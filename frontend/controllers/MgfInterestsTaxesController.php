<?php

namespace frontend\controllers;

use Yii;
use frontend\models\MgfInterestsTaxes;
use frontend\models\MgfInterestsTaxesSearch;
use frontend\models\MgfProfitBeforeInterestTaxes;
use frontend\models\MgfCumulativeProfit;
use frontend\models\MgfNetprofit;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MgfInterestsTaxesController implements the CRUD actions for MgfInterestsTaxes model.
 */
class MgfInterestsTaxesController extends Controller
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
     * Lists all MgfInterestsTaxes models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MgfInterestsTaxesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MgfInterestsTaxes model.
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
     * Creates a new MgfInterestsTaxes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MgfInterestsTaxes();

        if ($model->load(Yii::$app->request->post()) )
        {
            //$user=Yii::$app->user->id;
            $userid=Yii::$app->user->identity->id;
           // $applicant=MgfApplicant::findOne(['user_id'=>$userid]);
            //$proposal=MgfProposal::find()->where(['is_active'=>1,'organisation_id'=>$applicant->organisation_id])->one();
            //$model->proposal_id=13;//$proposal->id;
            $model->date_created=date('Y-m-d H:i:s');
            $model->created_by=$userid;  
            
            if (MgfProfitBeforeInterestTaxes::find()->where(['proposal_id'=>$model->proposal_id])->exists())
            {
             $ProfitBeforeInterestTaxes=MgfProfitBeforeInterestTaxes::find()->where(['proposal_id'=>$model->proposal_id])->one();
             $model->interest_yr1_value=$ProfitBeforeInterestTaxes->profit_yr1_value*$model->interest_tax_percent;
             $model->interest_yr2_value=$ProfitBeforeInterestTaxes->profit_yr2_value*$model->interest_tax_percent;
             $model->interest_yr3_value=$ProfitBeforeInterestTaxes->profit_yr3_value*$model->interest_tax_percent;
             $model->interest_yr4_value=$ProfitBeforeInterestTaxes->profit_yr4_value*$model->interest_tax_percent;
             if($model->save())
             {
               if (MgfNetprofit::find()->where(['proposal_id'=>$model->proposal_id])->exists())
                 {
                   if ($model->interest_tax_type=='Interest')
                   {
                    $userid=Yii::$app->user->identity->id;
                    
                    $Netprofit=MgfNetprofit::find()->where(['proposal_id'=>$model->proposal_id])->one();

                    $Netprofit->created_by=$userid;
                    $Netprofit->proposal_id=$model->proposal_id;
                    $Netprofit->netprofit_yr1_value=$model->interest_yr1_value+$ProfitBeforeInterestTaxes->profit_yr1_value;
                    $Netprofit->netprofit_yr2_value=$model->interest_yr2_value+$ProfitBeforeInterestTaxes->profit_yr2_value;
                    $Netprofit->netprofit_yr3_value=$model->interest_yr3_value+$ProfitBeforeInterestTaxes->profit_yr3_value;
                    $Netprofit->netprofit_yr4_value=$model->interest_yr4_value+$ProfitBeforeInterestTaxes->profit_yr4_value;
                    if($Netprofit->save()){
                      
                         $CumulativeProfit=MgfCumulativeProfit::find()->where(['proposal_id'=>$model->proposal_id])->one();
                         $CumulativeProfit->cumulative_profit_yr1_value=$CumulativeProfit->cumulative_profit_yr1_value + $model->interest_yr1_value;
                         $CumulativeProfit->cumulative_profit_yr2_value=$CumulativeProfit->cumulative_profit_yr2_value + $model->interest_yr2_value;
                         $CumulativeProfit->cumulative_profit_yr3_value=$CumulativeProfit->cumulative_profit_yr3_value + $model->interest_yr3_value;
                         $CumulativeProfit->cumulative_profit_yr4_value=$CumulativeProfit->cumulative_profit_yr4_value + $model->interest_yr4_value;
                         $CumulativeProfit->created_by=$userid;
                         $CumulativeProfit->proposal_id=$model->proposal_id;
                         $CumulativeProfit->save();


                     return $this->redirect(['/mgf-value-of-product/index']);
                     }


                   }elseif($model->interest_tax_type=='Tax')
                   {
                    $Netprofit=MgfNetprofit::find()->where(['proposal_id'=>$model->proposal_id])->one();
                    //$Netprofit=new MgfNetprofit();
                    $Netprofit->created_by=$userid;
                    $Netprofit->proposal_id=$model->proposal_id;
                    $Netprofit->netprofit_yr1_value=$ProfitBeforeInterestTaxes->profit_yr1_value-$model->interest_yr1_value;
                    $Netprofit->netprofit_yr2_value=$ProfitBeforeInterestTaxes->profit_yr2_value-$model->interest_yr2_value;
                    $Netprofit->netprofit_yr3_value=$ProfitBeforeInterestTaxes->profit_yr3_value-$model->interest_yr3_value;
                    $Netprofit->netprofit_yr4_value=$ProfitBeforeInterestTaxes->profit_yr4_value-$model->interest_yr4_value;
                     if($Netprofit->save()){

                        $CumulativeProfit=MgfCumulativeProfit::find()->where(['proposal_id'=>$model->proposal_id])->one();
                        $CumulativeProfit->cumulative_profit_yr1_value=$CumulativeProfit->cumulative_profit_yr1_value - $model->interest_yr1_value;
                        $CumulativeProfit->cumulative_profit_yr2_value=$CumulativeProfit->cumulative_profit_yr2_value - $model->interest_yr2_value;
                        $CumulativeProfit->cumulative_profit_yr3_value=$CumulativeProfit->cumulative_profit_yr3_value - $model->interest_yr3_value;
                        $CumulativeProfit->cumulative_profit_yr4_value=$CumulativeProfit->cumulative_profit_yr4_value - $model->interest_yr4_value;
                        $CumulativeProfit->created_by=$userid;
                        $CumulativeProfit->proposal_id=$model->proposal_id;
                        $CumulativeProfit->save();


                     return $this->redirect(['/mgf-value-of-product/index']);
                     }
                   };
                 }else
                 {
                     if ($model->interest_tax_type=='Interest')
                     {
                      
                      $Netprofit=new MgfNetprofit();
                      $Netprofit->netprofit_yr1_value=$model->interest_yr1_value+$ProfitBeforeInterestTaxes->profit_yr1_value;
                      $Netprofit->netprofit_yr2_value=$model->interest_yr2_value+$ProfitBeforeInterestTaxes->profit_yr2_value;
                      $Netprofit->netprofit_yr3_value=$model->interest_yr3_value+$ProfitBeforeInterestTaxes->profit_yr3_value;
                      $Netprofit->netprofit_yr4_value=$model->interest_yr4_value+$ProfitBeforeInterestTaxes->profit_yr4_value;
                      $Netprofit->created_by=$userid;
                      $Netprofit->proposal_id=$model->proposal_id;
                      if($Netprofit->save()){
                         $CumulativeProfit=new MgfCumulativeProfit();
                         $CumulativeProfit->cumulative_profit_yr1_value=$Netprofit->netprofit_yr1_value;
                         $CumulativeProfit->cumulative_profit_yr2_value=$CumulativeProfit->cumulative_profit_yr1_value+$Netprofit->netprofit_yr2_value;
                         $CumulativeProfit->cumulative_profit_yr3_value=$CumulativeProfit->cumulative_profit_yr2_value+$Netprofit->netprofit_yr3_value;
                         $CumulativeProfit->cumulative_profit_yr4_value=$CumulativeProfit->cumulative_profit_yr3_value+$Netprofit->netprofit_yr4_value;
                         $CumulativeProfit->created_by=$userid;
                         $CumulativeProfit->proposal_id=$model->proposal_id;
                         $CumulativeProfit->save();

                         return $this->redirect(['/mgf-value-of-product/index']);
                         }

                     }elseif($model->interest_tax_type=='Tax')
                     {
                      $Netprofit=new MgfNetprofit();
                      $Netprofit->netprofit_yr1_value=$ProfitBeforeInterestTaxes->profit_yr1_value-$model->interest_yr1_value;
                      $Netprofit->netprofit_yr2_value=$ProfitBeforeInterestTaxes->profit_yr2_value-$model->interest_yr2_value;
                      $Netprofit->netprofit_yr3_value=$ProfitBeforeInterestTaxes->profit_yr3_value-$model->interest_yr3_value;
                      $Netprofit->netprofit_yr4_value=$ProfitBeforeInterestTaxes->profit_yr4_value-$model->interest_yr4_value;
                      $Netprofit->created_by=$userid;
                      $Netprofit->proposal_id=$model->proposal_id;
                      if($Netprofit->save()){

                        $CumulativeProfit=new MgfCumulativeProfit();//::find()->where(['proposal_id'=>$model->proposal_id])->one();
                        $CumulativeProfit->cumulative_profit_yr1_value=$Netprofit->netprofit_yr1_value;
                        $CumulativeProfit->cumulative_profit_yr2_value=$CumulativeProfit->cumulative_profit_yr1_value +$Netprofit->netprofit_yr2_value;
                        $CumulativeProfit->cumulative_profit_yr3_value=$CumulativeProfit->cumulative_profit_yr2_value +$Netprofit->netprofit_yr3_value;
                        $CumulativeProfit->cumulative_profit_yr4_value=$CumulativeProfit->cumulative_profit_yr3_value +$Netprofit->netprofit_yr4_value;
                        $CumulativeProfit->created_by=$userid;
                        $CumulativeProfit->proposal_id=$model->proposal_id;
                        $CumulativeProfit->save();
                         return $this->redirect(['/mgf-value-of-product/index']);
                         }
                     };

                 }

             
               };
            
            };
       
                    
                          
            



        };

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing MgfInterestsTaxes model.
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
     * Deletes an existing MgfInterestsTaxes model.
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
     * Finds the MgfInterestsTaxes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MgfInterestsTaxes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MgfInterestsTaxes::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
