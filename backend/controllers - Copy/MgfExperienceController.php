<?php

namespace backend\controllers;
use Yii;
use frontend\models\MgfExperience;
use frontend\models\MgfExperienceSearch;
use frontend\models\MgfPartnership;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\MgfPastproject;
use frontend\models\MgfApplicant;

/**
 * MgfExperienceController implements the CRUD actions for MgfExperience model.
 */
class MgfExperienceController extends Controller{
    /**
     * {@inheritdoc}
     */
    public function behaviors(){
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
     * Lists all MgfExperience models.
     * @return mixed
     */
    public function actionIndex(){
        $searchModel = new MgfExperienceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MgfExperience model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id,$status){
        if($status==0){
            return $this->render('viewproj', ['model' => $this->findModel($id),]);
        }else{
            return $this->render('viewpart', ['model' => $this->findModel($id),]);
        }
    }


    public function actionPastproject($id){
        $model = new MgfPastproject();
        $experience = MgfExperience::findOne($id);
        if ($model->load(Yii::$app->request->post())) {
            $model->organisation_id=$experience->organisation_id;
            $model->experience_id=$experience->id;
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Saved successfully.');
                return $this->redirect(['update', 'id' =>$experience->id]);
            } else {
                Yii::$app->session->setFlash('error', 'NOT Saved');
                return $this->redirect(['update', 'id' =>$experience->id]);
            }
        }
    }


    public function actionPartnership($id){
        $model = new MgfPartnership();
        $experience = MgfExperience::findOne($id);
        if ($model->load(Yii::$app->request->post())) {
            $userid=Yii::$app->user->identity->id;
            $model->organisation_id=$experience->organisation_id;
            $model->experience_id=$id;
            if (MgfPartnership::find()->where(['partner_name'=>$model->partner_name,'start_date'=>$model->start_date,'experience_id'=>$experience->id])->exists()) {
                Yii::$app->session->setFlash('error', 'NOT Saved: This Partnership has already been recorded');
                return $this->redirect(['update', 'id' =>$experience->id]);
            }else{
                if ($model->save()) {
                    Yii::$app->session->setFlash('success', 'Saved successfully.');
                    return $this->redirect(['update', 'id' =>$experience->id]);
                } else {
                    Yii::$app->session->setFlash('error', 'NOT Saved');
                    return $this->redirect(['update', 'id' =>$experience->id]);
                }
            }
        }
    }


    /**
     * Updates an existing MgfExperience model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id){
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                if($model->financed_before=='NO'){
                    MgfPastproject::deleteAll(['experience_id'=>$id]);
                    Yii::$app->session->setFlash('success', 'Saved successfully.');
                    return $this->render('update', ['model' => $model,]);
                }
            } else {
                Yii::$app->session->setFlash('error', 'Information NOT Saved!.');
                return $this->render('update', ['model' => $model,]);
            }
        }
        return $this->render('update', ['model' => $model,]);
    }


    /**
     * Deletes an existing MgfExperience model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionProjectDelete($id){
        $pastproj=MgfPastproject::findOne($id);
        if($pastproj->delete()){
            Yii::$app->session->setFlash('success', 'Deleted successfully.');
        }
        
        return $this->redirect(['view', 'id' =>$pastproj->experience_id,'status'=>0]);
    }

    public function actionPartnershipDelete($id){
        $partnership=MgfPartnership::findOne($id);
        if($partnership->delete()){
            Yii::$app->session->setFlash('success', 'Deleted successfully.');
        }
        
        return $this->redirect(['view', 'id' =>$partnership->experience_id,'status'=>1]);
    }


    /**
     * Finds the MgfExperience model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MgfExperience the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MgfExperience::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
