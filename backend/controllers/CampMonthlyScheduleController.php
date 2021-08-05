<?php

namespace backend\controllers;

use Yii;
use backend\models\MeCampSubprojectRecordsPlannedWorkEffort;
use backend\models\MeCampSubprojectRecordsPlannedWorkEffortSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Json;
use backend\models\AuditTrail;
use backend\models\User;
use yii\helpers\Html;

/**
 * CampPlannedWorkEffortController implements the CRUD actions for MeCampSubprojectRecordsPlannedWorkEffort model.
 */
class CampMonthlyScheduleController extends Controller {
    /**
     * {@inheritdoc}
     */

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'create', 'delete', 'view', 'work-effort', 'add-activity',
                    'update-activity', 'achieved-monthly-modal',
                    'update-achieved-target', 'delete-activity', 'delete-achieved-activity-target'],
                'rules' => [
                    [
                        'actions' => ['index', 'create', 'delete', 'view', 'work-effort', 'add-activity',
                            'update-activity', 'achieved-monthly-modal',
                            'update-achieved-target', 'delete-activity', 'delete-achieved-activity-target'],
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
     * Lists all MeCampSubprojectRecordsPlannedWorkEffort models.
     * @return mixed
     */
    public function actionIndex() {
        if (User::userIsAllowedTo('Plan camp monthly activities') ||
                User::userIsAllowedTo('View planned camp monthly activities')) {
            $model = new MeCampSubprojectRecordsPlannedWorkEffort();
            $searchModel = new MeCampSubprojectRecordsPlannedWorkEffortSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            //$dataProvider->query->andFilterWhere(['created_by' => Yii::$app->user->id]);
            if (!empty(Yii::$app->user->identity->district_id) && Yii::$app->user->identity->district_id > 0) {
                $_camp_ids = [];
                $camp_ids = \backend\models\Camps::find()
                        ->select(['id'])
                        ->where(['district_id' => Yii::$app->user->identity->district_id])
                        ->asArray()
                        ->all();
                if (!empty($camp_ids)) {
                    foreach ($camp_ids as $id) {
                        array_push($_camp_ids, $id['id']);
                    }
                }
                $dataProvider->query->andFilterWhere(['IN', 'camp_id', $_camp_ids]);
            }

            $dataProvider->pagination = ['pageSize' => 15];
            $dataProvider->setSort([
                'attributes' => [
                    'created_at' => [
                        'desc' => ['created_at' => SORT_DESC],
                        'default' => SORT_DESC
                    ],
                ],
                'defaultOrder' => [
                    'created_at' => SORT_DESC
                ]
            ]);
            return $this->render('index', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                        'model' => $model,
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    /**
     * Displays a single MeCampSubprojectRecordsPlannedWorkEffort model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id, $camp_id = "") {
        if (User::userIsAllowedTo('Plan camp monthly activities') ||
                User::userIsAllowedTo('View planned camp monthly activities')) {
            return $this->render('view', [
                        'model' => $this->findModel($id),
                        'work_effort_id' => $id
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    /**
     * Creates a new MeCampSubprojectRecordsPlannedWorkEffort model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionWorkEffort() {
        if (User::userIsAllowedTo('Plan camp monthly activities')) {

            $model = new MeCampSubprojectRecordsPlannedWorkEffort();

            if (Yii::$app->request->isAjax) {
                $model->load(Yii::$app->request->post());
                return Json::encode(\yii\widgets\ActiveForm::validate($model));
            }
            if ($model->load(Yii::$app->request->post())) {
                $model->created_by = Yii::$app->user->identity->id;
                $model->updated_by = Yii::$app->user->identity->id;
                $model->days_in_month = date('t');
                $model->month = date('n');
                $model->days_total = $model->days_field + $model->days_office;
                $model->year = date('Y');
                if ($model->save()) {
                    $camp = \backend\models\Camps::findOne($model->camp_id)->name;
                    $audit = new AuditTrail();
                    $audit->user = Yii::$app->user->id;
                    $audit->action = "Added $camp camp work effort for month " . date('F');
                    $audit->ip_address = Yii::$app->request->getUserIP();
                    $audit->user_agent = Yii::$app->request->getUserAgent();
                    $audit->save();
                    Yii::$app->session->setFlash('success', $camp . ' camp monthly work effort was successfully added.You can add planned activities for this month');
                    return $this->redirect(['view', 'id' => $model->id, 'camp_id' => $model->camp_id]);
                } else {
                    Yii::$app->session->setFlash('error', 'Error occured while adding camp monthly work effort');
                }
            }

            return $this->render('create', [
                        'model' => $model,
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    /**
     * Updates an existing MeCampSubprojectRecordsPlannedWorkEffort model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        if (User::userIsAllowedTo('Plan camp monthly activities')) {
            $model = $this->findModel($id);
            if (Yii::$app->request->isAjax) {
                $model->load(Yii::$app->request->post());
                return Json::encode(\yii\widgets\ActiveForm::validate($model));
            }
            if ($model->load(Yii::$app->request->post())) {
                $model->updated_by = Yii::$app->user->identity->id;
                if ($model->save()) {
                    $camp = \backend\models\Camps::findOne($model->camp_id)->name;
                    $audit = new AuditTrail();
                    $audit->user = Yii::$app->user->id;
                    $audit->action = "Updated $camp camp work effort for month " . \DateTime::createFromFormat('!m', $model->month)->format('F');
                    $audit->ip_address = Yii::$app->request->getUserIP();
                    $audit->user_agent = Yii::$app->request->getUserAgent();
                    $audit->save();
                    Yii::$app->session->setFlash('success', $camp . ' camp monthly work effort was successfully updated.You can add planned activities for this month');
                    return $this->redirect(['view', 'id' => $model->id, 'camp_id' => $model->camp_id]);
                } else {
                    Yii::$app->session->setFlash('error', 'Error occured while updating camp monthly work effort');
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

    public function actionAddActivity($work_effort_id) {
        if (User::userIsAllowedTo('Plan camp monthly activities')) {
            $model = new \backend\models\MeCampSubprojectRecordsMonthlyPlannedActivities();
            if (Yii::$app->request->isAjax) {
                $model->load(Yii::$app->request->post());
                return Json::encode(\yii\widgets\ActiveForm::validate($model));
            }

            if ($model->load(Yii::$app->request->post())) {
                $awpb_budget = \backend\models\AwpbBudget::findOne(["activity_id" => $model->activity_id]);
                $model->created_by = Yii::$app->user->identity->id;
                $model->updated_by = Yii::$app->user->identity->id;
                $model->work_effort_id = $work_effort_id;
                $model->zone = "Zone";
                $model->beneficiary_target_women = $awpb_budget->number_of_females;
                $model->beneficiary_target_youth = $awpb_budget->number_of_young_people;
                $model->beneficiary_target_women_headed = $awpb_budget->number_of_women_headed_households;

                $model->beneficiary_target_total = $model->beneficiary_target_women +
                        $model->beneficiary_target_youth + $model->beneficiary_target_women_headed;
                //We get the activity target for the month
                $_model = MeCampSubprojectRecordsPlannedWorkEffort::findOne($work_effort_id);
                $model->activity_target = (string) $this->getMonthlyTarget($_model, $awpb_budget);
                //$model->activity_target = (string) $model->activity_target;

                if ($model->save()) {

                    $camp = \backend\models\Camps::findOne($_model->camp_id)->name;
                    $audit = new AuditTrail();
                    $audit->user = Yii::$app->user->id;
                    $audit->action = "Added $camp camp planned activity for month " . \DateTime::createFromFormat('!m', $_model->month)->format('F');
                    $audit->ip_address = Yii::$app->request->getUserIP();
                    $audit->user_agent = Yii::$app->request->getUserAgent();
                    $audit->save();
                    Yii::$app->session->setFlash('success', $camp . ' camp monthly planned activity was successfully added.');
                } else {
                    $message = "";
                    foreach ($model->getErrors() as $error) {
                        $message .= $error[0];
                    }
                    Yii::$app->session->setFlash('error', 'Error occured while adding camp monthly planned activity::' . $message);
                }
                return $this->redirect(['view', 'id' => $work_effort_id, 'camp_id' => '']);
            }
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    public function actionUpdateActivity($id, $source_id) {
        if (User::userIsAllowedTo('Plan camp monthly activities')) {
            $model = \backend\models\MeCampSubprojectRecordsMonthlyPlannedActivities::findOne($id);
            if ($model->load(Yii::$app->request->post())) {
                //Yii::warning('-----', var_export(Yii::$app->request->post, true));
                $awpb_budget = \backend\models\AwpbBudget::findOne(["activity_id" => $model->activity_id]);
                $model->updated_by = Yii::$app->user->identity->id;
                $model->beneficiary_target_women = $awpb_budget->number_of_females;
                $model->beneficiary_target_youth = $awpb_budget->number_of_young_people;
                $model->beneficiary_target_women_headed = $awpb_budget->number_of_women_headed_households;

                $model->beneficiary_target_total = $model->beneficiary_target_women +
                        $model->beneficiary_target_youth + $model->beneficiary_target_women_headed;
                //We get the activity target for the month
                $_model = MeCampSubprojectRecordsPlannedWorkEffort::findOne($source_id);
                $model->activity_target = (string) $this->getMonthlyTarget($_model, $awpb_budget);

                if ($model->save()) {
                    $camp = \backend\models\Camps::findOne($_model->camp_id)->name;
                    $audit = new AuditTrail();
                    $audit->user = Yii::$app->user->id;
                    $audit->action = "Updated $camp camp planned activity for month " . \DateTime::createFromFormat('!m', $_model->month)->format('F');
                    $audit->ip_address = Yii::$app->request->getUserIP();
                    $audit->user_agent = Yii::$app->request->getUserAgent();
                    $audit->save();
                    if (Yii::$app->request->isAjax) {
                        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                        Yii::$app->session->setFlash('success', 'Activity was successfully updated..');
                        return $this->redirect(['view', 'id' => $source_id, 'camp_id' =>
                                    ""]);
                    }
                }
            }
            if (Yii::$app->request->isAjax) {
                return $this->renderAjax('update_planned_activity', [
                            'id' => $id, //planned activity id
                            'model' => $model,
                            'source_id' => $source_id//work effort id
                ]);
            }
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    private function getMonthlyTarget($_model, $activity_budget_model) {
        $target = "";
        if ($_model->month == 1) {
            $target = $activity_budget_model->mo_1;
        }
        if ($_model->month == 2) {
            $target = $activity_budget_model->mo_2;
        }
        if ($_model->month == 3) {
            $target = $activity_budget_model->mo_3;
        }
        if ($_model->month == 4) {
            $target = $activity_budget_model->mo_4;
        }
        if ($_model->month == 5) {
            $target = $activity_budget_model->mo_5;
        }
        if ($_model->month == 6) {
            $target = $activity_budget_model->mo_6;
        }
        if ($_model->month == 7) {
            $target = $activity_budget_model->mo_7;
        }
        if ($_model->month == 8) {
            $target = $activity_budget_model->mo_8;
        }
        if ($_model->month == 9) {
            $target = $activity_budget_model->mo_9;
        }
        if ($_model->month == 10) {
            $target = $activity_budget_model->mo_10;
        }
        if ($_model->month == 11) {
            $target = $activity_budget_model->mo_11;
        }
        if ($_model->month == 12) {
            $target = $activity_budget_model->mo_12;
        }
        return $target;
    }

    public function actionAchievedMonthlyModal($id, $source_id) {
        $model = new \backend\models\MeCampSubprojectRecordsMonthlyPlannedActivitiesActual();

        if ($model->load(Yii::$app->request->post())) {
            //Yii::warning('-----', var_export(Yii::$app->request->post, true));
            $model->created_by = Yii::$app->user->identity->id;
            $model->updated_by = Yii::$app->user->identity->id;
            $model->planned_activity_id = $id;
            $model->hours_worked_total = (string) $model->hours_worked_field + $model->hours_worked_office;
            $model->beneficiary_target_achieved_total = (string)
                    $model->beneficiary_target_achieved_women +
                    $model->beneficiary_target_achieved_youth +
                    $model->beneficiary_target_achieved_women_headed;
            if ($model->save()) {
                //We update the activity line actuals for a particular month
                //1. Get the work effort to get the month
                $work_effort_model = MeCampSubprojectRecordsPlannedWorkEffort::findOne($source_id);
                //2. Get planned activity to get the awpb activity line id
                $planned_activity_model = \backend\models\MeCampSubprojectRecordsMonthlyPlannedActivities::findOne($id);
                //3. Get the activity line model
                $activity_line_model = \backend\models\AwpbBudget::findOne(["activity_id" => $planned_activity_model->activity_id]);
                //$activity_line_model = \backend\models\AwpbActivityLine::findOne($planned_activity_model->activity_id);
                //4. Get the name of the actuals month column to update
                $column = \backend\models\MeCampSubprojectRecordsMonthlyPlannedActivities::getMonthColumnNameActuals($work_effort_model->month);
                //5. Get actuals quarter
                $quarter_column = \backend\models\MeCampSubprojectRecordsMonthlyPlannedActivities::getQuarter($work_effort_model->month);

                //We add actuals in the budget table
                $activity_line_model->number_of_females_actual += $model->beneficiary_target_achieved_women;
                $activity_line_model->number_of_young_people_actual += $model->beneficiary_target_achieved_youth;
                $activity_line_model->number_of_women_headed_households_actual += $model->beneficiary_target_achieved_women_headed;

                $activity_line_model->$quarter_column += $model->achieved_activity_target;
                $activity_line_model->$column += $model->achieved_activity_target;
                $activity_line_model->save(false);

                //We also add to the cumulative actual for the activity
                $activity_model = \backend\models\AwpbActivity::findOne($activity_line_model->activity_id);
                $activity_model->cumulative_actual += $model->achieved_activity_target;
                $activity_model->save(false);

                if (Yii::$app->request->isAjax) {
                    Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                    Yii::$app->session->setFlash('success', 'Actual/Achieved activity targets were successfully added.');
                    return $this->redirect(['view', 'id' => $source_id, 'camp_id' =>
                                ""]);
                }
            }

            //  Yii::warning('ERRORS::', var_export($model->getErrors(), true));
        }
        if (Yii::$app->request->isAjax) {

            return $this->renderAjax('achieved-monthly-modal', [
                        'id' => $id, //planned activity id
                        'model' => $model,
                        'source_id' => $source_id//work effort id
            ]);
        }
    }

    public function actionUpdateAchievedTarget($id, $source_id) {
        $model = \backend\models\MeCampSubprojectRecordsMonthlyPlannedActivitiesActual::findOne($id);
        $old_achieved_target = $model->achieved_activity_target;
        $old_number_of_females_actual = $model->beneficiary_target_achieved_women;
        $old_number_of_young_people_actual = $model->beneficiary_target_achieved_youth;
        $old_number_of_women_headed_households_actual = $model->beneficiary_target_achieved_women_headed;


        if ($model->load(Yii::$app->request->post())) {
            //Yii::warning('-----', var_export(Yii::$app->request->post, true));
            $model->updated_by = Yii::$app->user->identity->id;
            $model->hours_worked_total = (string) $model->hours_worked_field + $model->hours_worked_office;
            $model->beneficiary_target_achieved_total = (string)
                    $model->beneficiary_target_achieved_women +
                    $model->beneficiary_target_achieved_youth +
                    $model->beneficiary_target_achieved_women_headed;

            if ($model->save()) {
                //We update the activity line actuals for a particular month
                //1. Get the work effort to get the month
                $work_effort_model = MeCampSubprojectRecordsPlannedWorkEffort::findOne($source_id);
                //2. Get planned activity to get the awpb activity line id
                $planned_activity_model = \backend\models\MeCampSubprojectRecordsMonthlyPlannedActivities::findOne($model->planned_activity_id);
                //3. Get the activity line model
                $activity_line_model = \backend\models\AwpbBudget::findOne(["activity_id" => $planned_activity_model->activity_id]);
                //4. Get the name of the actuals month column to update
                $column = \backend\models\MeCampSubprojectRecordsMonthlyPlannedActivities::getMonthColumnNameActuals($work_effort_model->month);
                //5. Get actuals quarter
                $quarter_column = \backend\models\MeCampSubprojectRecordsMonthlyPlannedActivities::getQuarter($work_effort_model->month);

                //We remove from actuals since we are doing an update before adding new values
                $activity_line_model->number_of_females_actual -= $old_number_of_females_actual;
                $activity_line_model->number_of_young_people_actual -= $old_number_of_young_people_actual;
                $activity_line_model->number_of_women_headed_households_actual -= $old_number_of_women_headed_households_actual;
                $activity_line_model->$column -= $old_achieved_target;
                $activity_line_model->$quarter_column -= $old_achieved_target;

                //We now add actuals in the budget table
                //Since its an update and we had already added to the actuals columns
                //First we remove what we added then we add the new achieved target
                $activity_line_model->number_of_females_actual += $model->beneficiary_target_achieved_women;
                $activity_line_model->number_of_young_people_actual += $model->beneficiary_target_achieved_youth;
                $activity_line_model->number_of_women_headed_households_actual += $model->beneficiary_target_achieved_women_headed;
                $activity_line_model->$quarter_column += $model->achieved_activity_target;
                $activity_line_model->$column += $model->achieved_activity_target;

                //We also add to the cumulative actual for the activity
                $activity_model = \backend\models\AwpbActivity::findOne($activity_line_model->activity_id);
                $activity_model->cumulative_actual -= $old_achieved_target;
                $activity_model->cumulative_actual += $model->achieved_activity_target;
                $activity_model->save(false);

                $activity_line_model->save(false);
                if (Yii::$app->request->isAjax) {
                    Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                    Yii::$app->session->setFlash('success', 'Actual/Achieved activity targets were successfully updated.');
                    return $this->redirect(['view', 'id' => $source_id, 'camp_id' =>
                                ""]);
                }
            }

            // Yii::warning('ERRORS::', var_export($model->getErrors(), true));
        }
        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('achieved-monthly-modal_1', [
                        'id' => $id, //planned activity id
                        'model' => $model,
                        'source_id' => $source_id//work effort id
            ]);
        }
    }

    /**
     * Deletes an existing MeCampSubprojectRecordsPlannedWorkEffort model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        if (User::userIsAllowedTo('Remove planned camp monthly activities')) {
            $model = $this->findModel($id);
            $camp = \backend\models\Camps::findOne($model->camp_id)->name;
            //get all planned activities
            $activity_list = \backend\models\MeCampSubprojectRecordsMonthlyPlannedActivities::find()
                    ->select(['id'])
                    ->where(['work_effort_id' => $id])
                    ->all();
            if (!empty($activity_list)) {
                foreach ($activity_list as $value) {
                    $_actual_model = \backend\models\MeCampSubprojectRecordsMonthlyPlannedActivitiesActual::findOne(['planned_activity_id' => $value['id']]);
                    if (!empty($_actual_model)) {
                        $_actual_model->delete();
                    }
                    $_planned_model = \backend\models\MeCampSubprojectRecordsMonthlyPlannedActivities::findOne($value['id']);
                    if (!empty($_planned_model)) {
                        $_planned_model->delete();
                    }
                }
            }

            if ($model->delete()) {
                $audit = new AuditTrail();
                $audit->user = Yii::$app->user->id;
                $audit->action = "Removed monthly work effort and all planned activities for camp: $camp from the systemfor the month of " . \DateTime::createFromFormat('!m', $model->month)->format('F');
                $audit->ip_address = Yii::$app->request->getUserIP();
                $audit->user_agent = Yii::$app->request->getUserAgent();
                $audit->save();
                Yii::$app->session->setFlash('success', "Work effort for the camp: $camp was successfully removed.");
            } else {
                Yii::$app->session->setFlash('error', "Work effort for the camp: $camp could not be removed. Please try again!");
            }

            return $this->redirect(['index']);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    public function actionDeleteActivity($id, $id1) {
        if (User::userIsAllowedTo('Remove planned camp monthly activities')) {
            $model = \backend\models\MeCampSubprojectRecordsMonthlyPlannedActivities::findOne($id);
            $_model = MeCampSubprojectRecordsPlannedWorkEffort::findOne($model->work_effort_id);
            $camp = \backend\models\Camps::findOne($_model->camp_id)->name;
            //$activity = \backend\models\AwpbActivityLine::findOne($model->activity_id)->name;

            $_actual_model = \backend\models\MeCampSubprojectRecordsMonthlyPlannedActivitiesActual::findOne(['planned_activity_id' => $model->id]);
            if (!empty($_actual_model)) {
                $_actual_model->delete();
            }
            if ($model->delete()) {
                $audit = new AuditTrail();
                $audit->user = Yii::$app->user->id;
                $audit->action = "Removed planned activities and all submitted actuals/achieved for camp: $camp for activity from the system for the month of " . \DateTime::createFromFormat('!m', $_model->month)->format('F');
                $audit->ip_address = Yii::$app->request->getUserIP();
                $audit->user_agent = Yii::$app->request->getUserAgent();
                $audit->save();
                Yii::$app->session->setFlash('success', "Planned activity and submitted actual/achieved targets were successfully removed.");
            } else {
                Yii::$app->session->setFlash('error', "Planned activity could not be removed. Please try again!");
            }

            return $this->redirect(['view', 'id' => $id1, 'camp_id' =>
                        ""]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    public function actionDeleteAchievedActivityTarget($id, $id1) {
        if (User::userIsAllowedTo('Remove planned camp monthly activities')) {
            $model = \backend\models\MeCampSubprojectRecordsMonthlyPlannedActivitiesActual::findOne($id);
            $_model = \backend\models\MeCampSubprojectRecordsMonthlyPlannedActivities::findOne($model->planned_activity_id);
            $_Model = MeCampSubprojectRecordsPlannedWorkEffort::findOne($_model->work_effort_id);
            $camp = \backend\models\Camps::findOne($_Model->camp_id)->name;
            $activity_model = \backend\models\AwpbActivity::findOne($_model->activity_id);
            $activity_budget_model = \backend\models\AwpbBudget::findOne(["activity_id" => $_model->activity_id]);

            $activity = $activity_model->name;
            //1. Get the name of the actuals month column to update
            $column = \backend\models\MeCampSubprojectRecordsMonthlyPlannedActivities::getMonthColumnNameActuals($_Model->month);
            $quarter_column = \backend\models\MeCampSubprojectRecordsMonthlyPlannedActivities::getQuarter($_Model->month);

            //2. We remove what we added aswell to the activity line actuals
            $activity_budget_model->number_of_females_actual -= $model->beneficiary_target_achieved_women;
            $activity_budget_model->number_of_young_people_actual -= $model->beneficiary_target_achieved_youth;
            $activity_budget_model->number_of_women_headed_households_actual -= $model->beneficiary_target_achieved_women_headed;
            $activity_budget_model->$quarter_column -= $model->achieved_activity_target;
            $activity_budget_model->$column -= $model->achieved_activity_target;
            $activity_budget_model->save(false);

            // $activity_model->$column -= $model->achieved_activity_target;
            $activity_model->cumulative_actual -= $model->achieved_activity_target;
            $activity_model->save(false);

            if ($model->delete()) {
                $audit = new AuditTrail();
                $audit->user = Yii::$app->user->id;
                $audit->action = "Removed submitted achieved planned activity targets for camp: $camp for activity:$activity from the system for the month of " . \DateTime::createFromFormat('!m', $_Model->month)->format('F');
                $audit->ip_address = Yii::$app->request->getUserIP();
                $audit->user_agent = Yii::$app->request->getUserAgent();
                $audit->save();
                Yii::$app->session->setFlash('success', "Submitted activity actual/achieved target were successfully removed.");
            } else {
                Yii::$app->session->setFlash('error', "ubmitted activity actual/achieved target could not be removed. Please try again!");
            }

            return $this->redirect(['view', 'id' => $id1, 'camp_id' =>
                        ""]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    /**
     * Finds the MeCampSubprojectRecordsPlannedWorkEffort model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MeCampSubprojectRecordsPlannedWorkEffort the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = MeCampSubprojectRecordsPlannedWorkEffort::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
