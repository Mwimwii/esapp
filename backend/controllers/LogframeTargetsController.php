<?php

namespace backend\controllers;

use Yii;
use backend\models\LogframeProgrammeTargets;
use backend\models\LogframeProgrammeTargetsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Json;
use backend\models\AuditTrail;
use backend\models\User;

/**
 * LogframeTargetsController implements the CRUD actions for LogframeProgrammeTargets model.
 */
class LogframeTargetsController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index',],
                'rules' => [
                    [
                        'actions' => ['index'],
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
     * Lists all LogframeProgrammeTargets models.
     * @return mixed
     */
    public function actionIndex() {
        if (User::userIsAllowedTo('Manage logframe programe targets')) {
            $searchModel = new LogframeProgrammeTargetsSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            if (Yii::$app->request->post('hasEditable')) {
                $Id = Yii::$app->request->post('editableKey');
                $model = LogframeProgrammeTargets::findOne($Id);
                $out = Json::encode(['output' => '', 'message' => '']);
                $posted = current($_POST['LogframeProgrammeTargets']);
                $post = ['LogframeProgrammeTargets' => $posted];
                $old_id = $model->id;

                if ($model->load($post)) {
                    if ($old_id != $model->id) {
                        $audit = new AuditTrail();
                        $audit->user = Yii::$app->user->id;
                        $audit->action = "Updated Logframe target record with id:" . $Id;
                        $audit->ip_address = Yii::$app->request->getUserIP();
                        $audit->user_agent = Yii::$app->request->getUserAgent();
                        $audit->save();
                        $model->updated_by = Yii::$app->user->id;
                    }

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
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

}
