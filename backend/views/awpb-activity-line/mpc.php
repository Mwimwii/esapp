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
/* @var $this yii\web\View */
/* @var $searchModel backend\models\CommodityPriceCollectionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'AWPB Activity Lines';
//$province_id = backend\models\Districts::findOne([Yii::$app->getUser()->identity->district_id])->province_id;
$this->params['breadcrumbs'][] = $this->title;
$dist="";
$acti="";
$comm="";
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
    <div class="row">
           
            <?php

            if (User::userIsAllowedTo('Manage province consolidated AWPB')&&User::userIsAllowedTo('Submit Provincial AWPB')&& $user->province_id>0 ||$user->province_id!=''&& $user->district_id==0 ||$user->district_id=='') {
            //   echo Html::a('&nbsp;');
                // btn btn-outline-primary btn-space
                echo'   <div class="col-12 col-sm-6 col-md-2">
            </div> 
            <div class="col-12 col-sm-6 col-md-2">
            </div>
            <div class="col-12 col-sm-6 col-md-2">
            </div>
            <div class="col-12 col-sm-6 col-md-2">
            </div>
            <div class="col-12 col-sm-6 col-md-2">
            </div>
            <div class="col-12 col-sm-6 col-md-1">';
                    echo Html::a('Add AWPB activity line', ['create'], ['class' => 'float-right btn btn-success btn-sm']);
                    echo '</div>
            <div class="col-12 col-sm-6 col-md-1">';
                    echo Html::a('Submit Provincial AWPB', ['approve'], ['class' => 'btn btn-success btn-sm btn-space']);  
                    echo ' </div>';            
            }
           

            ?>
       </div>
            <!-- </div> -->
        </p>






        <?php

        
        
if($user->district_id>0 ||$user->district_id!='') {

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
      'attribute' => 'district_id', 
      'width' => '310px',
      'value' => function ($model, $key, $index, $widget) { 
          return !empty($model->district_id) && $model->district_id > 0 ? backend\models\Districts::findOne($model->district_id)->name:"";
                       
      },
      'filterType' => GridView::FILTER_SELECT2,
   'filter' => ArrayHelper::map(backend\models\Districts::find()->orderBy('name')->asArray()->all(), 'id', 'name'), 
      'filterWidgetOptions' => [
          'pluginOptions' => ['allowClear' => true],
      ],
      'filterInputOptions' => ['placeholder' => 'Any district'],
      'group' => true,  // enable grouping
     // 'subGroupOf' => 1 // supplier column index is the parent group
  ],

  [
      'attribute' => 'activity_id', 
      'width' => '250px',
      'value' => function ($model, $key, $index, $widget) { 
          return !empty($model->activity_id) && $model->activity_id > 0 ? backend\models\AwpbActivity::findOne($model->activity_id)->activity_code:"";                  
      },
      'filterType' => GridView::FILTER_SELECT2,
      'filter' => ArrayHelper::map(backend\models\AwpbActivity::find()->orderBy('activity_code')->asArray()->all(), 'id', 'activity_code'), 
      'filterWidgetOptions' => [
          'pluginOptions' => ['allowClear' => true],
      ],
      'filterInputOptions' => ['placeholder' => 'Any activity'],
      'group' => true,  // enable grouping
      'subGroupOf' => 2  // supplier column index is the parent group

  ],

  [
      'attribute' => 'unit_of_measure_id', 
      'width' => '250px',
      'value' => function ($model, $key, $index, $widget) { 
          return !empty($model->unit_of_measure_id) && $model->unit_of_measure_id > 0 ? backend\models\AwpbUnitOfMeasure::findOne($model->unit_of_measure_id)->name:"";      
      },
      'filterType' => GridView::FILTER_SELECT2,
      'filter' => ArrayHelper::map(backend\models\AwpbUnitOfMeasure::find()->orderBy('name')->asArray()->all(), 'id', 'name'),  
      'filterWidgetOptions' => [
          'pluginOptions' => ['allowClear' => true],
      ],
      'filterInputOptions' => ['placeholder' => 'Any unit of measure'],
      'group' => true,  // enable grouping
    //  'subGroupOf' =>  // supplier column index is the parent group
  ],

  [
      'attribute' => 'unit_cost',
      'width' => '150px',
      'hAlign' => 'right',
      'format' => ['decimal', 2],
      'pageSummary' => true,
      //'pageSummaryFunc' => GridView::F_AVG
  ],
  [
      'attribute' => 'quarter_one_quantity',
      'width' => '150px',
      'hAlign' => 'right',
      'format' => ['decimal',2],
      'pageSummary' => true
  ],
  [
      'attribute' => 'quarter_two_quantity',
      'width' => '150px',
      'hAlign' => 'right',
      'format' => ['decimal', 2],
      'pageSummary' => true
  ],
  [
      'attribute' => 'quarter_three_quantity',
      'width' => '150px',
      'hAlign' => 'right',
      'format' => ['decimal', 2],
      'pageSummary' => true
  ],
  [
      'attribute' => 'quarter_four_quantity',
      'width' => '150px',
      'hAlign' => 'right',
      'format' => ['decimal', 2],
      'pageSummary' => true
  ],
  [
      'class' => 'kartik\grid\FormulaColumn',
      'header' => 'Total <br> Quantity',
      'value' => function ($model, $key, $index, $widget) { 
          $p = compact('model', 'key', 'index');
          return $widget->col(6, $p)+$widget->col(6, $p)+$widget->col(7, $p) + $widget->col(8, $p);
      },
      'mergeHeader' => true,
      'width' => '150px',
      'hAlign' => 'right',
      'format' => ['decimal', 2],
      'pageSummary' => true
  ],
  [
      'class' => 'kartik\grid\FormulaColumn',
      'header' => 'Total <br> Amount',
      'value' => function ($model, $key, $index, $widget) { 
          $p = compact('model', 'key', 'index');
      return $widget->col(10, $p) != 0 ? $widget->col(5, $p) * $widget->col(10, $p) : 0;
      },
      'mergeHeader' => true,
      'width' => '150px',
      'hAlign' => 'right',
      'format' => ['decimal', 2],
      'pageSummary' => true
  ],
  [
    'class' => 'kartik\grid\ActionColumn',
    'dropdown' => false,
    'vAlign'=>'middle',
    'template' => '{delete} {view}',
    'urlCreator' => function($action, $model, $key, $index) { 
            return Url::to([$action,'id'=>$key]);
    },
      
  
],

];

        }
if($user->province_id>0 ||$user->province_id!=''&& $user->district_id<0 ||$user->district_id=='') {

   
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
    
//   [
//       'attribute' => 'province_id', 
//       'width' => '310px',
//       'value' => function ($model, $key, $index, $widget) { 
//           return !empty($model->province_id) && $model->province_id > 0 ? backend\models\Provinces::findOne($model->province_id)->name:"";
        
//       },
//       'filterType' => GridView::FILTER_SELECT2,
//       'filter' => ArrayHelper::map(backend\models\Provinces::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
//       'filterWidgetOptions' => [
//           'pluginOptions' => ['allowClear' => true],
//       ],
//       'filterInputOptions' => ['placeholder' => 'Any province'],
//       'group' => true,  // enable grouping
//   ],

  [
      'attribute' => 'district_id', 
      'width' => '150px',
      'value' => function ($model, $key, $index, $widget) { 
          return !empty($model->district_id) && $model->district_id > 0 ? backend\models\Districts::findOne($model->district_id)->name:"";
                       
      },
      'filterType' => GridView::FILTER_SELECT2,
   'filter' => ArrayHelper::map(backend\models\Districts::find()->orderBy('name')->asArray()->all(), 'id', 'name'), 
      'filterWidgetOptions' => [
          'pluginOptions' => ['allowClear' => true],
      ],
      'filterInputOptions' => ['placeholder' => 'Any district'],
      'group' => true,  // enable grouping
     // 'subGroupOf' => 1 // supplier column index is the parent group
  ],

 

  [
      'attribute' => 'activity_id', 
      'width' => '100px',
      'value' => function ($model, $key, $index, $widget) { 
          return !empty($model->activity_id) && $model->activity_id > 0 ? backend\models\AwpbActivity::findOne($model->activity_id)->activity_code:"";                  
      },
      'filterType' => GridView::FILTER_SELECT2,
      'filter' => ArrayHelper::map(backend\models\AwpbActivity::find()->orderBy('activity_code')->asArray()->all(), 'id', 'activity_code'), 
      'filterWidgetOptions' => [
          'pluginOptions' => ['allowClear' => true],
      ],
      'filterInputOptions' => ['placeholder' => 'Any activity'],
      'group' => true,  // enable grouping
      'subGroupOf' => 1  // supplier column index is the parent group

  ],
  [
    'attribute' => 'name',
    'pageSummary' => 'Page Summary',
    'pageSummaryOptions' => ['class' => 'text-right'],
],

  [
      'attribute' => 'unit_of_measure_id', 
      'width' => '100px',
      'value' => function ($model, $key, $index, $widget) { 
          return !empty($model->unit_of_measure_id) && $model->unit_of_measure_id > 0 ? backend\models\AwpbUnitOfMeasure::findOne($model->unit_of_measure_id)->name:"";      
      },
      'filterType' => GridView::FILTER_SELECT2,
      'filter' => ArrayHelper::map(backend\models\AwpbUnitOfMeasure::find()->orderBy('name')->asArray()->all(), 'id', 'name'),  
      'filterWidgetOptions' => [
          'pluginOptions' => ['allowClear' => true],
      ],
      'filterInputOptions' => ['placeholder' => 'Any unit of measure'],
      'group' => true,  // enable grouping
    //  'subGroupOf' =>  // supplier column index is the parent group
  ],

  [
      'attribute' => 'unit_cost',
      'width' => '150px',
      'hAlign' => 'right',
      'format' => ['decimal', 2],
      'pageSummary' => true,
      //'pageSummaryFunc' => GridView::F_AVG
  ],
  [
      'attribute' => 'quarter_one_quantity',
      'width' => '150px',
      'hAlign' => 'right',
      'format' => ['decimal',2],
      'pageSummary' => true
  ],
  [
      'attribute' => 'quarter_two_quantity',
      'width' => '150px',
      'hAlign' => 'right',
      'format' => ['decimal', 2],
      'pageSummary' => true
  ],
  [
      'attribute' => 'quarter_three_quantity',
      'width' => '150px',
      'hAlign' => 'right',
      'format' => ['decimal', 2],
      'pageSummary' => true
  ],
  [
      'attribute' => 'quarter_four_quantity',
      'width' => '150px',
      'hAlign' => 'right',
      'format' => ['decimal', 2],
      'pageSummary' => true
  ],
  [
      'class' => 'kartik\grid\FormulaColumn',
      'header' => 'Total <br> Quantity',
      'value' => function ($model, $key, $index, $widget) { 
          $p = compact('model', 'key', 'index');
          return $widget->col(6, $p)+$widget->col(6, $p)+$widget->col(7, $p) + $widget->col(8, $p);
      },
      'mergeHeader' => true,
      'width' => '150px',
      'hAlign' => 'right',
      'format' => ['decimal', 2],
      'pageSummary' => true
  ],
  [
      'class' => 'kartik\grid\FormulaColumn',
      'header' => 'Total <br> Amount',
      'value' => function ($model, $key, $index, $widget) { 
          $p = compact('model', 'key', 'index');
      return $widget->col(10, $p) != 0 ? $widget->col(5, $p) * $widget->col(10, $p) : 0;
      },
      'mergeHeader' => true,
      'width' => '150px',
      'hAlign' => 'right',
      'format' => ['decimal', 2],
      'pageSummary' => true
  ],
  [
    'class' => 'kartik\grid\ActionColumn',
    'dropdown' => false,
    'vAlign'=>'middle',
    'template' => '{delete} {view}',
    'urlCreator' => function($action, $model, $key, $index) { 
            return Url::to([$action,'id'=>$key]);
    },
      
  
],

];



 } 
if($user->province_id<0 ||$user->province_id=='')
 {

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
                    'class' => EditableColumn::className(),
                    'attribute' => 'activity_id',
                    //'readonly' => false,
                    'refreshGrid' => true,
                    'filterType' => GridView::FILTER_SELECT2,
                    'filterWidgetOptions' => [
                        'pluginOptions' => ['allowClear' => true],
                    ],
                    'filter' => \backend\models\AwpbActivity::getAwpbActivitiesList($access_level),
                    'filterInputOptions' => ['prompt' => 'Filter by Activity', 'class' => 'form-control', 'id' => null],
                    'editableOptions' => [
                        'asPopover' => true,
                        'type' => 'success',
                        'size' => PopoverX::SIZE_MEDIUM,
                        'options' => ['data' => \backend\models\AwpbActivity::getAwpbActivitiesList($access_level)],
                        'inputType' => Editable::INPUT_SELECT2,
                    ],
                    'value' => function ($model) {
                        $name = backend\models\AwpbActivity::findOne($model->activity_id)->activity_code;
                        return $name;
                    },
                    ],
         
                    [
                        'label' => 'Activity Name',
                              'value' =>  function ($model) {
                                $name = backend\models\AwpbActivity::findOne($model->activity_id)->name;
                                return $name;
                                  
                              }
                          ],
        
   
                          [
                            'class' => 'kartik\grid\EditableColumn',
                            'attribute' => 'name',
                            
                            'editableOptions' => [
                                'header' => 'Name', 
                                'inputType' => \kartik\editable\Editable::INPUT_TEXT,
                                
                            ],
                            'hAlign' => 'left', 
                            'vAlign' => 'left',
                           // 'width' => '7%',
                          
                        ],
                          [
                            'class' => EditableColumn::className(),
                            'attribute' => 'unit_of_measure_id',
                            //'readonly' => false,
                            'refreshGrid' => true,
                            'filterType' => GridView::FILTER_SELECT2,
                            'filterWidgetOptions' => [
                                'pluginOptions' => ['allowClear' => true],
                            ],
                            'filter' => \backend\models\AwpbUnitOfMeasure::getAwpbUnitOfMeasuresList(),
                            'filterInputOptions' => ['prompt' => 'Filter by Commodity Type', 'class' => 'form-control', 'id' => null],
                            'editableOptions' => [
                                'asPopover' => true,
                                'type' => 'success',
                                'size' => PopoverX::SIZE_MEDIUM,
                                'options' => ['data' => \backend\models\AwpbUnitOfMeasure::getAwpbUnitOfMeasuresList()],
                                'inputType' => Editable::INPUT_SELECT2,
                            ],
                            'value' => function ($model) {
                                $name = backend\models\AwpbUnitOfMeasure::findOne($model->unit_of_measure_id)->name;
                                return $name;
                            },
                            ],
                 


     
        



        [
            'class' => 'kartik\grid\EditableColumn',
            'attribute' => 'unit_cost',
            'refreshGrid' => true,
            'editableOptions' => [
                'header' => 'Unit Cost', 
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
            'attribute' => 'quarter_one_quantity', 
            //'readonly' => function($model, $key, $index, $widget) {
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
            'attribute' => 'quarter_two_quantity', 
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
       
        


        [
            'class' => 'kartik\grid\FormulaColumn', 
            'attribute' => 'total_quantity', 
            'header' => 'Total <br> Quantity', 
           // 'refreshGrid' => true,
            'vAlign' => 'middle',
            'value' => function ($model, $key, $index, $widget) { 
                $p = compact('model', 'key', 'index');
                return $widget->col(6, $p)+$widget->col(7, $p)+$widget->col(8, $p) + $widget->col(9, $p);
            },
            'headerOptions' => ['class' => 'kartik-sheet-style'],
            'hAlign' => 'right', 
            'width' => '7%',
            'format' => ['decimal', 2],
            'mergeHeader' => true,
            'pageSummary' => true,
            'footer' => true
        ],
        [
            'class' => 'kartik\grid\FormulaColumn', 
            'attribute' => 'total_amount', 
            'header' => 'Total <br> Amount', 
            'vAlign' => 'middle',
            'hAlign' => 'right', 
            'width' => '7%',
            'value' => function ($model, $key, $index, $widget) { 
                $p = compact('model', 'key', 'index');
                return $widget->col(10, $p) != 0 ? $widget->col(5, $p) * $widget->col(10, $p) : 0;
            },
            'format' => ['decimal', 2],
            'headerOptions' => ['class' => 'kartik-sheet-style'],
            'mergeHeader' => true,
            'pageSummary' => true,
            'pageSummaryFunc' => GridView::F_SUM,
            'footer' => true
        ],
        [
            'class' => 'kartik\grid\ActionColumn',
            'dropdown' => false,
            'vAlign'=>'middle',
            'template' => '{delete} {view}',
            'urlCreator' => function($action, $model, $key, $index) { 
                    return Url::to([$action,'id'=>$key]);
            },
              
          
        ],
        ];



                // $gridColumns = [
                //     ['class' => 'kartik\grid\SerialColumn'],
                //     [
                //         'attribute' => 'province_id', 
                //         'width' => '310px',
                //         'value' => function ($model, $key, $index, $widget) { 
          
                //                return !empty($model->province_id) && $model->province_id > 0 ? backend\models\Provinces::findOne($model->province_id)->name:"";
                             
                          
                //         },
                //         // 'filterType' => GridView::FILTER_SELECT2,
                //         // 'filter' => ArrayHelper::map(backend\models\Provinces::find()->where(['id'=>$user->province_id])->orderBy('name')->asArray()->all(), 'id', 'name'), 
                //         // 'filterWidgetOptions' => [
                //         //     'pluginOptions' => ['allowClear' => true],
                //         // ],
                //         // 'filterInputOptions' => ['placeholder' => 'Any supplier'],
                //         'group' => true,  // enable grouping
                //         'groupFooter' => function ($model, $key, $index, $widget) { // Closure method
                //             return [
                //               //  'mergeColumns' => [[1,3]], // columns to merge in summary
                //                 'content' => [             // content to show in each summary cell
                //                     1 => 'Summary (' . $model->province_id . ')',
                //                     5 => GridView::F_SUM,
                //                     6 => GridView::F_SUM,
                //                     7 => GridView::F_SUM,
                //                     8 => GridView::F_SUM,
                //                     9 => GridView::F_SUM,
                //                     10 => GridView::F_SUM,
                //                 ],
                //                 'contentFormats' => [      // content reformatting for each summary cell
                //                     5 => ['format' => 'number', 'decimals' => 2],
                //                     6 => ['format' => 'number', 'decimals' => 2],
                //                     7 => ['format' => 'number', 'decimals' => 2],
                //                     8 => ['format' => 'number', 'decimals' => 2],
                //                     9 => ['format' => 'number', 'decimals' => 2],
                //                     10 => ['format' => 'number', 'decimals' => 2],
                //                 ],
                //                 'contentOptions' => [      // content html attributes for each summary cell
                //                     5 => ['style' => 'text-align:right'],
                //                     6 => ['style' => 'text-align:right'],
                //                     7 => ['style' => 'text-align:right'],
                //                     8 => ['style' => 'text-align:right'],
                //                     9 => ['style' => 'text-align:right'],
                //                     10 => ['style' => 'text-align:right'],
                //                 ],
                //                 // html attributes for group summary row
                //                 'options' => ['class' => 'info table-info','style' => 'font-weight:bold;']
                //             ];
                //         }
                //     ],
                  
                //     [
                //         'attribute' => 'activity_id', 
                //         'width' => '250px',
                //         'value' => function ($model, $key, $index, $widget) { 
                //             return !empty($model->activity_id) && $model->activity_id > 0 ? backend\models\AwpbActivity::findOne($model->activity_id)->activity_code:"";                  
                //         },
                //         'filterType' => GridView::FILTER_SELECT2,
                //         'filter' => ArrayHelper::map(backend\models\AwpbActivity::find()->orderBy('activity_code')->asArray()->all(), 'id', 'name'), 
                //         'filterWidgetOptions' => [
                //             'pluginOptions' => ['allowClear' => true],
                //         ],
                //         'filterInputOptions' => ['placeholder' => 'Any activity'],
                     
                //     ],
                //     [
                //         'attribute' => 'commodity_type_id',
                //         'width' => '150px',
                //         'value' => function ($model, $key, $index, $widget) { 
                //             return !empty($model->commodity_type_id) && $model->commodity_type_id > 0 ? backend\models\CommodityTypes::findOne($model->commodity_type_id)->name:"";      
                //      },
                //         'pageSummary' => true
                //     ],
                //     [
                //         'attribute' => 'unit_cost',
                //         'width' => '150px',
                //         'hAlign' => 'right',
                //         'format' => ['decimal', 2]
                //         //'pageSummary' => true
                //        // 'pageSummaryFunc' => GridView::F_AVG
                //     ],
                //     [
                //         'attribute' => 'quarter_one_quantity',
                //         'width' => '150px',
                //         'hAlign' => 'right',
                //         'format' => ['decimal',2],
                //         'pageSummary' => true
                //     ],
                //     [
                //         'attribute' => 'quarter_two_quantity',
                //         'width' => '150px',
                //         'hAlign' => 'right',
                //         'format' => ['decimal', 2],
                //         'pageSummary' => true
                //     ],
                //     [
                //         'attribute' => 'quarter_three_quantity',
                //         'width' => '150px',
                //         'hAlign' => 'right',
                //         'format' => ['decimal', 2],
                //         'pageSummary' => true
                //     ],
                //     [
                //         'attribute' => 'quarter_four_quantity',
                //         'width' => '150px',
                //         'hAlign' => 'right',
                //         'format' => ['decimal', 2],
                //         'pageSummary' => true
                //     ],
                //     [
                //         'class' => 'kartik\grid\FormulaColumn',
                //         'header' => 'Total <br> Quantity',
                //         'value' => function ($model, $key, $index, $widget) { 
                //             $p = compact('model', 'key', 'index');
                //             return $widget->col(6, $p)+$widget->col(7, $p)+$widget->col(8, $p) + $widget->col(9, $p);
                //         },
                //         'mergeHeader' => true,
                //         'width' => '150px',
                //         'hAlign' => 'right',
                //         'format' => ['decimal', 2],
                //         'pageSummary' => true
                //     ],
                //     [
                //         'class' => 'kartik\grid\FormulaColumn',
                //         'header' => 'Total <br> Amount',
                //         'value' => function ($model, $key, $index, $widget) { 
                //             $p = compact('model', 'key', 'index');
                //         return $widget->col(10, $p) != 0 ? $widget->col(5, $p) * $widget->col(10, $p) : 0;
                //         },
                //         'mergeHeader' => true,
                //         'width' => '150px',
                //         'hAlign' => 'right',
                //         'format' => ['decimal', 2],
                //         'pageSummary' => true
                //     ],
                
        
                //     ];
                } 
    

?>
<?php
      
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
             // echo '<p>';
             // !empty($model->province_id) && $model->province_id > 0 ? backend\models\Provinces::findOne($model->province_id)->name:""
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
        'showPageSummary' => true,
        
        'pjax' => true,
        'striped' => false,
        'hover' => true,
        // 'panel' => ['type' => 'primary', 'heading' => 'Grid Grouping Example'],
        'toggleDataContainer' => ['class' => 'btn-group mr-2'],
        'columns' => $gridColumns
                    ]);           
                  ?>  
    </div>
</div>
<?php


$this->registerCss('.popover-x {display:none}');
?>
