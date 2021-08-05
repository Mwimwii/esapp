<?php

namespace backend\controllers;

use Yii;
use backend\models\HourlyRates;
use backend\models\HourlyRatesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Json;
use backend\models\AuditTrail;
use backend\models\User;

/**
 * HourlyRatesController implements the CRUD actions for HourlyRates model.
 */
class HourlyRatesController extends Controller {

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
     * Lists all HourlyRates models.
     * @return mixed
     */
    public function actionIndex() {
        if (User::userIsAllowedTo('Manage staff hourly rates') || User::userIsAllowedTo('View staff hourly rates')) {
            $model = new HourlyRates();
            $searchModel = new HourlyRatesSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            if (Yii::$app->request->post('hasEditable')) {
                $Id = Yii::$app->request->post('editableKey');
                $model = HourlyRates::findOne($Id);
                $out = Json::encode(['output' => '', 'message' => '']);
                $posted = current($_POST['HourlyRates']);
                $post = ['HourlyRates' => $posted];
                $old_rate = $model->rate;
                $old_designation = $model->designation;
                $salary_scale_old = $model->salary_scale;

                if ($model->load($post)) {
                    $model->updated_by = Yii::$app->user->identity->id;
                    if ($old_rate != $model->rate ||
                            $old_designation != $model->designation ||
                            $salary_scale_old != $model->salary_scale) {
                        $audit = new AuditTrail();
                        $audit->user = Yii::$app->user->id;
                        $audit->action = "Updated hourly rate details ";
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
     * Displays a single HourlyRates model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found

      public function actionView($id) {
      return $this->render('view', [
      'model' => $this->findModel($id),
      ]);
      } */

    /**
     * Creates a new HourlyRates model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        if (User::userIsAllowedTo('Manage staff hourly rates')) {
            $model = new HourlyRates();
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
                    $audit->action = "Added hourly rate ZMW" . $model->rate;
                    $audit->ip_address = Yii::$app->request->getUserIP();
                    $audit->user_agent = Yii::$app->request->getUserAgent();
                    $audit->save();
                    Yii::$app->session->setFlash('success', 'Hourly rate was successfully added.');
                } else {
                    Yii::$app->session->setFlash('error', 'Error occured while adding Hourly rate');
                }
                return $this->redirect(['index']);
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
     * Updates an existing HourlyRates model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found

      public function actionUpdate($id) {
      $model = $this->findModel($id);

      if ($model->load(Yii::$app->request->post()) && $model->save()) {
      return $this->redirect(['view', 'id' => $model->id]);
      }

      return $this->render('update', [
      'model' => $model,
      ]);
      } */

    /**
     * Deletes an existing HourlyRates model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        if (User::userIsAllowedTo('Manage staff hourly rates')) {
            try {
                $model = $this->findModel($id);
                $name = $model->rate;
                $designation = $model->designation;
                if ($model->delete()) {
                    $audit = new AuditTrail();
                    $audit->user = Yii::$app->user->id;
                    $audit->action = "Removed hourly rate:ZMW $name for designation:$designation from the system.";
                    $audit->ip_address = Yii::$app->request->getUserIP();
                    $audit->user_agent = Yii::$app->request->getUserAgent();
                    $audit->save();
                    Yii::$app->session->setFlash('success', "Hourly rate was successfully removed.");
                } else {
                    Yii::$app->session->setFlash('error', "Hourly rate could not be removed. Please try again!");
                }

                return $this->redirect(['index']);
            } catch (Exception $ex) {
                Yii::$app->session->setFlash('error', "This rate cannot be removed as its been used by a system record!");
                return $this->redirect(['index']);
            }
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    /**
     * Finds the HourlyRates model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return HourlyRates the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = HourlyRates::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
