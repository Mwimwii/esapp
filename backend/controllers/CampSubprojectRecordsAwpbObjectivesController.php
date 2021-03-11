<?php

namespace backend\controllers;

use Yii;
use backend\models\MeCampSubprojectRecordsAwpbObjectives;
use backend\models\CampSubprojectRecordsAwpbObjectivesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CampSubprojectRecordsAwpbObjectivesController implements the CRUD actions for MeCampSubprojectRecordsAwpbObjectives model.
 */
class CampSubprojectRecordsAwpbObjectivesController extends Controller {

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
     * Lists all MeCampSubprojectRecordsAwpbObjectives models.
     * @return mixed
     */
    public function actionIndex($camp_id = "", $year = "") {
        $model = new MeCampSubprojectRecordsAwpbObjectives();
        // $searchModel = new CampSubprojectRecordsAwpbObjectivesSearch();
        $dataProvider = "";
        if (Yii::$app->request->post() && $model->load(Yii::$app->request->post())) {
            if ($model->load(Yii::$app->request->post())) {
                $query = MeCampSubprojectRecordsAwpbObjectives::find()->indexBy('id'); // where `id` is your primary key
                $query->andWhere(['camp_id' => $model->camp_id, 'year' => $model->year]);
                $dataProvider = new \yii\data\ActiveDataProvider([
                    'query' => $query,
                ]);
            }
            return $this->render('index', [
                        'model' => $model,
                        'dataProvider' => $dataProvider,
            ]);
        } else {
            if (!empty($camp_id) && !empty($year)) {
                $model = $this->findModel($camp_id);
                $query = MeCampSubprojectRecordsAwpbObjectives::find()->indexBy('id'); // where `id` is your primary key
                $query->andWhere(['camp_id' => $camp_id, 'year' => $year]);
                $dataProvider = new \yii\data\ActiveDataProvider([
                    'query' => $query,
                ]);
            }
            return $this->render('index', [
                        'model' => $model,
                        'camp_id' => $camp_id,
                        'dataProvider' => $dataProvider,
            ]);
        }
    }

    public function actionSaveObjectives($camp = "", $year = "") {
        if (!empty(Yii::$app->request->post())) {
            $_array = Yii::$app->request->post('MeCampSubprojectRecordsAwpbObjectives', []);
            foreach ($_array as $value) {
                $model = $this->findModel([$value['id']]);
                $model->updated_by = (int) Yii::$app->user->id;
                $model->created_by = (int) Yii::$app->user->id;
                $model->key_indicators = $value['key_indicators'];
                $model->period_unit = $value['period_unit'];
                $model->target = $value['target'];
                $model->save();
            }

            Yii::$app->session->setFlash('success', "Camp/Project AWPB Obejectives were successfully updated");
            return $this->redirect(['index', 'camp_id' => $camp, 'year' => $year]);
        }
    }

    /**
     * Displays a single MeCampSubprojectRecordsAwpbObjectives model.
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
     * Creates a new MeCampSubprojectRecordsAwpbObjectives model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new MeCampSubprojectRecordsAwpbObjectives();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing MeCampSubprojectRecordsAwpbObjectives model.
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
     * Deletes an existing MeCampSubprojectRecordsAwpbObjectives model.
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
     * Finds the MeCampSubprojectRecordsAwpbObjectives model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MeCampSubprojectRecordsAwpbObjectives the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = MeCampSubprojectRecordsAwpbObjectives::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
