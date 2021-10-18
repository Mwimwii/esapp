<?php

use yii\helpers\Html;
use kartik\grid\EditableColumn;
use kartik\grid\GridView;;
use kartik\editable\Editable;
use backend\models\User;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AwpbOutcomeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'AWPB Outcomes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card card-success card-outline">
    <div class="card-body">
    <h1><?= Html::encode($this->title) ?></h1>
        <p>
            <?php
           if (User::userIsAllowedTo("Setup AWPB") ) {
               echo Html::a('<i class="fa fa-plus"></i> Add AWPB Outcome', ['create'], ['class' => 'btn btn-success btn-sm']);
            }
            ?>
        </p>
        <hr class="dotted short">


  


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
     
           
            'name',
            'outcome_description',
            //'created_at',
            //'updated_at',
            //'created_by',
            //'updated_by',

        
            ['class' => 'yii\grid\ActionColumn',
'template' => '{view}{update}{delete}',
'buttons' => [
    'view' => function ($url, $model) {
        if (User::userIsAllowedTo('View AWPB') ) {
            return Html::a(
                            '<span class="fa fa-eye"></span>', ['view', 'id' => $model->id], [
                        'title' => 'View outcome',
                        'data-toggle' => 'tooltip',
                        'data-placement' => 'top',
                        'data-pjax' => '0',
                        'style' => "padding:5px;",
                        'class' => 'bt btn-lg'
                            ]
            );
        }
    },
    'update' => function ($url, $model) {
        if (User::userIsAllowedTo('Setup AWPB') ) {
            return Html::a(
                            '<span class="fas fa-edit"></span>',['update', 'id' => $model->id], [ 
                        'title' => 'Update outcome',
                        'data-toggle' => 'tooltip',
                        'data-placement' => 'top',
                        // 'target' => '_blank',
                        'data-pjax' => '0',
                        'style' => "padding:5px;",
                        'class' => 'bt btn-lg'
                            ]
            );
        }
    },
    'delete' => function ($url, $model) {
        if (User::userIsAllowedTo('Setup AWPB') ) {
            return Html::a(
                            '<span class="fa fa-trash"></span>', ['delete', 'id' => $model->id], [
                        'title' => 'delete outcome',
                        'data-toggle' => 'tooltip',
                        'data-placement' => 'top',
                        'data' => [
                            'confirm' => 'Are you sure you want to remove this outcome?',
                            'method' => 'post',
                        ],
                        'style' => "padding:5px;",
                        'class' => 'bt btn-lg'
                            ]
            );
        }
    },
]
]


        ],
    ]); ?>

</div>
