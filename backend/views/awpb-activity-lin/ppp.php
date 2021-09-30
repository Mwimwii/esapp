<?php

use yii\helpers\Html;

use borales\extensions\phoneInput\PhoneInput;
use kartik\form\ActiveForm;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use kartik\money\MaskMoney;
use yii\widgets\MaskedInput;
use kartik\detail\DetailView;


/* @var $this yii\web\View */
/* @var $model backend\models\AwpbActivityLine */

//$this->title = $model->id;
$this->title = 'AWPB Activity line : '. $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Awpb Activity Lines', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);


$act="";
$fis="";
$activity = \backend\models\AwpbActivity::findOne(['id' => $model->activity_id]);
    
if (!empty($activity)) {
    $act=  $activity->name;
    $fis=$activity->awpb_template_id;

    }

$tem="";
$template= \backend\models\AWPBTemplate::findOne(['id' => $model->awpb_template_id]);
	
if (!empty($template)) {
    $tem=  $template->fiscal_year;
    }

$dist="";
$district = \backend\models\Districts::findOne(['id' => $model->district_id]);
	
if (!empty($district))
{
    $dist=  $district->name;
    }
    $pro="";
    $province = \backend\models\Provinces::findOne(['id' => $model->province_id]);
	
if (!empty($province)) {
    $pro=  $province->name;
    }

?>

<div class="card card-success card-outline">
    <div class="card-body">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    
            <?php

             echo Html::a('<span class="fas fa-arrow-left fa-2x"></span>', ['index', 'id' => $model->id], [
                'title' => 'back',
                'data-toggle' => 'tooltip',
                'data-placement' => 'top',
            ]);
            
            if (User::userIsAllowedTo('Submit Provincial AWPB') ) 
            {          echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                echo Html::a('Decline District AWPB',   ['decline', 'id' => $model->id], 
                ['class' => 'float-right btn btn-success btn-sm btn-space']);       
            }

            $gridColumns = [
                [
                    'class'=>'kartik\grid\SerialColumn',
                    'contentOptions'=>['class'=>'kartik-sheet-style'],
                    'width'=>'36px',
                    'pageSummary'=>'Total',
                    'pageSummaryOptions' => ['colspan' => 2],
                    'header'=>'',
                    'headerOptions'=>['class'=>'kartik-sheet-style']
                ],
               // [
                //     'attribute' => 'district_id',
                //     'format' => 'raw',
                //     'label' => 'District',
                //     'value' => function ($model) {
                //         return !empty($model->district_id) && $model->district_id > 0 ? Html::a($name, ['awpb-activity-line/index', 'id' => $model->district_id], ['class' => 'awbp-activity-line']): "";
                //     },
                //     'visible' => !empty($model->district_id) && $model->district_id > 0 ? TRUE : FALSE,
                // ],
             
                // [
                //     'attribute' => 'awpb_template_id',
                //     'label' => 'Fiscal Year', 
                //     'vAlign' => 'middle',
                //     'width' => '180px',
        
                //     'value' => function ($model) {
                //         $name =  \backend\models\AwpbTemplate::findOne(['id' =>  $model->awpb_template_id])->fiscal_year;
                //         return Html::a($name, ['awpb-template/view', 'id' => $model->awpb_template_id], ['class' => 'awbp-template']);
                //     },
                   
                //     'filterType' => GridView::FILTER_SELECT2,
                //     'filter' =>  \backend\models\AwpbActivity::getAwpbActivitiesList($access_level), 
                //     'filterWidgetOptions' => [
                //         'pluginOptions' => ['allowClear' => true],
                //         'options' => ['multiple' => true]
                //     ],
                //     'filterInputOptions' => ['placeholder' => 'Filter by activity'],
                //     'format' => 'raw'
                // ],
                
         
                 [
                    'attribute' => 'activity_id',
                    'label' => 'Activity Code', 
                    'vAlign' => 'middle',
                    'width' => '180px',
        
                    'value' => function ($model) {
                        $name =  \backend\models\AwpbActivity::findOne(['id' =>  $model->activity_id])->activity_code;
                        return Html::a($name, ['awpb-activity-line/mpca', 'id' => $model->activity_id], ['class' => 'awbp-activity-line']);
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
                    'label' => 'Activity Name',
                          'value' =>  function ($model) {
                            $name =  \backend\models\AwpbActivity::findOne(['id' =>  $model->activity_id])->name;
                           return $name;//Html::a($name, ['awpb-activity-line/mpcd', 'id' => $model->activity_id], ['class' => 'awbp-activity-line']);
          
                              
                          }
                      ],
                    [
                        'class' => 'kartik\grid\EditableColumn',
                        'attribute' => 'quarter_one_amount', 
                        'readonly' =>true,
                        //='readonly' => function($model, $key, $index, $widget) {
                        //    return (!$model->status); // do not allow editing of inactive records
                       // },
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
                        'attribute' => 'quarter_two_amount', 
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
                        'attribute' => 'quarter_three_amount', 
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
                        'attribute' => 'quarter_four_amount', 
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
                     
                    //     'headerOptions' => ['class' => 'kartik-sheet-style'],
                    //     'hAlign' => 'right', 
                    //     'width' => '7%',
                    //     'format' => ['decimal', 2],
                    //     'mergeHeader' => true,
                    //     'pageSummary' => true,
                    //     'footer' => true
                    // ],
                    [
                        'class' => 'kartik\grid\FormulaColumn', 
                        'attribute' => 'total_amount', 
                        'header' => 'Total <br> Amount', 
                        'vAlign' => 'middle',
                        'hAlign' => 'right', 
                        'width' => '7%',
                     
                        'format' => ['decimal', 2],
                        'headerOptions' => ['class' => 'kartik-sheet-style'],
                        'mergeHeader' => true,
                        'pageSummary' => true,
                        'pageSummaryFunc' => GridView::F_SUM,
                        'footer' => true
                    ],
                    // //'id',
                    // [
                    //     'class' => 'kartik\grid\CheckboxColumn',
                    //     'headerOptions' => ['class' => 'kartik-sheet-style'],
                    //     'pageSummary' => '<small>(amounts in $)</small>',
                    //     'pageSummaryOptions' => ['colspan' => 3, 'data-colspan-dir' => 'rtl']
                    // ],
        
                    // [
                    //     'class' => 'kartik\grid\ActionColumn',
                    //     'dropdown' => false,
                    //     'vAlign'=>'middle',
                    //     'template' => '{delete} {view}',
                    //     'urlCreator' => function($action, $model, $key, $index) { 
                    //             return Url::to([$action,'id'=>$key]);
                    //     },
                          
                      
                    // ],
        
        
        
                    ];
        
        
        
                //if ($dataProvider->getCount() > 0) {
           
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
            //    }
                ?>
              
        
            <?=  GridView::widget([
                'dataProvider' => $dataProvider,
              //  'filterModel' => $searchModel,
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


</div>
