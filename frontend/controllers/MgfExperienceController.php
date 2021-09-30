<?php

namespace frontend\controllers;
<<<<<<< HEAD
=======

>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
use Yii;
use frontend\models\MgfExperience;
use frontend\models\MgfExperienceSearch;
use frontend\models\MgfPartnership;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\MgfPastproject;
use frontend\models\MgfApplicant;
use frontend\models\MgfChecklist;
use frontend\models\MgfOrganisation;

/**
 * MgfExperienceController implements the CRUD actions for MgfExperience model.
 */
<<<<<<< HEAD
class MgfExperienceController extends Controller{
    /**
     * {@inheritdoc}
     */
    public function behaviors(){
=======
class MgfExperienceController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
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
<<<<<<< HEAD
    public function actionIndex(){
=======
    public function actionIndex() {
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
        $searchModel = new MgfExperienceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
<<<<<<< HEAD
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
=======
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
        ]);
    }

    /**
     * Displays a single MgfExperience model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
<<<<<<< HEAD
    public function actionView($id,$status){
        if($status==0){
            return $this->render('viewproj', ['model' => $this->findModel($id),]);
        }else{
=======
    public function actionView($id, $status) {
        if ($status == 0) {
            return $this->render('viewproj', ['model' => $this->findModel($id),]);
        } else {
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
            return $this->render('viewpart', ['model' => $this->findModel($id),]);
        }
    }

<<<<<<< HEAD

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
=======
    public function actionPastproject($id) {
        $model = new MgfPastproject();
        $experience = MgfExperience::findOne($id);
        if ($model->load(Yii::$app->request->post())) {
            $model->organisation_id = $experience->organisation_id;
            $model->experience_id = $experience->id;
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Saved successfully.');
                return $this->redirect(['update', 'id' => $experience->id]);
            } else {
                Yii::$app->session->setFlash('error', 'NOT Saved');
                return $this->redirect(['update', 'id' => $experience->id]);
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
            }
        }
    }

<<<<<<< HEAD

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
=======
    public function actionPartnership($id) {
        $model = new MgfPartnership();
        $experience = MgfExperience::findOne($id);
        if ($model->load(Yii::$app->request->post())) {
            $userid = Yii::$app->user->identity->id;
            $model->organisation_id = $experience->organisation_id;
            $model->experience_id = $id;
            if (MgfPartnership::find()->where(['partner_name' => $model->partner_name, 'start_date' => $model->start_date, 'experience_id' => $experience->id])->exists()) {
                Yii::$app->session->setFlash('error', 'NOT Saved: This Partnership has already been recorded');
                return $this->redirect(['update', 'id' => $experience->id]);
            } else {
                if ($model->save()) {
                    Yii::$app->session->setFlash('success', 'Saved successfully.');
                    return $this->redirect(['update', 'id' => $experience->id]);
                } else {
                    Yii::$app->session->setFlash('error', 'NOT Saved');
                    return $this->redirect(['update', 'id' => $experience->id]);
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
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
<<<<<<< HEAD
    public function actionUpdate($id){
        $model = $this->findModel($id);
        $userid=Yii::$app->user->identity->id;
        $applicant=MgfApplicant::findOne(['user_id'=>$userid]);
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                MgfChecklist::updateAll(['experience_updated'=>1], 'applicant_id='.$applicant->id); 
                if($model->financed_before=='NO'){
                    MgfPastproject::deleteAll(['experience_id'=>$id]);

                }
                if ($model->collaboration_ready=='YES' || $model->collaboration_ready=='NO') {
                    MgfChecklist::updateAll(['experience_updated'=>1], 'applicant_id='.$applicant->id); 
                }
                Yii::$app->session->setFlash('success', 'Saved successfully.');
            
            } else {
                Yii::$app->session->setFlash('error', 'Information NOT Saved!.');
            }
            return $this->redirect(['update', 'id' =>$id]);
        }
        return $this->render('update', ['model' => $model,]);
    }


=======
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        $userid = Yii::$app->user->identity->id;
        $applicant = MgfApplicant::findOne(['user_id' => $userid]);
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                if ($model->financed_before == 'NO') {
                    MgfPastproject::deleteAll(['experience_id' => $id]);

                    Yii::$app->session->setFlash('success', 'Saved successfully.');
                    return $this->render('update', ['model' => $model,]);
                }
            } else {
                Yii::$app->session->setFlash('error', 'Information NOT Saved!.');
                return $this->render('update', ['model' => $model,]);
            }


            if ($model->collaboration_ready == 'YES' || $model->collaboration_ready == 'NO') {
                MgfChecklist::updateAll(['experience_updated' => 1], 'applicant_id=' . $applicant->id);
            }
            Yii::$app->session->setFlash('success', 'Saved successfully.' . $model->collaboration_ready);
        }
        return $this->redirect(['update', 'id' => $id]);
        
        return $this->render('update', ['model' => $model,]);
    }

>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
    /**
     * Deletes an existing MgfExperience model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
<<<<<<< HEAD
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

=======
    public function actionProjectDelete($id) {
        $pastproj = MgfPastproject::findOne($id);
        if ($pastproj->delete()) {
            Yii::$app->session->setFlash('success', 'Deleted successfully.');
        }

        return $this->redirect(['view', 'id' => $pastproj->experience_id, 'status' => 0]);
    }

    public function actionPartnershipDelete($id) {
        $partnership = MgfPartnership::findOne($id);
        if ($partnership->delete()) {
            Yii::$app->session->setFlash('success', 'Deleted successfully.');
        }

        return $this->redirect(['view', 'id' => $partnership->experience_id, 'status' => 1]);
    }
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d

    /**
     * Finds the MgfExperience model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MgfExperience the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
<<<<<<< HEAD
    protected function findModel($id)
    {
=======
    protected function findModel($id) {
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
        if (($model = MgfExperience::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
<<<<<<< HEAD
=======

>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
}
