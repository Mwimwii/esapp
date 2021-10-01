<?php

namespace frontend\controllers;

use frontend\models\MgfActivity;
use frontend\models\MgfApplicant;
use Yii;
use frontend\models\MgfComponent;
use frontend\models\MgfComponentSearch;
use frontend\models\MgfOrganisation;
use frontend\models\MgfProposal;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MgfComponentController implements the CRUD actions for MgfComponent model.
 */

class MgfComponentController extends Controller{
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
     * Lists all MgfComponent models.
     * @return mixed
     */
    public function actionIndex(){
        $searchModel = new MgfComponentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionComponents(){
        $userid=Yii::$app->user->identity->id;
        $applicant=MgfApplicant::find()->where(['user_id'=>$userid])->one();
        if(MgfProposal::find()->where(['organisation_id'=>$applicant->organisation_id,'is_active'=>1])->exists()){
            $proposal=MgfProposal::find()->where(['organisation_id'=>$applicant->organisation_id,'is_active'=>1])->one();
            $searchModel = new MgfComponentSearch(['proposal_id'=>$proposal->id]);
        }else{
            $searchModel = new MgfComponentSearch(['proposal_id'=>0]);
        }
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MgfComponent model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id){
        return $this->render('view', ['model' => $this->findModel($id),]);
    }

    public function actionManage($id,$status=0){
        $activities=MgfActivity::find()->where(['componet_id'=>$id])->all();
        return $this->render('activities', ['model' => $this->findModel($id),'activities'=>$activities,'status'=>$status,]);
    }


    public function actionInputitem($id,$status=1){
        $model = $this->findModel($id);
        $activities=MgfActivity::find()->where(['componet_id'=>$id])->all();
        $proposal=MgfProposal::findOne($model->proposal_id);
        return $this->render('quantities', ['model' => $this->findModel($id),'activities'=>$activities,'status'=>$status,'proposal'=>$proposal]);
    }

    public function actionItemcosts($id,$status=2){
        $model = $this->findModel($id);
        $activities=MgfActivity::find()->where(['componet_id'=>$id])->all();
        $proposal=MgfProposal::findOne($model->proposal_id);
        return $this->render('itemcosts', ['model' => $this->findModel($id),'activities'=>$activities,'status'=>$status,'proposal'=>$proposal]);
    }

    public function actionCostplan($id,$status=3){
        $model = $this->findModel($id);
        $activities=MgfActivity::find()->where(['componet_id'=>$id])->all();
        $proposal=MgfProposal::findOne($model->proposal_id);
        return $this->render('costplan', ['model' => $this->findModel($id),'activities'=>$activities,'status'=>$status,'proposal'=>$proposal]);
    }

    /**
     * Creates a new MgfComponent model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate(){
        $model = new MgfComponent();

        if ($model->load(Yii::$app->request->post())){
            $userid=Yii::$app->user->identity->id;
            $applicant=MgfApplicant::find()->where(['user_id'=>$userid])->one();
            $proposal=MgfProposal::find()->where(['organisation_id'=>$applicant->organisation_id,'is_active'=>1])->one();
            $components=MgfComponent::find()->where(['proposal_id'=>$proposal->id])->count();
            $model->proposal_id=$proposal->id;
            $model->component_no=$components+1;
            $model->createdby=$userid;
            $model->save();
            Yii::$app->session->setFlash('success', 'Saved successfully.');
            return $this->redirect(['components']);
        }
        $userid=Yii::$app->user->identity->id;
        $applicant=MgfApplicant::find()->where(['user_id'=>$userid])->one();
        $organisations=MgfOrganisation::find()->where(['applicant_id'=>$applicant->id,'is_active'=>1])->count();
        if ($organisations>0) {
            $proposals=MgfProposal::find()->where(['organisation_id'=>$applicant->organisation_id,'proposal_status'=>'Updated','is_active'=>1])->count();
            if ($proposals>0) {
                $proposal=MgfProposal::find()->where(['organisation_id'=>$applicant->organisation_id,'proposal_status'=>'Updated','is_active'=>1])->one();
                return $this->render('create', ['model' => $model,'proposal'=>$proposal]);
            }else{
                Yii::$app->session->setFlash('warning', 'Active Proposal is NOT Updated OR Already Submitted.');
                return $this->redirect(['components']);
            }
        }else{
            Yii::$app->session->setFlash('warning', 'Please Register Your Organisation to Proceed!');
        }
    }

    /**
     * Updates an existing MgfComponent model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id){
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->save();
            Yii::$app->session->setFlash('success', 'Saved successfully.');
            return $this->redirect(['components']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing MgfComponent model.
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
     * Finds the MgfComponent model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MgfComponent the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MgfComponent::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
