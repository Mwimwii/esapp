<?php
namespace frontend\controllers;
use Yii;
<<<<<<< HEAD
use backend\models\MgfAttachements;
=======
use frontend\models\MgfAttachements;
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
use frontend\models\MgfApplicant;
use frontend\models\MgfAttachementsSearch;
use frontend\models\MgfChecklist;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\filters\AccessControl;


/**
 * MgfAttachementsController implements the CRUD actions for MgfAttachements model.
 */
class MgfAttachementsController extends Controller{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
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
     * Lists all MgfAttachements models.
     * @return mixed
     */
    public function actionIndex(){
        $usertype=Yii::$app->user->identity->type_of_user;
        $searchModel = new MgfAttachementsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'usertype'=>$usertype,
        ]);
    }

    /**
     * Displays a single MgfAttachements model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id){
        $userid=Yii::$app->user->identity->id;
        $applicant=MgfApplicant::find()->where(['user_id'=>$userid])->one();
        $documents=MgfAttachements::find()->where(['organisation_id'=>$applicant->organisation_id])->all();
        return $this->render('view', ['model' => $this->findModel($id),'documents'=>$documents]);
    }

    public function actionAttachements($id){
        $userid=Yii::$app->user->identity->id;
        $applicant=MgfApplicant::find()->where(['user_id'=>$userid])->one();
        $documents=MgfAttachements::find()->where(['organisation_id'=>$applicant->organisation_id])->all();
        return $this->render('attachements', ['model' => $this->findModel($id),'documents'=>$documents]);
    }


    /**
     * Updates an existing MgfAttachements model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id){
        $model = $this->findModel($id);
        $userid=Yii::$app->user->identity->id;
        $applicant=MgfApplicant::findOne(['user_id'=>$userid]);
        if ($model->load(Yii::$app->request->post())) {
            
            if($applicant->applicant_type=="Category-A"){
                $model->registration_certificate=UploadedFile::getInstance($model,'registration_certificate');
                $model->articles_of_assoc=UploadedFile::getInstance($model,'articles_of_assoc');    
                $model->mou_contract=UploadedFile::getInstance($model,'mou_contract');
                $model->board_resolution=UploadedFile::getInstance($model,'board_resolution');
            
                $image_certificate=$model->registration_certificate;
                $certificate_path='uploads/attachements/'.$model->id.'_Certificate'.rand(1,4000).'_'.$image_certificate;
                $model->registration_certificate->saveAs($certificate_path);
                $model->registration_certificate=$certificate_path;

                $image_articles_of_assoc=$model->articles_of_assoc;
                $articles_path='uploads/attachements/'.$model->id.'_Article'.rand(1,4000).'_'.$image_articles_of_assoc;
                $model->articles_of_assoc->saveAs($articles_path);
                $model->articles_of_assoc=$articles_path;

                $image_mou_contract=$model->mou_contract;
                $contract_path='uploads/attachements/'.$model->id.'_Contract'.rand(1,4000).'_'.$image_mou_contract;
                $model->mou_contract->saveAs($contract_path);
                $model->mou_contract=$contract_path;

                $image_board_resolution=$model->board_resolution;
                $resolution_path='uploads/attachements/'.$model->id.'_Resolution'.rand(1,4000).'_'.$image_board_resolution;
                $model->board_resolution->saveAs($resolution_path);
                $model->board_resolution=$resolution_path;
     
            }else{

                $model->audit_reports=UploadedFile::getInstance($model,'audit_reports');
                $model->application_attachement=UploadedFile::getInstance($model,'application_attachement');
                $model->registration_certificate=UploadedFile::getInstance($model,'registration_certificate');
                $model->articles_of_assoc=UploadedFile::getInstance($model,'articles_of_assoc');    
                $model->mou_contract=UploadedFile::getInstance($model,'mou_contract');
                $model->board_resolution=UploadedFile::getInstance($model,'board_resolution');
            
                $image_certificate=$model->registration_certificate;
                $certificate_path='uploads/attachements/'.$model->id.'_Certificate'.rand(1,4000).'_'.$image_certificate;
                $model->registration_certificate->saveAs($certificate_path);
                $model->registration_certificate=$certificate_path;

                $image_articles_of_assoc=$model->articles_of_assoc;
                $articles_path='uploads/attachements/'.$model->id.'_Article'.rand(1,4000).'_'.$image_articles_of_assoc;
                $model->articles_of_assoc->saveAs($articles_path);
                $model->articles_of_assoc=$articles_path;

                $image_mou_contract=$model->mou_contract;
                $contract_path='uploads/attachements/'.$model->id.'_Contract'.rand(1,4000).'_'.$image_mou_contract;
                $model->mou_contract->saveAs($contract_path);
                $model->mou_contract=$contract_path;

                $image_board_resolution=$model->board_resolution;
                $resolution_path='uploads/attachements/'.$model->id.'_Resolution'.rand(1,4000).'_'.$image_board_resolution;
                $model->board_resolution->saveAs($resolution_path);
                $model->board_resolution=$resolution_path;

                $image_audit_reports=$model->audit_reports;
                $audit_path='uploads/attachements/'.$model->id.'_Audit'.rand(1,4000).'_'.$image_audit_reports;
                $model->audit_reports->saveAs($audit_path);
                $model->audit_reports=$audit_path;

                $image_application_attachement=$model->application_attachement;
                $application_path='uploads/attachements/'.$model->id.'_Application'.rand(1,4000).'_'.$image_application_attachement;
                $model->application_attachement->saveAs($application_path);
                $model->application_attachement=$application_path;
            }
            
            if ($model->save()) {
                MgfChecklist::updateAll(['attachements_uploaded'=>1], 'applicant_id='.$applicant->id);
                Yii::$app->session->setFlash('success', 'Saved successfully.');
                return $this->redirect(['mgf-attachements/view', 'id' =>$model->id]);
            }
        }

        if ($applicant->applicant_type=="Category-A") {
            return $this->render('updatea', [
                'model' => $model,
            ]);
        }else{
            return $this->render('updateb', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing MgfAttachements model.
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
     * Finds the MgfAttachements model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MgfAttachements the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MgfAttachements::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
