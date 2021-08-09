<?php

namespace backend\controllers;

use Yii;
use backend\models\AwpbComment;
use backend\models\AwpbCommentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Json;
use backend\models\AuditTrail;
use backend\models\User;
use backend\models\AwpbBudget;
use backend\models\AwpbBudgetSearch;
use backend\models\Camps;
use backend\models\Storyofchange;

/**
 * AwpbCommentController implements the CRUD actions for AwpbComment model.
 */
class AwpbCommentController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'create', 'update', 'delete', 'view', 'declinep'],
                'rules' => [
                    [
                        'actions' => ['index', 'create', 'update', 'delete', 'view', 'declinep'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
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
     * Lists all AwpbComment models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new AwpbCommentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AwpbComment model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    public function actionDeclinep($id) {

        $user = User::findOne(['id' => Yii::$app->user->id]);
        

//        if (User::userIsAllowedTo("Submit District AWPB") || User::userIsAllowedTo('Approve AWPB - Provincial') || User::userIsAllowedTo('Approve AWPB - PCO') || User::userIsAllowedTo('Approve AWPB - Ministry')) {
//            $right = "";
//            $returnpage = "";
//            $activitylines = "";
//            $subject = "";
//            $province = "";
//            $awpb_template = \backend\models\AwpbTemplate::find()->where(['status' => \backend\models\AwpbTemplate::STATUS_PUBLISHED])->one();
//            $model = new AwpbBudget();
//            $searchModel = new AwpbBudgetSearch();
//            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
//            $user = User::findOne(['id' => Yii::$app->user->id]);
//            $pro = \backend\models\Provinces::findOne($id);
//            $status1 = 0;
//            if (!empty($pro)) {
//                $province = $pro->name;
//            }
        $awpb_template = \backend\models\AwpbTemplate::find()->where(['status' => \backend\models\AwpbTemplate::STATUS_PUBLISHED])->one();
         if (User::userIsAllowedTo('Approve AWPB - Provincial') || User::userIsAllowedTo('Approve AWPB - PCO') || User::userIsAllowedTo('Approve AWPB - Ministry')) {
        $returnpage="";
        $model = new \backend\models\AwpbComment();
        
        if (Yii::$app->request->isAjax) {
                $model->load(Yii::$app->request->post());
                return Json::encode(\yii\widgets\ActiveForm::validate($model));
            }

            if ($model->load(Yii::$app->request->post())) {
                $model->awpb_template_id = $awpb_template->id;
                $model->created_by = Yii::$app->user->identity->id;
                $model->updated_by = Yii::$app->user->identity->id;
                //var_dump($id .' '.$user->province_id);
                if ($model->save()) {
                    $province = "";
                    $pro = \backend\models\Provinces::findOne(['id' => $model->province_id]);

                    if (!empty($pro)) {
                        $province = $pro->name;
                    }
            if (User::userIsAllowedTo("Approve AWPB - Provincial") && ($user->province_id > 0 || $user->province_id !== '')) {
               // $dataProvider->query->andFilterWhere(['awpb_template_id' => $awpb_template->id, 'district_id' => $id, 'status' => AwpbBudget::STATUS_SUBMITTED,]);
               // $activitylines = AwpbBudget::find()->where(['district_id' => $id])->andWhere(['awpb_template_id' => $awpb_template->id])->andWhere(['status' => AwpbBudget::STATUS_SUBMITTED])->all();
                $returnpage = 'mpc';
                //$province = \backend\models\Provinces::findOne($id2)->name;
                $right = "Submit District AWPB";
                $dear = "Dear District Officer";
                $bodymsg = "Your ";
                $bodymsg1 = " has been declined.";
                //$subject = $awpb_template->fiscal_year . "AWPB for " . $district . " district declined";
                $subject = $awpb_template->fiscal_year . "AWPB for  district declined";
                $status1 = AwpbBudget:: STATUS_DRAFT;
                $loca = "district_id";
                $id2 = $user->province_id;
                $awpb_district = \backend\models\AwpbDistrict::findOne(['awpb_template_id' => $awpb_template->id, 'district_id' => $id]);
                $awpb_district->status = AwpbBudget::STATUS_DRAFT;
               
                $model->updated_by = Yii::$app->user->id;
                $awpb_district->save();
               
                $awpb_province = \backend\models\AwpbProvince::findOne(['awpb_template_id' => $awpb_template->id, 'province_id' => $user->province_id]);
                $awpb_province->status = AwpbBudget::STATUS_DRAFT;
                $awpb_province->save();
                   //  Yii::$app->session->setFlash('error', 'Error occured while adding declining the AWPB'.$awpb_district->district_id. ' '.$awpb_district->awpb_template_id);
                $status = AwpbBudget::STATUS_DRAFT;
            } elseif (User::userIsAllowedTo('Approve AWPB - PCO') && ( $user->province_id == 0 || $user->province_id == '')) {
             //   $dataProvider->query->andFilterWhere(['awpb_template_id' => $awpb_template->id, 'province_id' => $id, 'status' => AwpbBudget::STATUS_REVIEWED,]);
              //  $activitylines = AwpbBudget::find()->where(['province_id' => $id])->andWhere(['awpb_template_id' => $awpb_template->id])->andWhere(['status' => AwpbBudget::STATUS_REVIEWED])->all();
                $returnpage = "mp";
                $right = "Approve AWPB - Provincial";
                $dear = "Dear Provincial Officer";
                $bodymsg = "Your ";
                $bodymsg1 = " has been declined.";
                $subject = $awpb_template->fiscal_year . " AWPB declined";
                $status1 = AwpbBudget::STATUS_SUBMITTED;
                $loca = "province_id";
                $awpb_province = \backend\models\AwpbProvince::findOne(['awpb_template_id' => $awpb_template->id, 'province_id' => $id]);
                $awpb_province->status = AwpbBudget::STATUS_SUBMITTED;
                $awpb_province->save();
                $status = AwpbBudget::STATUS_SUBMITTED;
            } elseif (User::userIsAllowedTo('Approve AWPB - Ministry') && ($user->province_id == 0 || $user->province_id == '')) {
               // $dataProvider->query->andFilterWhere(['awpb_template_id' => $awpb_template->id, 'province_id' => $id, 'status' => AwpbBudget::STATUS_APPROVED,]);
               // $activitylines = AwpbBudget::find()->where(['province_id' => $id])->andWhere(['awpb_template_id' => $awpb_template->id])->andWhere(['status' => AwpbBudget::STATUS_APPROVED])->all();
                $returnpage = "mp";
                $right = "Approve AWPB - PCO";
                $dear = "Dear PCO";
                $bodymsg = "Your ";
                $bodymsg1 = " has been declined.";
                $subject = $province . " " . $awpb_template->fiscal_year . "AWPB declined";
                $status1 = AwpbBudget:: STATUS_REVIEWED;
                $loca = "province_id";
                $awpb_province = \backend\models\AwpbProvince::findOne(['awpb_template_id' => $awpb_template->id, 'province_id' => $id]);
                $awpb_province->status = AwpbBudget::STATUS_REVIEWED;
                $awpb_province->save();
                $status = AwpbBudget::STATUS_REVIEWED;
            }
            else
            {
                 Yii::$app->session->setFlash('error', 'Error occured while adding declining the AWPB');
                    //  eturn $this->redirect(['home/home']);


                    return $this->redirect(['awpb-budget/'. $returnpage ]);
            }
            

            // if (Yii::$app->request->isAjax) {
            //     $model->load(Yii::$app->request->post());
            //     return Json::encode(\yii\widgets\ActiveForm::validate($model));
            // }
  

                    $role_model = \common\models\RightAllocation::find()->where(['right' => $right])->all();
                    if (!empty($role_model)) {

                        foreach ($role_model as $_role) {
                            //We now get all users with the fetched role
                            //  $resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/login']);

                            $_user_model = "";
                        }
                        if (((User::userIsAllowedTo('Approve AWPB - PCO') && $status == \backend\models\AwpbBudget::STATUS_SUBMITTED) || (User::userIsAllowedTo('Approve AWPB - Ministry') && $status == \backend\models\AwpbBudget::STATUS_REVIEWED )) && ($user->province_id == 0 || $user->province_id == '')) {

                            $_user_model = User::find()
                                    ->where(['role' => $_role->role])
                                    ->all();
                        } else {

                            $_user_model = User::find()
                                    ->where(['role' => $_role->role])
                                    ->andWhere([$loca => $id])
                                    ->all();
                        }
                        if (!empty($_user_model)) {
                            //We send the emails

                            foreach ($_user_model as $_model) {
                                $msg = "";
                                $msg .= "<p>" . $dear . ",<br/><br/>";
                                $msg .= $bodymsg . " " . $awpb_template->fiscal_year . " Annual Work Plan and Budget" . $bodymsg1 . "<br/><br/>";
                                //  $msg .=  $model->description . "<br/><br/>";
                                //  $msg .= "Story category:<b>" . \backend\models\LkmStoryofchangeCategory::findOne($model->category)->name . "</b><br/>";
                                // $msg .= "Kindly address the issues and resubmit.<br/><br/>";
                                // $msg .= "Interviewer:<b>" . $model->interviewer_names . "</b><br/>";
                                $msg .= "Yours sincerely,<br/><br/></p>";
                                $msg .= '<p>' . $user->title . ' ' . $user->first_name . ' ' . $user->last_name . '</p>';
                                Storyofchange::sendEmail($msg, $subject, $_model->email);
                             $msg = "";
                                            $msg .= "<p>" . $dear . ",<br/><br/>";
                                            $msg .= $bodymsg . " " . $awpb_template->fiscal_year . " Annual Work Plan and Budget" . $bodymsg1 . " due to the following:<br/><br/>";
                                           
                                            $msg .= $model->description . "<br/><br/>";
                                            //  $msg .= "Story category:<b>" . \backend\models\LkmStoryofchangeCategory::findOne($model->category)->name . "</b><br/>";
                                            $msg .= "Kindly address the issues and resubmit.<br/><br/>";
                                            // $msg .= "Interviewer:<b>" . $model->interviewer_names . "</b><br/>";
                                            $msg .= "Yours sincerely,<br/><br/></p>";
                                            $msg .= '<p>' . $user->title . ' ' . $user->first_name . ' ' . $user->last_name . '</p>';
                                            Storyofchange::sendEmail($msg, $subject, $_model->email);
                                
                                
                            }
                        }
                    }
                
                Yii::$app->session->setFlash('success', 'The AWPB has been declined.');
                return $this->redirect(['awpb-budget/'.$returnpage,
                        'id'=>$id,
                    'id2'=>$id]);
                
                 } else {
                    $message = "";
                    foreach ($model->getErrors() as $error) {
                        $message .= $error[0];
                    }
                    Yii::$app->session->setFlash('error', 'Error occured while adding declining the AWPB::' . $message);
                    //  eturn $this->redirect(['home/home']);


                    return $this->redirect(['awpb-budget/'. $returnpage ]);
            }
            }
                        return $this->render('declinep', [
                        'model' => $model,
                        'id' => $id,
            ]);
//                
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            //return $this->redirect(['home/home']);
        }
    }

    public function actionDeclinepk($id) {
        // public function actionDecline($district_id,$awpb_template_id) {
        //$district_id=48;
        // Yii::$app->session->setFlash('success', 'AWPB comment ' .$district.'was successfully added.');
        $user = User::findOne(['id' => Yii::$app->user->id]);
        $awpb_template = \backend\models\AwpbTemplate::find()->where(['status' => \backend\models\AwpbTemplate::STATUS_PUBLISHED])->one();
        $model = new \backend\models\AwpbComment();
        if (User::userIsAllowedTo('Approve AWPB - Provincial') || User::userIsAllowedTo('Approve AWPB - PCO') || User::userIsAllowedTo('Approve AWPB - Ministry')) {
        if (User::userIsAllowedTo('Approve AWBP - PCO') && $user->province_id == 0 || $user->province_id == '') {
            
        } elseif
        (User::userIsAllowedTo('Approve AWPB - Ministry') && ($user->province_id == 0 || $user->province_id == '')) {
            
        }

//            $status = AwpbBudget::STATUS_SUBMITTED;
//            $searchModel = new AwpbBudget();
//            $query = $searchModel::find();
//            $dear = "";
//
//            $query->select(['awpb_template_id', 'province_id', 'district_id', 'SUM(quarter_one_amount) as quarter_one_amount', 'SUM(quarter_two_amount) as quarter_two_amount', 'SUM(quarter_three_amount) as quarter_three_amount', 'SUM(quarter_four_amount) as quarter_four_amount', 'SUM(total_amount) as total_amount']);
//            $query->where(['province_id' => $model->province_id, 'awpb_template_id' =>     $awpb_template->id, 'status' => AwpbBudget::STATUS_REVIEWED]);
//            $status = AwpbBudget::STATUS_SUBMITTED;
            $dear = "<p>Dear Budget Committee,<br/><br/>";
//
//            // elseif(User::userIsAllowedTo('Approve AWBP - Ministry'))
//            // {
//            //     $query->select(['awpb_template_id','province_id','district_id','SUM(quarter_one_amount) as quarter_one_amount','SUM(quarter_two_amount) as quarter_two_amount','SUM(quarter_three_amount) as quarter_three_amount','SUM(quarter_four_amount) as quarter_four_amount','SUM(total_amount) as total_amount']);
//            //     $query->where(['province_id'=>$model->province_id, 'awpb_template_id' =>$model->awpb_template_id,'status' => AwpbBudget::STATUS_APPROVED]);
//            //     $status=AWPBActivityLine::STATUS_REVIEWED;
//            //     $dear .= "<p>Dear ESAPP,<br/><br/>";
//            // }
//            //  $query->where('province_id = :field1', [':field1' =>$user->province_id]);
//            // $query->groupBy('district_id');
//            $query->all();
//
//            $dataProvider = new ActiveDataProvider([
//                'query' => $query,
//            ]);

            if (Yii::$app->request->isAjax) {
                $model->load(Yii::$app->request->post());
                return Json::encode(\yii\widgets\ActiveForm::validate($model));
            }

            if ($model->load(Yii::$app->request->post())) {
                $model->awpb_template_id = $awpb_template->id;
                $model->created_by = Yii::$app->user->identity->id;
                $model->updated_by = Yii::$app->user->identity->id;

                if ($model->save()) {
                    $province = "";
                    $pro = \backend\models\Provinces::findOne(['id' => $model->province_id]);

                    if (!empty($pro)) {
                        $province = $pro->name;
                    }
                    $awpb_province = \backend\models\AwpbProvince::findOne(['awpb_template_id' => $awpb_template->id, 'province_id' => $model->province_id]);
                    $awpb_province->status = AwpbBudget::STATUS_SUBMITTED;
                    $awpb_province->save();
                                    

                            $audit = new AuditTrail();
                            $audit->user = Yii::$app->user->id;
                            //   $audit->action = "Added AWPB Commen for ".$district;
                            $audit->ip_address = Yii::$app->request->getUserIP();
                            $audit->user_agent = Yii::$app->request->getUserAgent();
                            $audit->save();
                            Yii::$app->session->setFlash('success', $province . ' province AWPB was declined.');

                            //We send an email informing IKM Officers that a story has been submited for review
                            //We first get roles with the permission to review stories
                            $role_model = \common\models\RightAllocation::find()->where(['right' => 'Approve AWPB - Provincial'])->all();
                            if (!empty($role_model)) {
                                $subject = $province . " province AWPB declined";
                                foreach ($role_model as $_role) {
                                    //We now get all users with the fetched role
                                    //  $resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/login']);
                                    $_user_model = User::find()
                                            ->where(['role' => $_role->role])
                                            ->andWhere(['province_id' => $model->province_id])
                                            ->all();
                                    if (!empty($_user_model)) {
                                        //We send the emails
                                        //     $user = User::findOne(['id' => Yii::$app->user->id]);
                                        foreach ($_user_model as $_model) {
                                            $msg = "";
                                            $msg .= $dear;
                                            $msg .= "Your budget has been declined due to the following:<br/><br/>";
                                            $msg .= $model->description . "<br/><br/>";
                                            //  $msg .= "Story category:<b>" . \backend\models\LkmStoryofchangeCategory::findOne($model->category)->name . "</b><br/>";
                                            $msg .= "Kindly address the issues and resubmit.<br/><br/>";
                                            // $msg .= "Interviewer:<b>" . $model->interviewer_names . "</b><br/>";
                                            $msg .= "Yours sincerely,<br/><br/></p>";
                                            $msg .= '<p>' . $user->title . ' ' . $user->first_name . ' ' . $user->last_name . '</p>';
                                            Storyofchange::sendEmail($msg, $subject, $_model->email);
                                        }
                                    }
                                }
                            }

                          


                    return $this->redirect(['awpb-budget/mp']);
                } else {
                    $message = "";
                    foreach ($model->getErrors() as $error) {
                        $message .= $error[0];
                    }
                    Yii::$app->session->setFlash('error', 'Error occured while adding AWPB comment::' . $message);
                    //  eturn $this->redirect(['home/home']);


                    return $this->redirect(['awpb-budget/mp']);
                }
            }

            return $this->render('declinep', [
                        'model' => $model,
                        'id' => $id,
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing AwpbComment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AwpbComment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AwpbComment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = AwpbComment::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}