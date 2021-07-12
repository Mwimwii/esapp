<?php

namespace backend\controllers;

use Yii;
use backend\models\AwpbBudget;
use backend\models\AwpbBudgetSearch;
use backend\models\AwpbBudget_1;
use backend\models\AwpbBudgetSearch_1;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Json;
use backend\models\AuditTrail;
use backend\models\User;
use yii\base\Model;
use yii\caching\DbDependency;
use yii\data\ActiveDataProvider;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use backend\models\AwpbUnitOfMeasure;


use backend\models\Storyofchange;
use backend\models\AwpbTemplate;
use backend\models\AwpbIndicator;
use backend\models\AwpbActivity;

/**
 * AwpbBudgetController implements the CRUD actions for AwpbBudget model.
 */
class AwpbBudgetController extends Controller {

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => [
                    'delete', 'view', 'viewo', 'viewp', 'viewpwpco', 'mp', 'mpc', 'mpca', 'mpcd', 'mpco', 'mpcd', 'mpcdo', 'mpcdoa', 'mpcop', 'mpcod', 'mpcoa',
                    'index', 'indexpw', 'create', 'createpw', 'update', 'updatepw', 'mpcma', 'mpcoa', 'mpca', 'mpcmd', 'mpcod', 'mpcmp', 'mpcmp',
                    'mpcop', 'mpcd', 'mpwm', 'mpcm', 'mpwpco', 'mpco', 'mpc', 'decline', 'declinepwm', 'declinem', 'declinep', 'declinepwpco', 'decline', 'submitpw', 'submit', 'mpwpcoa'
                ],
                'rules' => [
                    [
                        'actions' => [
                            'delete', 'view', 'viewo', 'viewp', 'viewpwpco', 'mp', 'mpc', 'mpca', 'mpcd', 'mpco', 'mpcd', 'mpcdo', 'mpcdoa', 'mpcop', 'mpcod', 'mpcoa',
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

    public function actionIndex($id, $status) {



        $user = User::findOne(['id' => Yii::$app->user->id]);
        $awpb_district = \backend\models\AwpbDistrict::findOne(['awpb_template_id' => $id, 'district_id' => $user->district_id]);
        // $status=100;
        if (!empty($awpb_district)) {
            $status = $awpb_district->status;
        
        //  $searchModel = new AwpbBudgetSearch();
        $searchModel = new AwpbBudget();
        $model = new AwpbBudget();
        $query = $searchModel::find();
        $query->select(['component_id','awpb_template_id', 'province_id', 'district_id', 'output_id', 'activity_id', 'indicator_id', 'id', 'quarter_one_quantity', 'quarter_two_quantity', 'quarter_three_quantity', 'quarter_four_quantity', 'total_amount']);
        $query->where(['=', 'awpb_template_id', $id]);
        // $query->andWhere(['=', 'status',$status]);
        $query->andWhere(['=', 'district_id', $user->district_id]);
        // $query->andWhere(['=', 'created_by', $user->id]);
        //  $query->groupBy('indicator_id');
        $query->all();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

//        if ($dataProvider->getCount() <= 0 || $dataProvider->count <= 0) {
//            $editable = 0;
//            $_searchModel = new AwpbBudget();
//            $_query = $searchModel::find();
//         $_query->select(['awpb_template_id', 'province_id', 'district_id', 'output_id', 'province_id', 'district_id', 'activity_id', 'indicator_id', 'id', 'quarter_one_quantity', 'quarter_two_quantity', 'quarter_three_quantity', 'quarter_four_quantity', 'total_amount']);
//            $_query->where(['=','awpb_template_id', $id]);
//            $_query->andWhere(['>=', 'status',$status]);
//            $_query->andWhere(['=', 'district_id', $user->district_id]);
//            //$_query->andWhere(['=', 'created_by', $user->id]);
//            // $_query->groupBy('indicator_id');
//            $_query->all();
//
//            $_dataProvider = new ActiveDataProvider([
//                'query' => $_query,
//            ]);
//
//            return $this->render('index', [
//                        'searchModel' => $_searchModel,
//                        'model' => $model,
//                        'dataProvider' => $_dataProvider,
//                      'id' => $id,
//                'status'=>$status,
//                        'editable' => 0
//            ]);
//        } else {
        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'model' => $model,
                    'dataProvider' => $dataProvider,
                    'id' => $id,
                    'status' => $status,
                    'editable' => 1
        ]);
        //}
        }else {
            Yii::$app->session->setFlash('error', 'This district has no activities.');
        return $this->redirect(['site/home']);}
    }

    public function actionIndexpw($id, $status) {



        $user = User::findOne(['id' => Yii::$app->user->id]);
        if ((User::userIsAllowedTo("Manage PW AWPB") || User::userIsAllowedTo('Approve AWPB - PCO') || User::userIsAllowedTo('Approve AWPB - Ministry')) && ($user->province_id == 0 || $user->province_id == '')) {

         $awpb_district = \backend\models\AwpbDistrict::findOne(['awpb_template_id' => $id]);
        // $status=100;
       // if (!empty($awpb_district)) {
        //    $status = $awpb_district->status;
        
            $searchModel = new AwpbBudget();
            $model = new AwpbBudget();
            $query = $searchModel::find();
            $query->select(['component_id','awpb_template_id', 'output_id', 'cost_centre_id', 'activity_id', 'indicator_id', 'id', 'quarter_one_quantity', 'quarter_two_quantity', 'quarter_three_quantity', 'quarter_four_quantity', 'total_amount']);
            $query->where(['=', 'awpb_template_id', $id]);
            //$query->andWhere(['=', 'status',$status]);
            $query->andWhere(['<>', 'cost_centre_id', 0]);
            // $query->andWhere(['=', 'created_by', $user->id]);
            //  $query->groupBy('indicator_id');
            $query->all();

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);

//        if ($dataProvider->getCount() <= 0 || $dataProvider->count <= 0) {
//            $editable = 0;
//            $_searchModel = new AwpbBudget();
//            $_query = $searchModel::find();
//         $_query->select(['awpb_template_id', 'province_id', 'district_id', 'output_id', 'province_id', 'district_id', 'activity_id', 'indicator_id', 'id', 'quarter_one_quantity', 'quarter_two_quantity', 'quarter_three_quantity', 'quarter_four_quantity', 'total_amount']);
//            $_query->where(['=','awpb_template_id', $id]);
//            $_query->andWhere(['>=', 'status',$status]);
//            $_query->andWhere(['=', 'district_id', $user->district_id]);
//            //$_query->andWhere(['=', 'created_by', $user->id]);
//            // $_query->groupBy('indicator_id');
//            $_query->all();
//
//            $_dataProvider = new ActiveDataProvider([
//                'query' => $_query,
//            ]);
//
//            return $this->render('index', [
//                        'searchModel' => $_searchModel,
//                        'model' => $model,
//                        'dataProvider' => $_dataProvider,
//                      'id' => $id,
//                'status'=>$status,
//                        'editable' => 0
//            ]);
//        } else {
            return $this->render('indexpw', [
                        'searchModel' => $searchModel,
                        'model' => $model,
                        'dataProvider' => $dataProvider,
                        'id' => $id,
                        'status' => $status,
                        'editable' => 1
            ]);
            //}}
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['site/home']);
        }
    }

    public function actionCheckList($id) {
        //  if (User::userIsAllowedTo('Setup AWPB')) {
        return $this->render('check-list', [
                    'model' => $this->findModel($id),
        ]);
        // } else {
        //     Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
        //     return $this->redirect(['home/home']);
        // }
    }

    public function actionViewp($id, $status) {
        return $this->render('viewp', [
                    'model' => $this->findModel($id),
                    'status' => $status
        ]);
    }

    public function actionView($id, $status) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
                    'status' => $status
        ]);
    }

    public function actionViewo($id) {
        return $this->render('viewo', [
                    'model' => $this->findModel($id),
        ]);
    }

    public function actionViewm($id) {
        return $this->render('viewm', [
                    'model' => $this->findModel($id),
        ]);
    }

    public function actionViewpw($id) {
        return $this->render('viewpw', [
                    'model' => $this->findModel($id),
        ]);
    }

    public function actionViewpwpco($id) {
        return $this->render('viewpwpco', [
                    'model' => $this->findModel($id),
        ]);
    }

    public function actionViewpwm($id) {
        return $this->render('viewpwm', [
                    'model' => $this->findModel($id),
        ]);
    }

    public function actionUpdate($id, $status) {
        $user = \backend\models\User::findOne(['id' => Yii::$app->user->id]);
        
        $camp_id ="";
        $_model = $this->findModel($id);
        $model="";
        if (($_model->cost_centre_id != 0 || $_model->cost_centre_id != '')&&($_model->province_id==0 ||$_model->province_id=='')) {
    
       $model = \backend\models\AwpbBudget_1::findOne($id);
   
   }
   else
   {
         $model = $this->findModel($id);
         $camp_id = $model->camp_id;
        
   }     

        if ((User::userIsAllowedTo('Manage AWPB') && ($user->district_id != 0 || $user->district_id != '' ||$model->cost_centre_id != 0 || $model->cost_centre_id != '') || (User::userIsAllowedTo('Approve AWPB - PCO'))&&($model->province_id == 0 || $model->province_id == ''))) {
            // $model = new AwpbBudget();

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
 // $indicator = \backend\models\AwpbIndicator::findOne(['id' => $model->indicator_id]);

                    $indicator = \backend\models\AwpbActivity::findOne(['id' => $model->activity_id]);
                    $model->name = $indicator->name;

                    $model->total_amount = \backend\models\AwpbInput::find()->where(['budget_id' => $id])->sum('total_amount');
                    $model->quarter_one_amount = \backend\models\AwpbInput::find()->where(['budget_id' => $model->id])->sum('quarter_one_amount ');
                    $model->quarter_two_amount = \backend\models\AwpbInput::find()->where(['budget_id' => $model->id])->sum('quarter_two_amount ');
                    $model->quarter_three_amount = \backend\models\AwpbInput::find()->where(['budget_id' => $model->id])->sum('quarter_three_amount ');
                    $model->quarter_four_amount = \backend\models\AwpbInput::find()->where(['budget_id' => $model->id])->sum('quarter_four_amount ');

//                             $model->total_amount = !empty(\backend\models\AwpbInput::find()->where(['budget_id'=>$id])->sum('total_amount'))?   $model->total_amount:0;
//                           $model->quarter_one_amount  =!empty(\backend\models\AwpbInput::find()->where(['budget_id'=>$model->id])->sum('quarter_one_amount '))? $model->quarter_one_amount :0;
//                            $model->quarter_two_amount  =!empty(\backend\models\AwpbInput::find()->where(['budget_id'=>$model->id])->sum('quarter_two_amount '))? $model->quarter_two_amount :0;
//                           $model->quarter_three_amount  =!empty(\backend\models\AwpbInput::find()->where(['budget_id'=>$model->id])->sum('quarter_three_amount '))? $model->quarter_three_amount :0;
//                       $model->quarter_four_amount  =!empty(\backend\models\AwpbInput::find()->where(['budget_id'=>$model->id])->sum('quarter_four_amount '))? $model->quarter_four_amount :0;
                    $number_of_non_women_headed_households = !empty($model->number_of_non_women_headed_households) ? $model->number_of_non_women_headed_households : 0;
                    $number_of_women_headed_households = !empty($model->number_of_women_headed_households) ? $model->number_of_women_headed_households : 0;
                    $model->number_of_household_members = $number_of_women_headed_households + $number_of_non_women_headed_households;
 
                    if ($model->validate() && $model->save()) {
                         
                            if ($model->camp_id != $camp_id &&($model->district_id==0 ||$model->district_id=='')&&($model->cost_centre_id == 0 || $model->cost_centre_id != '')) {
                                //  $province_id = backend\models\Districts::findOne([Yii::$app->getUser()->identity->district_id])->province_id;
                                $count = 0;
                                $errors = '';
                                $transaction = \Yii::$app->db->beginTransaction();
                                try {
                                    $awpbinputs = \backend\models\AwpbInput::find()->where(['=', 'budget_id', $model->id])->all();
                                    if ($awpbinputs != null) {

                                        foreach ($awpbinputs as $awpbinput) {
                                            $awpbinput->camp_id = $model->camp_id;
                                            $count++;
                                            if (!($flag = $awpbinput->save())) {
                                                $transaction->rollBack();
                                                foreach ($awpbinput->getErrors() as $error) {
                                                    $errors .= "\n" . $error[0];
                                                }
                                                break;
                                            }
                                        }

                                        if ($flag) {
                                            $transaction->commit();
                                            $audit = new AuditTrail();

                                            $audit->user = Yii::$app->user->id;
                                            $audit->action = "Added $count activity line";
                                            $audit->ip_address = Yii::$app->request->getUserIP();
                                            $audit->user_agent = Yii::$app->request->getUserAgent();
                                            $audit->save();
                                            //Yii::$app->session->setFlash('success', 'You have successfully added ' . $count . ' AWPB activity line.');
                                            // return $this->redirect(['index']);
                                        }
                                    }
                                } catch (Exception $e) {
                                    $transaction->rollBack();
                                    Yii::$app->session->setFlash('error', 'Error occured while updating the camp id.' . $ex->getMessage() . ' Please try again1');
                                }

                            }
                          else
                               {
                                //  $province_id = backend\models\Districts::findOne([Yii::$app->getUser()->identity->district_id])->province_id;
                                $count = 0;
                                $errors = '';
                                $transaction = \Yii::$app->db->beginTransaction();
                                try {
                                    $awpbinputs = \backend\models\AwpbInput::find()->where(['=', 'budget_id', $model->id])->all();
                                    if ($awpbinputs != null) {

                                        foreach ($awpbinputs as $awpbinput) {
                                            $awpbinput->cost_centre_id = $model->cost_centre_id;
                                            $count++;
                                            if (!($flag = $awpbinput->save())) {
                                                $transaction->rollBack();
                                                foreach ($awpbinput->getErrors() as $error) {
                                                    $errors .= "\n" . $error[0];
                                                }
                                                break;
                                            }
                                        }

                                        if ($flag) {
                                            $transaction->commit();
                                            $audit = new AuditTrail();

                                            $audit->user = Yii::$app->user->id;
                                            $audit->action = "Updated $count input";
                                            $audit->ip_address = Yii::$app->request->getUserIP();
                                            $audit->user_agent = Yii::$app->request->getUserAgent();
                                            $audit->save();
                                            //Yii::$app->session->setFlash('success', 'You have successfully added ' . $count . ' AWPB activity line.');
                                            // return $this->redirect(['index']);
                                        }
                                    }
                                } catch (Exception $e) {
                                    $transaction->rollBack();
                                    Yii::$app->session->setFlash('error', 'Error occured while updating the cost centre.' . $ex->getMessage() . ' Please try again1');
                                }

                               
                               
                            }
                         $audit = new AuditTrail();
                                $audit->user = Yii::$app->user->id;
                                $audit->action = "Update AWPB: " . $model->name . " : " . $model->id;
                                $audit->ip_address = Yii::$app->request->getUserIP();
                                $audit->user_agent = Yii::$app->request->getUserAgent();
                                $audit->save();
                                Yii::$app->session->setFlash('success', 'AWPB was successfully updated.');
                                  if (($model->province_id == 0 || $model->province_id == '') &&($model->cost_centre_id != 0 || $model->cost_centre_id != '')) {
                         
                            return $this->redirect(['viewpw', 'id' => $model->id, 'status'=>$status]);
                            
                            }
                            else{
                                 return $this->redirect(['view', 'id' => $model->id, 'status'=>$status]);
                            }
                    } else {
                        $message = '';
                        foreach ($model->getErrors() as $error) {
                            $message .= $error[0];
                              Yii::$app->session->setFlash('error', "Error occured while creating a component: ". $message);
                               
                           if (($model->province_id == 0 || $model->province_id == '') &&($model->cost_centre_id != 0 || $model->cost_centre_id != '')) {
                         
                            return $this->redirect(['viewpw', 'id' => $model->id, 'status'=>$status]);
                            }
                            else{
                                 return $this->redirect(['view', 'id' => $model->id, 'status'=>$status]);
                            }
                        }
                    }
                }else {
                        Yii::$app->session->setFlash('error', 'Enter quantity for at least one month.');
                    }
            }

            return $this->render('update', [
                        'model' => $model,
                        'template_id' => $model->awpb_template_id,
                        'status' => $status
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action1.');
            return $this->redirect(['site/home']);
        }
    }

    public function actionUpdatepw($id) {
        $user = \backend\models\User::findOne(['id' => Yii::$app->user->id]);

        if (User::userIsAllowedTo('Manage programme-wide AWPB activity lines') && $user->district_id == 0 || $user->district_id == '') {

            //if (User::userIsAllowedTo('Manage AWPB activity lines')) {
            $model = $this->findModel($id);

            // $model = new AwpbBudget();
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

                    $indicator = \backend\models\AwpbIndicator::findOne(['id' => $model->indicator_id5]);
                    $model->name = $indicator->name;
                    if ($model->validate()) {

                        if ($model->save()) {

                            $audit = new AuditTrail();
                            $audit->user = Yii::$app->user->id;
                            $audit->action = "Update AWPB Activitly Line : " . $model->name;
                            $audit->ip_address = Yii::$app->request->getUserIP();
                            $audit->user_agent = Yii::$app->request->getUserAgent();
                            $audit->save();
                            Yii::$app->session->setFlash('success', 'AWPB was successfully updated.');
                        } else {
                            Yii::$app->session->setFlash('error', 'Error occured while updating AWPB.');
                        }

                        return $this->redirect(['viewpw', 'id' => $model->id]);
                    }
                } else {
                    Yii::$app->session->setFlash('error', 'Enter quantity for at least one month.');
                }
            }

            return $this->render('updatepw', [
                        'model' => $model,
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['site/home']);
        }
    }

    public function actionCreate($template_id) {
        $user = User::findOne(['id' => Yii::$app->user->id]);
$status=0;
        if (User::userIsAllowedTo('Manage AWPB') && ($user->district_id != 0 || $user->district_id != '')) {
            $awpb_district =  \backend\models\AwpbDistrict::findOne(['awpb_template_id' =>$template_id, 'district_id'=>$user->district_id]);

if (!empty($awpb_district)) {
  $status= $awpb_district->status;
   
}
            $model = new AwpbBudget();
            if (Yii::$app->request->isAjax) {
                $model->load(Yii::$app->request->post());
                return Json::encode(\yii\widgets\ActiveForm::validate($model));
            }
            // if (Yii::$app->request->post('addComponent') != 'true' && $model->load(Yii::$app->request->post()) ) {
            // if ($model->load(Yii::$app->request->post())) {
            if ($model->load(Yii::$app->request->post())) {

                $_model = AwpbBudget::findOne(['awpb_template_id' => $model->awpb_template_id, 'activity_id' => $model->activity_id, 'camp_id' => $model->camp_id]);
                if (empty($_model)) {

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

                    //  $total_amt =  $model->unit_cost != 0 && $total_q != 0 ? $total_q * $model->unit_cost : 0;

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

                        //   $model->mo_1_amount  = $total_q_mo1 * $model->unit_cost;
                        // $model->mo_2_amount  = $total_q_mo2  * $model->unit_cost;
                        // $model->mo_3_amount  =  $total_q_mo3 * $model->unit_cost;
                        // $model->mo_4_amount  = $total_q_mo4   * $model->unit_cost;
                        // $model->mo_5_amount  = $total_q_mo5  * $model->unit_cost;
                        // $model->mo_6_amount  = $total_q_mo6   * $model->unit_cost;
                        // $model->mo_7_amount  = $total_q_mo7  * $model->unit_cost;
                        // $model->mo_8_amount  = $total_q_mo8   * $model->unit_cost;
                        // $model->mo_9_amount  = $total_q_mo9 * $model->unit_cost;
                        // $model->mo_10_amount  = $total_q_mo10   * $model->unit_cost;
                        // $model->mo_11_amount  = $total_q_mo11  * $model->unit_cost;
                        // $model->mo_12_amount  = $total_q_mo12 * $model->unit_cost;
                        // $model->quarter_one_amount = $total_q1 * $model->unit_cost;
                        // $model->quarter_two_amount = $total_q2 * $model->unit_cost;
                        // $model->quarter_three_amount = $total_q3 * $model->unit_cost;
                        // $model->quarter_four_amount = $total_q4 * $model->unit_cost;
                        // $model->total_amount = $total_amt;
                        $activity = new \backend\models\AwpbActivity();
                        $_activity = $activity::findOne(['id' => $model->activity_id]);

                        $model->awpb_template_id = $template_id;
                        $model->status = AwpbBudget::STATUS_DRAFT;
                        $model->name = $_activity->name;
                        $model->updated_by = Yii::$app->user->identity->id;
                        $model->created_by = Yii::$app->user->identity->id;
                        $model->district_id = $user->district_id;
                        $model->province_id = $user->province_id;
                        $number_of_non_women_headed_households = !empty($model->number_of_non_women_headed_households) ? $model->number_of_non_women_headed_households : 0;
                        $number_of_women_headed_households = !empty($model->number_of_women_headed_households) ? $model->number_of_women_headed_households : 0;
                        $model->number_of_household_members = $number_of_women_headed_households + $number_of_non_women_headed_households;

                        if ($model->validate()) {

                            if ($model->save()) {

                                $audit = new AuditTrail();
                                $audit->user = Yii::$app->user->id;
                                $audit->action = "Added AWPB  : " . $model->id;
                                $audit->ip_address = Yii::$app->request->getUserIP();
                                $audit->user_agent = Yii::$app->request->getUserAgent();
                                $audit->save();
                                Yii::$app->session->setFlash('success', 'AWPB  was successfully added.');
                                return $this->redirect(['view', 'id' => $model->id, 'status' => AwpbBudget::STATUS_DRAFT]);
                            } else {
                                Yii::$app->session->setFlash('error', 'Error occured while adding AWPB.');

                                $message = '';
                                foreach ($model->getErrors() as $error) {
                                    $message .= $error[0];
                                }
                                Yii::$app->session->setFlash('error', "Error occured while adding an AWPB " . $model->code . " details Please try again.Error:" . $message);

                                return $this->render('create', [
                                            'model' => $model,
                                            'template_id' => $template_id
                                ]);
                            }
                            return $this->redirect(['view', 'id' => $model->id, 'status' => AwpbBudget::STATUS_DRAFT]);
                            // return $this->render('create', [
                            //     'model' => $model,
                            //     'template_id' =>$template_id
                            // ]);
                        }
                    } else {
                        Yii::$app->session->setFlash('error', 'Enter quantity for at least one month.');
                    }
                } else {
                    Yii::$app->session->setFlash('error', 'An AWPB with this activity and camp has already added. Kindly proceed to update it.');
                    
                    return $this->redirect(['view', 'id' => $_model->id,'status'=>$status]);
                }
            }


            return $this->render('create', [
                        'model' => $model,
                        'template_id' => $template_id
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['site/home']);
        }
    }

    public function actionCreatepw($template_id) {
        $user = User::findOne(['id' => Yii::$app->user->id]);

        if (User::userIsAllowedTo('Manage AWPB') && ($user->district_id == 0 || $user->district_id == '')) {
            $model = new AwpbBudget_1();
            if (Yii::$app->request->isAjax) {
                $model->load(Yii::$app->request->post());
                return Json::encode(\yii\widgets\ActiveForm::validate($model));
            }
            // if (Yii::$app->request->post('addComponent') != 'true' && $model->load(Yii::$app->request->post()) ) {
            // if ($model->load(Yii::$app->request->post())) {
            if ($model->load(Yii::$app->request->post())) {

                $_model = AwpbBudget_1::findOne(['awpb_template_id' => $model->awpb_template_id, 'indicator_id' => $model->indicator_id, 'cost_centre_id' => $model->cost_centre_id]);
                if (empty($_model)) {

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

                    //  $total_amt =  $model->unit_cost != 0 && $total_q != 0 ? $total_q * $model->unit_cost : 0;

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

                        //   $model->mo_1_amount  = $total_q_mo1 * $model->unit_cost;
                        // $model->mo_2_amount  = $total_q_mo2  * $model->unit_cost;
                        // $model->mo_3_amount  =  $total_q_mo3 * $model->unit_cost;
                        // $model->mo_4_amount  = $total_q_mo4   * $model->unit_cost;
                        // $model->mo_5_amount  = $total_q_mo5  * $model->unit_cost;
                        // $model->mo_6_amount  = $total_q_mo6   * $model->unit_cost;
                        // $model->mo_7_amount  = $total_q_mo7  * $model->unit_cost;
                        // $model->mo_8_amount  = $total_q_mo8   * $model->unit_cost;
                        // $model->mo_9_amount  = $total_q_mo9 * $model->unit_cost;
                        // $model->mo_10_amount  = $total_q_mo10   * $model->unit_cost;
                        // $model->mo_11_amount  = $total_q_mo11  * $model->unit_cost;
                        // $model->mo_12_amount  = $total_q_mo12 * $model->unit_cost;
                        // $model->quarter_one_amount = $total_q1 * $model->unit_cost;
                        // $model->quarter_two_amount = $total_q2 * $model->unit_cost;
                        // $model->quarter_three_amount = $total_q3 * $model->unit_cost;
                        // $model->quarter_four_amount = $total_q4 * $model->unit_cost;
                        // $model->total_amount = $total_amt;
                        $indicator = new \backend\models\AwpbIndicator();
                        $_indicator = AwpbIndicator::findOne(['id' => $model->indicator_id]);
                        $_activity = AwpbActivity::findOne(['id' => $model->activity_id]);
                        $model->output_id = $_activity->output_id;
                        $model->indicator_id = $_activity->indicator_id;
                        $model->awpb_template_id = $template_id;
                        $model->status = AwpbBudget_1::STATUS_DRAFT;
                        $model->name = $_activity->name;
                        $model->updated_by = Yii::$app->user->identity->id;
                        $model->created_by = Yii::$app->user->identity->id;
                        $model->district_id = $user->district_id;
                        $model->province_id = $user->province_id;
                        $number_of_non_women_headed_households = !empty($model->number_of_non_women_headed_households) ? $model->number_of_non_women_headed_households : 0;
                        $number_of_women_headed_households = !empty($model->number_of_women_headed_households) ? $model->number_of_women_headed_households : 0;
                        $model->number_of_household_members = $number_of_women_headed_households + $number_of_non_women_headed_households;

                        if ($model->validate()) {

                            if ($model->save()) {

                                $audit = new AuditTrail();
                                $audit->user = Yii::$app->user->id;
                                $audit->action = "Added AWPB Indicator : " . $model->indicator_id;
                                $audit->ip_address = Yii::$app->request->getUserIP();
                                $audit->user_agent = Yii::$app->request->getUserAgent();
                                $audit->save();
                                Yii::$app->session->setFlash('success', 'AWPB indicator was successfully added.');
                                return $this->redirect(['viewpw', 'id' => $model->id, 'status' => AwpbBudget::STATUS_DRAFT]);
                            } else {
                                Yii::$app->session->setFlash('error', 'Error occured while adding AWPB indicator.');

                                $message = '';
                                foreach ($model->getErrors() as $error) {
                                    $message .= $error[0];
                                }
                                Yii::$app->session->setFlash('error', "Error occured while adding an indicator " . $model->code . " details Please try again.Error:" . $message);

                                return $this->render('createpw', [
                                            'model' => $model,
                                            'template_id' => $template_id
                                ]);
                            }
                            return $this->redirect(['viewpw', 'id' => $model->id, 'status' => AwpbBudget::STATUS_DRAFT]);
                            // return $this->render('create', [
                            //     'model' => $model,
                            //     'template_id' =>$template_id
                            // ]);
                        }
                    } else {
                        Yii::$app->session->setFlash('error', 'Enter quantity for at least one month.');
                    }
                } else {
                    Yii::$app->session->setFlash('error', 'A budget with this indicator and this camp has already added. Kindly proceed to update it.');
                    return $this->redirect(['viewpw', 'id' => $_model->id]);
                }
            }


            return $this->render('createpw', [
                        'model' => $model,
                        'template_id' => $template_id
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['site/home']);
        }
    }

    public function actionDelete($id, $id2, $status) {
        $model = $this->findModel($id);
        if (empty($model->total_amount)) {
            $this->findModel($id)->delete();

            return $this->redirect(['index', 'id' => $id2, 'status' => $status]);
        } else {
            Yii::$app->session->setFlash('error', 'You can not delete a plan which is linked to an input. Delete the input first.');
            return $this->redirect(['index', 'id' => $id2, 'status' => $status]);
        }
    }

    protected function findModel($id) {
        if (($model = AwpbBudget::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionSubmit($id, $id2, $status) {

        $user = User::findOne(['id' => Yii::$app->user->id]);

        if (User::userIsAllowedTo("Submit District AWPB") || User::userIsAllowedTo("Approve AWPB - Provincial") || User::userIsAllowedTo('Approve AWPB - PCO') || User::userIsAllowedTo('Approve AWPB - Ministry')) {
            $right = "";
            $returnpage = "";
            $activitylines = "";
            $subject = "";
            $province = "";
            $awpb_template = \backend\models\AwpbTemplate::findOne(['id' => $id]);
            $model = new AwpbBudget();
            $searchModel = new AwpbBudgetSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            $user = User::findOne(['id' => Yii::$app->user->id]);
            $pro = \backend\models\Provinces::findOne($id2);
            $status1 = 0;
            if (!empty($pro)) {
                $province = $pro->name;
            }
            if ($status == AwpbBudget::STATUS_SUBMITTED) { // && $user->district_id>0 ||$user->district_id!=='')
                $dataProvider->query->andFilterWhere(['awpb_template_id' => $id, 'district_id' => $id2, 'status' => AwpbBudget::STATUS_DRAFT,]);
                $activitylines = AwpbBudget::find()->where(['district_id' => $id2])->andWhere(['awpb_template_id' => $id])->andWhere(['status' => AwpbBudget::STATUS_DRAFT])->all();
                $returnpage = "index";
                $district = \backend\models\Districts::findOne($user->district_id)->name;
                $dear = "Dear Provincial Officer";
                $bodymsg = "We have submitted our";
                $bodymsg1 = " for your review and approval.";
                $subject = $awpb_template->fiscal_year . "AWPB for " . $district . "District";
                $loca = "district_id";
                $awpb_district = \backend\models\AwpbDistrict::findOne(['awpb_template_id' => $id, 'district_id' => $user->district_id]);

                $awpb_district->status = AwpbBudget::STATUS_SUBMITTED;
                $awpb_district->save();

                $awpb_province = \backend\models\AwpbProvince::findOne(['awpb_template_id' => $id, 'province_id' => $user->province_id]);
                $awpb_province->status = AwpbBudget::STATUS_SUBMITTED;
                $awpb_province->save();
            }

            if ($status == AwpbBudget::STATUS_REVIEWED) { //&& $user->province_id>0 ||$user->province_id!=='')
                $dataProvider->query->andFilterWhere(['awpb_template_id' => $id, 'district_id' => $user->district_id, 'status' => AwpbBudget::STATUS_SUBMITTED,]);
                $activitylines = AwpbBudget::find()->where(['province_id' => $user->province_id])->andWhere(['awpb_template_id' => $id])->andWhere(['status' => AwpbBudget::STATUS_SUBMITTED])->all();
                $returnpage = 'mpc';
                //$province = \backend\models\Provinces::findOne($id2)->name;
                $right = "Approve AWPB - PCO";
                $dear = "Dear PCO";
                $bodymsg = "We have submitted our";
                $bodymsg1 = " for your review and approval.";
                $subject = $awpb_template->fiscal_year . "AWPB for " . $province . " Province";
                $status1 = AwpbBudget:: STATUS_DRAFT;
                $loca = "province_id";
                $id2 = $user->province_id;
                $awpb_province = \backend\models\AwpbProvince::findOne(['awpb_template_id' => $id, 'province_id' => $user->province_id]);
                $awpb_province->status = AwpbBudget::STATUS_REVIEWED;
                $awpb_province->save();
            }
            if ($status == AwpbBudget::STATUS_APPROVED) { //&& $user->province_id==0 ||$user->province_id=='')
                $dataProvider->query->andFilterWhere(['awpb_template_id' => $id, 'province_id' => $id2, 'status' => AwpbBudget::STATUS_REVIEWED,]);
                $activitylines = AwpbBudget::find()->where(['province_id' => $id2])->andWhere(['awpb_template_id' => $id])->andWhere(['status' => AwpbBudget::STATUS_REVIEWED])->all();
                $returnpage = "mp";
                $right = "Approve AWPB - Ministry";
                $dear = "Dear Ministry";
                $bodymsg = "We have submitted the ";
                $bodymsg1 = " for your final review and approval.";
                $subject = $awpb_template->fiscal_year . " AWPB";
                $status1 = AwpbBudget:: STATUS_REVIEWED;
                $loca = "province_id";
                $awpb_province = \backend\models\AwpbProvince::findOne(['awpb_template_id' => $id, 'province_id' => $ids]);
                $awpb_province->status = AwpbBudget::STATUS_APPROVED;
                $awpb_province->save();
            }


            if ($status == AwpbBudget::STATUS_MINISTRY) { //&& $user->province_id==0 ||$user->province_id=='')
                $dataProvider->query->andFilterWhere(['awpb_template_id' => $id, 'province_id' => $id2, 'status' => AwpbBudget::STATUS_APPROVED,]);
                $activitylines = AwpbBudget::find()->where(['province_id' => $id2])->andWhere(['awpb_template_id' => $id])->andWhere(['status' => AwpbBudget::STATUS_APPROVED])->all();
                $returnpage = "mp";
                $right = "View AWPB";
                $dear = "Dear All";
                $bodymsg = "The";
                $bodymsg1 = " has been approved.";
                $subject = $province . " " . $awpb_template->fiscal_year . "AWPB";
                $status1 = AwpbBudget:: STATUS_APPROVED;
                $loca = "province_id";
                $awpb_province = \backend\models\AwpbProvince::findOne(['awpb_template_id' => $id, 'province_id' => $ids]);
                $awpb_province->status = AwpbBudget::STATUS_MINISTRY;
                $awpb_province->save();
            }

            // if (Yii::$app->request->isAjax) {
            //     $model->load(Yii::$app->request->post());
            //     return Json::encode(\yii\widgets\ActiveForm::validate($model));
            // }
            // if (!empty(Yii::$app->request->post())) {
            if (isset($activitylines)) {
                if ($activitylines != null) {
                    foreach ($activitylines as $activityline) {
                        $activityline->status = $status;
                        if ($activityline->validate()) {
                            $activityline->save();
                            $audit = new AuditTrail();
                            $audit->user = Yii::$app->user->id;
                            $audit->action = "Submitted " . $activityline->id . " : " . $activityline->name;
                            $audit->ip_address = Yii::$app->request->getUserIP();
                            $audit->user_agent = Yii::$app->request->getUserAgent();
                            $audit->save();
                        } else {
                            Yii::$app->session->setFlash('error', 'An error occurred while submitting the District AWPB.');
                            return $this->render($returnpage, [
                                        'searchModel' => $searchModel,
                                        'model' => $model,
                                        'dataProvider' => $dataProvider,
                                        'id' => $id
                            ]);
                        }
                    }

                    $role_model = \common\models\RightAllocation::find()->where(['right' => $right])->all();
                    if (!empty($role_model)) {

                        foreach ($role_model as $_role) {
                            //We now get all users with the fetched role
                            //  $resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/login']);

                            $_user_model = "";

                            $_user_model = User::find()
                                    ->where(['role' => $_role->role])
                                    ->andWhere([$loca => $id2])
                                    ->all();

                            if (!empty($_user_model)) {
                                //We send the emails

                                foreach ($_user_model as $_model) {
                                    $msg = "";
                                    $msg .= "<p>" . $dear . ",<br/><br/>";
                                    $msg .= $bodymsg . " " . $awpb_template->fiscal_year . " Annual Work Plan and Budget" . $bodymsg1 . "<br/><br/>";
                                    //  $msg .=  $model->description . "<br/><br/>";
                                    //  $msg .= "Story category:<b>" . \backend\models\LkmStoryofchangeCategory::findOne($model->category)->name . "</b><br/>";
                                    // $msg .= "Kindly address the issues and resubmit.<br/><br/>";
                                    // $msg .= "Interviewer:<b>" . $model->interviewer_names . "</b><br/>";
                                    $msg .= "Yours sincerely,<br/><br/></p>";
                                    $msg .= '<p>' . $user->title . ' ' . $user->first_name . ' ' . $user->last_name . '</p>';
                                    Storyofchange::sendEmail($msg, $subject, $_model->email);
                                }
                            }
                        }
                    }
                    if ($status == AwpbBudget::STATUS_APPROVED || $status == AwpbBudget::STATUS_MINISTRY) {
                        Yii::$app->session->setFlash('success', 'The AWPB has been submitted successfully.');
                        return $this->render('home/home', [
                                    'searchModel' => $searchModel,
                                    'model' => $model,
                                    'dataProvider' => $dataProvider,
                                    'id' => $id,
                                    'id2' => $id2,
                                    'status' => $status1,
                                    'editable' => 0
                        ]);
                    }
                    if ($status == AwpbBudget::STATUS_REVIEWED) {
                        Yii::$app->session->setFlash('success', 'The AWPB has been submitted successfully.');
                        return $this->render('mpc', [
                                    'searchModel' => $searchModel,
                                    'model' => $model,
                                    'dataProvider' => $dataProvider,
                                    'id' => $id,
                                    'id2' => $id2,
                                    'status' => $status1,
                                    'editable' => 0
                        ]);
                    }
                    if ($status == AwpbBudget::STATUS_SUBMITTED) {
                        Yii::$app->session->setFlash('success', 'The AWPB has been submitted successfully.');
                        return $this->render('index', [
                                    'searchModel' => $searchModel,
                                    'model' => $model,
                                    'dataProvider' => $dataProvider,
                                    'id' => $id,
                                    'id2' => $id2,
                                    'status' => $status1,
                                    'editable' => 0
                        ]);
                    }
                } else {
                    Yii::$app->session->setFlash('error', 'No AWPB to submit.');
                    return $this->render($returnpage, [
                                'searchModel' => $searchModel,
                                'model' => $model,
                                'dataProvider' => $dataProvider,
                                'id' => $id,
                                'id2' => $id2,
                                'status' => $status1,
                                'editable' => 0
                    ]);
                }
            }
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['site/home']);
        }
    }

    public function actionSubmitpw($id, $status) {
        $user = User::findOne(['id' => Yii::$app->user->id]);
        if (User::userIsAllowedTo('Submit programme-wide AWPB') || User::userIsAllowedTo('Approve AWPB - PCO') || User::userIsAllowedTo('Approve AWPB - Ministry')) {

            $returnpage = "";
            $right = "";
            $dear = "";
            $bodymsg = "";
            $bodymsg1 = "";
            $subject = "";
            $status1 = 0;

            $awpb_template = \backend\models\AwpbTemplate::findOne(['id' => $id]);
            $model = new AwpbBudget();
            $searchModel = new AwpbBudgetSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            $user = User::findOne(['id' => Yii::$app->user->id]);

            // $pro = \backend\models\Provinces::findOne($id2);
            // if (!empty($pro)) {
            //     $province =  $pro->name;
            // }
            // if ($status == AwpbBudget::STATUS_SUBMITTED) // && $user->district_id>0 ||$user->district_id!=='')
            // {
            //     $dataProvider->query->andFilterWhere(['awpb_template_id' => $id, 'district_id' => $id2, 'status' => AwpbBudget::STATUS_DRAFT,]);
            //     $activitylines = AwpbBudget::find()->where(['district_id' => $id2])->andWhere(['awpb_template_id' => $id])->andWhere(['status' => AwpbBudget::STATUS_DRAFT])->all();
            //     $returnpage = "index";
            //     $district = \backend\models\Districts::findOne($user->district_id)->name;
            //     $dear = "Dear Provincial Officer";
            //     $bodymsg = "We have submitted our";
            //     $bodymsg1 = " for your review and approval.";
            //     $subject = $awpb_template->fiscal_year . "AWPB for " . $district . "District";
            //     $loca = "district_id";
            // }

            if ($status == AwpbBudget::STATUS_REVIEWED) { //&& $user->province_id>0 ||$user->province_id!=='')
                $dataProvider->query->andFilterWhere(['awpb_template_id' => $id, 'provincial_id' => null, 'status' => AwpbBudget::STATUS_DRAFT]);
                $activitylines = AwpbBudget::find()->where(['province_id' => null])->andWhere(['awpb_template_id' => $id])->andWhere(['status' => AwpbBudget::STATUS_DRAFT])->all();
                $returnpage = 'indexpw';
                //$province = \backend\models\Provinces::findOne($id2)->name;
                $right = "Approve AWPB - PCO";
                $dear = "Dear PCO";
                $bodymsg = "We have submitted our";
                $bodymsg1 = " for your review and approval.";
                $subject = $awpb_template->fiscal_year . "PW AWPB";
                $status1 = AWPBActivityLine::STATUS_REVIEWED;
                // $loca = "province_id";
                //$id2 = $user->province_id;
            }
            if ($status == AwpbBudget::STATUS_APPROVED) { //&& $user->province_id==0 ||$user->province_id=='')
                $dataProvider->query->andFilterWhere(['awpb_template_id' => $id, 'province_id' => null, 'status' => AwpbBudget::STATUS_REVIEWED]);
                $activitylines = AwpbBudget::find()->where(['province_id' => null])->andWhere(['awpb_template_id' => $id])->andWhere(['status' => AwpbBudget::STATUS_REVIEWED])->all();
                $returnpage = "mpwpco";
                $right = "Approve AWPB - Ministry";
                $dear = "Dear Ministry";
                $bodymsg = "We have submitted the ";
                $bodymsg1 = " for your final review and approval.";
                $subject = $awpb_template->fiscal_year . " PW AWPB SUBMITTED FOR APPROVAL";
                $status1 = AWPBActivityLine::STATUS_APPROVED;
            }


            if ($status == AwpbBudget::STATUS_MINISTRY) { //&& $user->province_id==0 ||$user->province_id=='')
                $dataProvider->query->andFilterWhere(['awpb_template_id' => $id, 'province_id' => null, 'status' => AwpbBudget::STATUS_APPROVED,]);
                $activitylines = AwpbBudget::find()->where(['province_id' => null])->andWhere(['awpb_template_id' => $id])->andWhere(['status' => AwpbBudget::STATUS_APPROVED])->all();
                $returnpage = "mpwm";
                $right = "Approve AWPB - PCO";
                $dear = "Dear PCO";
                $bodymsg = "The";
                $bodymsg1 = " has been approved.";
                $subject = $awpb_template->fiscal_year . "PW AWPB APPROVED";
                $status1 = AWPBActivityLine::STATUS_MINISTRY;
            }

            // if (Yii::$app->request->isAjax) {
            //     $model->load(Yii::$app->request->post());
            //     return Json::encode(\yii\widgets\ActiveForm::validate($model));
            // }
            // if (!empty(Yii::$app->request->post())) {
            if (isset($activitylines)) {
                if ($activitylines != null) {
                    foreach ($activitylines as $activityline) {
                        $activityline->status = $status;
                        if ($activityline->validate()) {
                            $activityline->save();
                            $audit = new AuditTrail();
                            $audit->user = Yii::$app->user->id;
                            $audit->action = "Submitted " . $activityline->id . " : " . $activityline->name;
                            $audit->ip_address = Yii::$app->request->getUserIP();
                            $audit->user_agent = Yii::$app->request->getUserAgent();
                            $audit->save();
                        } else {
                            Yii::$app->session->setFlash('error', 'An error occurred while submitting the District AWPB.');
                            return $this->render($returnpage, [
                                        'searchModel' => $searchModel,
                                        'model' => $model,
                                        'dataProvider' => $dataProvider,
                                        'id' => $id
                            ]);
                        }
                    }

                    $role_model = \common\models\RightAllocation::find()->where(['right' => $right])->all();
                    if (!empty($role_model)) {
                        // $subject = "Case Study/Success Story review:" . $model->title;
                        foreach ($role_model as $_role) {
                            //We now get all users with the fetched role
                            //    $resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/login']);
                            $_user_model = User::find()
                                    ->where(['role' => $_role->role])
                                    ->all();
                            if (!empty($_user_model)) {
                                //We send the emails
                                foreach ($_user_model as $_model) {
                                    $msg = "";
                                    $msg .= "<p>" . $dear . ",<br/><br/>";
                                    $msg .= $bodymsg . " " . $awpb_template->fiscal_year . " Annual Work Plan and Budget" . $bodymsg1 . "<br/><br/>";
                                    //  $msg .=  $model->description . "<br/><br/>";
                                    //  $msg .= "Story category:<b>" . \backend\models\LkmStoryofchangeCategory::findOne($model->category)->name . "</b><br/>";
                                    // $msg .= "Kindly address the issues and resubmit.<br/><br/>";
                                    // $msg .= "Interviewer:<b>" . $model->interviewer_names . "</b><br/>";
                                    $msg .= "Yours sincerely,<br/><br/></p>";
                                    $msg .= '<p>' . $user->title . ' ' . $user->first_name . ' ' . $user->last_name . '</p>';
                                    Storyofchange::sendEmail($msg, $subject, $_model->email);
                                }
                            }
                        }
                    }
                    Yii::$app->session->setFlash('success', $status . 'The AWPB has been submitted successfully.');
                    return $this->render($returnpage, [
                                'searchModel' => $searchModel,
                                'model' => $model,
                                'dataProvider' => $dataProvider,
                                'id' => $id
                    ]);
                } else {
                    Yii::$app->session->setFlash('error', ' No Programme-Wide AWPB to submit.');
                    return $this->render($returnpage, [
                                'searchModel' => $searchModel,
                                'model' => $model,
                                'dataProvider' => $dataProvider,
                                'id' => $id
                    ]);
                }
            }
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['site/home']);
        }
    }

    public function actionDecline($status) {
        // public function actionDecline($district_id,$awpb_template_id) {
        //$district_id=48;
        // Yii::$app->session->setFlash('success', 'AWPB comment ' .$district.'was successfully added.');
        $model = new \backend\models\AwpbComment();
        $user = User::findOne(['id' => Yii::$app->user->id]);
        $activitylines = "";

        if (User::userIsAllowedTo('Approve AWPB - Provincial') && (($user->province_id != 0 || $user->province_id != ''))) {
            if (Yii::$app->request->isAjax) {
                $model->load(Yii::$app->request->post());
                return Json::encode(\yii\widgets\ActiveForm::validate($model));
            }

            if ($model->load(Yii::$app->request->post())) {

                $model->created_by = Yii::$app->user->identity->id;
                $model->updated_by = Yii::$app->user->identity->id;

                if ($model->save()) {


                    $activitylines = AwpbBudget::find()->where(['district_id' => $model->district_id])->andWhere(['awpb_template_id' => $model->awpb_template_id])->all();
                    //var_dump($activitylines);
                    if (isset($activitylines)) {
                        if ($activitylines != null) {
                            foreach ($activitylines as $activityline) {
                                $activityline->status = \Backend\models\AwpbBudget::STATUS_DRAFT;
                                if ($activityline->validate()) {
                                    $activityline->save();
                                } else {
                                    Yii::$app->session->setFlash('error', 'An error occurred while declining the District AWPB.');
                                    // return $this->render('mpc', ['id' => $model->awpb_template_id]);
                                }
                            }
                            $awpb_district = \backend\models\AwpbDistrict::findOne(['awpb_template_id' => $model->awpb_template_id, 'district_id' => $model->district_id]);

                            $awpb_district->status = \backend\models\AwpbBudget::STATUS_DRAFT;
                            $awpb_district->save();

                            $awpb_province = \backend\models\AwpbProvince::findOne(['awpb_template_id' => $model->awpb_template_id, 'province_id' => $model->province_id]);
                            $awpb_province->status = \Backend\models\AwpbBudget::STATUS_DRAFT;
                            $awpb_province->save();
                            $district = \backend\models\Districts::findOne($model->district_id)->name;

                            $audit = new AuditTrail();
                            $audit->user = Yii::$app->user->id;
                            $audit->action = "AWPB for " . $district . " declined";
                            $audit->ip_address = Yii::$app->request->getUserIP();
                            $audit->user_agent = Yii::$app->request->getUserAgent();
                            $audit->save();

                            //We send an email informing IKM Officers that a story has been submited for review
                            //We first get roles with the permission to review stories
                            $role_model = \common\models\RightAllocation::find()->where(['right' => 'Submit District AWPB'])->all();
                            if (!empty($role_model)) {
                                $subject = "AWPB for " . $district . " declined";
                                foreach ($role_model as $_role) {
                                    //We now get all users with the fetched role
                                    //  $resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/login']);
                                    $_user_model = User::find()
                                            ->where(['role' => $_role->role])
                                            ->andWhere(['district_id' => $model->district_id])
                                            ->all();
                                    if (!empty($_user_model)) {
                                        //We send the emails
                                        //     $user = User::findOne(['id' => Yii::$app->user->id]);
                                        foreach ($_user_model as $_model) {
                                            $msg = "";
                                            $msg .= "<p>Dear Budget Committee,<br/><br/>";
                                            $msg .= "Your budget has been declined due to the following:<br/><br/>";
                                            $msg .= $model->description . "<br/><br/>";
                                            //  $msg .= "Story category:<b>" . \backend\models\LkmStoryofchangeCategory::findOne($model->category)->name . "</b><br/>";
                                            $msg .= "Kindly address the issues and resubmit.<br/><br/>";
                                            // $msg .= "Interviewer:<b>" . $model->interviewer_names . "</b><br/>";
                                            $msg .= "Yours sincerely,<br/><br/></p>";
                                            $msg .= '<p>' . $user->title . ' ' . $user->first_name . ' ' . $user->last_name . '</p>';
                                            Storyofchange::sendEmail($msg, $subject, $_model->email);
                                        }
                                    }
                                }
                            }


                            Yii::$app->session->setFlash('success', $district . ' province AWPB was declined.');
                        }
                    }
                } else {
                    $message = "";
                    foreach ($model->getErrors() as $error) {
                        $message .= $error[0];
                    }
                    Yii::$app->session->setFlash('error', 'Error occured while adding AWPB comment::' . $message);
                }
            }
            $searchModel = new AwpbBudget();
            $query = $searchModel::find();

            $query->select(['awpb_template_id', 'province_id', 'district_id', 'SUM(quarter_one_amount) as quarter_one_amount', 'SUM(quarter_two_amount) as quarter_two_amount', 'SUM(quarter_three_amount) as quarter_three_amount', 'SUM(quarter_four_amount) as quarter_four_amount', 'SUM(total_amount) as total_amount']);
            $query->where(['awpb_template_id' => $model->awpb_template_id]);
            $query->andWhere(['=', 'status', \Backend\models\AwpbBudget::STATUS_SUBMITTED]);
            $query->andWhere(['=', 'province_id', $model->province_id]);
            $query->groupBy('district_id');
            $query->all();

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);

//             if ($dataProvider->getCount() <= 0 || $dataProvider->count <= 0) {
//                $editable = 0;
//                $_searchModel = new AwpbBudget();
//                $_query = $searchModel::find();
//                $_query->select(['awpb_template_id', 'province_id', 'district_id', 'SUM(quarter_one_amount) as quarter_one_amount', 'SUM(quarter_two_amount) as quarter_two_amount', 'SUM(quarter_three_amount) as quarter_three_amount', 'SUM(quarter_four_amount) as quarter_four_amount', 'SUM(total_amount) as total_amount']);
//                $_query->where(['=', 'awpb_template_id',$model->awpb_template_id]);
//                $_query->andWhere(['>=', 'status', $status]);
//                    $query->andWhere(['=', 'province_id', $model->province_id]);
//            $query->groupBy('district_id');
//            $query->all();
//                $_query->all();
//
//                $_dataProvider = new ActiveDataProvider([
//                    'query' => $_query,
//                ]);
//
//                return $this->render('mpc', [
//                            'searchModel' => $_searchModel,
//                            // 'model' => $model,
//                            'dataProvider' => $_dataProvider,
//                                    'district_id' => $model->district_id,
//                            'id2' => $model->province_id,
//                            'id' =>$model->awpb_template_id,
//                            'status' => $status,
//                            'editable' => 0
//                ]);
//            } else {
            return $this->render('mpc', [
                        'searchModel' => $searchModel,
                        'model' => $model,
                        'dataProvider' => $dataProvider,
                        'district_id' => $model->district_id,
                        'id2' => $model->province_id,
                        'id' => $model->awpb_template_id,
                        'status' => \Backend\models\AwpbBudget::STATUS_SUBMITTED,
                        'editable' => 1
            ]);
            // var_dump($model->district_id );
            //}
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            // return $this->redirect(['home/home']);
        }
    }

    public function actionDeclinepwpco($id, $id2) {
        // public function actionDecline($district_id,$awpb_template_id) {
        //$district_id=48;
        // Yii::$app->session->setFlash('success', 'AWPB comment ' .$district.'was successfully added.');
        $user = User::findOne(['id' => Yii::$app->user->id]);

        if (User::userIsAllowedTo('Approve AWBP - PCO') && $user->province_id == 0 || $user->province_id == '') {
            $model = new \backend\models\AwpbComment();

            $searchModel = new AwpbBudget();
            $query = $searchModel::find();
            $query->select(['awpb_template_id', 'activity_id', 'SUM(quarter_one_amount) as quarter_one_amount', 'SUM(quarter_two_amount) as quarter_two_amount', 'SUM(quarter_three_amount) as quarter_three_amount', 'SUM(quarter_four_amount) as quarter_four_amount', 'SUM(total_amount) as total_amount']);
            // $query->where(['awpb_template_id' => $model->awpb_template_id, 'province_id' => null, 'status' => AwpbBudget::STATUS_REVIEWED]);
            $query->where(['awpb_template_id' => $id2, 'activity_id' => $id, 'province_id' => null, 'status' => AwpbBudget::STATUS_REVIEWED]);

            //  $query->where('province_id = :field1', [':field1' =>$user->province_id]);
            $query->groupBy('activity_id');
            $query->all();

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);

            if (Yii::$app->request->isAjax) {
                $model->load(Yii::$app->request->post());
                return Json::encode(\yii\widgets\ActiveForm::validate($model));
            }

            if ($model->load(Yii::$app->request->post())) {

                $model->created_by = Yii::$app->user->identity->id;
                $model->updated_by = Yii::$app->user->identity->id;

                if ($model->save()) {

                    $activitylines = AwpbBudget::find()->where(['awpb_template_id' => $id2])->andWhere(['activity_id' => $id])->andWhere(['province_id' => null])->andWhere(['status' => AWPBActivityLine::STATUS_REVIEWED])->all();

                    if (isset($activitylines)) {
                        if ($activitylines != null) {
                            foreach ($activitylines as $activityline) {
                                $activityline->status = AWPBActivityLine::STATUS_DRAFT;
                                if ($activityline->validate()) {
                                    $activityline->save();
                                    $audit = new AuditTrail();
                                    $audit->user = Yii::$app->user->id;
                                    $audit->action = "Declined budget line " . $activityline->id . " : " . $activityline->name;
                                    $audit->ip_address = Yii::$app->request->getUserIP();
                                    $audit->user_agent = Yii::$app->request->getUserAgent();
                                    $audit->save();
                                } else {
                                    Yii::$app->session->setFlash('error', 'An error occurred while declining the District AWPB.');
                                    return $this->render('mpwpco', ['id' => $model->awpb_template_id]);
                                }
                            }

                            //   $district = \backend\models\Districts::findOne($model->district_id)->name;

                            $audit = new AuditTrail();
                            $audit->user = Yii::$app->user->id;
                            //   $audit->action = "Added AWPB Commen for ".$district;
                            $audit->ip_address = Yii::$app->request->getUserIP();
                            $audit->user_agent = Yii::$app->request->getUserAgent();
                            $audit->save();

                            //We send an email informing IKM Officers that a story has been submited for review
                            //We first get roles with the permission to review stories
                            $role_model = \common\models\RightAllocation::find()->where(['right' => 'Manage programme-wide AWPB activity lines'])->all();
                            if (!empty($role_model)) {
                                $subject = "Programme-Wide AWPB declined";
                                foreach ($role_model as $_role) {
                                    //We now get all users with the fetched role
                                    //  $resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/login']);
                                    $_user_model = User::find()
                                            ->where(['role' => $_role->role])
                                            // ->andWhere(['district_id' => $model->district_id])
                                            ->all();
                                    if (!empty($_user_model)) {
                                        //We send the emails
                                        //     $user = User::findOne(['id' => Yii::$app->user->id]);
                                        foreach ($_user_model as $_model) {
                                            $msg = "";
                                            $msg .= "<p>Dear Budget Committee,<br/><br/>";
                                            $msg .= "Your budget has been declined due to the following:<br/><br/>";
                                            $msg .= $model->description . "<br/><br/>";
                                            //  $msg .= "Story category:<b>" . \backend\models\LkmStoryofchangeCategory::findOne($model->category)->name . "</b><br/>";
                                            $msg .= "Kindly address the issues and resubmit.<br/><br/>";
                                            // $msg .= "Interviewer:<b>" . $model->interviewer_names . "</b><br/>";
                                            $msg .= "Yours sincerely,<br/><br/></p>";
                                            $msg .= '<p>' . $user->title . ' ' . $user->first_name . ' ' . $user->last_name . '</p>';
                                            Storyofchange::sendEmail($msg, $subject, $_model->email);
                                        }
                                    }
                                }
                            }


                            Yii::$app->session->setFlash('success', 'Programme-Wide AWPB was declined.');

                            return $this->redirect(['mpwpco', 'id' => $model->awpb_template_id]);
                        }

                        return $this->render('mpwpco', [
                                    'searchModel' => $searchModel,
                                    // 'model' => $model,
                                    'dataProvider' => $dataProvider,
                                    'show_results' => 1,
                                    'id' => $model->awpb_template_id
                        ]);
                    }
                    return $this->render('mpwpco', [
                                'searchModel' => $searchModel,
                                // 'model' => $model,
                                'dataProvider' => $dataProvider,
                                'show_results' => 1,
                                'id' => $model->awpb_template_id
                    ]);
                } else {
                    $message = "";
                    foreach ($model->getErrors() as $error) {
                        $message .= $error[0];
                    }
                    Yii::$app->session->setFlash('error', 'Error occured while adding AWPB comment::' . $message);
                    //  return $this->redirect(['home/home']);




                    return $this->render('mpwpco', [
                                'searchModel' => $searchModel,
                                // 'model' => $model,
                                'dataProvider' => $dataProvider,
                                'show_results' => 1,
                                'id' => $model->awpb_template_id
                    ]);
                }
            }
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    public function actionDeclinep() {
        // public function actionDecline($district_id,$awpb_template_id) {
        //$district_id=48;
        // Yii::$app->session->setFlash('success', 'AWPB comment ' .$district.'was successfully added.');
        $user = User::findOne(['id' => Yii::$app->user->id]);
        if (User::userIsAllowedTo('Approve AWBP - PCO') && $user->province_id == 0 || $user->province_id == '') {
            $model = new \backend\models\AwpbComment();

            $status = AwpbBudget::STATUS_SUBMITTED;
            $searchModel = new AwpbBudget();
            $query = $searchModel::find();
            $dear = "";

            $query->select(['awpb_template_id', 'province_id', 'district_id', 'SUM(quarter_one_amount) as quarter_one_amount', 'SUM(quarter_two_amount) as quarter_two_amount', 'SUM(quarter_three_amount) as quarter_three_amount', 'SUM(quarter_four_amount) as quarter_four_amount', 'SUM(total_amount) as total_amount']);
            $query->where(['province_id' => $model->province_id, 'awpb_template_id' => $model->awpb_template_id, 'status' => AwpbBudget::STATUS_REVIEWED]);
            $status = AwpbBudget::STATUS_SUBMITTED;
            $dear .= "<p>Dear Budget Committee,<br/><br/>";

            // elseif(User::userIsAllowedTo('Approve AWBP - Ministry'))
            // {
            //     $query->select(['awpb_template_id','province_id','district_id','SUM(quarter_one_amount) as quarter_one_amount','SUM(quarter_two_amount) as quarter_two_amount','SUM(quarter_three_amount) as quarter_three_amount','SUM(quarter_four_amount) as quarter_four_amount','SUM(total_amount) as total_amount']);
            //     $query->where(['province_id'=>$model->province_id, 'awpb_template_id' =>$model->awpb_template_id,'status' => AwpbBudget::STATUS_APPROVED]);
            //     $status=AWPBActivityLine::STATUS_REVIEWED;
            //     $dear .= "<p>Dear ESAPP,<br/><br/>";
            // }
            //  $query->where('province_id = :field1', [':field1' =>$user->province_id]);
            // $query->groupBy('district_id');
            $query->all();

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);

            if (Yii::$app->request->isAjax) {
                $model->load(Yii::$app->request->post());
                return Json::encode(\yii\widgets\ActiveForm::validate($model));
            }

            if ($model->load(Yii::$app->request->post())) {

                $model->created_by = Yii::$app->user->identity->id;
                $model->updated_by = Yii::$app->user->identity->id;

                if ($model->save()) {
                    $province = "";
                    $pro = \backend\models\Provinces::findOne(['id' => $model->province_id]);

                    if (!empty($pro)) {
                        $province = $pro->name;
                    }

                    $activitylines = AwpbBudget::find()->where(['province_id' => $model->province_id])->andWhere(['awpb_template_id' => $model->awpb_template_id])->andWhere(['status' => AwpbBudget::STATUS_REVIEWED])->all();

                    if (isset($activitylines)) {
                        if ($activitylines != null) {
                            foreach ($activitylines as $activityline) {
                                $activityline->status = $status;
                                if ($activityline->validate()) {
                                    $activityline->save();
                                    $audit = new AuditTrail();
                                    $audit->user = Yii::$app->user->id;
                                    $audit->action = "Decline budget line " . $activityline->id . " : " . $activityline->name;
                                    $audit->ip_address = Yii::$app->request->getUserIP();
                                    $audit->user_agent = Yii::$app->request->getUserAgent();
                                    $audit->save();
                                } else {
                                    Yii::$app->session->setFlash('error', 'An error occurred while declining the District AWPB.');
                                    return $this->render('mpco', [
                                                'searchModel' => $searchModel,
                                                // 'model' => $model,
                                                'dataProvider' => $dataProvider,
                                                'show_results' => 1,
                                                'id' => $model->awpb_template_id
                                    ]);
                                }
                            }


                            $audit = new AuditTrail();
                            $audit->user = Yii::$app->user->id;
                            //   $audit->action = "Added AWPB Commen for ".$district;
                            $audit->ip_address = Yii::$app->request->getUserIP();
                            $audit->user_agent = Yii::$app->request->getUserAgent();
                            $audit->save();
                            Yii::$app->session->setFlash('success', $province . ' province AWPB was declined.');

                            //We send an email informing IKM Officers that a story has been submited for review
                            //We first get roles with the permission to review stories
                            $role_model = \common\models\RightAllocation::find()->where(['right' => 'Approve AWPB - Provincial'])->all();
                            if (!empty($role_model)) {
                                $subject = $province . " province AWPB declined";
                                foreach ($role_model as $_role) {
                                    //We now get all users with the fetched role
                                    //  $resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/login']);
                                    $_user_model = User::find()
                                            ->where(['role' => $_role->role])
                                            ->andWhere(['province_id' => $model->province_id])
                                            ->all();
                                    if (!empty($_user_model)) {
                                        //We send the emails
                                        //     $user = User::findOne(['id' => Yii::$app->user->id]);
                                        foreach ($_user_model as $_model) {
                                            $msg = "";
                                            $msg .= $dear;
                                            $msg .= "Your budget has been declined due to the following:<br/><br/>";
                                            $msg .= $model->description . "<br/><br/>";
                                            //  $msg .= "Story category:<b>" . \backend\models\LkmStoryofchangeCategory::findOne($model->category)->name . "</b><br/>";
                                            $msg .= "Kindly address the issues and resubmit.<br/><br/>";
                                            // $msg .= "Interviewer:<b>" . $model->interviewer_names . "</b><br/>";
                                            $msg .= "Yours sincerely,<br/><br/></p>";
                                            $msg .= '<p>' . $user->title . ' ' . $user->first_name . ' ' . $user->last_name . '</p>';
                                            Storyofchange::sendEmail($msg, $subject, $_model->email);
                                        }
                                    }
                                }
                            }


                            return $this->render('mp', [
                                        'searchModel' => $searchModel,
                                        // 'model' => $model,
                                        'dataProvider' => $dataProvider,
                                        'show_results' => 1,
                                        'id' => $model->awpb_template_id
                            ]);
                        }

                        return $this->render('mp', [
                                    'searchModel' => $searchModel,
                                    // 'model' => $model,
                                    'dataProvider' => $dataProvider,
                                    'show_results' => 1,
                                    'id' => $model->awpb_template_id
                        ]);
                    }
                    return $this->render('mp', [
                                'searchModel' => $searchModel,
                                // 'model' => $model,
                                'dataProvider' => $dataProvider,
                                'show_results' => 1,
                                'id' => $model->awpb_template_id
                    ]);
                } else {
                    $message = "";
                    foreach ($model->getErrors() as $error) {
                        $message .= $error[0];
                    }
                    Yii::$app->session->setFlash('error', 'Error occured while adding AWPB comment::' . $message);
                    //  return $this->redirect(['home/home']);



                    return $this->render('mpco', [
                                'searchModel' => $searchModel,
                                // 'model' => $model,
                                'dataProvider' => $dataProvider,
                                'show_results' => 1,
                                'id' => $model->awpb_template_id
                    ]);
                }
            }
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    public function actionDeclinem() {
        // public function actionDecline($district_id,$awpb_template_id) {
        //$district_id=48;
        // Yii::$app->session->setFlash('success', 'AWPB comment ' .$district.'was successfully added.');
        $user = User::findOne(['id' => Yii::$app->user->id]);
        if (User::userIsAllowedTo('Approve AWBP - Ministry') && $user->province_id == 0 || $user->province_id == '') {
            $model = new \backend\models\AwpbComment();

            $searchModel = new AwpbBudget();
            $query = $searchModel::find();
            $dear = "";

            $query->select(['awpb_template_id', 'province_id', 'district_id', 'SUM(quarter_one_amount) as quarter_one_amount', 'SUM(quarter_two_amount) as quarter_two_amount', 'SUM(quarter_three_amount) as quarter_three_amount', 'SUM(quarter_four_amount) as quarter_four_amount', 'SUM(total_amount) as total_amount']);
            $query->where(['province_id' => $model->province_id, 'awpb_template_id' => $model->awpb_template_id, 'status' => AwpbBudget::STATUS_APPROVED]);
            // $status=AWPBActivityLine::STATUS_APPROVED;
            $dear .= "<p>Dear Budget Committee,<br/><br/>";

            // elseif(User::userIsAllowedTo('Approve AWBP - Ministry'))
            // {
            //     $query->select(['awpb_template_id','province_id','district_id','SUM(quarter_one_amount) as quarter_one_amount','SUM(quarter_two_amount) as quarter_two_amount','SUM(quarter_three_amount) as quarter_three_amount','SUM(quarter_four_amount) as quarter_four_amount','SUM(total_amount) as total_amount']);
            //     $query->where(['province_id'=>$model->province_id, 'awpb_template_id' =>$model->awpb_template_id,'status' => AwpbBudget::STATUS_APPROVED]);
            //     $status=AWPBActivityLine::STATUS_REVIEWED;
            //     $dear .= "<p>Dear ESAPP,<br/><br/>";
            // }
            //  $query->where('province_id = :field1', [':field1' =>$user->province_id]);
            // $query->groupBy('district_id');
            $query->all();

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);

            if (Yii::$app->request->isAjax) {
                $model->load(Yii::$app->request->post());
                return Json::encode(\yii\widgets\ActiveForm::validate($model));
            }

            if ($model->load(Yii::$app->request->post())) {

                $model->created_by = Yii::$app->user->identity->id;
                $model->updated_by = Yii::$app->user->identity->id;

                if ($model->save()) {
                    $province = "";
                    $pro = \backend\models\Provinces::findOne(['id' => $model->province_id]);

                    if (!empty($pro)) {
                        $province = $pro->name;
                    }

                    $activitylines = AwpbBudget::find()->where(['province_id' => $model->province_id])->andWhere(['awpb_template_id' => $model->awpb_template_id])->andWhere(['status' => AWPBActivityLine::STATUS_APPROVED])->all();

                    if (isset($activitylines)) {
                        if ($activitylines != null) {
                            foreach ($activitylines as $activityline) {
                                $activityline->status = AWPBActivityLine::STATUS_REVIEWED;
                                if ($activityline->validate()) {
                                    $activityline->save();
                                    $audit = new AuditTrail();
                                    $audit->user = Yii::$app->user->id;
                                    $audit->action = "Decline budget line " . $activityline->id . " : " . $activityline->name;
                                    $audit->ip_address = Yii::$app->request->getUserIP();
                                    $audit->user_agent = Yii::$app->request->getUserAgent();
                                    $audit->save();
                                } else {
                                    Yii::$app->session->setFlash('error', 'An error occurred while declining the District AWPB.');
                                    return $this->render('mpco', [
                                                'searchModel' => $searchModel,
                                                // 'model' => $model,
                                                'dataProvider' => $dataProvider,
                                                'show_results' => 1,
                                                'id' => $model->awpb_template_id
                                    ]);
                                }
                            }


                            $audit = new AuditTrail();
                            $audit->user = Yii::$app->user->id;
                            //   $audit->action = "Added AWPB Commen for ".$district;
                            $audit->ip_address = Yii::$app->request->getUserIP();
                            $audit->user_agent = Yii::$app->request->getUserAgent();
                            $audit->save();
                            Yii::$app->session->setFlash('success', $province . ' province AWPB was declined.');

                            //We send an email informing IKM Officers that a story has been submited for review
                            //We first get roles with the permission to review stories
                            $role_model = \common\models\RightAllocation::find()->where(['right' => 'Approve AWPB - PCO'])->all();
                            if (!empty($role_model)) {
                                $subject = $province . " province AWPB declined";
                                foreach ($role_model as $_role) {
                                    //We now get all users with the fetched role
                                    //  $resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/login']);
                                    $_user_model = User::find()
                                            ->where(['role' => $_role->role])
                                            ->andWhere(['province_id' => $model->province_id])
                                            ->all();
                                    if (!empty($_user_model)) {
                                        //We send the emails
                                        //     $user = User::findOne(['id' => Yii::$app->user->id]);
                                        foreach ($_user_model as $_model) {
                                            $msg = "";
                                            $msg .= $dear;
                                            $msg .= "Your budget has been declined due to the following:<br/><br/>";
                                            $msg .= $model->description . "<br/><br/>";
                                            //  $msg .= "Story category:<b>" . \backend\models\LkmStoryofchangeCategory::findOne($model->category)->name . "</b><br/>";
                                            $msg .= "Kindly address the issues and resubmit.<br/><br/>";
                                            // $msg .= "Interviewer:<b>" . $model->interviewer_names . "</b><br/>";
                                            $msg .= "Yours sincerely,<br/><br/></p>";
                                            $msg .= '<p>' . $user->title . ' ' . $user->first_name . ' ' . $user->last_name . '</p>';
                                            Storyofchange::sendEmail($msg, $subject, $_model->email);
                                        }
                                    }
                                }
                            }


                            return $this->render('mpcm', [
                                        'searchModel' => $searchModel,
                                        // 'model' => $model,
                                        'dataProvider' => $dataProvider,
                                        'show_results' => 1,
                                        'id' => $model->awpb_template_id
                            ]);
                        }

                        return $this->render('mpcm', [
                                    'searchModel' => $searchModel,
                                    // 'model' => $model,
                                    'dataProvider' => $dataProvider,
                                    'show_results' => 1,
                                    'id' => $model->awpb_template_id
                        ]);
                    }
                    return $this->render('mpcm', [
                                'searchModel' => $searchModel,
                                // 'model' => $model,
                                'dataProvider' => $dataProvider,
                                'show_results' => 1,
                                'id' => $model->awpb_template_id
                    ]);
                } else {
                    $message = "";
                    foreach ($model->getErrors() as $error) {
                        $message .= $error[0];
                    }
                    Yii::$app->session->setFlash('error', 'Error occured while adding AWPB comment::' . $message);
                    //  return $this->redirect(['home/home']);



                    return $this->render('mpcm', [
                                'searchModel' => $searchModel,
                                // 'model' => $model,
                                'dataProvider' => $dataProvider,
                                'show_results' => 1,
                                'id' => $model->awpb_template_id
                    ]);
                }
            }
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    public function actionDeclinepwm() {
        // public function actionDecline($district_id,$awpb_template_id) {
        //$district_id=48;
        // Yii::$app->session->setFlash('success', 'AWPB comment ' .$district.'was successfully added.');
        $user = User::findOne(['id' => Yii::$app->user->id]);
        if (User::userIsAllowedTo('Approve AWBP - Ministry') && $user->province_id == 0 || $user->province_id == '') {
            $model = new \backend\models\AwpbComment();

            $searchModel = new AwpbBudget();
            $query = $searchModel::find();
            $dear = "";

            $query->select(['awpb_template_id', 'activity_id', 'SUM(quarter_one_amount) as quarter_one_amount', 'SUM(quarter_two_amount) as quarter_two_amount', 'SUM(quarter_three_amount) as quarter_three_amount', 'SUM(quarter_four_amount) as quarter_four_amount', 'SUM(total_amount) as total_amount']);
            $query->where(['awpb_template_id' => $model->awpb_template_id, 'province_id' => null, 'status' => AwpbBudget::STATUS_APPROVED]);
            // $status=AWPBActivityLine::STATUS_APPROVED;
            $dear .= "<p>Dear Budget Committee,<br/><br/>";

            // elseif(User::userIsAllowedTo('Approve AWBP - Ministry'))
            // {
            //     $query->select(['awpb_template_id','province_id','district_id','SUM(quarter_one_amount) as quarter_one_amount','SUM(quarter_two_amount) as quarter_two_amount','SUM(quarter_three_amount) as quarter_three_amount','SUM(quarter_four_amount) as quarter_four_amount','SUM(total_amount) as total_amount']);
            //     $query->where(['province_id'=>$model->province_id, 'awpb_template_id' =>$model->awpb_template_id,'status' => AwpbBudget::STATUS_APPROVED]);
            //     $status=AWPBActivityLine::STATUS_REVIEWED;
            //     $dear .= "<p>Dear ESAPP,<br/><br/>";
            // }
            //  $query->where('province_id = :field1', [':field1' =>$user->province_id]);
            // $query->groupBy('district_id');
            $query->all();

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);

            if (Yii::$app->request->isAjax) {
                $model->load(Yii::$app->request->post());
                return Json::encode(\yii\widgets\ActiveForm::validate($model));
            }

            if ($model->load(Yii::$app->request->post())) {

                $model->created_by = Yii::$app->user->identity->id;
                $model->updated_by = Yii::$app->user->identity->id;

                if ($model->save()) {


                    $activitylines = AwpbBudget::find()->where(['awpb_template_id' => $model->awpb_template_id])->andWhere(['province_id' => null])->andWhere(['status' => AWPBActivityLine::STATUS_APPROVED])->all();

                    if (isset($activitylines)) {
                        if ($activitylines != null) {
                            foreach ($activitylines as $activityline) {
                                $activityline->status = AWPBActivityLine::STATUS_REVIEWED;
                                if ($activityline->validate()) {
                                    $activityline->save();
                                    $audit = new AuditTrail();
                                    $audit->user = Yii::$app->user->id;
                                    $audit->action = "Decline budget line " . $activityline->id . " : " . $activityline->name;
                                    $audit->ip_address = Yii::$app->request->getUserIP();
                                    $audit->user_agent = Yii::$app->request->getUserAgent();
                                    $audit->save();
                                } else {
                                    Yii::$app->session->setFlash('error', 'An error occurred while declining the Programme-Wide AWPB.');
                                    return $this->render('mpco', [
                                                'searchModel' => $searchModel,
                                                // 'model' => $model,
                                                'dataProvider' => $dataProvider,
                                                'show_results' => 1,
                                                'id' => $model->awpb_template_id
                                    ]);
                                }
                            }


                            $audit = new AuditTrail();
                            $audit->user = Yii::$app->user->id;
                            //   $audit->action = "Added AWPB Commen for ".$district;
                            $audit->ip_address = Yii::$app->request->getUserIP();
                            $audit->user_agent = Yii::$app->request->getUserAgent();
                            $audit->save();
                            Yii::$app->session->setFlash('success', 'Programme-Wide AWPB was declined.');

                            //We send an email informing IKM Officers that a story has been submited for review
                            //We first get roles with the permission to review stories
                            $role_model = \common\models\RightAllocation::find()->where(['right' => 'Approve AWPB - PCO'])->all();
                            if (!empty($role_model)) {
                                $subject = "Programme-Wide AWPB declined";
                                foreach ($role_model as $_role) {
                                    //We now get all users with the fetched role
                                    //  $resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/login']);
                                    $_user_model = User::find()
                                            ->where(['role' => $_role->role])
                                            ->all();
                                    if (!empty($_user_model)) {
                                        //We send the emails
                                        //     $user = User::findOne(['id' => Yii::$app->user->id]);
                                        foreach ($_user_model as $_model) {
                                            $msg = "";
                                            $msg .= $dear;
                                            $msg .= "Your budget has been declined due to the following:<br/><br/>";
                                            $msg .= $model->description . "<br/><br/>";
                                            //  $msg .= "Story category:<b>" . \backend\models\LkmStoryofchangeCategory::findOne($model->category)->name . "</b><br/>";
                                            $msg .= "Kindly address the issues and resubmit.<br/><br/>";
                                            // $msg .= "Interviewer:<b>" . $model->interviewer_names . "</b><br/>";
                                            $msg .= "Yours sincerely,<br/><br/></p>";
                                            $msg .= '<p>' . $user->title . ' ' . $user->first_name . ' ' . $user->last_name . '</p>';
                                            Storyofchange::sendEmail($msg, $subject, $_model->email);
                                        }
                                    }
                                }
                            }


                            return $this->render('mpwm', [
                                        'searchModel' => $searchModel,
                                        // 'model' => $model,
                                        'dataProvider' => $dataProvider,
                                        'show_results' => 1,
                                        'id' => $model->awpb_template_id
                            ]);
                        }

                        return $this->render('mpwm', [
                                    'searchModel' => $searchModel,
                                    // 'model' => $model,
                                    'dataProvider' => $dataProvider,
                                    'show_results' => 1,
                                    'id' => $model->awpb_template_id
                        ]);
                    }
                    return $this->render('mpwm', [
                                'searchModel' => $searchModel,
                                // 'model' => $model,
                                'dataProvider' => $dataProvider,
                                'show_results' => 1,
                                'id' => $model->awpb_template_id
                    ]);
                } else {
                    $message = "";
                    foreach ($model->getErrors() as $error) {
                        $message .= $error[0];
                    }
                    Yii::$app->session->setFlash('error', 'Error occured while adding AWPB comment::' . $message);
                    //  return $this->redirect(['home/home']);



                    return $this->render('mpwm', [
                                'searchModel' => $searchModel,
                                // 'model' => $model,
                                'dataProvider' => $dataProvider,
                                'show_results' => 1,
                                'id' => $model->awpb_template_id
                    ]);
                }
            }
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    public function actionMpcdoa($district_id, $province_id, $awpb_template_id, $status, $output_id, $activity_id) {
        if (User::userIsAllowedTo('Approve AWPB - Provincial') || User::userIsAllowedTo('Approve AWPB - PCO') || User::userIsAllowedTo('Approve AWPB - Ministry')) {
            $user = User::findOne(['id' => Yii::$app->user->id]);
            $searchModel = new AwpbBudgetSearch();
            $model = new AwpbBudget();
            $query = $searchModel::find();
            $query->select(['awpb_template_id', 'province_id', 'district_id', 'output_id', 'province_id', 'district_id', 'activity_id', 'indicator_id', 'id', 'SUM(quarter_one_amount) as quarter_one_amount', 'SUM(quarter_two_amount) as quarter_two_amount', 'SUM(quarter_three_amount) as quarter_three_amount', 'SUM(quarter_four_amount) as quarter_four_amount', 'SUM(total_amount) as total_amount']);
            $query->where(['awpb_template_id' => $awpb_template_id]);
            $query->andWhere(['>=', 'status', $status]);
            $query->andWhere(['=', 'district_id', $district_id]);
            $query->andWhere(['=', 'output_id', $output_id]);
            $query->andWhere(['=', 'activity_id', $activity_id]);
            $query->groupBy('indicator_id');
            $query->all();

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);

            return $this->render('mpcdoa', [
                        'searchModel' => $searchModel,
                        'model' => $model,
                        'dataProvider' => $dataProvider,
                        'district_id' => $district_id,
                        'province_id' => $province_id,
                        'awpb_template_id' => $awpb_template_id,
                        'status' => $status,
                        'output_id' => $output_id,
                        'activity_id' => $activity_id
            ]);

            if ($dataProvider->getCount() <= 0 || $dataProvider->count <= 0) {
                $editable = 0;
                $_searchModel = new AwpbBudget();
                $_query = $searchModel::find();
                $_query->select(['awpb_template_id', 'province_id', 'district_id', 'output_id', 'province_id', 'district_id', 'activity_id', 'indicator_id', 'id', 'SUM(quarter_one_amount) as quarter_one_amount', 'SUM(quarter_two_amount) as quarter_two_amount', 'SUM(quarter_three_amount) as quarter_three_amount', 'SUM(quarter_four_amount) as quarter_four_amount', 'SUM(total_amount) as total_amount']);
                $_query->where(['awpb_template_id' => $awpb_template_id]);
                $_query->andWhere(['>=', 'status', $status]);
                $_query->andWhere(['=', 'district_id', $district_id]);
                $_query->andWhere(['=', 'output_id', $output_id]);
                $_query->andWhere(['=', 'activity_id', $activity_id]);
                $_query->groupBy('indicator_id');
                $_query->all();

                $_dataProvider = new ActiveDataProvider([
                    'query' => $_query,
                ]);

                return $this->render('mpcdoa', [
                            'searchModel' => $_searchModel,
                            'model' => $model,
                            'dataProvider' => $_dataProvider,
                            'district_id' => $district_id,
                            'province_id' => $province_id,
                            'awpb_template_id' => $awpb_template_id,
                            'status' => $status,
                            'output_id' => $output_id,
                            'activity_id' => $activity_id,
                            'editable' => 0
                ]);
            } else {
                return $this->render('mpcdoa', [
                            'searchModel' => $searchModel,
                            'model' => $model,
                            'dataProvider' => $dataProvider,
                            'district_id' => $district_id,
                            'province_id' => $province_id,
                            'awpb_template_id' => $awpb_template_id,
                            'status' => $status,
                            'output_id' => $output_id,
                            'activity_id' => $activity_id,
                            'editable' => 1
                ]);
            }
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    public function actionMpcdo($district_id, $province_id, $awpb_template_id, $status, $output_id) {
        if (User::userIsAllowedTo('Approve AWPB - Provincial') || User::userIsAllowedTo('Approve AWPB - PCO') || User::userIsAllowedTo('Approve AWPB - Ministry')) {
            $user = User::findOne(['id' => Yii::$app->user->id]);
            $searchModel = new AwpbBudgetSearch();
            $model = new AwpbBudget();
            $query = $searchModel::find();
            $query->select(['awpb_template_id', 'province_id', 'district_id', 'output_id', 'province_id', 'district_id', 'activity_id', 'SUM(quarter_one_amount) as quarter_one_amount', 'SUM(quarter_two_amount) as quarter_two_amount', 'SUM(quarter_three_amount) as quarter_three_amount', 'SUM(quarter_four_amount) as quarter_four_amount', 'SUM(total_amount) as total_amount']);
            $query->where(['awpb_template_id' => $awpb_template_id]);
            $query->andWhere(['=', 'status', $status]);
            $query->andWhere(['=', 'district_id', $district_id]);
            $query->andWhere(['=', 'output_id', $output_id]);
            $query->groupBy('activity_id');
            $query->all();

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);

            if ($dataProvider->getCount() <= 0 || $dataProvider->count <= 0) {
                $editable = 0;
                $_searchModel = new AwpbBudget();
                $_query = $searchModel::find();
                $_query->select(['awpb_template_id', 'province_id', 'district_id', 'output_id', 'province_id', 'district_id', 'activity_id', 'SUM(quarter_one_amount) as quarter_one_amount', 'SUM(quarter_two_amount) as quarter_two_amount', 'SUM(quarter_three_amount) as quarter_three_amount', 'SUM(quarter_four_amount) as quarter_four_amount', 'SUM(total_amount) as total_amount']);
                $_query->where(['awpb_template_id' => $awpb_template_id]);
                $_query->andWhere(['>=', 'status', $status]);
                $_query->andWhere(['=', 'district_id', $district_id]);
                $_query->andWhere(['=', 'output_id', $output_id]);
                $_query->groupBy('activity_id');
                $_query->all();

                $_dataProvider = new ActiveDataProvider([
                    'query' => $_query,
                ]);

                return $this->render('mpcdo', [
                            'searchModel' => $_searchModel,
                            'model' => $model,
                            'dataProvider' => $_dataProvider,
                            'district_id' => $district_id,
                            'province_id' => $province_id,
                            'awpb_template_id' => $awpb_template_id,
                            'status' => $status,
                            'output_id' => $output_id,
                            'editable' => 0
                ]);
            } else {
                return $this->render('mpcdo', [
                            'searchModel' => $searchModel,
                            'model' => $model,
                            'dataProvider' => $dataProvider,
                            'district_id' => $district_id,
                            'province_id' => $province_id,
                            'awpb_template_id' => $awpb_template_id,
                            'status' => $status,
                            'output_id' => $output_id,
                            'editable' => 1
                ]);
            }
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    public function actionMpcd($district_id, $province_id, $awpb_template_id, $status) {
        $user = User::findOne(['id' => Yii::$app->user->id]);
        if (User::userIsAllowedTo('Approve AWPB - Provincial') || User::userIsAllowedTo('Approve AWPB - PCO') || User::userIsAllowedTo('Approve AWPB - Ministry')) {

            $awpb_district = \backend\models\AwpbDistrict::findOne(['awpb_template_id' => $awpb_template_id, 'district_id' => $district_id]);
            $status = $awpb_district->status;
            $searchModel = new AwpbBudgetSearch();
            $model = new AwpbBudget();
            $query = $searchModel::find();
            $query->select(['awpb_template_id', 'province_id', 'district_id', 'output_id', 'SUM(quarter_one_amount) as quarter_one_amount', 'SUM(quarter_two_amount) as quarter_two_amount', 'SUM(quarter_three_amount) as quarter_three_amount', 'SUM(quarter_four_amount) as quarter_four_amount', 'SUM(total_amount) as total_amount']);
            $query->where(['awpb_template_id' => $awpb_template_id]);
            $query->andWhere(['=', 'status', $status]);
            $query->andWhere(['=', 'district_id', $district_id]);
            $query->groupBy('output_id');
            $query->all();

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);

            if ($dataProvider->getCount() <= 0 || $dataProvider->count <= 0) {
                $editable = 0;
                $_searchModel = new AwpbBudget();
                $_query = $searchModel::find();
                $_query->select(['awpb_template_id', 'province_id', 'district_id', 'output_id', 'activity_id', 'SUM(quarter_one_amount) as quarter_one_amount', 'SUM(quarter_two_amount) as quarter_two_amount', 'SUM(quarter_three_amount) as quarter_three_amount', 'SUM(quarter_four_amount) as quarter_four_amount', 'SUM(total_amount) as total_amount']);
                $_query->where(['>=', 'awpb_template_id', $awpb_template_id]);
                $_query->andWhere(['>=', 'status', $status]);
                $_query->andWhere(['=', 'district_id', $district_id]);
                $_query->groupBy('output_id');
                $_query->all();

                $_dataProvider = new ActiveDataProvider([
                    'query' => $_query,
                ]);

                return $this->render('mpcd', [
                            'searchModel' => $_searchModel,
                            // 'model' => $model,
                            'dataProvider' => $_dataProvider,
                            'district_id' => $district_id,
                            'province_id' => $province_id,
                            'awpb_template_id' => $awpb_template_id,
                            'status' => $status,
                            'editable' => 0
                ]);
            } else {
                return $this->render('mpcd', [
                            'searchModel' => $searchModel,
                            'model' => $model,
                            'dataProvider' => $dataProvider,
                            'district_id' => $district_id,
                            'province_id' => $province_id,
                            'awpb_template_id' => $awpb_template_id,
                            'status' => $status,
                            'editable' => 1
                ]);
            }
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    public function actionMpc($id, $id2, $status) {

        $user = User::findOne(['id' => Yii::$app->user->id]);
        if (User::userIsAllowedTo('Approve AWPB - Provincial') || User::userIsAllowedTo('Approve AWPB - PCO') || User::userIsAllowedTo('Approve AWPB - Ministry')) {

            $awpb_province = \backend\models\AwpbProvince::findOne(['awpb_template_id' => $id, 'province_id' => $id2]);
            $status = $awpb_province->status;

            $searchModel = new AwpbBudget();
            $query = $searchModel::find();

            $query->select(['awpb_template_id', 'province_id', 'district_id', 'SUM(quarter_one_amount) as quarter_one_amount', 'SUM(quarter_two_amount) as quarter_two_amount', 'SUM(quarter_three_amount) as quarter_three_amount', 'SUM(quarter_four_amount) as quarter_four_amount', 'SUM(total_amount) as total_amount']);
            $query->where(['awpb_template_id' => $id]);
            $query->andWhere(['=', 'status', $status]);
            $query->andWhere(['=', 'province_id', $id2]);
            $query->groupBy('district_id');
            $query->all();

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);

            if ($dataProvider->getCount() <= 0 || $dataProvider->count <= 0) {
                $editable = 0;
                $_searchModel = new AwpbBudget();
                $_query = $searchModel::find();
                $_query->select(['awpb_template_id', 'province_id', 'district_id', 'SUM(quarter_one_amount) as quarter_one_amount', 'SUM(quarter_two_amount) as quarter_two_amount', 'SUM(quarter_three_amount) as quarter_three_amount', 'SUM(quarter_four_amount) as quarter_four_amount', 'SUM(total_amount) as total_amount']);
                $_query->where(['=', 'awpb_template_id', $id]);
                $_query->andWhere(['>=', 'status', $status]);
                $_query->andWhere(['=', 'province_id', $id2]);
                $_query->groupBy('district_id');
                $_query->all();

                $_dataProvider = new ActiveDataProvider([
                    'query' => $_query,
                ]);
                return $this->render('mpc', [
                            'searchModel' => $_searchModel,
                            // 'model' => $model,
                            'dataProvider' => $_dataProvider,
                            'show_results' => 1,
                            'id' => $id,
                            'id2' => $id2,
                            'status' => $status,
                            'editable' => 0
                ]);
            } else {
                return $this->render('mpc', [
                            'searchModel' => $searchModel,
                            // 'model' => $model,
                            'dataProvider' => $dataProvider,
                            'show_results' => 1,
                            'id' => $id,
                            'id2' => $id2,
                            'status' => $status,
                            'editable' => 1
                ]);
            }
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    public function actionMp($id, $status) {
        $user = User::findOne(['id' => Yii::$app->user->id]);
        $editable = 1;

//         $awpb_district =  \backend\models\AwpbDistrict::findOne(['awpb_template_id' =>$model->awpb_template_id, 'district_id'=>$user->district_id]);
//            $status=100;
//            if (!empty($awpb_district)) {
//              $status= $awpb_district->status;
//
//            }
        if ((User::userIsAllowedTo('Approve AWPB - PCO') || User::userIsAllowedTo('Approve AWPB - Ministry')) && ($user->province_id == 0 || $user->province_id == '')) {

            $searchModel = new AwpbBudget();
            $query = $searchModel::find();

            $query->select(['awpb_template_id', 'province_id', 'SUM(quarter_one_amount) as quarter_one_amount', 'SUM(quarter_two_amount) as quarter_two_amount', 'SUM(quarter_three_amount) as quarter_three_amount', 'SUM(quarter_four_amount) as quarter_four_amount', 'SUM(total_amount) as total_amount']);
            $query->where(['awpb_template_id' => $id]);

            $query->andWhere(['=', 'status', $status]);
            $query->groupBy('province_id');
            $query->all();

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);
            if ($dataProvider->getCount() <= 0 || $dataProvider->count <= 0) {
                $editable = 0;
                $_searchModel = new AwpbBudget();
                $_query = $searchModel::find();
                $_query->select(['awpb_template_id', 'province_id', 'SUM(quarter_one_amount) as quarter_one_amount', 'SUM(quarter_two_amount) as quarter_two_amount', 'SUM(quarter_three_amount) as quarter_three_amount', 'SUM(quarter_four_amount) as quarter_four_amount', 'SUM(total_amount) as total_amount']);
                $_query->where(['=', 'awpb_template_id', $id]);

                $_query->andWhere(['>=', 'status', $status]);
                $_query->groupBy('province_id');
                $_query->all();

                $_dataProvider = new ActiveDataProvider([
                    'query' => $_query,
                ]);
                return $this->render('mp', [
                            'searchModel' => $_searchModel,
                            // 'model' => $model,
                            'dataProvider' => $_dataProvider,
                            'show_results' => 1,
                            'id' => $id,
                            'status' => $status,
                            'editable' => 0
                ]);
            } else {

                return $this->render('mp', [
                            'searchModel' => $searchModel,
                            // 'model' => $model,
                            'dataProvider' => $dataProvider,
                            'show_results' => 1,
                            'id' => $id,
                            'status' => $status,
                            'editable' => 1
                ]);
            }

//            return $this->render('mp', [
//                        'searchModel' => $searchModel,
//                        // 'model' => $model,
//                        'dataProvider' => $dataProvider,
//                        'show_results' => 1,
//                        'id' => $id,
//                        'status' => $status,
//                        'editable' => $editable
//            ]);

            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    public function actionMpco($id) {
        if (User::userIsAllowedTo('Approve AWPB - PCO')) {
            $user = User::findOne(['id' => Yii::$app->user->id]);
            $searchModel = new AwpbBudget();
            $query = $searchModel::find();
            $query->select(['awpb_template_id', 'province_id', 'district_id', 'SUM(quarter_one_amount) as quarter_one_amount', 'SUM(quarter_two_amount) as quarter_two_amount', 'SUM(quarter_three_amount) as quarter_three_amount', 'SUM(quarter_four_amount) as quarter_four_amount', 'SUM(total_amount) as total_amount']);
            // $query->where(['awpb_template_id' => $id, 'status' => AwpbBudget::STATUS_REVIEWED]);
            $query->where(['awpb_template_id' => $id])->andWhere(['not', ['province_id' => null]])->andWhere(['status' => AwpbBudget::STATUS_REVIEWED]);

            //  $query->where('province_id = :field1', [':field1' =>$user->province_id]);
            $query->groupBy('province_id');
            $query->all();

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);

            return $this->render('mpco', [
                        'searchModel' => $searchModel,
                        // 'model' => $model,
                        'dataProvider' => $dataProvider,
                        'show_results' => 1,
                        'id' => $id,
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    public function actionMpwpco($id) {
        if (User::userIsAllowedTo('Approve AWPB - PCO')) {
            $user = User::findOne(['id' => Yii::$app->user->id]);
            $searchModel = new AwpbBudget();
            $query = $searchModel::find();
            $query->select(['awpb_template_id', 'activity_id', 'SUM(quarter_one_amount) as quarter_one_amount', 'SUM(quarter_two_amount) as quarter_two_amount', 'SUM(quarter_three_amount) as quarter_three_amount', 'SUM(quarter_four_amount) as quarter_four_amount', 'SUM(total_amount) as total_amount']);
            $query->where(['awpb_template_id' => $id, 'province_id' => null, 'status' => AwpbBudget::STATUS_REVIEWED]);

            //  $query->where('province_id = :field1', [':field1' =>$user->province_id]);
            $query->groupBy('activity_id');
            $query->all();

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);

            return $this->render('mpwpco', [
                        'searchModel' => $searchModel,
                        // 'model' => $model,
                        'dataProvider' => $dataProvider,
                        'show_results' => 1,
                        'id' => $id
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    public function actionMpcm($id) {
        if (User::userIsAllowedTo('Approve AWPB - Ministry')) {
            $user = User::findOne(['id' => Yii::$app->user->id]);
            $searchModel = new AwpbBudget();
            $query = $searchModel::find();
            $query->select(['awpb_template_id', 'province_id', 'district_id', 'SUM(quarter_one_amount) as quarter_one_amount', 'SUM(quarter_two_amount) as quarter_two_amount', 'SUM(quarter_three_amount) as quarter_three_amount', 'SUM(quarter_four_amount) as quarter_four_amount', 'SUM(total_amount) as total_amount']);
            $query->where(['awpb_template_id' => $id])->andWhere(['not', ['province_id' => null]])->andWhere(['status' => AwpbBudget::STATUS_APPROVED]);

            //  $query->where('province_id = :field1', [':field1' =>$user->province_id]);
            $query->groupBy('province_id');
            $query->all();

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);

            return $this->render('mpcm', [
                        'searchModel' => $searchModel,
                        // 'model' => $model,
                        'dataProvider' => $dataProvider,
                        'show_results' => 1,
                        'id' => $id
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    public function actionMpwm($id) {
        if (User::userIsAllowedTo('Approve AWPB - Ministry')) {
            $user = User::findOne(['id' => Yii::$app->user->id]);
            $searchModel = new AwpbBudget();
            $query = $searchModel::find();
            $query->select(['awpb_template_id', 'activity_id', 'SUM(quarter_one_amount) as quarter_one_amount', 'SUM(quarter_two_amount) as quarter_two_amount', 'SUM(quarter_three_amount) as quarter_three_amount', 'SUM(quarter_four_amount) as quarter_four_amount', 'SUM(total_amount) as total_amount']);
            $query->where(['awpb_template_id' => $id, 'province_id' => null, 'status' => AwpbBudget::STATUS_APPROVED]);

            //  $query->where('province_id = :field1', [':field1' =>$user->province_id]);
            $query->groupBy('activity_id');
            $query->all();

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);

            return $this->render('mpwm', [
                        'searchModel' => $searchModel,
                        // 'model' => $model,
                        'dataProvider' => $dataProvider,
                        'show_results' => 1,
                        'id' => $id
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    public function actionMpcop($id, $awpb_template_id) {

        if (User::userIsAllowedTo('Approve AWPB - PCO')) {
            $user = User::findOne(['id' => Yii::$app->user->id]);
            $searchModel = new AwpbBudgetSearch();
            $model = new AwpbBudget();
            $query = $searchModel::find();
            $query->select(['awpb_template_id', 'province_id', 'district_id', 'SUM(quarter_one_amount) as quarter_one_amount', 'SUM(quarter_two_amount) as quarter_two_amount', 'SUM(quarter_three_amount) as quarter_three_amount', 'SUM(quarter_four_amount) as quarter_four_amount', 'SUM(total_amount) as total_amount']);
            // $query->select(['district_id','activity_id','awpb_template_id','SUM(quarter_one_amount) as quarter_one_amount','SUM(quarter_two_amount) as quarter_two_amount','SUM(quarter_three_amount) as quarter_three_amount','SUM(quarter_four_amount) as quarter_four_amount','SUM(total_amount) as total_amount']);
            //      $query->where('district_id = :field1', [':field1' =>$id]);
            $query->where(['awpb_template_id' => $awpb_template_id, 'province_id' => $id, 'status' => AwpbBudget::STATUS_REVIEWED]);

            $query->groupBy('district_id');
            $query->all();

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);

            return $this->render('mpcop', [
                        'searchModel' => $searchModel,
                        'model' => $model,
                        'dataProvider' => $dataProvider,
                        'id' => $id,
                        'awpb_template_id' => $awpb_template_id
            ]);
            // return $this->redirect(['mp/mpcd']);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    public function actionMpcmp($id, $awpb_template_id) {

        if (User::userIsAllowedTo('Approve AWPB - Ministry')) {
            $user = User::findOne(['id' => Yii::$app->user->id]);
            $searchModel = new AwpbBudgetSearch();
            $model = new AwpbBudget();
            $query = $searchModel::find();
            $query->select(['awpb_template_id', 'province_id', 'district_id', 'SUM(quarter_one_amount) as quarter_one_amount', 'SUM(quarter_two_amount) as quarter_two_amount', 'SUM(quarter_three_amount) as quarter_three_amount', 'SUM(quarter_four_amount) as quarter_four_amount', 'SUM(total_amount) as total_amount']);
            // $query->select(['district_id','activity_id','awpb_template_id','SUM(quarter_one_amount) as quarter_one_amount','SUM(quarter_two_amount) as quarter_two_amount','SUM(quarter_three_amount) as quarter_three_amount','SUM(quarter_four_amount) as quarter_four_amount','SUM(total_amount) as total_amount']);
            //      $query->where('district_id = :field1', [':field1' =>$id]);
            $query->where(['awpb_template_id' => $awpb_template_id, 'province_id' => $id, 'status' => AwpbBudget::STATUS_APPROVED]);

            $query->groupBy('district_id');
            $query->all();

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);

            return $this->render('mpcmp', [
                        'searchModel' => $searchModel,
                        'model' => $model,
                        'dataProvider' => $dataProvider,
                        'id' => $id,
                        'awpb_template_id' => $awpb_template_id
            ]);
            // return $this->redirect(['mp/mpcd']);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    public function actionMpcod($id, $awpb_template_id) {

        if (User::userIsAllowedTo('Approve AWPB - PCO')) {
            $user = User::findOne(['id' => Yii::$app->user->id]);
            $searchModel = new AwpbBudgetSearch();
            $model = new AwpbBudget();
            $query = $searchModel::find();
            //$query->select(['awpb_template_id','province_id','district_id','SUM(quarter_one_amount) as quarter_one_amount','SUM(quarter_two_amount) as quarter_two_amount','SUM(quarter_three_amount) as quarter_three_amount','SUM(quarter_four_amount) as quarter_four_amount','SUM(total_amount) as total_amount']);
            $query->select(['district_id', 'activity_id', 'awpb_template_id', 'SUM(quarter_one_amount) as quarter_one_amount', 'SUM(quarter_two_amount) as quarter_two_amount', 'SUM(quarter_three_amount) as quarter_three_amount', 'SUM(quarter_four_amount) as quarter_four_amount', 'SUM(total_amount) as total_amount']);

            //      $query->where('district_id = :field1', [':field1' =>$id]);
            $query->where(['awpb_template_id' => $awpb_template_id, 'district_id' => $id, 'status' => AwpbBudget::STATUS_REVIEWED]);

            $query->groupBy('district_id');
            $query->all();

            $district = \backend\models\Districts::findOne($id);

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);

            return $this->render('mpcod', [
                        'searchModel' => $searchModel,
                        'model' => $model,
                        'dataProvider' => $dataProvider,
                        'id' => $id,
                        'province_id' => $district->province_id,
                        'awpb_template_id' => $awpb_template_id
            ]);
            // return $this->redirect(['mp/mpcd']);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    public function actionMpcmd($id, $awpb_template_id) {

        if (User::userIsAllowedTo('Approve AWPB - Ministry')) {
            $user = User::findOne(['id' => Yii::$app->user->id]);
            $searchModel = new AwpbBudgetSearch();
            $model = new AwpbBudget();
            $query = $searchModel::find();
            //$query->select(['awpb_template_id','province_id','district_id','SUM(quarter_one_amount) as quarter_one_amount','SUM(quarter_two_amount) as quarter_two_amount','SUM(quarter_three_amount) as quarter_three_amount','SUM(quarter_four_amount) as quarter_four_amount','SUM(total_amount) as total_amount']);
            $query->select(['district_id', 'activity_id', 'awpb_template_id', 'SUM(quarter_one_amount) as quarter_one_amount', 'SUM(quarter_two_amount) as quarter_two_amount', 'SUM(quarter_three_amount) as quarter_three_amount', 'SUM(quarter_four_amount) as quarter_four_amount', 'SUM(total_amount) as total_amount']);

            //      $query->where('district_id = :field1', [':field1' =>$id]);
            $query->where(['awpb_template_id' => $awpb_template_id, 'district_id' => $id, 'status' => AwpbBudget::STATUS_APPROVED]);

            $query->groupBy('district_id');
            $query->all();

            $district = \backend\models\Districts::findOne($id);

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);

            return $this->render('mpcmd', [
                        'searchModel' => $searchModel,
                        'model' => $model,
                        'dataProvider' => $dataProvider,
                        'id' => $id,
                        'province_id' => $district->province_id,
                        'awpb_template_id' => $awpb_template_id
            ]);
            // return $this->redirect(['mp/mpcd']);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    public function actionMpca($id, $district_id, $awpb_template_id) {
        // $awpb_template_id=32;
        if (User::userIsAllowedTo('Manage province consolidated AWPB')) {
            $user = User::findOne(['id' => Yii::$app->user->id]);
            $searchModel = new AwpbBudgetSearch();
            $model = new AwpbBudget();
            $query = $searchModel::find();
            // $searchModel = new AwpbBudget();
            $query = $searchModel::find();
            //   $query->select(['id', 'name', 'awpb_template_id', 'SUM(quarter_one_amount) as quarter_one_amount', 'SUM(quarter_two_amount) as quarter_two_amount', 'SUM(quarter_three_amount) as quarter_three_amount', 'SUM(quarter_four_amount) as quarter_four_amount', 'SUM(total_amount) as total_amount']);
            $query->select(['id', 'name', 'awpb_template_id', 'quarter_one_amount', 'quarter_two_amount', 'quarter_three_amount', 'quarter_four_amount', 'total_amount']);

            // $query->where('activity_id = :field1', [':field1' =>$id]);
            $query->where(['awpb_template_id' => $awpb_template_id, 'district_id' => $district_id, 'activity_id' => $id, 'status' => AwpbBudget::STATUS_SUBMITTED]);

            // $query->groupBy('activity_id');
            $query->all();

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);

            return $this->render('mpca', [
                        'searchModel' => $searchModel,
                        'model' => $model,
                        'dataProvider' => $dataProvider,
                        'distr' => $district_id
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    public function actionMpcoa($id, $district_id, $awpb_template_id) {
        // $awpb_template_id=32;
        if (User::userIsAllowedTo('Approve AWPB - PCO')) {
            $user = User::findOne(['id' => Yii::$app->user->id]);
            $searchModel = new AwpbBudgetSearch();
            $model = new AwpbBudget();
            $query = $searchModel::find();
            // $searchModel = new AwpbBudget();
            $query = $searchModel::find();
            //  $query->select(['id', 'name', 'awpb_template_id', 'SUM(quarter_one_amount) as quarter_one_amount', 'SUM(quarter_two_amount) as quarter_two_amount', 'SUM(quarter_three_amount) as quarter_three_amount', 'SUM(quarter_four_amount) as quarter_four_amount', 'SUM(total_amount) as total_amount']);
            $query->select(['id', 'name', 'awpb_template_id', 'quarter_one_amount', 'quarter_two_amount', 'quarter_three_amount', 'quarter_four_amount', 'total_amount']);

            // $query->where('activity_id = :field1', [':field1' =>$id]);
            $query->where(['awpb_template_id' => $awpb_template_id, 'district_id' => $district_id, 'activity_id' => $id, 'status' => AwpbBudget::STATUS_REVIEWED]);

            // $query->groupBy('activity_id');
            $query->all();

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);

            return $this->render('mpcoa', [
                        'searchModel' => $searchModel,
                        'model' => $model,
                        'dataProvider' => $dataProvider,
                        'distr' => $district_id
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    public function actionMpwpcoa($id, $id2) {
        // $awpb_template_id=32;
        if (User::userIsAllowedTo('Approve AWPB - PCO')) {
            $user = User::findOne(['id' => Yii::$app->user->id]);
            $searchModel = new AwpbBudgetSearch();
            $model = new AwpbBudget();
            $query = $searchModel::find();
            // $searchModel = new AwpbBudget();
            $query = $searchModel::find();
            $query->select(['id', 'name', 'awpb_template_id', 'quarter_one_amount', 'quarter_two_amount', 'quarter_three_amount', 'quarter_four_amount', 'total_amount']);

            // $query->where('activity_id = :field1', [':field1' =>$id]);
            $query->where(['awpb_template_id' => $id2, 'province_id' => null, 'activity_id' => $id, 'status' => AwpbBudget::STATUS_REVIEWED]);

            // $query->groupBy('activity_id');
            $query->all();

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);

            return $this->render('mpwpcoa', [
                        'searchModel' => $searchModel,
                        'model' => $model,
                        'dataProvider' => $dataProvider,
                        'id' => $id,
                        'id2' => $id2
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    public function actionMpwma($id, $id2) {
        // $awpb_template_id=32;
        if (User::userIsAllowedTo('Approve AWPB - Ministry')) {
            $user = User::findOne(['id' => Yii::$app->user->id]);
            $searchModel = new AwpbBudgetSearch();
            $model = new AwpbBudget();
            $query = $searchModel::find();
            // $searchModel = new AwpbBudget();
            $query = $searchModel::find();
            $query->select(['id', 'name', 'awpb_template_id', 'quarter_one_amount', 'quarter_two_amount', 'quarter_three_amount', 'quarter_four_amount', 'total_amount']);

            // $query->where('activity_id = :field1', [':field1' =>$id]);
            $query->where(['awpb_template_id' => $id2, 'province_id' => null, 'activity_id' => $id, 'status' => AwpbBudget::STATUS_APPROVED]);

            // $query->groupBy('activity_id');
            $query->all();

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);

            return $this->render('mpwma', [
                        'searchModel' => $searchModel,
                        'model' => $model,
                        'dataProvider' => $dataProvider,
                        'id' => $id,
                        'id2' => $id2
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    public function actionMpcma($id, $district_id, $awpb_template_id) {
        // $awpb_template_id=32;
        if (User::userIsAllowedTo('Approve AWPB - Ministry')) {
            $user = User::findOne(['id' => Yii::$app->user->id]);
            $searchModel = new AwpbBudgetSearch();
            $model = new AwpbBudget();
            $query = $searchModel::find();
            // $searchModel = new AwpbBudget();
            $query = $searchModel::find();
            // $query->select(['id', 'name', 'awpb_template_id', 'SUM(quarter_one_amount) as quarter_one_amount', 'SUM(quarter_two_amount) as quarter_two_amount', 'SUM(quarter_three_amount) as quarter_three_amount', 'SUM(quarter_four_amount) as quarter_four_amount', 'SUM(total_amount) as total_amount']);
            $query->select(['id', 'name', 'awpb_template_id', 'quarter_one_amount', 'quarter_two_amount', 'quarter_three_amount', 'quarter_four_amount', 'total_amount']);

            // $query->where('activity_id = :field1', [':field1' =>$id]);
            $query->where(['awpb_template_id' => $awpb_template_id, 'district_id' => $district_id, 'activity_id' => $id, 'status' => AwpbBudget::STATUS_APPROVED]);

            // $query->groupBy('activity_id');
            $query->all();

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);

            return $this->render('mpcma', [
                        'searchModel' => $searchModel,
                        'model' => $model,
                        'dataProvider' => $dataProvider,
                        'distr' => $district_id
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    public function actionExc($id) {
        if (User::userIsAllowedTo('Manage province consolidated AWPB')) {
            $user = User::findOne(['id' => Yii::$app->user->id]);
            $searchModel = new AwpbBudget();
            $query = $searchModel::find();
            $query->select(['id', 'name', 'SUM(quarter_one_amount) as quarter_one_amount', 'SUM(quarter_two_amount) as quarter_two_amount', 'SUM(quarter_three_amount) as quarter_three_amount', 'SUM(quarter_four_amount) as quarter_four_amount', 'SUM(total_amount) as total_amount']);
            $query->where('activity_id = :field1', [':field1' => $id]);
            $query->groupBy('id');
            $query->all();

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);

            // return $this->render('exc', [
            //                            // 'searchModel' => $searchModel,
            //                         // 'model' => $model,
            //                           //  'dataProvider' => $dataProvider,
            //                         // 'show_results' => 1
            //                         ]);


            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setCellValue('A1', 'Hello World !');

            $writer = new Xlsx($spreadsheet);
            $writer->save('hello world.xlsx');
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['site/home']);
        }
    }

    public function actionExport($id) {

        $user = User::findOne(['id' => Yii::$app->user->id]);
        $searchModel = new AwpbBudget();
        $query = $searchModel::find();
        $query->select(['AwpbTemplate.fiscal_year as year', 'AwpbActivity.gl_account_code as code', 'SUM(quarter_one_amount) as quarter_one_amount', 'SUM(quarter_two_amount) as quarter_two_amount', 'SUM(quarter_three_amount) as quarter_three_amount', 'SUM(quarter_four_amount) as quarter_four_amount', 'SUM(total_amount) as total_amount']);
        $query->leftJoin('AwpbActivity', 'AwpbActivity.id = AwpbBudget.activity_id');
        $query->where('AwpbTemplate.fiscal_year= :field1', [':field1' => $id]);

        //$query->joinWith('inventory');
        $query->groupBy('AwpbActivity.gl_account_code');
        //$query->asArray();
        $query->all();

        // $customers = Customer::find()
        // ->select('customer.*')
        // ->leftJoin('order', '`order`.`customer_id` = `customer`.`id`')
        // ->where(['order.status' => Order::STATUS_ACTIVE])
        // ->with('orders')
        // ->all();
        //         $searchModel = new Bill();
        //         $query = $searchModel::find();
        //         $query->select('teis_bill_id, inventory.teis_inventory_type,
        //                          sum(teis_bill_override_cbm ) as teis_bill_override_cbm,
        //                               teis_bill_pieces, teis_bill_sale_price, teis_bill_profit');
        //         $query->where(['BETWEEN', 'teis_bill_purchase_date', $from, $to]);
        //         // The problem is in the below sum
        //         $query->joinWith('inventory');
        //         $query->groupBy('teis_inventory_id');
        //         //$query->sum('teis_bill_override_cbm'); already calculated
        //         $query->all();

        CsvExport::export(
                $query, // a CActiveRecord array OR any CModel array
                array('year' => array('number'), 'code' => array('number')),
                true, // boolPrintRows
                'registers-upto--' . date('d-m-Y H-i') . ".csv"
        );
    }

    //echo CHtml::link('Download CSV',array('site/export'));
}
