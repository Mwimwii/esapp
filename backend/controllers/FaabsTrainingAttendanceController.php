<?php

namespace backend\controllers;

use Yii;
use backend\models\MeFaabsTrainingAttendanceSheet;
use backend\models\MeFaabsTrainingAttendanceSheetSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Json;
use backend\models\AuditTrail;
use backend\models\User;
use yii\base\Model;
use yii\caching\DbDependency;

/**
 * FaabsTrainingAttendanceController implements the CRUD actions for MeFaabsTrainingAttendanceSheet model.
 */
class FaabsTrainingAttendanceController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'create', 'delete', 'update'],
                'rules' => [
                    [
                        'actions' => ['index', 'create', 'delete', 'update'],
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
     * Lists all MeFaabsTrainingAttendanceSheet models.
     * @return mixed
     */
    public function actionIndex() {
        if (User::userIsAllowedTo('Submit FaaBS training records') ||
                User::userIsAllowedTo('View FaaBS training records')) {

            $searchModel = new MeFaabsTrainingAttendanceSheetSearch();
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
             if (!empty(Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['training_date'])) {
                $date_arry = explode("to", Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['training_date']);
                $start_date = trim($date_arry[0]);
                $end_date = trim($date_arry[1]);
                $dataProvider->query->andFilterWhere(["BETWEEN", 'Date(training_date)', $start_date, $end_date]);
            }

            if (!empty(Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['province_id'])) {
                $district_ids = [];
                $districts = \backend\models\Districts::find()->where(['province_id' => Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['province_id']])->all();
                if (!empty($districts)) {
                    foreach ($districts as $id) {
                        array_push($district_ids, $id['id']);
                    }
                } else {
                    $_ids = [''];
                }

                $_camp_ids = [];
                $_faabs_ids = [-1];
                $camp_ids = \backend\models\Camps::find()
                        ->select(['id'])
                        ->where(["IN", 'district_id', $district_ids])
                        ->asArray()
                        ->all();

                //   var_dump($camp_ids);
                if (!empty($camp_ids)) {
                    foreach ($camp_ids as $id) {
                        array_push($_camp_ids, $id['id']);
                    }
                    $list = \backend\models\MeFaabsGroups::find()
                            ->where(['IN', 'camp_id', $_camp_ids])
                            ->all();
                    if (!empty($list)) {
                        foreach ($list as $id) {
                            array_push($_faabs_ids, $id['id']);
                        }
                    }
                }
                $dataProvider->query->andFilterWhere(['IN', 'faabs_group_id', $_faabs_ids]);
            }


            if (!empty(Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['district_id'])) {

                $_camp_ids = [];
                $_faabs_ids = [-1];
                $camp_ids = \backend\models\Camps::find()
                        ->select(['id'])
                        ->where(['district_id' => Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['district_id']])
                        ->asArray()
                        ->all();

                //   var_dump($camp_ids);
                if (!empty($camp_ids)) {
                    foreach ($camp_ids as $id) {
                        array_push($_camp_ids, $id['id']);
                    }
                    $list = \backend\models\MeFaabsGroups::find()
                            ->where(['IN', 'camp_id', $_camp_ids])
                            ->all();
                    if (!empty($list)) {
                        foreach ($list as $id) {
                            array_push($_faabs_ids, $id['id']);
                        }
                    }
                }
                $dataProvider->query->andFilterWhere(['IN', 'faabs_group_id', $_faabs_ids]);
            }

            if (!empty(Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['camp_id'])) {

                $_faabs_ids = [-1];

                $list = \backend\models\MeFaabsGroups::find()
                        ->where(['camp_id' => Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['camp_id']])
                        ->all();

                if (!empty($list)) {
                    foreach ($list as $id) {
                        array_push($_faabs_ids, $id['id']);
                    }
                }

                $dataProvider->query->andFilterWhere(['IN', 'faabs_group_id', $_faabs_ids]);
            }


            if (!empty(Yii::$app->user->identity->district_id) && Yii::$app->user->identity->district_id > 0) {
                $_camp_ids = [];
                $_faabs_ids = [-1];
                $camp_ids = \backend\models\Camps::find()
                        ->select(['id'])
                        ->where(['district_id' => Yii::$app->user->identity->district_id])
                        ->asArray()
                        ->all();
                if (!empty($camp_ids)) {
                    foreach ($camp_ids as $id) {
                        array_push($_camp_ids, $id['id']);
                    }
                    $list = \backend\models\MeFaabsGroups::find()
                            ->where(['IN', 'camp_id', $_camp_ids])
                            ->all();
                    if (!empty($list)) {
                        foreach ($list as $id) {
                            array_push($_faabs_ids, $id['id']);
                        }
                    }
                }
                $dataProvider->query->andFilterWhere(['IN', 'faabs_group_id', $_faabs_ids]);
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
     * Displays a single MeFaabsTrainingAttendanceSheet model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new MeFaabsTrainingAttendanceSheet model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        if (User::userIsAllowedTo('Submit FaaBS training records')) {
            $model = new MeFaabsTrainingAttendanceSheet();
            if (Yii::$app->request->isAjax) {
                $model->load(Yii::$app->request->post());
                return Json::encode(\yii\widgets\ActiveForm::validate($model));
            }

            if ($model->load(Yii::$app->request->post())) {
                $model->created_by = Yii::$app->user->identity->id;
                $model->updated_by = Yii::$app->user->identity->id;
                $farmer_model = \backend\models\MeFaabsCategoryAFarmers::findOne($model->farmer_id);
                $name = $farmer_model->title . "" . $farmer_model->first_name . " " . $farmer_model->other_names . " " . $farmer_model->last_name;
                if ($model->save()) {
                    $audit = new AuditTrail();
                    $audit->user = Yii::$app->user->id;
                    $audit->action = "Added FaaBS training attendance record for farmer:" . $name . ". The training took place on:" . $model->training_date;
                    $audit->ip_address = Yii::$app->request->getUserIP();
                    $audit->user_agent = Yii::$app->request->getUserAgent();
                    $audit->save();
                    Yii::$app->session->setFlash('success', 'FaaBS training attendance record was successfully added. You can add another record');
                } else {
                    $message = "";
                    foreach ($model->getErrors() as $error) {
                        $message .= $error[0];
                    }
                    Yii::$app->session->setFlash('error', 'Error occured while adding FaaBS training attendance record. Please try again!.Error::' . $message);
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
     * Updates an existing MeFaabsTrainingAttendanceSheet model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        if (User::userIsAllowedTo('Submit FaaBS training records')) {
            $model = $this->findModel($id);
            if (Yii::$app->request->isAjax) {
                $model->load(Yii::$app->request->post());
                return Json::encode(\yii\widgets\ActiveForm::validate($model));
            }

            if ($model->load(Yii::$app->request->post())) {
                $model->updated_by = Yii::$app->user->identity->id;
                $farmer_model = \backend\models\MeFaabsCategoryAFarmers::findOne($model->farmer_id);
                $name = $farmer_model->title . "" . $farmer_model->first_name . " " . $farmer_model->other_names . " " . $farmer_model->last_name;
                if ($model->save()) {
                    $audit = new AuditTrail();
                    $audit->user = Yii::$app->user->id;
                    $audit->action = "Updated FaaBS training attendance record for farmer:" . $name . ". The training took place on:" . $model->training_date;
                    $audit->ip_address = Yii::$app->request->getUserIP();
                    $audit->user_agent = Yii::$app->request->getUserAgent();
                    $audit->save();
                    Yii::$app->session->setFlash('success', 'FaaBS training attendance record was successfully updated. ');
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    $message = "";
                    foreach ($model->getErrors() as $error) {
                        $message .= $error[0];
                    }
                    Yii::$app->session->setFlash('error', 'Error occured while updating FaaBS training attendance record. Please try again!.Error::' . $message);
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
     * Deletes an existing MeFaabsTrainingAttendanceSheet model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        if (User::userIsAllowedTo('Remove FaaBS training records')) {
            $model = $this->findModel($id);
            $farmer_model = \backend\models\MeFaabsCategoryAFarmers::findOne($model->farmer_id);
            $name = $farmer_model->title . "" . $farmer_model->first_name . " " . $farmer_model->other_names . " " . $farmer_model->last_name;
            if ($model->delete()) {
                $audit = new AuditTrail();
                $audit->user = Yii::$app->user->id;
                $audit->action = "Removed FaaBS training attendance record for farmer:" . $name . ". The training took place on:" . $model->training_date;
                $audit->ip_address = Yii::$app->request->getUserIP();
                $audit->user_agent = Yii::$app->request->getUserAgent();
                $audit->save();
                Yii::$app->session->setFlash('success', "FaaBS training attendance record was successfully removed from the system.");
            } else {
                Yii::$app->session->setFlash('error', "FaaBS training attendance record could not be removed. Please try again!");
            }

            return $this->redirect(['index']);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    /**
     * Finds the MeFaabsTrainingAttendanceSheet model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MeFaabsTrainingAttendanceSheet the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = MeFaabsTrainingAttendanceSheet::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
