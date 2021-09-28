<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MgfExistingFacilitiesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mgf Existing Facilities';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mgf-existing-facilities-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    <?= Html::a('<i class="fa fa-Home"></i>Home', ['/mgf-applicant/profile',], ['class' => 'btn btn-default']);?>    
    <?= Html::a('Create Existing Facilities', ['create'], ['class' => 'btn btn-success']) ?>
       
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'facility_name',
            'description',
            'quantity',
            'use_to_be_made',
            //'estimate_cost',
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
