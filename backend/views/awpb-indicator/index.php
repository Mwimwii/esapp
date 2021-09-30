<<<<<<< HEAD
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







</div>


=======
<?php

use yii\helpers\Html;
use kartik\grid\EditableColumn;
use kartik\grid\GridView;;
use kartik\editable\Editable;
use backend\models\User;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AwpbIndicatorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Programme Indicators';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card card-success card-outline">
    <div class="card-body">
    <h1><?= Html::encode($this->title) ?></h1>
        <p>
            <?php
           if (User::userIsAllowedTo("Setup AWPB") ) {
               echo Html::a('<i class="fa fa-plus"></i> Add AWPB Indicator', ['create'], ['class' => 'btn btn-success btn-sm']);
            }
            ?>
        </p>
        <hr class="dotted short">


<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
           
[
            'class'=>'kartik\grid\SerialColumn',
            'contentOptions'=>['class'=>'kartik-sheet-style'],
            'width'=>'36px',
           // 'pageSummary'=>'Total',
           // 'pageSummaryOptions' => ['colspan' => 2],
          //  'header'=>'',
          //  'headerOptions'=>['class'=>'kartik-sheet-style']
        ],
            
            
            
            [
                'attribute' => 'component_id', 
                'vAlign' => 'middle',
                'width' => '100px',
                'value' => function ($model, $key, $index, $widget) {
                    $component= \backend\models\AwpbComponent::findOne(['id' => $model->component_id]);						
                
                return     !empty( $component) ? Html::a( $component->code, ['awpb-component/view', 'id' => $model->component_id], ['class' => 'awbp-component']):"";
               
                },
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(backend\models\AwpbComponent::find()->orderBy('name')->asArray()->all(), 'id', 'code'), 
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                    'options' => ['multiple' => true]
                ],
                'filterInputOptions' => ['placeholder' => 'Filter by code'],
                'format' => 'raw'
            ], 

            [
                'attribute' => 'output_id', 
                'vAlign' => 'middle',
                //'width' => '350px',
                'value' => function ($model, $key, $index, $widget) {
                    $outcome= \backend\models\AwpbOutput::findOne(['id' => $model->output_id]);						
                
                return     !empty( $outcome) ? Html::a( $outcome->name, ['awpb-output/view', 'id' => $model->output_id], ['class' => 'awbp-output']):"";
               
                },
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(backend\models\AwpbOutput::find()->orderBy('name')->asArray()->all(), 'id', 'name'), 
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                    'options' => ['multiple' => true]
                ],
                'filterInputOptions' => ['placeholder' => 'Filter by name'],
                'format' => 'raw'
            ], 
         

//            [
//                'attribute' => 'activity_id', 
//                
//                
//                'vAlign' => 'middle',
//                'width' => '350px',
//                'value' => function ($model, $key, $index, $widget) {
//                    $activity= \backend\models\AWPBActivity::findOne(['id' => $model->activity_id]);						
//                
//                return     !empty( $activity) ? Html::a( $activity->activity_code.' '.$activity->name, ['awpb-activity/view', 'id' => $model->activity_id], ['class' => 'awbp-activity']):"";
//               
//                },
//                'filterType' => GridView::FILTER_SELECT2,
//                'filter' => ArrayHelper::map(backend\models\AwpbActivity::find()->orderBy('name')->asArray()->all(), 'id', 'name'), 
//                'filterWidgetOptions' => [
//                    'pluginOptions' => ['allowClear' => true],
//                    'options' => ['multiple' => true]
//                ],
//                'filterInputOptions' => ['placeholder' => 'Filter by name'],
//                'format' => 'raw'
//            ], 
       
            [
                'attribute' => 'name', 
            'filter'=>false,
            'vAlign' => 'middle',
           // 'width' => '450px',
            ],
//            [
//                'attribute' => 'description', 
//            'filter'=>false,
//            'vAlign' => 'middle',
//            'width' => '750px',
//            ],
            //'created_at',
            //'updated_at',
            //'created_by',
            //'updated_by',
    [
                'class' => 'kartik\grid\ActionColumn',
                'vAlign'=>'middle',
                                     'width' => '11%',
            'template' => '{view}{update}{delete}',
           
'buttons' => [
    'view' => function ($url, $model) {
        if (User::userIsAllowedTo('View AWPB') ) {
            return Html::a(
                            '<span class="fa fa-eye"></span>', ['view', 'id' => $model->id], [
                        'title' => 'View indicator',
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
                        'title' => 'Update indicator',
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
                        'title' => 'delete indicator',
                        'data-toggle' => 'tooltip',
                        'data-placement' => 'top',
                        'data' => [
                            'confirm' => 'Are you sure you want to remove this indicator?',
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

</div>





</div>


>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
