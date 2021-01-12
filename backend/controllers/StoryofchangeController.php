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
                'only' => ['index', 'create', 'update', 'delete', 'view', 'sequel', 'submit-story',
                    'conclusions', 'results', 'actions', 'challenges', 'introduction', 'check-list'],
                'rules' => [
                    [
                        'actions' => ['index', 'create', 'update', 'delete', 'view', 'sequel', 'submit-story',
                            'conclusions', 'results', 'actions', 'challenges', 'introduction', 'check-list'],
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
            $dataProvider->query->andFilterWhere(['created_by' => Yii::$app->user->id]);

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
                $dataProvider->query->andFilterWhere(['created_by' => Yii::$app->user->id]);
            } else {
                //We pull stories for all provinces/Districts/Camps which have been submitted for review or have been accepted
                $dataProvider->query->andFilterWhere(['IN', 'status', [2, 1]]);
                return $this->render('stories', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                ]);
            }
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
                            $msg .= "<p>Dear " . $_model->first_name . " " . $_model->other_name . " " . $_model->last_name . ",<br/><br/>";
                            $msg .= "A Case Study/Success Story has been sent back by IKM Officer for more information<br>";
                            $msg .= "Story title:<b>" . $model->title . "</b><br/>";
                            $msg .= "Story category:<b>" . \backend\models\LkmStoryofchangeCategory::findOne($model->category)->name . "</b><br/>";
                            $msg .= "Interviewee:<b>" . $model->interviewee_names . "</b><br/>";
                            $msg .= "Interviewer:<b>" . $model->interviewer_names . "</b><br/>";
                            $msg .= "Date of Interview:<b>" . $model->date_interviewed . "</b><br/>";
                            $msg .= "IKM Officer comments:<b>" . $model->ikmo_comments . "</b></p>";
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
                    $subject = "Case Study/Success Story review:" .$model->title;
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
                $audit->action = "Removed story of change: $name from the system.";
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
