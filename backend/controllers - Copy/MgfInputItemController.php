<?php

namespace backend\controllers;

use frontend\models\MgfActivity;
use frontend\models\MgfComponent;
use Yii;
use frontend\models\MgfInputItem;
use frontend\models\MgfInputCost;
use frontend\models\MgfInputItemSearch;
use frontend\models\MgfProposal;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MgfInputItemController implements the CRUD actions for MgfInputItem model.
 */
class MgfInputItemController extends Controller{
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
     * Lists all MgfInputItem models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MgfInputItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionInputs(){
        $searchModel = new MgfInputItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MgfInputItem model.
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
     * Creates a new MgfInputItem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id){
        $model = new MgfInputItem();
        if ($model->load(Yii::$app->request->post())) {
            $userid=Yii::$app->user->identity->id;
            $model->activity_id=$id;
            $model->item_no=time();
            $model->createdby=$userid;
            $total_1=$model->unit_cost*$model->project_year_1;
            $total_2=$model->unit_cost*$model->project_year_2;
            $total_3=$model->unit_cost*$model->project_year_3;
            $total_4=$model->unit_cost*$model->project_year_4;
            $total_5=$model->unit_cost*$model->project_year_5;
            $total_6=$model->unit_cost*$model->project_year_6;
            $total_7=$model->unit_cost*$model->project_year_7;
            $total_8=$model->unit_cost*$model->project_year_8;
            $total=$total_1+$total_2+$total_3+$total_4+$total_5+$total_6+$total_7+$total_8;;
            $model->total_cost=$total;
            $model->save();

            $activity=MgfActivity::findOne($id);

            $itemcost =MgfInputCost::find()->where(['activity_id'=>$id, 'input_name'=>$model->input_name,'item_no'=>$model->item_no])->one();
            $itemcost->project_year_1=$total_1;
            $itemcost->project_year_2=$total_2;
            $itemcost->project_year_3=$total_3;
            $itemcost->project_year_4=$total_4;
            $itemcost->project_year_5=$total_5;
            $itemcost->project_year_6=$total_6;
            $itemcost->project_year_7=$total_7;
            $itemcost->project_year_8=$total_8;
            $itemcost->save();

            $sum_of_item_cost=MgfInputCost::find()->where(['activity_id'=>$id])->sum('total_cost');
            $sum_of_items=MgfInputCost::find()->where(['activity_id'=>$id])->count();
            $activity->inputs=$sum_of_items;
            $activity->subtotal=$sum_of_item_cost;

            if($activity->save()){
                Yii::$app->session->setFlash('success', 'Saved Successfully');
                return $this->redirect(['mgf-component/manage', 'id' =>$this->sum_up_figures($activity->componet_id)]);
            }else{
                Yii::$app->session->setFlash('error', 'Action Fail');
                return $this->render('create', ['id' => $id,'model' => $model,]);
            }    
        }

        return $this->render('create', ['id' => $id,'model' => $model,]);
    }

    /**
     * Updates an existing MgfInputItem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id){
        $model = $this->findModel($id);
        $activity=MgfActivity::findOne($model->activity_id);
        $component=MgfComponent::findOne($activity->componet_id);
        $proposal=MgfProposal::findOne($component->proposal_id);
        if ($model->load(Yii::$app->request->post())) {
            $total_1=$model->unit_cost*$model->project_year_1;
            $total_2=$model->unit_cost*$model->project_year_2;
            $total_3=$model->unit_cost*$model->project_year_3;
            $total_4=$model->unit_cost*$model->project_year_4;
            $total_5=$model->unit_cost*$model->project_year_5;
            $total_6=$model->unit_cost*$model->project_year_6;
            $total_7=$model->unit_cost*$model->project_year_7;
            $total_8=$model->unit_cost*$model->project_year_8;
            $total=$total_1+$total_2+$total_3+$total_4+$total_5+$total_6+$total_7+$total_8;;
            $model->total_cost=$total;
            $model->save();

            $activity=MgfActivity::findOne($model->activity_id);
            $itemcost =MgfInputCost::find()->where(['activity_id'=>$activity->id, 'input_name'=>$model->input_name,'item_no'=>$model->item_no])->one();
            $itemcost->project_year_1=$total_1;
            $itemcost->project_year_2=$total_2;
            $itemcost->project_year_3=$total_3;
            $itemcost->project_year_4=$total_4;
            $itemcost->project_year_5=$total_5;
            $itemcost->project_year_6=$total_6;
            $itemcost->project_year_7=$total_7;
            $itemcost->project_year_8=$total_8;
            $itemcost->save();

            $sum_of_item_cost=MgfInputCost::find()->where(['activity_id'=>$activity->id])->sum('total_cost');
            $sum_of_items=MgfInputCost::find()->where(['activity_id'=>$activity->id])->count();
            $activity->inputs=$sum_of_items;
            $activity->subtotal=$sum_of_item_cost;
            
            if($activity->save() && $activity->save()){
                Yii::$app->session->setFlash('success', 'Saved Successfully');
                return $this->redirect(['mgf-component/inputitem', 'id' =>$this->sum_up_figures($activity->componet_id)]);
            }else{
                Yii::$app->session->setFlash('error', 'Action Fail');
                return $this->render('update', ['model' => $model,'proposal'=>$proposal]);
            }    
        }

        return $this->render('update', ['model' => $model,'proposal'=>$proposal]);
    }

    /**
     * Deletes an existing MgfInputItem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id){
        $item=MgfInputItem::findOne($id);
        if ($this->findModel($id)->delete()) {
            Yii::$app->session->setFlash('success', 'Deleted Successfully');
            $activity=MgfActivity::findOne($item->activity_id);
        
            $sum_of_item_cost=MgfInputCost::find()->where(['activity_id'=>$activity->id])->sum('total_cost');
            $sum_of_items=MgfInputCost::find()->where(['activity_id'=>$activity->id])->count();
            $activity->inputs=$sum_of_items;
            $activity->subtotal=$sum_of_item_cost;
            $activity->save();

            return $this->redirect(['mgf-component/inputitem', 'id' =>$this->sum_up_figures($activity->componet_id)]);
        }else{
            Yii::$app->session->setFlash('error', 'NOT Deleted');
        }
    }


    protected function sum_up_figures($compid){
        $component=MgfComponent::findOne($compid);

        $sum_of_activities=MgfActivity::find()->where(['componet_id'=>$component->id])->count();
        $sum_of_activity_cost=MgfActivity::find()->where(['componet_id'=>$component->id])->sum('subtotal');
        $component->subtotal=$sum_of_activity_cost;
        $component->activities=$sum_of_activities;
        $component->save();

        $proposal=MgfProposal::findOne($component->proposal_id);
        $sum_of_components=MgfComponent::find()->where(['proposal_id'=>$proposal->id])->sum('subtotal');
        $proposal->totalcost=$sum_of_components;
        if($sum_of_components>0){
            $proposal->proposal_status="Prepared";
        }else{
            $proposal->proposal_status="Created";
        }
        $proposal->save();

        return $compid;
    }

    /**
     * Finds the MgfInputItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MgfInputItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MgfInputItem::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
