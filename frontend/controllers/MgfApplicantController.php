<?php

namespace frontend\controllers;

use Yii;
use frontend\models\MgfApplicant;
use frontend\models\MgfApplicantSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Districts;
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
            $districtid=$model->district_id;
            $district=Districts::findOne($districtid);
            $model->province_id=$district->province_id;
            if($model->save()){
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
            $model->save();      
            $model->confirmed=1;
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Saved successfully.');
                return $this->redirect(['applicant', 'id' => $model->id]);
            }else{
                Yii::$app->session->setFlash('error', 'NOT Saved!.');
                return $this->render('confirmation', ['model' => $model,]);
            }
        }

        return $this->render('confirmation', ['model' => $model,]);
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
