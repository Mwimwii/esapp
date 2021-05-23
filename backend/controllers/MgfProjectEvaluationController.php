<?php
namespace backend\controllers;
use Yii;
use backend\models\MgfProjectEvaluation;
use backend\models\MgfProjectEvaluationSearch;
use backend\models\MgfApprovalStatus;
use backend\models\MgfFinalEvaluation;
use backend\models\MgfProposal;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\MgfProposalEvaluation;
use backend\models\MgfReviewer;
use backend\models\MgfSelectionCategory;
use backend\models\MgfSelectionCriteria;

/**
 * MgfProjectEvaluationController implements the CRUD actions for MgfProjectEvaluation model.
 */
class MgfProjectEvaluationController extends Controller
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
     * Lists all MgfProjectEvaluation models.
     * @return mixed
     */

    public function actionIndex(){
        $userid=Yii::$app->user->identity->id;
        $searchModel = new MgfProjectEvaluationSearch(['reviewedby'=>$userid]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', ['searchModel' => $searchModel,'dataProvider' => $dataProvider,]);
    }

    /**
     * Displays a single MgfProjectEvaluation model.
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
     * Updates an existing MgfProjectEvaluation model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */


    public function actionOpen($id){
        $userid=Yii::$app->user->identity->id;
            if(MgfReviewer::find()->where(['user_id'=>$userid])->exists()){
            $model = $this->findModel($id);
            $proposal=MgfProposal::findOne($model->proposal_id);
            if ($proposal->proposal_status=="Under_Review" || $proposal->proposal_status=="Submitted"){
                $proposal->proposal_status="Under_Review";
                $proposal->save();
            }
            
            $criteria=MgfSelectionCriteria::find()->all();
            foreach ($criteria as $item) {
                if(MgfProposalEvaluation::find()->where(['proposal_id'=>$model->proposal_id,'createdby'=>$userid,'criterion_id'=>$item->id])->exists()){
                    //Do Nothing if record exists
                }else{
                    //Save records
                    $pproposal=new MgfProposalEvaluation();
                    $pproposal->proposal_id=$model->proposal_id;
                    $pproposal->criterion_id=$item->id;
                    $pproposal->createdby=$userid;
                    $pproposal->save();
                }
            }

            $project=MgfProjectEvaluation::find()->where(['proposal_id'=>$proposal->id,'reviewedby'=>$userid])->one();
            $categories=MgfSelectionCategory::find()->all();
            return $this->render('proposal', ['model' => $proposal,'categories'=>$categories,'project'=>$project,'userid'=>$userid]);
        }else{
            Yii::$app->session->setFlash('warning', 'Your Profile Cannot Review Assigned Proposals');
            return $this->redirect(['index']);
        }
    }




    public function actionMarked($id){
        $userid=Yii::$app->user->identity->id;
        $model = $this->findModel($id);
        $proposal=MgfProposal::findOne($model->proposal_id);
        //$proposal->proposal_status="Under_Review";
        //$proposal->save();
        $categories=MgfSelectionCategory::find()->all();
        $project=MgfProjectEvaluation::find()->where(['proposal_id'=>$model->proposal_id,'reviewedby'=>$userid])->one();
        $unmarked=MgfProposalEvaluation::find()->where(['proposal_id'=>$model->proposal_id,'createdby'=>$userid,'grade'=>NULL])->count();
        return $this->render('marked', ['model' => $proposal,'categories'=>$categories,'project'=>$project,'unmarked'=>$unmarked,'userid'=>$userid]);    }


    public function actionFinalize($id){
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
            $stronglyrecommended=MgfApprovalStatus::find()->where(['approval_status'=>'Strongly Recommended'])->one();
            $recommended=MgfApprovalStatus::find()->where(['approval_status'=>'Recommended'])->one();
            $deferred=MgfApprovalStatus::find()->where(['approval_status'=>'Deferred'])->one();
            if($model->totalscore>=$stronglyrecommended->lowerlimit){
                $decision=$stronglyrecommended->approval_status;
                $status=1;
            }else if($model->totalscore>=$recommended->lowerlimit && $model->totalscore>=$deferred->upperlimit){
                $decision=$recommended->approval_status;
                $status=2;
            }else if($model->totalscore>=$deferred->lowerlimit && $model->totalscore<=$deferred->upperlimit){
                $decision=$deferred->approval_status;
                $status=4;
            }else{
                $decision='Not Recommended';
                $status=3;
            }
            
            $model->date_reviewed=date('Y-m-d H:i:s');
            $model->decision=$decision;
            $model->status=$status;
            $model->save();
            
            $evals=MgfProjectEvaluation::find()->where(['proposal_id'=>$model->proposal_id])->andWhere(['NOT',['status'=>0]])->count();
            $totalscore=MgfProjectEvaluation::find()->where(['proposal_id'=>$model->proposal_id])->andWhere(['NOT',['status'=>0]])->sum('totalscore');
            if ($totalscore>0) {
                $finalscore=$totalscore/$evals;
                if($model->totalscore>=$stronglyrecommended->lowerlimit){
                    $decision=$stronglyrecommended->approval_status;
                    $status=1;
                }else if($model->totalscore>=$recommended->lowerlimit && $model->totalscore>=$deferred->upperlimit){
                    $decision=$recommended->approval_status;
                    $status=2;
                }else if($model->totalscore>=$deferred->lowerlimit && $model->totalscore<=$deferred->upperlimit){
                    $decision=$deferred->approval_status;
                    $status=4;
                }else{
                    $decision='Not Recommended';
                    $status=3;
                }
            }else{
                $finalscore=0;
                $decision='Not Recommended';
                $status=3;
            }

            if($evals>3){
                MgfProposal::updateAll(['proposal_status'=>$decision],'id='.$model->proposal_id);
            }
            if(MgfFinalEvaluation::find()->where(['proposal_id'=>$model->proposal_id])->exists()){
                }else{
                    $final=new MgfFinalEvaluation();
                    $final->proposal_id=$model->proposal_id;
                    $final->organisation_id=$model->organisation_id;
                    $final->save();
                }
                
            MgfFinalEvaluation::updateAll(['decision'=>$decision,'finalscore'=>$finalscore,'status'=>$status],'proposal_id='.$model->proposal_id);
            Yii::$app->session->setFlash('success', 'Saved successfully.');
            return $this->redirect(['index']);
        }

        return $this->render('finalize', ['model' => $model,]);
    }


    public function actionGrading($ppe,$awardedscore,$grade,$proposal){
        $userid=Yii::$app->user->identity->id;
        MgfProposalEvaluation::updateAll(['awardedscore'=>$awardedscore,'grade'=>$grade,'createdby'=>$userid], 'id='.$ppe);
        $total=MgfProposalEvaluation::find()->where(['proposal_id'=>$proposal,'createdby'=>$userid])->sum('awardedscore');
        MgfProjectEvaluation::updateAll(['totalscore'=>$total],'proposal_id='.$proposal. ' && reviewedby='.$userid);
        $mpe=MgfProjectEvaluation::find()->where(['proposal_id'=>$proposal,'reviewedby'=>$userid])->one();
        Yii::$app->session->setFlash('success', 'Saved successfully.');
        return $this->redirect(['open','id'=>$mpe->id]);
    }

    
    public function actionAddcomment($ppe,$proposal,$comment){
        $userid=Yii::$app->user->identity->id;
        MgfProposalEvaluation::updateAll(['comment'=>$comment,'createdby'=>$userid], 'id='.$ppe. ' && createdby='.$userid);
        $mpe=MgfProjectEvaluation::find()->where(['proposal_id'=>$proposal,'reviewedby'=>$userid])->one();
        Yii::$app->session->setFlash('success', 'Saved successfully.');
        return $this->redirect(['marked','id'=>$mpe->id]);
    }

    public function actionResetgrade($ppe,$proposal){
        $userid=Yii::$app->user->identity->id;
        MgfProposalEvaluation::updateAll(['awardedscore'=>NULL,'grade'=>NULL,'comment'=>NULL,'createdby'=>$userid], 'id='.$ppe);
        $total=MgfProposalEvaluation::find()->where(['proposal_id'=>$proposal,'createdby'=>$userid])->sum('awardedscore');
        MgfProjectEvaluation::updateAll(['totalscore'=>$total],'proposal_id='.$proposal.  ' && reviewedby='.$userid);
        Yii::$app->session->setFlash('success', 'Saved successfully.');
        $mpe=MgfProjectEvaluation::find()->where(['proposal_id'=>$proposal,'reviewedby'=>$userid])->one();
        return $this->redirect(['marked','id'=>$mpe->id]);
    }

    /**
     * Deletes an existing MgfProjectEvaluation model.
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
     * Finds the MgfProjectEvaluation model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MgfProjectEvaluation the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id){
        if (($model = MgfProjectEvaluation::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}