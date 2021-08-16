<?php

namespace frontend\controllers;

use Yii;
use frontend\models\MgfEnvironmentalConsideration;
use frontend\models\MgfEnvironmentalConsiderationSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MgfEnvironmentalConsiderationController implements the CRUD actions for MgfEnvironmentalConsideration model.
 */
class MgfEnvironmentalConsiderationController extends Controller
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
     * Lists all MgfEnvironmentalConsideration models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MgfEnvironmentalConsiderationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MgfEnvironmentalConsideration model.
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
     * Creates a new MgfEnvironmentalConsideration model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MgfEnvironmentalConsideration();

        if ($model->load(Yii::$app->request->post()) ){
            //$user=Yii::$app->user->id;
            $userid=Yii::$app->user->identity->id;
           // $applicant=MgfApplicant::findOne(['user_id'=>$userid]);
            //$proposal=MgfProposal::find()->where(['is_active'=>1,'organisation_id'=>$applicant->organisation_id])->one();
            //$model->proposal_id=13;//$proposal->id;
            $model->date_created=date('Y-m-d H:i:s');
            $model->created_by=$userid;  
            
            
            
            $model->save();
                return $this->redirect(['index']);
            }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing MgfEnvironmentalConsideration model.
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
     * Deletes an existing MgfEnvironmentalConsideration model.
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
     * Finds the MgfEnvironmentalConsideration model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MgfEnvironmentalConsideration the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MgfEnvironmentalConsideration::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
