<?php

namespace backend\controllers;

use Yii;
use backend\models\MeBackToOfficeReport;
use backend\models\MeBackToOfficeReportSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Json;
use backend\models\AuditTrail;
use backend\models\User;
use yii\helpers\Html;
use backend\models\Storyofchange;
use yii\web\UploadedFile;

/**
 * BackToOfficeReportController implements the CRUD actions for MeBackToOfficeReport model.
 */
class BackToOfficeReportController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'create', 'delete', 'view', 'submit-for-review',
                    'btor-reports', 'btor-report-view', 'review-btor-action'],
                'rules' => [
                    [
                        'actions' => ['index', 'create', 'delete', 'view', 'submit-for-review',
                            'btor-reports', 'btor-report-view', 'review-btor-action'],
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
     * Lists all MeBackToOfficeReport models.
     * @return mixed
     */
    public function actionIndex() {
        if (User::userIsAllowedTo('Submit back to office report')) {
            $searchModel = new MeBackToOfficeReportSearch();
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

    public function actionBtorReports() {
        if (User::userIsAllowedTo('Review back to office report') ||
                User::userIsAllowedTo("View back to office report")) {
            $searchModel = new MeBackToOfficeReportSearch();
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
            if (User::userIsAllowedTo("View back to office report")) {
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
                $dataProvider->query->andFilterWhere(['IN', 'status', [2, 1]]);
            }

            return $this->render('btor-reports', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    public function actionBtorReportView($id) {
        if (User::userIsAllowedTo('Review back to office report')) {
            return $this->render('btor-report-view', [
                        'model' => $this->findModel($id),
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    public function actionReviewBtorAction($id) {
        if (User::userIsAllowedTo('Review back to office report')) {
            $model = $this->findModel($id);
            $model1 = new MeBackToOfficeReport();
            if ($model1->load(Yii::$app->request->post())) {
                $model->updated_by = Yii::$app->user->identity->id;
                $model->status = $model1->status;
                $model->reviewer_comments = $model1->reviewer_comments;
                $_status = $model->status == Storyofchange::_accepted ? "Accepted" : "Send back for more information";
                if ($model->save(false)) {
                    $audit = new AuditTrail();
                    $audit->user = Yii::$app->user->id;
                    $audit->action = "Updated BtOR report's status to '" . $_status . "'";
                    $audit->ip_address = Yii::$app->request->getUserIP();
                    $audit->user_agent = Yii::$app->request->getUserAgent();
                    $audit->save();
                    if ($model->status == Storyofchange::_accepted) {
                        Yii::$app->session->setFlash('success', 'BtOR report action was successfully taken as accepted.');
                        return $this->redirect(['btor-report-view', 'id' => $model->id]);
                    } else {
                        Yii::$app->session->setFlash('success', 'BtOR report action was successfully taken as need more information.');
                        //We send an email imforming user that the story needs more information
                        $_model = User::findOne($model->created_by);
                        if (!empty($_model)) {
                            $subject = "Back to office report: More information needed";
                            $resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/login']);
                            $msg = "";
                            $msg .= "<p>Dear " . $_model->first_name . " " . $_model->other_name . " " . $_model->last_name . ",<br/>";
                            $msg .= "One of your Back to office reports have been sent back for more information. See below comments<br/>";
                            $msg .= "<i>" . $model->reviewer_comments . "</i></p>";
                            $msg .= '<p>You can login <i style="color: blue;">' . Html::a('(Click Here to Login)', $resetLink) . '</i> to make changes to the Back to office report</p>';
                            Storyofchange::sendEmail($msg, $subject, $_model->email);
                        }

                        return $this->redirect(['btor-reports']);
                    }
                } else {
                    Yii::$app->session->setFlash('error', 'Error occured while updating BtOR report action');
                }
            }
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    /**
     * Displays a single MeBackToOfficeReport model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        if (User::userIsAllowedTo('Submit back to office report')) {
            return $this->render('view', [
                        'model' => $this->findModel($id),
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    public function actionMedia($id, $type = "") {
        if (User::userIsAllowedTo('Submit back to office report')) {
            $model = new \backend\models\BackToOfficeAnnexes();
            $model2 = $this->findModel($id);
            $model->type = $type;
            if (Yii::$app->request->isAjax) {
                $model->load(Yii::$app->request->post());
                return Json::encode(\yii\widgets\ActiveForm::validate($model));
            }

            if ($model->load(Yii::$app->request->post())) {
                $media_file = UploadedFile::getInstance($model, 'file');


                if (!empty($media_file)) {

                    $Filename = Yii::$app->security->generateRandomString(45) . '.' . $media_file->extension;
                    $model->file = $Filename;
                    $model->btor_id = $id;

                    !empty($media_file->name) ? $model->file_name = $media_file->name : "";

                    if ($model->type === "Image") {
                        $media_file->saveAs(Yii::getAlias('@backend') . '/web/uploads/image/' . $Filename);
                    }
                    if ($model->type === "Video") {
                        $media_file->saveAs(Yii::getAlias('@backend') . '/web/uploads/video/' . $Filename);
                    }

                    if ($model->save()) {
                        $audit = new AuditTrail();
                        $audit->user = Yii::$app->user->id;
                        $audit->action = "Added Back to Office media: " . $model->type;
                        $audit->ip_address = Yii::$app->request->getUserIP();
                        $audit->user_agent = Yii::$app->request->getUserAgent();
                        $audit->save();
                        $model = new \backend\models\BackToOfficeAnnexes();
                        Yii::$app->session->setFlash('success', 'Back to Office media was successfully added.You can add another ' . $type);
                    } else {
                        Yii::$app->session->setFlash('error', 'Error occured while adding Back to Office media ');
                    }
                }
            }

            return $this->render('media', [
                        'model' => $model,
                        'model2' => $model2,
                        "type" => $type
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    public function actionUpdateMedia($id, $id1, $type = "") {
        if (User::userIsAllowedTo('Submit back to office report')) {
            $model = \backend\models\BackToOfficeAnnexes::findOne($id);
            $file = $model->file;
            $model2 = $this->findModel($id1);
            $model->type = $type;

            if (Yii::$app->request->isAjax) {
                $model->load(Yii::$app->request->post());
                return Json::encode(\yii\widgets\ActiveForm::validate($model));
            }

            if ($model->load(Yii::$app->request->post())) {
                $media_file = UploadedFile::getInstance($model, 'file');

                if (!empty($media_file)) {

                    $Filename = Yii::$app->security->generateRandomString(45) . '.' . $media_file->extension;
                    $model->file = $Filename;
                    $model->type = $type;
                    //$model->btor_id = $id1;
                    !empty($media_file->name) ? $model->file_name = $media_file->name : "";

                    if ($model->type === "Image") {
                        $media_file->saveAs(Yii::getAlias('@backend') . '/web/uploads/image/' . $Filename);
                        $_file = Yii::getAlias('@backend') . '/web/uploads/image/' . $file;
                        if (file_exists($_file)) {
                            unlink($_file);
                        }
                    }
                    if ($model->type === "Video") {
                        $media_file->saveAs(Yii::getAlias('@backend') . '/web/uploads/video/' . $Filename);
                        $_file = Yii::getAlias('@backend') . '/web/uploads/video/' . $file;
                        if (file_exists($_file)) {
                            unlink($_file);
                        }
                    }

                    if ($model->save(false)) {
                        $audit = new AuditTrail();
                        $audit->user = Yii::$app->user->id;
                        $audit->action = "Updated Back to Office media: " . $model->type;
                        $audit->ip_address = Yii::$app->request->getUserIP();
                        $audit->user_agent = Yii::$app->request->getUserAgent();
                        $audit->save();
                        Yii::$app->session->setFlash('success', 'Back to Office media was successfully updated.');
                        return $this->redirect(['view', 'id' => $id1]);
                    } else {
                        $message = '';
                        foreach ($model->getErrors() as $error) {
                            $message .= $error[0];
                        }
                        Yii::$app->session->setFlash('error', 'Error occured while updating Back to Office media.Error::' . $message);
                    }
                }
            }

            return $this->render('update-media', [
                        'model' => $model,
                        'model2' => $model2,
                        "type" => $type
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    /**
     * Creates a new MeBackToOfficeReport model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        if (User::userIsAllowedTo('Submit back to office report')) {
            $model = new MeBackToOfficeReport();
            if (Yii::$app->request->isAjax) {
                $model->load(Yii::$app->request->post());
                return Json::encode(\yii\widgets\ActiveForm::validate($model));
            }

            if (!empty(Yii::$app->request->post()) && Yii::$app->request->post('submit_for_review') == 'true') {
                //var_dump(Yii::$app->request->post());
                $model->load(Yii::$app->request->post());
                $model->team_members = implode(", ", $model->team_members);
                list( $model->start_date, $model->end_date) = explode('to', $model->travel_dates);
                $model->created_by = Yii::$app->user->id;
                $model->updated_by = Yii::$app->user->id;
                $model->status = \backend\models\Storyofchange::_submitted_for_review;
                if ($model->save()) {
                    $audit = new AuditTrail();
                    $audit->user = Yii::$app->user->id;
                    $audit->action = "Submitted a back to office report for review";
                    $audit->ip_address = Yii::$app->request->getUserIP();
                    $audit->user_agent = Yii::$app->request->getUserAgent();
                    $audit->save();
                    $role_model = \common\models\RightAllocation::find()->where(['right' => 'Review back to office report'])->all();
                    if (!empty($role_model)) {
                        $subject = "Back to office report:" . $model->name_of_officer;
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
                                    $msg .= $model->name_of_officer . " has submitted a 'Back to office report' below is the summary of the assignment outcome<br/>";
                                    $msg .= $model->summary_of_assignment_outcomes . "</b></p>";
                                     $msg .= '<p>You can login <i style="color: blue;">' . Html::a('(Click Here to Login)', $resetLink) . '</i> to see more details and review the submitted BtOR if you are suppose to review Back To Office reports.'
                                            . ' Please ignore the email if you are not suppose to review Back to Office reports</p>';
                                    \backend\models\Storyofchange::sendEmail($msg, $subject, $_model->email);
                                }
                            }
                        }
                    }

                    Yii::$app->session->setFlash('success', 'Back to office report was successfully submitted for review');
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    $message = "";
                    foreach ($model->getErrors() as $error) {
                        $message .= $error[0];
                    }
                    Yii::$app->session->setFlash('error', 'Error occured while submitting back to office report for review.Error::' . $message);
                }
            }


            if (!empty(Yii::$app->request->post()) && Yii::$app->request->post('submit for review') != 'true') {
                $model->load(Yii::$app->request->post());
                $model->team_members = implode(", ", $model->team_members);
                list( $model->start_date, $model->end_date) = explode('to', $model->travel_dates);
                $model->created_by = Yii::$app->user->id;
                $model->updated_by = Yii::$app->user->id;
                $model->status = 0;
                if ($model->save()) {
                    $audit = new AuditTrail();
                    $audit->user = Yii::$app->user->id;
                    $audit->action = "Saved back to office report as draft";
                    $audit->ip_address = Yii::$app->request->getUserIP();
                    $audit->user_agent = Yii::$app->request->getUserAgent();
                    $audit->save();
                    Yii::$app->session->setFlash('success', 'Back to office report was successfully saved as a draft');
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    $message = "";
                    foreach ($model->getErrors() as $error) {
                        $message .= $error[0];
                    }
                    Yii::$app->session->setFlash('error', 'Error occured while saving back to office report.Error::' . $message);
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
     * Updates an existing MeBackToOfficeReport model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        if (User::userIsAllowedTo('Submit back to office report')) {
            $model = $this->findModel($id);
            if (Yii::$app->request->isAjax) {
                $model->load(Yii::$app->request->post());
                return Json::encode(\yii\widgets\ActiveForm::validate($model));
            }

            if (!empty(Yii::$app->request->post()) && Yii::$app->request->post('submit_for_review') === 'true') {
                //var_dump(Yii::$app->request->post());
                $model->load(Yii::$app->request->post());
                $model->team_members = implode(", ", $model->team_members);
                list( $model->start_date, $model->end_date) = explode('to', $model->travel_dates);
                // $model->created_by = Yii::$app->user->id;
                $model->updated_by = Yii::$app->user->id;
                $model->status = \backend\models\Storyofchange::_submitted_for_review;
                if ($model->save()) {
                    $audit = new AuditTrail();
                    $audit->user = Yii::$app->user->id;
                    $audit->action = "Updated and Submitted a back to office report for review";
                    $audit->ip_address = Yii::$app->request->getUserIP();
                    $audit->user_agent = Yii::$app->request->getUserAgent();
                    $audit->save();
                    $role_model = \common\models\RightAllocation::find()->where(['right' => 'Review back to office report'])->all();
                    if (!empty($role_model)) {
                        $subject = "Back to office report:" . $model->name_of_officer;
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
                                    $msg .= $model->name_of_officer . " has submitted a 'Back to office report' below is the summary of the assignment outcome<br/>";
                                    $msg .= $model->summary_of_assignment_outcomes . "</b></p>";
                                    $msg .= '<p>You can login <i style="color: blue;">' . Html::a('(Click Here to Login)', $resetLink) . '</i> to see more details and review the submitted BtOR</p>';
                                    \backend\models\Storyofchange::sendEmail($msg, $subject, $_model->email);
                                }
                            }
                        }
                    }

                    Yii::$app->session->setFlash('success', 'Back to office report was successfully submitted for review');
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    $message = "";
                    foreach ($model->getErrors() as $error) {
                        $message .= $error[0];
                    }
                    Yii::$app->session->setFlash('error', 'Error occured while submitting back to office report for review.Error::' . $message);
                }
            }


            if (!empty(Yii::$app->request->post()) && Yii::$app->request->post('submit for review') != 'true') {
                $model->load(Yii::$app->request->post());
                $model->team_members = implode(", ", $model->team_members);
                list( $model->start_date, $model->end_date) = explode('to', $model->travel_dates);
                // $model->created_by = Yii::$app->user->id;
                $model->updated_by = Yii::$app->user->id;
                $model->status = 0;
                if ($model->save()) {
                    $audit = new AuditTrail();
                    $audit->user = Yii::$app->user->id;
                    $audit->action = "Updated and Saved back to office report as draft";
                    $audit->ip_address = Yii::$app->request->getUserIP();
                    $audit->user_agent = Yii::$app->request->getUserAgent();
                    $audit->save();
                    Yii::$app->session->setFlash('success', 'Back to office report was successfully updated and saved as a draft');
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    $message = "";
                    foreach ($model->getErrors() as $error) {
                        $message .= $error[0];
                    }
                    Yii::$app->session->setFlash('error', 'Error occured while updating back to office report.Error::' . $message);
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

    public function actionSubmitForReview($id) {
        if (User::userIsAllowedTo('Submit back to office report')) {
            $model = $this->findModel($id);

            $model->updated_by = Yii::$app->user->id;
            $model->status = \backend\models\Storyofchange::_submitted_for_review;
            if ($model->save(false)) {
                $audit = new AuditTrail();
                $audit->user = Yii::$app->user->id;
                $audit->action = "Submitted a back to office report for review";
                $audit->ip_address = Yii::$app->request->getUserIP();
                $audit->user_agent = Yii::$app->request->getUserAgent();
                $audit->save();
                $role_model = \common\models\RightAllocation::find()->where(['right' => 'Review back to office report'])->all();
                if (!empty($role_model)) {
                    $subject = "Back to office report:" . $model->name_of_officer;
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
                                $msg .= $model->name_of_officer . " has submitted a 'Back to office report' below is the summary of the assignment outcome<br/>";
                                $msg .= $model->summary_of_assignment_outcomes . "</b></p>";
                                $msg .= '<p>You can login <i style="color: blue;">' . Html::a('(Click Here to Login)', $resetLink) . '</i> to see more details and review the submitted BtOR</p>';
                                \backend\models\Storyofchange::sendEmail($msg, $subject, $_model->email);
                            }
                        }
                    }
                }
                Yii::$app->session->setFlash('success', 'Back to office report was successfully submitted for review');
            } else {
                $message = "";
                foreach ($model->getErrors() as $error) {
                    $message .= $error[0];
                }
                Yii::$app->session->setFlash('error', 'Error occured while submitting back to office report for review.Error::' . $message);
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    /**
     * Deletes an existing MeBackToOfficeReport model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        if (User::userIsAllowedTo('Submit back to office report')) {
            $model = $this->findModel($id);
            if ($model->delete()) {
                $audit = new AuditTrail();
                $audit->user = Yii::$app->user->id;
                $audit->action = "Removed BtOR report from the system.";
                $audit->ip_address = Yii::$app->request->getUserIP();
                $audit->user_agent = Yii::$app->request->getUserAgent();
                $audit->save();
                Yii::$app->session->setFlash('success', "BtOR report  was successfully removed.");
            } else {
                Yii::$app->session->setFlash('error', "BtOR report could not be removed. Please try again!");
            }
            return $this->redirect(['index']);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    public function actionDeleteMedia($id, $id1) {
        if (User::userIsAllowedTo('Submit back to office report')) {
            $model_media = \backend\models\BackToOfficeAnnexes::findOne($id);
            if (!empty($model_media)) {
                $file_name = $model_media->file_name;
                $type = $model_media->type;
                if ($model_media->type == "Image") {
                    $_file = Yii::getAlias('@backend') . '/web/uploads/image/' . $model_media->file;
                    if (file_exists($_file) && $model_media->delete()) {
                        unlink($_file);
                        $audit_msg = "Removed Back to office media type: $type - $file_name";
                        Yii::$app->session->setFlash('success', "Back to office media type: $type was successfully removed.");
                    } else {
                        Yii::$app->session->setFlash('error', "Back to office media could not be removed. Please try again!");
                    }
                }
                if ($model_media->type == "Video") {
                    $_file = Yii::getAlias('@backend') . '/web/uploads/video/' . $model_media->file;
                    if (file_exists($_file) && $model_media->delete()) {
                        unlink($_file);
                        $audit_msg = "Removed Back to office media type: $type - $file_name";
                        Yii::$app->session->setFlash('success', "Back to office media was successfully removed.");
                    } else {
                        Yii::$app->session->setFlash('error', "Back to office media could not be removed. Please try again!");
                    }
                }


                $audit = new AuditTrail();
                $audit->user = Yii::$app->user->id;
                $audit->action = $audit_msg;
                $audit->ip_address = Yii::$app->request->getUserIP();
                $audit->user_agent = Yii::$app->request->getUserAgent();
                $audit->save();
                return $this->redirect(['view', 'id' => $id1]);
            }
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    /**
     * Finds the MeBackToOfficeReport model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MeBackToOfficeReport the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = MeBackToOfficeReport::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
