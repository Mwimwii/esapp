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
if (User::userIsAllowedTo('Manage AWPB activity lines') ) 
{

    echo'   <div class="col-12 col-sm-6 col-md-2">
        </div> 
        <div class="col-12 col-sm-6 col-md-2">
        </div>
        <div class="col-12 col-sm-6 col-md-2">
        </div>
        <div class="col-12 col-sm-6 col-md-2">
        </div>
        <div class="col-12 col-sm-6 col-md-2">
        </div>';
        echo'<div class="col-12 col-sm-6 col-md-1">';
        echo Html::a('Add AWPB activity line', ['create'], ['class' => 'float-right btn btn-success btn-sm']);
        echo ' </div>';

        echo'<div class="col-12 col-sm-6 col-md-1">';
        echo Html::a('Submit District AWPB', ['approve'], ['class' => 'btn btn-success btn-sm btn-space']); 
            echo ' </div>';
}
else 
{
            
          
    if (User::userIsAllowedTo('Manage AWPB activity lines')&& $user->district_id>0 ||$user->district_id!='') {
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
            <div class="col-12 col-sm-6 col-md-2">';
                echo Html::a('Add AWPB activity line', ['create'], ['class' => 'float-right btn btn-success btn-sm']);
                echo '</div>
                <div class="col-12 col-sm-6 col-md-2">';
                echo Html::a('Submit District AWPB', ['approve'], ['class' => 'btn btn-success btn-sm btn-space']);   
                echo ' </div>';      
        }
        else
        {
        
            if (User::userIsAllowedTo('Submit Provincial AWPB')&& $user->province_id>0 ||$user->province_id!=''&& $user->district_id==0 ||$user->district_id=='') {
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
            <div class="col-12 col-sm-6 col-md-2">';
                    echo Html::a('Add AWPB activity line', ['create'], ['class' => 'float-right btn btn-success btn-sm']);
                    echo '</div>
            <div class="col-12 col-sm-6 col-md-2">';
                    echo Html::a('Submit Provincial AWPB', ['approve'], ['class' => 'btn btn-success btn-sm btn-space']);  
                    echo ' </div>';            
            }
           
        }
    
    }
            ?>
            </div>
        <!-- <div class="btn-toolbar pull-right"> -->
            <?php
            // $user = User::findOne(['id' => Yii::$app->user->id]);
            // if (User::userIsAllowedTo('Manage AWPB activity lines')) {
               
            //         echo Html::a('Add AWPB activity line', ['create'], ['class' => 'float-right btn btn-success btn-sm']);
            // }
            // if (User::userIsAllowedTo('Submit District AWPB')&& $user->district_id>0 ||$user->district_id!='') {
            //     //   echo Html::a('&nbsp;');
            //      // btn btn-outline-primary btn-space
            //            echo Html::a('Submit District AWPB', ['approve'], ['class' => 'btn btn-success btn-sm btn-space']);         
            //    }
            //    if (User::userIsAllowedTo('Submit Provincial AWPB')&& $user->province_id>0 ||$user->province_id!=''&& $user->district_id<0 ||$user->district_id=='') {
            //     //   echo Html::a('&nbsp;');
            //      // btn btn-outline-primary btn-space
            //            echo Html::a('Submit Provincial AWPB', ['approve'], ['class' => 'btn btn-success btn-sm btn-space']);         
            //    }


            ?>
            <!-- </div> -->
        </p>



        <?php
        // $gridColumns = [
        //     ['class' => 'yii\grid\SerialColumn'],
        //     /*[
        //         'label' => 'Province',
        //         'visible' =>false,
        //         'filterType' => GridView::FILTER_SELECT2,
        //         'value' => function ($model) {
        //             $province_id = backend\models\Districts::findOne($model->district);
        //             $name = backend\models\Provinces::findOne($province_id)->name;
        //             return $name;
        //         },
        //     ],*/
        //     [
        //         'class' => EditableColumn::className(),
        //         'attribute' => 'activity_id',
        //         //'readonly' => false,
        //         'refreshGrid' => true,
        //         'filterType' => GridView::FILTER_SELECT2,
        //         'filterWidgetOptions' => [
        //             'pluginOptions' => ['allowClear' => true],
        //         ],
        //         'filter' => \backend\models\AwpbActivityLine::getByActivity($model->activity_id),
        //         'filterInputOptions' => ['prompt' => 'Filter by Market', 'class' => 'form-control', 'id' => null],
        //         'editableOptions' => [
        //             'asPopover' => true,
        //             'type' => 'success',
        //             'size' => PopoverX::SIZE_MEDIUM,
        //             'options' => ['data' => \backend\models\AwpbActivityLine::getByActivity($model->activity_id)],
        //             'inputType' => Editable::INPUT_SELECT2,
        //         ]
        //         ],

        //         [
        //             'class' => EditableColumn::className(),
        //             'attribute' => 'commodity_type_id',
        //             //'readonly' => false,
        //             //'options' => ["style" => "width:120px;",],
        //             'refreshGrid' => true,
        //             'filterType' => GridView::FILTER_SELECT2,
        //             'filterWidgetOptions' => [
        //                 'pluginOptions' => ['allowClear' => true],
        //             ],
        //             'filter' => \backend\models\CommodityTypes::getList(),
        //             'filterInputOptions' => ['prompt' => 'Filter by commodity type', 'class' => 'form-control', 'id' => null],
        //             'editableOptions' => [
        //                 'asPopover' => true,
        //                 'type' => 'success',
        //                 'size' => PopoverX::SIZE_MEDIUM,
        //                 'options' => ['data' => \backend\models\CommodityTypes::getList()],
        //                 'inputType' => Editable::INPUT_SELECT2,
        //             ]],
        //             [
        //                 'class' => EditableColumn::className(),
        //                 'attribute' => 'description',
        //                 //'readonly' => false,
        //                 //'options' => ["style" => "width:120px;",],
        //                 'refreshGrid' => true,
        //                 'filterType' => GridView::FILTER_SELECT2,
        //                 'filterWidgetOptions' => [
        //                     'pluginOptions' => ['allowClear' => true],
        //                 ],
        //                 'filter' => \backend\models\AwpbActivityLine::getList(),
        //                 'filterInputOptions' => ['prompt' => 'Filter by description', 'class' => 'form-control', 'id' => null],
        //                 'editableOptions' => [
        //                     'asPopover' => true,
        //                     'type' => 'success',
        //                     'size' => PopoverX::SIZE_MEDIUM,
        //                     'options' => ['data' => \backend\models\AwpbActivityLine::getList()],
        //                     'inputType' => Editable::INPUT_SELECT2,
        //                 ]],
        //                 [
        //                     'class' => EditableColumn::className(),
        //                     'attribute' => 'unit_cost',
        //                     //'readonly' => false,
        //                     //'options' => ["style" => "width:120px;",],
        //                     'refreshGrid' => true,
        //                     'filterType' => GridView::FILTER_SELECT2,
        //                     'filterWidgetOptions' => [
        //                         'pluginOptions' => ['allowClear' => true],
        //                     ],
        //                     'filter' => \backend\models\AwpbActivityLine::getList(),
        //                     'filterInputOptions' => ['prompt' => 'Filter by unit cost', 'class' => 'form-control', 'id' => null],
        //                     'editableOptions' => [
        //                         'asPopover' => true,
        //                         'type' => 'success',
        //                         'size' => PopoverX::SIZE_MEDIUM,
        //                         'options' => ['data' => \backend\models\AwpbActivityLine::getList()],
        //                         'inputType' => Editable::INPUT_SELECT2,
        //                     ],
        //                     'hAlign'=>'right',
        //                     'vAlign'=>'middle',
        //                     'width'=>'100px',
        //                     'format'=>['decimal', 2],
        //                     'pageSummary'=>true
        //                 ],
        //                 [
        //                     'class' => EditableColumn::className(),
        //                     'enableSorting' => true,
        //                     'attribute' => 'quarter_one_quantity',
        //                    // 'width' => '100px',
        //                     'contentOptions' => [
        //                         // 'style' => 'padding:0px 0px 0px 30px;',
        //                         'class' => 'text-right'
        //                     ],
        //                     'editableOptions' => [
        //                         'asPopover' => true,
        //                         'type' => 'success',
        //                         'inputType' => Editable::INPUT_TEXTAREA,
        //                         'submitOnEnter' => false,
        //                         'placement' => \kartik\popover\PopoverX::ALIGN_TOP,
        //                         'size' => PopoverX::SIZE_MEDIUM,
        //                         'options' => [
        //                             'class' => 'form-control',
        //                             'rows' => 1,
        //                             'placeholder' => 'Enter Q1 quantity...',
        //                             'style' => 'width:460px;',
        //                         ]
        //                     ],
        //                     'filter' => false,
        //                     'format' => 'raw',
        //                     'refreshGrid' => true,
        //                 ],
        //                 [
        //                     'class' => EditableColumn::className(),
        //                     'enableSorting' => true,
        //                     'attribute' => 'quarter_two_quantity',
        //                    // 'width' => '100px',
        //                     'contentOptions' => [
        //                         // 'style' => 'padding:0px 0px 0px 30px;',
        //                         'class' => 'text-right'
        //                     ],
        //                     'editableOptions' => [
        //                         'asPopover' => true,
        //                         'type' => 'success',
        //                         'inputType' => Editable::INPUT_TEXTAREA,
        //                         'submitOnEnter' => false,
        //                         'placement' => \kartik\popover\PopoverX::ALIGN_TOP,
        //                         'size' => PopoverX::SIZE_LARGE,
        //                         'options' => [
        //                             'class' => 'form-control',
        //                             'rows' => 1,
        //                             'placeholder' => 'Enter Q2 quantity...',
        //                             'style' => 'width:100px;',
        //                         ]
        //                     ],
        //                     'filter' => false,
        //                     'format' => 'raw',
        //                     'refreshGrid' => true,
        //                 ],

        //                 [
        //                     'class' => EditableColumn::className(),
        //                     'enableSorting' => true,
        //                     'attribute' => 'quarter_three_quantity',
        //                     'width' => '100px',
        //                     'contentOptions' => [
        //                         // 'style' => 'padding:0px 0px 0px 30px;',
        //                         'class' => 'text-right'
        //                     ],
        //                     'editableOptions' => [
        //                         'asPopover' => true,
        //                         'type' => 'success',
        //                         'inputType' => Editable::INPUT_TEXTAREA,
        //                         'submitOnEnter' => false,
        //                         'placement' => \kartik\popover\PopoverX::ALIGN_TOP,
        //                         'size' => PopoverX::SIZE_LARGE,
        //                         'options' => [
        //                             'class' => 'form-control',
        //                             'rows' => 1,
        //                             'placeholder' => 'Enter Q3 quantity...',
        //                             'style' => 'width:100px;',
        //                         ]
        //                     ],
        //                     'filter' => false,
        //                     'format' => 'raw',
        //                     'refreshGrid' => true,
        //                 ],
        //                 [
        //                     'class' => EditableColumn::className(),
        //                     'enableSorting' => true,
        //                     'attribute' => 'quarter_four_quantity',
        //                     'width' => '100px',
        //                     'contentOptions' => [
        //                         // 'style' => 'padding:0px 0px 0px 30px;',
        //                         'class' => 'text-right'
        //                     ],
        //                     'editableOptions' => [
        //                         'asPopover' => true,
        //                         'type' => 'success',
        //                         'inputType' => Editable::INPUT_TEXTAREA,
        //                         'submitOnEnter' => false,
        //                         'placement' => \kartik\popover\PopoverX::ALIGN_TOP,
        //                         'size' => PopoverX::SIZE_LARGE,
        //                         'options' => [
        //                             'class' => 'form-control',
        //                             'rows' => 1,
        //                             'placeholder' => 'Enter Q4 quantity...',
        //                             'style' => 'width:100px;',
        //                         ]
        //                     ],
        //                     'filter' => false,
        //                     'format' => 'raw',
        //                     'refreshGrid' => true,
        //                 ],
        //                     // [
        //                     //     'class' => EditableColumn::className(),
        //                     //     'attribute' => 'total_quantity',
        //                     //     //'readonly' => false,
        //                     //     //'options' => ["style" => "width:120px;",],
        //                     //     'refreshGrid' => true,
        //                     //     'filterType' => GridView::FILTER_SELECT2,
        //                     //     'filterWidgetOptions' => [
        //                     //         'pluginOptions' => ['allowClear' => true],
        //                     //     ],
        //                     //     'filter' => \backend\models\AwpbActivityLine::getList(),
        //                     //     'filterInputOptions' => ['prompt' => 'Filter by total quantity', 'class' => 'form-control', 'id' => null],
        //                     //     'editableOptions' => [
        //                     //         'asPopover' => true,
        //                     //         'type' => 'success',
        //                     //         'size' => PopoverX::SIZE_MEDIUM,
        //                     //         'options' => ['data' => \backend\models\AwpbActivityLine::getList()],
        //                     //         'inputType' => Editable::INPUT_SELECT2,
        //                     //     ]],
                             
        //                         // [
        //                         //     'class' => EditableColumn::className(),     
        //                         //     'attribute' => 'total_amount',
        //                         //     //'readonly' => false,
        //                         //     //'options' => ["style" => "width:120px;",],
        //                         //     'refreshGrid' => true,
        //                         //     'filterType' => GridView::FILTER_SELECT2,
        //                         //     'filterWidgetOptions' => [
        //                         //         'pluginOptions' => ['allowClear' => true],
        //                         //     ],
        //                         //     'filter' => \backend\models\AwpbActivityLine::getList(),
        //                         //     'filterInputOptions' => ['prompt' => 'Filter by total amount', 'class' => 'form-control', 'id' => null],
        //                         //     'editableOptions' => [
        //                         //         'asPopover' => true,
        //                         //         'type' => 'success',
        //                         //         'size' => PopoverX::SIZE_MEDIUM,
        //                         //         'options' => ['data' => \backend\models\AwpbActivityLine::getList()],
        //                         //         'inputType' => Editable::INPUT_SELECT2,
        //                         //     ],
        //                         //     'hAlign'=>'right',
        //                         //     'vAlign'=>'middle',
        //                         //     'width'=>'100px',
        //                         //     'format'=>['decimal', 2],
        //                         //     'pageSummary'=>true
        //                         // ],

        //                         [
        //                             'attribute' => 'total_quantity',
        //                             'filter' => false,
        //                             'hAlign'=>'right',
        //                             'vAlign'=>'middle',
        //                             'width'=>'100px',
        //                             'format'=>['decimal', 2],
        //                             'pageSummary'=>true
                                    
        //                         ],
        //                         [
        //                             'attribute' => 'total_amount',
        //                             'filter' => false,
        //                             'hAlign'=>'right',
        //                             'vAlign'=>'middle',
        //                             'width'=>'100px',
        //                             'format'=>['decimal', 2],
        //                             'pageSummary'=>true
                                    
        //                         ],
              
        //    // 'created_at',
        //     //'updated_at',
        //     //'created_by',
        //     //'updated_by',
        //     ['class' => ActionColumn::className(),
        //         'options' => ['style' => 'width:130px;'],
        //         'template' => '{delete}',
        //         'buttons' => [
        //             'delete' => function ($url, $model) {
        //                 if (User::userIsAllowedTo('Remove markets')) {
        //                     return Html::a(
        //                                     '<span class="fa fa-trash"></span>', ['delete', 'id' => $model->id], [
        //                                 'title' => 'Remove AWPB activity line',
        //                                 'data-toggle' => 'tooltip',
        //                                 'data-placement' => 'top',
        //                                 'data' => [
        //                                     'confirm' => 'Are you sure you want to remove this AWPB activity line for ' . backend\models\AwpbActivityLine::findOne($model->id)->description . '?<br>',
        //                                     'method' => 'post',
        //                                 ],
        //                                 'style' => "padding:5px;",
        //                                 'class' => 'bt btn-lg'
        //                                     ]
        //                     );
        //                 }
        //             },
        //         ]
        //     ],
        // ];


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
      


            // [
                
            //    // 'attribute' => 'activity_id',
            //     //'readonly' => false,
            //    // 'refreshGrid' => true,
            //     'filterType' => GridView::FILTER_SELECT2,
            //     'filterWidgetOptions' => [
            //         'pluginOptions' => ['allowClear' => true],
            //     ],
            //     'filter' => \backend\models\AwpbActivity::getAwpbActivitiesList(),
            //     'filterInputOptions' => ['prompt' => 'Filter by Market', 'class' => 'form-control', 'id' => null],
            //     // 'editableOptions' => [
            //     //     'asPopover' => true,
            //     //     'type' => 'success',
            //     //     'size' => PopoverX::SIZE_MEDIUM,
            //     //     'options' => ['data' => \backend\models\AwpbActivity::getAwpbActivitiesList()],
            //     //     'inputType' => Editable::INPUT_SELECT2,
            //     // ],
                
            //     'value' => function ($model) {
            //         $name = backend\models\AwpbActivity::findOne($model->activity_id)->activity_code;
            //         return $name;
            //     },
            //     ],
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
            
            // ['class' => 'kartik\grid\EditableColumn',
            //     'attribute' => 'activity_id', 
            //     'vAlign' => 'middle',
            //     'width' => '180px',
            //     'value' => function ($model, $key, $index, $widget) { 
            //         return Html::a($model->activity_id  
            //             );
            //     },
            //     'filterType' => GridView::FILTER_SELECT2,
            //     'filter' => ArrayHelper::map(backend\models\AWPBActivity::find()->orderBy('activity_code')->asArray()->all(), 'id', 'activity_code'), 
            //     'filterWidgetOptions' => [
            //         'pluginOptions' => ['allowClear' => true],
            //     ],
            //   //  'filterInputOptions' => ['placeholder' => 'Any author', 'multiple' => true], // allows multiple authors to be chosen
            //     'format' => 'raw'
            // ],

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
     


            
            // ['class' => 'kartik\grid\EditableColumn',
            //     'attribute' => 'commodity_type_id', 
            //     'vAlign' => 'middle',
            //     'width' => '180px',
            //     'value' => function ($model, $key, $index, $widget) { 

            //         $commodity_type = backend\models\CommodityType::findOne($model->commodity_type_id);
                    
            //         if (!empty($commodity_type)) {
            //            $name = $commodity_type->name;
            //        }
            //        return   $name ;
            //         // return Html::a($model->commodity_type_id
            //         //     );
            //     },
            //     'filterType' => GridView::FILTER_SELECT2,
            //     'filter' => ArrayHelper::map(backend\models\CommodityType::find()->orderBy('name')->asArray()->all(), 'id', 'name'), 
            //     'filterWidgetOptions' => [
            //         'pluginOptions' => ['allowClear' => true],
            //     ],

               
            //     //     return   $name ;
                    
            //     // },


               
            //   //  'filterInputOptions' => ['placeholder' => 'Any author', 'multiple' => true], // allows multiple authors to be chosen
            //     'format' => 'raw'
            // ],
            
            // [
            //     'attribute' => 'description', 
            //     'vAlign' => 'middle',
            //     'width' => '180px',
            //     'value' => function ($model, $key, $index, $widget) { 
            //         return Html::a($model->description 
            //             );
            //     },
            //     'filterType' => GridView::FILTER_SELECT2,
            //     'filter' => ArrayHelper::map(backend\models\AWPBActivity::find()->orderBy('description')->asArray()->all(), 'id', 'description'), 
            //     'filterWidgetOptions' => [
            //         'pluginOptions' => ['allowClear' => true],
            //     ],
            //   //  'filterInputOptions' => ['placeholder' => 'Any author', 'multiple' => true], // allows multiple authors to be chosen
            //     'format' => 'raw'
            // ],
            
         
            



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
            // //'id',
            // [
            //     'class' => 'kartik\grid\CheckboxColumn',
            //     'headerOptions' => ['class' => 'kartik-sheet-style'],
            //     'pageSummary' => '<small>(amounts in $)</small>',
            //     'pageSummaryOptions' => ['colspan' => 3, 'data-colspan-dir' => 'rtl']
            // ],

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

        
    </div>
</div>
<?php
$this->registerCss('.popover-x {display:none}');
?>
