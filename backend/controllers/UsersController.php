<?php

namespace backend\controllers;

use Yii;
use backend\models\User;
use backend\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Json;
use backend\models\AuditTrail;

/**
 * UsersController implements the CRUD actions for User model.
 */
class UsersController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'create', 'update', 'delete', 'view',
                    'image', 'change-password', 'profile', 'block'],
                'rules' => [
                    [
                        'actions' => ['index', 'create', 'update', 'delete',
                            'view', 'image', 'change-password', 'profile', 'block'],
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex() {
        if (User::userIsAllowedTo('View Users') || User::userIsAllowedTo('Manage Users')) {
            $searchModel = new UserSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            $dataProvider->query->andFilterWhere(['NOT IN', 'status', [User::STATUS_DELETED]]);
            // $dataProvider->query->andFilterWhere(['NOT IN', 'id', [Yii::$app->user->id]]);
            if (Yii::$app->request->post('hasEditable')) {
                $userId = Yii::$app->request->post('editableKey');
                $model = User::findOne($userId);
                $out = Json::encode(['output' => '', 'message' => '']);
                $posted = current($_POST['User']);
                $post = ['User' => $posted];
                $old_status = $model->status;
                if ($model->load($post)) {
                    if ($old_status != $model->status) {
                        $action = $model->status == User::STATUS_ACTIVE ?
                                "Activated user account with email:" . $model->email : "Blocked user account with email:" . $model->email;
                        $audit = new AuditTrail();
                        $audit->user = Yii::$app->user->id;
                        $audit->action = $action;
                        $audit->ip_address = Yii::$app->request->getUserIP();
                        $audit->user_agent = Yii::$app->request->getUserAgent();
                        $audit->save();
                    }

                    $model->updated_by = Yii::$app->user->id;
                    $model->save(false);
                    $output = '';
                    $out = Json::encode(['output' => $output, 'message' => '']);
                }
                return $out;
            }
            return $this->render('index', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        if (User::userIsAllowedTo('View Users') || User::userIsAllowedTo('Manage Users')) {
            return $this->render('view', [
                        'model' => $this->findModel($id),
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        if (User::userIsAllowedTo('Manage Users')) {
            $model = new User();
            $user_type = "";
            if (Yii::$app->request->isAjax) {
                $model->load(Yii::$app->request->post());
                return Json::encode(\yii\widgets\ActiveForm::validate($model));
            }

            if (Yii::$app->request->post('addUser') == 'true') {
                // var_dump(Yii::$app->request->post()['User']['user_type']);
                $user_type = Yii::$app->request->post()['User']['user_type'];
            }

            if (Yii::$app->request->post('addUser') != 'true' && $model->load(Yii::$app->request->post())) {
                $name = $model->first_name . ' ' . $model->other_name . ' ' . $model->last_name;
                $model->status = User::STATUS_INACTIVE;
                $model->auth_key = Yii::$app->security->generateRandomString();
                //Temp password hash 
                $model->password = Yii::$app->getSecurity()->generatePasswordHash($model->first_name . $model->auth_key);
                //Default username to email
                $model->username = $model->email;
                $model->created_by = Yii::$app->user->identity->id;
                $model->updated_by = Yii::$app->user->identity->id;
                $model->created_at = new \yii\db\Expression('NOW()');
                $model->updated_at = new \yii\db\Expression('NOW()');



                if ($model->save() && $model->validate()) {
                    $resetPasswordModel = new \backend\models\PasswordResetRequestForm();
                    if ($resetPasswordModel->sendEmailAccountCreation($model->email)) {
                        $audit = new AuditTrail();
                        $audit->user = Yii::$app->user->id;
                        $audit->action = "Created user with email: " . $model->email;
                        $audit->ip_address = Yii::$app->request->getUserIP();
                        $audit->user_agent = Yii::$app->request->getUserAgent();
                        $audit->save();
                        Yii::$app->session->setFlash('success', 'User account with email:' . $model->email . ' was successfully created.');
                        return $this->redirect(['view', 'id' => $model->id]);
                    } else {
                        Yii::$app->session->setFlash('error', "User account created but email not sent!");
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } else {
                    $message = '';
                    foreach ($model->getErrors() as $error) {
                        $message .= $error[0];
                    }
                    Yii::$app->session->setFlash('error', "Error occured while creating user: $name.Please try again.Error::" . $message);
                    return $this->render('create', ['model' => $model, "user_type" => $user_type]);
                }
            }


            return $this->render('create', [
                        'model' => $model,
                        "user_type" => $user_type
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        if (User::userIsAllowedTo('Manage Users')) {
            $model = $this->findModel($id);
            $old_user_type = $model->type_of_user;
            $name = $model->first_name . ' ' . $model->other_name . ' ' . $model->last_name;
            if (Yii::$app->request->isAjax) {
                $model->load(Yii::$app->request->post());
                return Json::encode(\yii\widgets\ActiveForm::validate($model));
            }
            if ($model->load(Yii::$app->request->post())) {
                // var_dump($old_user_type);
                // var_dump(Yii::$app->request->post()['User']['user_type']);
                $model->updated_by = Yii::$app->user->identity->id;
                $model->username = $model->email;
                if (Yii::$app->request->post()['User']['user_type'] != $old_user_type) {
                    $model->type_of_user = Yii::$app->request->post()['User']['user_type'];
                    if ($model->type_of_user === "Other user") {
                        $model->province_id = 0;
                        $model->camp_id = 0;
                        $model->district_id = 0;
                    }
                    if ($model->type_of_user === "District user") {
                        $model->camp_id = 0;
                    }
                    if ($model->type_of_user === "Provincial user") {
                        $model->camp_id = 0;
                        $model->district_id = 0;
                    }
                }
                if ($model->save() && $model->validate()) {
                    $audit = new AuditTrail();
                    $audit->user = Yii::$app->user->id;
                    $audit->action = "Updated user details with email: " . $model->email;
                    $audit->ip_address = Yii::$app->request->getUserIP();
                    $audit->user_agent = Yii::$app->request->getUserAgent();
                    $audit->save();
                    Yii::$app->session->setFlash('success', "$name\'s Details were successfully updated.");
                } else {
                    $message = '';
                    foreach ($model->getErrors() as $error) {
                        $message .= $error[0];
                    }
                    Yii::$app->session->setFlash('error', "Error occured while updating $name\'s details Please try again.Error:" . $message);
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }

            $user_type = $model->type_of_user;

            return $this->render('update', [
                        'model' => $model,
                        "user_type" => $user_type
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    public function actionProfile($id) {
        $model = $this->findModel($id);
        $model_password = new \backend\models\ResetPasswordForm_1();
        if (Yii::$app->request->isAjax) {
            $model->load(Yii::$app->request->post());
            return Json::encode(\yii\widgets\ActiveForm::validate($model));
        }
        if ($model->load(Yii::$app->request->post())) {
            $model->username = $model->email;
            if ($model->validate() && $model->save()) {
                $audit = new AuditTrail();
                $audit->user = Yii::$app->user->id;
                $audit->action = "Updated profile details ";
                $audit->ip_address = Yii::$app->request->getUserIP();
                $audit->user_agent = Yii::$app->request->getUserAgent();
                $audit->save();
                Yii::$app->session->setFlash('success', 'Profile successfully updated.');
                return $this->redirect(['profile', 'id' => $model->id]);
            } else {
                Yii::$app->session->setFlash('error', 'Error occured while updating profile.Please try again!');
                return $this->redirect(['profile', 'id' => $model->id]);
            }
        }
        return $this->render('profile', [
                    'model' => $model,
                    'model2' => $model_password,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        //For now we just set the user status to User::STATUS_DELETED
        if (User::userIsAllowedTo('Manage Users')) {
            $model = $this->findModel($id);
            $model->status = User::STATUS_DELETED;
            $email = $model->email;
            if ($model->save()) {
                $audit = new AuditTrail();
                $audit->user = Yii::$app->user->id;
                $audit->action = "Deleted user account with email " . $email;
                $audit->ip_address = Yii::$app->request->getUserIP();
                $audit->user_agent = Yii::$app->request->getUserAgent();
                $audit->save();
                Yii::$app->session->setFlash('success', "User was successfully deleted.");
            } else {
                Yii::$app->session->setFlash('error', "User could not be deleted. Please try again!");
            }
            return $this->redirect(['index']);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    public function actionBlock($id) {
        //For now we just set the user status to User::STATUS_DELETED
        if (User::userIsAllowedTo('Manage Users')) {
            $model = $this->findModel($id);
            $model->status = User::STATUS_INACTIVE;
            if ($model->save()) {
                $audit = new AuditTrail();
                $audit->user = Yii::$app->user->id;
                $audit->action = "Blocked user account with email " . $model->email;
                $audit->ip_address = Yii::$app->request->getUserIP();
                $audit->user_agent = Yii::$app->request->getUserAgent();
                $audit->save();
                Yii::$app->session->setFlash('success', "User was successfully blocked.");
            } else {
                Yii::$app->session->setFlash('error', "User could not be blocked. Please try again!");
            }
            return $this->redirect(['view', 'id' => $id]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
