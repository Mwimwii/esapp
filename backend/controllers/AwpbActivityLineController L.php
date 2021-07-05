<?php

namespace backend\controllers;

use Yii;
use backend\models\AwpbActivityLine;
use backend\models\AwpbActivityLineSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Json;
use backend\models\AuditTrail;
use backend\models\User;
use yii\base\Model;
use yii\caching\DbDependency;
use backend\models\AwpbUnitOfMeasure;
use yii\data\ActiveDataProvider;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use backend\models\Storyofchange;
use backend\models\AwpbTemplate;
/**
 * AwpbActivityLineController implements the CRUD actions for AwpbActivityLine model.
 */
class AwpbActivityLineController extends Controller
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
     * Lists all AwpbActivityLine models.
     * @return mixed
     */
    public function actionIndex($id)
    {
        // $searchModel = new AwpbActivityLineSearch();
        // $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        // return $this->render('index', [
        //     'searchModel' => $searchModel,
        //     'dataProvider' => $dataProvider,
        // ]);

        $user = User::findOne(['id' => Yii::$app->user->id]);
        $searchModel = new AwpbActivityLineSearch();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $dataProvider->query->andFilterWhere(['awpb_template_id' => $id, 'district_id' => $user->district_id, 'created_by' => $user->id, 'status' => AWPBActivityLine::STATUS_DRAFT,]);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'id' => $id
        ]);

    }

    /**
     * Displays a single AwpbActivityLine model.
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
     * Creates a new AwpbActivityLine model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($template_id)
    {
        $model = new AwpbActivityLine();

        if ($model->load(Yii::$app->request->post())) 
        {
            if ($model->save()) 
            {
                return $this->redirect(['view', 'id' => $model->id]);
            }
            else 
            {
                $message = "";
                foreach ($model->getErrors() as $error) {
                    $message .= $error[0];
                }
                Yii::$app->session->setFlash('error', 'Error occured while adding an AWPB Indicator::' . $message);
                //  return $this->redirect(['home/home']);
            }


      
        return $this->render('create', [
            'model' => $model,
            'template_id' =>$template_id
        ]);
    }
}

    /**
     * Updates an existing AwpbActivityLine model.
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
     * Deletes an existing AwpbActivityLine model.
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
     * Finds the AwpbActivityLine model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AwpbActivityLine the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AwpbActivityLine::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
