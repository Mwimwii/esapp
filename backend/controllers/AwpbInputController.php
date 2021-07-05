<?php

namespace backend\controllers;

use Yii;
use backend\models\AwpbInput;
use backend\models\AwpbInputSearch;
use backend\models\AwpbIndicator;
use backend\models\AwpbIndicatorSearch;
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
 * AwpbInputController implements the CRUD actions for AwpbInput model.
 */
class AwpbInputController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => [
                    'delete', 'view',   'viewo', 'viewp', 'viewpwpco', 'mpc', 'mpca', 'mpcd', 'mpco', 'mpcop', 'mpcod', 'mpcoa',
                    'index', 'indexpw', 'create', 'createpw', 'update', 'updatepw', 'mpcma', 'mpcoa', 'mpca', 'mpcmd', 'mpcod', 'mpcmp', 'mpcmp',
                    'mpcop', 'mpcd', 'mpwm', 'mpcm', 'mpwpco', 'mpco', 'mpc', 'decline', 'declinepwm', 'declinem', 'declinep', 'declinepwpco', 'decline', 'submitpw', 'submit', 'mpwpcoa'
                ],
                'rules' => [
                    [
                        'actions' => [
                            'delete', 'view',   'viewo', 'viewp', 'viewpwpco', 'mpc', 'mpca', 'mpcd', 'mpco', 'mpcop', 'mpcod', 'mpcoa',
                            'index', 'indexpw', 'create', 'createpw', 'update', 'updatepw', 'mpcma', 'mpcoa', 'mpca', 'mpcmd', 'mpcod', 'mpcmp', 'mpcmp',
                            'mpcop', 'mpcd', 'mpwm', 'mpcm', 'mpwpco', 'mpco', 'mpc', 'decline', 'declinepwm', 'declinem', 'declinep', 'declinepwpco', 'decline', 'submitpw', 'submit', 'mpwpcoa'
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
     * Lists all AwpbInput models.
     * @return mixed
     */
    public function actionIndex($id) {

        $user = User::findOne(['id' => Yii::$app->user->id]);
        $searchModel = new AwpbInputSearch();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $dataProvider->query->andFilterWhere(['awpb_template_id' => $id, 'district_id' => $user->district_id, 'created_by' => $user->id, 'status' => AWPBActivityLine::STATUS_DRAFT,]);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'id' => $id
        ]);
    }

    /**
     * Displays a single AwpbIndicator model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
  
    public function actionView($id)
    {
         $model = $this->findModel($id);
         $model_budget =new  \backend\models\AwpbBudget();
         $_model =  $model_budget::findOne(['id'=>$model->budget_id]);
        return $this->render('view', [
            'model' =>  $model,
            'status'=>  $_model->status
            
        ]);
        
    }


    public function actionComponentindicators() {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (isset(Yii::$app->request->post()['depdrop_parents'])) {
            $parents = Yii::$app->request->post('depdrop_parents');
            if ($parents != null) {
                $comp_id = $parents[0];
                // $parent_comp = \backend\models\AwpbComponent::findOne(['id'=>$comp_id]);
                // $parent_comp=   \backend\models\AwpbComponent::find()->where(['=','id',$comp_id])->one();
                return [
                    'output' => AwpbIndicator::getAwpbComponentIndicators($comp_id, true),
                    'selected' => '',
                ];
            }
        }
    }

    public function actionUpdate($id) {
         $model = $this->findModel($id);
         $model_budget =new  \backend\models\AwpbBudget();
         $_model =  $model_budget::findOne(['id'=>$model->budget_id]);
        if ($_model->status ==0 && User::userIsAllowedTo('Manage AWPB')) {
           

            if (Yii::$app->request->isAjax) {
                $model->load(Yii::$app->request->post());
                return Json::encode(\yii\widgets\ActiveForm::validate($model));
            }

            if ($model->load(Yii::$app->request->post())) {

                $total_q = 0;
                $total_amt = 0.0;
                $total_q_mo1 = !empty($model->mo_1) ? $model->mo_1 : 0;
                $total_q_mo2 = !empty($model->mo_2) ? $model->mo_2 : 0;
                $total_q_mo3 = !empty($model->mo_3) ? $model->mo_3 : 0;
                $total_q_mo4 = !empty($model->mo_4) ? $model->mo_4 : 0;
                $total_q_mo5 = !empty($model->mo_5) ? $model->mo_5 : 0;
                $total_q_mo6 = !empty($model->mo_6) ? $model->mo_6 : 0;
                $total_q_mo7 = !empty($model->mo_7) ? $model->mo_7 : 0;
                $total_q_mo8 = !empty($model->mo_8) ? $model->mo_8 : 0;
                $total_q_mo9 = !empty($model->mo_9) ? $model->mo_9 : 0;
                $total_q_mo10 = !empty($model->mo_10) ? $model->mo_10 : 0;
                $total_q_mo11 = !empty($model->mo_11) ? $model->mo_11 : 0;
                $total_q_mo12 = !empty($model->mo_12) ? $model->mo_12 : 0;

                $total_q1 = $total_q_mo1 + $total_q_mo2 + $total_q_mo3;
                $total_q2 = $total_q_mo4 + $total_q_mo5 + $total_q_mo6;
                $total_q3 = $total_q_mo7 + $total_q_mo8 + $total_q_mo9;
                $total_q4 = $total_q_mo10 + $total_q_mo11 + $total_q_mo12;

                $total_q = $total_q1 + $total_q2 + $total_q3 + $total_q4;

                $total_amt = $model->unit_cost != 0 && $total_q != 0 ? $total_q * $model->unit_cost : 0;

                if ($total_q > 0) {
                    $model->mo_1 = $total_q_mo1;
                    $model->mo_2 = $total_q_mo2;
                    $model->mo_3 = $total_q_mo3;
                    $model->mo_4 = $total_q_mo4;
                    $model->mo_5 = $total_q_mo5;
                    $model->mo_6 = $total_q_mo6;
                    $model->mo_7 = $total_q_mo7;
                    $model->mo_8 = $total_q_mo8;
                    $model->mo_9 = $total_q_mo9;
                    $model->mo_10 = $total_q_mo10;
                    $model->mo_11 = $total_q_mo11;
                    $model->mo_12 = $total_q_mo12;
                    $model->quarter_one_quantity = $total_q1;
                    $model->quarter_two_quantity = $total_q2;
                    $model->quarter_three_quantity = $total_q3;
                    $model->quarter_four_quantity = $total_q4;
                    $model->total_quantity = $total_q;

                    $model->mo_1_amount = $total_q_mo1 * $model->unit_cost;
                    $model->mo_2_amount = $total_q_mo2 * $model->unit_cost;
                    $model->mo_3_amount = $total_q_mo3 * $model->unit_cost;
                    $model->mo_4_amount = $total_q_mo4 * $model->unit_cost;
                    $model->mo_5_amount = $total_q_mo5 * $model->unit_cost;
                    $model->mo_6_amount = $total_q_mo6 * $model->unit_cost;
                    $model->mo_7_amount = $total_q_mo7 * $model->unit_cost;
                    $model->mo_8_amount = $total_q_mo8 * $model->unit_cost;
                    $model->mo_9_amount = $total_q_mo9 * $model->unit_cost;
                    $model->mo_10_amount = $total_q_mo10 * $model->unit_cost;
                    $model->mo_11_amount = $total_q_mo11 * $model->unit_cost;
                    $model->mo_12_amount = $total_q_mo12 * $model->unit_cost;
                    $model->quarter_one_amount = $total_q1 * $model->unit_cost;
                    $model->quarter_two_amount = $total_q2 * $model->unit_cost;
                    $model->quarter_three_amount = $total_q3 * $model->unit_cost;
                    $model->quarter_four_amount = $total_q4 * $model->unit_cost;
                    $model->total_amount = $total_amt;

                    $model->total_amount = $total_amt;
                    
                    $model->camp_id = $_model->camp_id;
                    $model->updated_by = Yii::$app->user->identity->id;
                    $model->created_by = Yii::$app->user->identity->id;
                    $model->district_id = $_model->district_id;
                    $model->province_id = $_model->province_id;

                    if ($model->validate()) {

                        if ($model->save()) {
                                                                             $_model->total_amount = \backend\models\AwpbInput::find()->where(['budget_id'=>$model->budget_id])->sum('total_amount');
                           $_model->quarter_one_amount  =\backend\models\AwpbInput::find()->where(['budget_id'=>$model->budget_id])->sum('quarter_one_amount ');
                            $_model->quarter_two_amount  =\backend\models\AwpbInput::find()->where(['budget_id'=>$model->budget_id])->sum('quarter_two_amount ');
                           $_model->quarter_three_amount  =\backend\models\AwpbInput::find()->where(['budget_id'=>$model->budget_id])->sum('quarter_three_amount ');
                       $_model->quarter_four_amount  =\backend\models\AwpbInput::find()->where(['budget_id'=>$model->budget_id])->sum('quarter_four_amount ');
                         
                           
//                                                 $_model->total_amount = !empty(\backend\models\AwpbInput::find()->where(['budget_id'=>$model->budget_id])->sum('total_amount'))?   $_model->total_amount:0;
//                           $_model->quarter_one_amount  =!empty(\backend\models\AwpbInput::find()->where(['budget_id'=>$model->budget_id])->sum('quarter_one_amount '))? $_model->quarter_one_amount :0;
//                            $_model->quarter_two_amount  =!empty(\backend\models\AwpbInput::find()->where(['budget_id'=>$model->budget_id])->sum('quarter_two_amount '))? $_model->quarter_two_amount :0;
//                           $_model->quarter_three_amount  =!empty(\backend\models\AwpbInput::find()->where(['budget_id'=>$model->budget_id])->sum('quarter_three_amount '))? $_model->quarter_three_amount :0;
//                       $_model->quarter_four_amount  =!empty(\backend\models\AwpbInput::find()->where(['budget_id'=>$model->budget_id])->sum('quarter_four_amount '))? $_model->quarter_four_amount :0;
//                         
                           $_model->save();
                            $audit = new AuditTrail();
                            $audit->user = Yii::$app->user->id;
                            $audit->action = "Update AWPB Input : " . $model->name;
                            $audit->ip_address = Yii::$app->request->getUserIP();
                            $audit->user_agent = Yii::$app->request->getUserAgent();
                            $audit->save();
                            Yii::$app->session->setFlash('success', 'AWPB input was successfully updated.');
                              return $this->redirect(['awpb-budget/view', 'id' => $model->budget_id, 'status'=>$_model->status]);
                        } else {
                            Yii::$app->session->setFlash('error', 'Error occured while updating AWPB input.');
                        }

                        return $this->redirect(['awpb-budget/view', 'id' => $model->budget_id, 'status'=>$_model->status]);
                    }
                } else {
                    Yii::$app->session->setFlash('error', 'Enter quantity for at least one month.');
                }
            }

            return $this->render('update', [
                        'model' => $model,
                 'id' => $model->budget_id,
                'status'=>$_model->status
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['site/home']);
        }
    }


    public function actionCreate($id) {
        if (User::userIsAllowedTo('Manage AWPB')) {
            $model = new AwpbInput();
            $model_budget =new  \backend\models\AwpbBudget();
           $_model =  $model_budget::findOne(['id'=>$model->budget_id]);

            if (Yii::$app->request->isAjax) {
                $model->load(Yii::$app->request->post());
                return Json::encode(\yii\widgets\ActiveForm::validate($model));
            }

            if ($model->load(Yii::$app->request->post())) {
                 $model_budget =new  \backend\models\AwpbBudget();
           $_model =  $model_budget::findOne(['id'=>$model->budget_id]);


                $total_q = 0;
                $total_amt = 0.0;
                $total_q_mo1 = !empty($model->mo_1) ? $model->mo_1 : 0;
                $total_q_mo2 = !empty($model->mo_2) ? $model->mo_2 : 0;
                $total_q_mo3 = !empty($model->mo_3) ? $model->mo_3 : 0;
                $total_q_mo4 = !empty($model->mo_4) ? $model->mo_4 : 0;
                $total_q_mo5 = !empty($model->mo_5) ? $model->mo_5 : 0;
                $total_q_mo6 = !empty($model->mo_6) ? $model->mo_6 : 0;
                $total_q_mo7 = !empty($model->mo_7) ? $model->mo_7 : 0;
                $total_q_mo8 = !empty($model->mo_8) ? $model->mo_8 : 0;
                $total_q_mo9 = !empty($model->mo_9) ? $model->mo_9 : 0;
                $total_q_mo10 = !empty($model->mo_10) ? $model->mo_10 : 0;
                $total_q_mo11 = !empty($model->mo_11) ? $model->mo_11 : 0;
                $total_q_mo12 = !empty($model->mo_12) ? $model->mo_12 : 0;

                $total_q1 = $total_q_mo1 + $total_q_mo2 + $total_q_mo3;
                $total_q2 = $total_q_mo4 + $total_q_mo5 + $total_q_mo6;
                $total_q3 = $total_q_mo7 + $total_q_mo8 + $total_q_mo9;
                $total_q4 = $total_q_mo10 + $total_q_mo11 + $total_q_mo12;

                $total_q = $total_q1 + $total_q2 + $total_q3 + $total_q4;

                $total_amt = $model->unit_cost != 0 && $total_q != 0 ? $total_q * $model->unit_cost : 0;

                if ($total_q > 0) {
                    $model->mo_1 = $total_q_mo1;
                    $model->mo_2 = $total_q_mo2;
                    $model->mo_3 = $total_q_mo3;
                    $model->mo_4 = $total_q_mo4;
                    $model->mo_5 = $total_q_mo5;
                    $model->mo_6 = $total_q_mo6;
                    $model->mo_7 = $total_q_mo7;
                    $model->mo_8 = $total_q_mo8;
                    $model->mo_9 = $total_q_mo9;
                    $model->mo_10 = $total_q_mo10;
                    $model->mo_11 = $total_q_mo11;
                    $model->mo_12 = $total_q_mo12;
                    $model->quarter_one_quantity = $total_q1;
                    $model->quarter_two_quantity = $total_q2;
                    $model->quarter_three_quantity = $total_q3;
                    $model->quarter_four_quantity = $total_q4;
                    $model->total_quantity = $total_q;

                    $model->mo_1_amount = $total_q_mo1 * $model->unit_cost;
                    $model->mo_2_amount = $total_q_mo2 * $model->unit_cost;
                    $model->mo_3_amount = $total_q_mo3 * $model->unit_cost;
                    $model->mo_4_amount = $total_q_mo4 * $model->unit_cost;
                    $model->mo_5_amount = $total_q_mo5 * $model->unit_cost;
                    $model->mo_6_amount = $total_q_mo6 * $model->unit_cost;
                    $model->mo_7_amount = $total_q_mo7 * $model->unit_cost;
                    $model->mo_8_amount = $total_q_mo8 * $model->unit_cost;
                    $model->mo_9_amount = $total_q_mo9 * $model->unit_cost;
                    $model->mo_10_amount = $total_q_mo10 * $model->unit_cost;
                    $model->mo_11_amount = $total_q_mo11 * $model->unit_cost;
                    $model->mo_12_amount = $total_q_mo12 * $model->unit_cost;
                    $model->quarter_one_amount = $total_q1 * $model->unit_cost;
                    $model->quarter_two_amount = $total_q2 * $model->unit_cost;
                    $model->quarter_three_amount = $total_q3 * $model->unit_cost;
                    $model->quarter_four_amount = $total_q4 * $model->unit_cost;
                    $model->total_amount = $total_amt;
                    $model->status = AwpbInput::STATUS_DRAFT;
                    $model->updated_by = Yii::$app->user->identity->id;
                    $model->created_by = Yii::$app->user->identity->id;
                  
                    $model->camp_id = $_model->camp_id;
                    $model->updated_by = Yii::$app->user->identity->id;
                    $model->created_by = Yii::$app->user->identity->id;
                    $model->district_id = $_model->district_id;
                    $model->province_id = $_model->province_id;

                    if ($model->validate()) {

                        if ($model->save()) {     
                             $_model->total_amount =\backend\models\AwpbInput::find()->where(['budget_id'=>$model->budget_id])->sum('total_amount');
                           $_model->quarter_one_amount  =\backend\models\AwpbInput::find()->where(['budget_id'=>$model->budget_id])->sum('quarter_one_amount ');
                            $_model->quarter_two_amount  =\backend\models\AwpbInput::find()->where(['budget_id'=>$model->budget_id])->sum('quarter_two_amount ');
                           $_model->quarter_three_amount  =\backend\models\AwpbInput::find()->where(['budget_id'=>$model->budget_id])->sum('quarter_three_amount ');
                       $_model->quarter_four_amount  =\backend\models\AwpbInput::find()->where(['budget_id'=>$model->budget_id])->sum('quarter_four_amount ');
                         
                           $_model->save();
                            $audit = new AuditTrail();
                            $audit->user = Yii::$app->user->id;
                            $audit->action = "Added AWPB input : " . $model->name . " # " . $model->id;
                            $audit->ip_address = Yii::$app->request->getUserIP();
                            $audit->user_agent = Yii::$app->request->getUserAgent();
                            $audit->save();
                            Yii::$app->session->setFlash('success', 'AWPB input was successfully added.');
                              return $this->redirect(['awpb-budget/view', 'id' => $model->budget_id, 'status'=>$_model->status]);
                        } else {
                            $message = "";
                            foreach ($model->getErrors() as $error) {
                                $message .= $error[0];
                            }
                         
                              Yii::$app->session->setFlash('error', 'Error occured while adding AWPB input::' . $message);
                            //  return $this->redirect(['home/home']);
                        }

                        return $this->redirect(['awpb-budget/view', 'id' => $model->budget_id, 'status'=>$_model->status]);
                    }
                }
                else {
                    Yii::$app->session->setFlash('error', 'Enter quantity for at least one month.');
                }
                
                
            }


            return $this->render('create', [
                        'model' => $model,
                        'id' => $id
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['site/home']);
        }
   }

    /**
     * Deletes an existing AwpbIndicator model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id,$id2,$status) {
        if (User::userIsAllowedTo('Manage AWPB')) {
            $budget_id = $this->findModel($id)->budget_id;
            $this->findModel($id)->delete();
            $model_budget =new  \backend\models\AwpbBudget();
            $_model =  $model_budget::findOne(['id'=>$budget_id]);
           
            $total_amount = \backend\models\AwpbInput::find()->where(['budget_id'=> $budget_id])->sum('total_amount');
            $quarter_one_amount  =\backend\models\AwpbInput::find()->where(['budget_id'=> $budget_id])->sum('quarter_one_amount ');
            $quarter_two_amount  =\backend\models\AwpbInput::find()->where(['budget_id'=> $budget_id])->sum('quarter_two_amount ');
            $quarter_three_amount  =\backend\models\AwpbInput::find()->where(['budget_id'=> $budget_id])->sum('quarter_three_amount ');
            $quarter_four_amount  =\backend\models\AwpbInput::find()->where(['budget_id'=> $budget_id])->sum('quarter_four_amount ');  
            $_model->total_amount =!empty($total_amount) ? $total_amount : 0;
            $_model->quarter_one_amount  =!empty($quarter_one_amount) ? $quarter_one_amount : 0;
            $_model->quarter_two_amount  =!empty($quarter_two_amount) ? $quarter_two_amount : 0;
            $_model->quarter_three_amount  =!empty($quarter_three_amount) ? $quarter_three_amount : 0;
            $_model->quarter_four_amount  =!empty($quarter_four_amount) ? $quarter_four_amount : 0;
            $_model->save();
         
            return $this->redirect(['awpb-budget/view', 'id' =>  $budget_id,'status'=>$status]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
        }
    }

    /**
     * Finds the AwpbIndicator model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AwpbIndicator the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = AwpbInput::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
