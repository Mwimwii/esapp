<?php

namespace backend\controllers;

use Yii;
use backend\models\LkmStoryofchangeCategory;
use backend\models\LkmStoryofchangeCategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use backend\models\AuditTrail;
use backend\models\User;
use yii\filters\AccessControl;

/**
 * StoryofchangeCategoryController implements the CRUD actions for LkmStoryofchangeCategory model.
 */
class StoryofchangeCategoryController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'create', 'delete',],
                'rules' => [
                    [
                        'actions' => ['index', 'create', 'delete'],
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
     * Lists all LkmStoryofchangeCategory models.
     * @return mixed
     */
    public function actionIndex() {
        if (User::userIsAllowedTo('Manage story of change categories')) {
            $model = new LkmStoryofchangeCategory();
            $searchModel = new LkmStoryofchangeCategorySearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            if (Yii::$app->request->post('hasEditable')) {
                $Id = Yii::$app->request->post('editableKey');
                $model = LkmStoryofchangeCategory::findOne($Id);
                $out = Json::encode(['output' => '', 'message' => '']);
                $posted = current($_POST['LkmStoryofchangeCategory']);
                $post = ['LkmStoryofchangeCategory' => $posted];
                $old = $model->name;
                $old_desc = $model->description;

                if ($model->load($post)) {
                    if ($old != $model->name || $old_desc != $model->description) {
                        $audit = new AuditTrail();
                        $audit->user = Yii::$app->user->id;
                        if ($old_desc != $model->description) {
                            $audit->action = "Updated story of change category description to::" . $model->description;
                        }
                        if ($old != $model->name) {
                            $audit->action = "Updated story of change category name from $old to " . $model->name;
                        }
                        $audit->ip_address = Yii::$app->request->getUserIP();
                        $audit->user_agent = Yii::$app->request->getUserAgent();
                        $audit->save();
                        $model->updated_by = Yii::$app->user->id;
                    }
                    $message = '';
                    if (!$model->save()) {
                        foreach ($model->getErrors() as $error) {
                            $message .= $error[0];
                        }
                        $output = $message;
                    }
                    $output = '';
                    $out = Json::encode(['output' => $output, 'message' => $message]);
                }
                return $out;
            }
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
     * Displays a single LkmStoryofchangeCategory model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    /*  public function actionView($id) {
      return $this->render('view', [
      'model' => $this->findModel($id),
      ]);
      } */

    /**
     * Creates a new LkmStoryofchangeCategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        if (User::userIsAllowedTo('Manage story of change categories')) {
            $model = new LkmStoryofchangeCategory();
            if (Yii::$app->request->isAjax) {
                $model->load(Yii::$app->request->post());
                return Json::encode(\yii\widgets\ActiveForm::validate($model));
            }
            if ($model->load(Yii::$app->request->post())) {
                $model->created_by = Yii::$app->user->identity->id;
                $model->updated_by = Yii::$app->user->identity->id;
                if ($model->save()) {
                    $audit = new AuditTrail();
                    $audit->user = Yii::$app->user->id;
                    $audit->action = "Added story of change category: " . $model->name;
                    $audit->ip_address = Yii::$app->request->getUserIP();
                    $audit->user_agent = Yii::$app->request->getUserAgent();
                    $audit->save();
                    Yii::$app->session->setFlash('success', 'Story of change category: ' . $model->name . ' was successfully added.');
                } else {
                    Yii::$app->session->setFlash('error', 'Error occured while adding story of change category: ' . $model->name);
                }
                return $this->redirect(['index']);
            }
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    /**
     * Updates an existing LkmStoryofchangeCategory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    /* public function actionUpdate($id) {
      $model = $this->findModel($id);

      if ($model->load(Yii::$app->request->post()) && $model->save()) {
      return $this->redirect(['view', 'id' => $model->id]);
      }

      return $this->render('update', [
      'model' => $model,
      ]);
      } */

    /**
     * Deletes an existing LkmStoryofchangeCategory model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        if (User::userIsAllowedTo('Manage story of change categories')) {
            $model = $this->findModel($id);
            $name = $model->name;
            if ($model->delete()) {
                $audit = new AuditTrail();
                $audit->user = Yii::$app->user->id;
                $audit->action = "Removed story of change category: $name from the system.";
                $audit->ip_address = Yii::$app->request->getUserIP();
                $audit->user_agent = Yii::$app->request->getUserAgent();
                $audit->save();
                Yii::$app->session->setFlash('success', "Story of change category: $name was successfully removed.");
            } else {
                Yii::$app->session->setFlash('error', "Story of change category: $name could not be removed. Please try again!");
            }
            return $this->redirect(['index']);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    /**
     * Finds the LkmStoryofchangeCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return LkmStoryofchangeCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = LkmStoryofchangeCategory::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
