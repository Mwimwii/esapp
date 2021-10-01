<?php

namespace frontend\controllers;

use Yii;
use frontend\models\MgfBusinessPerfomanceIndicator;
use frontend\models\MgfBpiCategoriesIndicators;
use frontend\models\MgfBusinessPerfomanceIndicatorSearch;
use frontend\models\MgfApplicant;
use frontend\models\MgfProposal;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MgfBusinessPerfomanceIndicatorController implements the CRUD actions for MgfBusinessPerfomanceIndicator model.
 */
class MgfBusinessPerfomanceIndicatorController extends Controller
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
     * Lists all MgfBusinessPerfomanceIndicator models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MgfBusinessPerfomanceIndicatorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MgfBusinessPerfomanceIndicator model.
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
     * Creates a new MgfBusinessPerfomanceIndicator model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MgfBusinessPerfomanceIndicator();

        if ($model->load(Yii::$app->request->post()) ){
            //$user=Yii::$app->user->id;
            $userid=Yii::$app->user->identity->id;
           // $applicant=MgfApplicant::findOne(['user_id'=>$userid]);
            $bpi=MgfBpiCategoriesIndicators::findOne($model->indicator_id);

            $userid=Yii::$app->user->identity->id;
            $applicant=MgfApplicant::findOne(['user_id'=>$userid]);
            $proposal=MgfProposal::find()->where(['is_active'=>1,'organisation_id'=>$applicant->organisation_id])->one();
            //$model->proposal_id=13;//$proposal->id;
            $model->date_created=date('Y-m-d H:i:s');
            $model->created_by=$userid;  
            $model->agribusiness_indicators	=$bpi->indicator_description;
            $model->proposal_id=$proposal->id;
            
            
            
            $model->save();
                return $this->redirect(['index']);
            }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing MgfBusinessPerfomanceIndicator model.
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
     * Deletes an existing MgfBusinessPerfomanceIndicator model.
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
     * Finds the MgfBusinessPerfomanceIndicator model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MgfBusinessPerfomanceIndicator the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MgfBusinessPerfomanceIndicator::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionIndicator() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            //  Yii::warning('**********************', var_export($_POST['depdrop_parents'],true));
            //   $parents = $_POST['depdrop_all_params']['parent_id'];
            $selected_id = $_POST['depdrop_params'];
            if ($parents != null) {
                $prov_id = $parents[0];
                $out = \frontend\models\MgfBpiCategoriesIndicators::find()
                        ->select(['id', 'indicator_description as name'])
                        ->where(['category_id' => $prov_id])
                        ->asArray()
                        ->all();

                return ['output' => $out, 'selected' => $selected_id[0]];
            }
        }
        return ['output' => '', 'selected' => ''];
    }
}
