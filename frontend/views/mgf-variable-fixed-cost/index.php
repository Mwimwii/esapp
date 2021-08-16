<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MgfVariableFixedCostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mgf Variable Fixed Costs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mgf-variable-fixed-cost-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Mgf Variable Fixed Cost', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
       <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'cost_name',
            'cost_type',
            'cost_yr1_value',
            'cost_yr2_value',
            //'cost_yr3_value',
            //'cost_yr4_value',
            //'comment',
            //'proposal_id',
            //'date_created',
            //'date_update',
            //'created_by',
            //'updated_by',

            [
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => [],
                'header'=>'Actions',
                'template' => '{view} {update} {delete}',
                'visibleButtons'=>[
                //'delete'=> function($model){
                //return $model->zone_status!='deleted';
                //},
                //'view'=> function($model){
                //return $model->zone_status!='active';
                //},
                ]
            ]
        ],
    ]); ?>


</div>
