<?php

namespace backend\controllers;

use Yii;
use backend\models\LogframeOutputPeopleTrainedClimateSensitiveServices;
use app\models\LogframeOutputPeopleTrainedClimateSensitiveServicesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Json;
use backend\models\AuditTrail;
use backend\models\User;

/**
 * LogframePeopleTrainedClimateController implements the CRUD actions for LogframeOutputPeopleTrainedClimateSensitiveServices model.
 */
class LogframePeopleTrainedClimateController extends Controller {

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
     * Lists all LogframeOutputPeopleTrainedClimateSensitiveServices models.
     * @return mixed
     */
    public function actionIndex() {
        if (User::userIsAllowedTo('Submit logframe data') || User::userIsAllowedTo('View logframe data')) {
            $searchModel = new LogframeOutputPeopleTrainedClimateSensitiveServicesSearch();
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
     * Displays a single LogframeOutputPeopleTrainedClimateSensitiveServices model.
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
     * Creates a new LogframeOutputPeopleTrainedClimateSensitiveServices model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        if (User::userIsAllowedTo('Submit logframe data')) {
            $model = new LogframeOutputPeopleTrainedClimateSensitiveServices();
            if (Yii::$app->request->isAjax) {
                $model->load(Yii::$app->request->post());
                return Json::encode(\yii\widgets\ActiveForm::validate($model));
            }
            if ($model->load(Yii::$app->request->post())) {

                $model->created_by = Yii::$app->user->identity->id;
                $model->updated_by = Yii::$app->user->identity->id;
                $model->cumulative = $model->yr_results + self::getCumulativePreviousYear($model->year, $model->people_type);
                //TODO: Calculate cumulative percentage
                $model->cumulative_percentage = 0;
                $model->indicator = "People trained in providing climate sensitive agribusiness advisory services (including Farming as a Business training)";
                if ($model->save()) {
                    $audit = new AuditTrail();
                    $audit->user = Yii::$app->user->id;
                    $audit->action = "Added Logframe data: Output people trained in climate sensitive services record ";
                    $audit->ip_address = Yii::$app->request->getUserIP();
                    $audit->user_agent = Yii::$app->request->getUserAgent();
                    $audit->save();
                    Yii::$app->session->setFlash('success', 'Output people trained in climate sensitive services record was successfully added.');
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    $message = '';
                    foreach ($model->getErrors() as $error) {
                        $message .= $error[0];
                    }
                    Yii::$app->session->setFlash('error', 'Error occured while adding Output people trained in climate sensitive services record.Error::'.$message);
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

    public static function getCumulativePreviousYear($year, $gender) {
        $response = 0;
        $model = LogframeOutputPeopleTrainedClimateSensitiveServices::findOne(["year" => $year - 1, "people_type" => $gender]);
        if (!empty($model)) {
            $response = $model->cumulative;
        }
        return $response;
    }

    /**
     * Updates an existing LogframeOutputPeopleTrainedClimateSensitiveServices model.
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
                $model->cumulative = $model->yr_results + self::getCumulativePreviousYear($model->year, $model->people_type);
                //TODO: Calculate cumulative percentage
                $model->cumulative_percentage = 0;
                if ($model->save()) {
                    $audit = new AuditTrail();
                    $audit->user = Yii::$app->user->id;
                    $audit->action = "Updated Logframe data: Output people trained in climate sensitive services with record id:" . $model->id;
                    $audit->ip_address = Yii::$app->request->getUserIP();
                    $audit->user_agent = Yii::$app->request->getUserAgent();
                    $audit->save();
                    Yii::$app->session->setFlash('success', 'Output people trained in climate sensitive services record was successfully updated.');
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                     $message = '';
                    foreach ($model->getErrors() as $error) {
                        $message .= $error[0];
                    }
                    Yii::$app->session->setFlash('error', 'Error occured while updating Output people trained in climate sensitive services record.Error::'.$message);
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
     * Deletes an existing LogframeOutputPeopleTrainedClimateSensitiveServices model.
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
                $audit->action = "Deleted Logframe data: Output people trained in climate sensitive services with record id:" . $id;
                $audit->ip_address = Yii::$app->request->getUserIP();
                $audit->user_agent = Yii::$app->request->getUserAgent();
                $audit->save();
                Yii::$app->session->setFlash('success', "Output people trained in climate sensitive services record was successfully removed.");
            } else {
                Yii::$app->session->setFlash('error', "Output people trained in climate sensitive services record could not be removed. Please try again!");
            }

            return $this->redirect(['index']);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    /**
     * Finds the LogframeOutputPeopleTrainedClimateSensitiveServices model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return LogframeOutputPeopleTrainedClimateSensitiveServices the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = LogframeOutputPeopleTrainedClimateSensitiveServices::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
