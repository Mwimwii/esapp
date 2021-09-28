<?php

namespace backend\controllers;
use Yii;
use backend\models\MgfOrganisation;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use backend\models\MgfApplicant;
use backend\models\MgfApplication;
use backend\models\MgfAttachements;
use backend\models\MgfConceptNote;
use backend\models\MgfContact;
use backend\models\MgfScreening;
use backend\models\MgfApproval;
use backend\models\MgfApprovalStatus;
use backend\models\MgfDistrictEligibility;
use backend\models\MgfOrganisationSearch;
use backend\models\MgfPcoEligibility;
use backend\models\MgfProvinceEligibility;
use frontend\models\MgfEligibility;
use frontend\models\MgfEligibilityApproval;
use yii\web\UploadedFile;
use kartik\mpdf\Pdf;
use backend\models\AuditTrail;
use backend\models\MgfProposal;

/**
 * MgfOrganisationController implements the CRUD actions for MgfOrganisation model.
 */

class MgfOrganisationController extends Controller{
    /**
     * {@inheritdoc}
     */
    public function behaviors(){
        return [
            'access'=>[
                'class'=>AccessControl::className(),
                'only'=>['create','update','index','view'],
                'rules'=>[
                    [
                        'allow'=>true,
                        'roles'=>['@']
                    ],
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all MgfOrganisation models.
     * @return mixed
     */
    public function actionIndex(){        
        $searchModel = new MgfOrganisationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionApplications($status){
        $searchModel = new MgfOrganisationSearch();
        if ($status==1) {
            $dataProvider = $searchModel->searchApplicationsWindow1(Yii::$app->request->queryParams);
        }elseif($status==2){
            $dataProvider = $searchModel->searchApplicationsWindow2(Yii::$app->request->queryParams);
        }else{
            $dataProvider = $searchModel->searchApplications(Yii::$app->request->queryParams);
        }
        return $this->render('applications', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'status' => $status,
        ]);
    }
    


    public function actionApplications2($status){
        $searchModel = new MgfOrganisationSearch();
        if ($status==1) {
            $dataProvider = $searchModel->searchApplicationsAccepted1(Yii::$app->request->queryParams);
        }elseif($status==2){
            $dataProvider = $searchModel->searchApplicationsAccepted2(Yii::$app->request->queryParams);
        }else{
            $dataProvider = $searchModel->searchApplicationsAccepted(Yii::$app->request->queryParams);
        }
        return $this->render('accepted', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'status' => $status,
        ]);
    }


    public function actionApplications_2($status){
        $searchModel = new MgfOrganisationSearch();
        if ($status==1) {
            $dataProvider = $searchModel->searchApplicationsRejected1(Yii::$app->request->queryParams);
        }elseif($status==2){
            $dataProvider = $searchModel->searchApplicationsRejected2(Yii::$app->request->queryParams);
        }else{
            $dataProvider = $searchModel->searchApplicationsRejected(Yii::$app->request->queryParams);
        }
        return $this->render('rejected', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'status' => $status,
        ]);
    }



    public function actionApplications3($status){
        $searchModel = new MgfOrganisationSearch();
        if ($status==1) {
            $dataProvider = $searchModel->searchApplicationsCertified1(Yii::$app->request->queryParams);
        }elseif($status==2){
            $dataProvider = $searchModel->searchApplicationsCertified2(Yii::$app->request->queryParams);
        }else{
            $dataProvider = $searchModel->searchApplicationsCertified(Yii::$app->request->queryParams);
        }
        return $this->render('certified', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'status' => $status,
        ]);
    }


    public function actionApplications_3($status){
        $searchModel = new MgfOrganisationSearch();
        if ($status==1) {
            $dataProvider = $searchModel->searchApplicationsUncertified1(Yii::$app->request->queryParams);
        }elseif($status==2){
            $dataProvider = $searchModel->searchApplicationsUncertified2(Yii::$app->request->queryParams);
        }else{
            $dataProvider = $searchModel->searchApplicationsUncertified(Yii::$app->request->queryParams);
        }
        return $this->render('rejected', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'status' => $status,
        ]);
    }

