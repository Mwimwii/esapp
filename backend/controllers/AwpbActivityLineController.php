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

/**
 * AwpbActivityLineController implements the CRUD actions for AwpbActivityLine model.
 */
class AwpbActivityLineController extends Controller
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
     * Lists all AwpbActivityLine models.
     * @return mixed
     */
    // public function actionIndex()
    // {
    //     $searchModel = new AwpbActivityLineSearch();
    //     $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

    //     return $this->render('index', [
    //         'searchModel' => $searchModel,
    //         'dataProvider' => $dataProvider,
    //     ]);
    // }

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
    // public function actionCreate()
    // {
    //     $model = new AwpbActivityLine();

    //     if ($model->load(Yii::$app->request->post()) && $model->save()) {
    //         return $this->redirect(['view', 'id' => $model->id]);
    //     }

    //     return $this->render('create', [
    //         'model' => $model,
    //     ]);
    // }

    public function actionApprove()
    {
        if (User::userIsAllowedTo('Submit District AWPB')) {
            
            $model = new AwpbActivityLine();
            $searchModel = new AwpbActivityLineSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            $user = User::findOne(['id' => Yii::$app->user->id]);
            $dataProvider->query->andFilterWhere(['district_id' => $user->district_id,'status' => AWPBActivityLine::STATUS_DISTRICT,]);
            $activitylines = AwpbActivityLine::find()->where(['district_id'=>$user->district_id])->andWhere(['status' => AWPBActivityLine::STATUS_DISTRICT])->all();
            // if (Yii::$app->request->isAjax) {
            //     $model->load(Yii::$app->request->post());
            //     return Json::encode(\yii\widgets\ActiveForm::validate($model));
            // }
            // if (!empty(Yii::$app->request->post())) {
            if(isset($activitylines) )
            {
                if($activitylines!=null)
                {
                foreach($activitylines as $activityline)
                {
                    $activityline->status = AWPBActivityLine::STATUS_PROVINCIAL;
                    if ($activityline->validate())
                    {
                        $activityline->save();
                    }
                    else{
                        Yii::$app->session->setFlash('error', 'An error occurred while submitting the District AWPB.');
                        return $this->render('index', [
                            'searchModel' => $searchModel,
                            'model' => $model,
                            'dataProvider' => $dataProvider,
                ]);
                    }
                   

                }
                Yii::$app->session->setFlash('success', 'The District AWPB has been submitted successfully.');
                return $this->render('index', [
                    'searchModel' => $searchModel,
                    'model' => $model,
                    'dataProvider' => $dataProvider,
        ]);

            }
              else{
                 Yii::$app->session->setFlash('error', 'No District AWPB to submit.');
                 return $this->render('index', [
                    'searchModel' => $searchModel,
                    'model' => $model,
                    'dataProvider' => $dataProvider,
        ]);
            }
        }
   // }
    // return $this->render('index', [
    //     'searchModel' => $searchModel,
    //     'model' => $model,
    //     'dataProvider' => $dataProvider,   
    //     ]);      
        }
     else {
        Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
        return $this->redirect(['site/home']);
    }

    }
    public function actionCreate() {
        if (User::userIsAllowedTo('Manage AWPB activity lines')) {
            $model = new AwpbActivityLine();
            $modelForm = [new AwpbActivityLine()];
            if (Yii::$app->request->isAjax) {
                $model->load(Yii::$app->request->post());
                return Json::encode(\yii\widgets\ActiveForm::validate($model));
            }
            if (!empty(Yii::$app->request->post())) {
                $modelForm = \backend\models\Model::createMultiple(AwpbActivityLine::classname());
                $count = 0;
                $errors = '';
                if (Model::loadMultiple($modelForm, Yii::$app->request->post())) {
                    //  $province_id = backend\models\Districts::findOne([Yii::$app->getUser()->identity->district_id])->province_id;
                    $transaction = \Yii::$app->db->beginTransaction();
                    try {
                        foreach ($modelForm as $Model) {
                            $total_q=0;
                            $total_amt=0.0;
                            $total_q = $Model->quarter_one_quantity + $Model->quarter_two_quantity + $Model->quarter_three_quantity + $Model->quarter_four_quantity;
                          //  $total_amt = $Model->unit_cost * $total_q;
                            $total_amt=  $Model->unit_cost!= 0 && $total_q != 0 ? $total_q * $Model->unit_cost : 0;
                            $Model->total_quantity =$total_q;
                            $Model->total_amount = $total_amt;
                            $Model->status = 0;
                            $Model->updated_by = Yii::$app->user->identity->id;
                            $Model->created_by = Yii::$app->user->identity->id;
                            $Model->district_id = Yii::$app->getUser()->identity->district_id;
                            $Model->province_id =  Yii::$app->getUser()->identity->province_id;
                           
                           // $Model->province_id = Yii::$app->getUser()->identity->province_id;
                           // Yii::$app->session->setFlash('error', 'Error occured while saving AWPB activity line records. Please try again1');
                            $count++;
                            if (!($flag = $Model->save())) {
                                $transaction->rollBack();
                                foreach ($Model->getErrors() as $error) {
                                    $errors .= "\n" . $error[0];
                                }
                                break;
                            }
                        }

                        if ($flag) {
                            $transaction->commit();
                            $audit = new AuditTrail();
                            
                            $audit->user = Yii::$app->user->id;
                            $audit->action = "Added $count activity line";
                            $audit->ip_address = Yii::$app->request->getUserIP();
                            $audit->user_agent = Yii::$app->request->getUserAgent();
                            $audit->save();
                            Yii::$app->session->setFlash('success', 'You have successfully added ' . $count . ' AWPB activity line.');
                            return $this->redirect(['index']);
                        }
                    } catch (Exception $e) {
                        $transaction->rollBack();
                        Yii::$app->session->setFlash('error', 'Error occured while saving AWPB activity line records.' . $ex->getMessage() . ' Please try again1');
                    }
                } else {
                    Yii::$app->session->setFlash('error', 'Error occured while saving AWPB activity line records. Please try again2');
                }
            }

            return $this->render('create', [
                        'model' => $model,
                        'modelForm' => $modelForm,
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['site/home']);
        }
    }


    /**
     * Updates an existing AwpbActivityLine model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    // public function actionUpdate($id)
    // {
    //     $model = $this->findModel($id);

    //     if ($model->load(Yii::$app->request->post()) && $model->save()) {
    //         return $this->redirect(['view', 'id' => $model->id]);
    //     }

    //     return $this->render('update', [
    //         'model' => $model,
    //     ]);
    // }

    public function actionIndex()
    {
       if (User::userIsAllowedTo('Manage AWPB activity lines') || User::userIsAllowedTo("View AWPB activity lines")) {
           $user = User::findOne(['id' => Yii::$app->user->id]);
           $model = new AwpbActivityLine();
           $searchModel = new AwpbActivityLineSearch();
           $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

           if($user->province_id !='' || $user->province_id > 0)
                {
                    if($user->district_id !=''||$user->district_id  >0)
                    { 
                        
                        $dataProvider->sort = ['defaultOrder' =>  ['district_id'=>SORT_ASC,'province_id'=>SORT_ASC]];
                      //  $dataProvider->query-> where('district_id = :field1', [':field1' =>$user->district_id]);
                        $dataProvider->query->andFilterWhere(['district_id' => $user->district_id,'status' => 0,]);
                       
            if (Yii::$app->request->post('hasEditable')) {
                   $Id = Yii::$app->request->post('editableKey');
                   $model = AwpbActivityLine::findOne($Id);
                   $out = Json::encode(['output' => '', 'message' => '']);
                   $posted = current($_POST['AwpbActivityLine']);
                   $post = ['AwpbActivityLine' => $posted];

                   if ($model->load($post)) {
                       $audit = new AuditTrail();
                       $audit->user = Yii::$app->user->id;
                       $audit->action = "Activity line details updated.";
                       $audit->ip_address = Yii::$app->request->getUserIP();
                       $audit->user_agent = Yii::$app->request->getUserAgent();
                       $audit->save();
                       $total_q=0;
                       $total_amt=0.0;
                       $total_q = $model->quarter_one_quantity + $model->quarter_two_quantity + $model->quarter_three_quantity + $model->quarter_four_quantity;
                     //  $total_amt = $Model->unit_cost * $total_q;
                       $total_amt=  $model->unit_cost!= 0 && $total_q != 0 ? $total_q * $model->unit_cost : 0;
                       $model->total_quantity =$total_q;
                       $model->total_amount = str_replace("-", "",$total_amt);
                       $model->unit_cost = str_replace("-", "", $model->unit_cost);
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
              // $dataProvider->query->andFilterWhere(['created_by' => Yii::$app->user->id]);
               return $this->render('index', [
                           'searchModel' => $searchModel,
                           'model' => $model,
                           'dataProvider' => $dataProvider,
               ]);
   

           }
           else
                           {
                               $dataProvider->sort = ['defaultOrder' => ['province_id'=>SORT_ASC]];
                                $dataProvider->query->where(['province_id' => $user->province_id]);
                                //where('province_id = :field1', [':field1' =>$user->provincet_id]);
                                return $this->render('index', [
                                                        'searchModel' => $searchModel,
                                                        'model' => $model,
                                                        'dataProvider' => $dataProvider,
                       
                                                    ]);
           
                            }
        
                            
                        }
                                    else
                                     {
                        
                                      
                                        $dataProvider->sort = ['defaultOrder' => ['activity_id'=>SORT_ASC]];
                                        return $this->render('index', [
                                                                'searchModel' => $searchModel,
                                                                 'model' => $model,
                                                                 'dataProvider' => $dataProvider,
                                
                                                             ]);
                                         }

       } else {
           Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
           return $this->redirect(['site/home']);
       }
  
}
   public function actionMpc()
   {
      if (User::userIsAllowedTo('Manage province consolidated AWPB') )
       {
          $user = User::findOne(['id' => Yii::$app->user->id]);
          $model = new AwpbActivityLine();
          $searchModel = new AwpbActivityLineSearch();
          $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        //   if($user->province_id !='' || $user->province_id > 0)
        //     {
               
                $dataProvider->sort = ['defaultOrder' => ['district_id'=>SORT_ASC]];
                // $dataProvider->query->select( `province_id`,`district_id`,`activity_id`,`commodity_type_id`,sum(`total_quantity`),sum(`total_amount`))
                // ->from(`awpb_activity_line`)
                // ->andFilterWhere(['province_id' => $user->province_id])
                // ->group(`province_id`,`district_id`,`activity_id`,`commodity_type_id`);
                
                $dataProvider->query->where('province_id = :field1', [':field1' =>$user->province_id,]);
                return $this->render('mpc', [
                                        'searchModel' => $searchModel,
                                       // 'model' => $model,
                                        'dataProvider' => $dataProvider,
       
                                    ]);

    //                                 $searchModel = new AwpbActivityLineSearch();
    // $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

    // return $this->render('index', [
    //     'searchModel' => $searchModel,
    //     'dataProvider' => $dataProvider,
    // ]);
            // }
            // else
            // {

            //    Yii::$app->session->setFlash('error', 'You are not assigned to any province.');
            //     return $this->redirect(['site/home']);
            // }
      } else {
          Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
          return $this->redirect(['site/home']);
        
}
  }

  public function actionMpw()
   {
      if (User::userIsAllowedTo('Manage programme-wide AWPB') )
       {
          $user = User::findOne(['id' => Yii::$app->user->id]);
          $model = new AwpbActivityLine();
          $searchModel = new AwpbActivityLineSearch();
          $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

          if($user->province_id =='' || $user->province_id < 0)
            {
               
                $dataProvider->sort = ['defaultOrder' => ['district_id'=>SORT_ASC]];
                // $dataProvider->query->select( `province_id`,`district_id`,`activity_id`,`commodity_type_id`,sum(`total_quantity`),sum(`total_amount`))
                // ->from(`awpb_activity_line`)
                // ->andFilterWhere(['province_id' => $user->province_id])
                // ->group(`province_id`,`district_id`,`activity_id`,`commodity_type_id`);
                  
                //$dataProvider->query->where('province_id = :field1', 'status=:field2',[':field1' =>null,':field2' =>0,]);
           
                return $this->render('mpw', [
                                        'searchModel' => $searchModel,
                                        'model' => $model,
                                        'dataProvider' => $dataProvider,
       
                                    ]);
            }
            else
            {

               Yii::$app->session->setFlash('error', 'You are not assigned to any budget.');
                return $this->redirect(['site/home']);
            }
      } else {
          Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
          return $this->redirect(['site/home']);
      }
  }
  
//     public function actionIndex() {

// // 	 if (User::userIsAllowedTo('Manage AWPB activity lines') || User::userIsAllowedTo("View AWPB activity lines")) {
// //             $user = User::findOne(['id' => Yii::$app->user->id]);
// // 			// your default model and dataProvider generated by gii
// //             $model = new AwpbActivityLine();
// //             $searchModel = new AwpbActivityLineSearch();
// //             $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
// //             if($user->province_id !='' || $user->province_id > 0)
// //             {
// //                 if($user->district_id !=''||$user->district_id  >0)
// //                 {
                   
                  
// //                     $dataProvider->sort = ['defaultOrder' => ['province_id'=>SORT_ASC, 'district_id'=>SORT_ASC]];
// //                     $dataProvider->query->where('district_id = :field1', [':field1' =>$user->district_id]);
					
    
  
// //     // validate if there is a editable input saved via AJAX
// //     if (Yii::$app->request->post('hasEditable')) {
// //         // instantiate your book model for saving
// //         $acivity_line_id = Yii::$app->request->post('editableKey');
// //         $model = AwpbActivityLine::findOne($acivity_line_id);

// //         // store a default json response as desired by editable
// //         $out = Json::encode(['output'=>'', 'message'=> '']);

// //         // fetch the first entry in posted data (there should only be one entry 
// //         // anyway in this array for an editable submission)
// //         // - $posted is the posted data for Book without any indexes
// //         // - $post is the converted array for single model validation

// //         $post = [];
// //         $posted = current($_POST['AwpbActivityLine']);
// //         $post['AwpbActivityLine'] = $posted;

// //         if ($model->load($post)) {
// //             $audit = new AuditTrail();
// //             $audit->user = Yii::$app->user->id;
// //             $audit->action = "Activity line details updated";
// //             $audit->ip_address = Yii::$app->request->getUserIP();
// //             $audit->user_agent = Yii::$app->request->getUserAgent();
// //             $audit->save();
// //             $model->updated_by = Yii::$app->user->id;
// //             $model->unit_cost = str_replace("-", "", $model->unit_cost);
// //             $message = '';
// //             if (!$model->save()) {
// //                 foreach ($model->getErrors() as $error) {
// //                     $message .= $error[0];
// //                 }
// //                 $output = $message;
// //             }
// //             $output = '';
// //             $out = Json::encode(['output' => $output, 'message' => $message]);
// //         }
// //         return $out;


    
// // //         // load model like any single model validation
// // //         if ($model->load($post)) {
// // //             // can save model or do something before saving model
// // //            // $model->total_quantity = $post['AwpbActivityLine']['total_quantity'];
// // //           //  $model->total_amount = $post['AwpbActivityLine']['total_amount'];
// // //             $model->save();



// // //         // custom output to return to be displayed as the editable grid cell
// // //         // data. Normally this is empty - whereby whatever value is edited by
// // //         // in the input by user is updated automatically.
// // //         $output = '';

// // //         // specific use case where you need to validate a specific
// // //         // editable column posted when you have more than one
// // //         // EditableColumn in the grid view. We evaluate here a
// // //         // check to see if buy_amount was posted for the Book model
// // //          if (isset($posted['unit_cost'])) {
// // //          $output = Yii::$app->formatter->asDecimal($model->unit_cost, 2);
// // //          }
// // //  		  if (isset($posted['total_quantity'])) {
// // //          $output = Yii::$app->formatter->asDecimal($model->total_quantity, 2);
// // //          }
// // //   if (isset($posted['total_amount'])) {
// // //          $output = Yii::$app->formatter->asDecimal($model->total_amount, 2);
// // //         }
// // //         // similarly you can check if the name attribute was posted as well
// // //         // if (isset($posted['name'])) {
// // //         // $output = ''; // process as you need
// // //         // }
// // //         $out = Json::encode(['output'=>$output, 'message'=>'']);
// // //         }
// // //         // return ajax json encoded response and exit
// // //         echo $out;
// // //         return;
// //     }

// //     // non-ajax - render the grid by default
// //     return $this->render('index', [
// //         'dataProvider' => $dataProvider,
// //         'model' => $model,
// //         'searchModel' => $searchModel
// //     ]);


// // }
// //                 else
// //                 {
// //                     $dataProvider->sort = ['defaultOrder' => ['province_id'=>SORT_ASC]];
// //                     $dataProvider->query->where('province_id = :field1', [':field1' =>$user->provincet_id]);
// //                     return $this->render('index', [
// //                                             'searchModel' => $searchModel,
// //                                             'model' => $model,
// //                                             'dataProvider' => $dataProvider,
            
// //                                         ]);

// //                 }
// // 				}
// //             else
// //             {

              
// //                 $dataProvider->sort = ['defaultOrder' => ['activity_id'=>SORT_ASC]];
// //                 return $this->render('index', [
// //                                         'searchModel' => $searchModel,
// //                                         'model' => $model,
// //                                         'dataProvider' => $dataProvider,
        
// //                                     ]);
// //                 }
                

// //     } else {
// //             Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
// //              return $this->redirect(['site/home']);
// //          }



//         if (User::userIsAllowedTo('Manage AWPB activity lines') || User::userIsAllowedTo("View AWPB activity lines")) {
//             $user = User::findOne(['id' => Yii::$app->user->id]);
//             $model = new AwpbActivityLine();
//             $searchModel = new AwpbActivityLineSearch();
//             $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
//             if($user->province_id !='' || $user->province_id > 0)
//             {
//                 if($user->district_id !=''||$user->district_id  >0)
//                 {
                   
                  
//                     $dataProvider->sort = ['defaultOrder' => ['province_id'=>SORT_ASC, 'district_id'=>SORT_ASC]];
//                     $dataProvider->query->where('district_id = :field1', [':field1' =>$user->district_id]);

//                     if (Yii::$app->request->post('hasEditable')) {
//                                     $Id = Yii::$app->request->post('editableKey');
//                                     $model = AWPBActivityLine::findOne($Id);
//                                     $out = Json::encode(['output' => '', 'message' => '']);
//                                     $posted = current($_POST['AwpbActivityLine']);
//                                     $post = ['AWPBActivityLine' => $posted];
                

//                                     if (Yii::$app->request->post('hasEditable')) {
//                                         $Id = Yii::$app->request->post('editableKey');
//                                         $model = AWPBActivityLine::findOne($Id);
//                                         $out = Json::encode(['output' => '', 'message' => '']);
//                                         $posted = current($_POST['AWPBActivityLines']);
//                                         $post = ['AWPBActivityLine' => $posted];
//                                         $old = $model->level;
//                                         $old_desc = $model->description;


//                                         if ($model->load($post)) {
//                                             if ($old != $model->level || $old_desc != $model->description) {
//                                                 $audit = new AuditTrail();
//                                                 $audit->user = Yii::$app->user->id;
//                                                 if ($old_desc != $model->description) {
//                                                     $audit->action = "Updated commodity price level description to::" . $model->description;
//                                                 }
//                                                 if ($old != $model->level) {
//                                                     $audit->action = "Updated commodity price level from $old to " . $model->level;
//                                                 }
//                                                 $audit->ip_address = Yii::$app->request->getUserIP();
//                                                 $audit->user_agent = Yii::$app->request->getUserAgent();
//                                                 $audit->save();
//                                                 $model->updated_by = Yii::$app->user->id;
//                                             }
//                                             $message = '';
//                                             if (!$model->save()) {
//                                                 foreach ($model->getErrors() as $error) {
//                                                     $message .= $error[0];
//                                                 }
//                                                 $output = $message;
//                                             }
//                                             $output = '';
//                                             $out = Json::encode(['output' => $output, 'message' => $message]);
//                                         }
//                                         return $out;



//                                     if ($model_post->load($post)) {
//                                         $audit = new AuditTrail();
//                                         $audit->user = Yii::$app->user->id;
//                                         $audit->action = "Updated AWPB activity line details";
//                                         $audit->ip_address = Yii::$app->request->getUserIP();
//                                         $audit->user_agent = Yii::$app->request->getUserAgent();
//                                         $audit->save();
//                                         $model->updated_by = Yii::$app->user->id;
//                                         $model->unit_cost = str_replace("-", "", $model->unit_cost);
//                                         $message = '';
//                                         if (!$model_post->save()) {
//                                             foreach ($model_post->getErrors() as $error) {
//                                                 $message .= $error[0];
//                                             }
//                                             $output = $message;
//                                         }
//                                         $output = '';
//                                         $out = Json::encode(['output' => $output, 'message' => $message]);
//                                     }
//                                     return $out;
//                                 }
//                     return $this->render('index', [
//                                             'searchModel' => $searchModel,
//                                             'model' => $model,
//                                             'dataProvider' => $dataProvider,
            
//                                         ]);
//                 }
//                 else
//                 {
//                     $dataProvider->sort = ['defaultOrder' => ['district_id'=>SORT_ASC]];
//                     $dataProvider->query->where('province_id = :field1', [':field1' =>$user->provincet_id]);
//                     return $this->render('index', [
//                                             'searchModel' => $searchModel,
//                                             'model' => $model,
//                                             'dataProvider' => $dataProvider,
            
//                                         ]);

//                 }

//             }
//                 else
//                 {
//                     $dataProvider->sort = ['defaultOrder' => ['province_id'=>SORT_ASC]];
//                     $dataProvider->query->where('province_id = :field1', [':field1' =>$user->provincet_id]);
//                     return $this->render('index', [
//                                             'searchModel' => $searchModel,
//                                             'model' => $model,
//                                             'dataProvider' => $dataProvider,
            
//                                         ]);

//                 }

//             }
//             else
//             {

              
//                 $dataProvider->sort = ['defaultOrder' => ['activity_id'=>SORT_ASC]];
//                 return $this->render('index', [
//                                         'searchModel' => $searchModel,
//                                         'model' => $model,
//                                         'dataProvider' => $dataProvider,
        
//                                     ]);
//                 }
                

//     } else {
//             Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
//              return $this->redirect(['site/home']);
//          }

//         // if (User::userIsAllowedTo('Manage AWPB activity lines') || User::userIsAllowedTo("View AWPB activity lines")) {
//         //     $model = new AwpbActivityLine();
//         //     $searchModel = new AwpbActivityLineSearch();
//         //     $prices_dependency = new DbDependency();
//         //     $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
//         //     if (!empty(Yii::$app->request->queryParams['AwpbActivityLineSearch']['province_id'])) {
//         //         $district_ids = [];
//         //         $districts = \backend\models\Districts::find()->cache(600,$prices_dependency)->where(['province_id' => Yii::$app->request->queryParams['AwpbActivityLineSearch']['province_id']])->all();
//         //         if (!empty($districts)) {
//         //             foreach ($districts as $id) {
//         //                 array_push($district_ids, $id['id']);
//         //             }
//         //         } else {
//         //             $district_ids = [''];
//         //         }

//         //         $dataProvider->query->andFilterWhere(['IN', 'id', $district_ids]);
//         //     }
//         //     if (Yii::$app->getUser()->identity->district_id > 0) {
//         //         $dataProvider->query->andFilterWhere(['id' => Yii::$app->getUser()->identity->district_id]);
//         //         if (Yii::$app->request->post('hasEditable')) {
//         //             $Id = Yii::$app->request->post('editableKey');
//         //             $model = AWPBActivityLine::findOne($Id);
//         //             $out = Json::encode(['output' => '', 'message' => '']);
//         //             $posted = current($_POST['AwpbActivityLine']);
//         //             $post = ['AWPBActivityLine' => $posted];

//         //             if ($model->load($post)) {
//         //                 $audit = new AuditTrail();
//         //                 $audit->user = Yii::$app->user->id;
//         //                 $audit->action = "Updated AWPB activity line details";
//         //                 $audit->ip_address = Yii::$app->request->getUserIP();
//         //                 $audit->user_agent = Yii::$app->request->getUserAgent();
//         //                 $audit->save();
//         //                 $model->updated_by = Yii::$app->user->id;
//         //                 $model->unit_cost = str_replace("-", "", $model->unit_cost);
//         //                 $message = '';
//         //                 if (!$model->save()) {
//         //                     foreach ($model->getErrors() as $error) {
//         //                         $message .= $error[0];
//         //                     }
//         //                     $output = $message;
//         //                 }
//         //                 $output = '';
//         //                 $out = Json::encode(['output' => $output, 'message' => $message]);
//         //             }
//         //             return $out;
//         //         }
//         //         $dataProvider->query->andFilterWhere(['created_by' => Yii::$app->user->id]);
//         //         return $this->render('index', [
//         //                     'searchModel' => $searchModel,
//         //                     'model' => $model,
//         //                     'dataProvider' => $dataProvider,
//         //         ]);
//         //     } else {

//         //         return $this->render('view', [
//         //                     'searchModel' => $searchModel,
//         //                     'dataProvider' => $dataProvider,
//         //         ]);
//         //     }
//         // } else {
//         //     Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
//         //     return $this->redirect(['site/home']);
//         // }
//     }




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
