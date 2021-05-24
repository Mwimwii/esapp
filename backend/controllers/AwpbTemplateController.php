<?php

namespace backend\controllers;

use Yii;
use backend\models\AwpbTemplate;
use backend\models\AwpbTemplateSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Json;
use backend\models\AuditTrail;
use backend\models\AwpbTemplateActivity;
use backend\models\User;
use backend\models\UploadImageForm;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;

/**
 * AwpbTemplateController implements the CRUD actions for AwpbTemplate model.
 */
class AwpbTemplateController extends Controller
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
     * Lists all AwpbTemplate models.
     * @return mixed
     */
    public function actionIndex()
    {
        	
		if (User::userIsAllowedTo('View AWPB templates')) 
		{
		
        $searchModel = new AwpbTemplateSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort->defaultOrder = ['status' => SORT_ASC];
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    } 
    else 
    {
        Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
        return $this->redirect(['site/home']);
    } 
    }

 public function actionUploadImage() {
   $model = new UploadImageForm();
   if (Yii::$app->request->isPost) {
      $model->image = UploadedFile::getInstance($model, 'image');
      if ($model->upload()) {
         // file is uploaded successfully
         echo "File successfully uploaded";
         return;
 }}}
   

    /**
     * Displays a single AwpbTemplate model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
	 
   public function actionView($id)
    {
        if (User::userIsAllowedTo('View AWPB templates')) 
		{
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    } 
    else 
    {
        Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
        return $this->redirect(['site/home']);
    } 
    }
	

/*
public function actionView($id) {
        $model=$this->findModel($id);

        if ($model->load(Yii::$app->request->post())&& $model->save(true,['budget_theme','comment','status','updated_by']))
		{     
		$model->guideline_file = UploadedFile::getInstance($model, 'guideline_file');
			
		if(isset($model->guideline_file->extension))
				{
					$file_name = $model->fiscal_year. '-AWPB-Guidelines.' .$model->guideline_file->extension;
					$file_path = 'uploads/'.$file_name;
					$model->guideline_file->saveAs($file_path);
					$model->guideline_file = $file_name;
					
				    if ($model->save(true,['budget_theme','comment','guideline_file','status','updated_by']))
					{
						//$model->updated_by = Yii::$app->user->id;	
						//if($model->save('budget_theme','comment','status','updated_by')) {
						// Yii::$app->session->setFlash('kv-detail-success', 'Saved record successfully');
						Yii::$app->session->setFlash('success', $model->fiscal_year . ' AWPB template was updated successfully.');

						// Multiple alerts can be set like below
						//Yii::$app->session->setFlash('kv-detail-warning', 'A last warning for completing all data.');
						/// Yii::$app->session->setFlash('kv-detail-info', '<b>Note:</b> You can proceed by clicking <a href="#">this link</a>.');
						return $this->redirect(['view', 'id'=>$model->id]);
					}
				}
				else
				{
					if ($model->save(true,['budget_theme','comment','status','updated_by']))
					{
						Yii::$app->session->setFlash('success', $model->fiscal_year . ' AWPB template was updated successfully.');
						return $this->redirect(['view', 'id'=>$model->id]);
					}
				}
					
			
        } else {
            return $this->render('view', ['model'=>$model]);
        }
		//}
    }

*/

// public function actionRead($id) {
//     $model = $this->findModel($id);

//     // This will need to be the path relative to the root of your app.
    
//     // Might need to change '@app' for another alias
//     $file_path = 'uploads/awpb/'.$model->guideline_file;
//  //   $completePath = Yii::getAlias('$filePath.'/'.$model->guideline_file);
//   //  $completePath = Yii::getAlias('@app'.$filePath.'/'.$model->guideline_file);

//     return Yii::$app->response->sendFile( $file_path, $model->guideline_file,['inline'=>true]);
// }

