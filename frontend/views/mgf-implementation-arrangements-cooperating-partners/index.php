<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MgfImplementationArrangementsCooperatingPartnersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

<<<<<<< HEAD
$this->title = 'Implementation Arrangements Cooperating';
=======
$this->title = 'Mgf Implementation Arrangements Cooperating Partners';
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mgf-implementation-arrangements-cooperating-partners-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
<<<<<<< HEAD
    <?= Html::a('<i class="fa fa-Home"></i>Home', ['/mgf-applicant/profile',], ['class' => 'btn btn-default']);?>
    <?= Html::a('Create Implementation Arrangements Cooperating', ['create'], ['class' => 'btn btn-success']) ?>
=======
        <?= Html::a('Create Mgf Implementation Arrangements Cooperating Partners', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<i class="fa fa-Home"></i>Home', ['/mgf-applicant/profile',], ['class' => 'btn btn-default']);?>
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

<<<<<<< HEAD
           // 'id',
=======
            'id',
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
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
<<<<<<< HEAD
            ]
=======
            ],
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
        ],
    ]); ?>


</div>
