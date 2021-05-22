<?php

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use backend\models\User;
use backend\models\UserSearch;
use backend\models\AuditTrail;
use kartik\mpdf\Pdf;

class HomeController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['home','faabs-attendance-sheet'],
                'rules' => [
                    [
                        'actions' => ['home','faabs-attendance-sheet'],
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

    public function actionHome() {
        $this->layout = 'main';
        return $this->render('home', [
        ]);
    }

    public function actionFaabsAttendanceSheet() {

        $model = new \backend\models\Downloads();
        $model->load(Yii::$app->request->post());
        $district_model = \backend\models\Districts::findOne(['id' => Yii::$app->user->identity->district_id]);
        $district = !empty($district_model) ? $district_model->name : "";
        $province = !empty($district_model) ? \backend\models\Provinces::findOne(['id' => $district_model->province_id])->name : "";
        $faabs_group = \backend\models\MeFaabsGroups::findOne($model->faabs_group);
        $camp = \backend\models\Camps::findOne($model->camp)->name;
        $topic = !empty($model->topic) ? \backend\models\MeFaabsTrainingTopics::findOne($model->topic)->topic : "";

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
                        'province' => $province,
                        'district' => $district,
                        'camp' => $camp,
                        'topic' => $topic,
                        'faabs_group' => $faabs_group,
            ]),
            'options' => [
                'text_input_as_HTML' => true,
                'target' => '_blank',
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
