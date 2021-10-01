<?php

namespace backend\controllers;

use Yii;
use backend\models\AwpbBudget;
use backend\models\AwpbBudgetSearch;
use backend\models\AwpbBudget_2;
use backend\models\AwpbBudgetSearch_2;
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
use backend\models\AwpbDistrict;

/**
 * AwpbBudgetController implements the- CRUD actions for AwpbBudget model.
 */
class AwpbBudgetController extends Controller {

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => [
                    'delete', 'view', 'view_1', 'viewo', 'viewpw', 'viewpw_1', 'viewp', 'viewpwpco','viewactualinput', 'mp', 'mpc', 'mpca', 'mpcd', 'mpco', 'mpcd', 'mpcdo', 'mpcdoa', 'mpcop', 'mpcod', 'mpcoa',
                    'index', 'index_2', 'index_2pw', 'index_3', 'indexpw', 'create', 'createcspco', 'createpw', 'update', 'updatepw', 'mpcma', 'mpcoa', 'mpca', 'mpcmd', 'mpcod', 'mpcmp', 'mpcmp',
                    'mpcop', 'mpcd', 'mpwm', 'mpcm', 'mpwpco', 'mpco', 'mpc', 'decline', 'declinepw', 'declinepwm', 'declinem', 'declinep', 'declinepwpco', 'submitpw', 'submit',
                    'mpwpcoa', 'pwc', 'pwca', 'pwcau', 'pwcu'
                ],
                'rules' => [
                    [
                        'actions' => [
                            'delete', 'view', 'view_1', 'viewo', 'viewpw', 'viewp', 'viewpwpco', 'viewactualinput', 'mp', 'mpc', 'mpca', 'mpcd', 'mpco', 'mpcd', 'mpcdo', 'mpcdoa', 'mpcop', 'mpcod', 'mpcoa',
                            'index', 'index_2', 'index_2pw', 'index_3', 'indexpw', 'create', 'createcspco', 'createpw', 'update', 'updatepw', 'mpcma', 'mpcoa', 'mpca', 'mpcmd', 'mpcod', 'mpcmp', 'mpcmp',
                            'mpcop', 'mpcd', 'mpwm', 'mpcm', 'mpwpco', 'mpco', 'mpc', 'decline', 'declinepw', 'declinepwm', 'declinem', 'declinep', 'declinepwpco', 'submitpw', 'submit',
                            'mpwpcoa', 'pwc', 'pwca', 'pwcau', 'pwcu'
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
        $template_model = \backend\models\AwpbTemplate::find()->where(['status' => \backend\models\AwpbTemplate::STATUS_PUBLISHED])->one();
        $user = User::findOne(['id' => Yii::$app->user->id]);
        if (!empty($template_model)) {
            $awpb_district = \backend\models\AwpbDistrict::findOne(['awpb_template_id' => $template_model->id, 'district_id' => $user->district_id]);
            // $status=100;
            if (!empty($awpb_district)) {
                $status = $awpb_district->status;

                //  $searchModel = new AwpbBudgetSearch();
                $searchModel = new AwpbBudget();
                $model = new AwpbBudget();
                $query = $searchModel::find();
                $query->select(['component_id', 'awpb_template_id', 'province_id', 'district_id', 'output_id', 'camp_id', 'activity_id', 'indicator_id', 'id', 'quarter_one_quantity', 'quarter_two_quantity', 'quarter_three_quantity', 'quarter_four_quantity', 'total_amount']);
                $query->where(['=', 'awpb_template_id', $template_model->id]);
                // $query->andWhere(['=', 'status',$status]);
                $query->andWhere(['=', 'district_id', $user->district_id]);
                // $query->andWhere(['=', 'created_by', $user->id]);
                //  $query->groupBy('indicator_id');
                $query->all();

                $dataProvider = new ActiveDataProvider([
                    'query' => $query,
                ]);

                return $this->render('index', [
                            'searchModel' => $searchModel,
                            'model' => $model,
                            'dataProvider' => $dataProvider,
                            'id' => $id,
                            'status' => $status,
                            'editable' => 1
                ]);
                //}
            } else {
                Yii::$app->session->setFlash('error', 'This district has no activities.Kinldy contact PCO');
                return $this->redirect(['home/home']);
            }
        } else {
            Yii::$app->session->setFlash('error', 'No AWPB Template has been published. Kindly contact PCO.');
                return $this->redirect(['home/home']);
            }
        
    }

    public function actionIndex_2($id, $status) {

        if (User::userIsAllowedTo("Request Funds")) {

            $user = User::findOne(['id' => Yii::$app->user->id]);
            $template_model = \backend\models\AwpbTemplate::find()->where(['status' => \backend\models\AwpbTemplate::STATUS_CURRENT_BUDGET])->one();
            $id = $template_model->id;
            if (!empty($template_model)) {
                $awpb_district = \backend\models\AwpbDistrict::findOne(['awpb_template_id' => $id, 'district_id' => $user->district_id]);

                $awpb_province = \backend\models\AwpbProvince::findOne(['awpb_template_id' => $id, 'province_id' => $awpb_district->province_id]);

                //if (!empty($awpb_district) && !empty($awpb_province)) {

                   

                        return $this->render('index_2', [
                                    //'searchModel' => $searchModel,
                                    //'model' => $model,
                                    // 'dataProvider' => $dataProvider,
                                    'fiscal_year' => $template_model->fiscal_year,
                                    'id' => $id,
//                    'status' => $status,
//                    'editable' => 1
                        ]);
//                    }
//                     else {
//                    Yii::$app->session->setFlash('error', 'You can not change inputs.');
//                    return $this->redirect(['home/home']);
//                }
//                } else {
//                    Yii::$app->session->setFlash('error', 'No inputs to vary.');
//                    return $this->redirect(['home/home']);
//                }
            } else {
                Yii::$app->session->setFlash('error', 'No cuurent budget has been set.');
                return $this->redirect(['home/home']);
            }
        } else {
            Yii::$app->session->setFlash('error', 'This district has no activities.');
            return $this->redirect(['home/home']);
        }
    }

    public function actionIndex_2pw($id, $status) {
        $user = User::findOne(['id' => Yii::$app->user->id]);
        $awpb_template = \backend\models\AwpbTemplate::findOne([
                    'status' => \backend\models\AwpbTemplate::STATUS_CURRENT_BUDGET,
        ]);
        if (User::userIsAllowedTo("Request Funds") && ($user->province_id == 0 || $user->province_id == '')) {


            // $awpb_district = \backend\models\AwpbDistrict::findOne(['awpb_template_id' => $id, 'created_by' => $user->created_by]);
            // $awpb_district = \backend\models\AwpbDistrict::findOne(['awpb_template_id' => $id, 'district_id'=>$id2]);
            // $awpb_province = \backend\models\AwpbProvince::findOne(['awpb_template_id' => $id, 'province_id' => $awpb_district->province_id]);
            $awpb_template_user = \backend\models\AwpbTemplateUsers::findOne(['awpb_template_id' => $awpb_template->id, 'user_id' => $user->id]);

//$budgeted_input = \backend\models\AwpbInput::find()->where(['budget_id'=>$id4])->sum('total_amount');
//$budget = \backend\models\AwpbActualInput::find()->where(['budget_id'=>$id4])->sum('total_amount');

            if (!empty($awpb_template_user)) {
                if ($awpb_template_user->status_budget == \backend\models\AwpbBudget::STATUS_MINISTRY) {


//        //  $searchModel = new AwpbBudgetSearch();
//        $searchModel = new AwpbBudget();
//        $model = new AwpbBudget();
//        $query = $searchModel::find();
//        $query->select(['component_id','awpb_template_id', 'province_id', 'district_id',  'activity_id', 'id', 'quarter_one_quantity', 'quarter_two_quantity', 'quarter_three_quantity', 'quarter_four_quantity', 'total_amount']);
//        $query->where(['=', 'awpb_template_id', $id]);
//        // $query->andWhere(['=', 'status',$status]);
//        $query->andWhere(['=', 'district_id', $user->district_id]);
//        // $query->andWhere(['=', 'created_by', $user->id]);
//        //  $query->groupBy('indicator_id');
//        $query->all();
//
//        $dataProvider = new ActiveDataProvider([
//            'query' => $query,
//        ]);
//
////        if ($dataProvider->getCount() <= 0 || $dataProvider->count <= 0) {
////            $editable = 0;
////            $_searchModel = new AwpbBudget();
////            $_query = $searchModel::find();
////         $_query->select(['awpb_template_id', 'province_id', 'district_id', 'output_id', 'province_id', 'district_id', 'activity_id', 'indicator_id', 'id', 'quarter_one_quantity', 'quarter_two_quantity', 'quarter_three_quantity', 'quarter_four_quantity', 'total_amount']);
////            $_query->where(['=','awpb_template_id', $id]);
////            $_query->andWhere(['>=', 'status',$status]);
////            $_query->andWhere(['=', 'district_id', $user->district_id]);
////            //$_query->andWhere(['=', 'created_by', $user->id]);
////            // $_query->groupBy('indicator_id');
////            $_query->all();
////
////            $_dataProvider = new ActiveDataProvider([
////                'query' => $_query,
////            ]);
////
////            return $this->render('index', [
////                        'searchModel' => $_searchModel,
////                        'model' => $model,
////                        'dataProvider' => $_dataProvider,
////                      'id' => $id,
////                'status'=>$status,
//                        'editable' => 0
//            ]);
//        } else {
                    return $this->render('index_2pw', [
                                //'searchModel' => $searchModel,
                                //'model' => $model,
                                // 'dataProvider' => $dataProvider,
                                'id' => $id,
//                    'status' => $status,
//                    'editable' => 1
                    ]);
                } else {
                    Yii::$app->session->setFlash('error', 'No inputs to vary.');
                    return $this->redirect(['home/home']);
                }
            } else {
                Yii::$app->session->setFlash('error', 'You have no programme wide activities.');
                return $this->redirect(['home/home']);
            }
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    public function actionIndexpwxx($id, $status) {


        $template_model = \backend\models\AwpbTemplate::find()->where(['status' => \backend\models\AwpbTemplate::STATUS_PUBLISHED])->one();

        $user = User::findOne(['id' => Yii::$app->user->id]);
        if ((User::userIsAllowedTo("Manage PW AWPB") || User::userIsAllowedTo('Approve AWPB - PCO') || User::userIsAllowedTo('Approve AWPB - Ministry')) && ($user->province_id == 0 || $user->province_id == '')) {

            $awpb_district = \backend\models\AwpbDistrict::findOne(['awpb_template_id' => $template_model->id]);
            // $status=100;
            // if (!empty($awpb_district)) {
            //    $status = $awpb_district->status;

            $searchModel = new AwpbBudget();
            $model = new AwpbBudget();
            $query = $searchModel::find();
            $query->select(['component_id', 'awpb_template_id', 'output_id', 'cost_centre_id', 'activity_id', 'indicator_id', 'id', 'quarter_one_quantity', 'quarter_two_quantity', 'quarter_three_quantity', 'quarter_four_quantity', 'total_amount']);
            $query->where(['=', 'awpb_template_id', $template_model->id]);

            $query->andWhere(['<>', 'cost_centre_id', 0]);
            $query->andWhere(['=', 'created_by', $user->id]);
            $query->andWhere(['>=', 'status', AwpbBudget::STATUS_DRAFT]);
            $query->all();

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);

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
            return $this->redirect(['home/home']);
        }
    }

    public function actionIndexpw($id, $status) {
        $template_model = \backend\models\AwpbTemplate::find()->where(['status' => \backend\models\AwpbTemplate::STATUS_PUBLISHED])->one();
        $user = User::findOne(['id' => Yii::$app->user->id]);
        $awpb_template_user = \backend\models\AwpbTemplateUsers::findOne(['awpb_template_id' => $template_model->id, 'user_id' => $user->id]);
        //$status=100;
        if (!empty($awpb_template_user)) {
            $status = $awpb_template_user->status_budget;

            //  $searchModel = new AwpbBudgetSearch();
            $searchModel = new AwpbBudget_1();
            $model = new AwpbBudget_1();
            $query = $searchModel::find();
            $query->select(['component_id', 'awpb_template_id', 'cost_centre_id', 'province_id', 'district_id', 'output_id', 'activity_id', 'indicator_id', 'id', 'quarter_one_quantity', 'quarter_two_quantity', 'quarter_three_quantity', 'quarter_four_quantity', 'total_amount']);
            $query->where(['=', 'awpb_template_id', $template_model->id]);
            // $query->andWhere(['=', 'status',$status]);
            $query->andWhere(['<>', 'cost_centre_id', 0]);
            $query->andWhere(['=', 'created_by', $user->id]);
            $query->all();

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);

            return $this->render('indexpw', [
                        'searchModel' => $searchModel,
                        'model' => $model,
                        'dataProvider' => $dataProvider,
                        'id' => $id,
                        'status' => $status,
                        'editable' => 1
            ]);
            //}
        } else {
            Yii::$app->session->setFlash('error', 'This district has no activities.');
            return $this->redirect(['home/home']);
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
       // $status = 100;
        $user = User::findOne(['id' => Yii::$app->user->id]);
        $template_model = \backend\models\AwpbTemplate::find()->where(['status' => \backend\models\AwpbTemplate::STATUS_PUBLISHED])->one();
        $awpb_district = \backend\models\AwpbDistrict::findOne(['awpb_template_id' => $template_model->id, 'district_id' => $user->district_id]);
        if (!empty($awpb_template_user)) {
            $status = $awpb_district->status;
        }
        return $this->render('view', [
                    'model' => $this->findModel($id),
                    'status' => $status
        ]);
    }

    public function actionViewactualinput($id) {
        return $this->render('viewactualinput', [
                    'model' => $this->findModel($id),
                        //'status' => $status
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
        $status = 100;
        $user = User::findOne(['id' => Yii::$app->user->id]);
        $template_model = \backend\models\AwpbTemplate::find()->where(['status' => \backend\models\AwpbTemplate::STATUS_PUBLISHED])->one();
        $awpb_template_user = \backend\models\AwpbTemplateUsers::findOne(['awpb_template_id' => $template_model->id, 'user_id' => $user->id]);
        if (!empty($awpb_template_user)) {
            $status = $awpb_template_user->status_budget;
        }
  $budget_model = \backend\models\AwpbBudget::findOne(['activity_id' =>$id, 'awpb_template_id'=>  $template_model->id]);
                
        return $this->render('viewpw', [
                    'model' => $this->findModel($budget_model->id),
                    'status' => $status
        ]);
    }

    public function actionViewpw_1($id) {
        $status = 100;
      //  $user = User::findOne(['id' => Yii::$app->user->id]);
      
        return $this->render('viewpw_1', [
                    'model' => $this->findModel($id),
                    'status' => $status
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
        $page = "";
        $camp_id = "";
        $_model = $this->findModel($id);
        $model = "";
        if (($_model->cost_centre_id != 0 || $_model->cost_centre_id != '') && ($_model->province_id == 0 || $_model->province_id == '')) {

            $model = \backend\models\AwpbBudget_1::findOne($id);
        } else {
            $model = $this->findModel($id);
            $camp_id = $model->camp_id;
        }

        if (User::userIsAllowedTo('Manage AWPB') || User::userIsAllowedTo('Manage PW AWPB')) {
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

                        //  if ($model->camp_id != $camp_id && ($model->district_id != 0 || $model->district_id != '') && ($model->cost_centre_id == 0 || $model->cost_centre_id == '')) {
                        //  $province_id = backend\models\Districts::findOne([Yii::$app->getUser()->identity->district_id])->province_id;
                        $count = 0;
                        $errors = '';
                        $transaction = \Yii::$app->db->beginTransaction();
                        try {
                            $awpbinputs = \backend\models\AwpbInput::find()->where(['=', 'budget_id', $model->id])->all();
                            if ($awpbinputs != null) {

                                foreach ($awpbinputs as $awpbinput) {
                                    $awpbinput->camp_id = $model->camp_id;
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

                        $audit = new AuditTrail();
                        $audit->user = Yii::$app->user->id;
                        $audit->action = "Update AWPB: " . $model->name . " : " . $model->id;
                        $audit->ip_address = Yii::$app->request->getUserIP();
                        $audit->user_agent = Yii::$app->request->getUserAgent();
                        $audit->save();
                        Yii::$app->session->setFlash('success', 'AWPB was successfully updated.');
                        if (($model->province_id == 0 || $model->province_id == '') && ($model->cost_centre_id != 0 || $model->cost_centre_id != '')) {

                            return $this->redirect(['indexpw', 'id' => $model->id, 'status' => $status]);
                        } else {
                            return $this->redirect(['index', 'id' => $model->id, 'status' => $status]);
                        }
                    } else {
                        $message = '';
                        foreach ($model->getErrors() as $error) {
                            $message .= $error[0];
                            Yii::$app->session->setFlash('error', "Error occured while creating a component: " . $message);

                            if (($model->province_id == 0 || $model->province_id == '') && ($model->cost_centre_id != 0 || $model->cost_centre_id != '')) {

                                return $this->redirect(['indexpw', 'id' => $model->id, 'status' => $status]);
                            } else {
                                return $this->redirect(['index', 'id' => $model->id, 'status' => $status]);
                            }
                        }
                    }
                } else {
                    Yii::$app->session->setFlash('error', 'Enter quantity for at least one month.');
                }
            }

            return $this->render('update', [
                        'model' => $model,
                        'template_id' => $model->awpb_template_id,
                        'status' => $status
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }
  public function actionUpdatecspco($id, $status) {
        $user = \backend\models\User::findOne(['id' => Yii::$app->user->id]);
        $page = "";
        $camp_id = "";
        $_model = \backend\models\AwpbBudget_1::findOne($id);
        $model = "";
        if (($_model->cost_centre_id != 0 || $_model->cost_centre_id != '') && ($_model->province_id == 0 || $_model->province_id == '')) {

            $model = \backend\models\AwpbBudget_2::findOne($id);
        } else {
            $model = \backend\models\AwpbBudget_2::findOne($id);
            $camp_id = $model->camp_id;
        }

        if (User::userIsAllowedTo('Manage AWPB') || User::userIsAllowedTo('Manage PW AWPB')) {
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

                        //  if ($model->camp_id != $camp_id && ($model->district_id != 0 || $model->district_id != '') && ($model->cost_centre_id == 0 || $model->cost_centre_id == '')) {
                        //  $province_id = backend\models\Districts::findOne([Yii::$app->getUser()->identity->district_id])->province_id;
                        $count = 0;
                        $errors = '';
                        $transaction = \Yii::$app->db->beginTransaction();
                        try {
                            $awpbinputs = \backend\models\AwpbInput::find()->where(['=', 'budget_id', $model->id])->all();
                            if (!empty($awpbinputs)) {

                                foreach ($awpbinputs as $awpbinput) {
                                    $awpbinput->camp_id = $model->camp_id;
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

                        $audit = new AuditTrail();
                        $audit->user = Yii::$app->user->id;
                        $audit->action = "Update AWPB: " . $model->name . " : " . $model->id;
                        $audit->ip_address = Yii::$app->request->getUserIP();
                        $audit->user_agent = Yii::$app->request->getUserAgent();
                        $audit->save();
                        Yii::$app->session->setFlash('success', 'AWPB was successfully updated.');
                        if ($model->province_id == 0 || $model->province_id == '')  {

                            return $this->redirect(['mp', 'id' => $model->id, 'status' => $status]);
                        } else {
                            return $this->redirect(['mpc', 'id' => $model->province_id, 'id2' => $model->province_id, 'status' => $status]);
                        }
                    } else {
                        $message = '';
                        foreach ($model->getErrors() as $error) {
                            $message .= $error[0];
                            Yii::$app->session->setFlash('error', "Error occured while creating a component: " . $message);

                            if (($model->province_id == 0 || $model->province_id == '')) {

                                return $this->redirect(['mp', 'id' => $model->id, 'status' => $status]);
                            } else {
                                return $this->redirect(['mpc', 'id' => $model->province_id, 'id2' => $model->province_id,'status' => $status]);
                            }
                        }
                    }
                } else {
                    Yii::$app->session->setFlash('error', 'Enter quantity for at least one month.');
                }
            }

            return $this->render('updatecspco', [
                        'model' => $model,
                        'template_id' => $model->awpb_template_id,
                        'status' => $status
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    public function actionUpdatepw($id, $status) {
        $user = \backend\models\User::findOne(['id' => Yii::$app->user->id]);
        $page = "";
        $camp_id = "";
        $_model = $this->findModel($id);
        $model = "";
        if (($_model->cost_centre_id != 0 || $_model->cost_centre_id != '') && ($_model->province_id == 0 || $_model->province_id == '')) {

            $model = \backend\models\AwpbBudget_1::findOne($id);
        } else {
            $model = $this->findModel($id);
            $camp_id = $model->camp_id;
        }

        if ((User::userIsAllowedTo('Manage AWPB') && ($user->district_id != 0 || $user->district_id != '')) || (User::userIsAllowedTo('Manage PW AWPB') && ($model->cost_centre_id != 0 || $model->cost_centre_id != '')) || (User::userIsAllowedTo('Approve AWPB - PCO') && ($model->province_id == 0 || $model->province_id == ''))) {
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

                        //  if ($model->camp_id != $camp_id && ($model->district_id != 0 || $model->district_id != '') && ($model->cost_centre_id == 0 || $model->cost_centre_id == '')) {
                        //  $province_id = backend\models\Districts::findOne([Yii::$app->getUser()->identity->district_id])->province_id;
                        $count = 0;
                        $errors = '';
                        $transaction = \Yii::$app->db->beginTransaction();
                        try {
                            $awpbinputs = \backend\models\AwpbInput::find()->where(['=', 'budget_id', $model->id])->all();
                            if ($awpbinputs != null) {

                                foreach ($awpbinputs as $awpbinput) {
                                    $awpbinput->camp_id = $model->camp_id;
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
//                        } else {
//                            //  $province_id = backend\models\Districts::findOne([Yii::$app->getUser()->identity->district_id])->province_id;
//                            $count = 0;
//                            $errors = '';
//                            $transaction = \Yii::$app->db->beginTransaction();
//                            try {
//                                $awpbinputs = \backend\models\AwpbInput::find()->where(['=', 'budget_id', $model->id])->all();
//                                if ($awpbinputs != null) {
//
//                                    foreach ($awpbinputs as $awpbinput) {
//                                        $awpbinput->cost_centre_id = $model->cost_centre_id;
//                                        $count++;
//                                        if (!($flag = $awpbinput->save())) {
//                                            $transaction->rollBack();
//                                            foreach ($awpbinput->getErrors() as $error) {
//                                                $errors .= "\n" . $error[0];
//                                            }
//                                            break;
//                                        }
//                                    }
//
//                                    if ($flag) {
//                                        $transaction->commit();
//                                        $audit = new AuditTrail();
//
//                                        $audit->user = Yii::$app->user->id;
//                                        $audit->action = "Updated $count input";
//                                        $audit->ip_address = Yii::$app->request->getUserIP();
//                                        $audit->user_agent = Yii::$app->request->getUserAgent();
//                                        $audit->save();
//                                        //Yii::$app->session->setFlash('success', 'You have successfully added ' . $count . ' AWPB activity line.');
//                                        // return $this->redirect(['index']);
//                                    }
//                                }
//                            } catch (Exception $e) {
//                                $transaction->rollBack();
//                                Yii::$app->session->setFlash('error', 'Error occured while updating the cost centre.' . $ex->getMessage() . ' Please try again1');
//                            }
//                        }
                        $audit = new AuditTrail();
                        $audit->user = Yii::$app->user->id;
                        $audit->action = "Update AWPB: " . $model->name . " : " . $model->id;
                        $audit->ip_address = Yii::$app->request->getUserIP();
                        $audit->user_agent = Yii::$app->request->getUserAgent();
                        $audit->save();
                        Yii::$app->session->setFlash('success', 'AWPB was successfully updated.');
                        if (($model->province_id == 0 || $model->province_id == '') && ($model->cost_centre_id != 0 || $model->cost_centre_id != '')) {

                            return $this->redirect(['indexpw', 'id' => $model->id, 'status' => $status]);
                        } else {
                            return $this->redirect(['index', 'id' => $model->id, 'status' => $status]);
                        }
                    } else {
                        $message = '';
                        foreach ($model->getErrors() as $error) {
                            $message .= $error[0];
                            Yii::$app->session->setFlash('error', "Error occured while creating a component: " . $message);

                            if (($model->province_id == 0 || $model->province_id == '') && ($model->cost_centre_id != 0 || $model->cost_centre_id != '')) {

                                return $this->redirect(['indexpw', 'id' => $model->id, 'status' => $status]);
                            } else {
                                return $this->redirect(['index', 'id' => $model->id, 'status' => $status]);
                            }
                        }
                    }
                } else {
                    Yii::$app->session->setFlash('error', 'Enter quantity for at least one month.');
                }
            }

            return $this->render('updatepw', [
                        'model' => $model,
                        'template_id' => $model->awpb_template_id,
                        'status' => $status
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action1.');
            return $this->redirect(['home/home']);
        }
    }

    public function actionCreatecspco($template_id) {
        $user = User::findOne(['id' => Yii::$app->user->id]);

        $status = 0;

        if ((User::userIsAllowedTo("Approve AWPB - Provincial") && ($user->province_id > 0 || $user->province_id !== '')) || (User::userIsAllowedTo('Approve AWPB - PCO') && ( $user->province_id == 0 || $user->province_id == ''))) {

            $template_model = \backend\models\AwpbTemplate::find()->where(['status' => \backend\models\AwpbTemplate::STATUS_PUBLISHED])->one();
            if (!empty($template_model)) {

                $template_id = $template_model->id;
                $model = new AwpbBudget_2();
                if (Yii::$app->request->isAjax) {
                    $model->load(Yii::$app->request->post());
                    $model->district_id = 2;
                    return Json::encode(\yii\widgets\ActiveForm::validate($model));
                }
                // if (Yii::$app->request->post('addComponent') != 'true' && $model->load(Yii::$app->request->post()) ) {
                // if ($model->load(Yii::$app->request->post())) {
                if ($model->load(Yii::$app->request->post())) {

                    $awpb_district = \backend\models\AwpbDistrict::findOne(['awpb_template_id' => $template_id, 'district_id' => $model->district_id]);

                    if (!empty($awpb_district)) {
                        $status = $awpb_district->status;
                    }


                    $_model = AwpbBudget_2::findOne(['awpb_template_id' => $model->awpb_template_id, 'activity_id' => $model->activity_id, 'district_id' => $model->district_id]);
                    if (empty($_model)) {
                        $model->district_id = 2;
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
                            //  $model->district_id = $user->district_id;
                           // $model->province_id = $user->province_id;
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
                                    Yii::$app->session->setFlash('error', "Error occured while adding an AWPB " . $model->name . " details Please try again.Error:" . $message);

                                    return $this->render('createcspco', [
                                                'model' => $model,
                                                'template_id' => $template_id
                                    ]);
                                }
                                return $this->redirect(['view', 'id' => $model->id, 'status' => AwpbBudget::STATUS_DRAFT]);
                                // return $this->render('create', [
                                //     'model' => $model,
                                //     'template_id' =>$template_id
                                // ]);
                            } else {
                                $message = '';
                                foreach ($model->getErrors() as $error) {
                                    $message .= $error[0];
                                }
                                Yii::$app->session->setFlash('error', "Error occured while adding an AWPB " . $model->name . " details Please try again.Error:" . $message);
                            }
                        } else {
                            Yii::$app->session->setFlash('error', 'Enter quantity for at least one month.');
                        }
                    } else {
                        Yii::$app->session->setFlash('error', 'An AWPB with this activity and camp has already added. Kindly proceed to update it.');

                        return $this->redirect(['view', 'id' => $_model->id, 'status' => $status]);
                    }
                }


                return $this->render('createcspco', [
                            'model' => $model,
                            'template_id' => $template_id
                ]);
            } else {
                Yii::$app->session->setFlash('error', 'No AWPB Template has been published. Kindly contact the systems administrator.');

                return $this->redirect(['index', 'id' => $_model->id, 'status' => $status]);
            }
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    //Creating commodity specific budget line for the district
    public function actionCreate($template_id) {
        $user = User::findOne(['id' => Yii::$app->user->id]);
        $status = 0;

        if (User::userIsAllowedTo('Manage AWPB') && ($user->district_id != 0 || $user->district_id != '')) {


            $model = new AwpbBudget();
            if (Yii::$app->request->isAjax) {
                $model->load(Yii::$app->request->post());
                return Json::encode(\yii\widgets\ActiveForm::validate($model));
            }
            // if (Yii::$app->request->post('addComponent') != 'true' && $model->load(Yii::$app->request->post()) ) {
            // if ($model->load(Yii::$app->request->post())) {
            if ($model->load(Yii::$app->request->post())) {

                $awpb_district = \backend\models\AwpbDistrict::findOne(['awpb_template_id' => $template_id, 'district_id' => $model->district_id]);

                if (!empty($awpb_district)) {
                    $status = $awpb_district->status;
                }
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

                    return $this->redirect(['view', 'id' => $_model->id, 'status' => $status]);
                }
            }


            return $this->render('create', [
                        'model' => $model,
                        'template_id' => $template_id
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    public function actionCreatepw() {
        $user = User::findOne(['id' => Yii::$app->user->id]);
        $status = 0;
        $template_model = \backend\models\AwpbTemplate::find()->where(['status' => \backend\models\AwpbTemplate::STATUS_PUBLISHED])->one();
        $template_id = $template_model->id;
        if (User::userIsAllowedTo('Manage PW AWPB') && ($user->district_id == 0 || $user->district_id == '')) {
            // $awpb_district = \backend\models\AwpbDistrict::findOne(['awpb_template_id' => $template_id, 'district_id' => $user->district_id]);
//            if (!empty($awpb_district)) {
//                $status = $awpb_district->status;
//            }
            $model = new AwpbBudget_1();
            if (Yii::$app->request->isAjax) {
                $model->load(Yii::$app->request->post());
                return Json::encode(\yii\widgets\ActiveForm::validate($model));
            }
            // if (Yii::$app->request->post('addComponent') != 'true' && $model->load(Yii::$app->request->post()) ) {
            // if ($model->load(Yii::$app->request->post())) {
            if ($model->load(Yii::$app->request->post())) {

                // $_model = AwpbBudget::findOne(['awpb_template_id' => $model->awpb_template_id, 'activity_id' => $model->activity_id, 'camp_id' => $model->camp_id]);
                $_model = AwpbBudget_1::findOne(['awpb_template_id' => $model->awpb_template_id, 'activity_id' => $model->activity_id, 'cost_centre_id' => $model->cost_centre_id]);

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
                        $model->created_at =0;
                        $model->updated_at =0;
                        //$model->district_id = $user->district_id;
                        //$model->province_id = $user->province_id;
                        $number_of_non_women_headed_households = !empty($model->number_of_non_women_headed_households) ? $model->number_of_non_women_headed_households : 0;
                        $number_of_women_headed_households = !empty($model->number_of_women_headed_households) ? $model->number_of_women_headed_households : 0;
                        $model->number_of_household_members = $number_of_women_headed_households + $number_of_non_women_headed_households;

                        if ($model->validate()) {

                            if ($model->save()) {

                                $activity_model = \backend\models\AwpbActivity::find()->where(['id' => $model->activity_id])->one();
                                $audit = new AuditTrail();
                                $audit->user = Yii::$app->user->id;
                                $audit->action = "Added AWPB  : " . $model->id;
                                $audit->ip_address = Yii::$app->request->getUserIP();
                                $audit->user_agent = Yii::$app->request->getUserAgent();
                                $audit->save();
                                Yii::$app->session->setFlash('success', 'AWPB  was successfully added.');
                               // return $this->redirect(['pwcasub', 'id' => $model->id, 'status' => AwpbBudget::STATUS_DRAFT]);
                                return $this->redirect( ['pwcasub', 'id' =>  $activity_model->parent_activity_id,'status' => 0 ]);
                            } else {
                                Yii::$app->session->setFlash('error', 'Error occured while adding AWPB.');

                                $message = '';
                                foreach ($model->getErrors() as $error) {
                                    $message .= $error[0];
                                }
                                Yii::$app->session->setFlash('error', "Error occured while adding an AWPB " . $model->code . " details Please try again.Error:" . $message);

                                return $this->render('createpw', [
                                            'model' => $model,
                                            'template_id' => $template_id
                                ]);
                            }
                            return $this->redirect(['viewpw', 'id' => $model->activity_id, 'status' => AwpbBudget::STATUS_DRAFT]);
                            // return $this->render('create', [
                            //     'model' => $model,
                            //     'template_id' =>$template_id
                            // ]);
                        }
                    } else {
                        Yii::$app->session->setFlash('error', 'Enter quantity for at least one month.');
                    }
                } else {
                    Yii::$app->session->setFlash('error', 'An AWPB with this activity and cost centre has been added already. Kindly proceed to update it.');
                    return $this->redirect(['viewpw', 'id' => $_model->id, 'status' => $status]);
                }
            }


            return $this->render('createpw', [
                        'model' => $model,
                        'template_id' => $template_id
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
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

    public function actionSubmit($id) {

        $user = User::findOne(['id' => Yii::$app->user->id]);

        if (User::userIsAllowedTo("Submit District AWPB") || User::userIsAllowedTo('Approve AWPB - Provincial') || User::userIsAllowedTo('Approve AWPB - PCO') || User::userIsAllowedTo('Approve AWPB - Ministry')) {
            $right = "";
            $returnpage = "";
            $activitylines = "";
            $subject = "";
            $province = "";
            $awpb_template = \backend\models\AwpbTemplate::find()->where(['status' => \backend\models\AwpbTemplate::STATUS_PUBLISHED])->one();
            $model = new AwpbBudget();
            $searchModel = new AwpbBudgetSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            $user = User::findOne(['id' => Yii::$app->user->id]);
            $pro = \backend\models\Provinces::findOne($id);
            $status1 = 0;
            $email_users = 0;
            if (!empty($awpb_template)) {
                if (!empty($pro)) {
                    $province = $pro->name;
                }
                if (User::userIsAllowedTo("Submit District AWPB") && ( $user->district_id > 0 || $user->district_id != '')) {

                    $dataProvider->query->andFilterWhere(['awpb_template_id' => $awpb_template->id, 'district_id' => $user->district_id, 'status' => AwpbBudget::STATUS_DRAFT,]);
                    $activitylines = AwpbBudget::find()->where(['district_id' => $user->district_id])->andWhere(['awpb_template_id' => $awpb_template->id])->andWhere(['status' => AwpbBudget::STATUS_DRAFT])->all();
                    $returnpage = "index";
                    $district = \backend\models\Districts::findOne($user->district_id)->name;
                    $right = "Approve AWPB - Provincial";
                    $dear = "Dear Provincial Officer";
                    $bodymsg = "We have submitted our";
                    $bodymsg1 = " for your review and approval.";
                    $subject = $awpb_template->fiscal_year . "AWPB for " . $district . "District Submitted for ";
                    $loca = "district_id";
                    $awpb_district = \backend\models\AwpbDistrict::findOne(['awpb_template_id' => $awpb_template->id, 'district_id' => $user->district_id]);
                    $id = $user->district_id;
                    $awpb_district->status = AwpbBudget::STATUS_SUBMITTED;
                    $awpb_district->save();
                    $status = AwpbBudget::STATUS_SUBMITTED;
//                $awpb_province = \backend\models\AwpbProvince::findOne(['awpb_template_id' => $id, 'province_id' => $user->province_id]);
//                $awpb_province->status = AwpbBudget::STATUS_SUBMITTED;
//                $awpb_province->save();
                    $email_users = 1;
                } elseif (User::userIsAllowedTo("Approve AWPB - Provincial") && ($user->province_id > 0 || $user->province_id !== '')) {
                    $dataProvider->query->andFilterWhere(['awpb_template_id' => $awpb_template->id, 'province_id' => $user->province_id, 'status' => AwpbBudget::STATUS_SUBMITTED,]);
                    $activitylines = AwpbBudget::find()->where(['province_id' => $user->province_id])->andWhere(['awpb_template_id' => $awpb_template->id])->andWhere(['status' => AwpbBudget::STATUS_SUBMITTED])->all();
                    $returnpage = 'mpc';
                    //$province = \backend\models\Provinces::findOne($id2)->name;
                    $right = "Approve AWPB - PCO";
                    $dear = "Dear PCO";
                    $bodymsg = "We have submitted our";
                    $bodymsg1 = " for your review and approval.";
                    $subject = $awpb_template->fiscal_year . "AWPB for " . $province . " Province Submitted for Approval";
                    $status1 = AwpbBudget:: STATUS_DRAFT;
                    $loca = "province_id";
                    $id2 = $user->province_id;
                    $awpb_province = \backend\models\AwpbProvince::findOne(['awpb_template_id' => $awpb_template->id, 'province_id' => $user->province_id]);
                    $awpb_province->status = AwpbBudget::STATUS_REVIEWED;
                    $awpb_province->save();
                    $status = AwpbBudget::STATUS_REVIEWED;
                    $_awpb_district = AwpbDistrict::find()->where(['awpb_template_id' => $awpb_template->id])->andWhere(['province_id' => $id])->all();

                    if (!empty($_awpb_district)) {
                        foreach ($_awpb_district as $district) {
                            $district->status = AwpbBudget::STATUS_REVIEWED;

                            $district->save();
                        }
                    }
                    $email_users = 1;
                } elseif (User::userIsAllowedTo('Approve AWPB - PCO') && ( $user->province_id == 0 || $user->province_id == '')) {
                    $dataProvider->query->andFilterWhere(['awpb_template_id' => $awpb_template->id, 'province_id' => $id, 'status' => AwpbBudget::STATUS_REVIEWED,]);
                    $activitylines = AwpbBudget::find()->where(['province_id' => $id])->andWhere(['awpb_template_id' => $awpb_template->id])->andWhere(['status' => AwpbBudget::STATUS_REVIEWED])->all();
                    $returnpage = "mp";
                    $right = "Approve AWPB - Ministry";
                    $dear = "Dear Ministry";
                    $bodymsg = "We have submitted the ";
                    $bodymsg1 = " for your final review and approval.";
                    $subject = $awpb_template->fiscal_year . " AWPB Submitted for Approval";
                    $status1 = AwpbBudget:: STATUS_REVIEWED;
                    $loca = "province_id";
                    $awpb_province = \backend\models\AwpbProvince::findOne(['awpb_template_id' => $awpb_template->id, 'province_id' => $id]);
                    $awpb_province->status = AwpbBudget::STATUS_APPROVED;
                    $awpb_province->save();
                    $status = AwpbBudget::STATUS_APPROVED;
                    $_awpb_district = AwpbDistrict::find()->where(['awpb_template_id' => $awpb_template->id])->andWhere(['province_id' => $id])->all();

                    if (!empty($_awpb_district)) {
                        foreach ($_awpb_district as $district) {
                            $district->status = AwpbBudget::STATUS_APPROVED;

                            $district->save();
                        }
                    }
                    $email_users = 1;
                } elseif (User::userIsAllowedTo('Approve AWPB - Ministry') && ($user->province_id == 0 || $user->province_id == '')) {
                    // $dataProvider->query->andFilterWhere(['awpb_template_id' => $awpb_template->id, 'province_id' => $id, 'status' => AwpbBudget::STATUS_APPROVED,]);
                    // $activitylines = AwpbBudget::find()->where(['province_id' => $id])->andWhere(['awpb_template_id' => $awpb_template->id])->andWhere(['status' => AwpbBudget::STATUS_APPROVED])->all();
                    $returnpage = "mp";
                    $right = "View AWPB";
                    $dear = "Dear All";
                    $bodymsg = "The";
                    $bodymsg1 = " has been approved.";
                    $subject = $awpb_template->fiscal_year . "AWPB Approved";
                    $status1 = AwpbBudget:: STATUS_APPROVED;
                    $loca = "province_id";
                    $awpb_province = \backend\models\AwpbProvince::findOne(['awpb_template_id' => $awpb_template->id, 'province_id' => $id]);
                    $awpb_province->status = AwpbBudget::STATUS_MINISTRY;
                    $awpb_province->save();
                    $status = AwpbBudget::STATUS_MINISTRY;

                    $_awpb_district = AwpbDistrict::find()->where(['awpb_template_id' => $awpb_template->id])->andWhere(['province_id' => $id])->all();

                    if (!empty($_awpb_district)) {
                        foreach ($_awpb_district as $district) {
                            $district->status = AwpbBudget::STATUS_MINISTRY;

                            $district->save();
                        }
                    }
                    $email_users = 1;
                } else {
                    $email_users = 0;
                }
                if ($email_users == 1) {
                    $role_model = \common\models\RightAllocation::find()->where(['right' => $right])->all();
                    if (!empty($role_model)) {

                        foreach ($role_model as $_role) {
                            //We now get all users with the fetched role
                            //  $resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/login']);

                            $_user_model = "";

                            $_user_model = User::find()
                                    ->where(['role' => $_role->role])
                                    ->andWhere([$loca => $id])
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
                    Yii::$app->session->setFlash('success', 'The AWPB has been submitted successfully.');
                    return $this->redirect(['home/home']);
                } else {
                    Yii::$app->session->setFlash('error', 'You can not submit or approve a budget.');

                    return $this->redirect(['home/home']);
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
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    public function actionSubmitpw($id) {

        $user = User::findOne(['id' => Yii::$app->user->id]);
        $email_users = 0;
        if (User::userIsAllowedTo("Manage PW AWPB") || User::userIsAllowedTo('Approve AWPB - PCO') || User::userIsAllowedTo('Approve AWPB - Ministry')) {
            $right = "";
            $returnpage = "";
            $activitylines = "";
            $subject = "";
            $province = "";
            $awpb_template = \backend\models\AwpbTemplate::find()->where(['status' => \backend\models\AwpbTemplate::STATUS_PUBLISHED])->one();
            $model = new AwpbBudget();
            $searchModel = new AwpbBudgetSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            $user = User::findOne(['id' => Yii::$app->user->id]);

            //$pro = \backend\models\Provinces::findOne($id);
//            $status1 = 0;
//            if (!empty($pro)) {
//                $province = $pro->name;
//            }
            if (User::userIsAllowedTo("Manage PW AWPB") && ($user->province_id == 0 || $user->province_id == '')) {

                $dataProvider->query->andFilterWhere(['awpb_template_id' => $awpb_template->id, 'district_id' => $user->district_id, 'status' => AwpbBudget::STATUS_DRAFT,]);
                $activitylines = AwpbBudget::find()->where(['district_id' => $user->district_id])->andWhere(['awpb_template_id' => $awpb_template->id])->andWhere(['status' => AwpbBudget::STATUS_DRAFT])->all();
                $returnpage = "indexpw";
                $right = "Approve AWPB - PCO";
                $dear = "Dear PCO";
                $bodymsg = "We have submitted our";
                $bodymsg1 = " for your review and approval.";
                $subject = $awpb_template->fiscal_year . "AWPB Submiited for Approval";

                $awpb_template_user = \backend\models\AwpbTemplateUsers::findOne(['awpb_template_id' => $awpb_template->id, 'user_id' => $user->id]);
                $id = $user->id;
                $awpb_template_user->status_budget = AwpbBudget::STATUS_SUBMITTED;
                $awpb_template_user->save();
                //$status = AwpbBudget::STATUS_SUBMITTED;

                $email_users = 1;
            } elseif (User::userIsAllowedTo('Approve AWPB - PCO') && ( $user->province_id == 0 || $user->province_id == '')) {
                //$dataProvider->query->andFilterWhere(['awpb_template_id' => $awpb_template->id, 'province_id' => $id, 'status' => AwpbBudget::STATUS_REVIEWED,]);
                // $activitylines = AwpbBudget::find()->where(['province_id' => $id])->andWhere(['awpb_template_id' => $awpb_template->id])->andWhere(['status' => AwpbBudget::STATUS_REVIEWED])->all();
                $returnpage = "pwc";
                $right = "Approve AWPB - Ministry";
                $dear = "Dear Ministry";
                $bodymsg = "We have submitted the ";
                $bodymsg1 = " for your final review and approval.";
                $subject = $awpb_template->fiscal_year . " AWPB Submitted for Approval";
                // $status1 = AwpbBudget:: STATUS_REVIEWED;
                $loca = "province_id";

                $email_users = 1;
                $awpb_template_component = \backend\models\AwpbTemplateComponent::find(['awpb_template_id' => $awpb_template->id])->all();

                if (!empty($awpb_template_component)) {
                    foreach ($awpb_template_component as $component) {
                        $component->status = AwpbBudget::STATUS_APPROVED;
                        $component->save();
                    }
                }

                $_awpb_template_user = \backend\models\AwpbTemplateUsers::find(['awpb_template_id' => $awpb_template->id])->all();

                if (!empty($_awpb_template_user)) {
                    foreach ($_awpb_template_user as $awpb_template_user) {
                        $awpb_template_user->status_budget = AwpbBudget::STATUS_APPROVED;
                        if ($awpb_template_user->save()) {
                            
                        } else {
                            $message = "";
                            foreach ($$awpb_template_user->getErrors() as $error) {
                                $message .= $error[0];
                            }
                            Yii::$app->session->setFlash('error', 'Error occured while adding AWPB comment::' . $message);
                            //  return $this->redirect(['home/home']);



                            return $this->render('pwc', [
                                        'searchModel' => $searchModel,
                                        // 'model' => $model,
                                        'dataProvider' => $dataProvider,
                                        'show_results' => 1,
                                        'id' => $model->awpb_template_id
                            ]);
                        }
                    }
                }
                //$status = AwpbBudget::STATUS_APPROVED;
            } elseif (User::userIsAllowedTo('Approve AWPB - Ministry') && ($user->province_id == 0 || $user->province_id == '')) {
                // $dataProvider->query->andFilterWhere(['awpb_template_id' => $awpb_template->id, 'province_id' => $id, 'status' => AwpbBudget::STATUS_APPROVED,]);
                // $activitylines = AwpbBudget::find()->where(['province_id' => $id])->andWhere(['awpb_template_id' => $awpb_template->id])->andWhere(['status' => AwpbBudget::STATUS_APPROVED])->all();
                $returnpage = "pwc";
                $right = "View AWPB";
                $dear = "Dear All";
                $bodymsg = "The";
                $bodymsg1 = " has been approved.";
                $subject = $awpb_template->fiscal_year . " AWPB Approved";
                $status1 = AwpbBudget:: STATUS_APPROVED;
                $loca = "province_id";
                $email_users = 1;

                $awpb_template_component = \backend\models\AwpbTemplateComponent::find(['awpb_template_id' => $awpb_template->id])->all();

                if (!empty($awpb_template_component)) {
                    foreach ($awpb_template_component as $component) {
                        $component->status = AwpbBudget::STATUS_MINISTRY;

                        $component->save();
                    }
                }


                $_awpb_template_user = \backend\models\AwpbTemplateUsers::find(['awpb_template_id' => $awpb_template->id])->all();

                if (!empty($_awpb_template_user)) {
                    foreach ($_awpb_template_user as $awpb_template_user) {
                        $awpb_template_user->status_budget = AwpbBudget::STATUS_MINISTRY;
                        $awpb_template_user->save();
                    }
                }
            } else {
                $email_users = 0;
            }
            if ($email_users == 1) {
                $role_model = \common\models\RightAllocation::find()->where(['right' => $right])->all();
                if (!empty($role_model)) {

                    foreach ($role_model as $_role) {
                        //We now get all users with the fetched role
                        //  $resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/login']);

                        $_user_model = "";

                        $_user_model = User::find()
                                ->where(['role' => $_role->role])
                                //  ->andWhere([$loca => $id])
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
                Yii::$app->session->setFlash('success', 'The AWPB has been submitted successfully.');

                return $this->redirect(['home/home']);
            } else {
                Yii::$app->session->setFlash('error', 'You can not submit or approve a budget.');

                return $this->redirect(['home/home']);
            }

//                } else {
//                    Yii::$app->session->setFlash('error', 'No AWPB to submit.');
//                    return $this->render($returnpage, [
//                                'searchModel' => $searchModel,
//                                'model' => $model,
//                                'dataProvider' => $dataProvider,
//                                'id' => $id,
//                                'id2' => $id2,
//                                'status' => $status1,
//                                'editable' => 0
//                    ]);
//                }
            // }
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    public function actionSubmitpw4($id, $status) {
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
            return $this->redirect(['home/home']);
        }
    }

    public function actionDecline() {
        // public function actionDecline($district_id,$awpb_template_id) {
        //$district_id=48;
        // Yii::$app->session->setFlash('success', 'AWPB comment ' .$district.'was successfully added.');
        $model = new \backend\models\AwpbComment();
        $user = User::findOne(['id' => Yii::$app->user->id]);
        $activitylines = "";

        if (User::userIsAllowedTo('Approve AWPB - Provincial') && ($user->province_id != 0 || $user->province_id != '')) {
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

                            // $awpb_province = \backend\models\AwpbProvince::findOne(['awpb_template_id' => $model->awpb_template_id, 'province_id' => $model->province_id]);
                            //$awpb_province->status = \Backend\models\AwpbBudget::STATUS_DRAFT;
                            //$awpb_province->save();
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
        $awpb_template = \backend\models\AwpbTemplate::find()->where(['status' => \backend\models\AwpbTemplate::STATUS_PUBLISHED])->one();
        if (User::userIsAllowedTo('Approve AWBP - PCO') && $user->province_id == 0 || $user->province_id == '') {
            $model = new \backend\models\AwpbComment();

            $status = AwpbBudget::STATUS_SUBMITTED;
            $searchModel = new AwpbBudget();
            $query = $searchModel::find();
            $dear = "";

            $query->select(['awpb_template_id', 'province_id', 'district_id', 'SUM(quarter_one_amount) as quarter_one_amount', 'SUM(quarter_two_amount) as quarter_two_amount', 'SUM(quarter_three_amount) as quarter_three_amount', 'SUM(quarter_four_amount) as quarter_four_amount', 'SUM(total_amount) as total_amount']);
            $query->where(['province_id' => $model->province_id, 'awpb_template_id' => $awpb_template->id, 'status' => AwpbBudget::STATUS_REVIEWED]);
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
                    $awpb_province = \backend\models\AwpbProvince::findOne(['awpb_template_id' => $awpb_template->id, 'province_id' => $model->province_id]);
                    $awpb_province->status = AwpbBudget::STATUS_SUBMITTED;
                    $awpb_province->save();
                    $activitylines = AwpbBudget::find()->where(['province_id' => $model->province_id])->andWhere(['awpb_template_id' => $awpb_template->id])->andWhere(['status' => AwpbBudget::STATUS_REVIEWED])->all();

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
                                    return $this->render('mp', [
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



                    return $this->render('mp', [
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

    public function actionMpcd3($district_id, $province_id, $awpb_template_id, $status) {
        $user = User::findOne(['id' => Yii::$app->user->id]);
        if (User::userIsAllowedTo('Approve AWPB - Provincial') || User::userIsAllowedTo('Approve AWPB - PCO') || User::userIsAllowedTo('Approve AWPB - Ministry')) {
            if (User::userIsAllowedTo("Approve AWPB - Provincial") && ($user->province_id > 0 || $user->province_id !== '')) {
                
            }

            $awpb_district = \backend\models\AwpbDistrict::findOne(['awpb_template_id' => $awpb_template_id, 'district_id' => $district_id]);
            $status = $awpb_district->status;
            $searchModel = new AwpbBudgetSearch();
            $model = new AwpbBudget();
            $query = $searchModel::find();
            $query->select(['awpb_template_id', 'province_id', 'district_id', 'component_id', 'activity_id', 'SUM(quarter_one_amount) as quarter_one_amount', 'SUM(quarter_two_amount) as quarter_two_amount', 'SUM(quarter_three_amount) as quarter_three_amount', 'SUM(quarter_four_amount) as quarter_four_amount', 'SUM(total_amount) as total_amount']);
            $query->where(['awpb_template_id' => $awpb_template_id]);
            $query->andWhere(['=', 'status', $status]);
            $query->andWhere(['=', 'district_id', $district_id]);
            $query->groupBy('activity_id');
            $query->all();

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);

            if ($dataProvider->getCount() <= 0 || $dataProvider->count <= 0) {
                $editable = 0;
                $_searchModel = new AwpbBudget();
                $_query = $searchModel::find();
                $_query->select(['awpb_template_id', 'province_id', 'district_id', 'component_id', 'output_id', 'activity_id', 'SUM(quarter_one_amount) as quarter_one_amount', 'SUM(quarter_two_amount) as quarter_two_amount', 'SUM(quarter_three_amount) as quarter_three_amount', 'SUM(quarter_four_amount) as quarter_four_amount', 'SUM(total_amount) as total_amount']);
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

    public function actionMpcd($id, $id2) {
        $status = 100;
        $user = User::findOne(['id' => Yii::$app->user->id]);
        $awpb_template = \backend\models\AwpbTemplate::find()->where(['status' => AwpbTemplate::STATUS_PUBLISHED])->one();
        if (User::userIsAllowedTo('Approve AWPB - Provincial') || User::userIsAllowedTo('Approve AWPB - PCO') || User::userIsAllowedTo('Approve AWPB - Ministry')) {

            $awpb_province = \backend\models\AwpbProvince::findOne(['awpb_template_id' => $awpb_template->id, 'province_id' => $id2]);
//            if (!empty($awpb_province)) {
//                $status = $awpb_province->status;
//            }

            if (User::userIsAllowedTo("Approve AWPB - Provincial") && ($user->province_id > 0 || $user->province_id !== '')) {
                $status = AwpbBudget::STATUS_SUBMITTED;
            } elseif (User::userIsAllowedTo('Approve AWPB - PCO') && ( $user->province_id == 0 || $user->province_id == '')) {
                $status = AwpbBudget::STATUS_REVIEWED;
            } elseif (User::userIsAllowedTo('Approve AWPB - Ministry') && ($user->province_id == 0 || $user->province_id == '')) {
                $status = AwpbBudget::STATUS_APPROVED;
            } else {
                $status = 100;
            }

            $searchModel = new AwpbBudget();
            $query = $searchModel::find();

            //$query->select(['awpb_budget.awpb_template_id', 'awpb_budget.province_id', 'awpb_district.status', 'awpb_budget.district_id',  'SUM(quarter_one_amount) as quarter_one_amount', 'SUM(quarter_two_amount) as quarter_two_amount', 'SUM(quarter_three_amount) as quarter_three_amount', 'SUM(quarter_four_amount) as quarter_four_amount', 'SUM(total_amount) as total_amount']);

            $query->select(['awpb_budget.awpb_template_id', 'awpb_budget.province_id', 'awpb_district.status', 'awpb_budget.id as id', 'awpb_budget.district_id', 'awpb_budget.component_id', 'awpb_budget.activity_id', 'camp_id', 'SUM(awpb_budget.quarter_one_amount) as quarter_one_amount', 'SUM(awpb_budget.quarter_two_amount) as quarter_two_amount', 'SUM(awpb_budget.quarter_three_amount) as quarter_three_amount', 'SUM(awpb_budget.quarter_four_amount) as quarter_four_amount', 'SUM(awpb_budget.total_amount) as total_amount']);
            $query->leftJoin('district', 'district.id = awpb_budget.district_id');
            $query->leftJoin('awpb_district', 'awpb_district.district_id = district.id');
            $query->where(['awpb_budget.awpb_template_id' => $awpb_template->id]);
            $query->andWhere(['awpb_district.awpb_template_id' => $awpb_template->id]);
            // $query->andWhere(['>=', 'awpb_district.status', $status]);
            $query->andWhere(['=', 'awpb_district.district_id', $id]);
            $query->groupBy('awpb_budget.camp_id');
            $query->all();

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);

            $status1 = 0;
            $count = \backend\models\AwpbDistrict::find()->where(['awpb_template_id' => $awpb_template->id])->andWhere(['=', 'province_id', $id2])->count();
            $count2 = \backend\models\AwpbDistrict::find()->where(['awpb_template_id' => $awpb_template->id])->andWhere(['=', 'province_id', $id2])->andWhere(['=', 'status', $status])->count();
            if ($count !== $count2) {
                $status1 = 1;
            }
            return $this->render('mpcd', [
                        'searchModel' => $searchModel,
                        // 'model' => $model,
                        'dataProvider' => $dataProvider,
                        'show_results' => 1,
                        'id' => $id,
                        'id2' => $id2,
                        'status' => $status,
                        'status1' => $status1,
                        'editable' => 0
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    public function actionMpc($id, $id2) {
        $status = 100;
        $user = User::findOne(['id' => Yii::$app->user->id]);
        $awpb_template = \backend\models\AwpbTemplate::find()->where(['status' => AwpbTemplate::STATUS_PUBLISHED])->one();
        if (User::userIsAllowedTo('Approve AWPB - Provincial') || User::userIsAllowedTo('Approve AWPB - PCO') || User::userIsAllowedTo('Approve AWPB - Ministry')) {
            if (!empty($awpb_template)) {
                $awpb_province = \backend\models\AwpbProvince::findOne(['awpb_template_id' => $awpb_template->id, 'province_id' => $id2]);
//            if (!empty($awpb_province)) {
//                $status = $awpb_province->status;
//            }

                if (User::userIsAllowedTo("Approve AWPB - Provincial") && ($user->province_id > 0 || $user->province_id !== '')) {
                    $status = AwpbBudget::STATUS_SUBMITTED;
                } elseif (User::userIsAllowedTo('Approve AWPB - PCO') && ( $user->province_id == 0 || $user->province_id == '')) {
                    $status = AwpbBudget::STATUS_REVIEWED;
                } elseif (User::userIsAllowedTo('Approve AWPB - Ministry') && ($user->province_id == 0 || $user->province_id == '')) {
                    $status = AwpbBudget::STATUS_APPROVED;
                } else {
                    $status = 100;
                }

                $searchModel = new AwpbBudget();
                $query = $searchModel::find();

                //$query->select(['awpb_budget.awpb_template_id', 'awpb_budget.province_id', 'awpb_district.status', 'awpb_budget.district_id',  'SUM(quarter_one_amount) as quarter_one_amount', 'SUM(quarter_two_amount) as quarter_two_amount', 'SUM(quarter_three_amount) as quarter_three_amount', 'SUM(quarter_four_amount) as quarter_four_amount', 'SUM(total_amount) as total_amount']);

                $query->select(['awpb_budget.awpb_template_id', 'awpb_budget.province_id', 'awpb_district.status', 'awpb_budget.district_id', 'SUM(awpb_budget.quarter_one_amount) as quarter_one_amount', 'SUM(awpb_budget.quarter_two_amount) as quarter_two_amount', 'SUM(awpb_budget.quarter_three_amount) as quarter_three_amount', 'SUM(awpb_budget.quarter_four_amount) as quarter_four_amount', 'SUM(awpb_budget.total_amount) as total_amount']);
                $query->leftJoin('district', 'district.id = awpb_budget.district_id');
                $query->leftJoin('awpb_district', 'awpb_district.district_id = district.id');
                $query->where(['awpb_budget.awpb_template_id' => $awpb_template->id]);
                $query->andWhere(['awpb_district.awpb_template_id' => $awpb_template->id]);
                //    $query->andWhere(['>=', 'awpb_district.status', $status]);
                $query->andWhere(['=', 'awpb_district.province_id', $id2]);
                $query->groupBy('awpb_budget.district_id');
                $query->all();

                $dataProvider = new ActiveDataProvider([
                    'query' => $query,
                ]);

                $status1 = 0;
                $count = \backend\models\AwpbDistrict::find()->where(['awpb_template_id' => $awpb_template->id])->andWhere(['=', 'province_id', $id2])->count();
                $count2 = \backend\models\AwpbDistrict::find()->where(['awpb_template_id' => $awpb_template->id])->andWhere(['=', 'province_id', $id2])->andWhere(['=', 'status', $status])->count();
                if ($count !== $count2) {
                    $status1 = 1;
                }
                return $this->render('mpc', [
                            'searchModel' => $searchModel,
                            // 'model' => $model,
                            'dataProvider' => $dataProvider,
                            'show_results' => 1,
                            'id' => $id,
                            'id2' => $id2,
                            'status' => $status,
                            'status1' => $status1,
                            'editable' => 0
                ]);
            }
//        
//        
            else {
                Yii::$app->session->setFlash('error', 'No AWPB template has been published. Kindly contact the PCO.');
            return $this->redirect(['home/home']);

          }
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    public function actionMp() {
        $user = User::findOne(['id' => Yii::$app->user->id]);
        $time = new \DateTime('now');
        $today = $time->format('Y-m-d');

        $template_id = 0;
        if ((User::userIsAllowedTo('Approve AWPB - PCO')  && ( $user->province_id == 0 || $user->province_id == '')) ||
                (User::userIsAllowedTo("Approve AWPB - Ministry") && ($user->province_id > 0 || $user->province_id !== ''))) {

        $template_model = \backend\models\AwpbTemplate::find()->where(['status' => \backend\models\AwpbTemplate::STATUS_PUBLISHED])->one();
        if (!empty($template_model)) {
            $template_id = $template_model->id;
        
//        if ((User::userIsAllowedTo('Approve AWPB - PCO') && strtotime($template_model->incorpation_deadline_pco_moa_mfl) >= strtotime($today) && ( $user->province_id == 0 || $user->province_id == '')) ||
//                (User::userIsAllowedTo("Approve AWPB - Ministry") && strtotime($template_model->submission_deadline_ifad) >= strtotime($today) && ($user->province_id > 0 || $user->province_id !== ''))) {


            $searchModel = new AwpbBudget();
            $query = $searchModel::find();

            $query->select(['awpb_budget.awpb_template_id', 'awpb_budget.province_id', 'awpb_province.status', 'SUM(quarter_one_amount) as quarter_one_amount', 'SUM(quarter_two_amount) as quarter_two_amount', 'SUM(quarter_three_amount) as quarter_three_amount', 'SUM(quarter_four_amount) as quarter_four_amount', 'SUM(total_amount) as total_amount']);

            $query->leftJoin('province', 'province.id = awpb_budget.province_id');
            $query->leftJoin('awpb_province', 'awpb_province.province_id = province.id');

            $query->where(['awpb_budget.awpb_template_id' => $template_id]);
            $query->andWhere(['awpb_province.awpb_template_id' => $template_id]);

            // $query->andWhere(['>=', 'awpb_province.status', AwpbBudget::STATUS_REVIEWED]);
            $query->groupBy('awpb_budget.province_id');
            $query->all();

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);
            return $this->render('mp', [
                        'searchModel' => $searchModel,
                        // 'model' => $model,
                        'dataProvider' => $dataProvider,
                        'show_results' => 1,
                        'id' => $template_id,
                        // 'status' => $status,
                        'editable' => 0]);
        } else {
            Yii::$app->session->setFlash('error', 'No AWPB Template has been published. Kindly contact PCO');
            return $this->redirect(['home/home']);
        }
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    public function actionPwc() {
        $user = User::findOne(['id' => Yii::$app->user->id]);
        $editable = 1;
        $template_model = \backend\models\AwpbTemplate::find()->where(['status' => \backend\models\AwpbTemplate::STATUS_PUBLISHED])->one();
        //  $awpb_template_component = \backend\models\AwpbTemplateComponent::findOne(['awpb_template_id' =>$model->awpb_template_id, 'district_id'=>$user->district_id]);
        $status = 100;
        $status1 = 1;
        $template_id = 0;
        if ((User::userIsAllowedTo('Approve AWPB - PCO') || User::userIsAllowedTo('Approve AWPB - Ministry')) && ($user->province_id == 0 || $user->province_id == '')) {

            if (!empty($template_model)) {
                $template_id = $template_model->id;

                $searchModel = new AwpbBudget();
                $query = $searchModel::find();
                $query->select(['awpb_budget.awpb_template_id', 'awpb_component.parent_component_id as component_id', 'SUM(quarter_one_amount) as quarter_one_amount', 'SUM(quarter_two_amount) as quarter_two_amount', 'SUM(quarter_three_amount) as quarter_three_amount', 'SUM(quarter_four_amount) as quarter_four_amount', 'SUM(total_amount) as total_amount']);
                //  $query->leftJoin('awpb_template_users', 'awpb_template_users.user_id = awpb_budget.created_by');
                $query->leftJoin('awpb_component', 'awpb_component.id = awpb_budget.component_id');
                $query->leftJoin('awpb_template_component', 'awpb_template_component.component_id = awpb_component.id');
                $query->where(['awpb_budget.awpb_template_id' => $template_id]);
                // $query->andWhere(['awpb_template_component.awpb_template_id' => $awpb_template->id]);
                //  $query->andWhere(['awpb_component.type' => 0]);   
               // $query->groupBy('awpb_budget.component_id');
                 $query->groupBy('awpb_component.parent_component_id');
                $query->all();

                $dataProvider = new ActiveDataProvider([
                    'query' => $query,
                ]);
            
            return $this->render('pwc', [
                        'searchModel' => $searchModel,
                        // 'model' => $model,
                        'dataProvider' => $dataProvider,
                        'show_results' => 1,
                        'id' => $template_id,
                        'status' => $status,
                        'status1' => $status1,
                        'editable' => 0]);
            }
            else
            {
                 Yii::$app->session->setFlash('error', 'No AWPB Templatehas been published.');
            return $this->redirect(['home/home']);
            }
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }
 public function actionPwcsub($id) {
        $user = User::findOne(['id' => Yii::$app->user->id]);
        $editable = 1;
        $template_model = \backend\models\AwpbTemplate::find()->where(['status' => \backend\models\AwpbTemplate::STATUS_PUBLISHED])->one();
        //  $awpb_template_component = \backend\models\AwpbTemplateComponent::findOne(['awpb_template_id' =>$model->awpb_template_id, 'district_id'=>$user->district_id]);
        $status = 100;
        $status1 = 1;
        $template_id = 0;
        if ((User::userIsAllowedTo('Approve AWPB - PCO') || User::userIsAllowedTo('Approve AWPB - Ministry')) && ($user->province_id == 0 || $user->province_id == '')) {

            if (!empty($template_model)) {
                $template_id = $template_model->id;

                $searchModel = new AwpbBudget();
                $query = $searchModel::find();
                $query->select(['awpb_budget.awpb_template_id', 'awpb_budget.component_id', 'SUM(quarter_one_amount) as quarter_one_amount', 'SUM(quarter_two_amount) as quarter_two_amount', 'SUM(quarter_three_amount) as quarter_three_amount', 'SUM(quarter_four_amount) as quarter_four_amount', 'SUM(total_amount) as total_amount']);
                //  $query->leftJoin('awpb_template_users', 'awpb_template_users.user_id = awpb_budget.created_by');
                $query->leftJoin('awpb_component', 'awpb_component.id = awpb_budget.component_id');
                //$query->leftJoin('awpb_template_component', 'awpb_template_component.component_id = awpb_component.id');
                $query->where(['awpb_budget.awpb_template_id' => $template_id]);
                $query->andWhere(['awpb_component.parent_component_id' => $id]);
                //  $query->andWhere(['awpb_component.type' => 0]);   
                $query->groupBy('awpb_budget.component_id');
                // $query->groupBy('awpb_component.parent_component_id');
                $query->all();

                $dataProvider = new ActiveDataProvider([
                    'query' => $query,
                ]);
            }
            return $this->render('pwcsub', [
                        'searchModel' => $searchModel,
                        // 'model' => $model,
                        'dataProvider' => $dataProvider,
                        'show_results' => 1,
                        'id' => $template_id,
                        'status' => $status,
                        'status1' => $status1,
                        'editable' => 0]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

     public function actionPwca($id) {
        $user = User::findOne(['id' => Yii::$app->user->id]);
        $editable = 1;
        $template_model = \backend\models\AwpbTemplate::find()->where(['status' => \backend\models\AwpbTemplate::STATUS_PUBLISHED])->one();
        //  $awpb_template_component = \backend\models\AwpbTemplateComponent::findOne(['awpb_template_id' =>$model->awpb_template_id, 'district_id'=>$user->district_id]);
        $status = 100;
        $status1 = 1;
        $template_id = 0;
        if ((User::userIsAllowedTo('Approve AWPB - PCO') || User::userIsAllowedTo('Approve AWPB - Ministry')) && ($user->province_id == 0 || $user->province_id == '')) {

            if (!empty($template_model)) {
                $template_id = $template_model->id;

                $searchModel = new AwpbBudget();
                $query = $searchModel::find();
                $query->select(['awpb_budget.awpb_template_id','awpb_component.access_level_district as status', 'awpb_activity.parent_activity_id as activity_id', 'SUM(quarter_one_amount) as quarter_one_amount', 'SUM(quarter_two_amount) as quarter_two_amount', 'SUM(quarter_three_amount) as quarter_three_amount', 'SUM(quarter_four_amount) as quarter_four_amount', 'SUM(total_amount) as total_amount']);
                //  $query->leftJoin('awpb_template_users', 'awpb_template_users.user_id = awpb_budget.created_by');
                $query->leftJoin('awpb_activity', 'awpb_activity.id = awpb_budget.activity_id');
                $query->leftJoin('awpb_component', 'awpb_component.id = awpb_activity.component_id');
                $query->where(['awpb_budget.awpb_template_id' => $template_id]);
                $query->andWhere(['awpb_activity.component_id' => $id]);
                //  $query->andWhere(['awpb_component.type' => 0]);   
               // $query->groupBy('awpb_budget.component_id');
                 $query->groupBy('awpb_activity.parent_activity_id');
                $query->all();

                $dataProvider = new ActiveDataProvider([
                    'query' => $query,
                ]);
            }
            return $this->render('pwca', [
                        'searchModel' => $searchModel,
                        // 'model' => $model,
                        'dataProvider' => $dataProvider,
                        'show_results' => 1,
                        'id' => $template_id,
                        'status' => $status,
                        'status1' => $status1,
                        'editable' => 0]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }
   public function actionPwcasub($id, $status) {
        $user = User::findOne(['id' => Yii::$app->user->id]);
        $editable = 1;
        $template_model = \backend\models\AwpbTemplate::find()->where(['status' => \backend\models\AwpbTemplate::STATUS_PUBLISHED])->one();
        //  $awpb_template_component = \backend\models\AwpbTemplateComponent::findOne(['awpb_template_id' =>$model->awpb_template_id, 'district_id'=>$user->district_id]);
       // $status = 100;
        //$status1 = 1;
        $template_id = 0;
        if ((User::userIsAllowedTo('Approve AWPB - PCO') || User::userIsAllowedTo('Approve AWPB - Ministry')) && ($user->province_id == 0 || $user->province_id == '')) {

            if (!empty($template_model)) {
                $template_id = $template_model->id;

                $searchModel = new AwpbBudget();
                $query = $searchModel::find();
                $query->select(['awpb_budget.awpb_template_id', 'awpb_budget.activity_id',  'SUM(quarter_one_amount) as quarter_one_amount', 'SUM(quarter_two_amount) as quarter_two_amount', 'SUM(quarter_three_amount) as quarter_three_amount', 'SUM(quarter_four_amount) as quarter_four_amount', 'SUM(total_amount) as total_amount']);
                //  $query->leftJoin('awpb_template_users', 'awpb_template_users.user_id = awpb_budget.created_by');
                $query->leftJoin('awpb_activity', 'awpb_activity.id = awpb_budget.activity_id');
                //$query->leftJoin('awpb_template_component', 'awpb_template_component.component_id = awpb_component.id');
                $query->where(['awpb_budget.awpb_template_id' => $template_id]);
                $query->andWhere(['awpb_activity.parent_activity_id' => $id]);
                //  $query->andWhere(['awpb_component.type' => 0]);   
               // $query->groupBy('awpb_budget.component_id');
                 $query->groupBy('awpb_budget.activity_id');
                 //$query->groupBy('awpb_budget.district_id');
                 //$query->groupBy('camp_id');
                $query->all();

                $dataProvider = new ActiveDataProvider([
                    'query' => $query,
                ]);
            }
            return $this->render('pwcasub', [
                        'searchModel' => $searchModel,
                        // 'model' => $model,
                        'dataProvider' => $dataProvider,
                        'show_results' => 1,
                        'id' => $template_id,
                        'status' => $status,
                      //  'status1' => $status1,
                        'editable' => 0,
                        'id2'=>$id             ]
                    
                    );
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }
   
    
    public function actionPwcma($id) {
        $user = User::findOne(['id' => Yii::$app->user->id]);
        $editable = 1;
        $awpb_template = \backend\models\AwpbTemplate::find()->where(['status' => 1])->one();
//        $awpb_district =  \backend\models\AwpbDistrict::findOne(['awpb_template_id' =>$model->awpb_template_id, 'district_id'=>$user->district_id]);
        $status = 100;

        if (User::userIsAllowedTo('Approve AWPB - Provincial') || User::userIsAllowedTo('Approve AWPB - PCO') || User::userIsAllowedTo('Approve AWPB - Ministry')) {
            if (User::userIsAllowedTo('Approve AWPB - PCO') && ($user->province_id == 0 || $user->province_id == '')) {

                $searchModel = new AwpbBudget();
                $query = $searchModel::find();

                $query->select(['awpb_budget.awpb_template_id', 'awpb_budget.id', 'component_id', 'awpb_budget.activity_id', 'awpb_budget.created_by', 'SUM(quarter_one_amount) as quarter_one_amount', 'SUM(quarter_two_amount) as quarter_two_amount', 'SUM(quarter_three_amount) as quarter_three_amount', 'SUM(quarter_four_amount) as quarter_four_amount', 'SUM(total_amount) as total_amount']);

                $query->leftJoin('users', 'users.id = awpb_budget.created_by');
                $query->leftJoin('awpb_template_users', 'awpb_template_users.user_id = users.id');
                $query->where(['awpb_budget.awpb_template_id' => $awpb_template->id]);
                $query->andWhere(['awpb_template_users.awpb_template_id' => $awpb_template->id]);

                $query->andWhere(['>=', 'awpb_template_users.status_budget', AwpbBudget::STATUS_SUBMITTED]);
                $query->andWhere(['awpb_budget.created_by' => $id]);
                $query->groupBy('awpb_budget.activity_id');
                $query->all();

                $dataProvider = new ActiveDataProvider([
                    'query' => $query,
                ]);
                return $this->render('pwca', [
                            'searchModel' => $searchModel,
                            // 'model' => $model,
                            'dataProvider' => $dataProvider,
                            'show_results' => 1,
                            'id' => $awpb_template->id,
                            'status' => $status,
                            'editable' => 0]);
            } elseif (User::userIsAllowedTo('Approve AWPB - Ministry') && ($user->province_id == 0 || $user->province_id == '')) {
                $searchModel = new AwpbBudget();
                $query = $searchModel::find();

                $query->select(['awpb_budget.awpb_template_id', 'awpb_budget.id', 'component_id', 'activity_id', 'SUM(quarter_one_amount) as quarter_one_amount', 'SUM(quarter_two_amount) as quarter_two_amount', 'SUM(quarter_three_amount) as quarter_three_amount', 'SUM(quarter_four_amount) as quarter_four_amount', 'SUM(total_amount) as total_amount']);

                $query->leftJoin('users', 'users.id = awpb_budget.created_by');
                $query->leftJoin('awpb_template_users', 'awpb_template_users.user_id = users.id');
                $query->where(['awpb_budget.awpb_template_id' => $awpb_template->id]);
                $query->andWhere(['awpb_template_users.awpb_template_id' => $awpb_template->id]);

                $query->andWhere(['>=', 'awpb_template_users.status_budget', AwpbBudget::STATUS_APPROVED]);
                $query->andWhere(['awpb_budget.component_id' => $id]);
                $query->groupBy('awpb_budget.activity_id');
                $query->all();

                $dataProvider = new ActiveDataProvider([
                    'query' => $query,
                ]);
                return $this->render('pwca', [
                            'searchModel' => $searchModel,
                            // 'model' => $model,
                            'dataProvider' => $dataProvider,
                            'show_results' => 1,
                            'id' => $awpb_template->id,
                            'status' => $status,
                            'editable' => 0]);
            } else {
                $searchModel = new AwpbBudget();
                $searchModel = new AwpbBudget();
                $query = $searchModel::find();

                $query->select(['awpb_budget.awpb_template_id', 'component_id', 'SUM(quarter_one_amount) as quarter_one_amount', 'SUM(quarter_two_amount) as quarter_two_amount', 'SUM(quarter_three_amount) as quarter_three_amount', 'SUM(quarter_four_amount) as quarter_four_amount', 'SUM(total_amount) as total_amount']);

                $query->leftJoin('users', 'users.id = awpb_budget.created_id');
                $query->leftJoin('awpb_template_users', 'awpb_template_users.user_id = users.id');
                $query->where(['awpb_budget.awpb_template_id' => $awpb_template->id]);
                $query->andWhere(['awpb_template_users.awpb_template_id' => $awpb_template->id]);

                $query->andWhere(['>=', 'awpb_template_users.status_budget', 100]);
                $query->groupBy('awpb_budget.component_id');
                $query->all();
                $dataProvider = new ActiveDataProvider([
                    'query' => $query,
                ]);
                return $this->render('pwc', [
                            'searchModel' => $searchModel,
                            // 'model' => $model,
                            'dataProvider' => $dataProvider,
                            'show_results' => 1,
                            'id' => $awpb_template->id,
                            // 'status' => $status,
                            'editable' => 0]);
            }
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    public function actionPwcu($id) {
        $user = User::findOne(['id' => Yii::$app->user->id]);
        $editable = 1;
        $awpb_template = \backend\models\AwpbTemplate::find()->where(['status' => 1])->one();
//        $awpb_district =  \backend\models\AwpbDistrict::findOne(['awpb_template_id' =>$model->awpb_template_id, 'district_id'=>$user->district_id]);
        $status = 100;

        if (User::userIsAllowedTo('Approve AWPB - Provincial') || User::userIsAllowedTo('Approve AWPB - PCO') || User::userIsAllowedTo('Approve AWPB - Ministry')) {
            if (User::userIsAllowedTo('Approve AWPB - PCO') && ($user->province_id == 0 || $user->province_id == '')) {

                $searchModel = new AwpbBudget();
                $query = $searchModel::find();

                $query->select(['awpb_budget.awpb_template_id', 'awpb_budget.id', 'component_id', 'activity_id', 'awpb_template_users.status_budget as status', 'awpb_budget.created_by', 'SUM(quarter_one_amount) as quarter_one_amount', 'SUM(quarter_two_amount) as quarter_two_amount', 'SUM(quarter_three_amount) as quarter_three_amount', 'SUM(quarter_four_amount) as quarter_four_amount', 'SUM(total_amount) as total_amount']);

                $query->leftJoin('users', 'users.id = awpb_budget.created_by');
                $query->leftJoin('awpb_template_users', 'awpb_template_users.user_id = users.id');
                $query->where(['awpb_budget.awpb_template_id' => $awpb_template->id]);
                $query->andWhere(['awpb_template_users.awpb_template_id' => $awpb_template->id]);

                $query->andWhere(['>=', 'awpb_template_users.status_budget', AwpbBudget::STATUS_SUBMITTED]);
                $query->andWhere(['awpb_budget.component_id' => $id]);
                $query->groupBy('awpb_budget.created_by');
                $query->all();

                $dataProvider = new ActiveDataProvider([
                    'query' => $query,
                ]);
                $status1 = 0;
                $count = \backend\models\AwpbTemplateComponent::find()->where(['awpb_template_id' => $awpb_template->id])->count();
                $count2 = \backend\models\AwpbTemplateComponent::find()->where(['awpb_template_id' => $awpb_template->id])->andWhere(['=', 'status', AwpbBudget::STATUS_DRAFT])->count();
                if ($count !== $count2) {
                    $status1 = 1;
                }
                return $this->render('pwcu', [
                            'searchModel' => $searchModel,
                            // 'model' => $model,
                            'dataProvider' => $dataProvider,
                            'show_results' => 1,
                            'id' => $awpb_template->id,
                            'status' => $status,
                            'status1' => $status1,
                            'editable' => 0]);
            } elseif (User::userIsAllowedTo('Approve AWPB - Ministry') && ($user->province_id == 0 || $user->province_id == '')) {
                $searchModel = new AwpbBudget();
                $query = $searchModel::find();

                $query->select(['awpb_budget.awpb_template_id', 'awpb_budget.id', 'component_id', 'activity_id', 'SUM(quarter_one_amount) as quarter_one_amount', 'SUM(quarter_two_amount) as quarter_two_amount', 'SUM(quarter_three_amount) as quarter_three_amount', 'SUM(quarter_four_amount) as quarter_four_amount', 'SUM(total_amount) as total_amount']);

                $query->leftJoin('users', 'users.id = awpb_budget.created_by');
                $query->leftJoin('awpb_template_users', 'awpb_template_users.user_id = users.id');
                $query->where(['awpb_budget.awpb_template_id' => $awpb_template->id]);
                $query->andWhere(['awpb_template_users.awpb_template_id' => $awpb_template->id]);

                $query->andWhere(['>=', 'awpb_template_users.status_budget', AwpbBudget::STATUS_APPROVED]);
                $query->andWhere(['awpb_budget.component_id' => $id]);
                $query->groupBy('awpb_budget.created_by');
                $query->all();

                $dataProvider = new ActiveDataProvider([
                    'query' => $query,
                ]);
                return $this->render('pwcu', [
                            'searchModel' => $searchModel,
                            // 'model' => $model,
                            'dataProvider' => $dataProvider,
                            'show_results' => 1,
                            'id' => $awpb_template->id,
                            'status' => $status,
                            'editable' => 0]);
            } else {
                $searchModel = new AwpbBudget();
                $searchModel = new AwpbBudget();
                $query = $searchModel::find();

                $query->select(['awpb_budget.awpb_template_id', 'component_id', 'SUM(quarter_one_amount) as quarter_one_amount', 'SUM(quarter_two_amount) as quarter_two_amount', 'SUM(quarter_three_amount) as quarter_three_amount', 'SUM(quarter_four_amount) as quarter_four_amount', 'SUM(total_amount) as total_amount']);

                $query->leftJoin('users', 'users.id = awpb_budget.created_id');
                $query->leftJoin('awpb_template_users', 'awpb_template_users.user_id = users.id');
                $query->where(['awpb_budget.awpb_template_id' => $awpb_template->id]);
                $query->andWhere(['awpb_template_users.awpb_template_id' => $awpb_template->id]);

                $query->andWhere(['>=', 'awpb_template_users.status_budget', 100]);
                $query->groupBy('awpb_budget.component_id');
                $query->all();
                $dataProvider = new ActiveDataProvider([
                    'query' => $query,
                ]);
                return $this->render('pwc', [
                            'searchModel' => $searchModel,
                            // 'model' => $model,
                            'dataProvider' => $dataProvider,
                            'show_results' => 1,
                            'id' => $awpb_template->id,
                            // 'status' => $status,
                            'editable' => 0]);
            }
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    public function actionPwcau($id) {
        $user = User::findOne(['id' => Yii::$app->user->id]);
        $editable = 1;
        $awpb_template = \backend\models\AwpbTemplate::find()->where(['status' => 1])->one();
        //  $awpb_template_component = \backend\models\AwpbTemplateComponent::findOne(['awpb_template_id' =>$model->awpb_template_id, 'district_id'=>$user->district_id]);
        $status = 100;

        if (User::userIsAllowedTo('Approve AWPB - Provincial') || User::userIsAllowedTo('Approve AWPB - PCO') || User::userIsAllowedTo('Approve AWPB - Ministry')) {
            if (User::userIsAllowedTo('Approve AWPB - PCO') && ($user->province_id == 0 || $user->province_id == '')) {

                $searchModel = new AwpbBudget();
                $query = $searchModel::find();

                $query->select(['awpb_budget.awpb_template_id', 'component_id', 'awpb_budget.id', 'awpb_budget.cost_centre_id', 'awpb_budget.activity_id', 'SUM(awpb_budget.quarter_one_amount) as quarter_one_amount', 'SUM(awpb_budget.quarter_two_amount) as quarter_two_amount', 'SUM(awpb_budget.quarter_three_amount) as quarter_three_amount', 'SUM(awpb_budget.quarter_four_amount) as quarter_four_amount', 'SUM(awpb_budget.total_amount) as total_amount']);
                $query->leftJoin('users', 'users.id = awpb_budget.created_by');
                $query->leftJoin('awpb_template_users', 'awpb_template_users.user_id = users.id');

                $query->leftJoin('awpb_cost_centre', 'awpb_cost_centre.id = awpb_budget.cost_centre_id');
                $query->leftJoin('awpb_district', 'awpb_district.cost_centre_id = awpb_cost_centre.id');

                $query->where(['awpb_district.awpb_template_id' => $awpb_template->id]);

                $query->andWhere(['awpb_template_users.awpb_template_id' => $awpb_template->id]);

                $query->andWhere(['awpb_budget.awpb_template_id' => $awpb_template->id]);

                $query->andWhere(['>=', 'awpb_template_users.status_budget', AwpbBudget::STATUS_SUBMITTED]);

                $query->andWhere(['>=', 'awpb_district.status', AwpbBudget::STATUS_DRAFT]);
                $query->andWhere(['awpb_budget.activity_id' => $id]);
                $query->groupBy('awpb_budget.cost_centre_id');
                $query->all();
                $dataProvider = new ActiveDataProvider([
                    'query' => $query,
                ]);
                return $this->render('pwcau', [
                            'searchModel' => $searchModel,
                            // 'model' => $model,
                            'dataProvider' => $dataProvider,
                            'show_results' => 1,
                            'id' => $id,
                            'status' => $status,
                            'editable' => 0]);
            } elseif (User::userIsAllowedTo('Approve AWPB - Ministry') && ($user->province_id == 0 || $user->province_id == '')) {
                $searchModel = new AwpbBudget();
                $query = $searchModel::find();

                $query->select(['awpb_budget.awpb_template_id', 'component_id', 'awpb_budget.id', 'awpb_budget.cost_centre_id', 'awpb_budget.activity_id', 'SUM(awpb_budget.quarter_one_amount) as quarter_one_amount', 'SUM(awpb_budget.quarter_two_amount) as quarter_two_amount', 'SUM(awpb_budget.quarter_three_amount) as quarter_three_amount', 'SUM(awpb_budget.quarter_four_amount) as quarter_four_amount', 'SUM(awpb_budget.total_amount) as total_amount']);
                $query->leftJoin('users', 'users.id = awpb_budget.created_by');
                $query->leftJoin('awpb_template_users', 'awpb_template_users.user_id = users.id');

                $query->leftJoin('awpb_cost_centre', 'awpb_cost_centre.id = awpb_budget.cost_centre_id');
                $query->leftJoin('awpb_district', 'awpb_district.cost_centre_id = awpb_cost_centre.id');

                $query->where(['awpb_district.awpb_template_id' => $awpb_template->id]);

                $query->andWhere(['awpb_template_users.awpb_template_id' => $awpb_template->id]);

                $query->andWhere(['awpb_budget.awpb_template_id' => $awpb_template->id]);

                $query->andWhere(['>=', 'awpb_template_users.status_budget', AwpbBudget::STATUS_SUBMITTED]);

                $query->andWhere(['>=', 'awpb_district.status', AwpbBudget::STATUS_DRAFT]);
                $query->andWhere(['awpb_budget.activity_id' => $id]);
                $query->groupBy('awpb_budget.cost_centre_id');
                $query->all();
                $dataProvider = new ActiveDataProvider([
                    'query' => $query,
                ]);

//                $query->select(['awpb_budget.awpb_template_id', 'component_id', 'cost_centre_id', 'activity_id', 'awpb_budget.created_by', 'awpb_budget.id', 'SUM(quarter_one_amount) as quarter_one_amount', 'SUM(quarter_two_amount) as quarter_two_amount', 'SUM(quarter_three_amount) as quarter_three_amount', 'SUM(quarter_four_amount) as quarter_four_amount', 'SUM(total_amount) as total_amount']);
//
//                $query->leftJoin('users', 'users.id = awpb_budget.created_by');
//                $query->leftJoin('awpb_template_users', 'awpb_template_users.user_id = users.id');
//                $query->where(['awpb_budget.awpb_template_id' => $awpb_template->id]);
//                $query->andWhere(['awpb_template_users.awpb_template_id' => $awpb_template->id]);
//                //$query->andWhere(['awpb_component.access_level_programme' => 1]);
//                $query->andWhere(['>=', 'awpb_template_users.status_budget', AwpbBudget::STATUS_APPROVED]);
//                $query->groupBy('awpb_budget.cost_centre_id');
//                $query->all();



                return $this->render('pwcau', [
                            'searchModel' => $searchModel,
                            // 'model' => $model,
                            'dataProvider' => $dataProvider,
                            'show_results' => 1,
                            'id' => $id,
                            'status' => $status,
                            'editable' => 0]);
                $dataProvider = new ActiveDataProvider([
                    'query' => $query,
                ]);
            } else {

                $searchModel = new AwpbBudget();
                $query = $searchModel::find();

                $query->select(['awpb_budget.awpb_template_id', 'component_id', 'SUM(quarter_one_amount) as quarter_one_amount', 'SUM(quarter_two_amount) as quarter_two_amount', 'SUM(quarter_three_amount) as quarter_three_amount', 'SUM(quarter_four_amount) as quarter_four_amount', 'SUM(total_amount) as total_amount']);

                $query->leftJoin('users', 'users.id = awpb_budget.created_id');
                $query->leftJoin('awpb_template_users', 'awpb_template_users.user_id = users.id');
                $query->where(['awpb_budget.awpb_template_id' => $awpb_template->id]);
                $query->andWhere(['awpb_template_users.awpb_template_id' => $awpb_template->id]);

                $query->andWhere(['>=', 'awpb_template_users.status_budget', 100]);
                $query->groupBy('awpb_budget.component_id');
                $query->all();
                $dataProvider = new ActiveDataProvider([
                    'query' => $query,
                ]);
                return $this->render('pwcua', [
                            'searchModel' => $searchModel,
                            // 'model' => $model,
                            'dataProvider' => $dataProvider,
                            'show_results' => 1,
                            'id' => $id,
                            // 'status' => $status,
                            'editable' => 0]);
            }
        } else {
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
            return $this->redirect(['home/home']);
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
