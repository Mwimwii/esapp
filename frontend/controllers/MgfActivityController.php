<?php

namespace frontend\controllers;

use Yii;
use frontend\models\MgfComponent;
use frontend\models\MgfActivity;
use frontend\models\MgfActivitySearch;
use frontend\models\MgfInputCost;
use frontend\models\MgfInputItem;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MgfActivityController implements the CRUD actions for MgfActivity model.
 */
class MgfActivityController extends Controller
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
     * Lists all MgfActivity models.
     * @return mixed
     */
    public function actionIndex(){
        $searchModel = new MgfActivitySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionActivities(){
        $searchModel = new MgfActivitySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MgfActivity model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id){
        $items=MgfInputItem::find()->where(['activity_id'=>$id])->all();
        $costs=MgfInputCost::find()->where(['activity_id'=>$id])->all();
        return $this->render('view', ['model' => $this->findModel($id),'items'=>$items,'costs'=>$costs]);
    }

    /**
     * Creates a new MgfActivity model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id){
        $component =MgfComponent::findOne($id);
        $model = new MgfActivity();
        if ($model->load(Yii::$app->request->post())) {
            $userid=Yii::$app->user->identity->id;
            $model->componet_id=$component->id;
            $model->activity_no=time();
            $model->createdby=$userid;
            $model->save();

            $sum_of_activities=MgfActivity::find()->where(['componet_id'=>$id])->count();
            $component->activities=$sum_of_activities;
            $component->save();
            Yii::$app->session->setFlash('success', 'Created successfully.');
            return $this->redirect(['mgf-component/manage', 'id' =>$model->componet_id]);
        }else{
            Yii::$app->session->setFlash('error', 'Record NOT Saved');
            return $this->redirect(['mgf-component/manage', 'id' =>$model->componet_id]);
        }
    }

    /**
     * Updates an existing MgfActivity model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id){
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->save();

            $component =MgfComponent::findOne($model->componet_id);
            $sum_of_activities=MgfActivity::find()->where(['componet_id'=>$component->id])->count();
            $sum_of_activity_cost=MgfActivity::find()->where(['componet_id'=>$component->id])->sum('subtotal');
            $component->subtotal=$sum_of_activity_cost;
            $component->activities=$sum_of_activities;
            $component->save();

            Yii::$app->session->setFlash('success', 'Updated successfully.');
            return $this->redirect(['mgf-component/manage', 'id' =>$model->componet_id]);
        }

        return $this->render('update', ['model' => $model,]);
    }

    /**
     * Deletes an existing MgfActivity model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id){
        $activity=MgfActivity::findOne($id);
        $this->findModel($id)->delete();
        $component =MgfComponent::findOne($activity->componet_id);

        $sum_of_activities=MgfActivity::find()->where(['componet_id'=>$component->id])->count();
        $sum_of_activity_cost=MgfActivity::find()->where(['componet_id'=>$component->id])->sum('subtotal');
        $component->subtotal=$sum_of_activity_cost;
        $component->activities=$sum_of_activities;
        $component->save();

        Yii::$app->session->setFlash('success', 'Deleted successfully.');
        return $this->redirect(['mgf-component/manage', 'id' =>$activity->componet_id]);
    }

    /**
     * Finds the MgfActivity model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MgfActivity the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MgfActivity::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
