<?php

namespace backend\controllers;

use Yii;
use backend\models\AwpbIndicator;
use backend\models\AwpbIndicatorSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Json;
use backend\models\AuditTrail;
use backend\models\User;
use yii\helpers\ArrayHelper;
use yii\web\IdentityInterface;
use common\models\Role;

/**
 * AwpbIndicatorController implements the CRUD actions for AwpbIndicator model.
 */
class AwpbIndicatorController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors() {
    
             return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => [
                    'delete', 'view',   'viewo', 'viewp', 'viewpwpco', 'mpc', 'mpca', 'mpcd', 'mpco', 'mpcop', 'mpcod', 'mpcoa',
                    'index', 'indexpw', 'create', 'createpw', 'update', 'updatepw', 'mpcma', 'mpcoa', 'mpca', 'mpcmd', 'mpcod', 'mpcmp', 'mpcmp',
                    'mpcop', 'mpcd', 'mpwm', 'mpcm', 'mpwpco', 'mpco', 'mpc', 'decline', 'declinepwm', 'declinem', 'declinep', 'declinepwpco', 'decline', 'submitpw', 'submit', 'mpwpcoa'
                ],
                'rules' => [
                    [
                        'actions' => [
                            'delete', 'view',   'viewo', 'viewp', 'viewpwpco', 'mpc', 'mpca', 'mpcd', 'mpco', 'mpcop', 'mpcod', 'mpcoa',
                            'index', 'indexpw', 'create', 'createpw', 'update', 'updatepw', 'mpcma', 'mpcoa', 'mpca', 'mpcmd', 'mpcod', 'mpcmp', 'mpcmp',
                            'mpcop', 'mpcd', 'mpwm', 'mpcm', 'mpwpco', 'mpco', 'mpc', 'decline', 'declinepwm', 'declinem', 'declinep', 'declinepwpco', 'decline', 'submitpw', 'submit', 'mpwpcoa'
                        ],
                        //'story/create/<id:\d+>/<usr:\d+>' => 'story/create',
                        //'awpb-activity-line/mpca/<id:\d+>/<distr:\d+>',
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
     * Lists all AwpbIndicator models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AwpbIndicatorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AwpbIndicator model.
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
    // public function actionComponentindicators() {
    //     \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    //     if (isset(Yii::$app->request->post()['depdrop_component'])) {
    //         $comp_indicators = Yii::$app->request->post('depdrop_component');
    //         if ($comp_indicators != null) {
    //             $comp_id = $comp_indicators[0];
    //             return [
    //                 'output' => AwpbIndicator::getAwpbComponentIndicators($comp_id, true),
    //                 'selected' => '',
    //             ];
    //         }
    //     }}

       
        public function actionComponentindicators() {
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            if (isset(Yii::$app->request->post()['depdrop_parents'])) {
                $parents = Yii::$app->request->post('depdrop_parents');
                if ($parents != null) {
                    $comp_id = $parents[0];
                   // $parent_comp = \backend\models\AwpbComponent::findOne(['id'=>$comp_id]);
                  // $parent_comp=   \backend\models\AwpbComponent::find()->where(['=','id',$comp_id])->one();
                    return [
                        'output' => AwpbIndicator::getAwpbComponentIndicators($comp_id, true),
                        'selected' => '',
                    ];
                }
            }}

  
    /**
     * Creates a new AwpbIndicator model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AwpbIndicator();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing AwpbIndicator model.
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
     * Deletes an existing AwpbIndicator model.
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
     * Finds the AwpbIndicator model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AwpbIndicator the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AwpbIndicator::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

   
}
