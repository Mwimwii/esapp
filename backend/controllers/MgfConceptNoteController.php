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
use backend\models\MgfProposal;
use backend\models\MgfScreening;
use frontend\models\MgfChecklist;
use yii\web\UploadedFile;

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

    public function actionView2($id){
        $model = $this->findModel($id);
        $concept=MgfConceptNote::findOne(['application_id'=>$model->application_id]);
        $application=MgfApplication::findOne($model->application_id);
        $screening=MgfScreening::find()->where(['conceptnote_id'=>$id])->all();
        $unmarked=MgfScreening::find()->where(['organisation_id'=>$model->organisation_id,'conceptnote_id'=>$id,'satisfactory'=>null])->count();
        $approval=MgfApproval::find()->where(['conceptnote_id'=>$id,'application_id'=>$application->id])->one();        
        $accepted=MgfApprovalStatus::findOne(['approval_status'=>'Accepted']);
        $application_status=$application->application_status;
        if (boolval($unmarked)==false) {
            if ($approval->scores>=$accepted->lowerlimit) {
                $application_status="Accepted";
            } else {
                $application_status="Rejected";
            }
        }

        return $this->render('view', ['model' => $this->findModel($id),'criteria'=>$screening,'concept'=>$concept,
        'unmarked'=>$unmarked,'approval'=>$approval,'application_status'=>$application_status,'applicationid'=>$application->id,'status'=>0]);
    
    }


    public function actionView($id){
        $model = MgfProposal::findOne($id);

        #$application=MgfApplication::findOne(['organisation_id'=>$model->organisation_id,'application_status'=>'Compliant','is_active'=>1]);
        $application=MgfApplication::findOne(['organisation_id'=>$model->organisation_id,'is_active'=>1]);
        $concept=MgfConceptNote::findOne(['application_id'=>$application->id]);
        $screening=MgfScreening::find()->where(['conceptnote_id'=>$concept->id])->all();
        $unmarked=MgfScreening::find()->where(['organisation_id'=>$model->organisation_id,'conceptnote_id'=>$concept->id,'satisfactory'=>null])->count();
        $approval=MgfApproval::find()->where(['conceptnote_id'=>$concept->id,'application_id'=>$application->id])->one();        
        $accepted=MgfApprovalStatus::findOne(['approval_status'=>'Accepted']);
        $application_status=$application->application_status;
        if (boolval($unmarked)==false) {
            if ($approval->scores>=$accepted->lowerlimit) {
                $application_status="Accepted";
            } else {
                $application_status="Rejected";
            }
        }

        return $this->render('view', ['model' => $concept,'criteria'=>$screening,'concept'=>$concept,
        'unmarked'=>$unmarked,'approval'=>$approval,'application_status'=>$application_status,'applicationid'=>$application->id,'status'=>0]);
    
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

    public function actionAddcomment($applicationid,$comment){
        $userid=Yii::$app->user->identity->id;
        MgfApproval::updateAll(['review_remark'=>$comment,'review_submission'=>date('Y-m-d H:i:s'),'reviewed_by'=>$userid], 'application_id='.$applicationid);
        Yii::$app->session->setFlash('success', 'Saved successfully.');
        //MgfProposal::updateAll(['proposal_status' => ''], 'id='.$model->id);
        return $this->redirect(['index']);
    }


    public function actionAddcomment2($applicationid,$comment){
        $userid=Yii::$app->user->identity->id;
        MgfApproval::updateAll(['certify_remark'=>$comment,'certify_submission'=>date('Y-m-d H:i:s'),'certified_by'=>$userid], 'application_id='.$applicationid);
        Yii::$app->session->setFlash('success', 'Saved successfully.');
        return $this->redirect(['index']);
    }

    public function actionAddcomment22($applicationid,$comment){
        $userid=Yii::$app->user->identity->id;
        MgfApproval::updateAll(['certify_remark'=>$comment,'certify_submission'=>date('Y-m-d H:i:s'),'certified_by'=>$userid], 'application_id='.$applicationid);
        Yii::$app->session->setFlash('success', 'Saved successfully.');
        return $this->redirect(['index']);
    }


    public function actionAddcomment3($applicationid,$comment){
        $userid=Yii::$app->user->identity->id;
        MgfApproval::updateAll(['approval_remark'=>$comment,'approve_submittion'=>date('Y-m-d H:i:s'),'approved_by'=>$userid], 'application_id='.$applicationid);
        Yii::$app->session->setFlash('success', 'Saved successfully.');
        return $this->redirect(['index',]);
    }

    public function actionAddcomment33($applicationid,$comment){
        $userid=Yii::$app->user->identity->id;
        MgfApproval::updateAll(['approval_remark'=>$comment,'approve_submittion'=>date('Y-m-d H:i:s'),'approved_by'=>$userid], 'application_id='.$applicationid);
        Yii::$app->session->setFlash('success', 'Saved successfully.');
        return $this->redirect(['index',]);
    }


    public function actionDistrictMinutes($id){
        $concept = $this->findModel($id);
        $model = MgfApproval::findOne(['conceptnote_id'=>$concept->id,'application_id'=>$concept->application_id]);
        if ($model->load(Yii::$app->request->post())) {
            $model->district_minutes=UploadedFile::getInstance($model,'district_minutes');
            $image_mminutes=$model->district_minutes;
            $path='uploads/documents/'.$model->id.'_Minutes'.rand(1,4000).'_'.$image_mminutes;
            $model->district_minutes->saveAs($path);
            $model->district_minutes=$path;

            if ($model->save()) {
           
                $proposal=MgfProposal::findOne(['organisation_id'=>$concept->organisation_id,'is_active'=>1]);
                if ($model->scores==100) {
                    $proposal->proposal_status="Compliant";
                }else{
                    $proposal->proposal_status="Not-Compliant";
                }
                    $proposal->save();
                
                Yii::$app->session->setFlash('success', 'Saved successfully.');
            }else{
                Yii::$app->session->setFlash('error', 'File NOT Saved!');
            }
            return $this->redirect(['mgf-proposal/submitted-concept-notes']);
        }

        return $this->render('upload1', [
            'model' => $model,
        ]);
    }



    public function actionProvinceMinutes($id){
        $concept = $this->findModel($id);
        $model = MgfApproval::findOne(['conceptnote_id'=>$concept->id,'application_id'=>$concept->application_id]);
        if ($model->load(Yii::$app->request->post())) {
            $model->province_minutes=UploadedFile::getInstance($model,'province_minutes');
            $image_mminutes=$model->province_minutes;
            $path='uploads/documents/'.$model->id.'_Minutes'.rand(1,4000).'_'.$image_mminutes;
            $model->province_minutes->saveAs($path);
            $model->province_minutes=$path;
            if ($model->save()) {
                //MgfApplication::updateAll(['application_status'=>"Confirmed"], 'id='.$concept->application_id);
                $proposal=MgfProposal::findOne(['organisation_id'=>$concept->organisation_id,'is_active'=>1]);
                if ($model->scores==100) {
                    $proposal->proposal_status="Confirmed";
                }else{
                    $proposal->proposal_status="Not-Confirmed";
                }
                    $proposal->save();
                Yii::$app->session->setFlash('success', 'Saved successfully.');
            }else{
                Yii::$app->session->setFlash('error', 'File NOT Saved!');
            }
            return $this->redirect(['mgf-proposal/submitted-concept-notes']);
        }

        return $this->render('upload2', [
            'model' => $model,
        ]);
    }


    public function actionProvinceMinutes2($id){
        $concept = $this->findModel($id);
        $model = MgfApproval::findOne(['conceptnote_id'=>$concept->id,'application_id'=>$concept->application_id]);
        if ($model->load(Yii::$app->request->post())) {
            $model->province_minutes=UploadedFile::getInstance($model,'province_minutes');
            $image_mminutes=$model->province_minutes;
            $path='uploads/documents/'.$model->id.'_Minutes'.rand(1,4000).'_'.$image_mminutes;
            $model->province_minutes->saveAs($path);
            $model->province_minutes=$path;

            if ($model->save()) {
                //MgfApplication::updateAll(['application_status'=>"Sent-Back"], 'id='.$concept->application_id); 
                $proposal=MgfProposal::findOne(['organisation_id'=>$concept->organisation_id,'is_active'=>1]);
                $proposal->proposal_status="Sent-Back";
                $proposal->save();
                Yii::$app->session->setFlash('success', 'Saved successfully.');
            }else{
                Yii::$app->session->setFlash('error', 'File NOT Saved!');
            }
            return $this->redirect(['mgf-proposal/submitted-concept-notes']);
        }

        return $this->render('upload_2', [
            'model' => $model,
        ]);
    }


    public function actionPcoMinutes($id){ 
        $concept = $this->findModel($id);
        $model = MgfApproval::findOne(['conceptnote_id'=>$concept->id,'application_id'=>$concept->application_id]);
        if ($model->load(Yii::$app->request->post())) {
            $model->pco_minutes=UploadedFile::getInstance($model,'pco_minutes');
            $image_mminutes=$model->pco_minutes;
            $path='uploads/documents/'.$model->id.'_Minutes'.rand(1,4000).'_'.$image_mminutes;
            $model->pco_minutes->saveAs($path);
            $model->pco_minutes=$path;

            if ($model->save()) {
                //MgfApplication::updateAll(['application_status'=>"Approved"], 'id='.$concept->application_id); 
                $proposal=MgfProposal::findOne(['organisation_id'=>$concept->organisation_id,'is_active'=>1]);
                if ($model->scores==100) {
                    $proposal->proposal_status="Accepted";
                    $proposal->is_concept=0;
                    $application=MgfApplication::findOne($concept->application_id);
                    MgfChecklist::updateAll(['proposal_created'=>1],'applicant_id='.$application->applicant_id);
                }else{
                    $proposal->proposal_status="Not-Approved";
                }
                    $proposal->save();
                
                Yii::$app->session->setFlash('success', 'Saved successfully.');
            }else{
                Yii::$app->session->setFlash('error', 'File NOT Saved!');
            }
            return $this->redirect(['mgf-proposal/submitted-concept-notes']);
        }

        return $this->render('upload3', [
            'model' => $model,
        ]);
    }


    public function actionPcoMinutes2($id){ 
        $concept = $this->findModel($id);
        $model = MgfApproval::findOne(['conceptnote_id'=>$concept->id,'application_id'=>$concept->application_id]);
        if ($model->load(Yii::$app->request->post())) {
            $model->pco_minutes=UploadedFile::getInstance($model,'pco_minutes');
            $image_mminutes=$model->pco_minutes;
            $path='uploads/documents/'.$model->id.'_Minutes'.rand(1,4000).'_'.$image_mminutes;
            $model->pco_minutes->saveAs($path);
            $model->pco_minutes=$path;

            if ($model->save()) {
                //MgfApplication::updateAll(['application_status'=>"Sent-Back"], 'id='.$concept->application_id); 
                $proposal=MgfProposal::findOne(['organisation_id'=>$concept->organisation_id,'is_active'=>1]);
                $proposal->proposal_status="Sent-Back";
                $proposal->save();
                Yii::$app->session->setFlash('success', 'Saved successfully.');
            }else{
                Yii::$app->session->setFlash('error', 'File NOT Saved!');
            }
            return $this->redirect(['mgf-proposal/submitted-concept-notes']);
        }

        return $this->render('upload_3', [
            'model' => $model,
        ]);
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
