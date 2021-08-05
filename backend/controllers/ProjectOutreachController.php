<?php

namespace backend\controllers;

use Yii;
use backend\models\ProjectOutreach;
use backend\models\ProjectOutreachSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\AuditTrail;
use backend\models\User;
use yii\filters\AccessControl;
use yii\helpers\Json;

/**
 * ProjectOutreachController implements the CRUD actions for ProjectOutreach model.
 */
class ProjectOutreachController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'create', 'delete', 'view', 'update'],
                'rules' => [
                    [
                        'actions' => ['index', 'create', 'delete', 'view', 'update'],
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
     * Lists all ProjectOutreach models.
     * @return mixed
     */
    public function actionIndex() {
        if (User::userIsAllowedTo('Submit project outreach records')) {
            $searchModel = new ProjectOutreachSearch();
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

    /**
     * Displays a single ProjectOutreach model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        if (User::userIsAllowedTo('Submit project outreach records')) {
            return $this->render('view', [
                        'model' => $this->findModel($id),
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    /**
     * Creates a new ProjectOutreach model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        if (User::userIsAllowedTo('Submit project outreach records')) {
            $model = new ProjectOutreach();
            if (Yii::$app->request->isAjax) {
                $model->load(Yii::$app->request->post());
                return Json::encode(\yii\widgets\ActiveForm::validate($model));
            }

            if ($model->load(Yii::$app->request->post())) {
                $model->component = "Component 2: Sustainable Agribusiness Partnerships";
                $model->created_by = Yii::$app->user->identity->id;
                $model->updated_by = Yii::$app->user->identity->id;
                if (!empty(Yii::$app->user->identity->district_id) && Yii::$app->user->identity->district_id > 0) {
                    $district_model = \backend\models\Districts::findOne(Yii::$app->user->identity->district_id);
                    $model->province_id = !empty($district_model) ? $district_model->province_id : 0;
                    $model->district_id = Yii::$app->user->identity->district_id;
                }

                if ($model->save()) {
                    $audit = new AuditTrail();
                    $audit->user = Yii::$app->user->id;
                    $audit->action = "Created project outreach record for year:" . $model->year . " and quarter:" . $model->quarter;
                    $audit->ip_address = Yii::$app->request->getUserIP();
                    $audit->user_agent = Yii::$app->request->getUserAgent();
                    $audit->save();
                    Yii::$app->session->setFlash('success', 'Project out reach record was saved successfully');
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    $message = "";
                    foreach ($model->getErrors() as $error) {
                        $message .= $error[0];
                    }
                    Yii::$app->session->setFlash('error', 'Error occured while saving project outreach record.Error::' . $message);
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
     * Updates an existing ProjectOutreach model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        if (User::userIsAllowedTo('Submit project outreach records')) {
            $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post())) {
                if (!empty(Yii::$app->user->identity->district_id) && Yii::$app->user->identity->district_id > 0) {
                    $district_model = \backend\models\Districts::findOne(Yii::$app->user->identity->district_id);
                    $model->province_id = !empty($district_model) ? $district_model->province_id : 0;
                    $model->district_id = Yii::$app->user->identity->district_id;
                }
                $model->updated_by = Yii::$app->user->identity->id;

                if ($model->save()) {
                    $audit = new AuditTrail();
                    $audit->user = Yii::$app->user->id;
                    $audit->action = "updated project outreach record for year:" . $model->year . " and quarter:" . $model->quarter;
                    $audit->ip_address = Yii::$app->request->getUserIP();
                    $audit->user_agent = Yii::$app->request->getUserAgent();
                    $audit->save();
                    Yii::$app->session->setFlash('success', 'Project out reach record was updated successfully');
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    $message = "";
                    foreach ($model->getErrors() as $error) {
                        $message .= $error[0];
                    }
                    Yii::$app->session->setFlash('error', 'Error occured while updating project outreach record.Error::' . $message);
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
     * Deletes an existing ProjectOutreach model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        if (User::userIsAllowedTo('Remove project outreach records')) {
            $model = $this->findModel($id);
            if ($model->delete()) {
                $audit = new AuditTrail();
                $audit->user = Yii::$app->user->id;
                $audit->action = "Removed project outreach record";
                $audit->ip_address = Yii::$app->request->getUserIP();
                $audit->user_agent = Yii::$app->request->getUserAgent();
                $audit->save();
                Yii::$app->session->setFlash('success', "Project outreach record was successfully removed.");
            } else {
                Yii::$app->session->setFlash('error', "Project outreach record could not be removed. Please try again!");
            }
            return $this->redirect(['index']);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    /**
     * Finds the ProjectOutreach model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProjectOutreach the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = ProjectOutreach::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
