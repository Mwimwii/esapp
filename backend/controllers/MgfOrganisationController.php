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
use backend\models\MgfOrganisationSearch;
use frontend\models\MgfEligibility;
use frontend\models\MgfEligibilityApproval;

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
        $application=MgfApplication::find()->where(['organisation_id'=>$id,'application_status'=>'Submitted','is_active'=>1])->orWhere(['organisation_id'=>$id,'application_status'=>'Under_Review','is_active'=>1])->one();
        $applicationid=$application->id;
        $application->application_status='Under_Review';
        if($application->save()){
        $documents=MgfAttachements::findOne(['application_id'=>$applicationid]);
        $screening=MgfEligibility::find()->where(['application_id'=>$applicationid])->all();
        $unmarked=MgfEligibility::find()->where(['organisation_id'=>$id,'application_id'=>$applicationid,'satisfactory'=>null])->count();
        $approval=MgfEligibilityApproval::find()->where(['application_id'=>$applicationid])->one();        
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
        //echo $applicationid;
        return $this->render('application', ['model' => $this->findModel($id),
        'document'=>$documents,'criteria'=>$screening,'unmarked'=>$unmarked,'approval'=>$approval,
        'application_status'=>$application_status,'applicationid'=>$applicationid,'status'=>0]);
    }else{
        Yii::$app->session->setFlash('error', 'This Application cannot be Reviewed');
        return $this->redirect(['index',]);
    }
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