public function actionRead($id)
{
    $model = $this->findModel($id);

    $storagePath = 'uploads/awpb/'.$model->guideline_file;
   // $storagePath = Yii::getAlias('@app/uploads/awpb/'.$model->guideline_file);

    // check filename for allowed chars (do not allow ../ to avoid security issue: downloading arbitrary files)
    if (!preg_match('/^[a-z0-9]+\.[a-z0-9]+$/i', $model->guideline_file) || !is_file($storagePath)) {
      // throw new \yii\web\NotFoundHttpException('The file does not exists.');
       // return Yii::$app->response->sendFile($storagePath, $model->guideline_file,['inline'=>false]);
        // Yii::$app->session->setFlash('error', 'The file does not exists.'. $storagePath);
        //     return $this->redirect(['site/home']);
            return Yii::$app->response->sendFile($storagePath, $model->guideline_file,['inline'=>true]);

    }
    Yii::$app->session->setFlash('error', 'The file does not exists.'. $storagePath);
        return $this->redirect(['site/home']);
}


    public function actionActivity($id)
    {	
		$model=$this->findModel($id);
		if (User::userIsAllowedTo('Manage AWPB activities')) 
		{
			if (!Yii::$app->session->getIsActive())
			{
				Yii::$app->session->open();
			}
			Yii::$app->session['fiscal_year'] = $model->fiscal_year;
			Yii::$app->session['awpb_template_id'] = $model->id;
			
			Yii::$app->session->close();  
			return $this->redirect(['awpb-activity/index']);
        }	
    }

    /**
     * Creates a new AwpbTemplate model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
		
		if (User::userIsAllowedTo('Manage AWPB templates')) 
		{
			  $model = new AwpbTemplate();
			 if (Yii::$app->request->isAjax) {
                $model->load(Yii::$app->request->post());
                return Json::encode(\yii\widgets\ActiveForm::validate($model));
            }

			if ($model->load(Yii::$app->request->post()) ) {
						
				$model->guideline_file = UploadedFile::getInstance($model, 'guideline_file');
				if(isset($model->guideline_file->extension))
				{
				$file_name = $model->fiscal_year. '-AWPB-Guidelines.' .$model->guideline_file->extension;
				$file_path = 'uploads/awpb/'.$file_name;
				$model->guideline_file->saveAs($file_path);
								
				$model->guideline_file = $file_name;
				//$up_file = 1;
					
				$model->created_by = Yii::$app->user->id;
                $model->updated_by = Yii::$app->user->id;
				
				//$model->component_code  = $comp_model->component_code . '.' .$model->component_code;
				/*if ($model->parent_component_id!='')
				{	$comp_model = $this->findModel($model->parent_component_id);				
					$model->component_code  = $comp_model->component_code .'.'.$model->component_code;
                }*/
                
               // $templates = AwpbTemplate::find()->where(['fiscal_year'<>$model->fiscal_year])->andWhere(['status'<>AwpbTemplate::STATUS_OLD])->all();
              
                $templates = AwpbTemplate::find()->where(['<>','fiscal_year',$model->fiscal_year])->andWhere(['<>','status',AwpbTemplate::STATUS_OLD])->all();
         
                if(isset($templates) )
                {
                    if( $templates!=null)
                    {
                    foreach($templates as $template)
                    {
                        $template->status = AwpbTemplate::STATUS_OLD;
                        if ($template->validate())
                        {
                            $template->save();
                        }
                        else{
                            Yii::$app->session->setFlash('error', 'An error occurred while disabling current AWPB Template.');
                            return $this->render('index');
                        }
                    }
                }
            }
			 if ( $model->validate()) {
				
                if ($model->save()) {
					//if($up_file==1)
					//{
                    //}
                    
            
                    
                    $audit = new AuditTrail();
                    $audit->user = Yii::$app->user->id;
                    $audit->action = "Added template : "  . $model->fiscal_year;
                    $audit->ip_address = Yii::$app->request->getUserIP();
                    $audit->user_agent = Yii::$app->request->getUserAgent();
                    $audit->save();
                    Yii::$app->session->setFlash('success', $model->fiscal_year . ' AWPB template was successfully added.');
             
			    } else {
                    Yii::$app->session->setFlash(' error', 'Error occured while adding ' . $model->fiscal_year .' AWPB template.');
                }
			 
				return $this->redirect(['view', 'id' => $model->id]);
				}
				
                // Yii::$app->session->setFlash(' error', 'Error occured while adding ' . $model->fiscal_year .' AWPB template.');
              // return $this->render('create', ['model' => $model,]);
			   //return $this->redirect(['index']);
			   
                }
           
			} else {
                    Yii::$app->session->setFlash(' error', 'Attached the ' . $model->fiscal_year .' AWPB budget guidelines.');
               return $this->render('create', [
				'model' => $model,
			]);
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
    // public function actionUpdate($id)
    // {
    //     $model = $this->findModel($id);

    //     if ($model->load(Yii::$app->request->post()) && $model->save(true,['budget_theme','comment','status','updated_at','updated_by'])) {
    //         return $this->redirect(['view', 'id' => $model->id]);
    //     }

    //     return $this->render('update', [
    //         'model' => $model,
    //     ]);
    // }

    public function actionUpdate8($id) {
        if (User::userIsAllowedTo('Setup AWPB')) 
        {
            $model = $this->findModel($id);
            if (Yii::$app->request->isAjax) {
                $model->load(Yii::$app->request->post());
                return Json::encode(\yii\widgets\ActiveForm::validate($model));
            }
            
            $model->activities = AwpbTemplateActivity::getActivities($id);
            $array = [];
            foreach ($model->activities as $activity => $v) {
                array_push($array, $activity);
            }
            $model->activities = $array;
            // if ($model->load(Yii::$app->request->post())) {
            //    //var_dump(Yii::$app->request->post());
            //    //$model->activities=explode(',',$_POST['AwpbTemplate']['activities']);
            //    $model->activities=$_POST['AwpbTemplate']['activities'];

            //     var_dump($model->activities);
            //    // var_dump($model->budget_theme);
            //     if (!empty($model->activities)) {
            //         $model->updated_by = Yii::$app->user->id;
            //         if ($model->save()) {
            //             $awpbTemplateActivity = new AwpbTemplateActivity();
            //             $awpbTemplateActivity::deleteAll(['awpb_template_id' => $id]);
            //             foreach ($model->activities as $activity) {
            //                 //check if the right was already assigned to this role

            //                 $awpbTemplateActivity->awpb_template_id = $id;
            //                 $awpbTemplateActivity->id = NULL; //primary key(auto increment id) id
            //                 $awpbTemplateActivity->isNewRecord = true;
            //                 $awpbTemplateActivity->activity_id = $activity;
            //                 //$rightAllocation->created_by = Yii::$app->user->id;
            //                 $awpbTemplateActivity->save();
            //             }

            //             //check if current user has the role that has just been edited so that we update the permissions instead of user logging out
            //             // if (Yii::$app->getUser()->identity->role == $model->id) {
            //             //     $rightsArray = \common\models\RightAllocation::getRights(Yii::$app->getUser()->identity->role);
            //             //     $rights = implode(",", $rightsArray);

            //             //     $session = Yii::$app->session;
            //             //     $session->set('rights', $rights);
            //             // }

            //             $audit = new AuditTrail();
            //             $audit->user = Yii::$app->user->id;
            //             $audit->action = "Updated " . $model->fiscal_year ." fiscal year";
            //             $audit->ip_address = Yii::$app->request->getUserIP();
            //             $audit->user_agent = Yii::$app->request->getUserAgent();
            //             $audit->save();
            //             Yii::$app->session->setFlash('success',  $model->fiscal_year. ' was successfully updated.');
            //            // return $this->redirect(['view', 'id' => $model->id]);
            //         } else {
            //             Yii::$app->session->setFlash('error', 'Error occurred while updating template. Please try again.');
                        
            //             return $this->render('update', [
            //                 'id' => $model->id                     
            //             ]);
            //         }
                   
            //     } 
            //     else {
            //         Yii::$app->session->setFlash('error', 'You need to select at least one activity!');
            //         return $this->render('update', [
            //             'model' => $model,
            //             'id' => $model->id,]);
            //     }
            

     
       
            
            // } 
            // // Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            // // return $this->redirect(['home/home']);

            return $this->render('update', [
                'model' => $model
    ]);

        
    }
    else {
        Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
        return $this->redirect(['home/home']);
    }

}



public function actionUpdate($id) {
    if (User::userIsAllowedTo('Setup AWPB')) {
        $model = $this->findModel($id);
        if (Yii::$app->request->isAjax) {
            $model->load(Yii::$app->request->post());
            return Json::encode(\yii\widgets\ActiveForm::validate($model));
        }

        $model->activities = AwpbTemplateActivity::getActivities($id);
        $array = [];
        foreach ($model->activities as $activity => $v) {
            array_push($array, $activity);
        }
        $model->activities = $array;
        
      
        return $this->render('update', [
                    'model' => $model
        ]);
    } else {
        Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
        return $this->redirect(['home/home']);
    }
}






    public function actionUpdate4($id)
    {
        if (User::userIsAllowedTo('Manage AWPB templates')) {
            $model = $this->findModel($id);
            $model->updated_by = Yii::$app->user->identity->id;

            if (Yii::$app->request->isAjax) {
                $model->load(Yii::$app->request->post());
                return Json::encode(\yii\widgets\ActiveForm::validate($model));
            }
          $test="";
            if ($model->load(Yii::$app->request->post())) {
               
                if ($model->save(true,['budget_theme','comment','status','updated_at','updated_by']) && $model->validate()) {

                   //$activities = \backend\models\AwpbActivity::getSubActivities();
                    $awpbTemplateActivity = new AwpbTemplateActivity();
                    $awpbTemplateActivity::deleteAll(['awpb_template_id' => $id]);
                   
                    
                    if(isset($model->activities))
    {
        foreach($model->activities as $row)
        {
            $awpbTemplateActivity->awpb_template_id=$id;
            $awpbTemplateActivity->activity_id = $row[0] ;
            $awpbTemplateActivity->id = NULL; //primary key(auto increment id) id
            $awpbTemplateActivity->isNewRecord = true;
            // $rightAllocation->right = $right;
            //$rightAllocation->created_by = Yii::$app->user->id;
            $awpbTemplateActivity->save();//true,['awpb_template_id','activity_id','updated_at','updated_by']);
            $test =   $row[0];
        }

                    $audit = new AuditTrail();
                    $audit->user = Yii::$app->user->id;
                    $audit->action = "Updated " . $model->fiscal_year ." AWPB template";
                    $audit->ip_address = Yii::$app->request->getUserIP();
                    $audit->user_agent = Yii::$app->request->getUserAgent();
                    $audit->save();
                    Yii::$app->session->setFlash('success', $model->fiscal_year. " AWPB template details were successfully updated. ".$test);
                    Yii::$app->session->setFlash('error',var_dump($model->activities));
                  
                   // return $this->redirect(['view', 'id' => $model->id]); 
                }
                    Yii::$app->session->setFlash('error',var_dump($model->activities));

                } else {
                    $message = '';
                    foreach ($model->getErrors() as $error) {
                        $message .= $error[0];
                    }
                    Yii::$app->session->setFlash('error', "Error occured while updating " .$model->fiscal_year." template details Please try again.Error:" . $message);
                    return $this->render('update', [
                        'model' => $model,                      
                    ]);
                }
                    Yii::$app->session->setFlash('error',var_dump($model->activities));
               
                //return $this->redirect(['view', 'id' => $model->id]);
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


    public function actionUpdate2($id) {
        if (User::userIsAllowedTo('Setup AWPB')) {
            $model = $this->findModel($id);
            if (Yii::$app->request->isAjax) {
                $model->load(Yii::$app->request->post());
                return Json::encode(\yii\widgets\ActiveForm::validate($model));
            }


            $activities = $model->activities;
            $array = [];
             foreach ($activities as $act => $v) {
                 array_push($array, $act);
             }

            $model->activities = $array;
            if ($model->load(Yii::$app->request->post())) {
                if (!empty($model->activities)) {
                    $model->updated_by = Yii::$app->user->id;
                    if ($model->save()) {
                        $awpbTemplateActivity = new AwpbTemplateActivity();
                        $awpbTemplateActivity::deleteAll(['awpb_template_id' => $id]);
                        foreach ($model->activities as $activity) {
                            //check if the right was already assigned to this role

                            $awpbTemplateActivity->awpb_template_id=$id;
                            $awpbTemplateActivity->activity_id = $activity;
                            $awpbTemplateActivity->id = NULL; //primary key(auto increment id) id
                            $awpbTemplateActivity->isNewRecord = true;
                           // $rightAllocation->right = $right;
                            //$rightAllocation->created_by = Yii::$app->user->id;
                            $awpbTemplateActivity->save();
                        }

                        //check if current user has the role that has just been edited so that we update the permissions instead of user logging out
                        // if (Yii::$app->getUser()->identity->role == $model->id) {
                        //     $awpbTemplateActivityArray = \backend\models\AwpbTemplateActivity::getActivities($model->id);
                        //     ($id);
                        //     $awpbTemplateActivity = implode(",", $awpbTemplateActivityArray);

                        //    // $session = Yii::$app->session;
                        //    // $session->set('rights', $rights);
                        // }

                        $audit = new AuditTrail();
                        $audit->user = Yii::$app->user->id;
                        $audit->action = "Update tempate" . $model->activities;
                        $audit->ip_address = Yii::$app->request->getUserIP();
                        $audit->user_agent = Yii::$app->request->getUserAgent();
                        $audit->save();
                        Yii::$app->session->setFlash('success', 'Template ' . $model->activities . ' was successfully updated.');
                        return $this->redirect(['view', 'id' => $model->id]);
                    } else {
                        Yii::$app->session->setFlash('error', 'Error occurred while updating role.Please try again.');
                        return $this->render('update', ['id' => $model->id,]);
                    }
                } else {
                    Yii::$app->session->setFlash('error', 'You need to select at least one right!');
                    Yii::$app->session->setFlash('error',var_dump($model->activities));
                    return $this->render('update', ['id' => $model->id,
                    'model' => $model
                    ]);
                }
            }

            return $this->render('update', [
                        'model' => $model
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }


  /**
     * Deletes an existing AwpbTemplate model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
  /*  public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    */
    
    public function actionDelete($id) {
        //For now we just set the user status to User::STATUS_DELETED
        if (User::userIsAllowedTo('Manage AWPB templates')) {
            $model = $this->findModel($id);
            $this->findModel($id)->delete();
          
            if ($model->save()) {
                $audit = new AuditTrail();
                $audit->user = Yii::$app->user->id;
                $audit->action = 'Delete'. $model->fiscal_year.' AWPB Template';
                $audit->ip_address = Yii::$app->request->getUserIP();
                $audit->user_agent = Yii::$app->request->getUserAgent();
                $audit->save();
                Yii::$app->session->setFlash('success', "The template was successfully deleted.");
            } else {
                Yii::$app->session->setFlash('error', "The template could not be deleted. Please try again!");
            }
            return $this->redirect(['index']);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['site/home']);
        }
    }

/*	public function actionDelete() {
        $post = Yii::$app->request->post();
        if (Yii::$app->request->isAjax && isset($post['custom_param'])) {
            $id = $post['id'];
            if ($this->findModel($id)->delete()) {
                echo Json::encode([
                    'success' => true,
                    'messages' => [
                        'kv-detail-info' => 'The AWPB template# ' . $id . ' was successfully deleted. <a href="' . 
                            Url::to(['/awpb-template/view']) . '" class="btn btn-sm btn-info">' .
                            '<i class="glyphicon glyphicon-hand-right"></i>  Click here</a> to proceed.'
                    ]
                ]);
            } else {
                echo Json::encode([
                    'success' => false,
                    'messages' => [
                        'kv-detail-error' => 'Cannot delete the template # ' . $id . '.'
                    ]
                ]);
            }
            return;
        }
        throw new InvalidCallException("You are not allowed to do this operation. Contact the administrator.");
    }
*/

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
