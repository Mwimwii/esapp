<?php

namespace backend\controllers;

use Yii;
use backend\models\AwpbTemplateActivity;
use backend\models\AwpbTemplateActivitySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Json;
use backend\models\AuditTrail;
use backend\models\User;

/**
 * AwpbTemplateActivityController implements the CRUD actions for AwpbTemplateActivity model.
 */
class AwpbTemplateActivityController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'create', 'update', 'delete', 'view','update1'],
                'rules' => [
                    [
                        'actions' => ['index', 'create', 'update', 'delete', 'view','update1'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                    'update1' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all AwpbTemplateActivity models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new AwpbTemplateActivitySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['=','status',0]);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
        
        
        
        
//         $searchModel = new AwpbBudget();
//            $model = new AwpbBudget();
//            $query = $searchModel::find();
//            $query->select(['component_id','awpb_template_id', 'output_id', 'cost_centre_id', 'activity_id', 'indicator_id', 'id', 'quarter_one_quantity', 'quarter_two_quantity', 'quarter_three_quantity', 'quarter_four_quantity', 'total_amount']);
//            $query->where(['=', 'awpb_template_id', $id]);
//            //$query->andWhere(['=', 'status',$status]);
//            $query->andWhere(['<>', 'cost_centre_id', 0]);
//            // $query->andWhere(['=', 'created_by', $user->id]);
//            //  $query->groupBy('indicator_id');
//            $query->all();
//
//            $dataProvider = new ActiveDataProvider([
//                'query' => $query,
    }

    /**
     * Displays a single AwpbTemplateActivity model.
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
     * Creates a new AwpbTemplateActivity model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new AwpbTemplateActivity();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing AwpbTemplateActivity model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    
    
       public function actionUpdate1($id) {
       

//        
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id]);
//        }
        if (User::userIsAllowedTo('Setup AWPB')) {
           $model = $this->findModel($id);
             $model->status = AwpbTemplateActivity::STATUS_LOCKED;
             $model->updated_by = Yii::$app->user->id;

          if ($model->save()) {
                 $audit = new AuditTrail();

                        $audit->user = Yii::$app->user->id;
                        $audit->action = "Activity no. " . $model->activity_id . "  funding profile has been locked for editing.";
                        $audit->ip_address = Yii::$app->request->getUserIP();
                        $audit->user_agent = Yii::$app->request->getUserAgent();
                        $audit->save();
                        Yii::$app->session->setFlash('success', 'Activity funding profile has been locked for editing.' );
                        return $this->redirect(['index']);
                    } else {
                        $message = '';
                        foreach ($model->getErrors() as $error) {
                            $message .= $error[0];
                        }
                        Yii::$app->session->setFlash('error', 'Error occured while setting the finding profie.Error:' . $message);
                    }
                 return $this->redirect(['index']);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
  
       }
    public function actionUpdate($id) {
        $model = $this->findModel($id);

//        
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id]);
//        }
        if (User::userIsAllowedTo('Setup AWPB')) {
            if (Yii::$app->request->isAjax) {
                $model->load(Yii::$app->request->post());
                return Json::encode(\yii\widgets\ActiveForm::validate($model));
            }

            if ($model->load(Yii::$app->request->post())) {



                $total_percentage = 0.0;
                $total_amt = 0.0;
                $ifad_percentage = !empty($model->ifad) ? $model->ifad : 0;
                $ifad_grant_percentage = !empty($model->ifad_grant) ? $model->ifad_grant : 0;
                $grz_percentage = !empty($model->grz) ? $model->grz : 0;
                $beneficiaries_percentage = !empty($model->beneficiaries) ? $model->beneficiaries : 0;
                $private_sector_percentage = !empty($model->private_sector) ? $model->private_sector : 0;
                $iapri_percentage = !empty($model->iapri) ? $model->iapri : 0;
                $parm_percentage = !empty($model->parm) ? $model->parm : 0;

                $total_percentage = $ifad_percentage + $ifad_grant_percentage + $grz_percentage + $beneficiaries_percentage + $private_sector_percentage + $iapri_percentage + $parm_percentage;
                if ($total_percentage == 100) {
                    $model->mo_1_amount = \backend\models\AwpbInput::find()->where(['activity_id' => $model->activity_id])->andWhere(['awpb_template_id' => $model->awpb_template_id])->sum('mo_1_amount');
                    $model->mo_2_amount = \backend\models\AwpbInput::find()->where(['activity_id' => $model->activity_id])->andWhere(['awpb_template_id' => $model->awpb_template_id])->sum('mo_2_amount');
                    $model->mo_3_amount = \backend\models\AwpbInput::find()->where(['activity_id' => $model->activity_id])->andWhere(['awpb_template_id' => $model->awpb_template_id])->sum('mo_3_amount');
                    $model->mo_4_amount = \backend\models\AwpbInput::find()->where(['activity_id' => $model->activity_id])->andWhere(['awpb_template_id' => $model->awpb_template_id])->sum('mo_4_amount');
                    $model->mo_5_amount = \backend\models\AwpbInput::find()->where(['activity_id' => $model->activity_id])->andWhere(['awpb_template_id' => $model->awpb_template_id])->sum('mo_5_amount');
                    $model->mo_6_amount = \backend\models\AwpbInput::find()->where(['activity_id' => $model->activity_id])->andWhere(['awpb_template_id' => $model->awpb_template_id])->sum('mo_6_amount');
                    $model->mo_7_amount = \backend\models\AwpbInput::find()->where(['activity_id' => $model->activity_id])->andWhere(['awpb_template_id' => $model->awpb_template_id])->sum('mo_7_amount');
                    $model->mo_8_amount = \backend\models\AwpbInput::find()->where(['activity_id' => $model->activity_id])->andWhere(['awpb_template_id' => $model->awpb_template_id])->sum('mo_8_amount');
                    $model->mo_9_amount = \backend\models\AwpbInput::find()->where(['activity_id' => $model->activity_id])->andWhere(['awpb_template_id' => $model->awpb_template_id])->sum('mo_9_amount');
                    $model->mo_10_amount = \backend\models\AwpbInput::find()->where(['activity_id' => $model->activity_id])->andWhere(['awpb_template_id' => $model->awpb_template_id])->sum('mo_10_amount');
                    $model->mo_11_amount = \backend\models\AwpbInput::find()->where(['activity_id' => $model->activity_id])->andWhere(['awpb_template_id' => $model->awpb_template_id])->sum('mo_11_amount');
                    $model->mo_12_amount = \backend\models\AwpbInput::find()->where(['activity_id' => $model->activity_id])->andWhere(['awpb_template_id' => $model->awpb_template_id])->sum('mo_12_amount');
                    $model->quarter_one_amount = \backend\models\AwpbInput::find()->where(['activity_id' => $model->activity_id])->andWhere(['awpb_template_id' => $model->awpb_template_id])->sum('quarter_one_amount ');
                    $model->quarter_two_amount = \backend\models\AwpbInput::find()->where(['activity_id' => $model->activity_id])->andWhere(['awpb_template_id' => $model->awpb_template_id])->sum('quarter_two_amount ');
                    $model->quarter_three_amount = \backend\models\AwpbInput::find()->where(['activity_id' => $model->activity_id])->andWhere(['awpb_template_id' => $model->awpb_template_id])->sum('quarter_three_amount ');
                    $model->quarter_four_amount = \backend\models\AwpbInput::find()->where(['activity_id' => $model->activity_id])->andWhere(['awpb_template_id' => $model->awpb_template_id])->sum('quarter_four_amount ');
                    $model->budget_amount = \backend\models\AwpbInput::find()->where(['activity_id' => $model->activity_id])->andWhere(['awpb_template_id' => $model->awpb_template_id])->sum('total_amount');
                    $model->ifad_amount = ($ifad_percentage * $model->budget_amount) / 100;
                    $model->ifad_grant_amount = ($ifad_grant_percentage * $model->budget_amount) / 100;
                    $model->grz_amount = ($grz_percentage * $model->budget_amount) / 100;
                    $model->beneficiaries_amount = ($beneficiaries_percentage * $model->budget_amount) / 100;
                    $model->private_sector_amount = ($private_sector_percentage * $model->budget_amount) / 100;
                    $model->iapri_amount = ($iapri_percentage * $model->budget_amount) / 100;
                    $model->parm_amount = ($parm_percentage * $model->budget_amount) / 100;
                    if ($model->save()) {
                        $model_activity = \backend\models\AwpbActivity::findOne(['id' => $model->activity_id]);
                        //$model_template = \backend\models\AwpbTemplate::findModel(['id' => $model->awpb_template_id]);
                        $model_expense_category = \backend\models\AwpbExpenseCategory::findOne(['id' => $model_activity->expense_category_id]);
                        $model_component = \backend\models\AwpbComponent::findOne(['id' => $model_activity->component_id]);
                        $model_funder = \backend\models\AwpbFunder::find()->all();
                        //var_dump($model_activity->name);
                        $percent = 0.0;
                        $gl_account = "";
                        if ( $model->budget_amount >0){
                        foreach ($model_funder as $funder) {

                            if ($funder->name == "IFAD") {
                                $percent = $ifad_percentage;
                                $gl_account = $model_activity->gl_account_code . "/" . $model_component->gl_account_code . "/" . $model_expense_category->code . "/0" . $funder->code;
                            }
                            if ($funder->name == "IFAD Grant") {
                                $percent = $ifad_grant_percentage;
                                $gl_account = $model_activity->gl_account_code . "/" . $model_component->gl_account_code . "/" . $model_expense_category->code . "/0" . $funder->code;
                            }
                            if ($funder->name == "GRZ") {
                                $percent = $grz_percentage;
                                $gl_account = $model_activity->gl_account_code . "/" . $model_component->gl_account_code . "/" . $model_expense_category->code . "/0" . $funder->code;
                            }
                            if ($funder->name == "Private Sector") {
                                $percent = $private_sector_percentage;
                                $gl_account = $model_activity->gl_account_code . "/" . $model_component->gl_account_code . "/" . $model_expense_category->code . "/0" . $funder->code;
                            }
                            if ($funder->name == "Beneficiaries") {
                                $percent = $beneficiaries_percentage;
                                $gl_account = $model_activity->gl_account_code . "/" . $model_component->gl_account_code . "/" . $model_expense_category->code . "/0" . $funder->code;
                            }
                            if ($funder->name == "IAPRI") {
                                $percent = $iapri_percentage;
                                $gl_account = $model_activity->gl_account_code . "/" . $model_component->gl_account_code . "/" . $model_expense_category->code . "/0" . $funder->code;
                            } if ($funder->name == "PARM") {
                                $percent = $parm_percentage;
                                $gl_account = $model_activity->gl_account_code . "/" . $model_component->gl_account_code . "/" . $model_expense_category->code . "/0" . $funder->code;
                            }
                            $_model_general_ledger = \backend\models\AwpbGeneralLedger::find()
                                            // ->where(['activity_id' => $model->activity_id])
                                            ->where(['awpb_template_id' => $model->awpb_template_id])
                                            //->andWhere(['funder_id' => $model->funder_id])
                                            ->andWhere(['general_ledger_account' => $gl_account])->one();
                            if (empty($_model_general_ledger)) {
                                $model_general_ledger = new \backend\models\AwpbGeneralLedger();
                                $model_general_ledger->general_ledger_account = $gl_account;
                                $model_general_ledger->activity_id = $model->activity_id;
                                $model_general_ledger->component_id = $model_activity->component_id;
                                $model_general_ledger->awpb_template_id = $model->awpb_template_id;
                                $model_general_ledger->funder_id = $funder->id;
                                $model_general_ledger->expense_category_id = $model_activity->expense_category_id;
                                $model_general_ledger->mo_1_amount = ($model->mo_1_amount * $percent) / 100;
                                $model_general_ledger->mo_2_amount = ($model->mo_2_amount * $percent) / 100;
                                $model_general_ledger->mo_3_amount = ($model->mo_3_amount * $percent) / 100;
                                $model_general_ledger->mo_4_amount = ($model->mo_4_amount * $percent) / 100;
                                $model_general_ledger->mo_5_amount = ($model->mo_5_amount * $percent) / 100;
                                $model_general_ledger->mo_6_amount = ($model->mo_6_amount * $percent) / 100;
                                $model_general_ledger->mo_7_amount = ($model->mo_7_amount * $percent) / 100;
                                $model_general_ledger->mo_8_amount = ($model->mo_8_amount * $percent) / 100;
                                $model_general_ledger->mo_9_amount = ($model->mo_9_amount * $percent) / 100;
                                $model_general_ledger->mo_10_amount = ($model->mo_10_amount * $percent) / 100;
                                $model_general_ledger->mo_11_amount = ($model->mo_11_amount * $percent) / 100;
                                $model_general_ledger->mo_12_amount = ($model->mo_12_amount * $percent) / 100;
                                $model_general_ledger->quarter_one_amount = ($model->quarter_one_amount * $percent) / 100;
                                $model_general_ledger->quarter_two_amount = ($model->quarter_two_amount * $percent) / 100;
                                $model_general_ledger->quarter_three_amount = ( $model->quarter_three_amount * $percent) / 100;
                                $model_general_ledger->quarter_four_amount = ($model->quarter_four_amount * $percent) / 100;
                                $model_general_ledger->updated_by = Yii::$app->user->identity->id;
                                $model_general_ledger->created_by = Yii::$app->user->identity->id;

                                Yii::$app->session->setFlash('error', 'Error occured while creating gl accounts.Error:' .
                                        $model_general_ledger->component_id . " " .
                                        $model_general_ledger->activity_id . " " .
                                        $model_general_ledger->awpb_template_id . " " .
                                        $model_general_ledger->funder_id . " " .
                                        $model_general_ledger->general_ledger_account . " " .
                                        $model_general_ledger->expense_category_id . " " .
                                        $percent . " " .
                                        $model->mo_1_amount);

                                $model_general_ledger->save();
//                            if ($model_general_ledger->save()) {
//                                
//                            } else {
//                                $message = '';
//                                foreach ($model->getErrors() as $error) {
//                                    $message .= $error[0];
//                                }
//                                Yii::$app->session->setFlash('error', 'Error occured while creating gl accounts.Error:' . $gl_account);
//                            }
                            } else {
//                            // $model_general_ledger->general_ledger_account = $gl_account;
//                            // $model_general_ledger->activity_id=$model->activity_id;
//                            // $model_general_ledger->component_id=$model_activity->component_id;
//                            // $model_general_ledger->awpb_template_id=$model->awpb_template_id;
//                            //  $model_general_ledger->funder_id=$funder->id;
//                            //  $model_general_ledger->expense_category_id=$model_activity->expense_category_id;
                                $_model_general_ledger->mo_1_amount = ($model->mo_1_amount * $percent) / 100;
                                $_model_general_ledger->mo_2_amount = ($model->mo_2_amount * $percent) / 100;
                                $_model_general_ledger->mo_3_amount = ($model->mo_3_amount * $percent) / 100;
                                $_model_general_ledger->mo_4_amount = ($model->mo_4_amount * $percent) / 100;
                                $_model_general_ledger->mo_5_amount = ($model->mo_5_amount * $percent) / 100;
                                $_model_general_ledger->mo_6_amount = ($model->mo_6_amount * $percent) / 100;
                                $_model_general_ledger->mo_7_amount = ($model->mo_7_amount * $percent) / 100;
                                $_model_general_ledger->mo_8_amount = ($model->mo_8_amount * $percent) / 100;
                                $_model_general_ledger->mo_9_amount = ($model->mo_9_amount * $percent) / 100;
                                $_model_general_ledger->mo_10_amount = ($model->mo_10_amount * $percent) / 100;
                                $_model_general_ledger->mo_11_amount = ($model->mo_11_amount * $percent) / 100;
                                $_model_general_ledger->mo_12_amount = ($model->mo_12_amount * $percent) / 100;
                                $_model_general_ledger->quarter_one_amount = ($model->quarter_one_amount * $percent) / 100;
                                $_model_general_ledger->quarter_two_amount = ($model->quarter_two_amount * $percent) / 100;
                                $_model_general_ledger->quarter_three_amount = ( $model->quarter_three_amount * $percent) / 100;
                                $_model_general_ledger->quarter_four_amount = ($model->quarter_four_amount * $percent) / 100;
                                $_model_general_ledger->updated_by = Yii::$app->user->identity->id;
                                $_model_general_ledger->created_by = Yii::$app->user->identity->id;
                                $_model_general_ledger->save();
                            }
                        }}
                        $audit = new AuditTrail();

                        $audit->user = Yii::$app->user->id;
                        $audit->action = "Activity no. " . $model->activity_id . " funding profile set";
                        $audit->ip_address = Yii::$app->request->getUserIP();
                        $audit->user_agent = Yii::$app->request->getUserAgent();
                        $audit->save();
                        Yii::$app->session->setFlash('success', 'Activity funding setting was successfully updated.' . $model->activity_id);
                        return $this->redirect(['index']);
                    } else {
                        $message = '';
                        foreach ($model->getErrors() as $error) {
                            $message .= $error[0];
                        }
                        Yii::$app->session->setFlash('error', 'Error occured while setting the finding profie.Error:' . $message);
                    }
                } else {

                    Yii::$app->session->setFlash('error', 'The total percentage must be 100%. Please enter the required percentage');
                }
            }
            return $this->render('update', [
                        'model' => $model,
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    /**
     * Deletes an existing AwpbTemplateActivity model.
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
     * Finds the AwpbTemplateActivity model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AwpbTemplateActivity the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = AwpbTemplateActivity::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
