<?php

namespace frontend\controllers;

use backend\models\Districts;
use Yii;
use frontend\models\MgfOrganisation;
use frontend\models\MgfOrganisationSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

use frontend\models\MgfApplicant;
use frontend\models\MgfApplication;
use frontend\models\MgfAttachements;
use frontend\models\MgfConceptNote;
use frontend\models\MgfContact;
use frontend\models\MgfScreening;
use frontend\models\MgfApproval;
use frontend\models\MgfProposal;
use frontend\models\MgfApprovalStatus;
use frontend\models\MgfBranch;
use frontend\models\MgfChecklist;
use frontend\models\MgfEligibility;
use frontend\models\MgfEligibilityApproval;

//include("findid.php");
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
        if($status==0){
            $dataProvider = $searchModel->searchApplications(Yii::$app->request->queryParams);
        }elseif($status==1){
            $dataProvider = $searchModel->searchApplicationsAccepted(Yii::$app->request->queryParams);
        }elseif($status==2){
            $dataProvider = $searchModel->searchApplicationsCertified(Yii::$app->request->queryParams);
        }elseif($status==3){
            $dataProvider = $searchModel->searchApplicationsApproved(Yii::$app->request->queryParams);
        }else{
            $dataProvider = $searchModel->searchApplicationsAll(Yii::$app->request->queryParams);
        }
        return $this->render('applications', [
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
        $branches=MgfBranch::find()->joinWith('district')->where(['organisation_id'=>$id])->all();
        $applicant=MgfApplicant::find()->where(['user_id'=>$userid])->one(); 
        //$id=getOrganisationID(); 
        return $this->render('view', ['model' => $this->findModel($id),'documents'=>$documents,'criteria'=>$screening,'concepts'=>$concepts,'contacts'=>$contacts,'branches'=>$branches,'applicant'=>$applicant]);
    }

    public function actionOpen($id){
        $model = $this->findModel($id);
        $application=MgfApplication::find()->where(['organisation_id'=>$id])->where(['application_status'=>'Submitted','is_active'=>1])->orWhere(['application_status'=>'Under_Review','is_active'=>1])->one();
        if ($application==null) {
            throw new NotFoundHttpException();
        }
        $applicationid=$application->id;
        $application->application_status='Under_Review';
        $application->save();
        $documents=MgfAttachements::find()->where(['organisation_id'=>$id,'application_id'=>$applicationid])->one();
        //$orgid=$documents->organisation_id;
        $concept=MgfConceptNote::find()->where(['organisation_id'=>$id,'application_id'=>$applicationid])->one();
        $conceptid=$concept->id;
        $screening=MgfScreening::find()->where(['organisation_id'=>$id,'conceptnote_id'=>$conceptid])->all();
        $unmarked=MgfScreening::find()->where(['organisation_id'=>$id,'conceptnote_id'=>$conceptid,'satisfactory'=>null])->count();
        $approval=MgfApproval::find()->where(['conceptnote_id'=>$conceptid,'application_id'=>$applicationid])->one();
        //$id=getOrganisationID();
        
        $accepted=MgfApprovalStatus::find()->where(['approval_status'=>'Accepted'])->one();
        $rejected=MgfApprovalStatus::find()->where(['approval_status'=>'Rejected'])->one();
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
        //echo $applicationid;
        return $this->render('application', ['model' => $this->findModel($id),
        'document'=>$documents,'criteria'=>$screening,'concept'=>$concept,'unmarked'=>$unmarked,
        'approval'=>$approval,'application_status'=>$application_status,'applicationid'=>$applicationid,'status'=>0]);
    }


    public function actionScreen($id){
        $model = $this->findModel($id);
        $application=MgfApplication::find()->where(['organisation_id'=>$id])->where(['application_status'=>'Submitted','is_active'=>1])->orWhere(['application_status'=>'Under_Review','is_active'=>1])->one();
        if ($application==null) {
            throw new NotFoundHttpException();
        }
        $applicationid=$application->id;
        $application->application_status='Under_Review';
        $application->save();
        $documents=MgfAttachements::find()->where(['organisation_id'=>$id,'application_id'=>$applicationid])->one();
        $screening=MgfEligibility::find()->where(['organisation_id'=>$id,'application_id'=>$applicationid])->all();
        $unmarked=MgfScreening::find()->where(['organisation_id'=>$id,'application_id'=>$applicationid,'satisfactory'=>null])->count();
        $approval=MgfEligibilityApproval::find()->where(['application_id'=>$applicationid])->one();
        
        
        $accepted=MgfApprovalStatus::find()->where(['approval_status'=>'Accepted'])->one();
        $rejected=MgfApprovalStatus::find()->where(['approval_status'=>'Rejected'])->one();
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
        //echo $applicationid;
        return $this->render('eligilibity', ['model' => $this->findModel($id),'document'=>$documents,'criteria'=>$screening,'unmarked'=>$unmarked,
        'approval'=>$approval,'application_status'=>$application_status,'applicationid'=>$applicationid,'status'=>0]);
    }


    public function actionManage($id){
        $model = $this->findModel($id);
        $application=MgfApplication::find()->where(['organisation_id'=>$id])->where(['application_status'=>'Accepted','is_active'=>1])->one();
        if ($application==null) {
                throw new NotFoundHttpException();
        }
        $applicationid=$application->id;
        $documents=MgfAttachements::find()->where(['organisation_id'=>$id,'application_id'=>$applicationid])->one();
        $concept=MgfConceptNote::find()->where(['organisation_id'=>$id,'application_id'=>$applicationid])->one();
        $conceptid=$concept->id;
        $screening=MgfScreening::find()->where(['organisation_id'=>$id,'conceptnote_id'=>$conceptid])->all();
        $unmarked=MgfScreening::find()->where(['organisation_id'=>$id,'conceptnote_id'=>$conceptid,'satisfactory'=>null])->count();
        $approval=MgfApproval::find()->where(['conceptnote_id'=>$conceptid,'application_id'=>$applicationid])->one();
        //$id=getOrganisationID();
        $application_status=$application->application_status;
        return $this->render('application', ['model' => $this->findModel($id),
        'document'=>$documents,'criteria'=>$screening,'concept'=>$concept,'unmarked'=>$unmarked,'approval'=>$approval,'application_status'=>$application_status,'applicationid'=>$applicationid,'status'=>1]);
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
     * Creates a new MgfOrganisation model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

    public function actionCreate(){
        $model = new MgfOrganisation();
        if ($model->load(Yii::$app->request->post())) {
            $userid=Yii::$app->user->identity->id;
            $applicant=MgfApplicant::findOne(["user_id"=>$userid]);
            $model->applicant_id=$applicant->id;
            $model->district_id=$applicant->district_id;
            $model->province_id=$applicant->province_id;
            $model->is_active=1;
            if ($model->save()){
                MgfChecklist::updateAll(['organisation_created'=>1],'applicant_id='.$applicant->id);
                Yii::$app->session->setFlash('success', 'Saved successfully.');
                return $this->redirect(['view', 'id' => $model->id]);
            }else{
                Yii::$app->session->setFlash('error', 'NOT Saved!');
                return $this->render('create', ['model' => $model,]);
            }
        }
        return $this->render('create', ['model' => $model,]);
    }


    public function actionCreatebranch($id){
        $model = new MgfBranch();
        if ($model->load(Yii::$app->request->post())) {
            $model->organisation_id=$id;
            $district=Districts::findOne($model->district_id);
            $model->province_id=$district->province_id;
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Saved successfully.');
            } else {
                Yii::$app->session->setFlash('error', 'NOT Saved');
            }
            return $this->redirect(['mgf-organisation/view', 'id' => $id]);
        }
    }


    public function actionUpdatebranch($id){
        $model=MgfBranch::findOne($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Saved successfully.');
            return $this->redirect(['view', 'id' => $model->organisation_id]);
        }

        return $this->render('branch', ['model' => $model,]);
    }

    public function actionDeletebranch($id){
        $model=MgfBranch::findOne($id);
        if($model->delete()){
            Yii::$app->session->setFlash('success', 'Deleted successfully.');
        }else{
            Yii::$app->session->setFlash('error', 'NOT Deleted.');
        }
        return $this->redirect(['view', 'id' => $model->organisation_id]);
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
            MgfChecklist::updateAll(['organisation_created'=>1],'applicant_id='.$model->applicant_id);
            Yii::$app->session->setFlash('success', 'Saved successfully.');
            if($model->organisational_branches==0){
                MgfBranch::deleteAll(['organisation_id'=>$id]);
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }


    /**
     * Deletes an existing MgfOrganisation model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */

    public function actionDelete($id){
        //$id=getOrganisationID();
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
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