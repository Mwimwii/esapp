<?php

namespace backend\controllers;

use Yii;
use backend\models\AwpbTemplate;
use backend\models\AwpbTemplateSearch;
use backend\models\AwpbDistrict;
use backend\models\AwpbProvince;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Json;
use backend\models\AuditTrail;
use backend\models\AwpbTemplateActivity;
use backend\models\AwpbTemplateUsers;
use backend\models\User;
use backend\models\UploadImageForm;
use yii\web\UploadedFile;
use \yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\mpdf\Pdf;
use backend\models\AwpbTemplateComponent;

/**
 * AwpbTemplateController implements the CRUD actions for AwpbTemplate model.
 */
class AwpbTemplateController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'create', 'update', 'delete', 'view','cq', 'check-list', 'activities', 'users', 'read', 'rollover'],
                'rules' => [
                    [
                        'actions' => ['index', 'create', 'update', 'delete','cq', 'view', 'check-list', 'activities', 'users', 'read', 'rollover'],
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
     * Lists all AwpbTemplate models.
     * @return mixed
     */
    public function actionIndex() {

        if (User::userIsAllowedTo('View AWPB') || User::userIsAllowedTo('Setup AWPB')) {

            $searchModel = new AwpbTemplateSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            $dataProvider->sort->defaultOrder = ['status' => SORT_ASC, 'fiscal_year' => SORT_DESC];
            return $this->render('index', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['site/home']);
        }
    }

    public function actionUploadImage() {
        $model = new UploadImageForm();
        if (Yii::$app->request->isPost) {
            $model->image = UploadedFile::getInstance($model, 'image');
            if ($model->upload()) {
                // file is uploaded successfully
                echo "File successfully uploaded";
                return;
            }
        }
    }

    /**
     * Displays a single AwpbTemplate model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        if (User::userIsAllowedTo('View AWPB')||User::userIsAllowedTo('Setup AWPB')) {
            return $this->render('view', [
                        'model' => $this->findModel($id),
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['site/home']);
        }
    }

    public function actionCheckList($id) {
        if (User::userIsAllowedTo('Setup AWPB')) {
            return $this->render('check-list', [
                        'model' => $this->findModel($id),
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    public function actionActivities($id) {
        if (User::userIsAllowedTo('Setup AWPB')) {
            $model = $this->findModel($id);
            if (Yii::$app->request->isAjax) {
                $model->load(Yii::$app->request->post());
                return Json::encode(\yii\widgets\ActiveForm::validate($model));
            }

            $act = AwpbTemplateActivity::getActivities($id);
            $array = [];
            foreach ($act as $activity => $v) {
                array_push($array, $activity);
            }
            $model->activities = $array;

            if ($model->load(Yii::$app->request->post())) {
                //var_dump(Yii::$app->request->post());
                //$model->activities=explode(',',$_POST['AwpbTemplate']['activities']);
                $model->activities = $_POST['AwpbTemplate']['activities'];
        
                if (!empty($model->activities)) {
                    $model->updated_by = Yii::$app->user->id;
                    $model->status_activities = AwpbTemplate::STATUS_PUBLISHED;
                    if ($model->save()) {
                        $awpbTemplateActivity = new AwpbTemplateActivity();
                        $awpbTemplateActivity::deleteAll(['awpb_template_id' => $id]);
                        foreach ($model->activities as $activity) {
                            //check if the right was already assigned to this role
                            $_model = \backend\models\AwpbActivity::findOne($activity);
                            $component_model = \backend\models\AwpbComponent::findOne($_model);
                            $awpbTemplateActivity->component_id = $_model->component_id;
                            // $awpbTemplateActivity->output_id = $_model->output_id;
                            $awpbTemplateActivity->activity_code = $_model->activity_code;
                            //$awpbTemplateActivity->name = $_model->activity_code.' '.$_model->name;
                            $awpbTemplateActivity->name = $_model->name;
                            $awpbTemplateActivity->awpb_template_id = $id;
                            $awpbTemplateActivity->id = NULL; //primary key(auto increment id) id
                            $awpbTemplateActivity->isNewRecord = true;
                            $awpbTemplateActivity->activity_id = $activity;
                            $awpbTemplateActivity->ifad = 50;
                            $awpbTemplateActivity->ifad_grant = 30;
                            $awpbTemplateActivity->grz = 20;
                            $awpbTemplateActivity->status = 1;
                            $awpbTemplateActivity->access_level_district = $component_model->access_level_district;
                            $awpbTemplateActivity->access_level_province = $component_model->access_level_province;
                            $awpbTemplateActivity->access_level_programme = $component_model->access_level_programme;
                            //$rightAllocation->created_by = Yii::$app->user->id;
                            if ($awpbTemplateActivity->save()) {
                                
                            } else {
                                $message = "";
                                foreach ($awpbTemplateActivity->getErrors() as $error) {
                                    $message .= $error[0];
                                }

                                Yii::$app->session->setFlash('error', 'Error occured while updating the AWPB template:' . $message);
                                //  return $this->redirect(['home/home']);
                            }
                        }

                        //check if current user has the role that has just been edited so that we update the permissions instead of user logging out
                        // if (Yii::$app->getUser()->identity->role == $model->id) {
                        //     $rightsArray = \common\models\RightAllocation::getRights(Yii::$app->getUser()->identity->role);
                        //     $rights = implode(",", $rightsArray);
                        //     $session = Yii::$app->session;
                        //     $session->set('rights', $rights);
                        // }


                        $awpbTemplateComponent = new AwpbTemplateComponent();
                        //$awpbTemplateProvince::deleteAll(['awpb_template_id' => $id]);
                        $_awpbTemplateComponents = \backend\models\AwpbTemplateActivity::find()->select('component_id')->distinct()->where(['=', 'awpb_template_id', $id])->all();
                        // var_dump($_awpbTemplateProvinces );
                        //$_awpbTemplateProvinces = \backend\models\AwpbDistrict::find(['awpb_template_id' => $id])->select('province_id')->distinct();
                        //  $_awpbTemplateProvinces = $awpbTemplateDistrict::find(['awpb_template_id' => $id])->select('province_id')->distinct();
                        if (!empty($_awpbTemplateComponents)) {
                            foreach ($_awpbTemplateComponents as $component) {
                                //check if the right was already assigned to this role
                                $comp = \backend\models\AwpbTemplateComponent::findOne(['component_id' => $component->component_id]);
                                if (empty($comp->id)) {
                                    $awpbTemplateComponent->awpb_template_id = $id;
                                    $awpbTemplateComponent->component_id = $component->component_id;
                                    $awpbTemplateComponent->id = NULL; //primary key(auto increment id) id
                                    $awpbTemplateComponent->isNewRecord = true;
                                    $awpbTemplateComponent->updated_by = Yii::$app->user->id;
                                    $awpbTemplateComponent->created_by = Yii::$app->user->id;
                                    $awpbTemplateComponent->status = AwpbTemplate::STATUS_DRAFT;
                                    $awpbTemplateComponent->save();
                                }
                            }
                        }


                        $audit = new AuditTrail();
                        $audit->user = Yii::$app->user->id;
                        $audit->action = "Updated " . $model->fiscal_year . " fiscal year";
                        $audit->ip_address = Yii::$app->request->getUserIP();
                        $audit->user_agent = Yii::$app->request->getUserAgent();
                        $audit->save();
                        Yii::$app->session->setFlash('success', $model->fiscal_year . ' was successfully updated.');
                        return $this->redirect(['view', 'id' => $model->id]);
                    } else {
                        $message = "";
                        foreach ($model->getErrors() as $error) {
                            $message .= $error[0];
                        }

                        Yii::$app->session->setFlash('error', 'Error occured while updating the AWPB template:' . $message);
                        //  return $this->redirect(['home/home']);
                    }
                } else {
                    Yii::$app->session->setFlash('error', 'You need to select at least one activity!');
                    return $this->render('activities', [
                                'model' => $model,
                                'id' => $model->id,]);
                }
            }
            return $this->render('activities', [
                        'model' => $model,
                        'fiscal_year' => $model->fiscal_year,
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    public function actionTemplateUsers($id) {
        if (User::userIsAllowedTo('Setup AWPB')) {
            $model = $this->findModel($id);
            if (Yii::$app->request->isAjax) {
                $model->load(Yii::$app->request->post());
                return Json::encode(\yii\widgets\ActiveForm::validate($model));
            }

            $_users = AwpbTemplateUsers::getTemplateUsers($id);
            $array = [];
            foreach ($_users as $_user => $v) {
                array_push($array, $_user);
            }
            $model->users = $array;
            // var_dump($model->users);

            if ($model->load(Yii::$app->request->post())) {
                //var_dump(Yii::$app->request->post());
                //$model->activities=explode(',',$_POST['AwpbTemplate']['activities']);
                $model->users = $_POST['AwpbTemplate']['users'];
                //var_dump($act);
                // var_dump($model->users);
                //   var_dump($model->budget_theme);
                if (!empty($model->users)) {
                    $model->updated_by = Yii::$app->user->id;
                    $model->status_users = AwpbTemplate::STATUS_PUBLISHED;
                    if ($model->save()) {
                        $awpbTemplateUsers = new AwpbTemplateUsers();
                        $awpbTemplateUsers::deleteAll(['awpb_template_id' => $id]);
                        foreach ($model->users as $user) {
                            //check if the right was already assigned to this role
                            $user_model = \backend\models\User::findOne($user);
                            // var_dump($_model);
                            $awpbTemplateUsers->awpb_template_id = $id;
                            $awpbTemplateUsers->title = $user_model->title;
                            $awpbTemplateUsers->first_name = $user_model->first_name;
                            $awpbTemplateUsers->last_name = $user_model->last_name;
                            $awpbTemplateUsers->other_name = $user_model->other_name;
                            $awpbTemplateUsers->id = NULL; //primary key(auto increment id) id
                            $awpbTemplateUsers->isNewRecord = true;
                            $awpbTemplateUsers->status_budget = 0;
                            $awpbTemplateUsers->user_id = $user;
                            $awpbTemplateUsers->updated_by = Yii::$app->user->id;
                            $awpbTemplateUsers->created_by = Yii::$app->user->id;
                            $awpbTemplateUsers->save();
                        }

                        //check if current user has the role that has just been edited so that we update the permissions instead of user logging out
                        // if (Yii::$app->getUser()->identity->role == $model->id) {
                        //     $rightsArray = \common\models\RightAllocation::getRights(Yii::$app->getUser()->identity->role);
                        //     $rights = implode(",", $rightsArray);
                        //     $session = Yii::$app->session;
                        //     $session->set('rights', $rights);
                        // }

                        $audit = new AuditTrail();
                        $audit->user = Yii::$app->user->id;
                        $audit->action = "Updated " . $model->fiscal_year . " AWPB user list";
                        $audit->ip_address = Yii::$app->request->getUserIP();
                        $audit->user_agent = Yii::$app->request->getUserAgent();
                        $audit->save();
                        Yii::$app->session->setFlash('success', $model->fiscal_year . ' AWPB user list was successfully updated.');
                        return $this->redirect(['view', 'id' => $model->id]);
                    } else {
                        Yii::$app->session->setFlash('error', 'Error occurred while updating AWPB user list. Please try again.');

                        return $this->render('template-users', [
                                    'id' => $model->id
                        ]);
                    }
                } else {
                    Yii::$app->session->setFlash('error', 'You need to select at least one user!');
                    return $this->render('template-users', [
                                'model' => $model,
                                'fiscal_year' => $model->fiscal_year,
                    ]);
                }
            }
            return $this->render('template-users', [
                        'model' => $model,
                        'fiscal_year' => $model->fiscal_year,
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    public function actionTemplateDistricts($id) {
        $test = "";
        if (User::userIsAllowedTo('Setup AWPB')) {
            $model = $this->findModel($id);
            if (Yii::$app->request->isAjax) {
                $model->load(Yii::$app->request->post());
                return Json::encode(\yii\widgets\ActiveForm::validate($model));
            }

            $_districts = AwpbDistrict::getAwpbDistricts($id);
            $array = [];
            foreach ($_districts as $_district => $v) {
                array_push($array, $_district);
            }
            $model->districts = $array;
            // var_dump($model->users);

            if ($model->load(Yii::$app->request->post())) {
                //var_dump(Yii::$app->request->post());
                //$model->activities=explode(',',$_POST['AwpbTemplate']['activities']);
                $model->districts = $_POST['AwpbTemplate']['districts'];
                //var_dump($act);
                // var_dump($model->users);
                //   var_dump($model->budget_theme);
                if (!empty($model->districts)) {
                    $model->updated_by = Yii::$app->user->id;
                    $model->status_district = AwpbTemplate::STATUS_PUBLISHED;
                    if ($model->save()) {
                        $awpbTemplateDistrict = new AwpbDistrict();
                        $awpbTemplateDistrict::deleteAll(['awpb_template_id' => $id]);
                        foreach ($model->districts as $district) {
                            //check if the right was already assigned to this role
                            $district_model = \backend\models\Districts::findOne($district);
                            $dist = \backend\models\AwpbDistrict::findOne(['district_id' => $district, 'awpb_template_id' => $id]);
                            if (empty($dist->id)) {
                                // var_dump($_model);
                                $awpbTemplateDistrict->awpb_template_id = $id;
                                $awpbTemplateDistrict->district_id = $district_model->id;
                                $awpbTemplateDistrict->province_id = $district_model->province_id;
                                $awpbTemplateDistrict->name = $district_model->name;
                                $awpbTemplateDistrict->id = NULL; //primary key(auto increment id) id
                                $awpbTemplateDistrict->isNewRecord = true;
                                $awpbTemplateDistrict->updated_by = Yii::$app->user->id;
                                $awpbTemplateDistrict->created_by = Yii::$app->user->id;
                                $awpbTemplateDistrict->status = AwpbTemplate::STATUS_DRAFT;
                                $awpbTemplateDistrict->save();
                            }
                        }



                        $audit = new AuditTrail();
                        $audit->user = Yii::$app->user->id;
                        $audit->action = "Updated " . $model->fiscal_year . " AWPB district list";
                        $audit->ip_address = Yii::$app->request->getUserIP();
                        $audit->user_agent = Yii::$app->request->getUserAgent();
                        $audit->save();
                        Yii::$app->session->setFlash('success', $model->fiscal_year . ' AWPB district list was successfully updated.');
                        return $this->redirect(['view', 'id' => $model->id]);
                    } else {
                        Yii::$app->session->setFlash('error', 'Error occurred while updating AWPB district list. Please try again.');

                        return $this->render('template-districts', [
                                    'id' => $model->id
                        ]);
                    }
                } else {
                    Yii::$app->session->setFlash('error', 'You need to select at least one district!');
                    return $this->render('template-districts', [
                                'model' => $model,
                                'fiscal_year' => $model->fiscal_year,
                    ]);
                }
            }
            return $this->render('template-districts', [
                        'model' => $model,
                        'fiscal_year' => $model->fiscal_year,
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    public function actionPublish($id) {
        if (User::userIsAllowedTo('Setup AWPB')) {
            $me = User::findOne(['id' => Yii::$app->user->id]);
            $model = $this->findModel($id);
            $model->updated_by = Yii::$app->user->identity->id;
            $model->status = AwpbTemplate::STATUS_PUBLISHED;
            if ($model->save()) {

                $session = Yii::$app->session;
                $session->set('awpb_template_id', AwpbTemplate::getId());
                $audit = new AuditTrail();
                $audit->user = Yii::$app->user->id;
                $audit->action = "Published  '" . $model->fiscal_year . ' AWPB Template';
                $audit->ip_address = Yii::$app->request->getUserIP();
                $audit->user_agent = Yii::$app->request->getUserAgent();
                $audit->save();
                Yii::$app->session->setFlash('success', $model->fiscal_year . ' AWPB Template was successfully published.');

                //We send an email informing IKM Officers that a story has been submited for review
                //We first get roles with the permission to review stories
                $user_model = \backend\models\AwpbTemplateUsers::find()->where(['awpb_template_id' => $id])->all();
                if (!empty($user_model)) {
                    $subject = $model->fiscal_year . " AWPB Template Published";
                    foreach ($user_model as $usr) {
                        //We now get all users with the fetched role
                        //  $resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/login']);

                        $user = User::findOne(['id' => $usr->user_id]);
                        $msg = "";
                        $msg .= "<p>Dear " . $user->first_name . " " . $user->last_name . ",<br/><br/>";
                        $msg .= "The " . $model->fiscal_year . " has been published. The budgeting schedule is as shown in the table below:<br /><br />";
                        $msg .= "<table class='table'><thead> <tr> <th>Budget Activity</th><th>Deadline</th> </tr></thead>";
                        $msg .= "<tbody>";
                        $msg .= " <tr><td>Deadline for preparing the AWPB by participating institution &emsp;&emsp;   </td><td>" . $model->preparation_deadline_first_draft . "&emsp;&emsp;</td></tr>";
                        $msg .= " <tr><td>Deadline for submitting the AWPB proposals to PCO&emsp;&emsp;   </td><td>" . $model->submission_deadline . "&emsp;&emsp;</td></tr>";
                        $msg .= " <tr><td>Deadline for consolidating AWPB&emsp;&emsp;   </td><td>" . $model->consolidation_deadline . "&emsp;&emsp;</td></tr>";
                        $msg .= " <tr><td>Deadline for reviewing the draft AWPB by participating institution&emsp;&emsp;   </td><td> " . $model->review_deadline . "&emsp;&emsp;</td></tr>";
                        $msg .= " <tr><td>Deadline for preparing the second AWPB Draft by participating institution&emsp;&emsp;   </td><td> " . $model->preparation_deadline_second_draft . "&emsp;&emsp;</td></tr>";
                        $msg .= " <tr><td>Deadline for reviewing the AWPB by PCO&emsp;&emsp;   </td><td>   " . $model->review_deadline_pco . "&emsp;&emsp;</td></tr>";
                        $msg .= " <tr><td>Deadline for AWPB finalisation by PCO&emsp;&emsp;   </td><td>  " . $model->finalisation_deadline_pco . "&emsp;&emsp;</td></tr>";
                        $msg .= " <tr><td>Deadline for submitting AWPB to MoA/MFL&emsp;&emsp;   </td><td>" . $model->submission_deadline_moa_mfl . "&emsp;&emsp;</td></tr>";
                        $msg .= " <tr><td>Deadline for approving AWPB by JPSC&emsp;&emsp;   </td><td>   " . $model->approval_deadline_jpsc . "&emsp;&emsp;</td></tr>";
                        $msg .= " <tr><td>Deadline for incorpating PCO Budget into MoA/MFL budget&emsp;&emsp;   </td><td> " . $model->incorpation_deadline_pco_moa_mfl . "&emsp;&emsp;</td></tr>";
                        $msg .= " <tr><td>Deadline for submitting AWPB to IFAD&emsp;&emsp;   </td><td>   " . $model->submission_deadline_ifad . "&emsp;&emsp;</td></tr>";
                        $msg .= " <tr><td>Deadline for receiving AWPB comments from IFAD&emsp;&emsp;   </td><td>" . $model->comment_deadline_ifad . "&emsp;&emsp;</td></tr>";
                        $msg .= " <tr><td>'Deadline for distributing the AWPB to institutions&emsp;&emsp;   </td><td>  " . $model->distribution_deadline . "&emsp;&emsp;</td></tr>";
                        $msg .= "</tbody>";
                        $msg .= "</table>";
                        $msg .= "<br />";
                        $msg .= '<p>You participation will highly be appreciated</p>';
                        $msg .= "Yours sincerely,<br/><br/></p>";
                        $msg .= '<p>' . $me->title . ' ' . $me->first_name . ' ' . $me->last_name . '</p>';
                        \backend\models\Storyofchange::sendEmail($msg, $subject, $user->email);
                        //  Storyofchange::sendEmail($msg, $subject, $_model->email);
                    }
                }

                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                Yii::$app->session->setFlash('error', 'Error occured while publishing ' . $model->fiscal_year . ' AWPB Template');
            }
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    

    public function actionRead($id) {
        $model = $this->findModel($id);

        $storagePath = 'uploads/awpb/' . $model->guideline_file;
        // $storagePath = Yii::getAlias('@app/uploads/awpb/'.$model->guideline_file);
        // check filename for allowed chars (do not allow ../ to avoid security issue: downloading arbitrary files)
        if (!preg_match('/^[a-z0-9]+\.[a-z0-9]+$/i', $model->guideline_file) || !is_file($storagePath)) {
            // throw new \yii\web\NotFoundHttpException('The file does not exists.');
            // return Yii::$app->response->sendFile($storagePath, $model->guideline_file,['inline'=>false]);
            // Yii::$app->session->setFlash('error', 'The file does not exists.'. $storagePath);
            //     return $this->redirect(['site/home']);
            return Yii::$app->response->sendFile($storagePath, $model->guideline_file, ['inline' => true]);
        }
        Yii::$app->session->setFlash('error', 'The file does not exists.' . $storagePath);
        return $this->redirect(['home/home']);
    }

    public function actionActivity($id) {
        $model = $this->findModel($id);
        if (User::userIsAllowedTo('Setup AWPB')) {
            if (!Yii::$app->session->getIsActive()) {
                Yii::$app->session->open();
            }
            Yii::$app->session['fiscal_year'] = $model->fiscal_year;
            Yii::$app->session['awpb_template_id'] = $model->id;

            Yii::$app->session->close();
            return $this->redirect(['awpb-activity/index']);
        }
    }

    /**
     * Creates a new AwpbTemplate model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {

        if (User::userIsAllowedTo('Setup AWPB')) {
            $model = new AwpbTemplate();
            if (Yii::$app->request->isAjax) {
                $model->load(Yii::$app->request->post());
                return Json::encode(\yii\widgets\ActiveForm::validate($model));
            }

            if ($model->load(Yii::$app->request->post())) {
                
                $template_model =  \backend\models\AwpbTemplate::find()->where(['status' =>\backend\models\AwpbTemplate::STATUS_DRAFT])->one();
                if (empty($template_model)){

                $model->guideline_file = UploadedFile::getInstance($model, 'guideline_file');
                if (isset($model->guideline_file->extension)) {
                    $file_name = $model->fiscal_year . '-AWPB-Guidelines.' . $model->guideline_file->extension;
                    $file_path = 'uploads/awpb/' . $file_name;
                    $model->guideline_file->saveAs($file_path);

                    $model->guideline_file = $file_name;
                    //$up_file = 1;
                }
                $model->status = AwpbTemplate::STATUS_DRAFT;

                $model->preparation_deadline_first_draft = $model->submission_deadline;

                $model->consolidation_deadline = $model->incorpation_deadline_pco_moa_mfl;
        
                $model->preparation_deadline_second_draft = $model->incorpation_deadline_pco_moa_mfl;
                $model->review_deadline_pco = $model->incorpation_deadline_pco_moa_mfl;
                $model->finalisation_deadline_pco = $model->incorpation_deadline_pco_moa_mfl;
                $model->submission_deadline_moa_mfl = $model->incorpation_deadline_pco_moa_mfl;
                $model->approval_deadline_jpsc = $model->incorpation_deadline_pco_moa_mfl;

                $model->comment_deadline_ifad = $model->incorpation_deadline_pco_moa_mfl;
                $model->distribution_deadline = $model->incorpation_deadline_pco_moa_mfl;

                $model->created_by = Yii::$app->user->id;
                $model->updated_by = Yii::$app->user->id;

    
                if ($model->validate()) {



                    if ($model->save()) {


                        $cost_centres = \backend\models\AwpbCostCentre::find()->all();

                        if (isset($cost_centres)) {
                            if ($cost_centres != null) {
                                $awpbTemplateDistrict = new AwpbDistrict();
                                foreach ($cost_centres as $cost_centre) {

                                    $awpbTemplateDistrict->awpb_template_id = $model->id;
                                    $awpbTemplateDistrict->cost_centre_id = $cost_centre->id;

                                    $awpbTemplateDistrict->name = $cost_centre->name;

                                    $awpbTemplateDistrict->id = NULL; //primary key(auto increment id) id
                                    $awpbTemplateDistrict->isNewRecord = true;

                                    $awpbTemplateDistrict->updated_by = Yii::$app->user->id;
                                    $awpbTemplateDistrict->created_by = Yii::$app->user->id;

                                    $awpbTemplateDistrict->status = AwpbTemplate::STATUS_DRAFT;
                                    $awpbTemplateDistrict->save();
                                }
                            }
                        }

                        $audit = new AuditTrail();
                        $audit->user = Yii::$app->user->id;
                        $audit->action = "Added template : " . $model->fiscal_year;
                        $audit->ip_address = Yii::$app->request->getUserIP();
                        $audit->user_agent = Yii::$app->request->getUserAgent();
                        $audit->save();
                        Yii::$app->session->setFlash('success', $model->fiscal_year . ' AWPB template was successfully added.');

                        return $this->redirect(['check-list', 'id' => $model->id]);
                    } else {
                        Yii::$app->session->setFlash('error', 'Error occured while adding ' . $model->fiscal_year . ' AWPB template.');
                    }
                }
                    
             } else {
                        Yii::$app->session->setFlash('error', 'You can only have one unpublished template at a time. Kindly publish or edit ' . $template_model->fiscal_year . ' AWPB template.');
                  
                        }
                
            }
        

            return $this->render('create', [
                        'model' => $model,
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['site/home']);
        }
    }

    /**
     * Updates an existing AwpbTemplate model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    // public function actionUpdate($id)
    // {
    //     $model = $this->findModel($id);
    //     if ($model->load(Yii::$app->request->post()) && $model->save(true,['budget_theme','comment','status','updated_at','updated_by'])) {
    //         return $this->redirect(['view', 'id' => $model->id]);
    //     }
    //     return $this->render('update', [
    //         'model' => $model,
    //     ]);
    // }


    public function actionDownloadGuideline($id, $id1) {

        $model = $this->findModel($id);
        $audit_msg = "";
        $filePath = '/web/uploads/awpb';
        $completePath = Yii::getAlias('@backend' . $filePath . '/' . $model->guideline_file);
        // $completePath = Yii::getAlias($filePath . '/');
        $file_name = "";
        //$story_model = Storyofchange::findOne($id1);

        $audit_msg = $model->fiscal_year . " Budget guideline was downloaded";

        $file_name = !empty($model->guideline_file) ? $model->guideline_file : "Budget guideline";

        $ath = new AuditTrail();
        $ath->user = Yii::$app->user->id;
        $ath->action = $audit_msg;
        $ath->ip_address = Yii::$app->request->getUserIP();
        $ath->user_agent = Yii::$app->request->getUserAgent();
        $ath->save();
        header("Content-type:application/pdf");
        return Yii::$app->response->sendFile($completePath, $file_name, ['inline' => true]);
    }

    public function actionUploadGuideline($id, $id1) {
        if (User::userIsAllowedTo('Setup AWPB')) {
            // $model = $this->findModel($id);
            $model = \backend\models\AwpbBudgetGuideline::findOne($id);
            // $file = $model->file;
            if (Yii::$app->request->isAjax) {
                $model->load(Yii::$app->request->post());
                return Json::encode(\yii\widgets\ActiveForm::validate($model));
            }

            if ($model->load(Yii::$app->request->post())) {
                $model->updated_by = Yii::$app->user->identity->id;
                $media_file = UploadedFile::getInstance($model, 'guideline_file');
                if (!empty($media_file)) {
                    $file_name = $model->fiscal_year . '-AWPB-Guidelines.' . $media_file->extension;
                    $media_file->saveAs(Yii::getAlias('@backend') . '/web/uploads/awpb/' . $file_name);
                    $model->updated_by = Yii::$app->user->id;
                    $model->guideline_file = $file_name;
                }

                if ($model->save(false)) {
                    $audit = new AuditTrail();
                    $audit->user = Yii::$app->user->id;
                    $audit->action = $model->fiscal_year . " AWPB guideline file uploaded. ";
                    $audit->ip_address = Yii::$app->request->getUserIP();
                    $audit->user_agent = Yii::$app->request->getUserAgent();
                    $audit->save();
                    Yii::$app->session->setFlash('success', $model->fiscal_year . ' AWPB guideline file was successfully uploaded.');
                    return $this->redirect(['view', 'id' => $id]);
                } else {
                    $message = '';
                    foreach ($model->getErrors() as $error) {
                        $message .= $error[0];
                    }
                    Yii::$app->session->setFlash('error', 'Error occured while uploading' . $model->fiscal_year . 'AWPB guideline file.Error:' . $message);
                }
            }

            return $this->render('upload-guideline', [
                        'model' => $model,
                        'id' => $id, 'id1' => $id
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    public function actionUpdate($id) {
        if (User::userIsAllowedTo('Setup AWPB')) {
            $model = $this->findModel($id);

            if (Yii::$app->request->isAjax) {
                $model->load(Yii::$app->request->post());
                return Json::encode(\yii\widgets\ActiveForm::validate($model));
            }

            if ($model->load(Yii::$app->request->post())) {

                $model->updated_by = Yii::$app->user->id;
                if ($model->save()) {

                    $cost_centres = \backend\models\AwpbCostCentre::find()->all();

                    if (isset($cost_centres)) {
                        if ($cost_centres != null) {
                            $awpbTemplateDistrict = new AwpbDistrict();
                            foreach ($cost_centres as $cost_centre) {
                                $_awpb_district = AwpbDistrict::findOne(['awpb_template_id' => $model->id, 'cost_centre_id' => $cost_centre->id]);
                                if (empty($_awpb_district)) {
                                    $awpbTemplateDistrict->awpb_template_id = $id;
                                    $awpbTemplateDistrict->cost_centre_id = $cost_centre->id;

                                    $awpbTemplateDistrict->name = $cost_centre->name;

                                    $awpbTemplateDistrict->id = NULL; //primary key(auto increment id) id
                                    $awpbTemplateDistrict->isNewRecord = true;

                                    $awpbTemplateDistrict->updated_by = Yii::$app->user->id;
                                    $awpbTemplateDistrict->created_by = Yii::$app->user->id;

                                    $awpbTemplateDistrict->status = AwpbTemplate::STATUS_DRAFT;
                                    $awpbTemplateDistrict->save();
                                }
                            }
                        }
                    }

                    $audit = new AuditTrail();
                    $audit->user = Yii::$app->user->id;
                    $audit->action = "AWPB template '. $model->fiscal_year.' updated";
                    $audit->ip_address = Yii::$app->request->getUserIP();
                    $audit->user_agent = Yii::$app->request->getUserAgent();
                    $audit->save();
                    Yii::$app->session->setFlash('success', 'Template  was successfully updated.');
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    Yii::$app->session->setFlash('error', 'Error occurred while updating role.Please try again.');
                    return $this->render('update', ['id' => $model->id,]);
                }
            }
            return $this->render('update', [
                        'model' => $model
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    public function actionUpdate4($id) {
        if (User::userIsAllowedTo('Setup AWPB')) {
            $model = $this->findModel($id);
            $model->updated_by = Yii::$app->user->identity->id;

            if (Yii::$app->request->isAjax) {
                $model->load(Yii::$app->request->post());
                return Json::encode(\yii\widgets\ActiveForm::validate($model));
            }
            $test = "";
            if ($model->load(Yii::$app->request->post())) {

                if ($model->save(true, ['budget_theme', 'comment', 'status', 'updated_at', 'updated_by']) && $model->validate()) {

                    //$activities = \backend\models\AwpbActivity::getSubActivities();
                    $awpbTemplateActivity = new AwpbTemplateActivity();
                    $awpbTemplateActivity::deleteAll(['awpb_template_id' => $id]);

                    if (isset($model->activities)) {
                        foreach ($model->activities as $row) {
                            $awpbTemplateActivity->awpb_template_id = $id;
                            $awpbTemplateActivity->activity_id = $row[0];
                            $awpbTemplateActivity->id = NULL; //primary key(auto increment id) id
                            $awpbTemplateActivity->isNewRecord = true;
                            // $rightAllocation->right = $right;
                            //$rightAllocation->created_by = Yii::$app->user->id;
                            $awpbTemplateActivity->save(); //true,['awpb_template_id','activity_id','updated_at','updated_by']);
                            $test = $row[0];
                        }

                        $audit = new AuditTrail();
                        $audit->user = Yii::$app->user->id;
                        $audit->action = "Updated " . $model->fiscal_year . " AWPB template";
                        $audit->ip_address = Yii::$app->request->getUserIP();
                        $audit->user_agent = Yii::$app->request->getUserAgent();
                        $audit->save();
                        Yii::$app->session->setFlash('success', $model->fiscal_year . " AWPB template details were successfully updated. " . $test);
                        Yii::$app->session->setFlash('error', var_dump($model->activities));

                        // return $this->redirect(['view', 'id' => $model->id]); 
                    }
                    Yii::$app->session->setFlash('error', var_dump($model->activities));
                } else {
                    $message = '';
                    foreach ($model->getErrors() as $error) {
                        $message .= $error[0];
                    }
                    Yii::$app->session->setFlash('error', "Error occured while updating " . $model->fiscal_year . " template details Please try again.Error:" . $message);
                    return $this->render('update', [
                                'model' => $model,
                    ]);
                }
                Yii::$app->session->setFlash('error', var_dump($model->activities));

                //return $this->redirect(['view', 'id' => $model->id]);
            }

            return $this->render('update', [
                        'model' => $model,
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['site/home']);
        }
    }

    public function actionUpdate2($id) {
        if (User::userIsAllowedTo('Setup AWPB')) {
            $model = $this->findModel($id);
            if (Yii::$app->request->isAjax) {
                $model->load(Yii::$app->request->post());
                return Json::encode(\yii\widgets\ActiveForm::validate($model));
            }


            $activities = $model->activities;
            $array = [];
            foreach ($activities as $act => $v) {
                array_push($array, $act);
            }

            $model->activities = $array;
            if ($model->load(Yii::$app->request->post())) {
                if (!empty($model->activities)) {
                    $model->updated_by = Yii::$app->user->id;
                    if ($model->save()) {
                        $awpbTemplateActivity = new AwpbTemplateActivity();
                        $awpbTemplateActivity::deleteAll(['awpb_template_id' => $id]);
                        foreach ($model->activities as $activity) {
                            //check if the right was already assigned to this role

                            $awpbTemplateActivity->awpb_template_id = $id;
                            $awpbTemplateActivity->activity_id = $activity;
                            $awpbTemplateActivity->id = NULL; //primary key(auto increment id) id
                            $awpbTemplateActivity->isNewRecord = true;
                            // $rightAllocation->right = $right;
                            //$rightAllocation->created_by = Yii::$app->user->id;
                            $awpbTemplateActivity->save();
                        }

                        //check if current user has the role that has just been edited so that we update the permissions instead of user logging out
                        // if (Yii::$app->getUser()->identity->role == $model->id) {
                        //     $awpbTemplateActivityArray = \backend\models\AwpbTemplateActivity::getActivities($model->id);
                        //     ($id);
                        //     $awpbTemplateActivity = implode(",", $awpbTemplateActivityArray);
                        //    // $session = Yii::$app->session;
                        //    // $session->set('rights', $rights);
                        // }

                        $audit = new AuditTrail();
                        $audit->user = Yii::$app->user->id;
                        $audit->action = "Update tempate" . $model->activities;
                        $audit->ip_address = Yii::$app->request->getUserIP();
                        $audit->user_agent = Yii::$app->request->getUserAgent();
                        $audit->save();
                        Yii::$app->session->setFlash('success', 'Template ' . $model->activities . ' was successfully updated.');
                        return $this->redirect(['view', 'id' => $model->id]);
                    } else {
                        Yii::$app->session->setFlash('error', 'Error occurred while updating role.Please try again.');
                        return $this->render('update', ['id' => $model->id,]);
                    }
                } else {
                    Yii::$app->session->setFlash('error', 'You need to select at least one right!');
                    //    Yii::$app->session->setFlash('error', var_dump($model->activities));
                    return $this->render('update', ['id' => $model->id,
                                'model' => $model
                    ]);
                }
            }

            return $this->render('update', [
                        'model' => $model
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    /**
     * Deletes an existing AwpbTemplate model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    /*  public function actionDelete($id)
      {
      $this->findModel($id)->delete();

      return $this->redirect(['index']);
      }
     */

    public function actionDelete($id) {
        //For now we just set the user status to User::STATUS_DELETED
        if (User::userIsAllowedTo('Setup AWPB')) {
           
           try {
                $model = $this->findModel($id);
            $this->findModel($id)->delete();

            
                $audit = new AuditTrail();
                $audit->user = Yii::$app->user->id;
                $audit->action = 'Delete' . $model->fiscal_year . ' AWPB Template';
                $audit->ip_address = Yii::$app->request->getUserIP();
                $audit->user_agent = Yii::$app->request->getUserAgent();
                $audit->save();
                Yii::$app->session->setFlash('success', "The template was successfully deleted.");
            
            
              return $this->redirect(['index']);
               } catch (\Exception $ex) {
                          //  $transaction->rollBack();
                            Yii::$app->session->setFlash('error', 'Error occured while deleting the AWPB Template.' . $ex->getMessage() . ' Please try again');
                           
                         return $this->redirect(['view','id'=>$id ]);
                            
               }
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['site/home']);
        }
    }

    public function actionCq() {
        $model = AwpbTemplate::find()->where(['status' => \backend\models\AwpbTemplate::STATUS_CURRENT_BUDGET])->one();

        //  $model = $this->findModel($id);
        $old_quarter = $model->quarter;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            Yii::$app->session->setFlash('success', 'Quarter changed from Q' . $old_quarter . ' to Q' . $model->quarter . ' successfully.');
            return $this->redirect(['site/home']);
        }

        return $this->render('cq', [
                    'model' => $model,
        ]);
    }

    public function actionRollover() {
        if (User::userIsAllowedTo("Setup AWPB")) {
            $model = AwpbTemplate::find()->where(['status' => \backend\models\AwpbTemplate::STATUS_CURRENT_BUDGET])->one();
            $_model = AwpbTemplate::find()->where(['status' => \backend\models\AwpbTemplate::STATUS_PUBLISHED])->one();

            if (!empty($_model)) {
                $request = Yii::$app->request;
                if ($request->isPost) {

                    $model->status = AwpbTemplate::STATUS_OLD_BUDGET;
                    $model->updated_by = Yii::$app->user->identity->id;
                    $model->save();

                    $_model->status = AwpbTemplate::STATUS_CURRENT_BUDGET;
                    $_model->quarter = AwpbTemplate::STATUS_PUBLISHED;
                    $_model->updated_by = Yii::$app->user->identity->id;
                    $_model->save();

                    if ($model->save() && $_model->save()) {

                        $audit = new AuditTrail();
                        $audit->user = Yii::$app->user->id;
                        $audit->action = 'Rollover from ' . $model->fiscal_year . ' to ' . $_model->fiscal_year;
                        $audit->ip_address = Yii::$app->request->getUserIP();
                        $audit->user_agent = Yii::$app->request->getUserAgent();
                        $audit->save();

                        $model_inputs = \backend\models\AwpbInput::find()->where(['awpb_template_id' => $_model->id])->all();
                        if (!empty($model_inputs)) {
                            foreach ($model_inputs as $model_input) {

                                $model_actual_input = new \backend\models\AwpbActualInput();
                                $model_actual_input->input_id = $model_input->id;
                                $model_actual_input->mo_1 = $model_input->mo_1;
                                $model_actual_input->mo_2 = $model_input->mo_2;
                                $model_actual_input->mo_3 = $model_input->mo_3;
                                $model_actual_input->mo_4 = $model_input->mo_4;
                                $model_actual_input->mo_5 = $model_input->mo_5;
                                $model_actual_input->mo_6 = $model_input->mo_6;
                                $model_actual_input->mo_7 = $model_input->mo_7;
                                $model_actual_input->mo_8 = $model_input->mo_8;
                                $model_actual_input->mo_9 = $model_input->mo_9;
                                $model_actual_input->mo_10 = $model_input->mo_10;
                                $model_actual_input->mo_11 = $model_input->mo_11;
                                $model_actual_input->mo_12 = $model_input->mo_12;
                                $model_actual_input->quarter_one_quantity = $model_input->quarter_one_quantity;
                                $model_actual_input->quarter_two_quantity = $model_input->quarter_two_quantity;
                                $model_actual_input->quarter_three_quantity = $model_input->quarter_three_quantity;
                                $model_actual_input->quarter_four_quantity = $model_input->quarter_four_quantity;
                                $model_actual_input->total_quantity = $model_input->total_quantity;

                                $model_actual_input->mo_1_amount = $model_input->mo_1_amount;
                                $model_actual_input->mo_2_amount = $model_input->mo_2_amount;
                                $model_actual_input->mo_3_amount = $model_input->mo_3_amount;
                                $model_actual_input->mo_4_amount = $model_input->mo_4_amount;
                                $model_actual_input->mo_5_amount = $model_input->mo_5_amount;
                                $model_actual_input->mo_6_amount = $model_input->mo_6_amount;
                                $model_actual_input->mo_7_amount = $model_input->mo_7_amount;
                                $model_actual_input->mo_8_amount = $model_input->mo_8_amount;
                                $model_actual_input->mo_9_amount = $model_input->mo_9_amount;
                                $model_actual_input->mo_10_amount = $model_input->mo_10_amount;
                                $model_actual_input->mo_11_amount = $model_input->mo_11_amount;
                                $model_actual_input->mo_12_amount = $model_input->mo_12_amount;
                                $model_actual_input->quarter_one_amount = $model_input->quarter_one_amount;
                                $model_actual_input->quarter_two_amount = $model_input->quarter_two_amount;
                                $model_actual_input->quarter_three_amount = $model_input->quarter_three_amount;
                                $model_actual_input->quarter_four_amount = $model_input->quarter_four_amount;
                                $model_actual_input->total_amount = $model_input->total_amount;

                                $model_actual_input->updated_by = Yii::$app->user->identity->id;
                                $model_actual_input->cost_centre_id = $model_input->cost_centre_id;
                                $model_actual_input->camp_id = $model_input->camp_id;
                                $model_actual_input->district_id = $model_input->district_id;
                                $model_actual_input->province_id = $model_input->province_id;
                                $model_actual_input->component_id = $model_input->component_id;

                                $model_actual_input->output_id =$model_input->output_id;
                                $model_actual_input->activity_id = $model_input->activity_id;
                                $model_actual_input->awpb_template_id = $model_input->awpb_template_id;
                                $model_actual_input->indicator_id = $model_input->indicator_id;
                                $model_actual_input->budget_id = $model_input->budget_id;
                                $model_actual_input->name = $model_input->name;
                                $model_actual_input->unit_cost = $model_input->unit_cost;
                                $model_actual_input->unit_of_measure_id= $model_input->unit_of_measure_id;
                                $model_actual_input->status = $model_input->status;
                                $model_actual_input->save();
                            }
                        }


                        $template_id = $_model->id;

                        $model_template_activities = \backend\models\AwpbTemplateActivity::find()->where(['awpb_template_id' => $template_id])->all();
                        if (!empty($model_template_activities)) {
                            foreach ($model_template_activities as $model_template_activity) {

                                $total_percentage = 0.0;
                                $total_amt = 0.0;
                                $ifad_percentage = !empty($model_template_activity->ifad) ? $model_template_activity->ifad : 0;
                                $ifad_grant_percentage = !empty($model_template_activity->ifad_grant) ? $model_template_activity->ifad_grant : 0;
                                $grz_percentage = !empty($model_template_activity->grz) ? $model_template_activity->grz : 0;
                                $beneficiaries_percentage = !empty($model_template_activity->beneficiaries) ? $model_template_activity->beneficiaries : 0;
                                $private_sector_percentage = !empty($model_template_activity->private_sector) ? $model_template_activity->private_sector : 0;
                                $iapri_percentage = !empty($model_template_activity->iapri) ? $model_template_activity->iapri : 0;
                                $parm_percentage = !empty($model_template_activity->parm) ? $model_template_activity->parm : 0;

                                $total_percentage = $ifad_percentage + $ifad_grant_percentage + $grz_percentage + $beneficiaries_percentage + $private_sector_percentage + $iapri_percentage + $parm_percentage;
                                if ($total_percentage == 100) {
                                    $model_template_activity->mo_1_amount = \backend\models\AwpbInput::find()->where(['activity_id' => $model_template_activity->activity_id])->andWhere(['awpb_template_id' => $model_template_activity->awpb_template_id])->sum('mo_1_amount');
                                    $model_template_activity->mo_2_amount = \backend\models\AwpbInput::find()->where(['activity_id' => $model_template_activity->activity_id])->andWhere(['awpb_template_id' => $model_template_activity->awpb_template_id])->sum('mo_2_amount');
                                    $model_template_activity->mo_3_amount = \backend\models\AwpbInput::find()->where(['activity_id' => $model_template_activity->activity_id])->andWhere(['awpb_template_id' => $model_template_activity->awpb_template_id])->sum('mo_3_amount');
                                    $model_template_activity->mo_4_amount = \backend\models\AwpbInput::find()->where(['activity_id' => $model_template_activity->activity_id])->andWhere(['awpb_template_id' => $model_template_activity->awpb_template_id])->sum('mo_4_amount');
                                    $model_template_activity->mo_5_amount = \backend\models\AwpbInput::find()->where(['activity_id' => $model_template_activity->activity_id])->andWhere(['awpb_template_id' => $model_template_activity->awpb_template_id])->sum('mo_5_amount');
                                    $model_template_activity->mo_6_amount = \backend\models\AwpbInput::find()->where(['activity_id' => $model_template_activity->activity_id])->andWhere(['awpb_template_id' => $model_template_activity->awpb_template_id])->sum('mo_6_amount');
                                    $model_template_activity->mo_7_amount = \backend\models\AwpbInput::find()->where(['activity_id' => $model_template_activity->activity_id])->andWhere(['awpb_template_id' => $model_template_activity->awpb_template_id])->sum('mo_7_amount');
                                    $model_template_activity->mo_8_amount = \backend\models\AwpbInput::find()->where(['activity_id' => $model_template_activity->activity_id])->andWhere(['awpb_template_id' => $model_template_activity->awpb_template_id])->sum('mo_8_amount');
                                    $model_template_activity->mo_9_amount = \backend\models\AwpbInput::find()->where(['activity_id' => $model_template_activity->activity_id])->andWhere(['awpb_template_id' => $model_template_activity->awpb_template_id])->sum('mo_9_amount');
                                    $model_template_activity->mo_10_amount = \backend\models\AwpbInput::find()->where(['activity_id' => $model_template_activity->activity_id])->andWhere(['awpb_template_id' => $model_template_activity->awpb_template_id])->sum('mo_10_amount');
                                    $model_template_activity->mo_11_amount = \backend\models\AwpbInput::find()->where(['activity_id' => $model_template_activity->activity_id])->andWhere(['awpb_template_id' => $model_template_activity->awpb_template_id])->sum('mo_11_amount');
                                    $model_template_activity->mo_12_amount = \backend\models\AwpbInput::find()->where(['activity_id' => $model_template_activity->activity_id])->andWhere(['awpb_template_id' => $model_template_activity->awpb_template_id])->sum('mo_12_amount');
                                    $model_template_activity->quarter_one_amount = \backend\models\AwpbInput::find()->where(['activity_id' => $model_template_activity->activity_id])->andWhere(['awpb_template_id' => $model_template_activity->awpb_template_id])->sum('quarter_one_amount ');
                                    $model_template_activity->quarter_two_amount = \backend\models\AwpbInput::find()->where(['activity_id' => $model_template_activity->activity_id])->andWhere(['awpb_template_id' => $model_template_activity->awpb_template_id])->sum('quarter_two_amount ');
                                    $model_template_activity->quarter_three_amount = \backend\models\AwpbInput::find()->where(['activity_id' => $model_template_activity->activity_id])->andWhere(['awpb_template_id' => $model_template_activity->awpb_template_id])->sum('quarter_three_amount ');
                                    $model_template_activity->quarter_four_amount = \backend\models\AwpbInput::find()->where(['activity_id' => $model_template_activity->activity_id])->andWhere(['awpb_template_id' => $model_template_activity->awpb_template_id])->sum('quarter_four_amount ');
                                    $model_template_activity->budget_amount = \backend\models\AwpbInput::find()->where(['activity_id' => $model_template_activity->activity_id])->andWhere(['awpb_template_id' => $model_template_activity->awpb_template_id])->sum('total_amount');
                                    $model_template_activity->ifad_amount = ($ifad_percentage * $model_template_activity->budget_amount) / 100;
                                    $model_template_activity->ifad_grant_amount = ($ifad_grant_percentage * $model_template_activity->budget_amount) / 100;
                                    $model_template_activity->grz_amount = ($grz_percentage * $model_template_activity->budget_amount) / 100;
                                    $model_template_activity->beneficiaries_amount = ($beneficiaries_percentage * $model_template_activity->budget_amount) / 100;
                                    $model_template_activity->private_sector_amount = ($private_sector_percentage * $model_template_activity->budget_amount) / 100;
                                    $model_template_activity->iapri_amount = ($iapri_percentage * $model_template_activity->budget_amount) / 100;
                                    $model_template_activity->parm_amount = ($parm_percentage * $model_template_activity->budget_amount) / 100;
                                    if ($model_template_activity->save()) {
                                        $model_activity = \backend\models\AwpbActivity::findOne(['id' => $model_template_activity->activity_id]);
                                        //$model_template = \backend\models\AwpbTemplate::findModel(['id' => $model_template_activity->awpb_template_id]);
                                        $model_expense_category = \backend\models\AwpbExpenseCategory::findOne(['id' => $model_activity->expense_category_id]);
                                        $model_component = \backend\models\AwpbComponent::findOne(['id' => $model_activity->component_id]);
                                        $model_funder = \backend\models\AwpbFunder::find()->all();
                                        //var_dump($model_activity->name);
                                        $percent = 0.0;
                                        $gl_account = "";
                                        if ($model_template_activity->budget_amount > 0) {
                                            foreach ($model_funder as $funder) {

                                                if ($funder->name == "IFAD") {
                                                    $percent = $ifad_percentage;
                                                    $gl_account = $model_activity->gl_account_code . "/" . $model_component->gl_account_code . "/" . $model_expense_category->code . "/0" . $funder->code;
                                                }
                                                if ($funder->name == "IFAD Grant") {
                                                    $percent = $ifad_grant_percentage;
                                                    $gl_account = $model_activity->gl_account_code . "/" . $model_component->gl_account_code . "/" . $model_expense_category->code . "/0" . $funder->code;
                                                }
                                                if ($funder->name == "GRZ") {
                                                    $percent = $grz_percentage;
                                                    $gl_account = $model_activity->gl_account_code . "/" . $model_component->gl_account_code . "/" . $model_expense_category->code . "/0" . $funder->code;
                                                }
                                                if ($funder->name == "Private Sector") {
                                                    $percent = $private_sector_percentage;
                                                    $gl_account = $model_activity->gl_account_code . "/" . $model_component->gl_account_code . "/" . $model_expense_category->code . "/0" . $funder->code;
                                                }
                                                if ($funder->name == "Beneficiaries") {
                                                    $percent = $beneficiaries_percentage;
                                                    $gl_account = $model_activity->gl_account_code . "/" . $model_component->gl_account_code . "/" . $model_expense_category->code . "/0" . $funder->code;
                                                }
                                                if ($funder->name == "IAPRI") {
                                                    $percent = $iapri_percentage;
                                                    $gl_account = $model_activity->gl_account_code . "/" . $model_component->gl_account_code . "/" . $model_expense_category->code . "/0" . $funder->code;
                                                } if ($funder->name == "PARM") {
                                                    $percent = $parm_percentage;
                                                    $gl_account = $model_activity->gl_account_code . "/" . $model_component->gl_account_code . "/" . $model_expense_category->code . "/0" . $funder->code;
                                                }
                                                $_model_general_ledger = \backend\models\AwpbGeneralLedger::find()
                                                                // ->where(['activity_id' => $model_template_activity->activity_id])
                                                                ->where(['awpb_template_id' => $model_template_activity->awpb_template_id])
                                                                //->andWhere(['funder_id' => $model_template_activity->funder_id])
                                                                ->andWhere(['general_ledger_account' => $gl_account])->one();
                                                if (empty($_model_general_ledger)) {
                                                    $model_general_ledger = new \backend\models\AwpbGeneralLedger();
                                                    $model_general_ledger->general_ledger_account = $gl_account;
                                                    $model_general_ledger->activity_id = $model_template_activity->activity_id;
                                                    $model_general_ledger->component_id = $model_activity->component_id;
                                                    $model_general_ledger->awpb_template_id = $model_template_activity->awpb_template_id;
                                                    $model_general_ledger->funder_id = $funder->id;
                                                    $model_general_ledger->expense_category_id = $model_activity->expense_category_id;
                                                    $model_general_ledger->mo_1_amount = ($model_template_activity->mo_1_amount * $percent) / 100;
                                                    $model_general_ledger->mo_2_amount = ($model_template_activity->mo_2_amount * $percent) / 100;
                                                    $model_general_ledger->mo_3_amount = ($model_template_activity->mo_3_amount * $percent) / 100;
                                                    $model_general_ledger->mo_4_amount = ($model_template_activity->mo_4_amount * $percent) / 100;
                                                    $model_general_ledger->mo_5_amount = ($model_template_activity->mo_5_amount * $percent) / 100;
                                                    $model_general_ledger->mo_6_amount = ($model_template_activity->mo_6_amount * $percent) / 100;
                                                    $model_general_ledger->mo_7_amount = ($model_template_activity->mo_7_amount * $percent) / 100;
                                                    $model_general_ledger->mo_8_amount = ($model_template_activity->mo_8_amount * $percent) / 100;
                                                    $model_general_ledger->mo_9_amount = ($model_template_activity->mo_9_amount * $percent) / 100;
                                                    $model_general_ledger->mo_10_amount = ($model_template_activity->mo_10_amount * $percent) / 100;
                                                    $model_general_ledger->mo_11_amount = ($model_template_activity->mo_11_amount * $percent) / 100;
                                                    $model_general_ledger->mo_12_amount = ($model_template_activity->mo_12_amount * $percent) / 100;
                                                    $model_general_ledger->quarter_one_amount = ($model_template_activity->quarter_one_amount * $percent) / 100;
                                                    $model_general_ledger->quarter_two_amount = ($model_template_activity->quarter_two_amount * $percent) / 100;
                                                    $model_general_ledger->quarter_three_amount = ( $model_template_activity->quarter_three_amount * $percent) / 100;
                                                    $model_general_ledger->quarter_four_amount = ($model_template_activity->quarter_four_amount * $percent) / 100;
                                                    $model_general_ledger->updated_by = Yii::$app->user->identity->id;
                                                    $model_general_ledger->created_by = Yii::$app->user->identity->id;
                                                     $model_general_ledger->save();

                                                } else {

                                                    $_model_general_ledger->mo_1_amount = ($model_template_activity->mo_1_amount * $percent) / 100;
                                                    $_model_general_ledger->mo_2_amount = ($model_template_activity->mo_2_amount * $percent) / 100;
                                                    $_model_general_ledger->mo_3_amount = ($model_template_activity->mo_3_amount * $percent) / 100;
                                                    $_model_general_ledger->mo_4_amount = ($model_template_activity->mo_4_amount * $percent) / 100;
                                                    $_model_general_ledger->mo_5_amount = ($model_template_activity->mo_5_amount * $percent) / 100;
                                                    $_model_general_ledger->mo_6_amount = ($model_template_activity->mo_6_amount * $percent) / 100;
                                                    $_model_general_ledger->mo_7_amount = ($model_template_activity->mo_7_amount * $percent) / 100;
                                                    $_model_general_ledger->mo_8_amount = ($model_template_activity->mo_8_amount * $percent) / 100;
                                                    $_model_general_ledger->mo_9_amount = ($model_template_activity->mo_9_amount * $percent) / 100;
                                                    $_model_general_ledger->mo_10_amount = ($model_template_activity->mo_10_amount * $percent) / 100;
                                                    $_model_general_ledger->mo_11_amount = ($model_template_activity->mo_11_amount * $percent) / 100;
                                                    $_model_general_ledger->mo_12_amount = ($model_template_activity->mo_12_amount * $percent) / 100;
                                                    $_model_general_ledger->quarter_one_amount = ($model_template_activity->quarter_one_amount * $percent) / 100;
                                                    $_model_general_ledger->quarter_two_amount = ($model_template_activity->quarter_two_amount * $percent) / 100;
                                                    $_model_general_ledger->quarter_three_amount = ( $model_template_activity->quarter_three_amount * $percent) / 100;
                                                    $_model_general_ledger->quarter_four_amount = ($model_template_activity->quarter_four_amount * $percent) / 100;
                                                    $_model_general_ledger->updated_by = Yii::$app->user->identity->id;
                                                    $_model_general_ledger->created_by = Yii::$app->user->identity->id;
                                                    $_model_general_ledger->save();
                                                }
                                            }
                                        }
                                        $audit = new AuditTrail();

                                        $audit->user = Yii::$app->user->id;
                                        $audit->action = "Activity no. " . $model_template_activity->activity_id . " funding profile set";
                                        $audit->ip_address = Yii::$app->request->getUserIP();
                                        $audit->user_agent = Yii::$app->request->getUserAgent();
                                        $audit->save();
                                        //   Yii::$app->session->setFlash('success', 'Activity funding setting was successfully updated.');
                                    } else {
                                        $message = '';
                                        foreach ($model_template_activity->getErrors() as $error) {
                                            $message .= $error[0];
                                        }
                                        Yii::$app->session->setFlash('error', 'Error occured while setting the finding profie.Error:' . $message);
                                    }
                                } else {

                                    Yii::$app->session->setFlash('error', 'The total percentage must be 100%. Please enter the required percentage');
                                }
                            }
                        } else {
                            Yii::$app->session->setFlash('error', 'Funding profile not found. Kindly contact the systems administrator.');
                        }

                       
                    Yii::$app->session->setFlash('success', "Rollover was completed successfully.");
                    return $this->redirect('index');
                } else {
                    $message = "";
                    foreach ($_model->getErrors() as $error) {
                        $message .= $error[0];
                    }

                    Yii::$app->session->setFlash('error', 'Error occured while updating the AWPB template:' . $message);
                    return $this->redirect('index');
                }
            }
            return $this->render('rollover', [
                        'model' => $model,
                        '_model' => $_model,
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'No AWPB template has been published for you to perform this process. Kindly publish an AWPB template');
            return $this->redirect('index');
        }
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

   
     
    protected function findModel($id) {
        if (($model = AwpbTemplate::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
