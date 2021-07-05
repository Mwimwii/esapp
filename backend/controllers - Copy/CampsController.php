<?php

namespace backend\controllers;

use Yii;
use backend\models\Camps;
use backend\models\CampsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Json;
use backend\models\AuditTrail;
use backend\models\User;

/**
 * CampsController implements the CRUD actions for Camps model.
 */
class CampsController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'create', 'delete','camp','district'],
                'rules' => [
                    [
                        'actions' => ['index', 'create', 'delete','camp','district'],
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
     * Lists all Camps models.
     * @return mixed
     */
    public function actionIndex() {
        if (User::userIsAllowedTo('Manage camps')) {
            $model = new Camps();
            $searchModel = new CampsSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            if (!empty(Yii::$app->request->queryParams['CampsSearch']['province_id'])) {
                $district_ids = [];
                $districts = \backend\models\Districts::find()->where(['province_id' => Yii::$app->request->queryParams['CampsSearch']['province_id']])->all();
                if (!empty($districts)) {
                    foreach ($districts as $id) {
                        array_push($district_ids, $id['id']);
                    }
                }
                $dataProvider->query->andFilterWhere(['IN', 'district_id', $district_ids]);
            }
            if (Yii::$app->request->post('hasEditable')) {
                $Id = Yii::$app->request->post('editableKey');
                $model = Camps::findOne($Id);
                $out = Json::encode(['output' => '', 'message' => '']);
                $posted = current($_POST['Camps']);
                $post = ['Camps' => $posted];
                $old = $model->name;

                if ($model->load($post)) {
                    if ($old != $model->name) {
                        $audit = new AuditTrail();
                        $audit->user = Yii::$app->user->id;
                        $audit->action = "Updated camp name from $old to " . $model->name;
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
                        'model' => $model,
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    /**
     * Creates a new Province model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        if (User::userIsAllowedTo('Manage camps')) {
            $model = new Camps();
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
                    $audit->action = "Added camp " . $model->name;
                    $audit->ip_address = Yii::$app->request->getUserIP();
                    $audit->user_agent = Yii::$app->request->getUserAgent();
                    $audit->save();
                    Yii::$app->session->setFlash('success', 'Camp ' . $model->name . ' was successfully added.');
                } else {
                    Yii::$app->session->setFlash('error', 'Error occured while adding camp ' . $model->name);
                }
                return $this->redirect(['index']);
            }
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    /**
     * Deletes an existing Camps model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        if (User::userIsAllowedTo('Remove camps')) {
            $model = $this->findModel($id);
            $name = $model->name;
            if ($model->delete()) {
                $audit = new AuditTrail();
                $audit->user = Yii::$app->user->id;
                $audit->action = "Removed camp $name from the system.";
                $audit->ip_address = Yii::$app->request->getUserIP();
                $audit->user_agent = Yii::$app->request->getUserAgent();
                $audit->save();
                Yii::$app->session->setFlash('success', "Camp $name was successfully removed.");
            } else {
                Yii::$app->session->setFlash('error', "Camp $name could not be removed. Please try again!");
            }

            return $this->redirect(['index']);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    /**
     * Finds the Camps model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Camps the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Camps::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionDistrict() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            //  Yii::warning('**********************', var_export($_POST['depdrop_parents'],true));
            //   $parents = $_POST['depdrop_all_params']['parent_id'];
            $selected_id = $_POST['depdrop_params'];
            if ($parents != null) {
                $prov_id = $parents[0];
                $out = \backend\models\Districts::find()
                        ->select(['id', 'name'])
                        ->where(['province_id' => $prov_id])
                        ->asArray()
                        ->all();

                return ['output' => $out, 'selected' => $selected_id[0]];
            }
        }
        return ['output' => '', 'selected' => ''];
    }

    public function actionCamp() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            $selected_id = $_POST['depdrop_all_params']['selected_id3'];
            if ($parents != null) {
                $dist_id = $parents[0];
                $out = \backend\models\Camps::find()
                        ->select(['id', 'name'])
                        ->where(['district_id' => $dist_id])
                        ->asArray()
                        ->all();

                return ['output' => $out, 'selected' => $selected_id];
            }
        }
        return ['output' => '', 'selected' => ''];
    }

}
