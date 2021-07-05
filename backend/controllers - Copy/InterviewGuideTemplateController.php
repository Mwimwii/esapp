<?php

namespace backend\controllers;

use Yii;
use backend\models\LkmStoryofchangeInterviewGuideTemplateQuestions;
use backend\models\LkmStoryofchangeInterviewGuideTemplateQuestionsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Json;
use backend\models\AuditTrail;
use backend\models\User;
use kartik\mpdf\Pdf;

/**
 * InterviewGuideTemplateController implements the CRUD actions for LkmStoryofchangeInterviewGuideTemplateQuestions model.
 */
class InterviewGuideTemplateController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'create', 'delete', 'download-template'],
                'rules' => [
                    [
                        'actions' => ['index', 'create', 'delete', 'download-template'],
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
     * Lists all LkmStoryofchangeInterviewGuideTemplateQuestions models.
     * @return mixed
     */
    public function actionIndex() {
        if (User::userIsAllowedTo('Manage interview guide template questions') ||
        User::userIsAllowedTo('View interview guide template')) {
            $model = new LkmStoryofchangeInterviewGuideTemplateQuestions();
            $searchModel = new LkmStoryofchangeInterviewGuideTemplateQuestionsSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            if (Yii::$app->request->post('hasEditable')) {
                $Id = Yii::$app->request->post('editableKey');
                $model = LkmStoryofchangeInterviewGuideTemplateQuestions::findOne($Id);
                $out = Json::encode(['output' => '', 'message' => '']);
                $posted = current($_POST['LkmStoryofchangeInterviewGuideTemplateQuestions']);
                $post = ['LkmStoryofchangeInterviewGuideTemplateQuestions' => $posted];
                $old_question = $model->question;
                $old_number = $model->number;
                $old_section = $model->section;
                $action = "";

                if ($model->load($post)) {
                    if ($old_question != $model->question) {
                        $action = "Updated interview guide question from:' $old_question ' to '" . $model->question . "'";
                    }
                    if ($old_number != $model->number) {
                        $action = "Updated interview guide question number from $old_number to " . $model->number;
                    }
                    if ($old_section != $model->section) {
                        $action = "Updated interview guide question section from $old_section to " . $model->section;
                    }

                    $audit = new AuditTrail();
                    $audit->user = Yii::$app->user->id;
                    $audit->action = $action;
                    $audit->ip_address = Yii::$app->request->getUserIP();
                    $audit->user_agent = Yii::$app->request->getUserAgent();
                    $audit->save();
                    $model->updated_by = Yii::$app->user->id;

                    $message = '';
                    if (!$model->save()) {
                        foreach ($model->getErrors() as $error) {
                            $message .= $error[0];
                        }
                        $output = $message;
                    }
                    $output = '';
                    $out = Json::encode(['output' => $output, 'message' => $message]);
                }
                return $out;
            }
            return $this->render('index', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                        'model' => $model,
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    /**
     * Displays a single LkmStoryofchangeInterviewGuideTemplateQuestions model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    /* public function actionView($id) {
      return $this->render('view', [
      'model' => $this->findModel($id),
      ]);
      } */

    /**
     * Creates a new LkmStoryofchangeInterviewGuideTemplateQuestions model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        if (User::userIsAllowedTo('Manage interview guide template questions')) {
            $model = new LkmStoryofchangeInterviewGuideTemplateQuestions();
            if (Yii::$app->request->isAjax) {
                $model->load(Yii::$app->request->post());
                return Json::encode(\yii\widgets\ActiveForm::validate($model));
            }

            if ($model->load(Yii::$app->request->post())) {

                $model->created_by = Yii::$app->user->identity->id;
                $model->updated_by = Yii::$app->user->identity->id;
                if ($model->save()) {
                    $audit = new AuditTrail();
                    $audit->user = Yii::$app->user->id;
                    $audit->action = "Added interview guide question::'" . $model->question . "'";
                    $audit->ip_address = Yii::$app->request->getUserIP();
                    $audit->user_agent = Yii::$app->request->getUserAgent();
                    $audit->save();
                    Yii::$app->session->setFlash('success', 'Interview guide question was successfully added.');
                } else {
                    Yii::$app->session->setFlash('error', 'Error occured while adding Interview guide question ');
                }
                return $this->redirect(['index']);
            }
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    /**
     * Deletes an existing LkmStoryofchangeInterviewGuideTemplateQuestions model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        if (User::userIsAllowedTo('Remove interview guide template question')) {
            $model = $this->findModel($id);
            $name = $model->question;
            if ($model->delete()) {
                $audit = new AuditTrail();
                $audit->user = Yii::$app->user->id;
                $audit->action = "Removed interview guide question: '$name' from the system.";
                $audit->ip_address = Yii::$app->request->getUserIP();
                $audit->user_agent = Yii::$app->request->getUserAgent();
                $audit->save();
                Yii::$app->session->setFlash('success', "Interview guide question was successfully removed.");
            } else {
                Yii::$app->session->setFlash('error', "Interview guide question could not be removed. Please try again!");
            }

            return $this->redirect(['index']);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    /**
     * Finds the LkmStoryofchangeInterviewGuideTemplateQuestions model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return LkmStoryofchangeInterviewGuideTemplateQuestions the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = LkmStoryofchangeInterviewGuideTemplateQuestions::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionDownloadTemplate() {
        $filename = "interview_guide_template-" . date("Ymdhis") . ".pdf";
        $ath = new AuditTrail();
        $ath->user = Yii::$app->user->id;
        $ath->action = "Downloaded Story of change interview guide template";
        $ath->ip_address = Yii::$app->request->getUserIP();
        $ath->user_agent = Yii::$app->request->getUserAgent();
        $ath->save();
        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        $pdf = new Pdf([
            'mode' => Pdf::MODE_CORE,
            // A4 paper format
            'format' => Pdf::FORMAT_A4,
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
            'content' => $this->renderPartial('download-template', []),
            'options' => [
                'text_input_as_HTML' => true,
            // any mpdf options you wish to set
            ],
            'methods' => [
                'SetTitle' => 'Story of change interview guide',
                //'SetSubject' => 'Generating PDF files via yii2-mpdf extension has never been easy',
                'SetHeader' => ['MOA/ESAPP Story of change interview guide||' . date("r") . "/ESAPP online system"],
                'SetFooter' => ['|Page {PAGENO}|'],
                'SetAuthor' => 'ESAPP online system',
            ]
        ]);
        $pdf->filename = $filename;
        return $pdf->render();
    }

}
