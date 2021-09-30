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
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use backend\models\Storyofchange;
use backend\models\AwpbTemplate;

/**
 * AwpbActivityLineController implements the CRUD actions for AwpbActivityLine model.
 */
class AwpbActivityLineController extends Controller
{
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
     * Lists all AwpbActivityLine models.
     * @return mixed
     */
    public function actionIndex($id)
    {

        $user = User::findOne(['id' => Yii::$app->user->id]);
        $searchModel = new AwpbActivityLineSearch();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $dataProvider->query->andFilterWhere(['awpb_template_id' => $id, 'district_id' => $user->district_id, 'created_by' => $user->id, 'status' => AWPBActivityLine::STATUS_DRAFT,]);
     //  $dataProvider->query->Where(['province_id' => null, 'awpb_template_id' => $id, 'created_by' =>  Yii::$app->user->id, 'status' => AWPBActivityLine::STATUS_DRAFT]);
      
       return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'id' => $id
        ]);
    }
    public function actionIndexpw($id)
    {

        $user = User::findOne(['id' => Yii::$app->user->id]);
        $searchModel = new AwpbActivityLineSearch();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $dataProvider->query->Where(['province_id' => null, 'awpb_template_id' => $id, 'created_by' =>  Yii::$app->user->id, 'status' => AWPBActivityLine::STATUS_DRAFT]);
        return $this->render('indexpw', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'id' => $id
        ]);
    }

    /**
     * Displays a single AwpbActivityLine model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */

     
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
    
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionViewp($id)
    {
        return $this->render('viewp', [
            'model' => $this->findModel($id),
        ]);
    }
    public function actionViewo($id)
    {
        return $this->render('viewo', [
            'model' => $this->findModel($id),
        ]);
    }
    public function actionViewm($id)
    {
        return $this->render('viewm', [
            'model' => $this->findModel($id),
        ]);
    }
    public function actionViewpw($id)
    {
        return $this->render('viewpw', [
            'model' => $this->findModel($id),
        ]);
    }
    public function actionViewpwpco($id)
    {
        return $this->render('viewpwpco', [
            'model' => $this->findModel($id),
        ]);
    }
    public function actionViewpwm($id)
    {
        return $this->render('viewpwm', [
            'model' => $this->findModel($id),
        ]);
    }
    public function actionUpdate($id)
    {
        if (User::userIsAllowedTo('Manage AWPB Indicator')) {
            $model = $this->findModel($id);

            // $model = new AwpbActivityLine();
            if (Yii::$app->request->isAjax) {
                $model->load(Yii::$app->request->post());
                return Json::encode(\yii\widgets\ActiveForm::validate($model));
            }

            if ($model->load(Yii::$app->request->post())) {

                $total_q = 0;
                $total_amt = 0.0;
                $total_q_mo1 = !empty($model->mo_1) ? $model->mo_1 : 0;
                $total_q_mo2 = !empty($model->mo_2)  ? $model->mo_2 : 0;
                $total_q_mo3 = !empty($model->mo_3) ? $model->mo_3 : 0;
                $total_q_mo4  = !empty($model->mo_4) ? $model->mo_4 : 0;
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
                $total_q4 = $total_q_mo10 +  $total_q_mo11 +  $total_q_mo12;


                $total_q =  $total_q1 + $total_q2 + $total_q3 + $total_q4;

                $total_amt =  $model->unit_cost != 0 && $total_q != 0 ? $total_q * $model->unit_cost : 0;

                if ($total_q > 0) {
                    $model->mo_1  = $total_q_mo1;
                    $model->mo_2  = $total_q_mo2;
                    $model->mo_3  =  $total_q_mo3;
                    $model->mo_4  = $total_q_mo4;
                    $model->mo_5  = $total_q_mo5;
                    $model->mo_6  = $total_q_mo6;
                    $model->mo_7  = $total_q_mo7;
                    $model->mo_8  = $total_q_mo8;
                    $model->mo_9  = $total_q_mo9;
                    $model->mo_10  = $total_q_mo10;
                    $model->mo_11  = $total_q_mo11;
                    $model->mo_12  = $total_q_mo12;
                    $model->quarter_one_quantity = $total_q1;
                    $model->quarter_two_quantity = $total_q2;
                    $model->quarter_three_quantity = $total_q3;
                    $model->quarter_four_quantity = $total_q4;
                    $model->total_quantity = $total_q;

                    $model->mo_1_amount  = $total_q_mo1 * $model->unit_cost;
                    $model->mo_2_amount  = $total_q_mo2  * $model->unit_cost;
                    $model->mo_3_amount  =  $total_q_mo3 * $model->unit_cost;
                    $model->mo_4_amount  = $total_q_mo4   * $model->unit_cost;
                    $model->mo_5_amount  = $total_q_mo5  * $model->unit_cost;
                    $model->mo_6_amount  = $total_q_mo6   * $model->unit_cost;
                    $model->mo_7_amount  = $total_q_mo7  * $model->unit_cost;
                    $model->mo_8_amount  = $total_q_mo8   * $model->unit_cost;
                    $model->mo_9_amount  = $total_q_mo9 * $model->unit_cost;
                    $model->mo_10_amount  = $total_q_mo10   * $model->unit_cost;
                    $model->mo_11_amount  = $total_q_mo11  * $model->unit_cost;
                    $model->mo_12_amount  = $total_q_mo12 * $model->unit_cost;
                    $model->quarter_one_amount = $total_q1 * $model->unit_cost;
                    $model->quarter_two_amount = $total_q2 * $model->unit_cost;
                    $model->quarter_three_amount = $total_q3 * $model->unit_cost;
                    $model->quarter_four_amount = $total_q4 * $model->unit_cost;
                    $model->total_amount = $total_amt;

                    $model->total_amount = $total_amt;


                    if ($model->validate()) {

                        if ($model->save()) {

                            $audit = new AuditTrail();
                            $audit->user = Yii::$app->user->id;
                            $audit->action = "Update AWPB Indicator : "  . $model->name." : ".$model->id;
                            $audit->ip_address = Yii::$app->request->getUserIP();
                            $audit->user_agent = Yii::$app->request->getUserAgent();
                            $audit->save();
                            Yii::$app->session->setFlash('success', 'AWPB indicator was successfully updated.');
                        } else {
                            Yii::$app->session->setFlash('error', 'Error occured while updating AWPB indicatore.');
                        }

                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } else {
                    Yii::$app->session->setFlash('error', 'Enter quantity for at least one month.');
                }
            }

            return $this->render('update', [
                'model' => $model,
                
                    'template_id' =>$model->awpb_template_id
          
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['site/home']);
        }
    }

    public function actionUpdatepw($id)
    {
        $user = \backend\models\User::findOne(['id' => Yii::$app->user->id]);

        if (User::userIsAllowedTo('Manage programme-wide AWPB activity lines') && $user->district_id == 0 || $user->district_id == '') {

            //if (User::userIsAllowedTo('Manage AWPB activity lines')) {
            $model = $this->findModel($id);

            // $model = new AwpbActivityLine();
            if (Yii::$app->request->isAjax) {
                $model->load(Yii::$app->request->post());
                return Json::encode(\yii\widgets\ActiveForm::validate($model));
            }

            if ($model->load(Yii::$app->request->post())) {

                $total_q = 0;
                $total_amt = 0.0;
                $total_q_mo1 = !empty($model->mo_1) ? $model->mo_1 : 0;
                $total_q_mo2 = !empty($model->mo_2)  ? $model->mo_2 : 0;
                $total_q_mo3 = !empty($model->mo_3) ? $model->mo_3 : 0;
                $total_q_mo4  = !empty($model->mo_4) ? $model->mo_4 : 0;
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
                $total_q4 = $total_q_mo10 +  $total_q_mo11 +  $total_q_mo12;


                $total_q =  $total_q1 + $total_q2 + $total_q3 + $total_q4;

                $total_amt =  $model->unit_cost != 0 && $total_q != 0 ? $total_q * $model->unit_cost : 0;

                if ($total_q > 0) {
                    $model->mo_1  = $total_q_mo1;
                    $model->mo_2  = $total_q_mo2;
                    $model->mo_3  =  $total_q_mo3;
                    $model->mo_4  = $total_q_mo4;
                    $model->mo_5  = $total_q_mo5;
                    $model->mo_6  = $total_q_mo6;
                    $model->mo_7  = $total_q_mo7;
                    $model->mo_8  = $total_q_mo8;
                    $model->mo_9  = $total_q_mo9;
                    $model->mo_10  = $total_q_mo10;
                    $model->mo_11  = $total_q_mo11;
                    $model->mo_12  = $total_q_mo12;
                    $model->quarter_one_quantity = $total_q1;
                    $model->quarter_two_quantity = $total_q2;
                    $model->quarter_three_quantity = $total_q3;
                    $model->quarter_four_quantity = $total_q4;
                    $model->total_quantity = $total_q;

                    $model->mo_1_amount  = $total_q_mo1 * $model->unit_cost;
                    $model->mo_2_amount  = $total_q_mo2  * $model->unit_cost;
                    $model->mo_3_amount  =  $total_q_mo3 * $model->unit_cost;
                    $model->mo_4_amount  = $total_q_mo4   * $model->unit_cost;
                    $model->mo_5_amount  = $total_q_mo5  * $model->unit_cost;
                    $model->mo_6_amount  = $total_q_mo6   * $model->unit_cost;
                    $model->mo_7_amount  = $total_q_mo7  * $model->unit_cost;
                    $model->mo_8_amount  = $total_q_mo8   * $model->unit_cost;
                    $model->mo_9_amount  = $total_q_mo9 * $model->unit_cost;
                    $model->mo_10_amount  = $total_q_mo10   * $model->unit_cost;
                    $model->mo_11_amount  = $total_q_mo11  * $model->unit_cost;
                    $model->mo_12_amount  = $total_q_mo12 * $model->unit_cost;
                    $model->quarter_one_amount = $total_q1 * $model->unit_cost;
                    $model->quarter_two_amount = $total_q2 * $model->unit_cost;
                    $model->quarter_three_amount = $total_q3 * $model->unit_cost;
                    $model->quarter_four_amount = $total_q4 * $model->unit_cost;
                    $model->total_amount = $total_amt;

                    $model->total_amount = $total_amt;


                    if ($model->validate()) {

                        if ($model->save()) {

                            $audit = new AuditTrail();
                            $audit->user = Yii::$app->user->id;
                            $audit->action = "Update AWPB Activitly Line : "  . $model->name;
                            $audit->ip_address = Yii::$app->request->getUserIP();
                            $audit->user_agent = Yii::$app->request->getUserAgent();
                            $audit->save();
                            Yii::$app->session->setFlash('success', 'AWPB activity line was successfully updated.');
                        } else {
                            Yii::$app->session->setFlash('error', 'Error occured while updating AWPB activity line.');
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

    // public function actionCreate($template_id)
    // {
    //     $model = new AwpbActivityLine();

    //     if ($model->load(Yii::$app->request->post()) && $model->save()) {
    //         return $this->redirect(['view', 'id' => $model->id]);
    //     }

    //       return $this->render('create', [
    //             'model' => $model,
    //             'template_id' =>$template_id
    //         ]);
    // }

    public function actionCreate($template_id)
    {
        if (User::userIsAllowedTo('Manage AWPB activity lines')) {
            $model = new AwpbActivityLine();
            if (Yii::$app->request->isAjax) {
                $model->load(Yii::$app->request->post());
                return Json::encode(\yii\widgets\ActiveForm::validate($model));
            }
            // if (Yii::$app->request->post('addComponent') != 'true' && $model->load(Yii::$app->request->post()) ) {
       
            // if ($model->load(Yii::$app->request->post())) {
            if ($model->load(Yii::$app->request->post()) ) {
		

                $total_q = 0;
                $total_amt = 0.0;
                $total_q_mo1 = !empty($model->mo_1) ? $model->mo_1 : 0;
                $total_q_mo2 = !empty($model->mo_2)  ? $model->mo_2 : 0;
                $total_q_mo3 = !empty($model->mo_3) ? $model->mo_3 : 0;
                $total_q_mo4  = !empty($model->mo_4) ? $model->mo_4 : 0;
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
                $total_q4 = $total_q_mo10 +  $total_q_mo11 +  $total_q_mo12;


                $total_q =  $total_q1 + $total_q2 + $total_q3 + $total_q4;

              //  $total_amt =  $model->unit_cost != 0 && $total_q != 0 ? $total_q * $model->unit_cost : 0;

                if ($total_q > 0) {
                    $model->mo_1  = $total_q_mo1;
                    $model->mo_2  = $total_q_mo2;
                    $model->mo_3  =  $total_q_mo3;
                    $model->mo_4  = $total_q_mo4;
                    $model->mo_5  = $total_q_mo5;
                    $model->mo_6  = $total_q_mo6;
                    $model->mo_7  = $total_q_mo7;
                    $model->mo_8  = $total_q_mo8;
                    $model->mo_9  = $total_q_mo9;
                    $model->mo_10  = $total_q_mo10;
                    $model->mo_11  = $total_q_mo11;
                    $model->mo_12  = $total_q_mo12;
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
                    $model->awpb_template_id = $template_id;
                    $model->status = AwpbActivityLine::STATUS_DRAFT;
                    $model->name = "MM";
                    $model->updated_by = Yii::$app->user->identity->id;
                    $model->created_by = Yii::$app->user->identity->id;
                    $model->district_id = Yii::$app->getUser()->identity->district_id;
                    $model->province_id =  Yii::$app->getUser()->identity->province_id;

                    if ($model->validate()) {

                        if ($model->save()) {

                            $audit = new AuditTrail();
                            $audit->user = Yii::$app->user->id;
                            $audit->action = "Added AWPB Indicator : "  . $model->indicator_id;
                            $audit->ip_address = Yii::$app->request->getUserIP();
                            $audit->user_agent = Yii::$app->request->getUserAgent();
                            $audit->save();
                            Yii::$app->session->setFlash('success', 'AWPB indicator was successfully added.');
                            return $this->redirect(['view', 'id' => $model->id]);
                        } else {
                            Yii::$app->session->setFlash('error', 'Error occured while adding AWPB indicator.');

                            $message = '';
                            foreach ($model->getErrors() as $error) {
                                $message .= $error[0];
                            }
                            Yii::$app->session->setFlash('error', "Error occured while adding an indicator " .$model->code." details Please try again.Error:" . $message);
                   
                                return $this->render('create', [
                                    'model' => $model,
                                    'template_id' =>$template_id
                            ]);
                        }
                        return $this->redirect(['view', 'id' => $model->id]);
                        // return $this->render('create', [
                        //     'model' => $model,
                        //     'template_id' =>$template_id
                        // ]);
                    }
                } else {
                    Yii::$app->session->setFlash('error', 'Enter quantity for at least one month.');
                }
            }
            

                return $this->render('create', [
                    'model' => $model,
                    'template_id' =>$template_id
            ]);
            
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['site/home']);
        }
    }
    
    public function actionCreatepw()
    {
        if (User::userIsAllowedTo('Manage programme-wide AWPB activity lines')) {

            $model = new AwpbActivityLine();
            if (Yii::$app->request->isAjax) {
                $model->load(Yii::$app->request->post());
                return Json::encode(\yii\widgets\ActiveForm::validate($model));
            }

            if ($model->load(Yii::$app->request->post())) {

                $total_q = 0;
                $total_amt = 0.0;
                $total_q_mo1 = !empty($model->mo_1) ? $model->mo_1 : 0;
                $total_q_mo2 = !empty($model->mo_2)  ? $model->mo_2 : 0;
                $total_q_mo3 = !empty($model->mo_3) ? $model->mo_3 : 0;
                $total_q_mo4  = !empty($model->mo_4) ? $model->mo_4 : 0;
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
                $total_q4 = $total_q_mo10 +  $total_q_mo11 +  $total_q_mo12;


                $total_q =  $total_q1 + $total_q2 + $total_q3 + $total_q4;

                $total_amt =  $model->unit_cost != 0 && $total_q != 0 ? $total_q * $model->unit_cost : 0;

                if ($total_q > 0) {
                    $model->mo_1  = $total_q_mo1;
                    $model->mo_2  = $total_q_mo2;
                    $model->mo_3  =  $total_q_mo3;
                    $model->mo_4  = $total_q_mo4;
                    $model->mo_5  = $total_q_mo5;
                    $model->mo_6  = $total_q_mo6;
                    $model->mo_7  = $total_q_mo7;
                    $model->mo_8  = $total_q_mo8;
                    $model->mo_9  = $total_q_mo9;
                    $model->mo_10  = $total_q_mo10;
                    $model->mo_11  = $total_q_mo11;
                    $model->mo_12  = $total_q_mo12;
                    $model->quarter_one_quantity = $total_q1;
                    $model->quarter_two_quantity = $total_q2;
                    $model->quarter_three_quantity = $total_q3;
                    $model->quarter_four_quantity = $total_q4;
                    $model->total_quantity = $total_q;

                    $model->mo_1_amount  = $total_q_mo1 * $model->unit_cost;
                    $model->mo_2_amount  = $total_q_mo2  * $model->unit_cost;
                    $model->mo_3_amount  =  $total_q_mo3 * $model->unit_cost;
                    $model->mo_4_amount  = $total_q_mo4   * $model->unit_cost;
                    $model->mo_5_amount  = $total_q_mo5  * $model->unit_cost;
                    $model->mo_6_amount  = $total_q_mo6   * $model->unit_cost;
                    $model->mo_7_amount  = $total_q_mo7  * $model->unit_cost;
                    $model->mo_8_amount  = $total_q_mo8   * $model->unit_cost;
                    $model->mo_9_amount  = $total_q_mo9 * $model->unit_cost;
                    $model->mo_10_amount  = $total_q_mo10   * $model->unit_cost;
                    $model->mo_11_amount  = $total_q_mo11  * $model->unit_cost;
                    $model->mo_12_amount  = $total_q_mo12 * $model->unit_cost;
                    $model->quarter_one_amount = $total_q1 * $model->unit_cost;
                    $model->quarter_two_amount = $total_q2 * $model->unit_cost;
                    $model->quarter_three_amount = $total_q3 * $model->unit_cost;
                    $model->quarter_four_amount = $total_q4 * $model->unit_cost;
                    $model->total_amount = $total_amt;
                    $model->status = AwpbActivityLine::STATUS_DRAFT;
                    $model->updated_by = Yii::$app->user->identity->id;
                    $model->created_by = Yii::$app->user->identity->id;
                    // $model->district_id = Yii::$app->getUser()->identity->district_id;
                    //  $model->province_id =  Yii::$app->getUser()->identity->province_id;

                    // $model->province_id =  Yii::$app->getUser()->identity->province_id;


                    if ($model->validate()) {

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

                        return $this->redirect(['viewpw', 'id' => $model->id]);
                    }
                } else {
                    Yii::$app->session->setFlash('error', 'Enter quantity for at least one month.');
                }
            }

            return $this->render('createpw', [
                'model' => $model,
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['site/home']);
        }
    }

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
    public function actionSubmit($id, $id2, $status)
    {

        $user = User::findOne(['id' => Yii::$app->user->id]);

        if (User::userIsAllowedTo('Submit District AWPB') || User::userIsAllowedTo('Approve AWBP - Provincial') || User::userIsAllowedTo('Approve AWBP - PCO') || User::userIsAllowedTo('Approve AWBP - Ministry')) {
            $right = "";
            $returnpage = "";
            $activitylines = "";
            $subject = "";
            $province = "";
            $awpb_template = \backend\models\AwpbTemplate::findOne(['id' => $id]);
            $model = new AwpbActivityLine();
            $searchModel = new AwpbActivityLineSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            $user = User::findOne(['id' => Yii::$app->user->id]);
            $pro = \backend\models\Provinces::findOne($id2);

            if (!empty($pro)) {
                $province =  $pro->name;
            }
            if ($status == AwpbActivityLine::STATUS_SUBMITTED) // && $user->district_id>0 ||$user->district_id!=='')
            {

                $dataProvider->query->andFilterWhere(['awpb_template_id' => $id, 'district_id' => $id2, 'status' => AwpbActivityLine::STATUS_DRAFT,]);
                $activitylines = AwpbActivityLine::find()->where(['district_id' => $id2])->andWhere(['awpb_template_id' => $id])->andWhere(['status' => AwpbActivityLine::STATUS_DRAFT])->all();
                $returnpage = "index";
                $district = \backend\models\Districts::findOne($user->district_id)->name;
                $dear = "Dear Provincial Officer";
                $bodymsg = "We have submitted our";
                $bodymsg1 = " for your review and approval.";
                $subject = $awpb_template->fiscal_year . "AWPB for " . $district . "District";
                $loca = "district_id";
            }

            if ($status == AwpbActivityLine::STATUS_REVIEWED) //&& $user->province_id>0 ||$user->province_id!=='')
            {

                $dataProvider->query->andFilterWhere(['awpb_template_id' => $id, 'district_id' => $user->district_id, 'status' => AwpbActivityLine::STATUS_SUBMITTED,]);
                $activitylines = AwpbActivityLine::find()->where(['province_id' => $user->province_id])->andWhere(['awpb_template_id' => $id])->andWhere(['status' => AwpbActivityLine::STATUS_SUBMITTED])->all();
                $returnpage = 'mpc';
                //$province = \backend\models\Provinces::findOne($id2)->name;
                $right = "Approve AWPB - PCO";
                $dear = "Dear PCO";
                $bodymsg = "We have submitted our";
                $bodymsg1 = " for your review and approval.";
                $subject = $awpb_template->fiscal_year . "AWPB for " . $province . " Province";
                // $status = AWPBActivityLine:: STATUS_REVIEWED;
                $loca = "province_id";
                $id2 = $user->province_id;
            }
            if ($status == AwpbActivityLine::STATUS_APPROVED) //&& $user->province_id==0 ||$user->province_id=='')
            {

                $dataProvider->query->andFilterWhere(['awpb_template_id' => $id, 'province_id' => $id2, 'status' => AwpbActivityLine::STATUS_REVIEWED,]);
                $activitylines = AwpbActivityLine::find()->where(['province_id' => $id2])->andWhere(['awpb_template_id' => $id])->andWhere(['status' => AwpbActivityLine::STATUS_REVIEWED])->all();
                $returnpage = "mpco";
                $right = "Approve AWPB - Ministry";
                $dear = "Dear Ministry";
                $bodymsg = "We have submitted the ";
                $bodymsg1 = " for your final review and approval.";
                $subject = $awpb_template->fiscal_year . " AWPB";
                // $status = AWPBActivityLine:: STATUS_APPROVED;
                $loca = "province_id";
            }


            if ($status == AwpbActivityLine::STATUS_MINISTRY) //&& $user->province_id==0 ||$user->province_id=='')
            {
                $dataProvider->query->andFilterWhere(['awpb_template_id' => $id, 'province_id' => $id2, 'status' => AwpbActivityLine::STATUS_APPROVED,]);
                $activitylines = AwpbActivityLine::find()->where(['province_id' => $id2])->andWhere(['awpb_template_id' => $id])->andWhere(['status' => AwpbActivityLine::STATUS_APPROVED])->all();
                $returnpage = "mpcm";
                $right = "View AWPB";
                $dear = "Dear All";
                $bodymsg = "The";
                $bodymsg1 = " has been approved.";
                $subject = $province . " " . $awpb_template->fiscal_year . "AWPB";
                // $status = AWPBActivityLine:: STATUS_MINISTRY;
                $loca = "province_id";
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
                                    $msg .=  $bodymsg . " " . $awpb_template->fiscal_year . " Annual Work Plan and Budget" . $bodymsg1 . "<br/><br/>";
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
                    return $this->render($returnpage, [
                        'searchModel' => $searchModel,
                        'model' => $model,
                        'dataProvider' => $dataProvider,
                        'id' => $id
                    ]);

                    
                } else {
                    Yii::$app->session->setFlash('error',     $returnpage . ' No District AWPB to submit.');
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

    public function actionSubmitpw($id, $status)
    {
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
            $model = new AwpbActivityLine();
            $searchModel = new AwpbActivityLineSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            $user = User::findOne(['id' => Yii::$app->user->id]);

            // $pro = \backend\models\Provinces::findOne($id2);

            // if (!empty($pro)) {
            //     $province =  $pro->name;
            // }
            // if ($status == AwpbActivityLine::STATUS_SUBMITTED) // && $user->district_id>0 ||$user->district_id!=='')
            // {

            //     $dataProvider->query->andFilterWhere(['awpb_template_id' => $id, 'district_id' => $id2, 'status' => AwpbActivityLine::STATUS_DRAFT,]);
            //     $activitylines = AwpbActivityLine::find()->where(['district_id' => $id2])->andWhere(['awpb_template_id' => $id])->andWhere(['status' => AwpbActivityLine::STATUS_DRAFT])->all();
            //     $returnpage = "index";
            //     $district = \backend\models\Districts::findOne($user->district_id)->name;
            //     $dear = "Dear Provincial Officer";
            //     $bodymsg = "We have submitted our";
            //     $bodymsg1 = " for your review and approval.";
            //     $subject = $awpb_template->fiscal_year . "AWPB for " . $district . "District";
            //     $loca = "district_id";
            // }

            if ($status == AwpbActivityLine::STATUS_REVIEWED) //&& $user->province_id>0 ||$user->province_id!=='')
            {

                $dataProvider->query->andFilterWhere(['awpb_template_id' => $id, 'provincial_id' => null, 'status' => AwpbActivityLine::STATUS_DRAFT]);
                $activitylines = AwpbActivityLine::find()->where(['province_id' => null])->andWhere(['awpb_template_id' => $id])->andWhere(['status' => AwpbActivityLine::STATUS_DRAFT])->all();
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
            if ($status == AwpbActivityLine::STATUS_APPROVED) //&& $user->province_id==0 ||$user->province_id=='')
            {

                $dataProvider->query->andFilterWhere(['awpb_template_id' => $id, 'province_id' => null, 'status' => AwpbActivityLine::STATUS_REVIEWED]);
                $activitylines = AwpbActivityLine::find()->where(['province_id' => null])->andWhere(['awpb_template_id' => $id])->andWhere(['status' => AwpbActivityLine::STATUS_REVIEWED])->all();
                $returnpage = "mpwpco";
                $right = "Approve AWPB - Ministry";
                $dear = "Dear Ministry";
                $bodymsg = "We have submitted the ";
                $bodymsg1 = " for your final review and approval.";
                $subject = $awpb_template->fiscal_year . " PW AWPB SUBMITTED FOR APPROVAL";
                $status1 = AWPBActivityLine::STATUS_APPROVED;
            }


            if ($status == AwpbActivityLine::STATUS_MINISTRY) //&& $user->province_id==0 ||$user->province_id=='')
            {
                $dataProvider->query->andFilterWhere(['awpb_template_id' => $id, 'province_id' => null, 'status' => AwpbActivityLine::STATUS_APPROVED,]);
                $activitylines = AwpbActivityLine::find()->where(['province_id' => null])->andWhere(['awpb_template_id' => $id])->andWhere(['status' => AwpbActivityLine::STATUS_APPROVED])->all();
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
                                    $msg .=  $bodymsg . " " . $awpb_template->fiscal_year . " Annual Work Plan and Budget" . $bodymsg1 . "<br/><br/>";
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
                    Yii::$app->session->setFlash('error',  ' No Programme-Wide AWPB to submit.');
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

    public function actionDecline()
    {
        // public function actionDecline($district_id,$awpb_template_id) {

        //$district_id=48;
        // Yii::$app->session->setFlash('success', 'AWPB comment ' .$district.'was successfully added.');


        if (User::userIsAllowedTo('Approve AWPB - Provincial') || User::userIsAllowedTo('Approve AWBP - PCO') || User::userIsAllowedTo('Approve AWBP - Ministry')) {
            $model = new \backend\models\AwpbComment();
            $user = User::findOne(['id' => Yii::$app->user->id]);

            $searchModel = new AwpbActivityLine();
            $query = $searchModel::find();
            $query->select(['awpb_template_id', 'province_id', 'district_id', 'SUM(quarter_one_amount) as quarter_one_amount', 'SUM(quarter_two_amount) as quarter_two_amount', 'SUM(quarter_three_amount) as quarter_three_amount', 'SUM(quarter_four_amount) as quarter_four_amount', 'SUM(total_amount) as total_amount']);
            $query->where(['province_id' => $user->province_id, 'awpb_template_id' => $model->awpb_template_id, 'status' => AwpbActivityLine::STATUS_SUBMITTED]);

            //  $query->where('province_id = :field1', [':field1' =>$user->province_id]);
            $query->groupBy('district_id');
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

                    $activitylines = AwpbActivityLine::find()->where(['district_id' => $model->district_id])->andWhere(['awpb_template_id' => $model->awpb_template_id])->andWhere(['status' => AWPBActivityLine::STATUS_SUBMITTED])->all();

                    if (isset($activitylines)) {
                        if ($activitylines != null) {
                            foreach ($activitylines as $activityline) {
                                $activityline->status = AWPBActivityLine::STATUS_DRAFT;
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
                                    return $this->render('mpc', ['id' => $model->awpb_template_id]);
                                }
                            }

                            $district = \backend\models\Districts::findOne($model->district_id)->name;

                            $audit = new AuditTrail();
                            $audit->user = Yii::$app->user->id;
                            //   $audit->action = "Added AWPB Commen for ".$district;
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
                                            $msg .=  $model->description . "<br/><br/>";
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

                            return $this->redirect(['mpc', 'id' => $model->awpb_template_id]);
                        }

                        return $this->render('mpc', [
                            'searchModel' => $searchModel,
                            // 'model' => $model,
                            'dataProvider' => $dataProvider,
                            'show_results' => 1,
                            'id' => $model->awpb_template_id
                        ]);
                    }
                    return $this->render('mpc', [
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




                    return $this->render('mpc', [
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

    public function actionDeclinepwpco($id, $id2)
    {
        // public function actionDecline($district_id,$awpb_template_id) {

        //$district_id=48;
        // Yii::$app->session->setFlash('success', 'AWPB comment ' .$district.'was successfully added.');
        $user = User::findOne(['id' => Yii::$app->user->id]);

        if (User::userIsAllowedTo('Approve AWBP - PCO') && $user->province_id == 0 || $user->province_id == '') {
            $model = new \backend\models\AwpbComment();


            $searchModel = new AwpbActivityLine();
            $query = $searchModel::find();
            $query->select(['awpb_template_id', 'activity_id', 'SUM(quarter_one_amount) as quarter_one_amount', 'SUM(quarter_two_amount) as quarter_two_amount', 'SUM(quarter_three_amount) as quarter_three_amount', 'SUM(quarter_four_amount) as quarter_four_amount', 'SUM(total_amount) as total_amount']);
            // $query->where(['awpb_template_id' => $model->awpb_template_id, 'province_id' => null, 'status' => AwpbActivityLine::STATUS_REVIEWED]);
            $query->where(['awpb_template_id' => $id2, 'activity_id' => $id, 'province_id' => null, 'status' => AwpbActivityLine::STATUS_REVIEWED]);

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

                    $activitylines = AwpbActivityLine::find()->where(['awpb_template_id' => $id2])->andWhere(['activity_id' => $id])->andWhere(['province_id' => null])->andWhere(['status' => AWPBActivityLine::STATUS_REVIEWED])->all();

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
                                            $msg .=  $model->description . "<br/><br/>";
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
    public function actionDeclinep()
    {
        // public function actionDecline($district_id,$awpb_template_id) {

        //$district_id=48;
        // Yii::$app->session->setFlash('success', 'AWPB comment ' .$district.'was successfully added.');
        $user = User::findOne(['id' => Yii::$app->user->id]);
        if (User::userIsAllowedTo('Approve AWBP - PCO') && $user->province_id == 0 || $user->province_id == '') {
            $model = new \backend\models\AwpbComment();


            $status = AWPBActivityLine::STATUS_SUBMITTED;
            $searchModel = new AwpbActivityLine();
            $query = $searchModel::find();
            $dear = "";


            $query->select(['awpb_template_id', 'province_id', 'district_id', 'SUM(quarter_one_amount) as quarter_one_amount', 'SUM(quarter_two_amount) as quarter_two_amount', 'SUM(quarter_three_amount) as quarter_three_amount', 'SUM(quarter_four_amount) as quarter_four_amount', 'SUM(total_amount) as total_amount']);
            $query->where(['province_id' => $model->province_id, 'awpb_template_id' => $model->awpb_template_id, 'status' => AwpbActivityLine::STATUS_REVIEWED]);
            $status = AWPBActivityLine::STATUS_SUBMITTED;
            $dear .= "<p>Dear Budget Committee,<br/><br/>";

            // elseif(User::userIsAllowedTo('Approve AWBP - Ministry'))
            // {
            //     $query->select(['awpb_template_id','province_id','district_id','SUM(quarter_one_amount) as quarter_one_amount','SUM(quarter_two_amount) as quarter_two_amount','SUM(quarter_three_amount) as quarter_three_amount','SUM(quarter_four_amount) as quarter_four_amount','SUM(total_amount) as total_amount']);
            //     $query->where(['province_id'=>$model->province_id, 'awpb_template_id' =>$model->awpb_template_id,'status' => AwpbActivityLine::STATUS_APPROVED]);
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
                        $province =  $pro->name;
                    }

                    $activitylines = AwpbActivityLine::find()->where(['province_id' => $model->province_id])->andWhere(['awpb_template_id' => $model->awpb_template_id])->andWhere(['status' => AWPBActivityLine::STATUS_REVIEWED])->all();

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
                                            $msg .=  $model->description . "<br/><br/>";
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


                            return $this->render('mpco', [
                                'searchModel' => $searchModel,
                                // 'model' => $model,
                                'dataProvider' => $dataProvider,
                                'show_results' => 1,
                                'id' => $model->awpb_template_id
                            ]);
                        }

                        return $this->render('mpco', [
                            'searchModel' => $searchModel,
                            // 'model' => $model,
                            'dataProvider' => $dataProvider,
                            'show_results' => 1,
                            'id' => $model->awpb_template_id
                        ]);
                    }
                    return $this->render('mpco', [
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
    public function actionDeclinem()
    {
        // public function actionDecline($district_id,$awpb_template_id) {

        //$district_id=48;
        // Yii::$app->session->setFlash('success', 'AWPB comment ' .$district.'was successfully added.');
        $user = User::findOne(['id' => Yii::$app->user->id]);
        if (User::userIsAllowedTo('Approve AWBP - Ministry') && $user->province_id == 0 || $user->province_id == '') {
            $model = new \backend\models\AwpbComment();



            $searchModel = new AwpbActivityLine();
            $query = $searchModel::find();
            $dear = "";


            $query->select(['awpb_template_id', 'province_id', 'district_id', 'SUM(quarter_one_amount) as quarter_one_amount', 'SUM(quarter_two_amount) as quarter_two_amount', 'SUM(quarter_three_amount) as quarter_three_amount', 'SUM(quarter_four_amount) as quarter_four_amount', 'SUM(total_amount) as total_amount']);
            $query->where(['province_id' => $model->province_id, 'awpb_template_id' => $model->awpb_template_id, 'status' => AwpbActivityLine::STATUS_APPROVED]);
            // $status=AWPBActivityLine::STATUS_APPROVED;   
            $dear .= "<p>Dear Budget Committee,<br/><br/>";

            // elseif(User::userIsAllowedTo('Approve AWBP - Ministry'))
            // {
            //     $query->select(['awpb_template_id','province_id','district_id','SUM(quarter_one_amount) as quarter_one_amount','SUM(quarter_two_amount) as quarter_two_amount','SUM(quarter_three_amount) as quarter_three_amount','SUM(quarter_four_amount) as quarter_four_amount','SUM(total_amount) as total_amount']);
            //     $query->where(['province_id'=>$model->province_id, 'awpb_template_id' =>$model->awpb_template_id,'status' => AwpbActivityLine::STATUS_APPROVED]);
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
                        $province =  $pro->name;
                    }

                    $activitylines = AwpbActivityLine::find()->where(['province_id' => $model->province_id])->andWhere(['awpb_template_id' => $model->awpb_template_id])->andWhere(['status' => AWPBActivityLine::STATUS_APPROVED])->all();

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
                                            $msg .=  $model->description . "<br/><br/>";
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

    public function actionDeclinepwm()
    {
        // public function actionDecline($district_id,$awpb_template_id) {

        //$district_id=48;
        // Yii::$app->session->setFlash('success', 'AWPB comment ' .$district.'was successfully added.');
        $user = User::findOne(['id' => Yii::$app->user->id]);
        if (User::userIsAllowedTo('Approve AWBP - Ministry') && $user->province_id == 0 || $user->province_id == '') {
            $model = new \backend\models\AwpbComment();



            $searchModel = new AwpbActivityLine();
            $query = $searchModel::find();
            $dear = "";


            $query->select(['awpb_template_id', 'activity_id', 'SUM(quarter_one_amount) as quarter_one_amount', 'SUM(quarter_two_amount) as quarter_two_amount', 'SUM(quarter_three_amount) as quarter_three_amount', 'SUM(quarter_four_amount) as quarter_four_amount', 'SUM(total_amount) as total_amount']);
            $query->where(['awpb_template_id' => $model->awpb_template_id, 'province_id' => null, 'status' => AwpbActivityLine::STATUS_APPROVED]);
            // $status=AWPBActivityLine::STATUS_APPROVED;   
            $dear .= "<p>Dear Budget Committee,<br/><br/>";

            // elseif(User::userIsAllowedTo('Approve AWBP - Ministry'))
            // {
            //     $query->select(['awpb_template_id','province_id','district_id','SUM(quarter_one_amount) as quarter_one_amount','SUM(quarter_two_amount) as quarter_two_amount','SUM(quarter_three_amount) as quarter_three_amount','SUM(quarter_four_amount) as quarter_four_amount','SUM(total_amount) as total_amount']);
            //     $query->where(['province_id'=>$model->province_id, 'awpb_template_id' =>$model->awpb_template_id,'status' => AwpbActivityLine::STATUS_APPROVED]);
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


                    $activitylines = AwpbActivityLine::find()->where(['awpb_template_id' => $model->awpb_template_id])->andWhere(['province_id' => null])->andWhere(['status' => AWPBActivityLine::STATUS_APPROVED])->all();

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
                                            $msg .=  $model->description . "<br/><br/>";
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
    public function actionMpc($id)
    {
        if (User::userIsAllowedTo('Approve AWPB - Provincial')) {
            $user = User::findOne(['id' => Yii::$app->user->id]);
            $searchModel = new AwpbActivityLine();
            $query = $searchModel::find();
            $query->select(['awpb_template_id', 'province_id', 'district_id', 'SUM(quarter_one_amount) as quarter_one_amount', 'SUM(quarter_two_amount) as quarter_two_amount', 'SUM(quarter_three_amount) as quarter_three_amount', 'SUM(quarter_four_amount) as quarter_four_amount', 'SUM(total_amount) as total_amount']);
            $query->where(['awpb_template_id' => $id, 'province_id' => $user->province_id, 'status' => AwpbActivityLine::STATUS_SUBMITTED]);

            //  $query->where('province_id = :field1', [':field1' =>$user->province_id]);
            $query->groupBy('district_id');
            $query->all();

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);

            return $this->render('mpc', [
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


    public function actionMpco($id)
    {
        if (User::userIsAllowedTo('Approve AWPB - PCO')) {
            $user = User::findOne(['id' => Yii::$app->user->id]);
            $searchModel = new AwpbActivityLine();
            $query = $searchModel::find();
            $query->select(['awpb_template_id', 'province_id', 'district_id', 'SUM(quarter_one_amount) as quarter_one_amount', 'SUM(quarter_two_amount) as quarter_two_amount', 'SUM(quarter_three_amount) as quarter_three_amount', 'SUM(quarter_four_amount) as quarter_four_amount', 'SUM(total_amount) as total_amount']);
            // $query->where(['awpb_template_id' => $id, 'status' => AwpbActivityLine::STATUS_REVIEWED]);
            $query->where(['awpb_template_id' => $id])->andWhere(['not', ['province_id' => null]])->andWhere(['status' => AwpbActivityLine::STATUS_REVIEWED]);

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
                'id' => $id
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }
    public function actionMpwpco($id)
    {
        if (User::userIsAllowedTo('Approve AWPB - PCO')) {
            $user = User::findOne(['id' => Yii::$app->user->id]);
            $searchModel = new AwpbActivityLine();
            $query = $searchModel::find();
            $query->select(['awpb_template_id',  'activity_id', 'SUM(quarter_one_amount) as quarter_one_amount', 'SUM(quarter_two_amount) as quarter_two_amount', 'SUM(quarter_three_amount) as quarter_three_amount', 'SUM(quarter_four_amount) as quarter_four_amount', 'SUM(total_amount) as total_amount']);
            $query->where(['awpb_template_id' => $id, 'province_id' => null, 'status' => AwpbActivityLine::STATUS_REVIEWED]);

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

    public function actionMpcm($id)
    {
        if (User::userIsAllowedTo('Approve AWPB - Ministry')) {
            $user = User::findOne(['id' => Yii::$app->user->id]);
            $searchModel = new AwpbActivityLine();
            $query = $searchModel::find();
            $query->select(['awpb_template_id', 'province_id', 'district_id', 'SUM(quarter_one_amount) as quarter_one_amount', 'SUM(quarter_two_amount) as quarter_two_amount', 'SUM(quarter_three_amount) as quarter_three_amount', 'SUM(quarter_four_amount) as quarter_four_amount', 'SUM(total_amount) as total_amount']);
            $query->where(['awpb_template_id' => $id])->andWhere(['not', ['province_id' => null]])->andWhere(['status' => AwpbActivityLine::STATUS_APPROVED]);

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


    public function actionMpwm($id)
    {
        if (User::userIsAllowedTo('Approve AWPB - Ministry')) {
            $user = User::findOne(['id' => Yii::$app->user->id]);
            $searchModel = new AwpbActivityLine();
            $query = $searchModel::find();
            $query->select(['awpb_template_id', 'activity_id', 'SUM(quarter_one_amount) as quarter_one_amount', 'SUM(quarter_two_amount) as quarter_two_amount', 'SUM(quarter_three_amount) as quarter_three_amount', 'SUM(quarter_four_amount) as quarter_four_amount', 'SUM(total_amount) as total_amount']);
            $query->where(['awpb_template_id' => $id, 'province_id' => null, 'status' => AwpbActivityLine::STATUS_APPROVED]);

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
    public function actionMpcd($id, $awpb_template_id)
    {

        // $id='48';

        // $user = User::findOne(['id' => Yii::$app->user->id]);
        // $searchModel = new AwpbActivityLineSearch();    

        // $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        // $dataProvider->query->andFilterWhere(['district_id' => $user->district_id, 'created_by'=>$user->id,'status' => AWPBActivityLine:: STATUS_DRAFT,]);
        //  return $this->render('index', [
        //     'searchModel' => $searchModel,
        //     'dataProvider' => $dataProvider,
        //     ]);



        if (User::userIsAllowedTo('Manage province consolidated AWPB')) {
            $user = User::findOne(['id' => Yii::$app->user->id]);
            $searchModel = new AwpbActivityLineSearch();
            $model  = new AwpbActivityLine();
            $query = $searchModel::find();
            $query->select(['district_id', 'activity_id', 'awpb_template_id', 'SUM(quarter_one_amount) as quarter_one_amount', 'SUM(quarter_two_amount) as quarter_two_amount', 'SUM(quarter_three_amount) as quarter_three_amount', 'SUM(quarter_four_amount) as quarter_four_amount', 'SUM(total_amount) as total_amount']);

            //      $query->where('district_id = :field1', [':field1' =>$id]);
            $query->where(['awpb_template_id' => $awpb_template_id, 'district_id' => $id, 'awpb_template_id' => $awpb_template_id, 'status' => AwpbActivityLine::STATUS_SUBMITTED]);

            $query->groupBy('activity_id');
            $query->all();

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);

            return $this->render('mpcd', [
                'searchModel' => $searchModel,
                'model' => $model,
                'dataProvider' => $dataProvider,
                'district_id' => $id,
                'awpb_template_id' => $awpb_template_id
            ]);
            // return $this->redirect(['mp/mpcd']);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }


    public function actionMpcop($id, $awpb_template_id)
    {

        if (User::userIsAllowedTo('Approve AWPB - PCO')) {
            $user = User::findOne(['id' => Yii::$app->user->id]);
            $searchModel = new AwpbActivityLineSearch();
            $model  = new AwpbActivityLine();
            $query = $searchModel::find();
            $query->select(['awpb_template_id', 'province_id', 'district_id', 'SUM(quarter_one_amount) as quarter_one_amount', 'SUM(quarter_two_amount) as quarter_two_amount', 'SUM(quarter_three_amount) as quarter_three_amount', 'SUM(quarter_four_amount) as quarter_four_amount', 'SUM(total_amount) as total_amount']);
            // $query->select(['district_id','activity_id','awpb_template_id','SUM(quarter_one_amount) as quarter_one_amount','SUM(quarter_two_amount) as quarter_two_amount','SUM(quarter_three_amount) as quarter_three_amount','SUM(quarter_four_amount) as quarter_four_amount','SUM(total_amount) as total_amount']);

            //      $query->where('district_id = :field1', [':field1' =>$id]);
            $query->where(['awpb_template_id' => $awpb_template_id, 'province_id' => $id, 'status' => AwpbActivityLine::STATUS_REVIEWED]);

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
    public function actionMpcmp($id, $awpb_template_id)
    {

        if (User::userIsAllowedTo('Approve AWPB - Ministry')) {
            $user = User::findOne(['id' => Yii::$app->user->id]);
            $searchModel = new AwpbActivityLineSearch();
            $model  = new AwpbActivityLine();
            $query = $searchModel::find();
            $query->select(['awpb_template_id', 'province_id', 'district_id', 'SUM(quarter_one_amount) as quarter_one_amount', 'SUM(quarter_two_amount) as quarter_two_amount', 'SUM(quarter_three_amount) as quarter_three_amount', 'SUM(quarter_four_amount) as quarter_four_amount', 'SUM(total_amount) as total_amount']);
            // $query->select(['district_id','activity_id','awpb_template_id','SUM(quarter_one_amount) as quarter_one_amount','SUM(quarter_two_amount) as quarter_two_amount','SUM(quarter_three_amount) as quarter_three_amount','SUM(quarter_four_amount) as quarter_four_amount','SUM(total_amount) as total_amount']);

            //      $query->where('district_id = :field1', [':field1' =>$id]);
            $query->where(['awpb_template_id' => $awpb_template_id, 'province_id' => $id, 'status' => AwpbActivityLine::STATUS_APPROVED]);

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


    public function actionMpcod($id, $awpb_template_id)
    {

        if (User::userIsAllowedTo('Approve AWPB - PCO')) {
            $user = User::findOne(['id' => Yii::$app->user->id]);
            $searchModel = new AwpbActivityLineSearch();
            $model  = new AwpbActivityLine();
            $query = $searchModel::find();
            //$query->select(['awpb_template_id','province_id','district_id','SUM(quarter_one_amount) as quarter_one_amount','SUM(quarter_two_amount) as quarter_two_amount','SUM(quarter_three_amount) as quarter_three_amount','SUM(quarter_four_amount) as quarter_four_amount','SUM(total_amount) as total_amount']);
            $query->select(['district_id', 'activity_id', 'awpb_template_id', 'SUM(quarter_one_amount) as quarter_one_amount', 'SUM(quarter_two_amount) as quarter_two_amount', 'SUM(quarter_three_amount) as quarter_three_amount', 'SUM(quarter_four_amount) as quarter_four_amount', 'SUM(total_amount) as total_amount']);

            //      $query->where('district_id = :field1', [':field1' =>$id]);
            $query->where(['awpb_template_id' => $awpb_template_id, 'district_id' => $id, 'status' => AwpbActivityLine::STATUS_REVIEWED]);

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
    public function actionMpcmd($id, $awpb_template_id)
    {

        if (User::userIsAllowedTo('Approve AWPB - Ministry')) {
            $user = User::findOne(['id' => Yii::$app->user->id]);
            $searchModel = new AwpbActivityLineSearch();
            $model  = new AwpbActivityLine();
            $query = $searchModel::find();
            //$query->select(['awpb_template_id','province_id','district_id','SUM(quarter_one_amount) as quarter_one_amount','SUM(quarter_two_amount) as quarter_two_amount','SUM(quarter_three_amount) as quarter_three_amount','SUM(quarter_four_amount) as quarter_four_amount','SUM(total_amount) as total_amount']);
            $query->select(['district_id', 'activity_id', 'awpb_template_id', 'SUM(quarter_one_amount) as quarter_one_amount', 'SUM(quarter_two_amount) as quarter_two_amount', 'SUM(quarter_three_amount) as quarter_three_amount', 'SUM(quarter_four_amount) as quarter_four_amount', 'SUM(total_amount) as total_amount']);

            //      $query->where('district_id = :field1', [':field1' =>$id]);
            $query->where(['awpb_template_id' => $awpb_template_id, 'district_id' => $id, 'status' => AwpbActivityLine::STATUS_APPROVED]);

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


    public function actionMpca($id, $district_id, $awpb_template_id)
    {
        // $awpb_template_id=32;
        if (User::userIsAllowedTo('Manage province consolidated AWPB')) {
            $user = User::findOne(['id' => Yii::$app->user->id]);
            $searchModel = new AwpbActivityLineSearch();
            $model  = new AwpbActivityLine();
            $query = $searchModel::find();
            // $searchModel = new AwpbActivityLine();
            $query = $searchModel::find();
            //   $query->select(['id', 'name', 'awpb_template_id', 'SUM(quarter_one_amount) as quarter_one_amount', 'SUM(quarter_two_amount) as quarter_two_amount', 'SUM(quarter_three_amount) as quarter_three_amount', 'SUM(quarter_four_amount) as quarter_four_amount', 'SUM(total_amount) as total_amount']);
            $query->select(['id', 'name', 'awpb_template_id', 'quarter_one_amount', 'quarter_two_amount', 'quarter_three_amount', 'quarter_four_amount', 'total_amount']);

            // $query->where('activity_id = :field1', [':field1' =>$id]);
            $query->where(['awpb_template_id' => $awpb_template_id, 'district_id' => $district_id, 'activity_id' => $id, 'status' => AwpbActivityLine::STATUS_SUBMITTED]);

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

    public function actionMpcoa($id, $district_id, $awpb_template_id)
    {
        // $awpb_template_id=32;
        if (User::userIsAllowedTo('Approve AWPB - PCO')) {
            $user = User::findOne(['id' => Yii::$app->user->id]);
            $searchModel = new AwpbActivityLineSearch();
            $model  = new AwpbActivityLine();
            $query = $searchModel::find();
            // $searchModel = new AwpbActivityLine();
            $query = $searchModel::find();
            //  $query->select(['id', 'name', 'awpb_template_id', 'SUM(quarter_one_amount) as quarter_one_amount', 'SUM(quarter_two_amount) as quarter_two_amount', 'SUM(quarter_three_amount) as quarter_three_amount', 'SUM(quarter_four_amount) as quarter_four_amount', 'SUM(total_amount) as total_amount']);
            $query->select(['id', 'name', 'awpb_template_id', 'quarter_one_amount', 'quarter_two_amount', 'quarter_three_amount', 'quarter_four_amount', 'total_amount']);

            // $query->where('activity_id = :field1', [':field1' =>$id]);
            $query->where(['awpb_template_id' => $awpb_template_id, 'district_id' => $district_id, 'activity_id' => $id, 'status' => AwpbActivityLine::STATUS_REVIEWED]);

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

    public function actionMpwpcoa($id, $id2)
    {
        // $awpb_template_id=32;
        if (User::userIsAllowedTo('Approve AWPB - PCO')) {
            $user = User::findOne(['id' => Yii::$app->user->id]);
            $searchModel = new AwpbActivityLineSearch();
            $model  = new AwpbActivityLine();
            $query = $searchModel::find();
            // $searchModel = new AwpbActivityLine();
            $query = $searchModel::find();
            $query->select(['id', 'name', 'awpb_template_id', 'quarter_one_amount', 'quarter_two_amount', 'quarter_three_amount', 'quarter_four_amount', 'total_amount']);

            // $query->where('activity_id = :field1', [':field1' =>$id]);
            $query->where(['awpb_template_id' => $id2, 'province_id' => null, 'activity_id' => $id, 'status' => AwpbActivityLine::STATUS_REVIEWED]);

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

    public function actionMpwma($id, $id2)
    {
        // $awpb_template_id=32;
        if (User::userIsAllowedTo('Approve AWPB - Ministry')) {
            $user = User::findOne(['id' => Yii::$app->user->id]);
            $searchModel = new AwpbActivityLineSearch();
            $model  = new AwpbActivityLine();
            $query = $searchModel::find();
            // $searchModel = new AwpbActivityLine();
            $query = $searchModel::find();
            $query->select(['id', 'name', 'awpb_template_id', 'quarter_one_amount', 'quarter_two_amount', 'quarter_three_amount', 'quarter_four_amount', 'total_amount']);

            // $query->where('activity_id = :field1', [':field1' =>$id]);
            $query->where(['awpb_template_id' => $id2, 'province_id' => null, 'activity_id' => $id, 'status' => AwpbActivityLine::STATUS_APPROVED]);

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

    public function actionMpcma($id, $district_id, $awpb_template_id)
    {
        // $awpb_template_id=32;
        if (User::userIsAllowedTo('Approve AWPB - Ministry')) {
            $user = User::findOne(['id' => Yii::$app->user->id]);
            $searchModel = new AwpbActivityLineSearch();
            $model  = new AwpbActivityLine();
            $query = $searchModel::find();
            // $searchModel = new AwpbActivityLine();
            $query = $searchModel::find();
            // $query->select(['id', 'name', 'awpb_template_id', 'SUM(quarter_one_amount) as quarter_one_amount', 'SUM(quarter_two_amount) as quarter_two_amount', 'SUM(quarter_three_amount) as quarter_three_amount', 'SUM(quarter_four_amount) as quarter_four_amount', 'SUM(total_amount) as total_amount']);
            $query->select(['id', 'name', 'awpb_template_id', 'quarter_one_amount', 'quarter_two_amount', 'quarter_three_amount', 'quarter_four_amount', 'total_amount']);

            // $query->where('activity_id = :field1', [':field1' =>$id]);
            $query->where(['awpb_template_id' => $awpb_template_id, 'district_id' => $district_id, 'activity_id' => $id, 'status' => AwpbActivityLine::STATUS_APPROVED]);

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
    public function actionExc($id)
    {
        if (User::userIsAllowedTo('Manage province consolidated AWPB')) {
            $user = User::findOne(['id' => Yii::$app->user->id]);
            $searchModel = new AwpbActivityLine();
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




    public function actionExport($id)
    {

        $user = User::findOne(['id' => Yii::$app->user->id]);
        $searchModel = new AwpbActivityLine();
        $query = $searchModel::find();
        $query->select(['AwpbTemplate.fiscal_year as year', 'AwpbActivity.gl_account_code as code', 'SUM(quarter_one_amount) as quarter_one_amount', 'SUM(quarter_two_amount) as quarter_two_amount', 'SUM(quarter_three_amount) as quarter_three_amount', 'SUM(quarter_four_amount) as quarter_four_amount', 'SUM(total_amount) as total_amount']);
        $query->leftJoin('AwpbActivity', 'AwpbActivity.id = AwpbActivityLine.activity_id');
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
