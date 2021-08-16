<?php

namespace frontend\controllers;

use Yii;
use frontend\models\MgfExpectedOutputsAndGrossRevenue;
use frontend\models\MgfExpectedOutputsAndGrossRevenueSearch;
use frontend\models\MgfApplicant;
use frontend\models\MgfProposal;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\User;

/**
 * MgfExpectedOutputsAndGrossRevenueController implements the CRUD actions for MgfExpectedOutputsAndGrossRevenue model.
 */
class MgfExpectedOutputsAndGrossRevenueController extends Controller
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
     * Lists all MgfExpectedOutputsAndGrossRevenue models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MgfExpectedOutputsAndGrossRevenueSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MgfExpectedOutputsAndGrossRevenue model.
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
     * Creates a new MgfExpectedOutputsAndGrossRevenue model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MgfExpectedOutputsAndGrossRevenue();

        if ($model->load(Yii::$app->request->post()) ){
            //$user=Yii::$app->user->id;
            $userid=Yii::$app->user->identity->id;
            $applicant=MgfApplicant::findOne(['user_id'=>$userid]);
            $proposal=MgfProposal::find()->where(['is_active'=>1,'organisation_id'=>$applicant->organisation_id])->one();
            $model->proposal_id=$proposal->id;
            $model->date_created=date('Y-m-d H:i:s');
            $model->created_by=$userid;  
            $model->expected_gross_revenue=$model->quantity * $model->expected_price;
            
            
            
            $model->save();
                return $this->redirect(['index']);
            }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing MgfExpectedOutputsAndGrossRevenue model.
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
     * Deletes an existing MgfExpectedOutputsAndGrossRevenue model.
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
     * Finds the MgfExpectedOutputsAndGrossRevenue model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MgfExpectedOutputsAndGrossRevenue the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MgfExpectedOutputsAndGrossRevenue::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
