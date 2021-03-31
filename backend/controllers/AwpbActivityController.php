<?php

namespace backend\controllers;

use Yii;
use backend\models\AwpbActivity;
use backend\models\AwbpActivitySearch;
use backend\models\AWPBTemplate;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Json;
use backend\models\AuditTrail;
use backend\models\User;

/**
 * AwbpActivityController implements the CRUD actions for AwpbActivity model.
 */
class AwpbActivityController extends Controller
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
     * Lists all AwpbActivity models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AwbpActivitySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AwpbActivity model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
   /* public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
	*/
	public function actionLists($id) 
	{
		$count_activities = AwpbActivity::find()
		->where(['component_id'=>$id])
		->count();
		$activities = AwpbActivity::find()
		->where(['component_id'=>$id])
		->all();
		if ($count_activities>0)
		{
			echo "<option value='0'>Select parent activity</option>";
			foreach($activities as $activity)
			{
				echo "<option value='".$activity->id."'>".$activity->description."</option>";
			}
			
		}
		else
		{
			echo "<option value='0'>-</option>";
		}
    }
    

 
    public function actionParentactivity() {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (isset(Yii::$app->request->post()['depdrop_parents'])) {
            $parents = Yii::$app->request->post('depdrop_parents');
            if ($parents != null) {
                $comp_id = $parents[0];
                return [
                    'output' => AwpbActivity:: getAwpbComponentActivities($comp_id, true),
                    'selected' => '',
                ];
            }
        }
        // return ['output' => '', 'selected' => ''];
        // $out = [];
        // if (isset($_POST['depdrop_parents'])) {
        //     $parents = $_POST['depdrop_parents'];
        //     if ($parents != null) {
        //         $comp_id = $parents[0];
        //         $out = AwpbActivity:: getAwpbComponentActivities($comp_id); 
        //         // the getSubCatList function will query the database based on the
        //         // cat_id and return an array like below:
        //         // [
        //         //    ['id'=>'<sub-cat-id-1>', 'name'=>'<sub-cat-name1>'],
        //         //    ['id'=>'<sub-cat_id_2>', 'name'=>'<sub-cat-name2>']
        //         // ]
        //         return json_encode(['output'=>$out, 'selected'=>'']);
            
        //     }
        // }
        // return json_encode(['output'=>'', 'selected'=>'']);
    }

    public function actionView($id)
    {
        if (User::userIsAllowedTo('View AWPB activities')) {
     
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
        $number_of_activities='';
		$number_of_subactivities='';
        if ($model->load(Yii::$app->request->post())&& $model->save(true,['activity_code','parent_activity_id','component_id','description', 'unit_of_measure','expense_category','updated_by']))
		{     
		//$model->guideline_file = UploadedFile::getInstance($model, 'guideline_file');
		
					
				$activity_model = \backend\models\AwpbActivity::findOne(['id' => $model->id,]);	
				$component = \backend\models\AWPBComponent::findOne(['id' => $model->component_id,]);					
			
					
                $model->updated_by = Yii::$app->user->id;
				
				
				if ($model->parent_activity_id!='')
				{	
					if ($activity_model->parent_activity_id !=$model->parent_activity_id)
					{										
						$number_of_subactivities = $model::find()
						->where(["parent_activity_id" => $model->parent_activity_id])
						->andWhere(["component_id" => $model->component_id])
						->count();
						$parent_model = $this->findModel($model->parent_activity_id);				
						if($number_of_subactivities==0||$number_of_subactivities=='')
						{
								$activity_code  = $parent_model->activity_code .'1';	
						}
						if($number_of_subactivities>0||$number_of_subactivities!='')
						{		
							$ecl = $number_of_subactivities+1;				
							$activity_code  =$parent_model->activity_code .''.$ecl;
						}
						$model->activity_code =	$activity_code;
					}
				}
				else
				{
					$number_of_activities = $model::find()
					->where(["component_id" => $model->component_id])
					->andWhere(["awpb_template_id" => $model->awpb_template_id])
					->count();
					if ($number_of_activities==0||$number_of_activities=='')
					{		
						$activity_code = 67;					
					}
					else
					{
						$activity_code = 64+$number_of_activities ;
					}
					$model->activity_code = $component->component_code.'.'.chr($activity_code);
					
				}
						
                if ($model->save(true,['activity_code','parent_activity_id','component_id','description', 'unit_of_measure','expense_category','updated_by'])) {
                    $audit = new AuditTrail();
                    $audit->user = Yii::$app->user->id;
                    $audit->action = "Updated activity : "  .$model->activity_code. ' '.$model->description;
                    $audit->ip_address = Yii::$app->request->getUserIP();
                    $audit->user_agent = Yii::$app->request->getUserAgent();
                    $audit->save();
                    Yii::$app->session->setFlash('success', 'activity ' . $model->activity_code. ' '.$model->description. ' was successfully updated. Act'.$number_of_activities. ' Sub ' .$number_of_subactivities++ );
                } else {
                    Yii::$app->session->setFlash(' error', 'Error occured while updating activity ' .$model->activity_code. ' '.$model->description);
                }
			 
            //    return $this->redirect(['index']);
				return $this->redirect(['view', 'id' => $model->id]);
				
		
				
        } else 
		{
            return $this->render('view', ['model'=>$model]);
        }
		//}
    }
*/
    /**
     * Creates a new AwpbActivity model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    

    public function actionCreate()
    {
		$number_of_activities='';
        $number_of_subactivities='';
        $sub="";
		if (User::userIsAllowedTo('Manage AWPB activities')) 
		{
			$model = new AwpbActivity();
			if (Yii::$app->request->isAjax) 
			{
                $model->load(Yii::$app->request->post());
                return Json::encode(\yii\widgets\ActiveForm::validate($model));
            }


            if (Yii::$app->request->post('addSub') == 'true') {
                // var_dump(Yii::$app->request->post()['User']['user_type']);
                $sub = Yii::$app->request->post()['AwpbActivity']['sub'];
            }

            if (Yii::$app->request->post('addSub') != 'true' && $model->load(Yii::$app->request->post()) ) {
                    
                $component = \backend\models\AWPBComponent::findOne([		
                    'id' => $model->component_id,]);

                $model->created_by = Yii::$app->user->id;
                $model->updated_by = Yii::$app->user->id;
				$model->name = $model->description;
	
                if ($model->activity_type == "Subactivity")
                {
            
                    $parent_model = $this->findModel($model->parent_activity_id);
                    $component = \backend\models\AWPBComponent::findOne(['id' =>  $parent_model->component_id]);	
                    $number_of_subactivities = $model::find()
                    ->where(["parent_activity_id" => $model->parent_activity_id])
                    ->andWhere(["component_id" => $parent_model->component_id])
                    ->count();
                                
                    if($number_of_subactivities==0||$number_of_subactivities=='')
                    {
                            $activity_code  = $parent_model->activity_code .'1';	
                    }
                    if($number_of_subactivities>0||$number_of_subactivities!='')
                    {		
                        $ecl = $number_of_subactivities+1;				
                        $activity_code  =$parent_model->activity_code .''.$ecl;
                    }
                    $model->activity_code =	$activity_code;
                    $model->component_id= $parent_model->component_id;
                   // $model->awpb_template_id=$parent_model->awpb_template_id;
                    //$model->unit_of_measure_id=$model->unit_of_measure_id;
                    //$model->expense_category_id=$parent_model->expense_category_id;
                    $model->type = AwpbActivity::TYPE_SUB;             
                }
                            
                if ($model->activity_type== "Main Activity")
                {
                    $number_of_activities = $model::find()
                    ->where(["component_id" => $model->component_id])
                    ->andWhere(["awpb_template_id" => $model->awpb_template_id])
                    ->count();
                    if ($number_of_activities==0||$number_of_activities=='')
                    {		
                        $activity_code = 67;     
                    }
                    else
                    {
                        $activity_code = 64+$number_of_activities ;
                    }
                    $model->activity_code = $component->code.'.'.chr($activity_code);   
                    $model->type = AwpbActivity::TYPE_MAIN;
                }
                                    
                if ($model->save())
                {
                    $audit = new AuditTrail();
                    $audit->user = Yii::$app->user->id;
                    $audit->action = "Added activity : "  .$model->activity_code. ' '.$model->name;
                    $audit->ip_address = Yii::$app->request->getUserIP();
                    $audit->user_agent = Yii::$app->request->getUserAgent();
                    $audit->save();
                    Yii::$app->session->setFlash('success', 'activity ' . $model->activity_code. ' '.$model->name.' was successfully added. Act'.$number_of_activities. ' Sub ' .$number_of_subactivities++ );
                } else 
                {
                    $message = '';
                    foreach ($model->getErrors() as $error) {
                        $message .= $error[0];
                    }
                    Yii::$app->session->setFlash('error', "Error occured while creating activity: $model->sub.'.Please try again.Error::" . $message);
                  
            return $this->render('create', [
                'model' => $model,
                "sub" => $sub
            ]);
                }


			 
            //  
				
            }
			
			return $this->render('create', [
				'model' => $model,   "sub" => $sub
			]);
		} 
	
    else 
		{
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['site/home']);
        }

}

    /**
     * Updates an existing AwpbActivity model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    { 
        $sub="";
        if (User::userIsAllowedTo('Manage AWPB activities')) 
		{
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,"sub" => $model->sub
        ]);
    }
    else 
		{
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['site/home']);
        }


}

    /**
     * Deletes an existing AwpbActivity model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (User::userIsAllowedTo('Manage AWPB activities')) 
		{
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
     * Finds the AwpbActivity model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AwpbActivity the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AwpbActivity::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
