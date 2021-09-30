<?php

use kartik\editable\Editable;
use kartik\grid\EditableColumn;
use kartik\grid\GridView;
use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\grid\ActionColumn;
use backend\models\User;
use \kartik\popover\PopoverX;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use kartik\export\ExportMenu;
use kartik\money\MaskMoney;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use backend\models\AwpbActivityLine;
use backend\models\AwpbTemplate;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\CommodityPriceCollectionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'AWPB Indicators';
//$province_id = backend\models\Districts::findOne([Yii::$app->getUser()->identity->district_id])->province_id;
$this->params['breadcrumbs'][] = $this->title;

//$this->params['breadcrumbs'][] = \backend\models\Provinces::findOne($province_id)->name;
//$this->params['breadcrumbs'][] = \backend\models\Districts::findOne([Yii::$app->getUser()->identity->district_id])->name;
$months = [
    1 => "January", 2 => "February", 3 => "March", 4 => "April", 5 => "May", 6 => "June",
    7 => "July", 8 => "August", 9 => "September", 10 => "October", 11 => "November", 12 => "December"
];
$user = User::findOne(['id' => Yii::$app->user->id]);
$access_level=1;
?>
<div class="card card-success card-outline">
    <div class="card-body" style="overflow: auto;">
   <p>
           
            <?php
   
          
    if (User::userIsAllowedTo('Manage AWPB Indicator')&& $user->district_id>0 ||$user->district_id!='') {
       
        
$time = new \DateTime('now');
$today = $time->format('Y-m-d');
$template_model =  \backend\models\AwpbTemplate::find()->where(['status' =>\backend\models\AwpbTemplate::STATUS_PUBLISHED])->one();

  if(!empty($template_model))
            { 
if(strtotime($template_model->submission_deadline) >= strtotime($today)){
 
                echo Html::a('Add AWPB Indicator', ['create','template_id'=>$template_model->id], ['class' => 'btn btn-success btn-sm']);
                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
          
                // echo  $template_model->submission_deadline ;
                // echo "<br /><br /><br /><br />";
                // echo  $today;
        }}
    
            ?>

        </p>



        <?php
       $gridColumns = [
        [
            'class'=>'kartik\grid\SerialColumn',
            'contentOptions'=>['class'=>'kartik-sheet-style'],
            'width'=>'36px',
            'pageSummary'=>'Total',
            'pageSummaryOptions' => ['colspan' => 6],
            'header'=>'',
            'headerOptions'=>['class'=>'kartik-sheet-style']
        ],
        
        [
            'attribute' => 'output_id', 
            'vAlign' => 'middle',
            'width' => '150px',
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
  
        [
            'attribute' => 'activity_id',
            'label' => 'Activity Code', 
            'vAlign' => 'middle',
            'width' => '180px',

            'value' => function ($model) {
                $name =  \backend\models\AwpbActivity::findOne(['id' =>  $model->activity_id])->activity_code;
                return Html::a($name, ['awpb-activity/view', 'id' => $model->activity_id], ['class' => 'awbp-activity']);
            },
           
            'filterType' => GridView::FILTER_SELECT2,
            'filter' =>  \backend\models\AwpbActivity::getAwpbActivitiesList($access_level), 
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
                'options' => ['multiple' => true]
            ],
            'filterInputOptions' => ['placeholder' => 'Filter by activity'],
            'format' => 'raw'
        ],
        [
            'attribute' => 'indicator_id',
            'label' => 'Indicator', 
            'vAlign' => 'middle',
            'width' => '180px',

            'value' => function ($model) {
                $name =  \backend\models\AwpbIndicator::findOne(['id' =>  $model->indicator_id])->name;
                return Html::a($name, ['awpb-indicator/view', 'id' => $model->indicator_id], ['class' => 'awbp-indicator']);
            },
           
            'filterType' => GridView::FILTER_SELECT2,
            'filter' =>  \backend\models\AwpbIndicator::getIndicators(), 
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
                'options' => ['multiple' => true]
            ],
            'filterInputOptions' => ['placeholder' => 'Filter by indicator'],
            'format' => 'raw'
        ],
        // [
        //     'label' => 'Activity Name',
        //           'value' =>  function ($model) {
        //             $name =  \backend\models\AwpbActivity::findOne(['id' =>  $model->activity_id])->name;
        //             return $name;
                      
        //           }
        //       ],

            // [
            //     'class' => 'kartik\grid\EditableColumn',
            //     'label' => 'Commodity Description',
            //     'attribute' => 'name',
            //     'readonly' =>true,
            //     'editableOptions' => [
            //         'header' => 'Name', 
            //         'inputType' => \kartik\editable\Editable::INPUT_TEXT,
                    
            //     ],
            //     'hAlign' => 'left', 
            //     'vAlign' => 'left',
            //    // 'width' => '7%',
              
            // ],


            // [
            //     'class' => 'kartik\grid\EditableColumn',
            //     'attribute' => 'unit_cost',
            //     'readonly' =>true,
            //     'refreshGrid' => true,
            //     'editableOptions' => [
            //         'header' => 'Unit Cost', 
            //         'inputType' => \kartik\editable\Editable::INPUT_SPIN,
            //         'options' => [
            //             'pluginOptions' => ['min' => 0, 'max'=>999999999999999999999]
            //         ]
            //     ],
            //     'hAlign' => 'right', 
            //     'vAlign' => 'middle',
            //     'width' => '7%',
            //     'format' => ['decimal', 2],
            //     'pageSummary' => false
            // ],

            [
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'quarter_one_quantity', 
                'readonly' =>true,
                //='readonly' => function($model, $key, $index, $widget) {
                //    return (!$model->status); // do not allow editing of inactive records
               // },
               'filterType' =>false,
               'refreshGrid' => true,
                'editableOptions' => [
                    'header' => 'Q1 Qty', 
                    'inputType' => \kartik\editable\Editable::INPUT_SPIN,
                    'options' => [
                        'pluginOptions' => ['min' => 0, 'max'=>999999999999999999999]
                    ]
                ],
                'hAlign' => 'right', 
                'vAlign' => 'middle',
                'width' => '7%',
                'format' => ['decimal', 2],
                'pageSummary' => true
            ],
            [
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'quarter_two_quantity', 
                'readonly' =>true,
                //'readonly' => function($model, $key, $index, $widget) {
                //    return (!$model->status); // do not allow editing of inactive records
               // },
               'refreshGrid' => true,
                'editableOptions' => [
                    'header' => 'Q2 Qty', 
                    'inputType' => \kartik\editable\Editable::INPUT_SPIN,
                    'options' => [
                        'pluginOptions' => ['min' => 0, 'max'=>999999999999999999999]
                    ]
                ],
                'hAlign' => 'right', 
                'vAlign' => 'middle',
                'width' => '7%',
                'format' => ['decimal', 2],
                'pageSummary' => true
            ],
            [
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'quarter_three_quantity', 
                'readonly' =>true,
                //'readonly' => function($model, $key, $index, $widget) {
                //    return (!$model->status); // do not allow editing of inactive records
               // },
               'refreshGrid' => true,
                'editableOptions' => [
                    'header' => 'Q3 Qty', 
                    'inputType' => \kartik\editable\Editable::INPUT_SPIN,
                    'options' => [
                        'pluginOptions' => ['min' => 0, 'max'=>999999999999999999999]
                    ]
                ],
                'hAlign' => 'right', 
                'vAlign' => 'middle',
                'width' => '7%',
                'format' => ['decimal', 2],
                'pageSummary' => true
            ],
            [
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'quarter_four_quantity', 
                'readonly' =>true,
                //'readonly' => function($model, $key, $index, $widget) {
                //    return (!$model->status); // do not allow editing of inactive records
               // },
               'refreshGrid' => true,
                'editableOptions' => [
                    'header' => 'Q4 Qty', 
                    'inputType' => \kartik\editable\Editable::INPUT_SPIN,
                    'options' => [
                        'pluginOptions' => ['min' => 0, 'max'=>999999999999999999999]
                    ]
                ],
                'hAlign' => 'right', 
                'vAlign' => 'middle',
                'width' => '7%',
                'format' => ['decimal', 2],
                'pageSummary' => true
            ],
           
            


            // [
            //     'class' => 'kartik\grid\FormulaColumn', 
            //     'attribute' => 'total_quantity', 
            //     'header' => 'Total <br> Quantity', 
            //    // 'refreshGrid' => true,
            //     'vAlign' => 'middle',
            //     'value' => function ($model, $key, $index, $widget) { 
            //         $p = compact('model', 'key', 'index');
            //         return $widget->col(6, $p)+$widget->col(7, $p)+$widget->col(8, $p) + $widget->col(9, $p);
            //     },
            //     'headerOptions' => ['class' => 'kartik-sheet-style'],
            //     'hAlign' => 'right', 
            //     'width' => '7%',
            //     'format' => ['decimal', 2],
            //     'mergeHeader' => true,
            //     'pageSummary' => true,
            //     'footer' => true
            // ],
            // [
            //     'class' => 'kartik\grid\FormulaColumn', 
            //     'attribute' => 'total_amount', 
            //     'header' => 'Total <br> Amount', 
            //     'vAlign' => 'middle',
            //     'hAlign' => 'right', 
            //     'width' => '7%',
            //     'value' => function ($model, $key, $index, $widget) { 
            //         $p = compact('model', 'key', 'index');
            //         return $widget->col(10, $p) != 0 ? $widget->col(5, $p) * $widget->col(10, $p) : 0;
            //     },
            //     'format' => ['decimal', 2],
            //     'headerOptions' => ['class' => 'kartik-sheet-style'],
            //     'mergeHeader' => true,
            //     'pageSummary' => true,
            //     'pageSummaryFunc' => GridView::F_SUM,
            //     'footer' => true
            // ],
            // // //'id',
            // [
            //     'class' => 'kartik\grid\CheckboxColumn',
            //     'headerOptions' => ['class' => 'kartik-sheet-style'],
            //     'pageSummary' => '<small>(amounts in $)</small>',
            //     'pageSummaryOptions' => ['colspan' => 3, 'data-colspan-dir' => 'rtl']
            // ],

     
                    ['class' => 'yii\grid\ActionColumn',
                    'options' => ['style' => 'width:150px;'],
                    'template' => '{view}{update}{delete}',
                    'buttons' => [
                        'view' => function ($url, $model) {
                            if ( $model->status == AwpbTemplate::STATUS_DRAFT && User::userIsAllowedTo('View AWPB Indicator')||User::userIsAllowedTo('Manage AWPB Indicator') ) {
                                return Html::a(
                                                '<span class="fa fa-eye"></span>', ['view', 'id' => $model->id], [
                                            'title' => 'View AWPB Indicator',
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
                            if ($model->status == AwpbTemplate::STATUS_DRAFT && User::userIsAllowedTo('Manage AWPB Indicator') ) {
                                return Html::a(
                                                '<span class="fas fa-edit"></span>', ['update', 'id' => $model->id], [
                                            'title' => 'Update AWPB Indicator',
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
                            if ($model->status == AwpbTemplate::STATUS_DRAFT && User::userIsAllowedTo('Manage AWPB Indicator') ) {
                                return Html::a(
                                                '<span class="fa fa-trash"></span>', ['delete', 'id' => $model->id], [
                                            'title' => 'delete component',
                                            'data-toggle' => 'tooltip',
                                            'data-placement' => 'top',
                                            'data' => [
                                                'confirm' => 'Are you sure you want to delete this AWPB Indicator?',
                                                'method' => 'post',
                                            ],
                                            'style' => "padding:5px;",
                                            'class' => 'bt btn-lg'
                                                ]
                                );
                            }
                        },
                    ]
                ],



            ];



        if ($dataProvider->getCount() > 0) {
   
          // echo ' </p>';
            echo ExportMenu::widget([
                'dataProvider' => $dataProvider,
                'columns' => $gridColumns,
                'fontAwesome' => true,
                'dropdownOptions' => [
                    'label' => 'Export All',
                    'class' => 'btn btn-default'
                ],
                'filename' => 'AWPB Activity Lines' . date("YmdHis")
            ]);
                 //   echo '<p>';
                //  if (User::userIsAllowedTo('Submit District AWPB')&& $user->district_id>0 ||$user->district_id!='') {
                //     //   echo Html::a('&nbsp;');
                //      // btn btn-outline-primary btn-space
                //            echo Html::a('Submit District AWPB', ['approve'], ['class' => 'btn btn-success btn-sm btn-space']);         
                //    }
                //    if (User::userIsAllowedTo('Submit Provincial AWPB')&& $user->province_id>0 ||$user->province_id!=''&& $user->district_id<0 ||$user->district_id=='') {
                //     //   echo Html::a('&nbsp;');
                //      // btn btn-outline-primary btn-space
                //            echo Html::a('Submit Provincial AWPB', ['approve'], ['class' => 'btn btn-success btn-sm btn-space']);         
                //    }
        }
        ?>
      

    <?=  GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumns,
      
        'pjax' => true,
        //'bordered' => true,
       // 'striped' => false,
      // 'condensed' => false,
       'responsive' => true,
      //  'hover' => true,
       // 'floatHeader' => true,
       // 'floatHeaderOptions' => ['top' => $scrollingTop],
        'showPageSummary' => true,
        // 'panel' => [
        //     'type' => GridView::TYPE_PRIMARY
        // ],




]);
        
 ?>

<div class="row">
		<div class="col-md-12">
      <?php
        if(!empty($template_model))
        { 
if(strtotime($template_model->submission_deadline) >= strtotime($today)){

      echo Html::a('Submit District AWPB', ['submit','id'=>$id,'id2'=>$user->district_id, 'status'=>AWPBActivityLine:: STATUS_SUBMITTED], ['class' => 'float-right btn btn-success btn-sm btn-space']);   
}}  
    }
     ?>
       </div>
</div>
    </div>
</div>
<?php
$this->registerCss('.popover-x {display:none}');
?>