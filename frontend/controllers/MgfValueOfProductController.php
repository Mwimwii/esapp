<?php

namespace frontend\controllers;

use Yii;
use frontend\models\MgfValueOfProduct;
use frontend\models\MgfValueOfProductSearch;
use frontend\models\MgfValueOfProductTotals;
use frontend\models\MgfValueOfProductTotalsSearch;
use frontend\models\MgfVariableFixedCost;
use frontend\models\MgfVariableFixedCostSearch;
use frontend\models\MgfVariableFixedCostTotalsSearch;
use frontend\models\MgfVariableFixedCostTotals;
use frontend\models\MgfProfitBeforeInterestTaxesSearch;
use frontend\models\MgfProfitBeforeInterestTaxes;
use frontend\models\MgfNetprofit;
use frontend\models\MgfNetprofitSearch;
use frontend\models\MgfCumulativeProfit;
use frontend\models\MgfCumulativeProfitSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\user;

/**
 * MgfValueOfProductController implements the CRUD actions for MgfValueOfProduct model.
 */
class MgfValueOfProductController extends Controller
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
     * Lists all MgfValueOfProduct models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MgfValueOfProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $searchModel1=new MgfVariableFixedCostSearch();
        $dataProvider1 = $searchModel1->search(Yii::$app->request->queryParams);
        $searchModel2=new MgfValueOfProductTotalsSearch();
        $dataProvider2 = $searchModel2->search(Yii::$app->request->queryParams);
        $searchModel3=new MgfVariableFixedCostTotalsSearch();
        $dataProvider3 = $searchModel3->search(Yii::$app->request->queryParams);

        $searchModel4=new MgfProfitBeforeInterestTaxesSearch();
        $dataProvider4 = $searchModel4->search(Yii::$app->request->queryParams);

        $searchModel5=new MgfNetprofitSearch();
        $dataProvider5 = $searchModel5->search(Yii::$app->request->queryParams);

        $searchModel6=new MgfCumulativeProfitSearch();
        $dataProvider6 = $searchModel6->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'searchModel1' => $searchModel1,
            'dataProvider1' => $dataProvider1,
            'searchModel2' => $searchModel2,
            'dataProvider2' => $dataProvider2,
            'searchModel3' => $searchModel3,
            'dataProvider3' => $dataProvider3,
            'searchModel4' => $searchModel4,
            'dataProvider4' => $dataProvider4,
            'searchModel5' => $searchModel5,
            'dataProvider5' => $dataProvider5,
            'searchModel6' => $searchModel6,
            'dataProvider6' => $dataProvider6,
        ]);
    }

    /**
     * Displays a single MgfValueOfProduct model.
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
     * Creates a new MgfValueOfProduct model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MgfValueOfProduct();
        $product_yr1_value=0;
        $product_yr2_value=0;
        $product_yr3_value=0;
        $product_yr4_value=0;
        
        if ($model->load(Yii::$app->request->post()) ){
            // $model_1= new MgfValueOfProductTotals();

            //$user=Yii::$app->user->id;
            $userid=Yii::$app->user->identity->id;
           // $applicant=MgfApplicant::findOne(['user_id'=>$userid]);
            //$proposal=MgfProposal::find()->where(['is_active'=>1,'organisation_id'=>$applicant->organisation_id])->one();
            //$model->proposal_id=13;//$proposal->id;
            $model->date_created=date('Y-m-d H:i:s');
            $model->created_by=$userid; 
            $product_yr1_value=$model->product_yr1_qty * $model->product_yr1_price;
            $product_yr2_value=$model->product_yr2_qty * $model->product_yr2_price;
            $product_yr3_value=$model->product_yr3_qty * $model->product_yr3_price;
            $product_yr4_value=$model->product_yr4_qty * $model->product_yr4_price;

            $model->product_yr1_value= $product_yr1_value;
            $model->product_yr2_value=$product_yr2_value;
            $model->product_yr3_value=$product_yr3_value;
            $model->product_yr4_value=$product_yr4_value;
                      
            
            if ($model->save()) 
               {
                   if (MgfValueofProductTotals::find()->where(['proposal_id'=>$model->proposal_id])->exists())
                   {
                    $ValueOfProduct=MgfValueofProductTotals::find()->where(['proposal_id'=>$model->proposal_id])->one();
                    $ValueOfProduct->total_yr1_value=MgfValueOfProduct::find()->where(['proposal_id'=>$model->proposal_id])->sum('product_yr1_value');
                    $ValueOfProduct->total_yr2_value=MgfValueOfProduct::find()->where(['proposal_id'=>$model->proposal_id])->sum('product_yr2_value');
                    $ValueOfProduct->total_yr3_value=MgfValueOfProduct::find()->where(['proposal_id'=>$model->proposal_id])->sum('product_yr3_value');
                    $ValueOfProduct->total_yr4_value=MgfValueOfProduct::find()->where(['proposal_id'=>$model->proposal_id])->sum('product_yr4_value');
                    $ValueOfProduct->save();
                   }else
                   {
                    $ValueOfProduct= new MgfValueOfProductTotals();
                    $ValueOfProduct->total_yr1_value=MgfValueOfProduct::find()->where(['proposal_id'=>$model->proposal_id])->sum('product_yr1_value');
                    $ValueOfProduct->total_yr2_value=MgfValueOfProduct::find()->where(['proposal_id'=>$model->proposal_id])->sum('product_yr2_value');
                    $ValueOfProduct->total_yr3_value=MgfValueOfProduct::find()->where(['proposal_id'=>$model->proposal_id])->sum('product_yr3_value');
                    $ValueOfProduct->total_yr4_value=MgfValueOfProduct::find()->where(['proposal_id'=>$model->proposal_id])->sum('product_yr4_value');
                    $ValueOfProduct->date_created=date('Y-m-d H:i:s');
                    $ValueOfProduct->created_by=$userid; 
                    $ValueOfProduct->proposal_id=$model->proposal_id;
                    $ValueOfProduct->save();
                   }
                 

                 return $this->redirect(['index']);
               }

               
            }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing MgfValueOfProduct model.
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
/* public function actionVariablefixedcosts()
    {
        $model = new \frontend\models\MgfVariableFixedCost();
    
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                // form inputs are valid, do something here
                return;
            }
        }
    
        return $this->render('mgf-variable-fixed-cost/create', [
            'model' => $model,
        ]);
    } */

   /*  public function actionVariablefixedcosttotals()
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
} */
    /**
     * Deletes an existing MgfValueOfProduct model.
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
     * Finds the MgfValueOfProduct model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MgfValueOfProduct the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MgfValueOfProduct::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
