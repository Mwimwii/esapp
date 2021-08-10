<?php

namespace backend\controllers;

use Yii;
use backend\models\TimeSheetsDistrictStaff;
use backend\models\TimeSheetsDistrictStaffSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Json;
use backend\models\AuditTrail;
use yii\helpers\Html;
use backend\models\Storyofchange;
use backend\models\User;

/**
 * TimeSheetsController implements the CRUD actions for TimeSheetsDistrictStaff model.
 */
class TimeSheetsController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => [
                    'index', 'create', 'delete', 'view', 'submit-for-review',
                    'time-sheets', 'time-sheet-view', 'approve-time-sheet-action'
                ],
                'rules' => [
                    [
                        'actions' => [
                            'index', 'create', 'delete', 'view', 'submit-for-review',
                            'time-sheets', 'time-sheet-view', 'approve-time-sheet-action'
                        ],
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
     * Lists all TimeSheetsDistrictStaff models.
     * @return mixed
     */
    public function actionIndex() {
        if (User::userIsAllowedTo('Submit timesheets')) {
            $searchModel = new TimeSheetsDistrictStaffSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            $dataProvider->query->andFilterWhere(['created_by' => Yii::$app->user->id]);
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
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    public function actionTimeSheets() {
        if (User::userIsAllowedTo('Review timesheets') ||
                User::userIsAllowedTo("View time sheets")) {
            $searchModel = new TimeSheetsDistrictStaffSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
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
            
            if (User::userIsAllowedTo("View time sheets")) {
                //We pull BtORs for only a single province
                //We get ids of users that belong to a logged in users province
                $_users_model = User::find()->select(['id'])->where(['province_id' => Yii::$app->user->identity->province_id])->all();
                if (!empty($_users_model)) {
                    $_user_ids = [-1];
                    foreach ($_users_model as $model) {
                        array_push($_user_ids, $model['id']);
                    }
                    $dataProvider->query->andFilterWhere(['IN', 'created_by', $_user_ids]);
                }
            } else {
                //We pull BtORs for all provinces/Districts/Camps which have been submitted for review or have been accepted
                $dataProvider->query->andFilterWhere(["IN",'status', [TimeSheetsDistrictStaff::_status_pending_approval, TimeSheetsDistrictStaff::_accepted]]);
            }

            return $this->render('time-sheets', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    /**
     * Displays a single TimeSheetsDistrictStaff model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        if (User::userIsAllowedTo('Submit timesheets')) {
            return $this->render('view', [
                        'model' => $this->findModel($id),
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    public function actionTimeSheetView($id) {
        if (User::userIsAllowedTo('Review timesheets')) {
            return $this->render('time-sheet-view', [
                        'model' => $this->findModel($id),
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    public function actionApproveTimeSheetAction($id) {
        if (User::userIsAllowedTo('Review timesheets')) {
            $model = $this->findModel($id);
            $model1 = new TimeSheetsDistrictStaff();
            if ($model1->load(Yii::$app->request->post())) {
                $model->updated_by = Yii::$app->user->identity->id;
                $model->approved_by = Yii::$app->user->identity->id;
                $model->approved_at = date("Y-m-d");
                $model->status = $model1->status;
                $model->reviewer_comments = $model1->reviewer_comments;
                $_status = $model->status == TimeSheetsDistrictStaff::_accepted ? "Accepted" : "Send back for more information";
                if ($model->save(false)) {
                    $audit = new AuditTrail();
                    $audit->user = Yii::$app->user->id;
                    $audit->action = "Updated Time sheets's status to '" . $_status . "'";
                    $audit->ip_address = Yii::$app->request->getUserIP();
                    $audit->user_agent = Yii::$app->request->getUserAgent();
                    $audit->save();
                    if ($model->status == TimeSheetsDistrictStaff::_accepted) {
                        Yii::$app->session->setFlash('success', 'Time sheet action was successfully taken as accepted.');
                        return $this->redirect(['time-sheet-view', 'id' => $model->id]);
                    } else {
                        Yii::$app->session->setFlash('success', 'Time sheet action was successfully taken as need more information.');
                        //We send an email imforming user that the story needs more information
                        $_model = User::findOne($model->created_by);
                        if (!empty($_model)) {
                            $subject = "Time sheet: More information needed";
                            $resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/login']);
                            $msg = "";
                            $msg .= "<p>Dear " . $_model->first_name . " " . $_model->other_name . " " . $_model->last_name . ",<br/>";
                            $msg .= "One of your Time sheets have been sent back for more information. See below comments<br/>";
                            $msg .= "<i>" . $model->reviewer_comments . "</i></p>";
                            $msg .= '<p>You can login <i style="color: blue;">' . Html::a('(Click Here to Login)', $resetLink) . '</i> to make changes to the Time sheet</p>';
                            Storyofchange::sendEmail($msg, $subject, $_model->email);
                        }

                        return $this->redirect(['time-sheets']);
                    }
                } else {
                    Yii::$app->session->setFlash('error', 'Error occured while updating Time sheet action');
                }
            }
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    /**
     * Creates a new TimeSheetsDistrictStaff model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        if (User::userIsAllowedTo('Submit timesheets')) {
            $model = new TimeSheetsDistrictStaff();
            if (Yii::$app->request->isAjax) {
                $model->load(Yii::$app->request->post());
                return Json::encode(\yii\widgets\ActiveForm::validate($model));
            }

            //  if (!empty(Yii::$app->request->post()) && Yii::$app->request->post('submit_for_review') == 'true') {
            if ($model->load(Yii::$app->request->post())) {
                //var_dump(Yii::$app->user->getIdentity());
                $model->created_by = Yii::$app->user->id;
                $model->updated_by = Yii::$app->user->id;
                $model->province = Yii::$app->user->getIdentity()->province_id;
                $model->district = Yii::$app->user->getIdentity()->district_id;
                $model->status = TimeSheetsDistrictStaff::_status_pending_approval;
                $model->total_hours_worked = $model->hours_field_esapp_activities + $model->hours_office_esapp_activities;
                $rate_details = \backend\models\HourlyRates::findOne($model->designation);
                $model->designation = !empty($rate_details) ? $rate_details->designation . "-" . $rate_details->salary_scale : $model->designation;
                $model->contribution = $model->total_hours_worked * $rate_details->rate;
                $model->rate_id = $rate_details->id;

                if ($model->save()) {
                    $audit = new AuditTrail();
                    $audit->user = Yii::$app->user->id;
                    $audit->action = "Submitted time sheet for approve";
                    $audit->ip_address = Yii::$app->request->getUserIP();
                    $audit->user_agent = Yii::$app->request->getUserAgent();
                    $audit->save();
                    $_user = Yii::$app->user->getIdentity()->first_name . " " . Yii::$app->user->getIdentity()->other_name . " " . Yii::$app->user->getIdentity()->last_name;
                    $role_model = \common\models\RightAllocation::find()->where(['right' => 'Review timesheetss'])->all();
                    if (!empty($role_model)) {
                        $subject = "Time sheet:" . $_user . "-" . $model->month . " " . $model->year;
                        foreach ($role_model as $_role) {
                            //We now get all users with the fetched role
                            $resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/login']);
                            $_user_model = User::find()
                                    ->where(['role' => $_role->role])
                                    ->all();
                            if (!empty($_user_model)) {
                                //We send the emails
                                foreach ($_user_model as $_model) {
                                    $msg = "";
                                    $msg .= "<p>Dear " . $_model->first_name . " " . $_model->other_name . " " . $_model->last_name . ",<br/>";
                                    $msg .= $_user . " has submitted a 'Time Sheet' for your approval<br/>";
                                    $msg .= '<p>You can login <i style="color: blue;">' . Html::a('(Click Here to Login)', $resetLink) . '</i> to see more details and approve the submitted Time Sheet if you are suppose to approve District time sheets.'
                                            . ' <br/>Please ignore the email if you are not suppose to approve District Time Sheets</p>';
                                    \backend\models\Storyofchange::sendEmail($msg, $subject, $_model->email);
                                }
                            }
                        }
                    }

                    Yii::$app->session->setFlash('success', 'Time sheet was successfully submitted for approval');
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    $message = "";
                    foreach ($model->getErrors() as $error) {
                        $message .= $error[0];
                    }
                    Yii::$app->session->setFlash('error', 'Error occured while submitting time sheet for approval.Error::' . $message);
                }
            }

            /* if (!empty(Yii::$app->request->post()) && Yii::$app->request->post('submit for review') != 'true') {
              $model->load(Yii::$app->request->post());
              $model->created_by = Yii::$app->user->id;
              $model->updated_by = Yii::$app->user->id;
              $model->total_hours_worked = $model->hours_field_esapp_activities + $model->hours_office_esapp_activities;
              $rate_details = \backend\models\HourlyRates::findOne($model->designation);
              $model->designation = !empty($rate_details) ? $rate_details->designation . "-" . $rate_details->salary_scale : $model->designation;
              $model->contribution = $model->total_hours_worked * $rate_details->rate;
              $model->rate_id = $rate_details->id;
              $model->status = 0;

              if ($model->save()) {
              $audit = new AuditTrail();
              $audit->user = Yii::$app->user->id;
              $audit->action = "Saved time sheet as draft";
              $audit->ip_address = Yii::$app->request->getUserIP();
              $audit->user_agent = Yii::$app->request->getUserAgent();
              $audit->save();
              Yii::$app->session->setFlash('success', 'Time sheet was successfully saved as a draft');
              return $this->redirect(['view', 'id' => $model->id]);
              } else {
              $message = "";
              foreach ($model->getErrors() as $error) {
              $message .= $error[0];
              }
              Yii::$app->session->setFlash('error', 'Error occured while saving time sheet.Error::' . $message);
              }
              } */

            return $this->render('create', [
                        'model' => $model,
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    /**
     * Updates an existing TimeSheetsDistrictStaff model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        if (User::userIsAllowedTo('Submit timesheets')) {
            $model = $this->findModel($id);
            if (Yii::$app->request->isAjax) {
                $model->load(Yii::$app->request->post());
                return Json::encode(\yii\widgets\ActiveForm::validate($model));
            }
            if ($model->load(Yii::$app->request->post())) {
                //   var_dump(Yii::$app->user->getIdentity()->role);
                $model->created_by = Yii::$app->user->id;
                $model->updated_by = Yii::$app->user->id;
                $model->province = Yii::$app->user->getIdentity()->province_id;
                $model->district = Yii::$app->user->getIdentity()->district_id;
                $model->status = TimeSheetsDistrictStaff::_status_pending_approval;
                $model->total_hours_worked = $model->hours_field_esapp_activities + $model->hours_office_esapp_activities;
                $rate_details = \backend\models\HourlyRates::findOne($model->designation);
                $model->designation = !empty($rate_details) ? $rate_details->designation . "-" . $rate_details->salary_scale : $model->designation;
                $model->contribution = $model->total_hours_worked * $rate_details->rate;
                $model->rate_id = $rate_details->id;

                if ($model->save()) {
                    $audit = new AuditTrail();
                    $audit->user = Yii::$app->user->id;
                    $audit->action = "Updated and Submitted time sheet for approve";
                    $audit->ip_address = Yii::$app->request->getUserIP();
                    $audit->user_agent = Yii::$app->request->getUserAgent();
                    $audit->save();
                    $_user = Yii::$app->user->getIdentity()->first_name . " " . Yii::$app->user->getIdentity()->other_name . " " . Yii::$app->user->getIdentity()->last_name;
                    $role_model = \common\models\RightAllocation::find()->where(['right' => 'Review timesheetss'])->all();
                    if (!empty($role_model)) {
                        $subject = "Time sheet:" . $_user . "-" . $model->month . " " . $model->year;
                        foreach ($role_model as $_role) {
                            //We now get all users with the fetched role
                            $resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/login']);
                            $_user_model = User::find()
                                    ->where(['role' => $_role->role])
                                    ->all();
                            if (!empty($_user_model)) {
                                //We send the emails
                                foreach ($_user_model as $_model) {
                                    $msg = "";
                                    $msg .= "<p>Dear " . $_model->first_name . " " . $_model->other_name . " " . $_model->last_name . ",<br/>";
                                    $msg .= $_user . " has updated a submitted 'Time Sheet' for your approval<br/>";
                                    $msg .= '<p>You can login <i style="color: blue;">' . Html::a('(Click Here to Login)', $resetLink) . '</i> to see more details and approve the submitted Time Sheet if you are suppose to approve District time sheets.'
                                            . ' <br/>Please ignore the email if you are not suppose to approve District Time Sheets</p>';
                                    \backend\models\Storyofchange::sendEmail($msg, $subject, $_model->email);
                                }
                            }
                        }
                    }

                    Yii::$app->session->setFlash('success', 'Time sheet was successfully updated and submitted for approval');
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    $message = "";
                    foreach ($model->getErrors() as $error) {
                        $message .= $error[0];
                    }
                    Yii::$app->session->setFlash('error', 'Error occured while updating time sheet.Error::' . $message);
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
     * Deletes an existing TimeSheetsDistrictStaff model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        if (User::userIsAllowedTo('Submit timesheets')) {
            $model = $this->findModel($id);
            if ($model->delete()) {
                $audit = new AuditTrail();
                $audit->user = Yii::$app->user->id;
                $audit->action = "Removed time sheet from the system.";
                $audit->ip_address = Yii::$app->request->getUserIP();
                $audit->user_agent = Yii::$app->request->getUserAgent();
                $audit->save();
                Yii::$app->session->setFlash('success', "Time sheet  was successfully removed.");
            } else {
                Yii::$app->session->setFlash('error', "Time sheet could not be removed. Please try again!");
            }
            return $this->redirect(['index']);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    /**
     * Finds the TimeSheetsDistrictStaff model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TimeSheetsDistrictStaff the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = TimeSheetsDistrictStaff::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
