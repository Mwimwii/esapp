<?php

namespace frontend\controllers;

use Yii;
use frontend\models\MgfVariableFixedCost;
use frontend\models\MgfVariableFixedCostSearch;
use frontend\models\MgfVariableFixedCostTotals;
use frontend\models\MgfValueOfProductTotals;
use frontend\models\MgfProfitBeforeInterestTaxes;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MgfVariableFixedCostController implements the CRUD actions for MgfVariableFixedCost model.
 */
class MgfVariableFixedCostController extends Controller
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
     * Lists all MgfVariableFixedCost models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MgfVariableFixedCostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MgfVariableFixedCost model.
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
     * Creates a new MgfVariableFixedCost model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MgfVariableFixedCost();

        if ($model->load(Yii::$app->request->post()) ){
            //$user=Yii::$app->user->id;
            $userid=Yii::$app->user->identity->id;
           // $applicant=MgfApplicant::findOne(['user_id'=>$userid]);
            //$proposal=MgfProposal::find()->where(['is_active'=>1,'organisation_id'=>$applicant->organisation_id])->one();
            //$model->proposal_id=13;//$proposal->id;
            $model->date_created=date('Y-m-d H:i:s');
            $model->created_by=$userid;  
            
            
            
            if ($model->save()) 
               {
                   if (MgfVariableFixedCostTotals::find()->where(['proposal_id'=>$model->proposal_id])->exists())
                   {
                   // $ValueOfGrossProfit=new MgfProfitBeforeInterestTaxes();//::find()->where(['proposal_id'=>$model->proposal_id])->one();
                    //$ValueOfProductTotal=MgfValueOfProductTotals::find()->where(['proposal_id'=>$model->proposal_id])->one();
                    //saving fixed and variable cost
                    $VariablefixedCoststotal=MgfVariableFixedCostTotals::find()->where(['proposal_id'=>$model->proposal_id])->one();
                    $total_yr1_value=MgfVariableFixedCost::find()->where(['proposal_id'=>$model->proposal_id])->sum('cost_yr1_value');
                    $total_yr2_value=MgfVariableFixedCost::find()->where(['proposal_id'=>$model->proposal_id])->sum('cost_yr2_value');
                    $total_yr3_value=MgfVariableFixedCost::find()->where(['proposal_id'=>$model->proposal_id])->sum('cost_yr3_value');
                    $total_yr4_value=MgfVariableFixedCost::find()->where(['proposal_id'=>$model->proposal_id])->sum('cost_yr4_value');
                    
                    $VariablefixedCoststotal->total_yr1_value=$total_yr1_value;
                    $VariablefixedCoststotal->total_yr2_value=$total_yr1_value;
                    $VariablefixedCoststotal->total_yr3_value=$total_yr1_value;
                    $VariablefixedCoststotal->total_yr4_value=$total_yr1_value;
                    $VariablefixedCoststotal->created_by=$userid; 
                    $VariablefixedCoststotal->proposal_id=$model->proposal_id;                   
                    if($VariablefixedCoststotal->save()){
                        $this->calculateprofit($model->proposal_id);
                        }
                                                                   
                    
                   }else
                   {
                            $VariableFixedCostTotals= new MgfVariableFixedCostTotals();
                        
                            $ValueOfProductTotal=MgfValueOfProductTotals::find()->where(['proposal_id'=>$model->proposal_id])->one();
                            //$ValueOfProduct=MgfVariableFixedCost::find()->where(['proposal_id'=>$model->proposal_id])->one();
                            $VariableFixedCostTotals->total_yr1_value=MgfVariableFixedCost::find()->where(['proposal_id'=>$model->proposal_id])->sum('cost_yr1_value');
                            $VariableFixedCostTotals->total_yr2_value=MgfVariableFixedCost::find()->where(['proposal_id'=>$model->proposal_id])->sum('cost_yr2_value');
                            $VariableFixedCostTotals->total_yr3_value=MgfVariableFixedCost::find()->where(['proposal_id'=>$model->proposal_id])->sum('cost_yr3_value');
                            $VariableFixedCostTotals->total_yr4_value=MgfVariableFixedCost::find()->where(['proposal_id'=>$model->proposal_id])->sum('cost_yr4_value');
                            $VariableFixedCostTotals->date_created=date('Y-m-d H:i:s');
                            $VariableFixedCostTotals->created_by=$userid; 
                            $VariableFixedCostTotals->proposal_id=$model->proposal_id;
                            
                            if($VariableFixedCostTotals->save()){
                            $this->calculateprofit($model->proposal_id);
                            }
                                
                        }

                   }
                 
            
                
                //return $this->redirect(['index']);
            
        }
        //calculateprofit();
        return $this->render('create', [
            'model' => $model,
        ]);
    }


public function calculateprofit($proposal_id)
{
    $userid=Yii::$app->user->identity->id;
    $ValueOfProductTotal=MgfValueOfProductTotals::find()->where(['proposal_id'=>$proposal_id])->one();
    $ValueOfVariableFixedTotal=MgfVariableFixedCostTotals::find()->where(['proposal_id'=>$proposal_id])->one();

    
    
if (MgfProfitBeforeInterestTaxes::find()->where(['proposal_id'=>$proposal_id])->exists())
  {
    $model->profit_yr1_value=$ValueOfProductTotal->total_yr1_value-$ValueOfVariableFixedTotal->total_yr1_value;
    $model->profit_yr2_value=$ValueOfProductTotal->total_yr2_value-$ValueOfVariableFixedTotal->total_yr2_value;
    $model->profit_yr3_value=$ValueOfProductTotal->total_yr3_value-$ValueOfVariableFixedTotal->total_yr3_value;
    $model->profit_yr4_value=$ValueOfProductTotal->total_yr4_value-$ValueOfVariableFixedTotal->total_yr4_value;
    $model->created_by=$userid;
    $model->proposal_id=$proposal_id;
        if($model->save()){
        return $this->redirect(['/mgf-value-of-product/index']);
        }
 
    //return;
  }
  else
  {
    $model=new MgfProfitBeforeInterestTaxes();
    $model->profit_yr1_value=$ValueOfProductTotal->total_yr1_value-$ValueOfVariableFixedTotal->total_yr1_value;
    $model->profit_yr2_value=$ValueOfProductTotal->total_yr2_value-$ValueOfVariableFixedTotal->total_yr2_value;
    $model->profit_yr3_value=$ValueOfProductTotal->total_yr3_value-$ValueOfVariableFixedTotal->total_yr3_value;
    $model->profit_yr4_value=$ValueOfProductTotal->total_yr4_value-$ValueOfVariableFixedTotal->total_yr4_value;
    $model->created_by=$userid;
    $model->proposal_id=$proposal_id;
        if($model->save()){
        return $this->redirect(['/mgf-value-of-product/index']);
        }

  }

}
   public function actionVariablefixedcosttotals()
    {
        $model = new \frontend\models\MgfVariableFixedCostTotals();
    
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                // form inputs are valid, do something here
                return;
            }
        }
    
        return $this->render('variablefixedcosttotals', [
            'model' => $model,
        ]);
    } 

    /**
     * Updates an existing MgfVariableFixedCost model.
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
     * Deletes an existing MgfVariableFixedCost model.
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
     * Finds the MgfVariableFixedCost model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MgfVariableFixedCost the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MgfVariableFixedCost::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
} 
