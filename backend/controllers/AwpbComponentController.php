<?php

namespace backend\controllers;

use Yii;
use backend\models\AwpbComponent;
use backend\models\AwpbComponentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Json;
use backend\models\AuditTrail;
use backend\models\User;
use yii\helpers\ArrayHelper;
use yii\web\IdentityInterface;
use common\models\Role;

/**
 * AwpbComponentController implements the CRUD actions for AwpbComponent model.
 */
class AwpbComponentController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'create', 'update', 'delete', 'view'],
                'rules' => [
                    [
                        'actions' => ['index', 'create', 'update', 'delete', 'view'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all AwpbComponent models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AwpbComponentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
     
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AwpbComponent model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new AwpbComponent model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
   // public function actionCreate()
   // {
        // $model = new AwpbComponent();

        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
        //     return $this->redirect(['view', 'id' => $model->id]);
        // }

        // return $this->render('create', [
        //     'model' => $model,
        // ]);
      //  }
        public function actionCreate()
        {
            if (User::userIsAllowedTo('Manage components')) 
            {
                 $model = new AwpbComponent();
                 $sub_component="";
                 $comp_code="";
                 if (Yii::$app->request->isAjax) {
                    $model->load(Yii::$app->request->post());
                    return Json::encode(\yii\widgets\ActiveForm::validate($model));
                }
    
                if (Yii::$app->request->post('addComponent') == 'true') {
                    // var_dump(Yii::$app->request->post()['User']['user_type']);
                    $sub_component = Yii::$app->request->post()['AwpbComponent']['sub_component'];
                }
    
                if (Yii::$app->request->post('addComponent') != 'true' && $model->load(Yii::$app->request->post()) ) {
                                     
                    
                    //$model->component_code  = $comp_model->component_code . '.' .$model->component_code;
                    
                    //Yii::$app->session->setFlash('success', 'Here were are ' . $model->subcomponent . ' was successfully added.');
              
                     
                    if ($model->subcomponent== "Subcomponent") 
                    {   $number_of_subcomponents = $model::find()
                        ->where(["parent_component_id" => $model->parent_component_id])
                        //->andWhere(["component_id" => $model->component_id])
                        ->count();
                        
                        $comp_model = $this->findModel($model->parent_component_id);
                        
                        if($number_of_subcomponents==0||$number_of_subcomponents =='')
                            {
                                    $comp_code = $comp_model->code .'.1';	
                            }
                            if($number_of_subcomponents>0||$number_of_subcomponents!='')
                            {		
                                $co = $number_of_subcomponents+1;				
                                $comp_code  =$comp_model->code .'.'.$co;
                            }
                        $model->access_level = $comp_model->access_level;    
                        $model->code = $comp_code;
                        //$model->funder_id = $comp_model->funder_id;
                        //$model->expense_category_id = $comp_model->expense_category_id;
                        $model->type = AwpbComponent::TYPE_SUB;
                        
                    }
                    else
                    {
                        $model->type = AwpbComponent::TYPE_MAIN;
                    }
    
                    $model->created_by = Yii::$app->user->identity->id;
                    $model->updated_by = Yii::$app->user->identity->id;
                   // $model->created_at = new \yii\db\Expression('NOW()');
                   // $model->updated_at = new \yii\db\Expression('NOW()');
                    
            
                    
                    if ($model->save()&&$model->validate()) {
                        $audit = new AuditTrail();
                        $audit->user = Yii::$app->user->id;
                        $audit->action = "Added component : "  . $model->name;
                        $audit->ip_address = Yii::$app->request->getUserIP();
                        $audit->user_agent = Yii::$app->request->getUserAgent();
                        $audit->save();
                        Yii::$app->session->setFlash('success', 'Component ' . $model->name . ' was successfully added.');
                    } else {
                        $message = '';
                        foreach ($model->getErrors() as $error) {
                            $message .= $error[0];
                        }
                        Yii::$app->session->setFlash('error', "Error occured while creating component: $model->name.Please try again.Error::" . $message);
                      
                return $this->render('create', [
                    'model' => $model,
                    "sub_component" => $sub_component
                ]);
                    }
                 
                //    return $this->redirect(['index']);
                    return $this->redirect(['view', 'id' => $model->id]);
                    
                 
                 
                }
                
                return $this->render('create', [
                    'model' => $model,
                    "sub_component" => $sub_component
                ]);
            } 
            else 
            {
                Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
                return $this->redirect(['site/home']);
            }
        } 
    

    /**
     * Updates an existing AwpbComponent model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (User::userIsAllowedTo('Manage components')) 
        {
         
            $model = $this->findModel($id);
            $model->updated_by = Yii::$app->user->identity->id;

            if (Yii::$app->request->isAjax) {
                $model->load(Yii::$app->request->post());
                return Json::encode(\yii\widgets\ActiveForm::validate($model));
            }
          

            if ($model->load(Yii::$app->request->post())) {
               
               
                if ($model->save(true,['name','outcome', 'output','access_level','updated_by'])&& $model->validate()) {


                    $subcomponents = AwpbComponent::find()->where(['=','parent_component_id',$model->id])->all();
         
                    if(isset($subcomponents) )
                    {
                        if( $subcomponents !=null)
                        {
                        foreach($subcomponents as $sub)
                        {
                            $sub->access_level =$model->access_level;
                            if ($sub->validate())
                            {
                                $sub->save();
                            }
                            else{
                                Yii::$app->session->setFlash('error', 'An error occurred while updating subcomponents.');
                                return $this->render('index');
                            }
                        }
                    }
                }




                    $audit = new AuditTrail();
                    $audit->user = Yii::$app->user->id;
                    $audit->action = "Updated component: " . $model->code .' - '.$model->name;
                    $audit->ip_address = Yii::$app->request->getUserIP();
                    $audit->user_agent = Yii::$app->request->getUserAgent();
                    $audit->save();
                    Yii::$app->session->setFlash('success', " Component ".$model->code." details were successfully updated.");
                    return $this->redirect(['view', 'id' => $model->id]); 
                   
                } else {
                    $message = '';
                    foreach ($model->getErrors() as $error) {
                        $message .= $error[0];
                    }
                    Yii::$app->session->setFlash('error', "Error occured while updating component " .$model->code." details Please try again.Error:" . $message);
                    return $this->render('update', [
                        'model' => $model,                      
                    ]);
                }
               
                return $this->redirect(['view', 'id' => $model->id]);
            }

            return $this->render('update', [
                'model' => $model,
            ]);
        } 
        else 
        {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['site/home']);
        }   
    }

    /**
     * Deletes an existing AwpbComponent model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    // public function actionDelete($id)
    // {
    //     $this->findModel($id)->delete();

    //     return $this->redirect(['index']);
    // }

    public function actionDelete($id) {
        //For now we just set the user status to User::STATUS_DELETED
        if (User::userIsAllowedTo('Manage components')) {
            $model = $this->findModel($id);
            $this->findModel($id)->delete();
          
            if ($model->save()) {
                $audit = new AuditTrail();
                $audit->user = Yii::$app->user->id;
                $audit->action = "Delete component : "  . $model->code . " ".$model->name;
                $audit->ip_address = Yii::$app->request->getUserIP();
                $audit->user_agent = Yii::$app->request->getUserAgent();
                $audit->save();
                Yii::$app->session->setFlash('success', "The component was successfully deleted.");
            } else {
                Yii::$app->session->setFlash('error', "The component could not be deleted. Please try again!");
            }
            return $this->redirect(['index']);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['site/home']);
        }
    }


    /**
     * Finds the AwpbComponent model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AwpbComponent the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AwpbComponent::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
