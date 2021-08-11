<?php

namespace backend\controllers;

use backend\models\MgfEligibilityApproval;
use Yii;
use frontend\models\MgfProposalSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\MgfComponent;
use frontend\models\MgfProposal;
use frontend\models\MgfApplicant;
use frontend\models\MgfApproval;
use frontend\models\MgfEligibility;
use frontend\models\MgfOffer;
use frontend\models\MgfSelectionCategory;
use frontend\models\MgfProposalEvaluation;
use frontend\models\MgfProjectEvaluation;
use frontend\models\MgfScreening;
use frontend\models\MgfScreeningSearch;
use frontend\models\MgfSelectionCriteria;


/**
 * MgfScreeningController implements the CRUD actions for MgfScreening model.
 */
class MgfScreeningController extends Controller{
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
     * Lists all MgfScreening models.
     * @return mixed
     */
    public function actionIndex(){
        $searchModel = new MgfScreeningSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MgfScreening model.
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
     * Updates an existing MgfScreening model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id){
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }


    public function actionAddcomment($id){
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['addcomment', 'id' => $model->id]);
        }

        return $this->render('addcomment', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing MgfScreening model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id){
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    public function actionApprove($id,$orgid,$conceptid){
        $userid=Yii::$app->user->identity->username;
        $model = $this->findModel($id);
        if(MgfScreening::updateAll(['satisfactory' => 'YES','verified_by'=>$userid], 'id='.$id)){
            $scores=MgfScreening::find()->where(['organisation_id'=>$orgid,'conceptnote_id'=>$conceptid,'satisfactory'=>'YES'])->count();
            $total_marks=MgfScreening::find()->where(['organisation_id'=>$orgid,'conceptnote_id'=>$conceptid])->count();
            if ($scores>0) {
                $total=100*($scores/$total_marks);
            }else{
                $total=0;
            }
            Yii::$app->session->setFlash('success', 'Saved successfully.');
            MgfApproval::updateAll(['scores' => $total], 'conceptnote_id='.$conceptid);
            return $this->redirect(['mgf-concept-note/view','id'=>$conceptid]);
        }else{
            $scores=MgfScreening::find()->where(['organisation_id'=>$orgid,'conceptnote_id'=>$conceptid,'satisfactory'=>'YES'])->count();
            $message = '';
            foreach ($model->getErrors() as $error) {
                $message .= $error[0];
            }
            Yii::$app->session->setFlash('error', "Error::" . $message);
            #Yii::$app->session->setFlash('error', 'NOT Saved!'.$id.'-'.$orgid.'-'.$conceptid.'-'.$scores);
            return $this->redirect(['mgf-concept-note/view','id'=>$conceptid]);
        }
    }



    public function actionDisapprove($id,$orgid,$conceptid){
        $userid=Yii::$app->user->identity->username;
        $model = $this->findModel($id);
        if(MgfScreening::updateAll(['satisfactory' => 'NO','verified_by'=>$userid], 'id='.$id)){
            $scores=MgfScreening::find()->where(['organisation_id'=>$orgid,'conceptnote_id'=>$conceptid,'satisfactory'=>'YES'])->count();
            $total_marks=MgfScreening::find()->where(['organisation_id'=>$orgid,'conceptnote_id'=>$conceptid])->count();
            if ($scores>0) {
                $total=100*($scores/$total_marks);
            } else {
                $total=0;
            }
            MgfApproval::updateAll(['scores' => $total], 'conceptnote_id='.$conceptid);
            Yii::$app->session->setFlash('success', 'Saved successfully.');

            return $this->redirect(['mgf-concept-note/view','id'=>$conceptid]);
        }else{
            $message = '';
            foreach ($model->getErrors() as $error) {
                $message .= $error[0];
            }
            Yii::$app->session->setFlash('error', "Error:" . $message);
            //Yii::$app->session->setFlash('error', 'NOT Saved!');
            return $this->redirect(['mgf-concept-note/view','id'=>$conceptid]);
        }
    }
    


    public function actionAccept($id,$orgid,$applicationid){
        $userid=Yii::$app->user->identity->username;
        $model = MgfEligibility::findOne($id);
        if(MgfEligibility::updateAll(['satisfactory' => 'YES','verified_by'=>$userid], 'id='.$id)){
            $scores=MgfEligibility::find()->where(['organisation_id'=>$orgid,'application_id'=>$applicationid,'satisfactory'=>'YES'])->count();
            $total_marks=MgfEligibility::find()->where(['organisation_id'=>$orgid,'application_id'=>$applicationid])->count();
            if ($scores>0) {
                $total=100*($scores/$total_marks);
            }else{
                $total=0;
            }
            Yii::$app->session->setFlash('success', 'Saved successfully.');
            MgfEligibilityApproval::updateAll(['scores' => $total], 'application_id='.$applicationid);
            return $this->redirect(['mgf-organisation/open','id'=>$orgid]);
        }else{
            $scores=MgfScreening::find()->where(['organisation_id'=>$orgid,'application_id'=>$applicationid,'satisfactory'=>'YES'])->count();
            $message = '';
            foreach ($model->getErrors() as $error) {
                $message .= $error[0];
            }
            Yii::$app->session->setFlash('error', "Error::" . $message);
            #Yii::$app->session->setFlash('error', 'NOT Saved!'.$id.'-'.$orgid.'-'.$conceptid.'-'.$scores);
            return $this->redirect(['mgf-organisation/open','id'=>$orgid]);
        }
    }


    public function actionDeny($id,$orgid,$applicationid){
        $userid=Yii::$app->user->identity->username;
        $model = MgfEligibility::findOne($id);
        if(MgfEligibility::updateAll(['satisfactory' => 'NO','verified_by'=>$userid], 'id='.$id)){
            $scores=MgfEligibility::find()->where(['organisation_id'=>$orgid,'application_id'=>$applicationid,'satisfactory'=>'YES'])->count();
            $total_marks=MgfEligibility::find()->where(['organisation_id'=>$orgid,'application_id'=>$applicationid])->count();
            if ($scores>0) {
                $total=100*($scores/$total_marks);
            } else {
                $total=0;
            }
            MgfEligibilityApproval::updateAll(['scores' => $total], 'application_id='.$applicationid);
            Yii::$app->session->setFlash('success', 'Saved successfully.');

            return $this->redirect(['mgf-organisation/open','id'=>$orgid]);
        }else{
            $message = '';
            foreach ($model->getErrors() as $error) {
                $message .= $error[0];
            }
            Yii::$app->session->setFlash('error', "Error:" . $message);
            //Yii::$app->session->setFlash('error', 'NOT Saved!');
            return $this->redirect(['mgf-organisation/open','id'=>$orgid]);
        }
    }

    /**
     * Finds the MgfScreening model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MgfScreening the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MgfScreening::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
