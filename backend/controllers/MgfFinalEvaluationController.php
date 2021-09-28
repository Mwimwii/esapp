<?php

namespace backend\controllers;

use backend\models\MgfApplicant;
use Yii;
use backend\models\MgfFinalEvaluation;
use backend\models\MgfFinalEvaluationSearch;
use backend\models\MgfOffer;
use backend\models\MgfProjectEvaluation;
use backend\models\MgfProposal;
use backend\models\MgfSelectionCategory;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MgfFinalEvaluationController implements the CRUD actions for MgfFinalEvaluation model.
 */
class MgfFinalEvaluationController extends Controller
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
     * Lists all MgfFinalEvaluation models.
     * @return mixed
     */
    public function actionIndex($status){
        $searchModel = new MgfFinalEvaluationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionEvaluations($status){
        if ($status==1) {
            $searchModel = new MgfFinalEvaluationSearch(['status'=>1]);
        } elseif ($status==2) {
            $searchModel = new MgfFinalEvaluationSearch(['status'=>2]);
        } elseif ($status==3) {
            $searchModel = new MgfFinalEvaluationSearch(['status'=>3]);
        } elseif ($status==4) {
            $searchModel = new MgfFinalEvaluationSearch(['status'=>4]);
        }else{
            $searchModel = new MgfFinalEvaluationSearch();
        }
        
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('evaluations', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MgfFinalEvaluation model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id){
        $model = $this->findModel($id);
        $categories=MgfSelectionCategory::find()->all();
        $reviewers=MgfProjectEvaluation::find()->joinWith('reviewedby0')->where(['proposal_id'=>$model->proposal_id])->all();
        return $this->render('view', ['model' => $this->findModel($id),'categories'=>$categories,'reviewers'=>$reviewers]);
    }

    /**
     * Creates a new MgfFinalEvaluation model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionNotify($id){
        $model = $this->findModel($id);
        if ($model->status==4){
            if ($model->load(Yii::$app->request->post())) {
               $this->proposal_deferred($model);
            }
            return $this->render('notify', ['model' => $model]);
            
        }elseif($model->status==1 || $model->status==2){
            $this->proposal_recommend($model);
        }else{
            if ($model->load(Yii::$app->request->post())) {
                $this->proposal_rejected($model);
             }
             return $this->render('notify', ['model' => $model]);
        }
        
        return $this->redirect(['evaluations', 'status' => $model->status]);
    }


    public function proposal_recommend($model){
        MgfProposal::updateAll(['proposal_status'=>$model->decision,'is_active'=>0],'id='.$model->proposal_id);
        $userid=Yii::$app->user->identity->id;
        $fname=Yii::$app->user->identity->first_name;
        $lname=Yii::$app->user->identity->last_name;
        $name=$fname.' '.$lname;
        $applicant=MgfApplicant::find()->where(['organisation_id'=>$model->organisation_id])->one();
        $recipient=$applicant->first_name.' '.$applicant->last_name;
        $organisation=$model->organisation->cooperative;
        $datesigned=date("F d, Y", time());
        $amount_offered=200000;
        $contribution=2457;
        $amount_in_words='AMOUNT IN WORDS';
        $contribution_in_words='CONTRIBUTION IN WORDS';
        $mpe=MgfProjectEvaluation::find()->where(['proposal_id'=>$model->proposal_id])->one();
        $window=$mpe->window;
        $project_title=$model->proposal->project_title;
        $message='
        We are pleased to offer '.$organisation.', a matching grant facility in the amount of ZMW '.$amount_offered.' 
        ('.$amount_in_words.') under. The Enhanced Smallholder Agribusiness Promotion Programme (E - SAPP) matching 
        grant facility window '.$window.' Subject to the terms and conditions to be agreed in the Matching Grant 
        Agreement. '.$organisation.' will provide a Matching Contribution of ZMW '.$contribution.'('.$contribution_in_words.').

        The purpose of the matching grant facility and the Matching Contribution is to enable '.$organisation.' to implement 
        activities contained in the project, entitled '.$project_title.' which you submitted to E –SAPP on '.$model->proposal->date_submitted. 
        ' and approved for financing by the Matching Grant Facility Approval Committee on '.$model->date_created;

        'In order to facilitate the implementation of the Project, a one day pre-implementation workshop will be arranged within 
        two weeks of the date this letter. The workshop will discuss key issues of implementation including, inter-alia, grant 
        disbursement conditions and procedures, procurement arrangements, Accounts and Financial management, reporting requirements,
        supervision, monitoring and evaluation. The draft Grant Agreement will also be discussed and agreed. We will advise you shortly 
        of the date and the details of the workshop. We expect however, that key staff who will be involved in the implementation of the
        project will participate in the workshop.
        In the meantime, kindly undertake the following and submit the related document to the address above.
        •	Open a bank account in a commercial bank into which E –SAPP will disburse its funding, and submit the details of the designated 
        Bank Account along with a letter indicating the names and signatures of authorized representatives to operate the account, and also 
        sign the request for disbursements to be submitted by '.$organisation.'
        •	Documentary evidence confirming the availability of matching contribution in a Bank Account.
        •	A certified copy of the '.$organisation.' Board resolution authorizing acceptance of Matching Grant Facility from E – SAPP.

        Please confirm your acceptance of this offer by signing and returning to E- SAPP, the duplicate copy of this offer letter. This offer 
        will lapse after 20 (twenty) working days from the date of this offer letter, unless otherwise agreed in writing.

        We look forward to hearing from you at your earliest convenience.';

                     
                'Yours faithfully,

                For ENHANCED SMALLHOLDER AGRIBUSINESS PROMOTION PROGRAMME

                Programme Coordinator (Name : '.$name.')';


                'Signature _________________________ Date '.$datesigned;


        'We hereby accept this offer of Matching Grant Facility, subject to the terms and conditions to be agreed in the Matching Grant Agreement.';

        'For and on behalf of '.$organisation;
        
        'Authorized Representative; Name :'.$recipient;
        
        'Signature_____________________________________ Date _______________';

        $offer=new MgfOffer();
        $offer->organisation_id=$model->organisation_id;
        $offer->proposal_id=$model->proposal_id;
        $offer->amountoffered=$amount_offered;
        $offer->contribution=$contribution;
        $offer->createdby=$userid;
        $offer->save();
        if(MgfOffer::find()->where(['organisation_id'=>$model->organisation_id,'proposal_id'=>$model->proposal_id])){
            $model->notified=1;
            $model->finalcomment=$message;
            $model->response=$message;
            $model->save();
        }
    }

    public function proposal_rejected($model){
        MgfProposal::updateAll(['proposal_status'=>$model->decision,'is_active'=>0],'id='.$model->proposal_id);
        $userid=Yii::$app->user->identity->id;
        $fname=Yii::$app->user->identity->first_name;
        $lname=Yii::$app->user->identity->last_name;
        $name=$fname.' '.$lname;
        $organisation=$model->organisation->cooperative;
        $datesigned=date("F d, Y", time());
    
        $project_title=$model->proposal->project_title;
        $message='
        We have reviewed the Full Project Proposal ('.$project_title.') Submitted by '.$organisation.' on '.$model->proposal->date_submitted.', 
        and found them inadequate for support at the state they are at the moment. The reasons for rejecting the Proposal are 
        listed below for your consideration and action.'.
	 
        $model->finalcomment.
	
        'Should you so desire, you can make necessary amendments considering the above, and resubmit to District Agricultural 
        Coordination Office as previously. Should you wish to discuss the reasons for rejection, you can visit the PCO at the 
        above address at your convenience.';
                     
        'Yours faithfully,

        For ENHANCED SMALLHOLDER AGRIBUSINESS PROMOTION PROGRAMME

        Programme Coordinator (Name : '.$name.')';


        'Signature _________________________ Date '.$datesigned;

       
        
        $model->notified=1;
        $model->finalcomment=$message;
        $model->response=$message;
        $model->save();
        return $this->redirect(['evaluations', 'status' => $model->status]);
    }

    public function proposal_deferred($model){
        $userid=Yii::$app->user->identity->id;
        MgfProposal::updateAll(['proposal_status'=>$model->decision,'is_active'=>1],'id='.$model->proposal_id);
        $fname=Yii::$app->user->identity->first_name;
        $lname=Yii::$app->user->identity->last_name;
        $name=$fname.' '.$lname;
        
        $organisation=$model->organisation->cooperative;
        $datesigned=date("F d, Y", time());
       
        $project_title=$model->proposal->project_title;
        $message='
        We have reviewed the Full Project Proposal ('.$project_title.') Submitted by '.$organisation.' on '.$model->proposal->date_submitted.', 
        and found that certain issues need to be addressed before a firm decision on the Proposal can be made. The reasons for 
        deferring of the approval of the proposal are listed below for consideration and action.';

        $model->finalcomment;

        'You may amend the proposal considering the above, and resubmit to PCO at the above address for reconsideration. 
        Should you wish to discuss the issues for clarification, you may visit our office at the above address at your convenience.';
                     
            'Yours faithfully,

            For ENHANCED SMALLHOLDER AGRIBUSINESS PROMOTION PROGRAMME

            Programme Coordinator (Name : '.$name.')';

            'Signature _________________________ Date '.$datesigned;

        $model->notified=1;
        $model->save();
        return $this->redirect(['evaluations', 'status' => $model->status]);
    }

    /**
     * Updates an existing MgfFinalEvaluation model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id){
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', ['model' => $model,]);
    }

    /**
     * Deletes an existing MgfFinalEvaluation model.
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
     * Finds the MgfFinalEvaluation model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MgfFinalEvaluation the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MgfFinalEvaluation::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
