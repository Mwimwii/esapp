<?php

use yii\helpers\Html;
use kartik\grid\EditableColumn;
use kartik\grid\GridView;;
use kartik\editable\Editable;
use backend\models\User;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AwpbOutputSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'AWPB Outputs';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="card card-success card-outline">
    <div class="card-body">
    <h1><?= Html::encode($this->title) ?></h1>
        <p>
            <?php
           if (User::userIsAllowedTo("Setup AWPB") ) {
               echo Html::a('<i class="fa fa-plus"></i> Add AWPB Output', ['create'], ['class' => 'btn btn-success btn-sm']);
            }
            ?>
        </p>
        <hr class="dotted short">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'component_id', 
                'vAlign' => 'middle',
                'width' => '180px',
                'value' => function ($model, $key, $index, $widget) {
                    $component= \backend\models\AwpbComponent::findOne(['id' => $model->component_id]);						
                
                return     !empty($component) ? Html::a($component->name, ['awpb-component/view', 'id' => $model->component_id], ['class' => 'awbp-outcome']):"";
               
                },
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(backend\models\AwpbComponent::find()->orderBy('name')->asArray()->all(), 'id', 'name'), 
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                    'options' => ['multiple' => true]
                ],
                'filterInputOptions' => ['placeholder' => 'Filter by name'],
                'format' => 'raw'
            ],
        
            [
                'attribute' => 'outcome_id', 
                'vAlign' => 'middle',
                'width' => '180px',
                'value' => function ($model, $key, $index, $widget) {
                    $outcome= \backend\models\AwpbOutcome::findOne(['id' => $model->outcome_id]);						
                
                return     !empty( $outcome) ? Html::a( $outcome->name, ['awpb-outcome/view', 'id' => $model->outcome_id], ['class' => 'awbp-output']):"";
               
                },
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(backend\models\AwpbOutcome::find()->orderBy('name')->asArray()->all(), 'id', 'name'), 
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                    'options' => ['multiple' => true]
                ],
                'filterInputOptions' => ['placeholder' => 'Filter by name'],
                'format' => 'raw'
            ], 
     
            'name',
            'output_description',
            //'created_at',
            //'updated_at',
            //'created_by',
            //'updated_by',

           ['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
'template' => '{view}{update}{delete}',
'buttons' => [
    'view' => function ($url, $model) {
        if (User::userIsAllowedTo('View AWPB') ) {
            return Html::a(
                            '<span class="fa fa-eye"></span>', ['view', 'id' => $model->id], [
                        'title' => 'View output',
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
                        'title' => 'Update output',
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
                        'title' => 'delete output',
                        'data-toggle' => 'tooltip',
                        'data-placement' => 'top',
                        'data' => [
                            'confirm' => 'Are you sure you want to remove this output?',
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
