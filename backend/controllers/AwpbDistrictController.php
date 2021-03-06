<?php

namespace backend\controllers;

use Yii;
use backend\models\AwpbDistrict;
use backend\models\AwpbDistrictSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use backend\models\AuditTrail;
use backend\models\User;

use backend\models\Storyofchange;






/**
 * AwpbDistrictController implements the CRUD actions for AwpbDistrict model.
 */
class AwpbDistrictController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
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
     * Lists all AwpbDistrict models.
     * @return mixed
     */
    public function actionSubmith($id, $id2, $id3) {

        $user = User::findOne(['id' => Yii::$app->user->id]);
        $right = "";
        $audit_mgs = "";
        $bodymsg = "";
        $bodymsg1 = "";
        $loca = "district_id";
        $page = "";
        if (User::userIsAllowedTo("Request Funds") || User::userIsAllowedTo("Approve Funds Requisition") || User::userIsAllowedTo("Disburse Funds")) {

            $funds_requisition = AwpbDistrict::findOne(['awpb_template_id' => $id, 'district_id' => $id2]);

            $awpb_template = \backend\models\AwpbTemplate::findOne(['id' => $id]);
         
            $query = (new \yii\db\Query());
            
            $query->from('awpb_input');
            $query->where(['awpb_template_id' => $id]);
            $query->andWhere(['district_id' => $id2]);

            if ($id3 == 1) {

                $ms = "Quarter One";

                if (($user->district_id != 0 || $user->district_id != "") && User::userIsAllowedTo("Request Funds")) {
                    $funds_requisition->status_q_1 = \backend\models\AwpbDistrict::STATUS_QUARTER_REQUESTED;
                    $quarter_amount = !empty($query->sum('quarter_one_amount')) ? $query->sum('quarter_one_amount') : 0;

                    $funds_requisition->quarter_one_amount = $quarter_amount;
                    $page = "index_1";
                }
                if (($user->province_id == 0 || $user->province_id == "") && User::userIsAllowedTo("Approve Funds Requisition")) {
                    $page = "index_2";
                    $funds_requisition->status_q_1 = \backend\models\AwpbDistrict::STATUS_QUARTER_APPROVED;
                } elseif (($user->province_id == 0 || $user->province_id == "") && User::userIsAllowedTo("Disburse Funds")) {
                    $page = "index_4";
                    $funds_requisition->status_q_1 = \backend\models\AwpbDistrict::STATUS_QUARTER_DISBURSED;
                } else {
                    
                }
            }
            if ($id3 == 2) {

                $ms = "Quarter Two";

                //       $funds_requisition->status_q_2 = \backend\models\AwpbDistrict::STATUS_QUARTER_REQUESTED;

                if (($user->district_id != 0 || $user->district_id != "") && User::userIsAllowedTo("Request Funds")) {
                    $quarter_amount = !empty($query->sum('quarter_two_amount')) ? $query->sum('quarter_two_amount') : 0;

                    $funds_requisition->status_q_2 = \backend\models\AwpbDistrict::STATUS_QUARTER_REQUESTED;

                    $funds_requisition->quarter_two_amount = $quarter_amount;
                }
                if (($user->province_id == 0 || $user->province_id == "") && User::userIsAllowedTo("Approve Funds Requisition")) {

                    $funds_requisition->status_q_2 = \backend\models\AwpbDistrict::STATUS_QUARTER_APPROVED;
                } elseif (($user->province_id == 0 || $user->province_id == "") && User::userIsAllowedTo("Disburse Funds")) {

                    $funds_requisition->status_q_2 = \backend\models\AwpbDistrict::STATUS_QUARTER_DISBURSED;
                } else {
                    
                }
            } if ($id3 == 3) {
                $ms = "Quarter Three";

                //       $funds_requisition->status_q_2 = \backend\models\AwpbDistrict::STATUS_QUARTER_REQUESTED;

                if (($user->district_id != 0 || $user->district_id != "") && User::userIsAllowedTo("Request Funds")) {

                    $quarter_amount = !empty($query->sum('quarter_three_amount')) ? $query->sum('quarter_three_amount') : 0;

                    $funds_requisition->quarter_three_amount = $quarter_amount;
                    $funds_requisition->status_q_3 = \backend\models\AwpbDistrict::STATUS_QUARTER_REQUESTED;
                }
                if (($user->province_id == 0 || $user->province_id == "") && User::userIsAllowedTo("Approve Funds Requisition")) {

                    $funds_requisition->status_q_3 = \backend\models\AwpbDistrict::STATUS_QUARTER_APPROVED;
                } elseif (($user->province_id == 0 || $user->province_id == "") && User::userIsAllowedTo("Disburse Funds")) {

                    $funds_requisition->status_q_3 = \backend\models\AwpbDistrict::STATUS_QUARTER_DISBURSED;
                } else {
                    
                }
            }
            if ($id3 == 4) {
                $ms = "Quarter Four";

                //       $funds_requisition->status_q_2 = \backend\models\AwpbDistrict::STATUS_QUARTER_REQUESTED;

                if (($user->district_id != 0 || $user->district_id != "") && User::userIsAllowedTo("Request Funds")) {


                    $quarter_amount = !empty($query->sum('quarter_four_amount')) ? $query->sum('quarter_four_amount') : 0;

                    $funds_requisition->quarter_four_amount = $quarter_amount;
                    $funds_requisition->status_q_4 = \backend\models\AwpbDistrict::STATUS_QUARTER_REQUESTED;
                }
                if (($user->province_id == 0 || $user->province_id == "") && User::userIsAllowedTo("Approve Funds Requisition")) {

                    $funds_requisition->status_q_4 = \backend\models\AwpbDistrict::STATUS_QUARTER_APPROVED;
                } elseif (($user->province_id == 0 || $user->province_id == "") && User::userIsAllowedTo("Disburse Funds")) {

                    $funds_requisition->status_q_4 = \backend\models\AwpbDistrict::STATUS_QUARTER_DISBURSED;
                } else {
                    
                }
            }
//            $quarter_one_amount = $query->quarter_one_amount;  
//            $quarter_two_amount = $query->quarter_two_amount;
//            $quarter_three_amount = $query->quarter_three_amount;
//            $quarter_four_amount = $query->quarter_four_amount;

            if (($user->district_id != 0 || $user->district_id != "") && User::userIsAllowedTo("Request Funds") && ($funds_requisition->status_q_1 == \backend\models\AwpbDistrict::STATUS_QUARTER_OPEN || $funds_requisition->status_q_2 == \backend\models\AwpbDistrict::STATUS_QUARTER_OPEN || $funds_requisition->status_q_3 == \backend\models\AwpbDistrict::STATUS_QUARTER_OPEN || $funds_requisition->status_q_4 == \backend\models\AwpbDistrict::STATUS_QUARTER_OPEN)) {
                //$funds_requisition->funds_request =  AwpbDistrict::STATUS_FUNDS_REQUESTED;
                $rigt = "Request Funds";
                $audit_mgs = "The quarterly funds requisition has been submitted.";
                $bodymsg = "The funds requisition for ";
                $bodymsg1 = " has been submitted.";
            }
            if (($user->province_id == 0 || $user->province_id == "") && User::userIsAllowedTo("Approve Funds Requisition") && ($funds_requisition->status_q_1 == \backend\models\AwpbDistrict::STATUS_QUARTER_REQUESTED || $funds_requisition->status_q_2 == \backend\models\AwpbDistrict::STATUS_QUARTER_REQUESTED || $funds_requisition->status_q_3 == \backend\models\AwpbDistrict::STATUS_QUARTER_REQUESTED || $funds_requisition->status_q_4 == \backend\models\AwpbDistrict::STATUS_QUARTER_REQUESTED)) {
                // $funds_requisition->funds_request =  AwpbDistrict::STATUS_FUNDS_REQUEST_APPROVED;

                $rigt = "Request Funds";
                $audit_mgs = "The quarterly funds requisition has been approved.";
                $bodymsg = "The funds for ";
                $bodymsg1 = " have been approved.";
            }
            if (($user->province_id == 0 || $user->province_id == "") && User::userIsAllowedTo("Disburse Funds") && ($funds_requisition->status_q_1 == \backend\models\AwpbDistrict::STATUS_QUARTER_APPROVED || $funds_requisition->status_q_2 == \backend\models\AwpbDistrict::STATUS_QUARTER_APPROVED || $funds_requisition->status_q_3 == \backend\models\AwpbDistrict::STATUS_QUARTER_APPROVED || $funds_requisition->status_q_4 == \backend\models\AwpbDistrict::STATUS_QUARTER_APPROVED)) {
                // $funds_requisition->funds_request =  AwpbDistrict::STATUS_FUNDS_REQUEST_APPROVED;

                $rigt = "Request Funds";
                $audit_mgs = "The quarterly funds requisition has been disbursed.";
                $bodymsg = "The funds for ";
                $bodymsg1 = " have been disbursed.";
            }


            if ($funds_requisition->save()) {

                $role_model = \common\models\RightAllocation::find()->where(['right' => $right])->all();
                if (!empty($role_model)) {

                    foreach ($role_model as $_role) {
                        //We now get all users with the fetched role
                        //  $resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/login']);

                        $_user_model = "";

                        $_user_model = User::find()
                                ->where(['role' => $_role->role])
                                ->andWhere([$loca => $id2])
                                ->all();

                        if (!empty($_user_model)) {
                            //We send the emails

                            foreach ($_user_model as $_model) {
                                $msg = "";
                                $msg .= "<p>" . $dear . ",<br/><br/>";
                                $msg .= $bodymsg . " " . $awpb_template->fiscal_year . " " . $ms . " Annual Work Plan and Budget" . $bodymsg1 . "<br/><br/>";
                                //  $msg .=  $model->description . "<br/><br/>";
                                //  $msg .= "Story category:<b>" . \backend\models\LkmStoryofchangeCategory::findOne($model->category)->name . "</b><br/>";
                                // $msg .= "Kindly address the issues and resubmit.<br/><br/>";
                                // $msg .= "Interviewer:<b>" . $model->interviewer_names . "</b><br/>";
                                $msg .= "Yours sincerely,<br/><br/></p>";
                                $msg .= '<p>' . $user->title . ' ' . $user->first_name . ' ' . $user->last_name . '</p>';
                                Storyofchange::sendEmail($msg, $subject, $_model->email);
                            }
                        }
                    }
                }


                $audit = new AuditTrail();
                $audit->user = Yii::$app->user->id;
                $audit->action = $ms . " funds requisition " . $bodymsg1;
                $audit->ip_address = Yii::$app->request->getUserIP();
                $audit->user_agent = Yii::$app->request->getUserAgent();
                $audit->save();
                Yii::$app->session->setFlash('success', $ms . " funds requisition " . $bodymsg1);
                return $this->redirect(['awpb-input/' . $page, 'id' => $id, 'id2' => $id2,]);
            } else {
                $message = '';
                foreach ($model->getErrors() as $error) {
                    $message .= $error[0];
                    Yii::$app->session->setFlash('error', "Error occured : " . $message);
                }
            }
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    public function actionSubmit($id, $id2) {
        $user = User::findOne(['id' => Yii::$app->user->id]);
        $template_model = \backend\models\AwpbTemplate::find()->where(['status' => \backend\models\AwpbTemplate::STATUS_CURRENT_BUDGET])->one();
        if (User::userIsAllowedTo('Request Funds') && ( $user->district_id > 0 || $user->district_id != '')) {
            $model = \backend\models\AwpbDistrict::findOne(['awpb_template_id' => $id, 'district_id' => $id2]);
            $model->updated_by = Yii::$app->user->identity->id;
            $model->status = $template_model->quarter;
            if ($template_model->quarter==1)
            {
                $model->status_q_1 = AwpbDistrict::STATUS_QUARTER_OPEN;
            }
             if ($template_model->quarter==2)
            {
                   $model->status_q_2 = AwpbDistrict::STATUS_QUARTER_OPEN;
            }
             if ($template_model->quarter==3)
            {
                   $model->status_q_3 = AwpbDistrict::STATUS_QUARTER_OPEN;
            }
             if ($template_model->quarter==4)
            {
                   $model->status_q_4 = AwpbDistrict::STATUS_QUARTER_OPEN;
            }
            if ($model->save()) {
               
                    $district = \backend\models\Districts::findOne(['id' => $user->district_id])->name;
                    $role_model = \common\models\RightAllocation::find()->where(['right' => "Review Funds Request"])->all();

                    if (!empty($role_model)) {

                        foreach ($role_model as $_role) {
                            //We now get all users with the fetched role
                            //  $resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/login']);

                            $_user_model = "";

                            $_user_model = User::find()
                                    ->where(['role' => $_role->role])
                                    ->andWhere(['province_id' => $user->province_id])
                                    ->all();

                            if (!empty($_user_model)) {
                                //We send the emails
                                $subject = $template_model->fiscal_year . " Q" . $template_model->quarter . " Funds Request for " . $district;
                                foreach ($_user_model as $_model) {


                                    $msg = "";
                                    $msg .= "<p>Dear " . $_model->first_name . " " . $_model->last_name . ",<br/><br/>";
                                    $msg .= "The funds requisition for " . $template_model->fiscal_year . " Annual Work Plan and Budget quarter " . $template_model->quarter . " has been submitted for your review and approval. <br/><br/>";

                                    $msg .= "Yours sincerely,<br/><br/></p>";
                                    $msg .= '<p>' . $user->title . ' ' . $user->first_name . ' ' . $user->last_name . '</p>';
                                    \backend\models\Storyofchange::sendEmail($msg, $subject, $user->email);
                                }
                            }
                        }
                    }
                
                $audit = new AuditTrail();
                $audit->user = Yii::$app->user->id;
                $audit->action = "Funds requisition for " . $template_model->fiscal_year . " Q" . $template_model->quarter . " has been submitted.";
                $audit->ip_address = Yii::$app->request->getUserIP();
                $audit->user_agent = Yii::$app->request->getUserAgent();
                $audit->save();
                Yii::$app->session->setFlash('success', " Funds request has been submitted.");
                //return $this->redirect(['awpb-input/' . $page, 'id' => $id, 'id2' => $id2,]);
                return $this->redirect(['home/home']);
                
            } else {
                $message = '';
                foreach ($model->getErrors() as $error) {
                    $message .= $error[0];
                    Yii::$app->session->setFlash('error', "Error occured : " . $message);
                }
            }
        } 
        
         else if  (User::userIsAllowedTo('Request Funds') && ( $user->province_id == 0 || $user->province_id == '')) {
            $model = \backend\models\AwpbDistrict::findOne(['awpb_template_id' =>  $template_model ->id, 'cost_centre_id' => $id]);
            $model->updated_by = Yii::$app->user->identity->id;
            $model->status = $template_model->quarter;
                if ($template_model->quarter==1)
            {
                $model->status_q_1 = \backend\models\AwpbDistrict::STATUS_QUARTER_OPEN;
            }
             if ($template_model->quarter==2)
            {
                   $model->status_q_2 = \backend\models\AwpbDistrict::STATUS_QUARTER_OPEN;
            }
             if ($template_model->quarter==3)
            {
                   $model->status_q_3 =\backend\models\AwpbDistrict::STATUS_QUARTER_OPEN;
            }
             if ($template_model->quarter==4)
            {
                   $model->status_q_4 = \backend\models\AwpbDistrict::STATUS_QUARTER_OPEN;
            }
            if ($model->save()) {
               
                    $district = \backend\models\AwpbCostCentre::findOne(['id' => $id])->name;
                    $role_model = \common\models\RightAllocation::find()->where(['right' => "Approve Funds Requisition"])->all();

                    if (!empty($role_model)) {

                        foreach ($role_model as $_role) {
                            //We now get all users with the fetched role
                            //  $resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/login']);

                            $_user_model = "";

                            $_user_model = User::find()
                                    ->where(['role' => $_role->role])
                                  //  ->andWhere(['province_id' => $user->province_id])
                                    ->all();

                            if (!empty($_user_model)) {
                                //We send the emails
                                $subject = $template_model->fiscal_year . " Q" . $template_model->quarter . " Funds Request for " . $district;
                                foreach ($_user_model as $_model) {


                                    $msg = "";
                                    $msg .= "<p>Dear " . $_model->first_name . " " . $_model->last_name . ",<br/><br/>";
                                    $msg .= "The funds requisition for " . $template_model->fiscal_year . " Annual Work Plan and Budget quarter " . $template_model->quarter . " has been submitted for your review and approval. <br/><br/>";

                                    $msg .= "Yours sincerely,<br/><br/></p>";
                                    $msg .= '<p>' . $user->title . ' ' . $user->first_name . ' ' . $user->last_name . '</p>';
                                    \backend\models\Storyofchange::sendEmail($msg, $subject, $user->email);
                                }
                            }
                        }
                    }
                
                $audit = new AuditTrail();
                $audit->user = Yii::$app->user->id;
                $audit->action = "Funds requisition for " . $template_model->fiscal_year . " Q" . $template_model->quarter . " has been submitted.";
                $audit->ip_address = Yii::$app->request->getUserIP();
                $audit->user_agent = Yii::$app->request->getUserAgent();
                $audit->save();
                Yii::$app->session->setFlash('success', " Funds request has been submitted.");
           
                 return $this->redirect(['awpb-funds-requisition/qofrpw', 'id'=>0,'id2'=>0,'status'=>0]);
                
            } else {
                $message = '';
                foreach ($model->getErrors() as $error) {
                    $message .= $error[0];
                    Yii::$app->session->setFlash('error', "Error occured : " . $message);
                }
            }
        } 
      

      
        elseif (User::userIsAllowedTo('Review Funds Request') && ( $user->province_id > 0 || $user->province_id != '')) {
             $model = \backend\models\AwpbDistrict::findOne(['awpb_template_id' => $id, 'district_id' => $id2]);
            
            $model->updated_by = Yii::$app->user->identity->id;
            $model->status = $template_model->quarter;
            if ($template_model->quarter==1)
            {
                $model->status_q_1 = AwpbDistrict::STATUS_QUARTER_APPROVED;
            }
             if ($template_model->quarter==2)
            {
                   $model->status_q_2 = AwpbDistrict::STATUS_QUARTER_APPROVED;
            }
             if ($template_model->quarter==3)
            {
                   $model->status_q_3 = AwpbDistrict::STATUS_QUARTER_APPROVED;
            }
             if ($template_model->quarter==4)
            {
                   $model->status_q_4 = AwpbDistrict::STATUS_QUARTER_APPROVED;
            }
                   if ($model->save()) {
                    $district = \backend\models\Districts::findOne(['id' => $id2])->name;
                    $role_model = \common\models\RightAllocation::find()->where(['right' => "Approve Funds Requisition"])->all();

                    if (!empty($role_model)) {

                        foreach ($role_model as $_role) {
                            //We now get all users with the fetched role
                            //  $resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/login']);

                            $_user_model = "";

                            $_user_model = User::find()
                                    ->where(['role' => $_role->role])
                                    ->andWhere(['province_id' => $user->province_id])
                                    ->all();

                            if (!empty($_user_model)) {
                                //We send the emails
                                $subject = $template_model->fiscal_year . " Q" . $template_model->quarter . " Funds Request for " . $district;
                                foreach ($_user_model as $_model) {


                                    $msg = "";
                                    $msg .= "<p>Dear " . $_model->first_name . " " . $_model->last_name . ",<br/><br/>";
                                    $msg .= "The funds requisition for " . $template_model->fiscal_year . " Annual Work Plan and Budget quarter " . $template_model->quarter . " has been submitted for your review and approval. <br/><br/>";

                                    $msg .= "Yours sincerely,<br/><br/></p>";
                                    $msg .= '<p>' . $user->title . ' ' . $user->first_name . ' ' . $user->last_name . '</p>';
                                    \backend\models\Storyofchange::sendEmail($msg, $subject, $user->email);
                                }
                            }
                        }
                    }
                
                $audit = new AuditTrail();
                $audit->user = Yii::$app->user->id;
                $audit->action = "Funds requisition for " . $template_model->fiscal_year . " Q" . $template_model->quarter . " has been submitted.";
                $audit->ip_address = Yii::$app->request->getUserIP();
                $audit->user_agent = Yii::$app->request->getUserAgent();
                $audit->save();
                Yii::$app->session->setFlash('success', " Funds request has been submitted.");
                //return $this->redirect(['awpb-input/' . $page, 'id' => $id, 'id2' => $id2,]);
                return $this->redirect(['home/home']);
            } else {
                $message = '';
                foreach ($model->getErrors() as $error) {
                    $message .= $error[0];
                    Yii::$app->session->setFlash('error', "Error occured : " . $message);
                }
            }
        }
        elseif  (User::userIsAllowedTo('Approve Funds Requisition') && ( $user->province_id == 0 || $user->province_id == '')) {
            $model = \backend\models\AwpbDistrict::findOne(['id' => $id]);
            
              if ($model->district_id >0){
             $spending_centre = !empty($model->district_id) && $model->district_id > 0 ? \backend\models\Districts::findOne($model->district_id)->name : "";
            }
            else if ($model->cost_centre_id >0){
                 
                  $spending_centre = !empty($model->cost_centre_id) && $model->cost_centre_id > 0 ? \backend\models\AwpbCostCentre::findOne($model->cost_centre_id)->name : "";
            }
           
            $model->updated_by = Yii::$app->user->identity->id;
            $model->status = $template_model->quarter;
            if ($template_model->quarter==1)
            {
                $model->status_q_1 = AwpbDistrict::STATUS_QUARTER_APPROVED;
            }
             if ($template_model->quarter==2)
            {
                   $model->status_q_2 = AwpbDistrict::STATUS_QUARTER_APPROVED;
            }
             if ($template_model->quarter==3)
            {
                   $model->status_q_3 = AwpbDistrict::STATUS_QUARTER_APPROVED;
            }
             if ($template_model->quarter==4)
            {
                   $model->status_q_4 = AwpbDistrict::STATUS_QUARTER_APPROVED;
            }
                        if ($model->save()) {
                            //$district = \backend\models\Districts::findOne(['id' => $id2])->name;
                    $role_model = \common\models\RightAllocation::find()->where(['right' => "Request Funds"])->all();

                    if (!empty($role_model)) {

                        foreach ($role_model as $_role) {
                            //We now get all users with the fetched role
                            //  $resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/login']);

                            $_user_model = "";

                               if ($model->province_id>0){
                            $_user_model = User::find()
                                    ->where(['role' => $_role->role])
                                    ->andWhere(['province_id' => $user->province_id])
                                    ->all();
                        }
                        else if ($model->cost_centre_id > 0){
                        
                            $_user_model = User::find()
                                    ->where(['role' => $_role->role])
                                   // ->andWhere(['province_id' => $user->province_id])
                                    ->all();
                        }
                        
                        else
                        {
                            
                        }

                            if (!empty($_user_model)) {
                                //We send the emails
                                $subject = $template_model->fiscal_year . " Q" . $template_model->quarter . " Funds Request for ";
                                foreach ($_user_model as $_model) {


                                    $msg = "";
                                    $msg .= "<p>Dear " . $_model->first_name . " " . $_model->last_name . ",<br/><br/>";
                                    $msg .= "The funds requisition for " . $template_model->fiscal_year . " Annual Work Plan and Budget quarter " . $template_model->quarter . " has been reviewed and approved. <br/><br/>";

                                    $msg .= "Yours sincerely,<br/><br/></p>";
                                    $msg .= '<p>' . $user->title . ' ' . $user->first_name . ' ' . $user->last_name . '</p>';
                                    \backend\models\Storyofchange::sendEmail($msg, $subject, $user->email);
                                }
                            }
                        }
                    }
                
                $audit = new AuditTrail();
                $audit->user = Yii::$app->user->id;
                $audit->action = "Funds requisition for " . $template_model->fiscal_year . " Q" . $template_model->quarter . " has been approved.";
                $audit->ip_address = Yii::$app->request->getUserIP();
                $audit->user_agent = Yii::$app->request->getUserAgent();
                $audit->save();
                Yii::$app->session->setFlash('success', " Funds request has been approved.");
                //return $this->redirect(['awpb-input/' . $page, 'id' => $id, 'id2' => $id2,]);
                 return $this->redirect(['awpb-funds-requisition/qofrd', 'id'=>0,'id2'=>0]);
            } else {
                $message = '';
                foreach ($model->getErrors() as $error) {
                    $message .= $error[0];
                    Yii::$app->session->setFlash('error', "Error occured : " . $message);
                }
            }
        }
        elseif (User::userIsAllowedTo('Disburse Funds') && ( $user->province_id == 0 || $user->province_id == '')) {
             $spending_centre="";
            $model = \backend\models\AwpbDistrict::findOne(['id' => $id]);
            if ($model->district_id >0){
            $disbursed_funds = \backend\models\AwpbFundsRequisition::find()->where([ 'district_id'=>$model->district_id])
                    ->andWhere(['=', 'awpb_template_id',$template_model->id ])
                    ->andWhere(['=', 'quarter_number', $template_model->quarter])
                    ->sum('quarter_amount');
            //$spending_centre = \backend\models\Districts::findOne(['id' => $model->district_id])->name;
             $spending_centre = !empty($model->district_id) && $model->district_id > 0 ? \backend\models\Districts::findOne($model->district_id)->name : "";
            }
            else if ($model->cost_centre_id >0){
                  $disbursed_funds = \backend\models\AwpbFundsRequisition::find()->where([ 'cost_centre_id'=> $model->cost_centre_id])
                    ->andWhere(['=', 'awpb_template_id',$template_model->id ])
                    ->andWhere(['=', 'quarter_number', $template_model->quarter])
                    ->sum('quarter_amount');
                  
                  $spending_centre = !empty($model->cost_centre_id) && $model->cost_centre_id > 0 ? \backend\models\AwpbCostCentre::findOne($model->cost_centre_id)->name : "";
            }
                
           
            $model->updated_by = Yii::$app->user->identity->id;
            $model->status = $template_model->quarter;
            if ($template_model->quarter==1)
            {
                $model->status_q_1 = AwpbDistrict::STATUS_QUARTER_DISBURSED;
                $model->quarter_one_amount= $disbursed_funds;
            }
             else if ($template_model->quarter==2)
            {
                   $model->status_q_2 = AwpbDistrict::STATUS_QUARTER_DISBURSED;
                   $model->quarter_two_amount= $disbursed_funds;
            }
             else if ($template_model->quarter==3)
            {
                   $model->status_q_3 = AwpbDistrict::STATUS_QUARTER_DISBURSED;
                    $model->quarter_three_amount= $disbursed_funds;
            }
             else if ($template_model->quarter==4)
            {
                   $model->status_q_4 = AwpbDistrict::STATUS_QUARTER_DISBURSED;
                   $model->quarter_four_amount= $disbursed_funds;
            }
            else
            {
                
            }
            
           
          
                 
                    if($model->save()){
                           
                    $role_model = \common\models\RightAllocation::find()->where(['right' => "Request Funds"])->all();

                    if (!empty($role_model)) {

                        foreach ($role_model as $_role) {
                            //We now get all users with the fetched role
                            //  $resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/login']);

                            $_user_model = "";

                            if ($model->province_id>0){
                            $_user_model = User::find()
                                    ->where(['role' => $_role->role])
                                    ->andWhere(['province_id' => $user->province_id])
                                    ->all();
                        }
                        else if ($model->cost_centre_id > 0){
                        
                            $_user_model = User::find()
                                    ->where(['role' => $_role->role])
                                   // ->andWhere(['province_id' => $user->province_id])
                                    ->all();
                        }
                        
                        else
                        {
                            
                        }
                            if (!empty($_user_model)) {
                                //We send the emails
                                $subject = $template_model->fiscal_year . " Q" . $template_model->quarter . " Funds Request for " . $spending_centre;
                                foreach ($_user_model as $_model) {


                                    $msg = "";
                                    $msg .= "<p>Dear " . $_model->first_name . " " . $_model->last_name . ",<br/><br/>";
                                    $msg .= "The " . $template_model->fiscal_year . " Annual Work Plan and Budget quarter " . $template_model->quarter . " funds have been disbursed. <br/><br/>";

                                    $msg .= "Yours sincerely,<br/><br/></p>";
                                    $msg .= '<p>' . $user->title . ' ' . $user->first_name . ' ' . $user->last_name . '</p>';
                                    \backend\models\Storyofchange::sendEmail($msg, $subject, $user->email);
                                }
                            }
                        }
                    
                    }
                $audit = new AuditTrail();
                $audit->user = Yii::$app->user->id;
                $audit->action = "The " . $template_model->fiscal_year . " Q" . $template_model->quarter . " funds have been disurbed.";
                $audit->ip_address = Yii::$app->request->getUserIP();
                $audit->user_agent = Yii::$app->request->getUserAgent();
                $audit->save();
                Yii::$app->session->setFlash('success', " Funds disbursed.");
                //return $this->redirect(['awpb-input/' . $page, 'id' => $id, 'id2' => $id2,]);
                    return $this->redirect(['awpb-funds-requisition/qofrd', 'id'=>0,'id2'=>0]);
                    
                                
            } else {
                $message = '';
                foreach ($model->getErrors() as $error) {
                    $message .= $error[0];
                    Yii::$app->session->setFlash('error', "Error occured : " . $message);
                }
                    }
        }
        else 
        {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    public function actionDecline($id, $id2,$id3) {
        $user = User::findOne(['id' => Yii::$app->user->id]);
        $template_model = \backend\models\AwpbTemplate::find()->where(['status' => \backend\models\AwpbTemplate::STATUS_CURRENT_BUDGET])->one();
        if (User::userIsAllowedTo('Review Funds Request') && ( $user->province_id > 0 || $user->province_id !=0))
        {
            if ($id3==1){
            $model = \backend\models\AwpbDistrict::findOne(['awpb_template_id' => $template_model->id, 'district_id' => $id2]);
            }else  if ($id3==2)
            {
                  $model = \backend\models\AwpbDistrict::findOne(['awpb_template_id' =>  $template_model->id, 'cost_centre_id' => $id2]);
            }
            
            $model->updated_by = Yii::$app->user->identity->id;
            $model->status = $template_model->quarter;
            if ($template_model->quarter==1)
            {
                $model->status_q_1 = AwpbDistrict::STATUS_QUARTER_CLOSED;
            }
            if ($template_model->quarter==2)
            {
                   $model->status_q_2 = AwpbDistrict::STATUS_QUARTER_CLOSED;
            }
            if ($template_model->quarter==3)
            {
                   $model->status_q_3 = AwpbDistrict::STATUS_QUARTER_CLOSED;
            }
            if ($template_model->quarter==4)
            {
                   $model->status_q_4 = AwpbDistrict::STATUS_QUARTER_CLOSED;
            }
            if ($model->save()) {
                 $funds_requesition = new \backend\models\AwpbFundsRequisition();
                       
             $funds_requesition::deleteAll(['district_id'=>$id2,'awpb_template_id'=>$template_model->id,'quarter_number'=> $template_model->quarter]);
                
              
                    $district = \backend\models\Districts::findOne(['id' => $id2])->name;
                    $role_model = \common\models\RightAllocation::find()->where(['right' => "Request Funds"])->all();

                    if (!empty($role_model)) {

                        foreach ($role_model as $_role) {
                            //We now get all users with the fetched role
                            //  $resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/login']);

                            $_user_model = "";

                            $_user_model = User::find()
                                    ->where(['role' => $_role->role])
                                    ->andWhere(['district_id' => $id2])
                                    ->all();

                            if (!empty($_user_model)) {
                                //We send the emails
                                $subject = $template_model->fiscal_year . " Q" . $template_model->quarter . " Funds Request for " . $district;
                                foreach ($_user_model as $_model) {


                                    $msg = "";
                                    $msg .= "<p>Dear " . $_model->first_name . " " . $_model->last_name . ",<br/><br/>";
                                    $msg .= "The funds requisition for " . $template_model->fiscal_year . " Annual Work Plan and Budget quarter " . $template_model->quarter . " has been declined. <br/><br/>";

                                    $msg .= "Yours sincerely,<br/><br/></p>";
                                    $msg .= '<p>' . $user->title . ' ' . $user->first_name . ' ' . $user->last_name . '</p>';
                                    \backend\models\Storyofchange::sendEmail($msg, $subject, $user->email);
                                }
                            }
                        }
                    }
                
                $audit = new AuditTrail();
                $audit->user = Yii::$app->user->id;
                $audit->action = "Funds requisition for " . $template_model->fiscal_year . " Q" . $template_model->quarter . " has been declined.";
                $audit->ip_address = Yii::$app->request->getUserIP();
                $audit->user_agent = Yii::$app->request->getUserAgent();
                $audit->save();
                Yii::$app->session->setFlash('success', " Funds request has been declined.");
                //return $this->redirect(['awpb-input/' . $page, 'id' => $id, 'id2' => $id2,]);
                return $this->redirect(['home/home']);
            } else {
                $message = '';
                foreach ($model->getErrors() as $error) {
                    $message .= $error[0];
                    Yii::$app->session->setFlash('error', "Error occured : " . $message);
                }
            }
        } 
        elseif (User::userIsAllowedTo('Approve Funds Requisition') && ( $user->province_id == 0 || $user->province_id == '')) {
             $model = \backend\models\AwpbDistrict::findOne(['awpb_template_id' => $template_model->id, 'district_id' => $id2]);
          if ($id3==1){
            $model = \backend\models\AwpbDistrict::findOne(['awpb_template_id' => $template_model->id, 'district_id' => $id2]);
            }else  if ($id3==2)
            {
                  $model = \backend\models\AwpbDistrict::findOne(['awpb_template_id' => $template_model->id, 'cost_centre_id' => $id2]);
            }
            
         //   $model->status = $template_model->quarter;
            if ($template_model->quarter==1)
            {
                $model->status_q_1 = AwpbDistrict::STATUS_QUARTER_CLOSED;
            }
            if ($template_model->quarter==2)
            {
                   $model->status_q_2 = AwpbDistrict::STATUS_QUARTER_CLOSED;
            }
            if ($template_model->quarter==3)
            {
                   $model->status_q_3 = AwpbDistrict::STATUS_QUARTER_CLOSED;
            }
            if ($template_model->quarter==4)
            {
                   $model->status_q_4 = AwpbDistrict::STATUS_QUARTER_CLOSED;
            }
            //$model->status = $template_model->quarter;
            if ($model->save()) {
                $funds_requesition = new \backend\models\AwpbFundsRequisition();
                
                    $district = \backend\models\Districts::findOne(['id' => $id2])->name;
                    
                     $district="";
                    
                    if ($id3==1){
             $district = \backend\models\Districts::findOne(['id' => $id2])->name;
                $funds_requesition::deleteAll(['district_id'=>$id2,'awpb_template_id'=>$template_model->id,'quarter_number'=> $template_model->quarter]);
            }else  if ($id3==2)
            {
                  $district = \backend\models\AwpbCostCentre::findOne(['id' => $id2])->name;
                     $funds_requesition::deleteAll(['cost_centre_id'=>$id2,'awpb_template_id'=>$template_model->id,'quarter_number'=> $template_model->quarter]);
            }
                    
                    
                    
                   $role_model = \common\models\RightAllocation::find()->where(['right' => "Request Funds"])->all();
                    if (!empty($role_model)) {

                        foreach ($role_model as $_role) {
                            //We now get all users with the fetched role
                            //  $resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/login']);

                            $_user_model = "";

                            $_user_model = User::find()
                                    ->where(['role' => $_role->role])
                                    ->andWhere(['district_id' => $id2])
                                    ->all();

                            if (!empty($_user_model)) {
                                //We send the emails
                                $subject = $template_model->fiscal_year . " Q" . $template_model->quarter . " Funds Request for " . $district;
                                foreach ($_user_model as $_model) {


                                    $msg = "";
                                    $msg .= "<p>Dear " . $_model->first_name . " " . $_model->last_name . ",<br/><br/>";
                                    $msg .= "The funds requisition for " . $template_model->fiscal_year . " Annual Work Plan and Budget quarter " . $template_model->quarter . " has been declined. <br/><br/>";

                                    $msg .= "Yours sincerely,<br/><br/></p>";
                                    $msg .= '<p>' . $user->title . ' ' . $user->first_name . ' ' . $user->last_name . '</p>';
                                    \backend\models\Storyofchange::sendEmail($msg, $subject, $user->email);
                                }
                            }
                        }
                    }
                
                $audit = new AuditTrail();
                $audit->user = Yii::$app->user->id;
                $audit->action = "Funds requisition for " . $template_model->fiscal_year . " Q" . $template_model->quarter . " has been declined.";
                $audit->ip_address = Yii::$app->request->getUserIP();
                $audit->user_agent = Yii::$app->request->getUserAgent();
                $audit->save();
                Yii::$app->session->setFlash('success', " Funds request has been declined.");
                 return $this->redirect(['awpb-funds-requisition/qofrd', 'id'=>0,'id2'=>0]);
                //return $this->redirect(['awpb-input/' . $page, 'id' => $id, 'id2' => $id2,]);
                //return $this->redirect(['home/home']);
            } else {
                $message = '';
                foreach ($model->getErrors() as $error) {
                    $message .= $error[0];
                    Yii::$app->session->setFlash('error', "Error occured : " . $message);
                }
            }
        } 
        elseif (User::userIsAllowedTo('Disburse Funds') && ( $user->province_id == 0 || $user->province_id == '')) {
          // $model = \backend\models\AwpbDistrict::findOne(['awpb_template_id' => $template_model->id, 'district_id' => $id2]);
            if ($id3==1){
            $model = \backend\models\AwpbDistrict::findOne(['awpb_template_id' => $template_model->id, 'district_id' => $id2]);
            }else  if ($id3==2)
            {
                  $model = \backend\models\AwpbDistrict::findOne(['awpb_template_id' => $template_model->id, 'cost_centre_id' => $id2]);
            }
            
            $model->updated_by = Yii::$app->user->identity->id;
            //$model->status = $template_model->quarter;
           
            
            $model->updated_by = Yii::$app->user->identity->id;
            $model->status = $template_model->quarter;
            
     
            if ($template_model->quarter==1)
            {
                $model->status_q_1 = AwpbDistrict::STATUS_QUARTER_REQUESTED ;
            }
            if ($template_model->quarter==2)
            {
                   $model->status_q_2 = AwpbDistrict::STATUS_QUARTER_REQUESTED ;
            }
            if ($template_model->quarter==3)
            {
                   $model->status_q_3 = AwpbDistrict::STATUS_QUARTER_REQUESTED ;
            }
            if ($template_model->quarter==4)
            {
                   $model->status_q_4 = AwpbDistrict::STATUS_QUARTER_REQUESTED ;
            }
            
            if ($model->save()) {
 $district="";
                    $district = \backend\models\Districts::findOne(['id' => $id2])->name;
                    if ($id3==1){
             $district = \backend\models\Districts::findOne(['id' => $id2])->name;
            }else  if ($id3==2)
            {
                  $district = \backend\models\AwpbCostCentre::findOne(['id' => $id2])->name;
            }
                    
                    $role_model = \common\models\RightAllocation::find()->where(['right' => "Approve Funds Requisition"])->all();

                    if (!empty($role_model)) {

                        foreach ($role_model as $_role) {
                            //We now get all users with the fetched role
                            //  $resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/login']);

                            $_user_model = "";

                            $_user_model = User::find()
                                    ->where(['role' => $_role->role])
                                    ->andWhere(['district_id' => $id2])
                                    ->all();

                            if (!empty($_user_model)) {
                                //We send the emails
                                $subject = "Decline - " . $template_model->fiscal_year . " Q" . $template_model->quarter . " Funds Request for " . $district;
                                foreach ($_user_model as $_model) {


                                    $msg = "";
                                    $msg .= "<p>Dear " . $_model->first_name . " " . $_model->last_name . ",<br/><br/>";
                                    $msg .= "The funds requisition for " . $template_model->fiscal_year . " Annual Work Plan and Budget quarter " . $template_model->quarter . " has been declined. <br/><br/>";

                                    $msg .= "Yours sincerely,<br/><br/></p>";
                                    $msg .= '<p>' . $user->title . ' ' . $user->first_name . ' ' . $user->last_name . '</p>';
                                    \backend\models\Storyofchange::sendEmail($msg, $subject, $user->email);
                                }
                            }
                        }
                    }
               // }
                $audit = new AuditTrail();
                $audit->user = Yii::$app->user->id;
                $audit->action = "Funds requisition for " . $template_model->fiscal_year . " Q" . $template_model->quarter . " has been declined.";
                $audit->ip_address = Yii::$app->request->getUserIP();
                $audit->user_agent = Yii::$app->request->getUserAgent();
                $audit->save();
                Yii::$app->session->setFlash('success', " Funds request has been declined.");
                return $this->redirect(['awpb-funds-requisition/qofrd', 'id'=>0,'id2'=>0]);
                
            } else {
                $message = '';
                foreach ($model->getErrors() as $error) {
                    $message .= $error[0];
                    Yii::$app->session->setFlash('error', "Error occured : " . $message);
                }
            }
        } 
        else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    public function actionIndex() {
        $searchModel = new AwpbDistrictSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AwpbDistrict model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new AwpbDistrict model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new AwpbDistrict();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing AwpbDistrict model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
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
     * Deletes an existing AwpbDistrict model.
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
     * Finds the AwpbDistrict model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AwpbDistrict the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = AwpbDistrict::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    
     public function actionDistrict() {
         $template_model = \backend\models\AwpbTemplate::find()->where(['status' => \backend\models\AwpbTemplate::STATUS_PUBLISHED])->one();
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            //  Yii::warning('**********************', var_export($_POST['depdrop_parents'],true));
            //   $parents = $_POST['depdrop_all_params']['parent_id'];
            $selected_id = $_POST['depdrop_params'];
            if ($parents != null) {
                $prov_id = $parents[0];
                $out = \backend\models\AwpbDistrict::find()
                       // ->select(['name', 'id'])
                        ->select(["name", "district_id as id"])
                        ->where(['province_id' => $prov_id])
                         ->andWhere(['awpb_template_id' => $template_model->id])
                        ->asArray()
                        ->all();

                return ['output' => $out, 'selected' => $selected_id[0]];
            }
        }
        return ['output' => '', 'selected' => ''];
    }
    
}
