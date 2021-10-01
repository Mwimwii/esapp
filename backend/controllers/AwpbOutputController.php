<?php
namespace backend\controllers;
use Yii;
use backend\models\AwpbOutput;
use backend\models\AwpbOutputSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AwpbOutputController implements the CRUD actions for AwpbOutput model.
 */
class AwpbOutputController extends Controller
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
     * Lists all AwpbOutput models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AwpbOutputSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AwpbOutput model.
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
     * Creates a new AwpbOutput model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
<<<<<<< HEAD
    {
        $model = new AwpbOutput();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
=======
    {        
           if (User::userIsAllowedTo('Setup AWPB')) {
              $model = new AwpbOutput();
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
                    $audit->action = "Added output : " . $model->name;
                    $audit->ip_address = Yii::$app->request->getUserIP();
                    $audit->user_agent = Yii::$app->request->getUserAgent();
                    $audit->save();
                    Yii::$app->session->setFlash('success', 'Output ' . $model->name . ' was successfully added.');
//                } else {
//                    Yii::$app->session->setFlash('error', 'Error occured while adding output ' . $model->name);
//                }
                } else {
                        $message = '';
                        foreach ($model->getErrors() as $error) {
                            $message .= $error[0];
                              Yii::$app->session->setFlash('error', "Error occured while creating an output: ". $message);
                              //Yii::$app->session->setFlash('error', 'Error occured while adding output ' . $model->name);
                               return $this->redirect(['index',]);
                        }
                }
                
                return $this->redirect(['index']);
            }
            return $this->render('create', [
                        'model' => $model,
                       
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
    }

    /**
     * Updates an existing AwpbOutput model.
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
     * Deletes an existing AwpbOutput model.
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
     * Finds the AwpbOutput model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AwpbOutput the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AwpbOutput::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
<<<<<<< HEAD
=======
    public function actionActivities() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            //  Yii::warning('**********************', var_export($_POST['depdrop_parents'],true));
            //   $parents = $_POST['depdrop_all_params']['parent_id'];
            $selected_id = $_POST['depdrop_params'];
            if ($parents != null) {
                $out_id = $parents[0];
                $out = \backend\models\AwpbActivity::find()
                ->select(["CONCAT(activity_code,' ',name) as name", 'id'])
                ->where(['type' =>\backend\models\AwpbActivity::TYPE_MAIN])
                ->andWhere(['output_id' => $out_id])
                ->asArray()
                ->all();


                return ['output' => $out, 'selected' => $selected_id[0]];
            }
        }
        return ['output' => '', 'selected' => ''];
    }
   public function actionIndicators() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            //  Yii::warning('**********************', var_export($_POST['depdrop_parents'],true));
            //   $parents = $_POST['depdrop_all_params']['parent_id'];
            $selected_indicator_id= $_POST['depdrop_params'];
            if ($parents != null) {
                $out_id = $parents[0];
                $out = \backend\models\AwpbIndicator::find()
                ->select(['name', 'id'])
               // ->where(['type' =>\backend\models\AwpbActivity::TYPE_MAIN])
                ->where(['output_id' => $out_id])
                ->asArray()
                ->all();


                return ['output' => $out, 'selected' => $selected_indicator_id[0]];
            }
        }
        return ['output' => '', 'selected' => ''];
    }
  
	
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
}
