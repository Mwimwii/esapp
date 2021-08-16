<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MgfExpectedOutputsAndGrossRevenueSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mgf Expected Outputs And Gross Revenues';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mgf-expected-outputs-and-gross-revenue-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Mgf Expected Outputs And Gross Revenue', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<i class="fa fa-Home"></i>Home', ['/mgf-applicant/profile',], ['class' => 'btn btn-default']);?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
            'output_name',
            'unit_of_measure',
            'quantity',
            'expected_price',
            //'expected_gross_revenue',
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
            ],
        ],
    ]); ?>


</div>
