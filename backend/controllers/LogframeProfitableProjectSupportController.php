<?php

namespace backend\controllers;

use Yii;
use backend\models\LogframeDeveObjectivesHouseholdProfitableprojectSupport;
use app\models\LogframeDevObjectivesProfitableprojectSupportSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Json;
use backend\models\AuditTrail;
use backend\models\User;

/**
 * LogframeProfitableProjectSupportController implements the CRUD actions for LogframeDeveObjectivesHouseholdProfitableprojectSupport model.
 */
class LogframeProfitableProjectSupportController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'create', 'delete', 'update', 'view'],
                'rules' => [
                    [
                        'actions' => ['index', 'create', 'delete', 'update', 'view'],
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
     * Lists all LogframeDeveObjectivesHouseholdProfitableprojectSupport models.
     * @return mixed
     */
      public function actionIndex() {
        if (User::userIsAllowedTo('Submit logframe data') || User::userIsAllowedTo('View logframe data')) {
            $searchModel = new LogframeDevObjectivesProfitableprojectSupportSearch();
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
     * Displays a single LogframeDeveObjectivesHouseholdProfitableprojectSupport model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
   public function actionView($id) {
        if (User::userIsAllowedTo('Submit logframe data') || User::userIsAllowedTo('View logframe data')) {
            return $this->render('view', [
                        'model' => $this->findModel($id),
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    /**
     * Creates a new LogframeDeveObjectivesHouseholdProfitableprojectSupport model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        if (User::userIsAllowedTo('Submit logframe data')) {
            $model = new LogframeDeveObjectivesHouseholdProfitableprojectSupport();
            if (Yii::$app->request->isAjax) {
                $model->load(Yii::$app->request->post());
                return Json::encode(\yii\widgets\ActiveForm::validate($model));
            }

            if ($model->load(Yii::$app->request->post())) {

                $model->created_by = Yii::$app->user->identity->id;
                $model->updated_by = Yii::$app->user->identity->id;
                $model->cumulative = $model->yr_results + self::getCumulativePreviousYear($model->year,$model->category);
                //TODO: Calculate cumulative percentage
                $model->cumulative_percentage = 0;
                $model->indicator = "Proportion (%) of households receiving programme support that are having profitable market-oriented agriculture by project end";
                if ($model->save()) {
                    $audit = new AuditTrail();
                    $audit->user = Yii::$app->user->id;
                    $audit->action = "Added Logframe data: Development Objectives Profitable Project Supports. Category:" . $model->category;
                    $audit->ip_address = Yii::$app->request->getUserIP();
                    $audit->user_agent = Yii::$app->request->getUserAgent();
                    $audit->save();
                    Yii::$app->session->setFlash('success', 'Development Objectives Profitable Project Supports record was successfully added.');
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    $message = '';
                    foreach ($model->getErrors() as $error) {
                        $message .= $error[0];
                    }
                    Yii::$app->session->setFlash('error', 'Error occured while adding Development Objectives Profitable Project Supports record.Error::' . $message);
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

    public static function getCumulativePreviousYear($year, $category) {
        $response = 0;
        $model = LogframeDeveObjectivesHouseholdProfitableprojectSupport::findOne(["year" => $year - 1,'category' => $category]);
        if (!empty($model)) {
            $response = $model->cumulative;
        }
        return $response;
    }

    /**
     * Updates an existing LogframeDeveObjectivesHouseholdProfitableprojectSupport model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        if (User::userIsAllowedTo('Submit logframe data')) {
            $model = $this->findModel($id);
            if (Yii::$app->request->isAjax) {
                $model->load(Yii::$app->request->post());
                return Json::encode(\yii\widgets\ActiveForm::validate($model));
            }
            if ($model->load(Yii::$app->request->post())) {
                $model->updated_by = Yii::$app->user->identity->id;
                $model->cumulative = $model->yr_results + self::getCumulativePreviousYear($model->year, $model->category);
                //TODO: Calculate cumulative percentage
                $model->cumulative_percentage = 0;
                if ($model->save()) {
                    $audit = new AuditTrail();
                    $audit->user = Yii::$app->user->id;
                    $audit->action = "Updated Logframe data: Development Objectives Profitable Project Supports Category:" . $model->category . ". Record ID:" . $model->id;
                    $audit->ip_address = Yii::$app->request->getUserIP();
                    $audit->user_agent = Yii::$app->request->getUserAgent();
                    $audit->save();
                    Yii::$app->session->setFlash('success', 'Development Objectives Profitable Project Supports record was successfully updated.');
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    $message = '';
                    foreach ($model->getErrors() as $error) {
                        $message .= $error[0];
                    }
                    Yii::$app->session->setFlash('error', 'Error occured while updating Development Objectives Profitable Project Supports record.Error::' . $message);
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
     * Deletes an existing LogframeDeveObjectivesHouseholdProfitableprojectSupport model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        if (User::userIsAllowedTo('Submit logframe data')) {
            $model = $this->findModel($id);

            if ($model->delete()) {
                $audit = new AuditTrail();
                $audit->user = Yii::$app->user->id;
                $audit->action = "Deleted Logframe data:Development Objectives Profitable Project Supports Category:" . $model->category . ". Record ID:" . $model->id;
                $audit->ip_address = Yii::$app->request->getUserIP();
                $audit->user_agent = Yii::$app->request->getUserAgent();
                $audit->save();
                Yii::$app->session->setFlash('success', "Development Objectives Profitable Project Supports record was successfully removed.");
            } else {
                Yii::$app->session->setFlash('error', "Development Objectives Profitable Project Supports record could not be removed. Please try again!");
            }

            return $this->redirect(['index']);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    /**
     * Finds the LogframeDeveObjectivesHouseholdProfitableprojectSupport model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return LogframeDeveObjectivesHouseholdProfitableprojectSupport the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = LogframeDeveObjectivesHouseholdProfitableprojectSupport::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
