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
use backend\models\Storyofchange;
use backend\models\AwpbActivityLine;
use backend\models\AwpbActivityLineSearch;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\CommodityPriceCollectionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$activity = \backend\models\AwpbActivity::findOne(['id' => $id]);
 $activity_name="";
if (!empty($activity)) {
    $activity_name = $activity->activity_code.' '.$activity->name;
    $fis = $activity->awpb_template_id;
}
 $this->title = 'AWPB  PW Activity : '.   $activity_name .' by Cost Centre';
//$province_id = backend\models\Districts::findOne([Yii::$app->getUser()->identity->district_id])->province_id;
$this->params['breadcrumbs'][] = $this->title;

$user = User::findOne(['id' => Yii::$app->user->id]);
$access_level=1;
 global $province_id;
 $province_id = 0;
 $pro=0;
 $time = new \DateTime('now');
$today = $time->format('Y-m-d');
$template_model =  \backend\models\AwpbTemplate::find()->where(['status' =>\backend\models\AwpbTemplate::STATUS_PUBLISHED])->one();


?>
<div class="card card-success card-outline">
    <div class="card-body" style="overflow: auto;">
        <h1><?= Html::encode($this->title) ?></h1>
   <p>
         

        <?php
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
  
     
         [
             'attribute' => 'awpb_template_id',
             'label' => 'Fiscal Year', 
             'vAlign' => 'middle',
             'width' => '7%',

             'value' => function ($model) {
                 $name =  \backend\models\AwpbTemplate::findOne(['id' =>  $model->awpb_template_id])->fiscal_year;
                 return Html::a($name, ['awpb-template/view', 'id' => $model->awpb_template_id], ['class' => 'awbp-template']);
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
//[
//                    'attribute' => 'component_id',
//                    'label' => 'Component',
//                    'vAlign' => 'middle',
//                    'width' => '7%',
//                    'value' => function ($model, $key, $index, $widget) {
//                        $component = \backend\models\AwpbComponent::findOne(['id' => $model->component_id]);
//
//                       return !empty($component) ? $component->code : "";
//                        //return !empty($component) ? Html::a($component->code .' '.$component->name, ['pwca', 'id' => $model->component_id ], ['class' => 'mpcd']) : "";
//                 
//                    },
//                    'filterType' => GridView::FILTER_SELECT2,
//                    'filter' => ArrayHelper::map(backend\models\AwpbComponent::find()->orderBy('code')->asArray()->all(), 'id', 'code'),
//                    'filterWidgetOptions' => [
//                        'pluginOptions' => ['allowClear' => true],
//                        'options' => ['multiple' => true]
//                    ],
//                    'filterInputOptions' => ['placeholder' => 'Filter by component'],
//                    'format' => 'raw'
//                ],
//                                 [
//                    'attribute' => 'activity_id',
//                    'label' => 'Activity',
//                    'vAlign' => 'middle',
//                    //'width' => '180px',
//                    'value' => function ($model) {
//                        $activity = \backend\models\AwpbActivity::findOne(['id' => $model->activity_id]);
////
////                        return $name->activity_code . ' ' . $name->name;
//                        
//                           return !empty($model->activity_id) && $model->activity_id > 0 ? Html::a($activity->activity_code.' '.$activity->name, ['viewpw_1', 'id' => $model->id,'status' => $model->id ], ['class' => 'mpcd']) : "";
//                 
//                    },
//                    'filterType' => GridView::FILTER_SELECT2,
//                    'filter' => \backend\models\AwpbActivity::getAwpbActivitiesList($access_level),
//                    'filterWidgetOptions' => [
//                        'pluginOptions' => ['allowClear' => true],
//                        'options' => ['multiple' => true]
//                    ],
//                    'filterInputOptions' => ['placeholder' => 'Filter by activity'],
//                    'format' => 'raw'
//                ],
        


         [
             'attribute' => 'cost_centre_id',
             'label' => 'Cost Cntre', 
             'vAlign' => 'middle',
           //  'width' => '180px',

             'value' => function ($model) {
                 $name = \backend\models\AwpbCostCentre::findOne(['id' =>  $model->cost_centre_id])->name;
                 return !empty($model->cost_centre_id) && $model->cost_centre_id > 0 ? Html::a($name, ['awpb-budget/viewpw_1', 'id' => $model->id], ['class' => 'awbp-activity-line']): "";
                   },
           
              'filterType' => GridView::FILTER_SELECT2,
              'filter' =>  \backend\models\AwpbActivity::getAwpbActivitiesList($access_level), 
//              'filterWidgetOptions' => [
//                  'pluginOptions' => ['allowClear' => true],
//                  'options' => ['multiple' => true]
//              ],
              'filterInputOptions' => ['placeholder' => 'Filter by activity'],
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
            //     'label' => 'Item Description',
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
                                 [
                'class' => 'kartik\grid\ActionColumn',
                'vAlign'=>'middle',
                                     'width' => '10%',
            'template' => '{view}{update} {declinep}',
            'buttons' => [
                
                         
                'view' => function ($url, $model) use ($user,$status){
                  
                              
                        return Html::a(
                                        '<span class="fas fa-eye"></span>',['viewpw_1','id'=>$model->id,'status'=> \backend\models\AwpbBudget:: STATUS_APPROVED], [ 
                                    'title' => 'View AWPB Activity',
                                    'data-toggle' => 'tooltip',
                                    'data-placement' => 'top',
                                    // 'target' => '_blank',
                                    'data-pjax' => '0',
                                   // 'style' => "padding:5px;",
                                    'class' => 'bt btn-lg'
                                        ]
                        );
                        
                  
                },
                'update' => function ($url, $model) use ($user,$status){
                  $awpb_province =  \backend\models\AwpbProvince::findOne(['awpb_template_id' =>$model->awpb_template_id, 'province_id'=>$model->province_id]);
                            //$status=100;
                            if (!empty($awpb_province)) {
                              $status= $awpb_province->status;

                            }
                   if ((User::userIsAllowedTo('Approve AWPB - PCO') && $status == \backend\models\AwpbBudget::STATUS_REVIEWED) || (User::userIsAllowedTo('Approve AWPB - Ministry') && $status == \backend\models\AwpbBudget::STATUS_APPROVED )) {

                              
                        return Html::a(
                                        '<span class="fas fa-check">'.$status.'</span>',['submit','id'=>$model->province_id,'status'=> \backend\models\AwpbBudget:: STATUS_APPROVED], [ 
                                    'title' => 'Approve Provincial AWPB',
                                    'data-toggle' => 'tooltip',
                                    'data-placement' => 'top',
                                    // 'target' => '_blank',
                                    'data-pjax' => '0',
                                   // 'style' => "padding:5px;",
                                    'class' => 'bt btn-lg'
                                        ]
                        );
                        
                  }
                },
                           'declinep' => function ($url, $model) use ($user, $pro,$status) {
                            $awpb_province =  \backend\models\AwpbProvince::findOne(['awpb_template_id' =>$model->awpb_template_id,'province_id'=>$model->province_id]);
                            $status=100;
                            if (!empty($awpb_province)) {
                              $status= $awpb_province->status;

                            }
                  if (((User::userIsAllowedTo('Approve AWPB - PCO') && $status == \backend\models\AwpbBudget::STATUS_REVIEWED) || (User::userIsAllowedTo('Approve AWPB - Ministry') && $status == \backend\models\AwpbBudget::STATUS_APPROVED ))&& ($user->province_id == 0 || $user->province_id == '')) {

                        $pro =  $awpb_province->id;
                        $province_id =$awpb_province->id;
                

                         return Html::a(
                                        '<span class="fas fa-times-circle"></span>',['awpb-comment/declinep','id'=>$model->province_id], [ 
                                    'title' => 'Decline Provincial AWPB',
                                    'data-toggle' => 'tooltip',
                                    'data-placement' => 'top',
                                    // 'target' => '_blank',
                                    'data-pjax' => '0',
                                   // 'style' => "padding:5px;",
                                    'class' => 'bt btn-lg'
                                        ]
                        );


                    }
                },
               
            ]]

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


            // [
            //     'attribute' => 'status', 'format' => 'raw',
            //     'value' => function($model) {
            //         $str = "";
            //         $id = 1;
            //         //if ($model->status == AwpbActivityLine::STATUS_SUBMITTED) {
            //             if ($id== 1) {
            //             $str = "<p style='margin:2px;padding:2px;display:inline-block;' class='badge badge-success'> "
            //                     . "<i class='fa fa-check'></i> Accepted</p><br>";
            //         } else {
            //             $str = "<p style='margin:2px;padding:2px;display:inline-block;' class='badge badge-info'> "
            //                     . "<i class='fa fa-hourglass-half'></i> Pending IKMO review</p><br>";
            //         }
            //         return $str;
            //     },
            // ],

            ];



        if ($dataProvider->getCount() > 0) {
            
        }
   
          // echo ' </p>';
            echo ExportMenu::widget([
                'dataProvider' => $dataProvider,
                'columns' => $gridColumns,
                'fontAwesome' => true,
                'dropdownOptions' => [
                    'label' => 'Export All',
                    'class' => 'btn btn-default'
                ],
                'filename' => 'AWPB' . date("YmdHis")
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
       // 'filterModel' => $searchModel,
        'columns' => $gridColumns,
      
       // 'pjax' => true,
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
 
 </p>
        
    </div>
</div>




<?php
$this->registerCss('.popover-x {display:none}');

?>