<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\grid\ActionColumn;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MgfImplementationScheduleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mgf Implementation Schedules';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mgf-implementation-schedule-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Back', ['mgf-applicant/profile'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Create Mgf Implementation Schedule', ['create'], ['class' => 'btn btn-success']) ?>
        
    </p>

    
    <?php
    $gridColumns = [
      ['class' => 'kartik\grid\SerialColumn'],
      [
          'class' => 'kartik\grid\EditableColumn',
          'attribute' => 'name',
          'pageSummary' => 'Page Total',
          'vAlign'=>'middle',
          'headerOptions'=>['class'=>'kv-sticky-column'],
          'contentOptions'=>['class'=>'kv-sticky-column'],
          'editableOptions'=>['header'=>'Name', 'size'=>'md']
      ],
      [
          'attribute'=>'color',
          'value'=>function ($model, $key, $index, $widget) {
              return "<span class='badge' style='background-color: {$model->color}'> </span>  <code>" . 
                  $model->color . '</code>';
          },
          'filterType'=>GridView::FILTER_COLOR,
          'vAlign'=>'middle',
          'format'=>'raw',
          'width'=>'150px',
          'noWrap'=>true
      ],
      [
          'class'=>'kartik\grid\BooleanColumn',
          'attribute'=>'status', 
          'vAlign'=>'middle',
      ],
      [
          'class' => 'kartik\grid\ActionColumn',
          'dropdown' => true,
          'vAlign'=>'middle',
          'urlCreator' => function($action, $model, $key, $index) { return '#'; },
          'viewOptions'=>['title'=>'View', 'data-toggle'=>'tooltip'],
          'updateOptions'=>['title'=>'Update', 'data-toggle'=>'tooltip'],
          'deleteOptions'=>['title'=>'Delete', 'data-toggle'=>'tooltip'], 
      ],
      ['class' => 'kartik\grid\CheckboxColumn']
  ];   
    
    ?>
       <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => $gridColumns,
        'containerOptions' => ['style'=>'overflow: auto'], // only set when $responsive = false
        'beforeHeader'=>[
            [
                'columns'=>[
                    ['content'=>'Activity', 'options'=>['colspan'=>1, 'class'=>'text-center warning']], 
                    ['content'=>'Year 1', 'options'=>['colspan'=>4, 'class'=>'text-center warning']], 
                    ['content'=>'Year 2', 'options'=>['colspan'=>4, 'class'=>'text-center warning']], 
                    ['content'=>'Year 3', 'options'=>['colspan'=>4, 'class'=>'text-center warning']],
                    ['content'=>'Year 4', 'options'=>['colspan'=>4, 'class'=>'text-center warning']],  
                  ],
                'options'=>['class'=>'skip-export'] // remove this row from export
            ]
        ],
        /* 'toolbar' =>  [
          ['content'=>
              Html::button('&lt;i class="glyphicon glyphicon-plus">&lt;/i>', ['type'=>'button', 'title'=>Yii::t('kvgrid', 'Add Book'), 'class'=>'btn btn-success', 'onclick'=>'alert("This will launch the book creation form.\n\nDisabled for this demo!");']) . ' '.
              Html::a('&lt;i class="glyphicon glyphicon-repeat">&lt;/i>', ['grid-demo'], ['data-pjax'=>0, 'class' => 'btn btn-default', 'title'=>Yii::t('kvgrid', 'Reset Grid')])
          ],
          '{export}',
          '{toggleData}'
      ], */
      'pjax' => true,
      'bordered' => true,
      'striped' => false,
      'condensed' => false,
      'responsive' => true,
      'hover' => true,
      'floatHeader' => true,
      // 'floatHeaderOptions' => ['top' => $scrollingTop],
      'showPageSummary' => true,
      'panel' => [
          'type' => GridView::TYPE_PRIMARY
      ],
                   
        'columns' => [
            //['class' => 'yii\grid\CheckboxColumn'],

            //'id',
            //'activity_id',
            [
                'label' => '',
                'attribute' => 'activity_name',
                 // 'filter' => ['0' => 'no', '1' => 'yes'],
               // 'filterInputOptions' => ['prompt' => 'All educations', 'class' => 'form-control', 'id' => null]
            ],
            [  
                'label' => 'Qtr 1',
                'attribute' => 'yr1qtr1',
                'value'=> function($model)
                   {
                     return $model->yr1qtr1==0?'X':'✓';
                   },
               // 'filter' => ['0' => 'no', '1' => 'yes'],
               // 'filterInputOptions' => ['prompt' => 'All educations', 'class' => 'form-control', 'id' => null]
            ],
            [
                'label' => 'Qtr 2',
                'attribute' => 'yr1qtr2',
                'value'=> function($model)
                   {
                     return $model->yr1qtr2==0?'X':'✓';
                   },
               // 'filter' => ['0' => 'no', '1' => 'yes'],
               // 'filterInputOptions' => ['prompt' => 'All educations', 'class' => 'form-control', 'id' => null]
            ],
            [
                'label' => 'Qtr 3',
                'attribute' => 'yr1qtr3',
                'value'=> function($model)
                   {
                     return $model->yr1qtr3==0?'X':'✓';
                   },
               // 'filter' => ['0' => 'no', '1' => 'yes'],
               // 'filterInputOptions' => ['prompt' => 'All educations', 'class' => 'form-control', 'id' => null]
            ],
            [    
                'label' => 'Qtr 4',
                'attribute' => 'yr1qtr4',
                'value'=> function($model)
                   {
                     return $model->yr1qtr4==0?'X':'✓';
                   },
               // 'filter' => ['0' => 'no', '1' => 'yes'],
               // 'filterInputOptions' => ['prompt' => 'All educations', 'class' => 'form-control', 'id' => null]
            ],
            [
                'label' => 'Qtr 1',
                'attribute' => 'yr2qtr1',
                'value'=> function($model)
                   {
                     return $model->yr2qtr1==0?'X':'✓';
                   },
               // 'filter' => ['0' => 'no', '1' => 'yes'],
               // 'filterInputOptions' => ['prompt' => 'All educations', 'class' => 'form-control', 'id' => null]
            ],
            [
                'label' => 'Qtr 2',
                'attribute' => 'yr2qtr2',
                'value'=> function($model)
                   {
                     return $model->yr2qtr2==0?'X':'✓';
                   },
               // 'filter' => ['0' => 'no', '1' => 'yes'],
               // 'filterInputOptions' => ['prompt' => 'All educations', 'class' => 'form-control', 'id' => null]
            ],
            [
                'label' => 'Qtr 3',
                'attribute' => 'yr2qtr3',
                'value'=> function($model)
                   {
                     return $model->yr2qtr3==0?'X':'✓';
                   },
               // 'filter' => ['0' => 'no', '1' => 'yes'],
               // 'filterInputOptions' => ['prompt' => 'All educations', 'class' => 'form-control', 'id' => null]
            ],
            [
                'label' => 'Qtr 4',
                'attribute' => 'yr2qtr4',
                'value'=> function($model)
                   {
                     return $model->yr2qtr4==0?'X':'✓';
                   },
               // 'filter' => ['0' => 'no', '1' => 'yes'],
               // 'filterInputOptions' => ['prompt' => 'All educations', 'class' => 'form-control', 'id' => null]
            ],
            [
                'label' => 'Qtr 1',
                'attribute' => 'yr3qtr1',
                'value'=> function($model)
                   {
                     return $model->yr3qtr1==0?'X':'✓';
                   },
               // 'filter' => ['0' => 'no', '1' => 'yes'],
               // 'filterInputOptions' => ['prompt' => 'All educations', 'class' => 'form-control', 'id' => null]
            ],
            [
                'label' => 'Qtr 2',
                'attribute' => 'yr3qtr2',
                'value'=> function($model)
                   {
                     return $model->yr3qtr2==0?'X':'✓';
                   },
               // 'filter' => ['0' => 'no', '1' => 'yes'],
               // 'filterInputOptions' => ['prompt' => 'All educations', 'class' => 'form-control', 'id' => null]
            ],
            [
                'label' => 'Qtr 3',
                'attribute' => 'yr3qtr3',
                'value'=> function($model)
                   {
                     return $model->yr3qtr3==0?'X':'✓';
                   },
               // 'filter' => ['0' => 'no', '1' => 'yes'],
               // 'filterInputOptions' => ['prompt' => 'All educations', 'class' => 'form-control', 'id' => null]
            ],
            [
                'label' => 'Qtr 4',
                'attribute' => 'yr3qtr4',
                'value'=> function($model)
                   {
                     return $model->yr3qtr4==0?'X':'✓';
                   },
               // 'filter' => ['0' => 'no', '1' => 'yes'],
               // 'filterInputOptions' => ['prompt' => 'All educations', 'class' => 'form-control', 'id' => null]
            ],
            [
                'label' => 'Qtr 1',
                'attribute' => 'yr4qtr1',
                'value'=> function($model)
                   {
                     return $model->yr4qtr1==0?'X':'✓';
                   },
               // 'filter' => ['0' => 'no', '1' => 'yes'],
               // 'filterInputOptions' => ['prompt' => 'All educations', 'class' => 'form-control', 'id' => null]
            ],
            [
                'label' => 'Qtr 2',
                'attribute' => 'yr4qtr2',
                'value'=> function($model)
                   {
                     return $model->yr4qtr2==0?'X':'✓';
                   },
               // 'filter' => ['0' => 'no', '1' => 'yes'],
               // 'filterInputOptions' => ['prompt' => 'All educations', 'class' => 'form-control', 'id' => null]
            ],
            [
                'label' => 'Qtr 3',
                'attribute' => 'yr4qtr3',
                'value'=> function($model)
                   {
                     return $model->yr4qtr3==0?'X':'✓';
                   },
               // 'filter' => ['0' => 'no', '1' => 'yes'],
               // 'filterInputOptions' => ['prompt' => 'All educations', 'class' => 'form-control', 'id' => null]
            ],
            [
                'label' => 'Qtr 4',
                'attribute' => 'yr4qtr4',
                'value'=> function($model)
                   {
                     return $model->yr4qtr4==0?'X':'✓';
                   },
               // 'filter' => ['0' => 'no', '1' => 'yes'],
               // 'filterInputOptions' => ['prompt' => 'All educations', 'class' => 'form-control', 'id' => null]
            ],
            //'yr2qtr1',
            //'yr2qtr2',
            //'yr2qtr3',
            //'yr2qtr4',
            //'yr3qtr1',
            //'yr3qtr2',
            //'yr3qtr3',
            //'yr3qtr4',
            //'yr4qtr1',
            //'yr4qtr2',
            //'yr4qtr3',
            //'yr4qtr4',
            //'proposal_id',
            //'date_created',
            //'date_update',
            //'created_by',
            //'updated_by',

            ['class' => ActionColumn::className(),
            'options' => ['style' => 'width:130px;'],
            'template' => '{delete}',
            'buttons' => [
                'delete' => function ($url, $model) {
                  //  if (User::userIsAllowedTo('Remove camps')) {
                        return Html::a(
                                        '<span class="fa fa-trash"></span>', ['delete', 'id' => $model->id], [
                                    'title' => 'Remove camp',
                                    'data-toggle' => 'tooltip',
                                    'data-placement' => 'top',
                                    'data' => [
                                        'confirm' => 'Are you sure you want to this record?<br>',
                                        'method' => 'post',
                                    ],
                                    'style' => "padding:5px;",
                                    'class' => 'bt btn-lg'
                                        ]
                        );
                   // }
                },
            ]
        ],
        ],
    ]); ?>


</div>
