<?php

namespace backend\controllers;

use backend\models\AuditTrail;
use backend\models\MgfProjectEvaluation;
use backend\models\MgfProposal;
use backend\models\MgfReviewer;
use backend\models\User;
use common\models\Role;
use Yii;
use frontend\models\MgfReviewerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

/**
 * MgfReviewerController implements the CRUD actions for MgfReviewer model.
 */
class MgfReviewerController extends Controller
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
     * Lists all MgfReviewer models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MgfReviewerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MgfReviewer model.
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
     * Creates a new MgfReviewer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */


    public function actionCreate2() {
        if (User::userIsAllowedTo('Create Reviewer')) {
            $model = new User();
            if ($model->load(Yii::$app->request->post())) {
                $role=Role::findOne(['role'=>"Reviewer"]);
                $name = $model->first_name . ' ' . $model->other_name . ' ' . $model->last_name;
                $model->status = User::STATUS_INACTIVE;
                $model->auth_key = Yii::$app->security->generateRandomString();
                $model->password = Yii::$app->getSecurity()->generatePasswordHash($model->first_name . $model->auth_key);
                $model->username = $model->email;
                $model->role = $role->id;
                $model->created_by = Yii::$app->user->identity->id;
                $model->updated_by = Yii::$app->user->identity->id;
                $type=$model->user_type;
                $model->user_type="Other user";
                if ($model->save() && $model->validate()) {
                    $resetPasswordModel = new \backend\models\PasswordResetRequestForm();
                    if ($resetPasswordModel->sendEmailAccountCreation($model->email)) {
                        $reviewer=new MgfReviewer();
                        $reviewer->first_name=$model->first_name;
                        $reviewer->last_name=$model->last_name;
                        $reviewer->email=$model->email;
                        $reviewer->login_code=$model->phone;
                        $reviewer->mobile=$model->phone;
                        $reviewer->reviewer_type=$type;
                        $reviewer->user_id=$model->id;
                        $reviewer->createdBy=Yii::$app->user->id;
                        if($reviewer->save()){
                            $audit = new AuditTrail();
                            $audit->user = Yii::$app->user->id;
                            $audit->action = "Created MGF Reviewer with email: " . $model->email;
                            $audit->ip_address = Yii::$app->request->getUserIP();
                            $audit->user_agent = Yii::$app->request->getUserAgent();
                            $audit->save();    
                        }
                        Yii::$app->session->setFlash('success', 'MGF Reviewer account with email:' . $model->email . ' was successfully created.');
                        return $this->redirect(['index',]);
                    } else {
                        Yii::$app->session->setFlash('error', "User account created but email not sent!");
                        return $this->redirect(['index',]);
                    }
                } else {
                    $message = '';
                    foreach ($model->getErrors() as $error) {
                        $message .= $error[0];
                    }
                    Yii::$app->session->setFlash('error', "Error occured while creating user: $name. Please try again. Error::" . $message);
                    return $this->render('create', ['model' => $model,]);
                }
            }
           
            return $this->render('create', ['model' => $model,]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['index']);
        }
    }


    public function actionCreate21(){
        $model = new MgfReviewer();
        if ($model->load(Yii::$app->request->post())) {
            $userid=Yii::$app->user->identity->id;
            $model->user_id=time();
            $model->createdBy=$userid;
            if ($model->save()) {
                $role=Role::findOne(['role'=>'Reviewer']);
                $this->createUser("Noya","Kalu","kali@kmail.com","0977441156",$role->id);
                
                $user=User::findOne(['email'=>"Kalu","kali@kmail.com"]);
                //MgfReviewer::updateAll(['user_id' => $user->id], 'id='.$model->id);
                //$password = Yii::$app->getSecurity()->generatePasswordHash($model->mobile);
                //$auth=Yii::$app->security->generateRandomString();
                //$verify=Yii::$app->security->generateRandomString().'_'.time();
                //User::updateAll(['role'=>$role->id,'created_at' =>time(),'updated_at'=>time(),'created_by'=>$userid,'auth_key'=>$auth,'password'=>$password,'verification_token'=>$verify], 'id='.$user->id);
                //$resetPasswordModel = new \backend\models\PasswordResetRequestForm();
                //$resetPasswordModel->sendEmailAccountCreation($user->email);
                //Yii::$app->session->setFlash('success', 'Saved successfully.'.$user->setPassword($user->phone));
                //return $this->redirect(['index']);
                
            }else {
                $message = '';
                foreach ($model->getErrors() as $error) {
                    $message .= $error[0];
                }
                Yii::$app->session->setFlash('error', "Error: " . $message);
                return $this->redirect(['index']);
            }
        } return $this->redirect(['index']);
    }


    public function actionAssignReviewers($id){
        if (isset($_POST["reviewers"])) {
            $proposal=MgfProposal::findOne($id);
            foreach ($_POST["reviewers"] as $rev) {
                $reviewer=MgfReviewer::findOne($rev);
                if(!MgfProjectEvaluation::find()->where(['proposal_id'=>$id,'reviewedby'=>$reviewer->user_id])->exists()) {
                    //Create Reviewers Record
                    if($proposal->applicant_type=="Category-A"){
                        $window='1';
                    }else{
                        $window='2';
                    }
                    $mpe=new MgfProjectEvaluation();
                    $mpe->proposal_id=$id;
                    $mpe->window=$window;
                    $mpe->reviewedby=$reviewer->user_id;
                    $mpe->organisation_id=$proposal->organisation_id;
                    $mpe->date_submitted=$proposal->date_submitted;
                    if($mpe->save()){
                        $proposalcount=MgfProjectEvaluation::find()->where(['proposal_id'=>$id])->count();
                        MgfProposal::updateAll(['number_reviewers' => $proposalcount], 'id='.$id);

                        $reviewer->total_assigned_1=MgfProjectEvaluation::find()->where(['reviewedby'=>$reviewer->user_id,'window'=>1])->count();
                        $reviewer->total_assigned_2=MgfProjectEvaluation::find()->where(['reviewedby'=>$reviewer->user_id,'window'=>2])->count();
                        $reviewer->save();
                    }
                }
            }
            //Yii::$app->session->setFlash('success', $reviewer->area_of_expertise .' '.$proposal->project_operations );
            Yii::$app->session->setFlash('success', sizeof($_POST["reviewers"])." Reviwers(s) Assigned Successfully!!");
            if($reviewer->area_of_expertise==$proposal->project_operations){
                return $this->redirect(['/mgf-reviewer/reviewers','id'=>$id]);
            }else{
                return $this->redirect(['/mgf-reviewer/reviewers-other','id'=>$id]);
            }
            
        }else{
            Yii::$app->session->setFlash('error', 'Please select Reviewer(s) to Assign');
            return $this->redirect(['/mgf-reviewer/reviewers','id'=>$id]);
        }
    }


    public function actionRemoveReviewers($id){
        if (isset($_POST["reviewers"])) {
            $proposal=MgfProposal::findOne($id);
            foreach ($_POST["reviewers"] as $pe) {
                $evalution=MgfProjectEvaluation::findOne($pe);
                $reviewer=MgfReviewer::findOne(['user_id'=>$evalution->reviewedby]);
                if($evalution->delete()){
                    $proposalcount=MgfProjectEvaluation::find()->where(['proposal_id'=>$id])->count();
                    MgfProposal::updateAll(['number_reviewers' => $proposalcount], 'id='.$id);
                    $reviewer->total_assigned_1=MgfProjectEvaluation::find()->where(['reviewedby'=>$reviewer->user_id,'window'=>1])->count();
                    $reviewer->total_assigned_2=MgfProjectEvaluation::find()->where(['reviewedby'=>$reviewer->user_id,'window'=>2])->count();
                    $reviewer->save();
                }
            }
            Yii::$app->session->setFlash('success', sizeof($_POST["reviewers"])." Reviwers(s) Removed Successfully!!");
            return $this->redirect(['/mgf-reviewer/assigned','id'=>$id]);
        }else{
            Yii::$app->session->setFlash('error', 'Please select Reviewer(s) to Assign');
            return $this->redirect(['/mgf-reviewer/assigned','id'=>$id]);
        }
    }


    public function actionReviewers($id){
        $proposal=MgfProposal::findOne($id);
        $assinged = ArrayHelper::getColumn(MgfProjectEvaluation::find()->where(['proposal_id'=>$id])->select(['reviewedby'])->asArray()->all(),'reviewedby');
        $reviewers=MgfReviewer::find()->where(['NOT IN','user_id',$assinged])->andWhere(['area_of_expertise'=>$proposal->project_operations])->all();
        return $this->render('reviewers',['reviewers'=>$reviewers,'proposal'=>$proposal,'assigned'=>'NO']);
    }

    public function actionReviewersOther($id){
        $proposal=MgfProposal::findOne($id);
        $assinged = ArrayHelper::getColumn(MgfProjectEvaluation::find()->where(['proposal_id'=>$id])->select(['reviewedby'])->asArray()->all(),'reviewedby');
        $reviewers=MgfReviewer::find()->where(['NOT IN','user_id',$assinged])->andWhere(['NOT IN','area_of_expertise',$proposal->project_operations])->all();
        return $this->render('reviewers',['reviewers'=>$reviewers,'proposal'=>$proposal,'assigned'=>'NO']);
    }


    public function actionAssigned($id){
        $proposal=MgfProposal::findOne($id);      
        $reviewers = MgfProjectEvaluation::find()->joinWith('reviewedby0')->where(['proposal_id'=>$id])->all();
        return $this->render('reviewers',['proposal'=>$proposal,'reviewers'=>$reviewers,'assigned'=>'YES']);
    }

    /**
     * Updates an existing MgfReviewer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing MgfReviewer model.
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
     * Finds the MgfReviewer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MgfReviewer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MgfReviewer::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
