<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MgfExperienceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mgf Experiences';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mgf-experience-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Mgf Experience', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'financed_before',
            'project_name',
            'years_assisted',
            'amount_assisted',
            //'obligations_met',
            //'outcome_response:ntext',
            //'any_collaboration',
            //'collaboration_response:ntext',
            //'collaboration_will',
            //'willing_response:ntext',
            //'organisation_id',
            //'date_created',

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
