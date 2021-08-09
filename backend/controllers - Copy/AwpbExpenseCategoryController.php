<?php

namespace backend\controllers;

use Yii;
use backend\models\AwpbExpenseCategory;
use backend\models\AwpbExpenseCategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Json;
use backend\models\AuditTrail;
use backend\models\User;


/**
 * AwpbExpenseCategoryController implements the CRUD actions for AwpbExpenseCategory model.
 */
class AwpbExpenseCategoryController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'create', 'update', 'delete', 'view'],
                'rules' => [
                    [
                        'actions' => ['index', 'create', 'update', 'delete', 'view'],
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
     * Lists all AwpbExpenseCategory models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AwpbExpenseCategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AwpbExpenseCategory model.
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
     * Creates a new AwpbExpenseCategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
       

        if (User::userIsAllowedTo('Setup AWPB')) {
            $model = new AwpbExpenseCategory();
            //$model = $this->findModel($id);
            $model->updated_by = Yii::$app->user->identity->id;

            if (Yii::$app->request->isAjax) {
                $model->load(Yii::$app->request->post());
                return Json::encode(\yii\widgets\ActiveForm::validate($model));
            }
          

            if ($model->load(Yii::$app->request->post())) {
               
               
                if ($model->save() && $model->validate()) {
                    $audit = new AuditTrail();
                    $audit->user = Yii::$app->user->id;
                    $audit->action = "Updated Expense Category " . $model->name ;
                    $audit->ip_address = Yii::$app->request->getUserIP();
                    $audit->user_agent = Yii::$app->request->getUserAgent();
                    $audit->save();
                    Yii::$app->session->setFlash('success', $model->name. " details were successfully updated.");
                    return $this->redirect(['view', 'id' => $model->id]); 
                   
                } else {
                    $message = '';
                    foreach ($model->getErrors() as $error) {
                        $message .= $error[0];
                    }
                    Yii::$app->session->setFlash('error', "Error occured while updating " .$model->name." details Please try again.Error:" . $message);
                    return $this->render('update', [
                        'model' => $model,                      
                    ]);
                }
               
                return $this->redirect(['view', 'id' => $model->id]);
            }

            return $this->render('update', [
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
     * Updates an existing AwpbExpenseCategory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (User::userIsAllowedTo('Setup AWPB')) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
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
     * Deletes an existing AwpbExpenseCategory model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (User::userIsAllowedTo('Setup AWPB')) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    else 
		{
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['site/home']);
        }
    }

    /**
     * Finds the AwpbExpenseCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AwpbExpenseCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AwpbExpenseCategory::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
