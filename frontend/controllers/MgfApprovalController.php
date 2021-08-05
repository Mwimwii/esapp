<?php

namespace frontend\controllers;
use Yii;
use frontend\models\MgfApproval;
use frontend\models\MgfApprovalSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\MgfApplicant;
use frontend\models\MgfApplication;
use frontend\models\MgfApprovalStatus;
use frontend\models\MgfConceptNote;
use frontend\models\MgfOrganisation;
use frontend\models\MgfProposal;
/**
 * MgfApprovalController implements the CRUD actions for MgfApproval model.
 */
class MgfApprovalController extends Controller
{
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
     * Lists all MgfApproval models.
     * @return mixed
     */
    public function actionIndex()
{
        $searchModel = new MgfApprovalSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MgfApproval model.
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
     * Updates an existing MgfApproval model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionReview($id){
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->save();
            $scores=$model->scores;
            $rejected=MgfApprovalStatus::find()->where(['approval_status'=>'Rejected'])->one();
            $applicationid=$model->application_id;
            $application=MgfApplication::findOne($applicationid);
            if ($scores<=$rejected->upperlimit) {
                $application->application_status="Rejected";
                $finalcomment="Comments For Rejection";
            } else {
                $application->application_status="On-Hold";
                $finalcomment="Comments For Putting On-Hold";
            }$application->save();
            return $this->redirect(['mgf-organisation/applications','status'=>0]);
        }

        return $this->render('review', ['model' => $model,]);
    }


    public function actionAccept($id){
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
            $applicationid=$model->application_id;
            $application=MgfApplication::findOne($applicationid);
            if ($model->save()) {
                $applicationid=$model->application_id;
                $application=MgfApplication::findOne($applicationid);
                $username=Yii::$app->user->identity->username;
                $applicationid=$model->application_id;
                $application->application_status='Accepted';
                $model->review_submission=date('Y-m-d H:i:s');
                $model->reviewed_by=$username;
                if ($application->save()) {
                    Yii::$app->session->setFlash('success', 'Certified successfully.');
                    return $this->redirect(['mgf-organisation/applications','status'=>0]);
                }
            }else{
                Yii::$app->session->setFlash('error', 'NOT Certified!.');
                return $this->redirect(['mgf-organisation/manage','id'=>$application->organisation_id]);
            }
        }  
    }


    public function actionCertify($id){
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
            $applicationid=$model->application_id;
            $application=MgfApplication::findOne($applicationid);
            if ($model->save()) {
                $applicationid=$model->application_id;
                $application=MgfApplication::findOne($applicationid);
                $application->application_status="Certified";
                $username=Yii::$app->user->identity->username;
                $applicationid=$model->application_id;
                $model->review_submission=date('Y-m-d H:i:s');
                $model->reviewed_by=$username;
                if ($application->save()) {
                    Yii::$app->session->setFlash('success', 'Certified successfully.');
                    return $this->redirect(['mgf-organisation/applications','status'=>1]);
                }
            }else{
                Yii::$app->session->setFlash('error', 'NOT Certified!.');
                return $this->redirect(['mgf-organisation/manage','id'=>$application->organisation_id]);
            }
        }  
    }



    public function actionApprove($id){
        $model = $this->findModel($id);
        if($model==null){
            throw new NotFoundHttpException();
        }else{
            $username=Yii::$app->user->identity->username;
            $applicationid=$model->application_id;
            $coneptnoteid=$model->conceptnote_id;
            $model->approve_submittion=date('Y-m-d H:i:s');
            $model->approved_by=$username;

            $application=MgfApplication::findOne($applicationid);
            $organisationid=$application->organisation_id;
            $application->application_status="Approved";
            
            if($model->save() && $application->save()){
                
                $applicant=MgfApplicant::findOne($application->applicant_id);
                $coneptnote=MgfConceptNote::findOne($coneptnoteid);
                $organisation=MgfOrganisation::findOne($organisationid);
    
                $proposalexists=MgfProposal::find()->where(['organisation_id'=>$organisationid,'proposal_status'=>'Created','province_id'=>$applicant->province_id,'district_id'=>$applicant->district_id,'is_active'=>0])->exists();
                MgfProposal::updateAll(['is_active' => 0], 'organisation_id='.$organisationid);
                if ($proposalexists==False) {
                    $newproposal=new MgfProposal();
                    $end=date("Y-m-d", strtotime("+".$coneptnote->implimentation_period.' years', strtotime($coneptnote->starting_date)));
                    $newproposal->mgf_no=''.time();
                    $newproposal->starting_date=$coneptnote->starting_date;
                    $newproposal->ending_date=$end;
                    $newproposal->project_length=$coneptnote->implimentation_period;
                    $newproposal->project_operations=$coneptnote->operation->operation_type;
                    $newproposal->totalcost=$coneptnote->estimated_cost;
                    $newproposal->project_title=$coneptnote->project_title;
                    $newproposal->applicant_type=$applicant->applicant_type;
                    $newproposal->is_active=1;
                    $newproposal->organisation_id=$organisation->id;
                    $newproposal->province_id=$organisation->province_id;
                    $newproposal->district_id=$organisation->district_id;
                    if($newproposal->save()){
                        Yii::$app->session->setFlash('success', 'Approved successfully.');
                        return $this->redirect(['mgf-organisation/applications','status'=>2]);
                    }
                }else{
                    $proposal=MgfProposal::find()->where(['organisation_id'=>$organisationid,'proposal_status'=>'Created','province_id'=>$applicant->province_id,'district_id'=>$applicant->district_id,'is_active'=>0])->one();
                    $end=date("Y-m-d", strtotime("+".$coneptnote->implimentation_period.' years', strtotime($coneptnote->starting_date)));
                    $proposal->mgf_no=''.time();
                    $proposal->starting_date=$coneptnote->starting_date;
                    $proposal->ending_date=$end;
                    $proposal->project_length=$coneptnote->implimentation_period;
                    $proposal->project_operations=$coneptnote->operation->operation_type;
                    $proposal->totalcost=$coneptnote->estimated_cost;
                    $proposal->project_title=$coneptnote->project_title;
                    $proposal->applicant_type=$applicant->applicant_type;
                    $proposal->is_active=1;
                    $proposal->organisation_id=$organisation->id;
                    $proposal->province_id=$organisation->province_id;
                    $proposal->district_id=$organisation->district_id;
                    if($proposal->save()){
                        Yii::$app->session->setFlash('success', 'Approved successfully.');
                        return $this->redirect(['mgf-organisation/applications','status'=>2]);
                    }
                }
                
            }else{
                Yii::$app->session->setFlash('error', 'NOT Approved!.');
                return $this->redirect(['mgf-organisation/applications','status'=>2]);
            }
        }
    }


    /**
     * Deletes an existing MgfApproval model.
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
     * Finds the MgfApproval model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MgfApproval the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */

    protected function findModel($id)
    {
        if (($model = MgfApproval::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
