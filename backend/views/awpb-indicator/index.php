<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AwpbIndicatorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Awpb Indicators';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="awpb-indicator-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Awpb Indicator', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'component_id',
            'name',
            'description',
            'unit_of_measure_id',
            //'created_at',
            //'updated_at',
            //'created_by',
            //'updated_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>


?>

<div class="card card-success card-outline">
    <div class="card-body">

        <p>
         <?php
            if (\backend\models\User::userIsAllowedTo('Manage AWPB activities')) {
               echo Html::a('<i class="fa fa-plus"></i> Add AWPB Activity', ['create'], ['class' => 'btn btn-success btn-sm']);
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
                'attribute' => 'activity_code', 
                'vAlign' => 'middle',
                'width' => '180px',
                'value' => function ($model, $key, $index, $widget) { 
                return      Html::a($model->activity_code, ['awpb-activity/view', 'id' => $model->id], ['class' => 'awbp-activty']);
               
                },
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(backend\models\AwpbActivity::find()->orderBy('activity_code')->asArray()->all(), 'id', 'activity_code'), 
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                    'options' => ['multiple' => true]
                ],
                'filterInputOptions' => ['placeholder' => 'Filter by activity code'],
                'format' => 'raw'
            ],

			//'parent_activity_id',
			//'component_id',
            [
                'attribute' => 'name', 
                'vAlign' => 'middle',
                'width' => '180px',
                'value' => function ($model, $key, $index, $widget) { 
                return      Html::a($model->name, ['awpb-activity/view', 'id' => $model->id], ['class' => 'awbp-activity']);
               
                },
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(backend\models\AwpbActivity::find()->orderBy('name')->asArray()->all(), 'id', 'name'), 
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                    'options' => ['multiple' => true]
                ],
                'filterInputOptions' => ['placeholder' => 'Filter by name'],
                'format' => 'raw'
            ],

            'indicator',
            'programme_target',	


                  [
                    'attribute' => 'funder_id', 
                    'vAlign' => 'middle',
                    'width' => '180px',
                    'value' => function ($model, $key, $index, $widget) {
                        $funder= \backend\models\AwpbFunder::findOne(['id' => $model->funder_id]);						
                    
                    return     !empty($funder) ? Html::a($funder->name, ['awpb-funder/view', 'id' => $model->funder_id], ['class' => 'awbp-funder']):"";
                   
                    },
                    'filterType' => GridView::FILTER_SELECT2,
                    'filter' => ArrayHelper::map(backend\models\AwpbActivity::find()->orderBy('name')->asArray()->all(), 'id', 'name'), 
                    'filterWidgetOptions' => [
                        'pluginOptions' => ['allowClear' => true],
                        'options' => ['multiple' => true]
                    ],
                    'filterInputOptions' => ['placeholder' => 'Filter by name'],
                    'format' => 'raw'
                ],
    
                  [
                    'attribute' => 'unit_of_measure_id', 
                    'vAlign' => 'middle',
                    'width' => '180px',
                    'value' => function ($model, $key, $index, $widget) { 
                        $unit_of_measure = \backend\models\AwpbUnitOfMeasure::findOne(['id' => $model->unit_of_measure_id]);						
                      //  return !empty( $unit_of_measure) ?  $unit_of_measure->name : "";
                    return     !empty( $unit_of_measure) ?  $unit_of_measure->name:"";
                   
                    },
                    // 'filterType' => GridView::FILTER_SELECT2,
                    // 'filter' => ArrayHelper::map(backend\models\AwpbUnitOfMeasure::find()->orderBy('name')->asArray()->all(), 'id', 'name'), 
                    // 'filterWidgetOptions' => [
                    //     'pluginOptions' => ['allowClear' => true],
                    //     'options' => ['multiple' => true]
                    // ],
                    // 'filterInputOptions' => ['placeholder' => 'Filter by name'],
                    // 'format' => 'raw'
                ],
    
			//   [
            //   'label' => 'Unit of measure',
            //         'value' => function($model) {
            //             $unit_of_measure = \backend\models\AwpbUnitOfMeasure::findOne(['id' => $model->unit_of_measure_id]);						
            //             return !empty( $unit_of_measure) ?  $unit_of_measure->name : "";  
            //         }
            //     ],

            [
                'attribute' => 'expense_category_id', 
                'vAlign' => 'middle',
                'width' => '180px',
                'value' => function ($model, $key, $index, $widget) { 
                    $expense_category = \backend\models\AwpbExpenseCategory::findOne(['id' => $model->expense_category_id]);
                       
                return    !empty($expense_category) ? $expense_category->name:"";
               
                },
  
            ],


['class' => 'yii\grid\ActionColumn',
'template' => '{view}{update}{delete}',
'buttons' => [
    'view' => function ($url, $model) {
        if (User::userIsAllowedTo('View AWPB activities') ) {
            return Html::a(
                            '<span class="fa fa-eye"></span>', ['view', 'id' => $model->id], [
                        'title' => 'View component',
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
        if (User::userIsAllowedTo('Manage AWPB activities') ) {
            return Html::a(
                            '<span class="fas fa-edit"></span>',['update', 'id' => $model->id], [ 
                        'title' => 'Update component',
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
        if (User::userIsAllowedTo('Manage AWPB activities') ) {
            return Html::a(
                            '<span class="fa fa-trash"></span>', ['delete', 'id' => $model->id], [
                        'title' => 'delete component',
                        'data-toggle' => 'tooltip',
                        'data-placement' => 'top',
                        'data' => [
                            'confirm' => 'Are you sure you want to remove this component?',
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
]);
            ?>











</div>


