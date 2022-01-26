<?php

namespace backend\controllers;

use Yii;
use backend\models\Storyofchange;
use backend\models\StoryofchangeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use backend\models\AuditTrail;
use backend\models\User;
use yii\filters\AccessControl;
use \yii\helpers\Html;
use yii\web\UploadedFile;
use kartik\mpdf\Pdf;

/**
 * StoryofchangeController implements the CRUD actions for Storyofchange model.
 */
class StoryofchangeController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' =>
                [
                    'index', 'create', 'update', 'delete', 'delete-media', 'update-media', 'view', 'sequel', 'submit-story',
                    'conclusions', 'results', 'actions', 'challenges', 'introduction', 'check-list',
                    'stories', "media", 'export-story', 'attach-article',
                    'update-article', 'download-article', 'delete-media', 'delete-article', 'export-story', 'story-view',
                    'download', 'review-story-action'
                ],
                'rules' => [
                    [
                        'actions' =>
                        [
                            'index', 'create', 'update', 'delete', 'delete-media', 'update-media', 'view', 'sequel', 'submit-story',
                            'conclusions', 'results', 'actions', 'challenges', 'introduction', 'check-list', 'stories',
                            'media', 'export-story', 'attach-article',
                            'update-article', 'download-article', 'delete-media', 'delete-article', 'export-story', 'story-view',
                            'download', 'review-story-action'
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
     * Lists all Storyofchange models.
     * @return mixed
     */
    public function actionIndex() {
        if (User::userIsAllowedTo('Submit story of change')) {
            $searchModel = new StoryofchangeSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            
//            if (!empty(Yii::$app->user->role) && app\models\Role::findOne(Yii::$app->user->role)->name == "lecturer") {
//                $dataProvider->query->andFilterWhere(['lecturer' => Yii::$app->user->id]);
//            }
//            if (!empty(Yii::$app->user->role) && app\models\Role::findOne(Yii::$app->user->role)->name == "lecturer") {
//                $dataProvider->query->andFilterWhere(['created_by' => Yii::$app->user->id]);
//            }
//
//            if (!empty(Yii::$app->user->role) && app\models\Role::findOne(Yii::$app->user->role)->name == "student") {
//                $dataProvider->query->andFilterWhere(['student_id' => Yii::$app->user->id]);
//            }
            
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

    public function actionStories() {
        if (User::userIsAllowedTo('Review Story of change') ||
                User::userIsAllowedTo("View Story of change")) {
            $searchModel = new StoryofchangeSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            if (User::userIsAllowedTo("View Story of change")) {
                //We pull stories for only a single province
                $_users_model = User::find()->select(['id'])->where(['province_id' => Yii::$app->user->identity->province_id])->all();
                if (!empty($_users_model)) {
                    $_user_ids = [-1];
                    foreach ($_users_model as $model) {
                        array_push($_user_ids, $model['id']);
                    }
                    $dataProvider->query->andFilterWhere(['IN', 'created_by', $_user_ids]);
                }
            } else {
                //We pull stories for all provinces/Districts/Camps which have been submitted for
                // review or have been accepted

                $dataProvider->query->andFilterWhere(['IN', 'status', [2, 1]]);
            }
            return $this->render('stories', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    public function actionStoryView($id) {
        if (User::userIsAllowedTo('Review Story of change')) {
            return $this->render('story-view', [
                        'model' => $this->findModel($id),
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    public function actionReviewStoryAction($id) {
        if (User::userIsAllowedTo('Review Story of change')) {
            $model = $this->findModel($id);
            $model1 = new Storyofchange();
            if ($model1->load(Yii::$app->request->post())) {
                $model->updated_by = Yii::$app->user->identity->id;
                $model->status = $model1->status;
                $model->ikmo_review_status = $model1->status;
                $model->ikmo_comments = $model1->ikmo_comments;
                $_status = $model->status == Storyofchange::_accepted ? "Accepted" : "Send back for more information";
                if ($model->save()) {
                    $audit = new AuditTrail();
                    $audit->user = Yii::$app->user->id;
                    $audit->action = "Updated story of change: '" . $model->title . "'s status to '" . $_status . "'";
                    $audit->ip_address = Yii::$app->request->getUserIP();
                    $audit->user_agent = Yii::$app->request->getUserAgent();
                    $audit->save();

                    if ($model->status == Storyofchange::_accepted) {
                        Yii::$app->session->setFlash('success', 'Story of change: ' . $model->title . ' action was successfully taken.');
                        return $this->redirect(['story-view', 'id' => $model->id]);
                    } else {
                        Yii::$app->session->setFlash('success', 'Story of change: ' . $model->title . ' action was successfully taken.');
                        //We send an email imforming user that the story needs more information
                        $_model = User::findOne($model->created_by);
                        if (!empty($_model)) {
                            $subject = "Need more information for Case study:" . $model->title;
                            $resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/login']);
                            $msg = "";
                            $msg .= "<p>Dear " . $_model->first_name . " " . $_model->other_name . " " . $_model->last_name . ",<br/>";
                            $msg .= "A Case Study/Success Story has been sent back by IKM Officer for more information.See below comments<br>";
                            $msg .= "<i>" . $model->ikmo_comments . "</i></p>";
                            $msg .= '<p>You can login <i style="color: blue;">' . Html::a('(Click Here to Login)', $resetLink) . '</i> to make changes to the Case Study/Success Story</p>';
                            Storyofchange::sendEmail($msg, $subject, $_model->email);
                        }

                        return $this->redirect(['stories']);
                    }
                } else {
                    Yii::$app->session->setFlash('error', 'Error occured while updating story of change : ' . $model->title . " action");
                }
            }
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    /**
     * Displays a single Storyofchange model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        if (User::userIsAllowedTo('Submit story of change')) {
            return $this->render('view', [
                        'model' => $this->findModel($id),
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    public function actionCheckList($id) {
        if (User::userIsAllowedTo('Submit story of change')) {
            return $this->render('check-list', [
                        'model' => $this->findModel($id),
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    public function actionIntroduction($id) {
        if (User::userIsAllowedTo('Submit story of change')) {
            $model = $this->findModel($id);
            if (Yii::$app->request->isAjax) {
                $model->load(Yii::$app->request->post());
                return Json::encode(\yii\widgets\ActiveForm::validate($model));
            }
            if ($model->load(Yii::$app->request->post())) {
                $model->updated_by = Yii::$app->user->identity->id;
                if ($model->save()) {
                    $audit = new AuditTrail();
                    $audit->user = Yii::$app->user->id;
                    $audit->action = "Updated introduction for story of change: " . $model->title;
                    $audit->ip_address = Yii::$app->request->getUserIP();
                    $audit->user_agent = Yii::$app->request->getUserAgent();
                    $audit->save();
                    Yii::$app->session->setFlash('success', 'Introduction for Story of change: ' . $model->title . ' was successfully updated.');
                    return $this->redirect(['check-list', 'id' => $model->id]);
                } else {
                    Yii::$app->session->setFlash('error', 'Error occured while updating introduction for story of change : ' . $model->title);
                }
            }
            return $this->render('introduction', [
                        'model' => $model,
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    public function actionChallenges($id) {
        if (User::userIsAllowedTo('Submit story of change')) {
            $model = $this->findModel($id);
            if (Yii::$app->request->isAjax) {
                $model->load(Yii::$app->request->post());
                return Json::encode(\yii\widgets\ActiveForm::validate($model));
            }
            if ($model->load(Yii::$app->request->post())) {
                $model->updated_by = Yii::$app->user->identity->id;
                if ($model->save()) {
                    $audit = new AuditTrail();
                    $audit->user = Yii::$app->user->id;
                    $audit->action = "Updated challenges for story of change: " . $model->title;
                    $audit->ip_address = Yii::$app->request->getUserIP();
                    $audit->user_agent = Yii::$app->request->getUserAgent();
                    $audit->save();
                    Yii::$app->session->setFlash('success', 'Challenges for Story of change: ' . $model->title . ' was successfully updated.');
                    return $this->redirect(['check-list', 'id' => $model->id]);
                } else {
                    Yii::$app->session->setFlash('error', 'Error occured while updating challenges for story of change : ' . $model->title);
                }
            }
            return $this->render('challenges', [
                        'model' => $model,
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    public function actionActions($id) {
        if (User::userIsAllowedTo('Submit story of change')) {
            $model = $this->findModel($id);
            if (Yii::$app->request->isAjax) {
                $model->load(Yii::$app->request->post());
                return Json::encode(\yii\widgets\ActiveForm::validate($model));
            }
            if ($model->load(Yii::$app->request->post())) {
                $model->updated_by = Yii::$app->user->identity->id;
                if ($model->save()) {
                    $audit = new AuditTrail();
                    $audit->user = Yii::$app->user->id;
                    $audit->action = "Updated actions for story of change: " . $model->title;
                    $audit->ip_address = Yii::$app->request->getUserIP();
                    $audit->user_agent = Yii::$app->request->getUserAgent();
                    $audit->save();
                    Yii::$app->session->setFlash('success', 'Actions for Story of change: ' . $model->title . ' was successfully updated.');
                    return $this->redirect(['check-list', 'id' => $model->id]);
                } else {
                    Yii::$app->session->setFlash('error', 'Error occured while updating actions for story of change : ' . $model->title);
                }
            }
            return $this->render('actions', [
                        'model' => $model,
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    public function actionResults($id) {
        if (User::userIsAllowedTo('Submit story of change')) {
            $model = $this->findModel($id);
            if (Yii::$app->request->isAjax) {
                $model->load(Yii::$app->request->post());
                return Json::encode(\yii\widgets\ActiveForm::validate($model));
            }
            if ($model->load(Yii::$app->request->post())) {
                $model->updated_by = Yii::$app->user->identity->id;
                if ($model->save()) {
                    $audit = new AuditTrail();
                    $audit->user = Yii::$app->user->id;
                    $audit->action = "Updated results for story of change: " . $model->title;
                    $audit->ip_address = Yii::$app->request->getUserIP();
                    $audit->user_agent = Yii::$app->request->getUserAgent();
                    $audit->save();
                    Yii::$app->session->setFlash('success', 'Results for Story of change: ' . $model->title . ' was successfully updated.');
                    return $this->redirect(['check-list', 'id' => $model->id]);
                } else {
                    Yii::$app->session->setFlash('error', 'Error occured while updating results for story of change : ' . $model->title);
                }
            }
            return $this->render('results', [
                        'model' => $model,
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    public function actionConclusions($id) {
        if (User::userIsAllowedTo('Submit story of change')) {
            $model = $this->findModel($id);
            if (Yii::$app->request->isAjax) {
                $model->load(Yii::$app->request->post());
                return Json::encode(\yii\widgets\ActiveForm::validate($model));
            }
            if ($model->load(Yii::$app->request->post())) {
                $model->updated_by = Yii::$app->user->identity->id;
                if ($model->save()) {
                    $audit = new AuditTrail();
                    $audit->user = Yii::$app->user->id;
                    $audit->action = "Updated conclusions for story of change: " . $model->title;
                    $audit->ip_address = Yii::$app->request->getUserIP();
                    $audit->user_agent = Yii::$app->request->getUserAgent();
                    $audit->save();
                    Yii::$app->session->setFlash('success', 'Conclusions for Story of change: ' . $model->title . ' was successfully updated.');
                    return $this->redirect(['check-list', 'id' => $model->id]);
                } else {
                    Yii::$app->session->setFlash('error', 'Error occured while updating conclusions for story of change : ' . $model->title);
                }
            }
            return $this->render('conclusions', [
                        'model' => $model,
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    public function actionSequel($id) {
        if (User::userIsAllowedTo('Submit story of change')) {
            $model = $this->findModel($id);
            if (Yii::$app->request->isAjax) {
                $model->load(Yii::$app->request->post());
                return Json::encode(\yii\widgets\ActiveForm::validate($model));
            }
            if ($model->load(Yii::$app->request->post())) {
                $model->updated_by = Yii::$app->user->identity->id;
                if ($model->save()) {
                    $audit = new AuditTrail();
                    $audit->user = Yii::$app->user->id;
                    $audit->action = "Updated sequel for story of change: " . $model->title;
                    $audit->ip_address = Yii::$app->request->getUserIP();
                    $audit->user_agent = Yii::$app->request->getUserAgent();
                    $audit->save();
                    Yii::$app->session->setFlash('success', 'Sequel for Story of change: ' . $model->title . ' was successfully updated.');
                    return $this->redirect(['check-list', 'id' => $model->id]);
                } else {
                    Yii::$app->session->setFlash('error', 'Error occured while updating sequel for story of change : ' . $model->title);
                }
            }
            return $this->render('sequel', [
                        'model' => $model,
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    public function actionSubmitStory($id) {
        if (User::userIsAllowedTo('Submit story of change')) {
            $model = $this->findModel($id);
            $model->updated_by = Yii::$app->user->identity->id;
            $model->status = 2;
            if ($model->save()) {
                $audit = new AuditTrail();
                $audit->user = Yii::$app->user->id;
                $audit->action = "Submitted story of change: '" . $model->title . "' for review";
                $audit->ip_address = Yii::$app->request->getUserIP();
                $audit->user_agent = Yii::$app->request->getUserAgent();
                $audit->save();
                Yii::$app->session->setFlash('success', 'Story of change: "' . $model->title . '" was successfully submitted for review.');

                //We send an email informing IKM Officers that a story has been submited for review
                //We first get roles with the permission to review stories
                $role_model = \common\models\RightAllocation::find()->where(['right' => 'Review Story of change'])->all();
                if (!empty($role_model)) {
                    $subject = "Case Study/Success Story review:" . $model->title;
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
                                $msg .= "<p>Dear " . $_model->first_name . " " . $_model->other_name . " " . $_model->last_name . ",<br/><br/>";
                                $msg .= "A Case Study/Success Story has been submitted for your review.See the details below<br>";
                                $msg .= "Story title:<b>" . $model->title . "</b><br/>";
                                $msg .= "Story category:<b>" . \backend\models\LkmStoryofchangeCategory::findOne($model->category)->name . "</b><br/>";
                                $msg .= "Interviewee:<b>" . $model->interviewee_names . "</b><br/>";
                                $msg .= "Interviewer:<b>" . $model->interviewer_names . "</b><br/>";
                                $msg .= "Date of Interview:<b>" . $model->date_interviewed . "</b></p>";
                                $msg .= '<p>You can login <i style="color: blue;">' . Html::a('(Click Here to Login)', $resetLink) . '</i> to see more details and review the submitted Case Study/Success Story</p>';
                                Storyofchange::sendEmail($msg, $subject, $_model->email);
                            }
                        }
                    }
                }

                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                Yii::$app->session->setFlash('error', 'Error occured while submitting story of change : "' . $model->title . '" for review');
            }
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    public function actionMedia($id, $media_type = "") {
        if (User::userIsAllowedTo('Submit story of change')) {
            $model = new \backend\models\LkmStoryofchangeMedia();
            $model2 = $this->findModel($id);
            $model->media_type = $media_type;
            if (Yii::$app->request->isAjax) {
                $model->load(Yii::$app->request->post());
                return Json::encode(\yii\widgets\ActiveForm::validate($model));
            }

            if ($model->load(Yii::$app->request->post())) {
                $model->created_by = Yii::$app->user->identity->id;
                $model->updated_by = Yii::$app->user->identity->id;
                $media_file = UploadedFile::getInstance($model, 'file');


                if (!empty($media_file)) {
                    //We just update the interview guide template if it exist already.
                    if ($media_type === "Completed Interview guide") {
                        $_model = \backend\models\LkmStoryofchangeMedia::findOne(['media_type' => "Completed Interview guide"]);
                        $_file = "";
                        if (!empty($_model)) {
                            $model = $_model;
                            $_file = Yii::getAlias('@backend') . '/web/uploads/documents/' . $_model->file;
                        }
                    }

                    $Filename = Yii::$app->security->generateRandomString(45) . '.' . $media_file->extension;
                    $model->file = $Filename;
                    $model->story_id = $id;

                    !empty($media_file->name) ? $model->file_name = $media_file->name : "";

                    if ($model->media_type === "Completed Interview guide") {
                        if (!empty($_file)) {
                            if (file_exists($_file)) {
                                unlink($_file);
                            }
                        }
                        $media_file->saveAs(Yii::getAlias('@backend') . '/web/uploads/documents/' . $Filename);
                    }
                    if ($model->media_type === "Picture") {
                        $media_file->saveAs(Yii::getAlias('@backend') . '/web/uploads/image/' . $Filename);
                    }
                    if ($model->media_type === "Audio") {
                        $media_file->saveAs(Yii::getAlias('@backend') . '/web/uploads/audio/' . $Filename);
                    }
                    if ($model->media_type === "Video") {
                        $media_file->saveAs(Yii::getAlias('@backend') . '/web/uploads/video/' . $Filename);
                    }

                    if ($model->save()) {
                        $audit = new AuditTrail();
                        $audit->user = Yii::$app->user->id;
                        $audit->action = "Added story of change media: " . $model->media_type;
                        $audit->ip_address = Yii::$app->request->getUserIP();
                        $audit->user_agent = Yii::$app->request->getUserAgent();
                        $audit->save();
                        $model = new \backend\models\LkmStoryofchangeMedia();
                        Yii::$app->session->setFlash('success', 'Story of change media was successfully added.You can add another ' . $media_type);
                    } else {
                        Yii::$app->session->setFlash('error', 'Error occured while adding story of change media ');
                    }
                }
            }

            return $this->render('media', [
                        'model' => $model,
                        'model2' => $model2,
                        "media_type" => $media_type
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    public function actionUpdateMedia($id, $id1, $media_type = "") {
        if (User::userIsAllowedTo('Submit story of change')) {
            $model = \backend\models\LkmStoryofchangeMedia::findOne($id);
            $file = $model->file;
            $model2 = $this->findModel($id1);
            $model->media_type = $media_type;

            if (Yii::$app->request->isAjax) {
                $model->load(Yii::$app->request->post());
                return Json::encode(\yii\widgets\ActiveForm::validate($model));
            }

            if ($model->load(Yii::$app->request->post())) {
                $model->updated_by = Yii::$app->user->identity->id;
                $media_file = UploadedFile::getInstance($model, 'file');

                if (!empty($media_file)) {

                    $Filename = Yii::$app->security->generateRandomString(45) . '.' . $media_file->extension;
                    $model->file = $Filename;
                    $model->media_type = $media_type;
                    //$model->story_id = $id1;
                    !empty($media_file->name) ? $model->file_name = $media_file->name : "";

                    if ($model->media_type === "Completed Interview guide") {
                        $media_file->saveAs(Yii::getAlias('@backend') . '/web/uploads/documents/' . $Filename);
                        $_file = Yii::getAlias('@backend') . '/web/uploads/documents/' . $file;
                        if (file_exists($_file)) {
                            unlink($_file);
                        }
                    }
                    if ($model->media_type === "Picture") {
                        $media_file->saveAs(Yii::getAlias('@backend') . '/web/uploads/image/' . $Filename);
                        $_file = Yii::getAlias('@backend') . '/web/uploads/image/' . $file;
                        if (file_exists($_file)) {
                            unlink($_file);
                        }
                    }
                    if ($model->media_type === "Audio") {
                        $media_file->saveAs(Yii::getAlias('@backend') . '/web/uploads/audio/' . $Filename);
                        $_file = Yii::getAlias('@backend') . '/web/uploads/audio/' . $file;
                        if (file_exists($_file)) {
                            unlink($_file);
                        }
                    }
                    if ($model->media_type === "Video") {
                        $media_file->saveAs(Yii::getAlias('@backend') . '/web/uploads/video/' . $Filename);
                        $_file = Yii::getAlias('@backend') . '/web/uploads/video/' . $file;
                        if (file_exists($_file)) {
                            unlink($_file);
                        }
                    }

                    if ($model->save(false)) {
                        $audit = new AuditTrail();
                        $audit->user = Yii::$app->user->id;
                        $audit->action = "Updated story of change media: " . $model->media_type;
                        $audit->ip_address = Yii::$app->request->getUserIP();
                        $audit->user_agent = Yii::$app->request->getUserAgent();
                        $audit->save();
                        Yii::$app->session->setFlash('success', 'Story of change media was successfully updated.');
                        return $this->redirect(['view', 'id' => $id1]);
                    } else {
                        $message = '';
                        foreach ($model->getErrors() as $error) {
                            $message .= $error[0];
                        }
                        Yii::$app->session->setFlash('error', 'Error occured while updating story of change media.Error::' . $message);
                    }
                }
            }

            return $this->render('update-media', [
                        'model' => $model,
                        'model2' => $model2,
                        "media_type" => $media_type
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    public function actionAttachArticle($id) {
        if (User::userIsAllowedTo('Attach case study articles')) {
            $model = new \backend\models\LkmStoryofchangeArticle();
            $model2 = $this->findModel($id);
            if (Yii::$app->request->isAjax) {
                $model->load(Yii::$app->request->post());
                return Json::encode(\yii\widgets\ActiveForm::validate($model));
            }

            if ($model->load(Yii::$app->request->post())) {
                $model->created_by = Yii::$app->user->identity->id;
                $model->updated_by = Yii::$app->user->identity->id;
                $media_file = UploadedFile::getInstance($model, 'file');


                if (!empty($media_file)) {
                    if ($media_file->extension != "pdf") {
                        $model = \backend\models\LkmStoryofchangeMedia();
                        Yii::$app->session->setFlash('error', 'You can only upload PDF files for case study articles!');
                        return $this->render('attach-article', [
                                    'model' => $model,
                                    'model2' => $model2,
                        ]);
                    }


                    $Filename = Yii::$app->security->generateRandomString() . '.' . $media_file->extension;
                    $model->file = $Filename;
                    !empty($media_file->name) ? $model->file_name = $media_file->name : "";
                    $model->story_id = $id;
                    $media_file->saveAs(Yii::getAlias('@backend') . '/web/uploads/articles/' . $Filename);

                    if ($model->save()) {
                        $audit = new AuditTrail();
                        $audit->user = Yii::$app->user->id;
                        $audit->action = "Added story of change article";
                        $audit->ip_address = Yii::$app->request->getUserIP();
                        $audit->user_agent = Yii::$app->request->getUserAgent();
                        $audit->save();

                        Yii::$app->session->setFlash('success', 'Story of change article was successfully added.');
                        return $this->redirect(['story-view', 'id' => $id]);
                    } else {
                        Yii::$app->session->setFlash('error', 'Error occured while adding story of change article ');
                    }
                }
            }

            return $this->render('attach-article', [
                        'model' => $model,
                        'model2' => $model2,
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    public function actionUpdateArticle($id, $id1) {
        if (User::userIsAllowedTo('Attach case study articles')) {
            $model = \backend\models\LkmStoryofchangeArticle::findOne($id);
            $model2 = $this->findModel($id1);
            $file = $model->file;
            if (Yii::$app->request->isAjax) {
                $model->load(Yii::$app->request->post());
                return Json::encode(\yii\widgets\ActiveForm::validate($model));
            }

            if ($model->load(Yii::$app->request->post())) {
                $model->created_by = Yii::$app->user->identity->id;
                $model->updated_by = Yii::$app->user->identity->id;
                $media_file = UploadedFile::getInstance($model, 'file');


                if (!empty($media_file)) {
                    if ($media_file->extension != "pdf") {
                        $model = \backend\models\LkmStoryofchangeMedia();
                        Yii::$app->session->setFlash('error', 'You can only upload PDF files for case study articles!');
                        return $this->render('update-article', [
                                    'model' => $model,
                                    'model2' => $model2,
                        ]);
                    }


                    $Filename = Yii::$app->security->generateRandomString() . '.' . $media_file->extension;
                    $model->file = $Filename;
                    $media_file->saveAs(Yii::getAlias('@backend') . '/web/uploads/articles/' . $Filename);
                    !empty($media_file->name) ? $model->file_name = $media_file->name : "";

                    $_file = Yii::getAlias('@backend') . '/web/uploads/articles/' . $file;
                    if (file_exists($_file)) {
                        unlink($_file);
                    }

                    if ($model->save()) {
                        $audit = new AuditTrail();
                        $audit->user = Yii::$app->user->id;
                        $audit->action = "Updated story of change article";
                        $audit->ip_address = Yii::$app->request->getUserIP();
                        $audit->user_agent = Yii::$app->request->getUserAgent();
                        $audit->save();

                        Yii::$app->session->setFlash('success', 'Story of change article was successfully updated.');
                        return $this->redirect(['story-view', 'id' => $id1]);
                    } else {
                        Yii::$app->session->setFlash('error', 'Error occured while adding story of change article ');
                    }
                }
            }

            return $this->render('update-article', [
                        'model' => $model,
                        'model2' => $model2,
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    /**
     * Creates a new Storyofchange model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        if (User::userIsAllowedTo('Submit story of change')) {
            $model = new Storyofchange();
            if (Yii::$app->request->isAjax) {
                $model->load(Yii::$app->request->post());
                return Json::encode(\yii\widgets\ActiveForm::validate($model));
            }

            if ($model->load(Yii::$app->request->post())) {
                $model->created_by = Yii::$app->user->identity->id;
                $model->updated_by = Yii::$app->user->identity->id;
                if (!empty(Yii::$app->user->identity->camp_id)) {
                    $model->camp_id = Yii::$app->user->identity->camp_id;
                }
                if (!empty(Yii::$app->user->identity->district_id)) {
                    $model->district_id = Yii::$app->user->identity->district_id;
                }
                if (!empty(Yii::$app->user->identity->province_id)) {
                    $model->province_id = Yii::$app->user->identity->province_id;
                }
                $model->status = 0;
                if ($model->save()) {
                    $audit = new AuditTrail();
                    $audit->user = Yii::$app->user->id;
                    $audit->action = "Added story of change: " . $model->title;
                    $audit->ip_address = Yii::$app->request->getUserIP();
                    $audit->user_agent = Yii::$app->request->getUserAgent();
                    $audit->save();
                    Yii::$app->session->setFlash('success', 'Story of change: ' . $model->title . ' was successfully added.');
                    return $this->redirect(['check-list', 'id' => $model->id]);
                } else {
                    Yii::$app->session->setFlash('error', 'Error occured while adding story of change : ' . $model->title);
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
     * Updates an existing Storyofchange model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        if (User::userIsAllowedTo('Submit story of change')) {
            $model = $this->findModel($id);
            if (Yii::$app->request->isAjax) {
                $model->load(Yii::$app->request->post());
                return Json::encode(\yii\widgets\ActiveForm::validate($model));
            }
            if ($model->load(Yii::$app->request->post())) {
                $model->updated_by = Yii::$app->user->identity->id;
                if ($model->save()) {
                    $audit = new AuditTrail();
                    $audit->user = Yii::$app->user->id;
                    $audit->action = "Updated story of change: " . $model->title;
                    $audit->ip_address = Yii::$app->request->getUserIP();
                    $audit->user_agent = Yii::$app->request->getUserAgent();
                    $audit->save();
                    Yii::$app->session->setFlash('success', 'Story of change: ' . $model->title . ' was successfully updated.');
                    return $this->redirect(['check-list', 'id' => $model->id]);
                } else {
                    Yii::$app->session->setFlash('error', 'Error occured while updating story of change : ' . $model->title);
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
     * Deletes an existing Storyofchange model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        if (User::userIsAllowedTo('Submit story of change')) {
            $model = $this->findModel($id);
            $name = $model->title;
            if ($model->delete()) {
                $audit = new AuditTrail();
                $audit->user = Yii::$app->user->id;
                $audit->action = "Removed story of change: $name and associated media from the system.";
                $audit->ip_address = Yii::$app->request->getUserIP();
                $audit->user_agent = Yii::$app->request->getUserAgent();
                $audit->save();
                Yii::$app->session->setFlash('success', "Story of change: $name was successfully removed.");
            } else {
                Yii::$app->session->setFlash('error', "Story of change: $name could not be removed. Please try again!");
            }
            return $this->redirect(['index']);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    public function actionDeleteMedia($id, $id1) {
        if (User::userIsAllowedTo('Submit story of change')) {
            $model_media = \backend\models\LkmStoryofchangeMedia::findOne($id);
            if (!empty($model_media)) {
                $file_name = $model_media->file_name;
                $type = $model_media->media_type;

                if ($model_media->media_type == "Completed Interview guide") {
                    $_file = Yii::getAlias('@backend') . '/web/uploads/documents/' . $model_media->file;
                    if (file_exists($_file) && $model_media->delete()) {
                        unlink($_file);
                        $audit_msg = "Removed Case study media type: $type - $file_name";
                        Yii::$app->session->setFlash('success', "Case study media was successfully removed.");
                    } else {
                        Yii::$app->session->setFlash('error', "Case study media could not be removed. Please try again!");
                    }
                }
                if ($model_media->media_type == "Picture") {
                    $_file = Yii::getAlias('@backend') . '/web/uploads/image/' . $model_media->file;
                    if (file_exists($_file) && $model_media->delete()) {
                        unlink($_file);
                        $audit_msg = "Removed Case study media type: $type - $file_name";
                        Yii::$app->session->setFlash('success', "Case study media type: $type was successfully removed.");
                    } else {
                        Yii::$app->session->setFlash('error', "Case study media could not be removed. Please try again!");
                    }
                }
                if ($model_media->media_type == "Audio") {
                    $_file = Yii::getAlias('@backend') . '/web/uploads/audio/' . $model_media->file;
                    if (file_exists($_file) && $model_media->delete()) {
                        unlink($_file);
                        $audit_msg = "Removed Case study media type: $type - $file_name";
                        Yii::$app->session->setFlash('success', "Case study media was successfully removed.");
                    } else {
                        Yii::$app->session->setFlash('error', "Case study media could not be removed. Please try again!");
                    }
                }
                if ($model_media->media_type == "Video") {
                    $_file = Yii::getAlias('@backend') . '/web/uploads/video/' . $model_media->file;
                    if (file_exists($_file) && $model_media->delete()) {
                        unlink($_file);
                        $audit_msg = "Removed Case study media type: $type - $file_name";
                        Yii::$app->session->setFlash('success', "Case study media was successfully removed.");
                    } else {
                        Yii::$app->session->setFlash('error', "Case study media could not be removed. Please try again!");
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

    public function actionDeleteArticle($id, $id1) {
        if (User::userIsAllowedTo('Attach case study articles')) {
            $model_media = \backend\models\LkmStoryofchangeArticle::findOne($id);
            if (!empty($model_media)) {

                $_file = Yii::getAlias('@backend') . '/web/uploads/articles/' . $model_media->file;
                if (file_exists($_file) && $model_media->delete()) {
                    unlink($_file);
                    $audit_msg = "Removed Case study article";
                    Yii::$app->session->setFlash('success', "Case study article was successfully removed.");
                } else {
                    Yii::$app->session->setFlash('error', "Case study article could not be removed. Please try again!");
                }


                $audit = new AuditTrail();
                $audit->user = Yii::$app->user->id;
                $audit->action = $audit_msg;
                $audit->ip_address = Yii::$app->request->getUserIP();
                $audit->user_agent = Yii::$app->request->getUserAgent();
                $audit->save();

                return $this->redirect(['story-view', 'id' => $id1]);
            } else {
                Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
                return $this->redirect(['home/home']);
            }
        }
    }

    public function actionDownload($id, $id1) {
        // if (User::userIsAllowedTo('View employee documents')) {
        $model = \backend\models\LkmStoryofchangeMedia::findOne($id);
        $audit_msg = "";
        $filePath = '/web/uploads/documents';
        $completePath = Yii::getAlias('@backend' . $filePath . '/' . $model->file);
        $file_name = "";
        $story_model = Storyofchange::findOne($id1);
        $file_name = !empty($story_model) ? "Interview guide-" . $story_model->title : "Completed interview guide";
        $audit_msg = "Completed interview guide template was downloaded";

        $ath = new AuditTrail();
        $ath->user = Yii::$app->user->id;
        $ath->action = $audit_msg;
        $ath->ip_address = Yii::$app->request->getUserIP();
        $ath->user_agent = Yii::$app->request->getUserAgent();
        $ath->save();

        header("Content-type:application/pdf");
        return Yii::$app->response->sendFile($completePath, $file_name, ['inline' => true]);
        /* } else {
          Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
          return $this->redirect(['home/index']);
          } */
    }

    public function actionDownloadArticle($id, $id1) {
        // if (User::userIsAllowedTo('View employee documents')) {
        $model = \backend\models\LkmStoryofchangeArticle::findOne($id);
        $audit_msg = "";
        $filePath = '/web/uploads/articles';
        $completePath = Yii::getAlias('@backend' . $filePath . '/' . $model->file);
        $file_name = "";
        $story_model = Storyofchange::findOne($id1);
        $file_name = !empty($story_model) ? "Article_" . $story_model->title : "Case_study_article";
        $audit_msg = "Downloaded Case study article";

        $ath = new AuditTrail();
        $ath->user = Yii::$app->user->id;
        $ath->action = $audit_msg;
        $ath->ip_address = Yii::$app->request->getUserIP();
        $ath->user_agent = Yii::$app->request->getUserAgent();
        $ath->save();

        header("Content-type:application/pdf");
        return Yii::$app->response->sendFile($completePath, $file_name, ['inline' => true]);
        /* } else {
          Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
          return $this->redirect(['home/index']);
          } */
    }

    public function actionExportStory($id) {
        $model = Storyofchange::findOne($id);
        $filename = "Case study_" . $model->title . "_" . date("Ymdhis") . ".pdf";
        $ath = new AuditTrail();
        $ath->user = Yii::$app->user->id;
        $ath->action = "Exported Story of change:" . $model->title . " to pdf";
        $ath->ip_address = Yii::$app->request->getUserIP();
        $ath->user_agent = Yii::$app->request->getUserAgent();
        $ath->save();
        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        $pdf = new Pdf([
            'mode' => Pdf::MODE_CORE,
            // A4 paper format
            'format' => Pdf::FORMAT_A4,
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
            'content' => $this->renderPartial('export-story', ['model' => $model]),
            'options' => [
                'text_input_as_HTML' => true,
                'justifyB4br' => true
            // any mpdf options you wish to set
            ],
            'methods' => [
                'SetTitle' => 'Case study/Success story',
                //'SetSubject' => 'Generating PDF files via yii2-mpdf extension has never been easy',
                'SetHeader' => ['MOA/ESAPP Case study/Success Story||' . date("r") . "/ESAPP online system"],
                'SetFooter' => ['|Page {PAGENO}|'],
                'SetAuthor' => 'ESAPP online system',
            ]
        ]);
        $pdf->filename = $filename;
        return $pdf->render();
    }

    /**
     * Finds the Storyofchange model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Storyofchange the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Storyofchange::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
