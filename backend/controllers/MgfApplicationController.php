<?php

namespace backend\controllers;

use backend\models\MgfApplicant;
use Yii;
use backend\models\MgfApplication;
use frontend\models\MgfAttachements;
use frontend\models\MgfScreening;
use frontend\models\MgfApplicationSearch;
use frontend\models\MgfConceptNote;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
//include("findid.php");
/**
 * MgfApplicationController implements the CRUD actions for MgfApplication model.
 */

class MgfApplicationController extends Controller{
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
     * Lists all MgfApplication models.
     * @return mixed
     */
    public function actionIndex($status){
        $searchModel = new MgfApplicationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionApplications(){
        $searchModel = new MgfApplicationSearch();
        $dataProvider = $searchModel->searchApplications(Yii::$app->request->queryParams);

        return $this->render('applications', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MgfApplication model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id){
        $model = $this->findModel($id);
        $applicant=MgfApplicant::findOne($model->applicant_id); 
        if($applicant->applicant_type=='Category-B'){
            if(MgfConceptNote::find()->where(['application_id'=>$id,'organisation_id'=>$model->organisation_id])->exists()){
                $concept=MgfConceptNote::findOne(['application_id'=>$id]);
                $screening=MgfScreening::find()->where(['organisation_id'=>$concept->organisation_id,'conceptnote_id'=>$concept->id])->all();
                return $this->render('view', ['model' => $this->findModel($id),'criteria'=>$screening,'applicant'=>$applicant]);
            }else{
                $screening=MgfScreening::find()->where(['id'=>0])->all();
                return $this->render('view', ['model' => $this->findModel($id),'criteria'=>$screening,'applicant'=>$applicant]);
            }
        }else{
            return $this->render('view', ['model' => $this->findModel($id),'applicant'=>$applicant]);
        }
        
    }

    public function actionManage($id){
        $model = $this->findModel($id);
        //$organisation=MgfOrganisation::findOne($model->organisation_id);
        $documents=MgfAttachements::find()->where(['organisation_id'=>$model->organisation_id,'application_id'=>$id])->all();
        $concept=MgfConceptNote::find()->where(['application_id'=>$id,'organisation_id'=>$model->organisation_id])->one();
        $screening=MgfScreening::find()->where(['organisation_id'=>$model->organisation_id])->all();
        $applicant=MgfApplicant::findOne($model->applicant_id); 
        //$id=getOrganisationID();   
        return $this->render('manage', ['model' => $this->findModel($id),
        'documents'=>$documents,'criteria'=>$screening,'concept'=>$concept,'applicant'=>$applicant]);
    }

    /**
     * Updates an existing MgfApplication model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionAddcomment($id){
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Saved successfully.');
            return $this->redirect(['mgf-organisation/applications']);
        }

        return $this->render('addcomment', ['model' => $model,
        ]);
    }

    /**
     * Deletes an existing MgfApplication model.
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
     * Finds the MgfApplication model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MgfApplication the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MgfApplication::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
