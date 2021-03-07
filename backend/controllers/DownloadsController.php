<?php

namespace backend\controllers;

use Yii;
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
class DownloadsController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['farmer-registration-form'],
                'rules' => [
                    [
                        'actions' => ['farmer-registration-form'],
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

    public function actionFarmerRegistrationForm() {
        $filename = "cate_a_farmer_registration_form" . date("Ymdhis") . ".pdf";
        $ath = new AuditTrail();
        $ath->user = Yii::$app->user->id;
        $ath->action = "Downloaded category A Farmer registration form";
        $ath->ip_address = Yii::$app->request->getUserIP();
        $ath->user_agent = Yii::$app->request->getUserAgent();
        $ath->save();
        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        $pdf = new Pdf([
            'mode' => Pdf::MODE_CORE,
            // A4 paper format
            'format' => Pdf::FORMAT_A4,
            // portrait orientation
            'orientation' => Pdf::ORIENT_LANDSCAPE,
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
            'content' => $this->renderPartial('farmer-registration-form', []),
            'options' => [
                'text_input_as_HTML' => true,
                'page-break-inside' => false
            // any mpdf options you wish to set
            ],
            'methods' => [
                'SetTitle' => 'Category A Farmer registration form',
                //'SetSubject' => 'Generating PDF files via yii2-mpdf extension has never been easy',
                'SetHeader' => ['MOA/ESAPP Category A Farmer registration form||' . date("r") . "/ESAPP online system"],
                'SetFooter' => ['|Page {PAGENO}|'],
                'SetAuthor' => 'ESAPP online system',
            ]
        ]);
        $pdf->filename = $filename;
        return $pdf->render();
    }

    public function actionFaabsAttendanceSheet() {

        $filename = "faabs_attendance_sheet" . date("Ymdhis") . ".pdf";
        $ath = new AuditTrail();
        $ath->user = Yii::$app->user->id;
        $ath->action = "Downloaded FaaBS training attendance sheet";
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
            'content' => $this->renderPartial('faabs-attendance-sheet',
                    [
                        'province' => "",
                        'district' => "",
                        'camp' => "",
                        'faabs_group' => "",
            ]),
            'options' => [
                'text_input_as_HTML' => true,
                'page-break-inside' => false
            // any mpdf options you wish to set
            ],
            'methods' => [
                'SetTitle' => 'FaaBS training attendance sheet',
                //'SetSubject' => 'Generating PDF files via yii2-mpdf extension has never been easy',
                'SetHeader' => ['MOA/ESAPP FaaBS training attendance sheet||' . date("r") . "/ESAPP online system"],
                'SetFooter' => ['|Page {PAGENO}|'],
                'SetAuthor' => 'ESAPP online system',
            ]
        ]);
        $pdf->filename = $filename;
        return $pdf->render();
    }

}
