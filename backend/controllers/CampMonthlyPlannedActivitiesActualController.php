<?php

namespace backend\controllers;

use Yii;
use backend\models\MeCampSubprojectRecordsMonthlyPlannedActivitiesActual;
use backend\models\MeCampSubprojectRecordsMonthlyPlannedActivitiesActualSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CampMonthlyPlannedActivitiesActualController implements the CRUD actions for MeCampSubprojectRecordsMonthlyPlannedActivitiesActual model.
 */
class CampMonthlyPlannedActivitiesActualController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
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
     * Lists all MeCampSubprojectRecordsMonthlyPlannedActivitiesActual models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MeCampSubprojectRecordsMonthlyPlannedActivitiesActualSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MeCampSubprojectRecordsMonthlyPlannedActivitiesActual model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new MeCampSubprojectRecordsMonthlyPlannedActivitiesActual model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MeCampSubprojectRecordsMonthlyPlannedActivitiesActual();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing MeCampSubprojectRecordsMonthlyPlannedActivitiesActual model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing MeCampSubprojectRecordsMonthlyPlannedActivitiesActual model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the MeCampSubprojectRecordsMonthlyPlannedActivitiesActual model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MeCampSubprojectRecordsMonthlyPlannedActivitiesActual the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MeCampSubprojectRecordsMonthlyPlannedActivitiesActual::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
