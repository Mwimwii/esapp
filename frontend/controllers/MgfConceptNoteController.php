<?php

namespace frontend\controllers;

use Yii;
use frontend\models\MgfConceptNote;
use frontend\models\MgfConceptNoteSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\MgfApplicant;
use frontend\models\MgfApplication;
use frontend\models\MgfApproval;
use frontend\models\MgfChecklist;
use frontend\models\MgfOrganisation;

include("findid.php");
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
    public function actionView($id){
        $orgid=getOrganisationID();
        $concept=MgfConceptNote::find()->where(['organisation_id'=>$orgid]);
        //$concept
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new MgfConceptNote model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate(){
        $model = new MgfConceptNote();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {  
            $userid=Yii::$app->user->identity->id;
            $applicant=MgfApplicant::findOne(['user_id'=>$userid]);
            MgfChecklist::updateAll(['concept_created'=>1], 'applicant_id='.$applicant->id);     
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
                $userid=Yii::$app->user->identity->id;
                $applicant=MgfApplicant::findOne(['user_id'=>$userid]);
                MgfChecklist::updateAll(['concept_submitted'=>1], 'applicant_id='.$applicant->id);   
                Yii::$app->session->setFlash('success', 'Saved successfully.');
                MgfApplication::updateAll(['is_active' => 0], 'id!='.$applicationid);
                Yii::$app->session->setFlash('success', 'Saved successfully.');
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
        $applicationid=$model->application_id;
        $application = MgfApplication::findOne($applicationid);
        $application->application_status='Submitted';
        $application->date_submitted=date('Y-m-d H:i:s');
        if ($application->save()) {
            $model->date_submitted=$application->date_submitted;
            $model->save();
            $approval=new MgfApproval();
            $approval->application_id=$applicationid;
            $approval->conceptnote_id=$id;

            if ($approval->save()) {
                MgfChecklist::updateAll(['concept_submitted'=>1,'application_id'=>$applicationid], 'applicant_id='.$application->applicant->id);
                Yii::$app->session->setFlash('success', 'Submitted successfully.');
                return $this->redirect(['/mgf-applicant/profile']);
            }
        }
    }


    public function actionCancel($id){
        $model = $this->findModel($id);
        $applicationid=$model->application_id;
        $application = MgfApplication::find()->where(['id'=>$applicationid,'application_status'=>'Submitted'])->one();
        $application->application_status='Cancelled';
        $application->date_submitted=NULL;
        if(MgfApplication::find()->where(['id'=>$applicationid,'application_status'=>'Submitted'])->exists()){
            $application->save();
            $model->date_submitted=$application->date_submitted;
            if($model->save()){
                MgfChecklist::updateAll(['concept_submitted'=>0,'application_id'=>$applicationid], 'applicant_id='.$application->applicant->id);
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
    public function actionDelete($id){
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
    protected function findModel($id){
        if (($model = MgfConceptNote::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
