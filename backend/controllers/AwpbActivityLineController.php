<?php

namespace backend\controllers;

use Yii;
use backend\models\AwpbActivityLine;
use backend\models\AwpbActivityLineSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Json;
use backend\models\AuditTrail;
use backend\models\User;
use yii\base\Model;
use yii\caching\DbDependency;
use backend\models\AwpbUnitOfMeasure;
use yii\data\ActiveDataProvider;

/**
 * AwpbActivityLineController implements the CRUD actions for AwpbActivityLine model.
 */
class AwpbActivityLineController extends Controller
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
     * Lists all AwpbActivityLine models.
     * @return mixed
     */
    public function actionIndex()
    {

        $user = User::findOne(['id' => Yii::$app->user->id]);
        $searchModel = new AwpbActivityLineSearch();    

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $dataProvider->query->andFilterWhere(['district_id' => $user->district_id, 'created_by'=>$user->id,'status' => AWPBActivityLine:: STATUS_DRAFT,]);
         return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            ]);

    }

    /**
     * Displays a single AwpbActivityLine model.
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
     * Creates a new AwpbActivityLine model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    // public function actionCreate()
    // {
    //     $model = new AwpbActivityLine();

    //     if ($model->load(Yii::$app->request->post()) && $model->save()) {
    //         return $this->redirect(['view', 'id' => $model->id]);
    //     }

    //     return $this->render('create', [
    //         'model' => $model,
    //     ]);
    // }


    public function actionUpdate($id)
    {
        if (User::userIsAllowedTo('Manage AWPB activity lines')) {
            $model = $this->findModel($id);
         
               // $model = new AwpbActivityLine();
                 if (Yii::$app->request->isAjax) {
                    $model->load(Yii::$app->request->post());
                    return Json::encode(\yii\widgets\ActiveForm::validate($model));
                }
    
                if ($model->load(Yii::$app->request->post()) ) {
    
                    $total_q=0;
                    $total_amt=0.0;
                    $total_q_mo1 = !empty($model->mo_1) ? $model->mo_1: 0;
                    $total_q_mo2 = !empty($model->mo_2)  ? $model->mo_2: 0;
                    $total_q_mo3 = !empty($model->mo_3) ? $model->mo_3: 0;
                    $total_q_mo4  = !empty($model->mo_4) ? $model->mo_4: 0;
                    $total_q_mo5 = !empty($model->mo_5) ? $model->mo_5: 0;
                    $total_q_mo6 = !empty($model->mo_6) ? $model->mo_6: 0;
                    $total_q_mo7 =!empty($model->mo_7) ? $model->mo_7: 0;
                    $total_q_mo8 = !empty($model->mo_8) ? $model->mo_8: 0;
                    $total_q_mo9 = !empty($model->mo_9) ? $model->mo_9: 0;
                    $total_q_mo10 = !empty($model->mo_10)? $model->mo_10: 0;
                    $total_q_mo11 =!empty($model->mo_11) ? $model->mo_11: 0;  
                    $total_q_mo12 = !empty($model->mo_12) ? $model->mo_12: 0; 

                    $total_q1 = $total_q_mo1 + $total_q_mo2 + $total_q_mo3;
                    $total_q2 = $total_q_mo4 + $total_q_mo5 + $total_q_mo6 ;
                    $total_q3 = $total_q_mo7 + $total_q_mo8 + $total_q_mo9;
                    $total_q4 = $total_q_mo10 +  $total_q_mo11 +  $total_q_mo12;          


                    $total_q =  $total_q1 + $total_q2 + $total_q3 + $total_q4 ;

                    $total_amt=  $model->unit_cost!= 0 && $total_q != 0 ? $total_q * $model->unit_cost : 0;

                    if($total_q >0)
                    {
                        $model->mo_1  = $total_q_mo1 ;
                        $model->mo_2  = $total_q_mo2  ; 
                        $model->mo_3  =  $total_q_mo3;
                        $model->mo_4  = $total_q_mo4  ;
                        $model->mo_5  = $total_q_mo5 ;
                        $model->mo_6  =$total_q_mo6  ;
                        $model->mo_7  =$total_q_mo7 ;
                        $model->mo_8  =$total_q_mo8  ;
                        $model->mo_9  =$total_q_mo9;
                        $model->mo_10  =$total_q_mo10  ;
                        $model->mo_11  =$total_q_mo11  ; 
                        $model->mo_12  =$total_q_mo12;
                        $model->quarter_one_quantity= $total_q1;
                        $model->quarter_two_quantity= $total_q2;
                        $model->quarter_three_quantity= $total_q3;
                        $model->quarter_four_quantity= $total_q4;
                        $model->total_quantity =$total_q;

                        $model->mo_1_amount  = $total_q_mo1 * $model->unit_cost ;
                        $model->mo_2_amount  = $total_q_mo2  * $model->unit_cost ;
                        $model->mo_3_amount  =  $total_q_mo3 * $model->unit_cost ;
                        $model->mo_4_amount  = $total_q_mo4   * $model->unit_cost ;
                        $model->mo_5_amount  = $total_q_mo5  * $model->unit_cost ;
                        $model->mo_6_amount  =$total_q_mo6   * $model->unit_cost ;
                        $model->mo_7_amount  =$total_q_mo7  * $model->unit_cost ;
                        $model->mo_8_amount  =$total_q_mo8   * $model->unit_cost ;
                        $model->mo_9_amount  =$total_q_mo9 * $model->unit_cost ;
                        $model->mo_10_amount  =$total_q_mo10   * $model->unit_cost ;
                        $model->mo_11_amount  =$total_q_mo11  * $model->unit_cost ; 
                        $model->mo_12_amount  =$total_q_mo12 * $model->unit_cost ;
                        $model->quarter_one_amount = $total_q1* $model->unit_cost ;
                        $model->quarter_two_amount = $total_q2* $model->unit_cost ;
                        $model->quarter_three_amount = $total_q3* $model->unit_cost ;
                        $model->quarter_four_amount = $total_q4* $model->unit_cost ;
                        $model->total_amount = $total_amt;

                        $model->total_amount = $total_amt;
                
            
                    if ( $model->validate()) 
                    {
                        
                        if ($model->save()) {
                                                
                            $audit = new AuditTrail();
                            $audit->user = Yii::$app->user->id;
                            $audit->action = "Update AWPB Activitly Line : "  . $model->name;
                            $audit->ip_address = Yii::$app->request->getUserIP();
                            $audit->user_agent = Yii::$app->request->getUserAgent();
                            $audit->save();
                            Yii::$app->session->setFlash('success', 'AWPB activity line was successfully updated.');
                    
                        } 
                        else 
                        {
                            Yii::$app->session->setFlash('error', 'Error occured while updating AWPB activity line.');
                        }
                    
                        return $this->redirect(['view', 'id' => $model->id]);
                        }
                        
            
                
            } else {
                Yii::$app->session->setFlash('error', 'Enter quantity for at least one month.');
                
            }
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


    public function actionCreate() {
        if (User::userIsAllowedTo('Manage AWPB activity lines')) {
            $model = new AwpbActivityLine();
                  if (Yii::$app->request->isAjax) {
                    $model->load(Yii::$app->request->post());
                    return Json::encode(\yii\widgets\ActiveForm::validate($model));
                }
    
                if ($model->load(Yii::$app->request->post()) ) {
    
                    $total_q=0;
                    $total_amt=0.0;
                    $total_q_mo1 = !empty($model->mo_1) ? $model->mo_1: 0;
                    $total_q_mo2 = !empty($model->mo_2)  ? $model->mo_2: 0;
                    $total_q_mo3 = !empty($model->mo_3) ? $model->mo_3: 0;
                    $total_q_mo4  = !empty($model->mo_4) ? $model->mo_4: 0;
                    $total_q_mo5 = !empty($model->mo_5) ? $model->mo_5: 0;
                    $total_q_mo6 = !empty($model->mo_6) ? $model->mo_6: 0;
                    $total_q_mo7 =!empty($model->mo_7) ? $model->mo_7: 0;
                    $total_q_mo8 = !empty($model->mo_8) ? $model->mo_8: 0;
                    $total_q_mo9 = !empty($model->mo_9) ? $model->mo_9: 0;
                    $total_q_mo10 = !empty($model->mo_10)? $model->mo_10: 0;
                    $total_q_mo11 =!empty($model->mo_11) ? $model->mo_11: 0;  
                    $total_q_mo12 = !empty($model->mo_12) ? $model->mo_12: 0; 

                    $total_q1 = $total_q_mo1 + $total_q_mo2 + $total_q_mo3;
                    $total_q2 = $total_q_mo4 + $total_q_mo5 + $total_q_mo6 ;
                    $total_q3 = $total_q_mo7 + $total_q_mo8 + $total_q_mo9;
                    $total_q4 = $total_q_mo10 +  $total_q_mo11 +  $total_q_mo12;          


                    $total_q =  $total_q1 + $total_q2 + $total_q3 + $total_q4 ;

                    $total_amt=  $model->unit_cost!= 0 && $total_q != 0 ? $total_q * $model->unit_cost : 0;

                    if($total_q >0)
                    {
                        $model->mo_1  = $total_q_mo1 ;
                        $model->mo_2  = $total_q_mo2  ; 
                        $model->mo_3  =  $total_q_mo3;
                        $model->mo_4  = $total_q_mo4  ;
                        $model->mo_5  = $total_q_mo5 ;
                        $model->mo_6  =$total_q_mo6  ;
                        $model->mo_7  =$total_q_mo7 ;
                        $model->mo_8  =$total_q_mo8  ;
                        $model->mo_9  =$total_q_mo9;
                        $model->mo_10  =$total_q_mo10  ;
                        $model->mo_11  =$total_q_mo11  ; 
                        $model->mo_12  =$total_q_mo12;
                        $model->quarter_one_quantity= $total_q1;
                        $model->quarter_two_quantity= $total_q2;
                        $model->quarter_three_quantity= $total_q3;
                        $model->quarter_four_quantity= $total_q4;
                        $model->total_quantity =$total_q;

                        $model->mo_1_amount  = $total_q_mo1 * $model->unit_cost ;
                        $model->mo_2_amount  = $total_q_mo2  * $model->unit_cost ;
                        $model->mo_3_amount  =  $total_q_mo3 * $model->unit_cost ;
                        $model->mo_4_amount  = $total_q_mo4   * $model->unit_cost ;
                        $model->mo_5_amount  = $total_q_mo5  * $model->unit_cost ;
                        $model->mo_6_amount  =$total_q_mo6   * $model->unit_cost ;
                        $model->mo_7_amount  =$total_q_mo7  * $model->unit_cost ;
                        $model->mo_8_amount  =$total_q_mo8   * $model->unit_cost ;
                        $model->mo_9_amount  =$total_q_mo9 * $model->unit_cost ;
                        $model->mo_10_amount  =$total_q_mo10   * $model->unit_cost ;
                        $model->mo_11_amount  =$total_q_mo11  * $model->unit_cost ; 
                        $model->mo_12_amount  =$total_q_mo12 * $model->unit_cost ;
                        $model->quarter_one_amount = $total_q1* $model->unit_cost ;
                        $model->quarter_two_amount = $total_q2* $model->unit_cost ;
                        $model->quarter_three_amount = $total_q3* $model->unit_cost ;
                        $model->quarter_four_amount = $total_q4* $model->unit_cost ;
                        $model->total_amount = $total_amt;
                        $model->status = AwpbActivityLine::STATUS_DRAFT;
                        $model->updated_by = Yii::$app->user->identity->id;
                        $model->created_by = Yii::$app->user->identity->id;
                        $model->district_id = Yii::$app->getUser()->identity->district_id;
                        $model->province_id =  Yii::$app->getUser()->identity->province_id;
                    
                        $model->province_id =  Yii::$app->getUser()->identity->province_id;
                    
                
                     if ( $model->validate())
                      {
                    
                    if ($model->save()) {
                                            
                        $audit = new AuditTrail();
                        $audit->user = Yii::$app->user->id;
                        $audit->action = "Added AWPB Activitly Line : "  . $model->name;
                        $audit->ip_address = Yii::$app->request->getUserIP();
                        $audit->user_agent = Yii::$app->request->getUserAgent();
                        $audit->save();
                        Yii::$app->session->setFlash('success', 'AWPB activity line was successfully added.');
                 
                    } else {
                        Yii::$app->session->setFlash('error', 'Error occured while adding AWPB activity line.');
                    }
                 
                    return $this->redirect(['view', 'id' => $model->id]);
                    }
                
                    
                
            } else {
                Yii::$app->session->setFlash('error', 'Enter quantity for at least one month.');
                
            }
                }
                
                return $this->render('create', [
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
     * Updates an existing AwpbActivityLine model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    // public function actionUpdate($id)
    // {
    //     $model = $this->findModel($id);

    //     if ($model->load(Yii::$app->request->post()) && $model->save()) {
    //         return $this->redirect(['view', 'id' => $model->id]);
    //     }

    //     return $this->render('update', [
    //         'model' => $model,
    //     ]);
    // }

    /**
     * Deletes an existing AwpbActivityLine model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AwpbActivityLine model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AwpbActivityLine the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AwpbActivityLine::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionApprove()
    {
        if (User::userIsAllowedTo('Submit District AWPB')) {
            
            $model = new AwpbActivityLine();
            $searchModel = new AwpbActivityLineSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            $user = User::findOne(['id' => Yii::$app->user->id]);

       
            $dataProvider->query->andFilterWhere(['district_id' => $user->district_id,'status' => AWPBActivityLine:: STATUS_DRAFT,]);
            $activitylines = AwpbActivityLine::find()->where(['district_id'=>$user->district_id])->andWhere(['status' => AWPBActivityLine:: STATUS_DRAFT])->all();
            // if (Yii::$app->request->isAjax) {
            //     $model->load(Yii::$app->request->post());
            //     return Json::encode(\yii\widgets\ActiveForm::validate($model));
            // }
            // if (!empty(Yii::$app->request->post())) {
            if(isset($activitylines) )
            {
                if($activitylines!=null)
                {
                foreach($activitylines as $activityline)
                {
                    $activityline->status = AWPBActivityLine::STATUS_SUBMITTED;
                    if ($activityline->validate())
                    {
                        $activityline->save();
                        $audit = new AuditTrail();
                        $audit->user = Yii::$app->user->id;
                        $audit->action = "Submitted ".$activityline->id." : " .$activityline->name;
                        $audit->ip_address = Yii::$app->request->getUserIP();
                        $audit->user_agent = Yii::$app->request->getUserAgent();
                        $audit->save();
                    }
                    else{
                        Yii::$app->session->setFlash('error', 'An error occurred while submitting the District AWPB.');
                        return $this->render('index', [
                            'searchModel' => $searchModel,
                            'model' => $model,
                            'dataProvider' => $dataProvider,
                ]);
                    }
                   

                }
                Yii::$app->session->setFlash('success', 'The District AWPB has been submitted successfully.');
                return $this->render('index', [
                    'searchModel' => $searchModel,
                    'model' => $model,
                    'dataProvider' => $dataProvider,
        ]);

            }
              else{
                 Yii::$app->session->setFlash('error', 'No District AWPB to submit.');
                 return $this->render('index', [
                    'searchModel' => $searchModel,
                    'model' => $model,
                    'dataProvider' => $dataProvider,
        ]);
            }
        }     
        }
     else {
        Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
        return $this->redirect(['site/home']);
    }

    }
    public function actionMpc()
    {
       if (User::userIsAllowedTo('Manage province consolidated AWPB') )
        {
            $user = User::findOne(['id' => Yii::$app->user->id]);
            $searchModel = new AwpbActivityLine();
            $query = $searchModel::find();
            $query->select(['province_id','district_id','SUM(quarter_one_amount) as quarter_one_amount','SUM(quarter_two_amount) as quarter_two_amount','SUM(quarter_three_amount) as quarter_three_amount','SUM(quarter_four_amount) as quarter_four_amount','SUM(total_amount) as total_amount']);
         
            $query->where('province_id = :field1', [':field1' =>$user->province_id]);
            $query->groupBy('district_id');
            $query->all();
       



$dataProvider = new ActiveDataProvider([
    'query' => $query,
]);

                return $this->render('mpc', [
                                         'searchModel' => $searchModel,
                                        // 'model' => $model,
                                         'dataProvider' => $dataProvider,
                                         'show_results' => 1
                                     ]);
              
       } else {
           Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
           return $this->redirect(['site/home']);
         
 }
   }

    public function actionMpcd($id)
    {
        if (User::userIsAllowedTo('Manage province consolidated AWPB') )
        {            
            $user = User::findOne(['id' => Yii::$app->user->id]);
            $searchModel = new AwpbActivityLine();
            $query = $searchModel::find();
            $query->select(['activity_id','SUM(quarter_one_amount) as quarter_one_amount','SUM(quarter_two_amount) as quarter_two_amount','SUM(quarter_three_amount) as quarter_three_amount','SUM(quarter_four_amount) as quarter_four_amount','SUM(total_amount) as total_amount']);
            
            $query->where('district_id = :field1', [':field1' =>$id]);
            $query->groupBy('activity_id');
            $query->all();
            
            $dataProvider = new ActiveDataProvider([
                    'query' => $query,
                    ]);

            return $this->render('mpcd', [
                                        'searchModel' => $searchModel,
                                    // 'model' => $model,
                                        'dataProvider' => $dataProvider,
                                    // 'show_results' => 1
                                    ]);
                
        }
            else
            {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['site/home']);
            
            }
    }

    public function actionMpca($id)
    {
        if (User::userIsAllowedTo('Manage province consolidated AWPB') )
        {            
            $user = User::findOne(['id' => Yii::$app->user->id]);
            $searchModel = new AwpbActivityLine();
            $query = $searchModel::find();
            $query->select(['id','name','SUM(quarter_one_amount) as quarter_one_amount','SUM(quarter_two_amount) as quarter_two_amount','SUM(quarter_three_amount) as quarter_three_amount','SUM(quarter_four_amount) as quarter_four_amount','SUM(total_amount) as total_amount']);
            
            $query->where('activity_id = :field1', [':field1' =>$id]);
            $query->groupBy('id');
            $query->all();
            
            $dataProvider = new ActiveDataProvider([
                    'query' => $query,
                    ]);

            return $this->render('mpca', [
                                        'searchModel' => $searchModel,
                                    // 'model' => $model,
                                        'dataProvider' => $dataProvider,
                                    // 'show_results' => 1
                                    ]);
                
        }
            else
            {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['site/home']);
            
            }
    }
 
    private function queryData($id)
    {
        return AwpbActivityLine::find()
            ->select(['district_id','SUM(quarter_one_quantity) as quarter_one_quantity','SUM(quarter_two_quantity) as quarter_two_quantity','SUM(quarter_three_quantity) as quarter_three_quantity','SUM(quarter_four_quantity) as quarter_four_quantity','SUM(total_quantity) as total_quantity','SUM(total_amount) as total_amount'])
            //->select(['*','district_id'])
            
            // select(['*', 'AVG(salary) as avg_salary'])
            ->groupBy('district_id')
//            ->having('AVG(salary) > 60000')
           //     ->orderBy('SUM(total_amount)')
            //->limit(10)
            ->where("province_id = :field1", [':field1' =>$id])
            ->asArray()
            ->all();
        /*
        return Employee::find()
            ->select(["CONCAT(first_name, ' ', last_name) as full_name"])
            ->limit(10)
//            ->where([
//                'emp_no' => ['10001', '10002']
//            ])
//            ->andWhere(['gender' => 'M'])
//            ->offset(10)
            ->asArray()
            ->column();
        */
    }
  
    private function printTable($data)
    {
        $content = '<table class="table">';
        foreach ($data as $datum) {
            $content .= "<tr>";
            foreach ($datum as $key => $value) {
                $content .= "<td>$value</td>";
            }
            $content .= "</tr>";
        }
        $content .= '</table>';
        return $this->renderContent($content);
    }


}