    public function actionSentback($status){
        $searchModel = new MgfOrganisationSearch();
        if ($status==1) {
            $dataProvider = $searchModel->searchSentBack1(Yii::$app->request->queryParams);
        }elseif($status==2){
            $dataProvider = $searchModel->searchSentBack2(Yii::$app->request->queryParams);
        }else{
            $dataProvider = $searchModel->searchSentBack(Yii::$app->request->queryParams);
        }
        return $this->render('rejected', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'status' => $status,
        ]);
    }


    


    /**
     * Displays a single MgfOrganisation model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id){
        $userid=Yii::$app->user->identity->id;
        //$model = $this->findModel($id);
        $documents=MgfAttachements::find()->where(['organisation_id'=>$id])->all();
        $concepts=MgfConceptNote::find()->where(['organisation_id'=>$id])->all();
        $screening=MgfScreening::find()->where(['organisation_id'=>$id])->all();   
        $contacts=MgfContact::find()->joinWith('position')->where(['organisation_id'=>$id])->all(); 
        $applicant=MgfApplicant::find()->where(['user_id'=>$userid])->one(); 
        //$id=getOrganisationID(); 
        return $this->render('view', ['model' => $this->findModel($id),'documents'=>$documents,'criteria'=>$screening,'concepts'=>$concepts,'contacts'=>$contacts,'applicant'=>$applicant]);
    }

    public function actionOpen($id){
        $model = $this->findModel($id);
        $application=MgfApplication::findOne(['organisation_id'=>$id,'is_active'=>1]);
        $applicationid=$application->id;
        $documents=MgfAttachements::find()->where(['application_id'=>$applicationid])->all();
        $screening=MgfEligibility::find()->where(['application_id'=>$applicationid])->all();
        $unmarked=MgfEligibility::find()->where(['organisation_id'=>$id,'application_id'=>$applicationid,'satisfactory'=>null])->count();
        $approval=MgfEligibilityApproval::findOne(['application_id'=>$applicationid]);        
        $accepted=MgfApprovalStatus::findOne(['approval_status'=>'Accepted']);
        $application_status=$application->application_status;
        if (boolval($unmarked)==false) {
            if ($approval->scores>=$accepted->lowerlimit) {
                $application_status="Accepted";
            } else {
                $application_status="Rejected";
            }
        }
        return $this->render('application', ['model' => $this->findModel($id),
        'documents'=>$documents,'criteria'=>$screening,'unmarked'=>$unmarked,'approval'=>$approval,
        'application_status'=>$application_status,'applicationid'=>$applicationid,'status'=>0]);
    }


    public function actionAddcomment($applicationid,$comment,$score){
        $userid=Yii::$app->user->identity->id;
        MgfEligibilityApproval::updateAll(['review_remark'=>$comment,'review_submission'=>date('Y-m-d H:i:s'),'reviewed_by'=>$userid], 'application_id='.$applicationid);
        $application=MgfApplication::findOne($applicationid);
        $organisation=MgfOrganisation::findOne($application->organisation_id);
        if ($score==100) {
            MgfApplication::updateAll(['application_status'=>"Compliant"], 'id='.$applicationid);
            if (MgfProposal::find()->where(['organisation_id'=>$organisation->id,'is_concept'=>1,'is_active'=>1])->exists()) {
                $proposal=MgfProposal::findOne(['organisation_id'=>$organisation->id,'is_concept'=>1,'is_active'=>1]);
                MgfProposal::updateAll(['proposal_status'=>"Submitted"], 'id='.$proposal->id);
            }
        } else {
            MgfApplication::updateAll(['application_status'=>"Non-Compliant"], 'id='.$applicationid);
            
            if (MgfProposal::find()->where(['organisation_id'=>$organisation->id,'is_concept'=>1,'is_active'=>1])->exists()) {
                $proposal=MgfProposal::findOne(['organisation_id'=>$organisation->id,'is_concept'=>1,'is_active'=>1]);
                MgfProposal::updateAll(['proposal_status'=>"Not-Eligible"], 'id='.$proposal->id);
            }
        }
            Yii::$app->session->setFlash('success', 'Saved successfully.');
            return $this->redirect(['mgf-organisation/applications','status' => 0]);
    }


    public function actionAddcomment2($applicationid,$comment){
        $userid=Yii::$app->user->identity->id;
        MgfEligibilityApproval::updateAll(['certify_remark'=>$comment,'certify_submission'=>date('Y-m-d H:i:s'),'certified_by'=>$userid], 'application_id='.$applicationid);
        $approval=MgfEligibilityApproval::findOne(['application_id'=>$applicationid]);
        if($approval->scores==100){
            MgfApplication::updateAll(['application_status'=>"Confirmed"], 'id='.$applicationid); 
        }else{
            MgfApplication::updateAll(['application_status'=>"Not-Confirmed"], 'id='.$applicationid); 

        }
        
        Yii::$app->session->setFlash('success', 'Saved successfully.');
        return $this->redirect(['mgf-organisation/applications2','status' => 0]);
    }


    public function actionAddcomment22($applicationid,$comment){
        $userid=Yii::$app->user->identity->id;
        MgfEligibilityApproval::updateAll(['certify_remark'=>$comment,'certify_submission'=>date('Y-m-d H:i:s'),'certified_by'=>$userid], 'application_id='.$applicationid);
        MgfApplication::updateAll(['application_status'=>"Sent-Back"], 'id='.$applicationid); 
        Yii::$app->session->setFlash('success', 'Saved successfully.');
        return $this->redirect(['mgf-organisation/applications_2','status' => 0]);
    }


    public function actionAddcomment3($applicationid,$comment){
        $userid=Yii::$app->user->identity->id;
        MgfEligibilityApproval::updateAll(['approval_remark'=>$comment,'approve_submittion'=>date('Y-m-d H:i:s'),'approved_by'=>$userid], 'application_id='.$applicationid);
        $approval=MgfEligibilityApproval::findOne(['application_id'=>$applicationid]);
        if($approval->scores==100){
            MgfApplication::updateAll(['application_status'=>"Approved"], 'id='.$applicationid); 
        }else{
            MgfApplication::updateAll(['application_status'=>"Not-Approved"], 'id='.$applicationid); 
        }
        Yii::$app->session->setFlash('success', 'Saved successfully.');
        return $this->redirect(['mgf-organisation/applications3','status' => 0]);
    }

    public function actionAddcomment33($applicationid,$comment){
        $userid=Yii::$app->user->identity->id;
        MgfEligibilityApproval::updateAll(['approval_remark'=>$comment,'approve_submittion'=>date('Y-m-d H:i:s'),'approved_by'=>$userid], 'application_id='.$applicationid);
        MgfApplication::updateAll(['application_status'=>"Sent-Back"], 'id='.$applicationid); 
        Yii::$app->session->setFlash('success', 'Saved successfully.');
        return $this->redirect(['mgf-organisation/applications3','status' => 0]);
    }


    public function actionVerify($id){
        $model = $this->findModel($id);
        $application=MgfApplication::find()->where(['organisation_id'=>$id,'application_status'=>'Certified','is_active'=>1])->one();
        $applicationid=$application->id;
        $documents=MgfAttachements::find()->where(['organisation_id'=>$id,'application_id'=>$applicationid])->one();
        $concept=MgfConceptNote::find()->where(['organisation_id'=>$id,'application_id'=>$applicationid])->one();
        $conceptid=$concept->id;
        $screening=MgfScreening::find()->where(['organisation_id'=>$id,'conceptnote_id'=>$conceptid])->all();
        $unmarked=MgfScreening::find()->where(['organisation_id'=>$id,'conceptnote_id'=>$conceptid,'satisfactory'=>null])->count();
        $approval=MgfApproval::find()->where(['conceptnote_id'=>$conceptid,'application_id'=>$applicationid])->one();
        //$id=getOrganisationID();
        $application_status=$application->application_status;
                return $this->render('application', ['model' => $this->findModel($id),'document'=>$documents,
                                            'criteria'=>$screening,'concept'=>$concept,'unmarked'=>$unmarked,
                                            'approval'=>$approval,'application_status'=>$application_status,
                                            'applicationid'=>$applicationid,'status'=>2]);
    }

    

    /**
     * Updates an existing MgfOrganisation model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id){
        //$id=getOrganisationID();
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Saved successfully.');
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }



    public function actionDistrictMinutes($id){
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
            $model->minutes=UploadedFile::getInstance($model,'minutes');
            $image_mminutes=$model->minutes;
            $path='uploads/documents/'.$model->id.'_Minutes'.rand(1,4000).'_'.$image_mminutes;
            $model->minutes->saveAs($path);
            $model->minutes=$path;

            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Saved successfully.');
            }else{
                Yii::$app->session->setFlash('error', 'File NOT Saved!');
            }
            return $this->redirect(['applications', 'status' => 0]);
        }

        return $this->render('upload1', [
            'model' => $model,
        ]);
    }

    public function actionProvinceMinutes($id){
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
            $model->minutes=UploadedFile::getInstance($model,'minutes');
            $image_mminutes=$model->minutes;
            $path='uploads/documents/'.$model->id.'_Minutes'.rand(1,4000).'_'.$image_mminutes;
            $model->minutes->saveAs($path);
            $model->minutes=$path;

            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Saved successfully.');
            }else{
                Yii::$app->session->setFlash('error', 'File NOT Saved!');
            }
            return $this->redirect(['applications', 'status' => 0]);
        }

        return $this->render('upload2', [
            'model' => $model,
        ]);
    }


    public function actionPcoMinutes($id){
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
            $model->minutes=UploadedFile::getInstance($model,'minutes');
            $image_mminutes=$model->minutes;
            $path='uploads/documents/'.$model->id.'_Minutes'.rand(1,4000).'_'.$image_mminutes;
            $model->minutes->saveAs($path);
            $model->minutes=$path;

            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Saved successfully.');
            }else{
                Yii::$app->session->setFlash('error', 'File NOT Saved!');
            }
            return $this->redirect(['applications', 'status' => 0]);
        }

        return $this->render('upload3', [
            'model' => $model,
        ]);
    }


    public function actionDownloadAppendixOne($id) {
        $model = $this->findModel($id);
        $filename = "Appendix-1" . date("Ymdhis") . ".pdf";
        $ath = new AuditTrail();
        $ath->user = Yii::$app->user->id;
        $ath->action = "Downloaded Appendix 1: Application for Participation in the E-SAPP-MGF";
        $ath->ip_address = Yii::$app->request->getUserIP();
        $ath->user_agent = Yii::$app->request->getUserAgent();
        $ath->save();
        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        $pdf = new Pdf([
            'mode' => Pdf::MODE_CORE,
            // A4 paper format
            'format' => Pdf::FORMAT_A4,
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
            'content' => $this->renderPartial('eligibility-appendix-1', []),
            'options' => [
                'text_input_as_HTML' => true,
            // any mpdf options you wish to set
            ],
            'methods' => [
                'SetTitle' => 'Appendix 1: Application for Participation',
                'SetHeader' => ['MOA/ESAPP-MGF Appendix 1: Application for Participation ||' . date("r") . "/ESAPP online system"],
                'SetFooter' => ['|Page {PAGENO}|'],
                'SetAuthor' => 'ESAPP online system',
            ]
        ]);
        $pdf->filename = $filename;
        return $pdf->render();
    }




    /**
     * Finds the MgfOrganisation model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MgfOrganisation the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id){
        if (($model = MgfOrganisation::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
