<?php

namespace backend\controllers;

use Yii;
use backend\models\MeCampSubprojectRecordsMonthlyPlannedActivities;
use backend\models\MeCampSubprojectRecordsMonthlyPlannedActivitiesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CampMonthlyPlannedActivitiesController implements the CRUD actions for MeCampSubprojectRecordsMonthlyPlannedActivities model.
 */
class CampMonthlyPlannedActivitiesController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all MeCampSubprojectRecordsMonthlyPlannedActivities models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new MeCampSubprojectRecordsMonthlyPlannedActivitiesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MeCampSubprojectRecordsMonthlyPlannedActivities model.
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
     * Creates a new MeCampSubprojectRecordsMonthlyPlannedActivities model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new MeCampSubprojectRecordsMonthlyPlannedActivities();
        if (Yii::$app->request->isAjax) {
            $model->load(Yii::$app->request->post());
            return Json::encode(\yii\widgets\ActiveForm::validate($model));
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        /*return $this->render('create', [
                    'model' => $model,
        ]);*/
    }

    /**
     * Updates an existing MeCampSubprojectRecordsMonthlyPlannedActivities model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing MeCampSubprojectRecordsMonthlyPlannedActivities model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the MeCampSubprojectRecordsMonthlyPlannedActivities model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MeCampSubprojectRecordsMonthlyPlannedActivities the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = MeCampSubprojectRecordsMonthlyPlannedActivities::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
