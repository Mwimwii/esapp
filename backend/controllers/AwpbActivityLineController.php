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
        $searchModel = new AwpbActivityLineSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

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


    public function actionCreate() {
        if (User::userIsAllowedTo('View AWPB activity lines')) {
          
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

                    $total_q1 = $total_q_mo1 +
                    $total_q_mo2 + 
                    $total_q_mo3;
                    $total_q2 = $total_q_mo4 +
                    $total_q_mo5;
                    $total_q_mo6 ;
                    $total_q3 = $total_q_mo7+
                    $total_q_mo8 +
                    $total_q_mo9;
                    $total_q4 = $total_q_mo10 +
                    $total_q_mo11 +  
                    $total_q_mo12;          


                    $total_q =  $total_q1 + $total_q1 + $total_q3 + $total_q4 ;

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
                    $model->total_amount = $total_amt;
                    $model->status = AwpbActivityLine::STATUS_DRAFT;
                    $model->updated_by = Yii::$app->user->identity->id;
                    $model->created_by = Yii::$app->user->identity->id;
                    $model->district_id = Yii::$app->getUser()->identity->district_id;
                    $model->province_id =  Yii::$app->getUser()->identity->province_id;
                
                    $model->province_id =  Yii::$app->getUser()->identity->province_id;
                
                
                 if ( $model->validate()) {
                    
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
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

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
}
