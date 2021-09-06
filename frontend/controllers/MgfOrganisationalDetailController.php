<?php

namespace frontend\controllers;


use frontend\models\MgfChecklist;
use frontend\models\MgfApplicant;
use Yii;
use frontend\models\MgfOrganisationalDetails;
use frontend\models\MgfOrganisationalDetailSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MgfOrganisationalDetailController implements the CRUD actions for MgfOrganisationalDetails model.
 */
class MgfOrganisationalDetailController extends Controller
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
     * Lists all MgfOrganisationalDetails models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MgfOrganisationalDetailSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MgfOrganisationalDetails model.
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
     * Creates a new MgfOrganisationalDetails model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate(){
        $model = new MgfOrganisationalDetails();
        $userid=Yii::$app->user->identity->id;

        $applicant=MgfApplicant::findOne(['user_id'=>$userid]);
        if ($model->load(Yii::$app->request->post())) {
            $model->organisation_id=$applicant->organisation_id;
            $model->save();
            MgfChecklist::updateAll(['management_updated'=>1],'applicant_id='.$applicant->id);
        }
        if(MgfOrganisationalDetails::find()->where(['organisation_id'=>$applicant->organisation_id])->exists()){
            MgfChecklist::updateAll(['management_updated'=>1],'applicant_id='.$applicant->id);
            $model = MgfOrganisationalDetails::find()->where(['organisation_id'=>$applicant->organisation_id])->one();
            return $this->redirect(['view', 'id' => $model->id]);
        }else{
            return $this->render('create', ['model' => $model,]);
        }
    }

    /**
     * Updates an existing MgfOrganisationalDetails model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */

    public function actionUpdate($id){
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $userid=Yii::$app->user->identity->id;
            $applicant=MgfApplicant::findOne(['user_id'=>$userid]);
            MgfChecklist::updateAll(['management_updated'=>1],'applicant_id='.$applicant->id);
            Yii::$app->session->setFlash('success', 'Saved99 successfully.'.$model->applicant_id);
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('upd', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing MgfOrganisationalDetails model.
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
     * Finds the MgfOrganisationalDetails model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MgfOrganisationalDetails the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MgfOrganisationalDetails::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
