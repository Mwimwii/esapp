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
                'only' => ['index', 'create', 'createpw','update', 'delete', 'view', 'declinep'],
                'rules' => [
                    [
                        'actions' => ['index', 'create','createpw', 'update', 'delete', 'view', 'declinep'],
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
    
    
      public function actionCreate($id,$id2,$id3,$status) {
        //if (User::userIsAllowedTo('Manage camps')) {
            $user = User::findOne(['id' => Yii::$app->user->id]);
          $template_model = \backend\models\AwpbTemplate::find()->where(['status' => \backend\models\AwpbTemplate::STATUS_PUBLISHED])->one();
          if(!empty($template_model)){
            $model = new AwpbComment();
            if (Yii::$app->request->isAjax) {
                $model->load(Yii::$app->request->post());
                return Json::encode(\yii\widgets\ActiveForm::validate($model));
            }

            if ($model->load(Yii::$app->request->post())) {
                
                 $activity_model = \backend\models\AwpbActivity::find()->where(['id' =>$id])->one();
              $model->awpb_template_id =  $template_model->id;
                $model->activity_id = $id;
                $model->district_id = $id2;
                        $model->province_id = $id3;
                $model->created_by = Yii::$app->user->identity->id;
                $model->updated_by = Yii::$app->user->identity->id;
                if ($model->save()) {
                    $audit = new AuditTrail();
                    $audit->user = Yii::$app->user->id;
                    $audit->action = "Added comment " . $model->description;
                    $audit->ip_address = Yii::$app->request->getUserIP();
                    $audit->user_agent = Yii::$app->request->getUserAgent();
                    $audit->save();
                    Yii::$app->session->setFlash('success', 'Comment :' . $model->description. ' was successfully added.');
                } else {
                    Yii::$app->session->setFlash('error', 'Error occured while adding comment ' . $model->decription);
                }
                if($user->province_id == 0 || $user->province_id == '')
                {
                    return $this->redirect(['awpb-budget/pwcasub', 'status' => $status, 'id' => $activity_model->parent_activity_id, 'id2' =>$id2]);
                }
                elseif ($user->province_id > 0 || $user->province_id !== ''){
                
            
                    return $this->redirect(['awpb-budget/mpcd', 'status' => $status, 'id' => $id3, 'id2' =>$id2]);
                }
                //return $this->redirect(['pwcasub', 'id' => $model->activity_id,'status' => $status]);
            }
            return $this->render('create', [
                        'model' => $model,
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'No AWPB Tempate has been published.');
            return $this->redirect(['home/home']);
        }
    }
           public function actionCreatepw2($id,$id2,$id3,$status) {
        //if (User::userIsAllowedTo('Manage camps')) {
          $template_model = \backend\models\AwpbTemplate::find()->where(['status' => \backend\models\AwpbTemplate::STATUS_PUBLISHED])->one();
          if(!empty($template_model)){
            $model = new AwpbComment();
            if (Yii::$app->request->isAjax) {
                $model->load(Yii::$app->request->post());
                return Json::encode(\yii\widgets\ActiveForm::validate($model));
            }

            if ($model->load(Yii::$app->request->post())) {
              $model->awpb_template_id =  $template_model->id;
                $model->activity_id = $id;
               // $model->district_id = $id2;
                 //       $model->province_id = $id3;
                $model->created_by = Yii::$app->user->identity->id;
                $model->updated_by = Yii::$app->user->identity->id;
                if ($model->save()) {
                    $audit = new AuditTrail();
                    $audit->user = Yii::$app->user->id;
                    $audit->action = "Added comment " . $model->description;
                    $audit->ip_address = Yii::$app->request->getUserIP();
                    $audit->user_agent = Yii::$app->request->getUserAgent();
                    $audit->save();
                    Yii::$app->session->setFlash('success', 'Comment :' . $model->description. ' was successfully added.');
                } else {
                    Yii::$app->session->setFlash('error', 'Error occured while adding comment ' . $model->decription);
                }
               // return $this->redirect(['awpb-budget/mpcd', 'status' => $status, 'id' => $id3, 'id2' =>$id2]);
                return $this->redirect(['pwcasub', 'id' => $model->activity_id,'status' => $status]);
            }
            return $this->render('createpw', [
                        'model' => $model,
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'No AWPB Tempate has been published.');
            return $this->redirect(['home/home']);
        }
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
            $returnpage = "";
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
                    } else {
                        Yii::$app->session->setFlash('error', 'Error occured while adding declining the AWPB');
                        //  eturn $this->redirect(['home/home']);


                        return $this->redirect(['awpb-budget/' . $returnpage]);
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
                    return $this->redirect(['awpb-budget/' . $returnpage,
                                'id' => $id,
                                'id2' => $id]);
                } else {
                    $message = "";
                    foreach ($model->getErrors() as $error) {
                        $message .= $error[0];
                    }
                    Yii::$app->session->setFlash('error', 'Error occured while adding declining the AWPB::' . $message);
                    //  eturn $this->redirect(['home/home']);


                    return $this->redirect(['awpb-budget/' . $returnpage]);
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

    public function actionDeclinepw($id) {

        $user = User::findOne(['id' => Yii::$app->user->id]);
        $email_status = 0;
        $awpb_template = \backend\models\AwpbTemplate::find()->where(['status' => \backend\models\AwpbTemplate::STATUS_PUBLISHED])->one();
        if (User::userIsAllowedTo('Approve AWPB - PCO') || User::userIsAllowedTo('Approve AWPB - Ministry')) {
            $returnpage = "";
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

                if (User::userIsAllowedTo('Approve AWPB - PCO') && ( $user->province_id == 0 || $user->province_id == '')) {
                    //   $dataProvider->query->andFilterWhere(['awpb_template_id' => $awpb_template->id, 'province_id' => $id, 'status' => AwpbBudget::STATUS_REVIEWED,]);
                    //  $activitylines = AwpbBudget::find()->where(['province_id' => $id])->andWhere(['awpb_template_id' => $awpb_template->id])->andWhere(['status' => AwpbBudget::STATUS_REVIEWED])->all();
                    $returnpage = "pwc";
                    $right = "Manage PW AWPB";
                    $dear = "Dear Officer";
                    $bodymsg = "Your ";
                    $bodymsg1 = " has been declined.";
                    $subject = $awpb_template->fiscal_year . " AWPB declined";
                    $awpb_template_user = \backend\models\AwpbTemplateUsers::findOne(['awpb_template_id' => $awpb_template->id, 'user_id' => $id]);
                    $id = $user->id;
                    $awpb_template_user->status_budget = AwpbBudget::STATUS_DRAFT;
                    $awpb_template_user->save();
                    $email_status == 1;
                    
                } elseif (User::userIsAllowedTo('Approve AWPB - Ministry') && ($user->province_id == 0 || $user->province_id == '')) {
                    // $dataProvider->query->andFilterWhere(['awpb_template_id' => $awpb_template->id, 'province_id' => $id, 'status' => AwpbBudget::STATUS_APPROVED,]);
                    // $activitylines = AwpbBudget::find()->where(['province_id' => $id])->andWhere(['awpb_template_id' => $awpb_template->id])->andWhere(['status' => AwpbBudget::STATUS_APPROVED])->all();
                    $returnpage = "pwc";
                    $right = "Approve AWPB - PCO";
                    $dear = "Dear PCO";
                    $bodymsg = "Your ";
                    $bodymsg1 = " has been declined.";
                     $subject = $awpb_template->fiscal_year . " AWPB declined";
                   

                    $awpb_template_component = \backend\models\AwpbTemplateComponent::find(['awpb_template_id' => $awpb_template->id])->all();

                    if (!empty($awpb_template_component)) {
                        foreach ($awpb_template_component as $component) {
                            $component->status = AwpbBudget::STATUS_DRAFT;

                            $component->save();
                        }
                    }


                    $_awpb_template_user = \backend\models\AwpbTemplateUsers::find(['awpb_template_id' => $awpb_template->id])->all();

                    if (!empty($_awpb_template_user)) {
                        foreach ($_awpb_template_user as $awpb_template_user) {
                            $awpb_template_user->status_budget = AwpbBudget::STATUS_SUBMITTED;

                            $awpb_template_user->save();
                        }
                    }
                    $email_status == 1;
                } else {
                    Yii::$app->session->setFlash('error', 'Error occured while adding declining the AWPB');
                    return $this->redirect(['home/home']);

                    //return $this->redirect(['awpb-budget/' . $returnpage]);
                }


                // if (Yii::$app->request->isAjax) {
                //     $model->load(Yii::$app->request->post());
                //     return Json::encode(\yii\widgets\ActiveForm::validate($model));
                // }

                if ($email_status == 1) {
                    $role_model = \common\models\RightAllocation::find()->where(['right' => $right])->all();
                    if (!empty($role_model)) {

                        foreach ($role_model as $_role) {
                            //We now get all users with the fetched role
                            //  $resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/login']);

                            $_user_model = "";
                        }
                        if ((User::userIsAllowedTo('Approve AWPB - PCO') || User::userIsAllowedTo('Approve AWPB - Ministry')) && ($user->province_id == 0 || $user->province_id == '')) {

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
                }}
      Yii::$app->session->setFlash('success', 'The AWPB has been declined.');
                    return $this->redirect(['awpb-budget/' . $returnpage,
                                'id' => $id,
                                'id2' => $id]);
             
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
