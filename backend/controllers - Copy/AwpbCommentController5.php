<?php

namespace backend\controllers;

use Yii;
use backend\models\AwpbComment;
use backend\models\AwpbCommentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Json;
use backend\models\AuditTrail;
use backend\models\User;
use backend\models\AwpbActivityLine;
use backend\models\AwpbActivityLineSearch;
use backend\models\Camps;

/**
 * AwpbCommentController implements the CRUD actions for AwpbComment model.
 */
class AwpbCommentController extends Controller
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
     * Lists all AwpbComment models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AwpbCommentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AwpbComment model.
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

    // public function actionCreate() {
    //     if (User::userIsAllowedTo('Manage camps')) {
    //         $model = new AwpbComment();
    //         if (Yii::$app->request->isAjax) {
    //             $model->load(Yii::$app->request->post());
    //             return Json::encode(\yii\widgets\ActiveForm::validate($model));
    //         }

    //         if ($model->load(Yii::$app->request->post())) {
    //             $model->created_by = Yii::$app->user->identity->id;
    //             $model->updated_by = Yii::$app->user->identity->id;
    //             if ($model->save()) {
    //                 $audit = new AuditTrail();
    //                 $audit->user = Yii::$app->user->id;
    //                 $audit->action = "Added camp " ;
    //                 $audit->ip_address = Yii::$app->request->getUserIP();
    //                 $audit->user_agent = Yii::$app->request->getUserAgent();
    //                 $audit->save();
    //                // Yii::$app->session->setFlash('success', 'Camp ' . $model->name . ' was successfully added.');
    //             } else {
    //                // Yii::$app->session->setFlash('error', 'Error occured while adding camp ' . $model->name);
    //             }
    //             return $this->redirect(['index']);
    //         }
    //     } else {
    //         Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
    //         return $this->redirect(['home/home']);
    //     }
    // }

    // public function actionCreate()
    // {
    //     $model = new AwpbComment();
    //     if ($model->load(Yii::$app->request->post()) && $model->save()) {
    //         return $this->redirect(['view', 'id' => $model->id]);
    //     }

    //     return $this->render('create', [
    //         'model' => $model,
    //     ]);
    // }
    /**
     * Creates a new AwpbComment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    // public function actionCreateg($id)
    // {
    //     if (User::userIsAllowedTo('Submit Provincial AWPB5')) {
    //         $model = new AwpbComment();

    //         // if ($model->load(Yii::$app->request->post()) && $model->save()) {
    //         //     return $this->redirect(['view', 'id' => $model->id]);
    //         // }


        
    //         if (Yii::$app->request->isAjax)
    //         {
    //             $model->load(Yii::$app->request->post());
    //             return Json::encode(\yii\widgets\ActiveForm::validate($model));
    //         }

    //   if ($model->load(Yii::$app->request->post()) )
    //   {
    //     $model->updated_by = Yii::$app->user->identity->id;
    //     $model->created_by = Yii::$app->user->identity->id; 

    //     if ( $model->validate())
    //     {
      
    //   if ($model->save()) {
                              
    //       $audit = new AuditTrail();
    //       $audit->user = Yii::$app->user->id;
    //       $audit->action = "Added AWBP comment";
    //       $audit->ip_address = Yii::$app->request->getUserIP();
    //       $audit->user_agent = Yii::$app->request->getUserAgent();
    //       $audit->save();
    //       Yii::$app->session->setFlash('success', 'AWPB activity line was successfully added.');
   
    //   } else {
    //       Yii::$app->session->setFlash('error', 'Error occured while adding AWPB activity line.');
    //   }
   
    //   return $this->redirect(['view', 'id' => $model->id]);
    //   }
  


    //     return $this->render('create', [
    //         'model' => $model,
    //     ]);
    //   }
    //     else 
    //     {
    //         Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
    //         return $this->redirect(['site/home']);
    //     }
    // }}

    // public function actionCreate() {
    //     if (User::userIsAllowedTo('Submit Provincial AWPB')) {
    //         $model = new AwpbComment();
    //         if (Yii::$app->request->isAjax) {
    //             $model->load(Yii::$app->request->post());
    //             return Json::encode(\yii\widgets\ActiveForm::validate($model));
    //         }

    //         if ($model->load(Yii::$app->request->post())) {

    //             $model->created_by = Yii::$app->user->identity->id;
    //             $model->updated_by = Yii::$app->user->identity->id;
                
    //             if ($model->save()) {
    //                 $_model = new AwpbActivityLine();
    //                 $_searchModel = new AwpbActivityLineSearch();
    //                 $_dataProvider = $_searchModel->search(Yii::$app->request->queryParams);

    //                 $_dataProvider->query->andFilterWhere(['district_id' => $id,'status' => AWPBActivityLine::STATUS_SUBMITTED,]);
    //                 $activitylines = AwpbActivityLine::find()->where(['district_id'=>$id])->andWhere(['status' => AWPBActivityLine::STATUS_SUBMITTED])->all();
                  
    //                 if(isset($activitylines) )
    //                 {
    //                     if($activitylines!=null)
    //                     {
    //                         foreach($activitylines as $activityline)
    //                         {
    //                             $activityline->status = AWPBActivityLine::STATUS_DRAFT;
    //                             if ($activityline->validate())
    //                             {
    //                                 $activityline->save();
    //                             }
    //                             else
    //                             {
    //                                 Yii::$app->session->setFlash('error', 'An error occurred while declining the District AWPB.');
                                    
    //                             }
    //                         }
    //                         $audit = new AuditTrail();
    //                         $audit->user = Yii::$app->user->id;
    //                         $audit->action = "Added a comment ";
    //                         $audit->ip_address = Yii::$app->request->getUserIP();
    //                         $audit->user_agent = Yii::$app->request->getUserAgent();
    //                         $audit->save();
    //                         Yii::$app->session->setFlash('success', 'AWPB comment was successfully added.');
    //                     } else {
    //                         Yii::$app->session->setFlash('error', 'Error occured while adding comment');
    //                     }
    //             // return $this->redirect(
    //             // ['awpb-activity-line/mpcd','id' =>  $model->district_id])
    //             // ;
    //         }
    //     }
    //         // return $this->render('create', [
	// 		// 	'model' => $model,
	// 		// ]);
    //     }

    //     } else {
    //         Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
    //         return $this->redirect(['home/home']);
    //     }
    // }



    /**
     * Updates an existing AwpbComment model.
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
     * Deletes an existing AwpbComment model.
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
     * Finds the AwpbComment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AwpbComment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AwpbComment::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
