<?php

namespace backend\controllers;

use Yii;
use backend\models\AwpbOutcome;
use backend\models\AwpbOutcomeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
/**
 * AwpbOutcomeController implements the CRUD actions for AwpbOutcome model.
 */
class AwpbOutcomeController extends Controller
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
     * Lists all AwpbOutcome models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AwpbOutcomeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AwpbOutcome model.
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
     * Creates a new AwpbOutcome model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AwpbOutcome();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing AwpbOutcome model.
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
     * Deletes an existing AwpbOutcome model.
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
     * Finds the AwpbOutcome model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AwpbOutcome the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AwpbOutcome::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionComponentoutcomes() {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (isset(Yii::$app->request->post()['depdrop_parents'])) {
            $parents = Yii::$app->request->post('depdrop_parents');
            if ($parents != null) {
                $comp_id = $parents[0];
               // $parent_comp = \backend\models\AwpbComponent::findOne(['id'=>$comp_id]);
              // $parent_comp=   \backend\models\AwpbComponent::find()->where(['=','id',$comp_id])->one();
                return [
                    'output' => AwpbOutcome::getAwpbComponentOutcomes($comp_id, true),
                    'selected' => '',
                ];
            }
        }}
}
