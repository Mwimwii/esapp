<?php

namespace frontend\controllers;

use backend\models\MgfApplication;
use backend\models\User;
use common\models\Role;
use Yii;
use frontend\models\MgfProposalSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\MgfComponent;
use frontend\models\MgfProposal;
use frontend\models\MgfApplicant;
use frontend\models\MgfChecklist;
use frontend\models\MgfOffer;
use frontend\models\MgfSelectionCategory;
use frontend\models\MgfProposalEvaluation;
use frontend\models\MgfProjectEvaluation;
use frontend\models\MgfReviewer;
use frontend\models\MgfSelectionCriteria;
use yii\helpers\ArrayHelper;

/**
 * MgfProposalController implements the CRUD actions for MgfProposal model.
 */
class MgfProposalController extends Controller
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
     * Lists all MgfProposal models.
     * @return mixed
     */

    public function actionIndex(){
        $searchModel = new MgfProposalSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionProposals1(){
        $userid=Yii::$app->user->identity->id;
        $submitted=MgfProposal::find()->where(['proposal_status'=>'Submitted','is_active'=>1])->orWhere(['proposal_status'=>'Under_Review','is_active'=>1])->exists();
        $proposals=MgfProposal::find()->where(['proposal_status'=>'Submitted','is_active'=>1])->orWhere(['proposal_status'=>'Under_Review','is_active'=>1])->all();
        if ($submitted) {
            foreach ($proposals as $item) {
                if (MgfProjectEvaluation::find()->where(['proposal_id'=>$item->id,'reviewedby'=>$userid])->exists()) {
                    //Do Nothing
                } else {
                    //Create Reviewers Record
                    $mpe=new MgfProjectEvaluation();
                    $mpe->proposal_id=$item->id;
                    $mpe->reviewedby=$userid;
                    $mpe->organisation_id=$item->organisation_id;
                    $mpe->date_submitted=$item->date_submitted;
                    //$mpe->save();
                }
            }
        }

        $allreviewed=MgfProjectEvaluation::find()->where(['reviewedby'=>$userid,'status'=>0])->exists();
        //$submitted=MgfProposal::find()->where(['proposal_status'=>'Submitted','is_active'=>1])->orWhere(['proposal_status'=>'Under_Review','is_active'=>1])->exists();
        if ($allreviewed) {
            $searchModel = new MgfProposalSearch();
        }else{
            $searchModel = new MgfProposalSearch(['id'=>0]);
        }
    
        $dataProvider = $searchModel->searchProposals(Yii::$app->request->queryParams);
        
        return $this->render('proposals', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionProposals(){
        $searchModel = new MgfProposalSearch();
        $dataProvider = $searchModel->searchProposals(Yii::$app->request->queryParams);
        
        return $this->render('proposals', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MgfProposal model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */

    public function actionView($id){
        $userid=Yii::$app->user->identity->id;
        $components=MgfComponent::find()->where(['proposal_id'=>$id])->all();
        $reviewers=MgfProjectEvaluation::find()->joinWith('reviewedby0')->where(['proposal_id'=>$id,'reviewedby'=>$userid])->andWhere(['NOT',['mgf_project_evaluation.status'=>0]])->all();
        $count=sizeof($reviewers);
        $categories=MgfSelectionCategory::find()->all();
        return $this->render('view', ['model' => $this->findModel($id),'components'=>$components,'categories'=>$categories,'categories'=>$categories,'reviewers'=>$reviewers,'count'=>$count]);
    }


    public function actionReviewers(){
        $reviewers=MgfReviewer::find()->all();
        return $this->render('reviewers',['reviewers'=>$reviewers]);
    }


    public function actionMessage($id){
        $userid=Yii::$app->user->identity->id;
        $response=MgfOffer::find()->where(['proposal_id'=>$id]);
        $components=MgfComponent::find()->where(['proposal_id'=>$id])->all();
        $reviewers=MgfProjectEvaluation::find()->joinWith('reviewedby0')->where(['proposal_id'=>$id,'reviewedby'=>$userid])->andWhere(['NOT',['mgf_project_evaluation.status'=>0]])->all();
        $count=sizeof($reviewers);
        $categories=MgfSelectionCategory::find()->all();
        return $this->render('message', ['model' => $this->findModel($id),'components'=>$components,'categories'=>$categories,'reviewers'=>$reviewers,'count'=>$count]);
    }

    /**
     * Creates a new MgfProposal model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

    public function actionCreate(){
        $model = new MgfProposal();

        if ($model->load(Yii::$app->request->post())) {
            $userid=Yii::$app->user->identity->id;
            $username=Yii::$app->user->identity->username;
            $applicant=MgfApplicant::findOne(['user_id'=>$userid]);
            MgfProposal::updateAll(['is_active' => 0], 'organisation_id='.$applicant->organisation_id);
            $model->organisation_id=$applicant->organisation_id;
            $model->applicant_type=$applicant->applicant_type;
            $model->province_id=$applicant->province_id;
            $model->district_id=$applicant->district_id;
            $model->mgf_no=$username;
            $model->is_active=1;
            if($model->save()){
                $end=date("Y-m-d", strtotime("+".$model->project_length.' years', strtotime($model->starting_date)));
                MgfProposal::updateAll(['ending_date' => $end], 'id='.$model->id);
                MgfChecklist::updateAll(['proposal_created'=>1], 'applicant_id='.$applicant->id);
                Yii::$app->session->setFlash('success', 'Saved successfully.');
                return $this->redirect(['view', 'id' => $model->id]);
            }else{
                Yii::$app->session->setFlash('error', 'NOT Saved');
                return $this->render('create', ['model' => $model,]);
            }
        } return $this->render('create', ['model' => $model,]);
    }

    
    public function actionCreateReviewer(){
        $model = new MgfReviewer();
        if ($model->load(Yii::$app->request->post())) {
            $userid=Yii::$app->user->identity->id;
            $model->user_id=time();
            $model->createdBy=$userid;
            if($model->save()){
                $user=User::findOne(['email'=>$model->email]);
                MgfReviewer::updateAll(['user_id' => $user->id], 'id='.$model->id);
                $password = Yii::$app->getSecurity()->generatePasswordHash($model->mobile);
                $auth=Yii::$app->security->generateRandomString();
                $verify=Yii::$app->security->generateRandomString().'_'.time();
                User::updateAll(['created_at' =>time(),'updated_at'=>time(),'created_by'=>$userid,'auth_key'=>$auth,'password'=>$password,'verification_token'=>$verify], 'id='.$user->id);
                Yii::$app->session->setFlash('success', 'Saved successfully.'.$user->setPassword($user->phone));
                return $this->redirect(['reviewers']);
            }else{
                Yii::$app->session->setFlash('error', 'NOT Saved:');
                return $this->redirect(['reviewers']);
            }
        } return $this->redirect(['reviewers']);
    }


    public function actionUnassigned($id){
        $reviewer=MgfReviewer::findOne($id);
        $assinged = ArrayHelper::getColumn(MgfProjectEvaluation::find()->where(['reviewedby'=>$reviewer->user_id])->select(['proposal_id'])->asArray()->all(),'proposal_id');
        $submitted=MgfProposal::find()->where(['NOT IN','id',$assinged])->andWhere(['proposal_status'=>'Submitted','project_operations'=>$reviewer->area_of_expertise])->andWhere(['NOT',['number_reviewers'=>4]])->all();
        return $this->render('unassigned',['submitted'=>$submitted,'reviewer'=>$reviewer,'assigned'=>'NO']);
    }


    public function actionAssigned($id){
        $reviewer=MgfReviewer::findOne($id);
        $assinged = MgfProjectEvaluation::find()->where(['reviewedby'=>$reviewer->user_id])->all();
        return $this->render('unassigned',['assignedto'=>$assinged,'reviewer'=>$reviewer,'assigned'=>'YES']);
    }


    /**
     * Updates an existing MgfProposal model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */

    public function actionUpdate($id){
        $model = $this->findModel($id);
        $applicant=MgfApplicant::findOne(['organisation_id'=>$model->organisation_id]);
        if ($model->load(Yii::$app->request->post())) {
            $submitted=MgfProposal::find()->where(['proposal_status'=>'Submitted','organisation_id'=>$model->organisation_id])->orWhere(['proposal_status'=>'Under_Review','organisation_id'=>$model->organisation_id])->exists();
            $applicant=MgfApplicant::find()->where(['organisation_id'=>$model->organisation_id])->one();
            $model->applicant_type=$applicant->applicant_type;
            $model->proposal_status="Updated";
            $model->is_active=1;
            if($model->save()){
                MgfProposal::updateAll(['is_active' => 0], 'id!='.$model->id);
                $end=date("Y-m-d", strtotime("+".$model->project_length.' years', strtotime($model->starting_date)));
                MgfProposal::updateAll(['ending_date' => $end], 'id='.$model->id);
                MgfChecklist::updateAll(['proposal_created'=>1], 'applicant_id='.$applicant->id);
                Yii::$app->session->setFlash('success', 'Saved successfully.');
                return $this->redirect(['view', 'id' => $model->id]);
            }else{
                Yii::$app->session->setFlash('error', 'NOT Saved');
                return $this->render('update', ['model' => $model,'applicant'=>$applicant]);
            }
            return $this->redirect(['/mgf-applicant/profile']);
        }
        return $this->render('update', ['model' => $model,'applicant'=>$applicant]);
    }


    public function actionProjectDetails($id){
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
            $submitted=MgfProposal::find()->where(['proposal_status'=>'Submitted','organisation_id'=>$model->organisation_id])->orWhere(['proposal_status'=>'Under_Review','organisation_id'=>$model->organisation_id])->exists();
            $applicant=MgfApplicant::find()->where(['organisation_id'=>$model->organisation_id])->one();
            $model->applicant_type=$applicant->applicant_type;
            $model->proposal_status="Updated";
            $model->is_active=1;
            $model->save();
            MgfProposal::updateAll(['is_active' => 0], 'id!='.$model->id);
            return $this->redirect(['/mgf-applicant/profile']);
        }
        return $this->render('projectdetails', ['model' => $model,]);
    }


    public function actionSubmit($id){
        $model = $this->findModel($id);
        if ($model->proposal_status=="Prepared" || $model->proposal_status=="Cancelled") {
            $model->proposal_status="Submitted";
            $model->date_submitted=date('Y-m-d H:i:s');
            if ($model->save()) {
                $userid=Yii::$app->user->identity->id;
                $applicant=MgfApplicant::findOne(['user_id'=>$userid]);
                #MgfApplication::updateAll(['application_status'=>$model->proposal_status], 'applicant_id='.$applicant->id.' AND is_active=1');
                MgfChecklist::updateAll(['project_submitted'=>1], 'applicant_id='.$applicant->id);
                Yii::$app->session->setFlash('success', 'Submiited successfully.');
            } else {
                Yii::$app->session->setFlash('error', 'Action Fail');
            } 
        }else{
            Yii::$app->session->setFlash('error', 'This Proposal Cannot be Submitted now');
        }return $this->redirect(['/mgf-applicant/profile']);  
    }


    public function actionCancel($id){
        $model = $this->findModel($id);
        $isassigned=boolval(MgfProjectEvaluation::find()->where(['proposal_id'=>$id])->count());
        if ($model->proposal_status=="Submitted" && !$isassigned) {
            $model->proposal_status="Cancelled";
            $model->date_submitted=null;
            if ($model->save()) {
                $userid=Yii::$app->user->identity->id;
                $applicant=MgfApplicant::findOne(['user_id'=>$userid]);
                #MgfApplication::updateAll(['application_status'=>$model->proposal_status], 'applicant_id='.$applicant->id.' AND is_active=1');
                MgfChecklist::updateAll(['project_submitted'=>0], 'applicant_id='.$applicant->id);
                Yii::$app->session->setFlash('success', 'Cancelled successfully.');
            } else {
                Yii::$app->session->setFlash('error', 'Action Fail');
            }
        }else{
            Yii::$app->session->setFlash('error', 'This Proposal Cannot be Cancelled now');
        }return $this->redirect(['/mgf-applicant/profile']);  
    }


    public function actionAssignProposals($id){
        $reviewer=MgfReviewer::findOne($id);
        foreach ($_POST["proposals"] as $prop) {
            $proposal=MgfProposal::findOne($prop);
            $proposal->number_reviewers=0;
            if ($proposal->save()) {
                if (!MgfProjectEvaluation::find()->where(['proposal_id'=>$prop,'reviewedby'=>$reviewer->user_id])->exists()) {
                    //Create Reviewers Record
                    if($proposal->applicant_type=="Category-A"){
                        $window='1';
                    }else{
                        $window='2';
                    }
                    $mpe=new MgfProjectEvaluation();
                    $mpe->proposal_id=$prop;
                    $mpe->window=$window;
                    $mpe->reviewedby=$reviewer->user_id;
                    $mpe->organisation_id=$proposal->organisation_id;
                    $mpe->date_submitted=$proposal->date_submitted;
                    if($mpe->save()){
                        $proposalcount=MgfProjectEvaluation::find()->where(['proposal_id'=>$prop])->count();
                        //$proposal->number_reviewers=$proposalcount;
                        //$proposal->save();
                        MgfProposal::updateAll(['number_reviewers' => $proposalcount], 'id='.$prop);
                    }
                }
            }
        }

        if (boolval(sizeof($_POST["proposals"]))) {
            $reviewer=MgfReviewer::findOne($id);
            $proposalcount_1=MgfProjectEvaluation::find()->where(['reviewedby'=>$reviewer->user_id,'window'=>'1'])->count();
            $proposalcount_2=MgfProjectEvaluation::find()->where(['reviewedby'=>$reviewer->user_id,'window'=>'2'])->count();
            $reviewer->total_assigned_1=$proposalcount_1;
            $reviewer->total_assigned_2=$proposalcount_2;
            $reviewer->save();
            
            Yii::$app->session->setFlash('success', sizeof($_POST["proposals"])." Proposal(s) Assigned Successfully!!");
            return $this->redirect(['/mgf-proposal/unassigned','id'=>$id]);
        } else {
            Yii::$app->session->setFlash('error', 'Action Fail');
            return $this->redirect(['/mgf-proposal/unassigned','id'=>$id]);
        }
        return $this->redirect(['/mgf-proposal/unassigned','id'=>$id]);
    }


    public function actionRemoveProposals1($id){
        $reviewer=MgfReviewer::findOne($id);
        foreach ($_POST["proposals"] as $prop) {
            //Delete Records
            MgfProjectEvaluation::deleteAll(['id'=>$prop,'reviewedby'=>$reviewer->user_id]);
            $mpe=MgfProjectEvaluation::findOne($prop);
            $proposalcount=MgfProjectEvaluation::find()->where(['proposal_id'=>$mpe->proposal_id])->count();
            MgfProposal::updateAll(['number_reviewers' => $proposalcount], 'id='.$mpe->proposal_id);
            
        }

        if (boolval(sizeof($_POST["proposals"]))) {
            $proposalcount_1=MgfProjectEvaluation::find()->where(['reviewedby'=>$reviewer->user_id])->count();
            $proposalcount_2=MgfProjectEvaluation::find()->where(['reviewedby'=>$reviewer->user_id])->count();
            $reviewer->total_assigned_1=$proposalcount_1;
            $reviewer->total_assigned_2=$proposalcount_2;
            $reviewer->save();
            Yii::$app->session->setFlash('success', sizeof($_POST["proposals"])." Proposal(s) Removed from ".$reviewer->first_name.' '.$reviewer->last_name);
            return $this->redirect(['/mgf-proposal/assigned','id'=>$id]);
        } else {
            Yii::$app->session->setFlash('error', 'Action Fail');
            return $this->redirect(['/mgf-proposal/assigned','id'=>$id]);
        }
        return $this->redirect(['/mgf-proposal/assigned','id'=>$id]);
    }


    public function actionRemoveProposals($id){
        $mpe=MgfProjectEvaluation::findOne($id);
        MgfProjectEvaluation::deleteAll(['id'=>$id]);
        $reviewer=MgfReviewer::findOne(['user_id'=>$mpe->reviewedby]);
        $proposalcount=MgfProjectEvaluation::find()->where(['proposal_id'=>$mpe->proposal_id])->count();
        MgfProposal::updateAll(['number_reviewers' => $proposalcount], 'id='.$mpe->proposal_id);     
        $proposalcount_1=MgfProjectEvaluation::find()->where(['reviewedby'=>$reviewer->user_id])->count();
        $proposalcount_2=MgfProjectEvaluation::find()->where(['reviewedby'=>$reviewer->user_id])->count();
        $reviewer->total_assigned_1=$proposalcount_1;
        $reviewer->total_assigned_2=$proposalcount_2;
        if($reviewer->save()){
        Yii::$app->session->setFlash('success', " Proposal Removed from ".$reviewer->first_name.' '.$reviewer->last_name);
        return $this->redirect(['/mgf-proposal/assigned','id'=>$reviewer->id]);
    } else {
            Yii::$app->session->setFlash('error', 'Action Fail');
        }return $this->redirect(['/mgf-proposal/assigned','id'=>$reviewer->id]);
    }



    public function actionDownload(){
        $path = Yii::getAlias('@webroot') . '/files';
        $file=$path . '/document.docx';
        if(file_exists($file)){
            Yii::$app->response->sendFile($file);
        }else{
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    public function ActionSelect(){

        /* get the selected rows */

        $selection = (array)Yii::$app->request->post('selection'); 

        foreach ($selection as $item) {
            Yii::$app->session->setFlash('error', 'Action Fail');
            /* your code to do with the checked rows*/

       }return $this->redirect(['index']);
    }

  
    /** 
     * Finds the MgfProposal model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MgfProposal the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id){
        if (($model = MgfProposal::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
