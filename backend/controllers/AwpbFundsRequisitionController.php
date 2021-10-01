<?php

namespace backend\controllers;

use Yii;
use backend\models\AwpbFundsRequisition;
use backend\models\AwpbFundsRequisitionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\User;
use backend\models\AuditTrail;
use yii\data\ActiveDataProvider;
/**
 * AwpbFundsRequisitionController implements the CRUD actions for AwpbFundsRequisition model.
 */
class AwpbFundsRequisitionController extends Controller {

    /**
     * {@inheritdoc}
     */
  public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => [
                    'delete', 'view','index',  'create',  'update', 'funds_request_district','funds_request_pco'
                ],
                'rules' => [
                    [
                        'actions' => [
                            'delete', 'view','index',  'create',  'update', 'funds_request_district','funds_request_pco'
                        ],
                        //'story/create/<id:\d+>/<usr:\d+>' => 'story/create',
                        //'awpb-activity-line/mpca/<id:\d+>/<distr:\d+>',
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
     * Lists all AwpbFundsRequisition models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new AwpbFundsRequisitionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
        
        
    }

    /**
     * Displays a single AwpbFundsRequisition model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new AwpbFundsRequisition model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
//    public function actionCreate()
//    {
//        $model = new AwpbFundsRequisition();
//
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id]);
//        }
//
//        return $this->render('create', [
//            'model' => $model,
//        ]);
//    }


    public function actionFrd() {
        $user = \backend\models\User::findOne(['id' => Yii::$app->user->id]);
        $template_model = \backend\models\AwpbTemplate::find()->where(['status' => \backend\models\AwpbTemplate::STATUS_CURRENT_BUDGET])->one();
        if (User::userIsAllowedTo('Manage AWPB') || User::userIsAllowedTo('Manage PW AWPB')) {


            if (Yii::$app->request->isPost) {

                   $id = Yii::$app->request->post('id');
            if ($user->province_id == 0 || $user->province_id == '') {
                $_model = \backend\models\AwpbBudget_1::findOne(['id' => $id]);
            } else {
                $_model = \backend\models\AwpbBudget::findOne(['id' => $id]);
            }
            if (Yii::$app->request->isAjax) {
                $model->load(Yii::$app->request->post());
                return Json::encode(\yii\widgets\ActiveForm::validate($model));
            }
         
            
                if (!empty($template_model)) {
                    $awpb_actual_inputs = \backend\models\AwpbActualInput::find()->where(['=', 'awpb_template_id', $template_model->id])->andWhere(['=', 'district_id', $id])->all();

                    if (!empty($awpb_actual_inputs)) {
                        //$model_actual_input = new AwpbFundsRequisition();
                        foreach ($awpb_actual_inputs as $model) {

                            $model_actual_input = new AwpbFundsRequisition();
                            $model_actual_input->component_id = $model->component_id;
                            $model_actual_input->budget_id = $model->budget_id;
                            $model_actual_input->input_id = $model->id;
                            $model_actual_input->name = $model->name;
                            $model_actual_input->unit_of_measure_id = $model->unit_of_measure_id;
                            $model_actual_input->unit_cost = $model->unit_cost;
                            if ($template_model->quarter == 1) {
                                $model_actual_input->quarter_number = 1;

//                                $model_actual_input->mo_1 = $model->mo_1;
//                                $model_actual_input->mo_2 = $model->mo_2;
//                                $model_actual_input->mo_3 = $model->mo_3;
                                $model_actual_input->quarter_quantity = $model->quarter_one_quantity;
                                $model_actual_input->mo_1_amount = $model->mo_1 * $model->unit_cost;
                                $model_actual_input->mo_2_amount = $model->mo_2 * $model->unit_cost;
                                $model_actual_input->mo_3_amount = $model->mo_3 * $model->unit_cost;
                                $model_actual_input->quarter_amount = $model->quarter_one_quantity * $model->unit_cost;
                            }
                            if ($template_model->quarter == 2) {
                                $model_actual_input->quarter_number = 2;
                                $model_actual_input->mo_4 = $model->mo_4;
                                $model_actual_input->mo_5 = $model->mo_5;
                                $model_actual_input->mo_6 = $model->mo_6;
                                $model_actual_input->quarter_quantity = $model->quarter_two_quantity;
                                $model_actual_input->mo_4_amount = $model->mo_4 * $model->unit_cost;
                                $model_actual_input->mo_5_amount = $model->mo_5 * $model->unit_cost;
                                $model_actual_input->mo_6_amount = $model->mo_6 * $model->unit_cost;
                                $model_actual_input->quarter_amount = $model->quarter_two_quantity * $model->unit_cost;
                            }
                            if ($template_model->quarter == 3) {
                                $model_actual_input->quarter_number = 3;
                                $model_actual_input->mo_7 = $model->mo_7;
                                $model_actual_input->mo_8 = $model->mo_8;
                                $model_actual_input->mo_9 = $model->mo_9;
                                $model_actual_input->quarter_quantity = $model->quarter_two_quantity;
                                $model_actual_input->mo_7_amount = $model->mo_7 * $model->unit_cost;
                                $model_actual_input->mo_8_amount = $model->mo_8 * $model->unit_cost;
                                $model_actual_input->mo_9_amount = $model->mo_9 * $model->unit_cost;
                                $model_actual_input->quarter_amount = $model->quarter_three_quantity * $model->unit_cost;
                            }
                            if ($template_model->quarter == 4) {

                                $model_actual_input->quarter_number = 4;
                                $model_actual_input->mo_10 = $model->mo_10;
                                $model_actual_input->mo_11 = $model->mo_11;
                                $model_actual_input->mo_12 = $model->mo_12;
                                $model_actual_input->quarter_quantity = $model->quarter_two_quantity;
                                $model_actual_input->mo_10_amount = $model->mo_10 * $model->unit_cost;
                                $model_actual_input->mo_11_amount = $model->mo_11 * $model->unit_cost;
                                $model_actual_input->mo_12_amount = $model->mo_12 * $model->unit_cost;
                                $model_actual_input->quarter_amount = $model->quarter_four_quantity * $model->unit_cost;
                            }

                            $model_actual_input->status = AwpbFundsRequisition::STATUS_PROVINCIAL;
                            $model_actual_input->updated_by = Yii::$app->user->identity->id;
                            $model_actual_input->created_by = Yii::$app->user->identity->id;
                            $model_actual_input->district_id = $model->district_id;
                            $model_actual_input->province_id = $model->province_id;
                            $model_actual_input->awpb_template_id = $model->awpb_template_id;
                            $model_actual_input->activity_id = $model->activity_id;
                            $model_actual_input->budget_id = $model->budget_id;
                            $model_actual_input->component_id = $model->component_id;
                            $model_actual_input->input_id = $model->input_id;
                            // $model_actual_input->save();
                            if ($model_actual_input->save()) {
                              
                            } else {
                                $message = "";
                                foreach ($model_actual_input->getErrors() as $error) {
                                    $message .= $error[0];
                                }

                                Yii::$app->session->setFlash('error', 'Error occured while requesting for funds: ' . $message);
                                //  return $this->redirect(['home/home']);
                            }
                        }

                        
                        
                        $district_model = \backend\models\AwpbDistrict::findOne(['awpb_template_id' => $template_model->id, 'district_id' =>$user->district_id]);
                         if (!empty($district_model)) {
            $district_model->updated_by = Yii::$app->user->identity->id;
            $district_model ->status = $template_model->quarter;
            if ($template_model->quarter==1)
            {
                $district_model ->status_q_1 = \backend\models\AwpbDistrict::STATUS_QUARTER_REQUESTED;
            }
             if ($template_model->quarter==2)
            {
                   $district_model ->status_q_2 = \backend\models\AwpbDistrict::STATUS_QUARTER_REQUESTED;
            }
             if ($template_model->quarter==3)
            {
                   $district_model ->status_q_3 =  \backend\models\AwpbDistrict::STATUS_QUARTER_REQUESTED;
            }
             if ($template_model->quarter==4)
            {
                   $district_model ->status_q_4 = \backend\models\AwpbDistrict::STATUS_QUARTER_REQUESTED;
            }
              if ( $district_model->save()) {           
                        
                       
                     
                        $audit = new AuditTrail();
                        $audit->user = Yii::$app->user->id;
                        $audit->action = "Quarterly Operation Funds Requisition  : Q" . $template_model->quarter . " for " . $district_model->name . " District";
                        $audit->ip_address = Yii::$app->request->getUserIP();
                        $audit->user_agent = Yii::$app->request->getUserAgent();
                        $audit->save();
                          Yii::$app->session->setFlash('success', 'Funds request was submitted successfully.');
                             return $this->redirect(['awpb-actual-input/qofr', 
                    // 'searchModel' => $searchModel,
                    // 'dataProvider' => $dataProvider,
                    'id' => $template_model->quarter,
                    'id2' =>$template_model->quarter,
                    'quarter' => $template_model->quarter]);
                    }
                    } else {
                                $message = "";
                                foreach ($model_actual_input->getErrors() as $error) {
                                    $message .= $error[0];
                                }

                                Yii::$app->session->setFlash('error', 'Error occured while requesting for funds:' . $message);
                                //  return $this->redirect(['home/home']);
                            }
                    }
                    
                    else {
                        Yii::$app->session->setFlash('error', 'No Input budget available.');
                    }
                         
                } else {
                    Yii::$app->session->setFlash('error', 'No current budget available.');
                }
            } else {
                     return $this->redirect(['awpb-actual-input/qofr', 
                    // 'searchModel' => $searchModel,
                    // 'dataProvider' => $dataProvider,
                    'id' => $template_model->quarter,
                    'id2' =>$template_model->quarter,
                    'quarter' => $template_model->quarter
        ]);
            }
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
        }
    }

    /**
     * Updates an existing AwpbFundsRequisition model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing AwpbFundsRequisition model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AwpbFundsRequisition model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AwpbFundsRequisition the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = AwpbFundsRequisition::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    
     public function actionQofrpw($id, $id2) {
         $user = User::findOne(['id' => Yii::$app->user->id]);
            if (User::userIsAllowedTo('Request Funds') && ( $user->province_id == 0 || $user->province_id == '')) {
                 $cost_centre_id=0;
           if (Yii::$app->request->post('costCentre') == 'true') {
                // var_dump(Yii::$app->request->post()['User']['user_type']);
                $cost_centre_id = Yii::$app->request->post()['AwpbFundsRequisition']['cost_centre_id'];
            }

        $quarter = "";
        return $this->render('qofrpw', [
                    // 'searchModel' => $searchModel,
                    // 'dataProvider' => $dataProvider,
                    'id' => $id,
                    'id2' => $id2,
                    'quarter' => $quarter,
                  'cost_centre_id'=>$cost_centre_id
            ]);
        
           } else 
           {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
       }
    
    public function actionQofr($id, $id2) {
        $quarter = 0;
        $template_model =  \backend\models\AwpbTemplate::find()->where(['status' =>\backend\models\AwpbTemplate::STATUS_CURRENT_BUDGET])->one();
        if(!empty( $template_model))
        {
             $quarter = $template_model->quarter;
        }
        
        return $this->render('qofr', [
                    // 'searchModel' => $searchModel,
                    // 'dataProvider' => $dataProvider,
                    'id' => $id,
                    'id2' => $id2,
                    'quarter' => $quarter
        ]);
 
    }

    public function actionQofu($id, $id2) {
        $quarter = "";
        return $this->render('qofu', [
                    // 'searchModel' => $searchModel,
                    // 'dataProvider' => $dataProvider,
                    'id' => $id,
                    'id2' => $id2,
                    'quarter' => $quarter
        ]);
    }

    public function actionQofri($id, $id2) {
        $quarter = "";
        return $this->render('qofri', [
                    // 'searchModel' => $searchModel,
                    // 'dataProvider' => $dataProvider,
                    'id' => $id,
                    'id2' => $id2,
                    'quarter' => $quarter
        ]);

    }

    public function actionQofui($id, $id2) {
        $quarter = "";
        return $this->render('qofui', [
                    // 'searchModel' => $searchModel,
                    // 'dataProvider' => $dataProvider,
                    'id' => $id,
                    'id2' => $id2,
                    'quarter' => $quarter
        ]);
    }

    public function actionQofrd($id, $id2) {

        $user = User::findOne(['id' => Yii::$app->user->id]);
        $template_model = \backend\models\AwpbTemplate::find()->where(['status' => \backend\models\AwpbTemplate::STATUS_CURRENT_BUDGET])->one();
        $quarter = $template_model->quarter;
        $searchModel = new AwpbActualInput();

        if (User::userIsAllowedTo('Review Funds Request') && ( $user->province_id != 0 || $user->province_id != '')) {
            $query = $searchModel::find();
            $query->select(['awpb_template_id', 'district_id', 'province_id', 'SUM(mo_1_amount) as mo_1_amount', 'SUM(mo_2_amount) as mo_2_amount', 'SUM(mo_3_amount) as mo_3_amount', 'SUM(quarter_amount) as quarter_amount']);
            $query->where(['=', 'awpb_template_id', $template_model->id]);
            $query->andWhere(['=', 'province_id', $user->province_id]);
            $query->andWhere(['=', 'quarter_number', $template_model->quarter]);
            $query->andWhere(['=', 'status', AwpbActualInput::STATUS_DISTRICT]);
            $query->groupBy('district_id');
            $query->all();

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);

            return $this->render('qofrd', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                        'id' => $id,
                        'id2' => $id2,
                        'quarter' => $quarter
            ]);
        } elseif (User::userIsAllowedTo('Approve Funds Requisition') && ($user->province_id == 0 || $user->province_id == '')) {
            $query = $searchModel::find();
            $query->select(['awpb_template_id', 'district_id', 'SUM(mo_1_amount) as mo_1_amount', 'SUM(mo_2_amount) as mo_2_amount', 'SUM(mo_3_amount) as mo_3_amount', 'SUM(quarter_amount) as quarter_amount']);
            //$query->join('LEFT JOIN', 'awpb_district', 'awpb_district.district_id = districk.id');
            $query->where(['=', 'awpb_template_id', $template_model->id]);

            // $query->andWhere(['=', 'district_id', $id2]);
            $query->andWhere(['=', 'quarter_number', $template_model->quarter]);
            $query->andWhere(['=', 'status', AwpbActualInput::STATUS_PROVINCIAL]);
            $query->groupBy('district_id');
            $query->all();

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);

            return $this->render('qofrd', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                        'id' => $id,
                        'id2' => $id2,
                        'quarter' => $quarter
            ]);
        } elseif (User::userIsAllowedTo('Disburse Funds') && ($user->province_id == 0 || $user->province_id == '')) {
            $query = $searchModel::find();
            $query->select(['awpb_template_id', 'district_id', 'SUM(mo_1_amount) as mo_1_amount', 'SUM(mo_2_amount) as mo_2_amount', 'SUM(mo_3_amount) as mo_3_amount', 'SUM(quarter_amount) as quarter_amount']);
            //$query->join('LEFT JOIN', 'awpb_district', 'awpb_district.district_id = districk.id');
            $query->where(['=', 'awpb_template_id', $template_model->id]);

            //$query->andWhere(['=', 'district_id', $id2]);
            $query->andWhere(['=', 'quarter_number', $template_model->quarter]);
            $query->andWhere(['=', 'status', AwpbActualInput::STATUS_SPECIALIST]);
            $query->groupBy('district_id');
            $query->all();

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);

            return $this->render('qofrd', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                        'id' => $id,
                        'id2' => $id2,
                        'quarter' => $quarter
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    public function actionQofud($id, $id2) {

        $user = User::findOne(['id' => Yii::$app->user->id]);
        $template_model = \backend\models\AwpbTemplate::find()->where(['status' => \backend\models\AwpbTemplate::STATUS_CURRENT_BUDGET])->one();
        $quarter = $template_model->quarter;
        $searchModel = new \backend\models\AwpbDistrict();

        if (User::userIsAllowedTo('View Funds Utilisation') && ( $user->province_id != 0 || $user->province_id != '')) {
            $query = $searchModel::find();
            $query->select(['awpb_template_id', 'district_id', 'cost_centre_id', 'province_id', 'SUM(quarter_one_amount) as quarter_one_amount', 'SUM(quarter_two_amount) as quarter_two_amount', 'SUM(quarter_three_amount) as quarter_three_amount', 'SUM(quarter_four_amount) as quarter_four_amount']);
            $query->where(['=', 'awpb_template_id', $template_model->id]);
            $query->andWhere(['=', 'province_id', $user->province_id]);
            //  $query->andWhere(['=', 'quarter_number', $template_model->quarter]);
            // $query->andWhere(['=', 'status', AwpbActualInput::STATUS_DISBURSED]);
            $query->groupBy('district_id');
            $query->all();
            //\backend\models\AwpbActualInput::STATUS_DISBURSED
            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);

            return $this->render('qofud', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                        'id' => $id,
                        'id2' => $id2,
                        'quarter' => $quarter
            ]);
        } elseif (User::userIsAllowedTo('View Funds Utilisation') && ($user->province_id == 0 || $user->province_id == '')) {
            $query = $searchModel::find();
            $query->select(['awpb_template_id', 'district_id', 'cost_centre_id', 'province_id', 'SUM(quarter_one_amount) as quarter_one_amount', 'SUM(quarter_two_amount) as quarter_two_amount', 'SUM(quarter_three_amount) as quarter_three_amount', 'SUM(quarter_four_amount) as quarter_four_amount']);
            $query->where(['=', 'awpb_template_id', $template_model->id]);

            // $query->andWhere(['=', 'district_id', $id2]);
            //  $query->andWhere(['=', 'quarter_number', $template_model->quarter]);
            //   $query->andWhere(['=', 'status', AwpbActualInput::STATUS_DISBURSED]);
            $query->groupBy('district_id');
            $query->all();

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);

            return $this->render('qofud', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                        'id' => $id,
                        'id2' => $id2,
                        'quarter' => $quarter
            ]);
        } elseif (User::userIsAllowedTo('View Funds Utilisation') && ($user->province_id == 0 || $user->province_id == '')) {
            $query = $searchModel::find();
            $query->select(['awpb_template_id', 'district_id', 'province_id', 'SUM(quarter_one_amount) as quarter_one_amount', 'SUM(quarter_two_amount) as quarter_two_amount', 'SUM(quarter_three_amount) as quarter_three_amount', 'SUM(quarter_four_amount) as quarter_four_amount']);
            $query->where(['=', 'awpb_template_id', $template_model->id]);

            // $query->andWhere(['=', 'district_id', $id2]);
            //  $query->andWhere(['=', 'quarter_number', $template_model->quarter]);
            //   $query->andWhere(['=', 'status', AwpbActualInput::STATUS_DISBURSED]);
            $query->groupBy('district_id');
            $query->all();

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);

            return $this->render('qofud', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                        'id' => $id,
                        'id2' => $id2,
                        'quarter' => $quarter
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }
}
