<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MgfImplementationArrangementsCooperatingPartnersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mgf Implementation Arrangements Cooperating Partners';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mgf-implementation-arrangements-cooperating-partners-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Mgf Implementation Arrangements Cooperating Partners', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<i class="fa fa-Home"></i>Home', ['/mgf-applicant/profile',], ['class' => 'btn btn-default']);?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'main_activities',
            'respobility',
            'experience',
            'comment',
            //'typee',
            //'proposal_id',
            //'date_created',
            //'created_by',
            //'created_at',
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
