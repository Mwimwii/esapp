<?php

namespace frontend\controllers;
use Yii;
use frontend\models\MgfApplicant;
use frontend\models\MgfEligibilityApproval;
use frontend\models\MgfApplicantSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Districts;
use backend\models\MeFaabsCategoryAFarmers;
use backend\models\MgfDistrictEligibility;
use backend\models\MgfYear;
use frontend\models\MgfApplication;
use frontend\models\MgfChecklist;
use frontend\models\MgfOrganisation;

/**
 * MgfApplicantController implements the CRUD actions for MgfApplicant model.
 */

class MgfApplicantController extends Controller{
    /**
     * {@inheritdoc}
     */
    public function behaviors(){
        return [
            'access'=>[
                'class'=>AccessControl::className(),
                'only'=>['create','update','index','view','applicant'],
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
     * Lists all MgfApplicant models.
     * @return mixed
     */
    public function actionMgf(){
        //$this->layout = 'login';
        return $this->render('mgf');
    }


    public function actionIndex(){
        $searchModel = new MgfApplicantSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionProfile(){
        $userid=Yii::$app->user->identity->id;
        $applicant=MgfApplicant::findOne(["user_id"=>$userid]);
        $searchModel = new MgfApplicantSearch(["user_id"=>$userid]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('profile', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'applicant'=>$applicant,
        ]);
    }

    /**
     * Displays a single MgfApplicant model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id){
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }


     /**
     * Displays a single MgfApplicant model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionApplicant($id){
        $userid=Yii::$app->user->identity->id;
        $applicant=MgfApplicant::find()->where(['user_id'=>$userid])->one();
        $id=$applicant->id;
        return $this->render('applicant', ['model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new MgfApplicant model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

    public function actionCreate(){
        $model = new MgfApplicant();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing MgfApplicant model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id){
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
            $model->save();
            if(MeFaabsCategoryAFarmers::find()->where(['nrc'=>$model->nationalid])->exists()){
                $farmer_type='Category-A';
            }else{
                $farmer_type='Category-B';
            }
            $model->applicant_type=$farmer_type;
            $districtid=$model->district_id;
            $district=Districts::findOne($districtid);
            $model->province_id=$district->province_id;
            if($model->save()){
                if (!MgfChecklist::find()->where(['applicant_id'=>$model->id])->exists()) {
                    $checklist=new MgfChecklist();
                    $checklist->applicant_id=$model->id;
                    $checklist->save();
                }
                Yii::$app->session->setFlash('success', 'Saved successfully.');
                return $this->redirect(['applicant', 'id' => $model->id]);
            }else{
                Yii::$app->session->setFlash('error', 'NOT Saved!.');
                return $this->render('update', ['model' => $model,]);
            }
        }

        return $this->render('update', ['model' => $model,]);
    }

    public function actionConfirm($id){
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
            $year=MgfYear::findOne(['is_active'=>1]);
            $model->save();      
            $model->confirmed=1;
            if ($model->save()) {
                MgfChecklist::updateAll(['profile_confirmed'=>1], 'applicant_id='.$id);
                Yii::$app->session->setFlash('success', 'Saved successfully.');

                $application=MgfApplication::findOne(['organisation_id'=>$model->organisation_id,'is_active'=>1]);
                if (!MgfEligibilityApproval::find()->where(['application_id'=>$application->id,'is_active'=>1])->exists()) {
                    $eligilbility=new MgfEligibilityApproval();
                    $eligilbility->application_id=$application->id;
                    $eligilbility->is_active=1;
                    $eligilbility->save();
                }
                
                if (!MgfDistrictEligibility::find()->where(['district_id'=>$model->district_id,'year_id'=>$year->id])->exists()){
                    $districtEligibilty=new MgfDistrictEligibility();
                    $districtEligibilty->year_id=$year->id;
                    $districtEligibilty->district_id=$model->district_id;
                    $districtEligibilty->province_id=$model->province_id;
                    $districtEligibilty->save();
                }

                MgfApplication::updateAll(['application_status'=>'Submitted'], 'id='.$application->id);

                return $this->redirect(['applicant', 'id' => $model->id]);
            }else{
                Yii::$app->session->setFlash('error', 'NOT Saved!.');
                return $this->render('confirmation', ['model' => $model,]);
            }
        }

        return $this->render('confirmation', ['model' => $model,]);
    }


    public function actionDeclaration($id){
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
            $year=MgfYear::findOne(['is_active'=>1]);
            $model->save();      
            $model->confirmed=1;
            if ($model->save()) {
                MgfChecklist::updateAll(['items_created'=>1], 'applicant_id='.$id);
                Yii::$app->session->setFlash('success', 'Saved successfully.');
                return $this->redirect(['declaration', 'id' => $model->id]);
            }else{
                Yii::$app->session->setFlash('error', 'NOT Saved!.');
                return $this->render('declaration', ['model' => $model,]);
            }
        }

        return $this->render('declaration', ['model' => $model,]);
    }


    public function actionDeclaration2($id){
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
            $year=MgfYear::findOne(['is_active'=>1]);
            $model->save();      
            $model->confirmed=1;
            if ($model->save()) {
                MgfChecklist::updateAll(['activities_created'=>1], 'applicant_id='.$id);
                Yii::$app->session->setFlash('success', 'Saved successfully.');
                return $this->redirect(['declaration', 'id' => $model->id]);
            }else{
                Yii::$app->session->setFlash('error', 'NOT Saved!.');
                return $this->render('declaration', ['model' => $model,]);
            }
        }

        return $this->render('declaration', ['model' => $model,]);
    }
    /**
     * Deletes an existing MgfApplicant model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id){
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    public function actionDocuments(){
        $userid=Yii::$app->user->identity->id;
        $applicant=MgfApplicant::findOne(['user_id'=>$userid]);
        $organisation = MgfOrganisation::findOne($applicant->organisation_id);
        return $this->render('documents', ['model' => $organisation,]);
    }

    /**
     * Finds the MgfApplicant model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MgfApplicant the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id){
        if (($model = MgfApplicant::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
