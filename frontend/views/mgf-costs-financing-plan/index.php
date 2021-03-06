<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MgfCostsFinancingPlanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mgf Costs Financing Plans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mgf-costs-financing-plan-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Mgf Costs Financing Plan', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<i class="fa fa-Home"></i>Home', ['/mgf-applicant/profile',], ['class' => 'btn btn-default']);?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'componentid',
            'activityid',
            'input_name',
            'total_Project_cost',
           // 'Applicant_in_kind',
            //'Applicant_in_cash',
            //'total_contribution',
            //'mgf_grant',
            //'other_sources',
            //'total',
            //'mgf_as_percent',
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
            ],
        ],
    ]); ?>


</div>
