<?php

namespace backend\controllers;

use Yii;
use backend\models\MgfConceptNote;
use backend\models\MgfConceptNoteSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\MgfApplicant;
use backend\models\MgfApplication;
use backend\models\MgfApproval;
use backend\models\MgfApprovalStatus;
use backend\models\MgfOrganisation;
use backend\models\MgfScreening;

//include("findid.php");
/**
 * MgfConceptNoteController implements the CRUD actions for MgfConceptNote model.
 */
class MgfConceptNoteController extends Controller
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
     * Lists all MgfConceptNote models.
     * @return mixed
     */
    public function actionIndex(){
        $searchModel = new MgfConceptNoteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MgfConceptNote model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */

    public function actionView1($id){
        //$orgid=getOrganisationID();
        $concept=MgfConceptNote::find()->where(['organisation_id'=>$id]);
        //$concept
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }


    public function actionView($id){
        $model = $this->findModel($id);
        $application=MgfApplication::find()->where(['organisation_id'=>$model->organisation_id,'application_status'=>'Submitted','is_active'=>1])->orWhere(['organisation_id'=>$model->organisation_id,'application_status'=>'Under_Review','is_active'=>1])->one();
        $applicationid=$application->id;
        $application->application_status='Under_Review';
        if($application->save()){
        $concept=MgfConceptNote::findOne(['application_id'=>$applicationid]);
        $conceptid=$concept->id;
        $screening=MgfScreening::find()->where(['conceptnote_id'=>$id])->all();
        $unmarked=MgfScreening::find()->where(['organisation_id'=>$model->organisation_id,'conceptnote_id'=>$conceptid,'satisfactory'=>null])->count();
        $approval=MgfApproval::find()->where(['conceptnote_id'=>$conceptid,'application_id'=>$applicationid])->one();        
        $accepted=MgfApprovalStatus::findOne(['approval_status'=>'Accepted']);
        $rejected=MgfApprovalStatus::findOne(['approval_status'=>'Rejected']);
        $application_status=$application->application_status;
        if (boolval($unmarked)==false) {
            if ($approval->scores>=$accepted->lowerlimit) {
                $application_status="Accepted";
            } elseif ($approval->scores<=$rejected->upperlimit) {
                $application_status="Rejected";
            } else {
                $application_status="On-Hold";
            }
        }

        return $this->render('view', ['model' => $this->findModel($id),'criteria'=>$screening,'concept'=>$concept,
        'unmarked'=>$unmarked,'approval'=>$approval,'application_status'=>$application_status,'applicationid'=>$applicationid,'status'=>0]);
    }else{
        Yii::$app->session->setFlash('error', 'This Application cannot be Reviewed');
        return $this->redirect(['index',]);
    }
    }

    /**
     * Creates a new MgfConceptNote model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate(){
        $model = new MgfConceptNote();
        if ($model->load(Yii::$app->request->post())) {
            $userid=Yii::$app->user->identity->id;
            $applicant=MgfApplicant::findOne(["user_id"=>$userid]);
            $organisationid=$applicant->organisation_id;

            $application=MgfApplication::findOne(['organisation_id'=>$applicant->organisation_id,'is_active'=>1,'application_status'=>'Initialized']);
            MgfApplication::updateAll(['is_active' => 0], 'organisation_id='.$applicant->organisation_id);
            MgfApplication::updateAll(['is_active' => 1], 'id='.$application->id);
            $model->application_id=$application->id;
            $model->organisation_id=$organisationid;
            $model->save();
            Yii::$app->session->setFlash('success', 'Saved successfully.');
            return $this->redirect(['view', 'id' => $model->id]);
        }else{
            Yii::$app->session->setFlash('error', 'NOT Saved.');
            return $this->redirect(['/mgf-applicant/profile']);
        }
    }

    /**
     * Updates an existing MgfConceptNote model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id){
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->date_submitted=NULL;
            $model->save();
            $applicationid=$model->application_id;
            $application = MgfApplication::findOne($applicationid);
            $application->application_status='Updated';
            $application->is_active=1;
            $application->date_submitted=NULL;
            if ($application->save()) {
                Yii::$app->session->setFlash('success', 'Saved successfully.');
                MgfApplication::updateAll(['is_active' => 0], 'id!='.$applicationid);
                return $this->redirect(['view', 'id' => $model->id]);
            }else{
                Yii::$app->session->setFlash('error', 'NOT Saved.');
                return $this->render('update', ['model' => $model,]);
            }
        }

        return $this->render('update', ['model' => $model,]);
    }

    
    public function actionSubmit($id){
        $model = $this->findModel($id);
        if($model==null){
            throw new NotFoundHttpException();
        }else{
            //$userid=Yii::$app->user->identity->username;
            $applicationid=$model->application_id;
            $application = MgfApplication::findOne($applicationid);
            $application->application_status='Submitted';
            $application->date_submitted=date('Y-m-d H:i:s');
            $application->save();
            
            $model->date_submitted=$application->date_submitted;
            $model->save();

            $approval=new MgfApproval();
            $approval->application_id=$applicationid;
            $approval->conceptnote_id=$id;

            if ($approval->save()) {
                Yii::$app->session->setFlash('success', 'Submitted successfully.');
                return $this->redirect(['/mgf-applicant/profile']);
            }
        }
    }

    public function actionCancel($id){
        //$userid=Yii::$app->user->identity->username;
        $model = $this->findModel($id);
        $applicationid=$model->application_id;
        $application = MgfApplication::find()->where(['id'=>$applicationid,'application_status'=>'Submitted'])->one();
        $application->application_status='Cancelled';
        //$application->is_active=0;
        $application->date_submitted=NULL;
        if(MgfApplication::find()->where(['id'=>$applicationid,'application_status'=>'Submitted'])->exists()){
            $application->save();
            $model->date_submitted=$application->date_submitted;

            if($model->save()){
                $approval = MgfApproval::find()->where(['application_id'=>$applicationid,'conceptnote_id'=>$id])->one();
                $approval->delete();
                Yii::$app->session->setFlash('success', 'Cancelled successfully.');
                return $this->redirect(['/mgf-applicant/profile']);
            }
        }else{
            Yii::$app->session->setFlash('error', 'This Record Cannot be Cancelled at this moment.');
            return $this->redirect(['/mgf-applicant/profile']);
        }
    }


    /**
     * Deletes an existing MgfConceptNote model.
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
     * Finds the MgfConceptNote model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MgfConceptNote the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MgfConceptNote::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
