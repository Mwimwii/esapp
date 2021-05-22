<?php

namespace backend\controllers;

use Yii;
use backend\models\AwpbTemplate;
use backend\models\AwpbTemplateSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AwpbTemplateController implements the CRUD actions for AwpbTemplate model.
 */
class AwpbTemplateController extends Controller
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
     * Lists all AwpbTemplate models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AwpbTemplateSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AwpbTemplate model.
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
     * Creates a new AwpbTemplate model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
       
		if (User::userIsAllowedTo('Manage provinces')) 
		{
			 $model = new AwpbTemplate();
			 if (Yii::$app->request->isAjax) {
                $model->load(Yii::$app->request->post());
                return Json::encode(\yii\widgets\ActiveForm::validate($model));
            }

			if ($model->load(Yii::$app->request->post()) ) {
								 
				$model->created_by = Yii::$app->user->id;
                $model->updated_by = Yii::$app->user->id;
				//$model->component_code  = $comp_model->component_code . '.' .$model->component_code;
				
			 if ( $model->validate()) {
				
                if ($model->save()) {
                    $audit = new AuditTrail();
                    $audit->user = Yii::$app->user->id;
                    $audit->action = "Added template : "  . $model->fiscal_year;
                    $audit->ip_address = Yii::$app->request->getUserIP();
                    $audit->user_agent = Yii::$app->request->getUserAgent();
                    $audit->save();
                    Yii::$app->session->setFlash('success', $model->fiscal_year . 'AWPB templated was successfully added.');
                } else {
                    Yii::$app->session->setFlash(' error', 'Error occured while adding ' . $model->fiscal_year .'AWPB template.');
                }
			 
            //    return $this->redirect(['index']);
				return $this->redirect(['view', 'id' => $model->id]);
				}
				 else {
                    $message = '';
                    foreach ($model->getErrors() as $error) {
                        $message .= $error[0];
                    }
                    Yii::$app->session->setFlash('error', "Error occured while creating user: $name.Please try again.Error::" . $message);
                    return $this->render('create', ['model' => $model,]);
                }
            }
			
			return $this->render('create', [
				'model' => $model,
			]);
		} 
		else 
		{
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
     * Deletes an existing AwpbTemplate model.
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
     * Finds the AwpbTemplate model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AwpbTemplate the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AwpbTemplate::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
