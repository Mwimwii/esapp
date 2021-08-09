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
use backend\models\AwpbBudget;
use backend\models\AwpbActualInput;
use backend\models\AwpbActualInputSearch;

use backend\models\AwpbDistrict;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CommodityPriceCollectionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'Quarterly Operations Funds Requisition';
//$province_id = backend\models\Districts::findOne([Yii::$app->getUser()->identity->district_id])->province_id;
//$this->params['breadcrumbs'][] = $this->title;

//$this->params['breadcrumbs'][] = \backend\models\Provinces::findOne($province_id)->name;
//$this->params['breadcrumbs'][] = \backend\models\Districts::findOne([Yii::$app->getUser()->identity->district_id])->name;

?>
<div class="card card-success card-outline">
    <div class="card-body" style="overflow: auto;">
<?php

$user = User::findOne(['id' => Yii::$app->user->id]);
//$budget = AwpbBudget::findOne(['id'=>$modid]);
//$model = new backend\models\AwpbInput();

     if (User::userIsAllowedTo('Request Funds') && ( $user->district_id != 0 || $user->district_id != '')) {
            {
            
$funds_requisition =  AwpbDistrict::findOne(['awpb_template_id' => $id, 'district_id'=>$id2]);
$budgeted_input = \backend\models\AwpbInput::find()->where(['budget_id'=>$id4])->sum('total_amount');
$budget = \backend\models\AwpbActualInput::find()->where(['budget_id'=>$id4])->sum('total_amount');
 //$gridColumns ="";
//$id2="";
$id3="";
if (!empty($funds_requisition)) {
    
    if ($funds_requisition->status==backend\models\AwpbBudget::STATUS_MINISTRY) {
//$id2 = $funds_requisition->district_id;
        
            if ($budgeted_input<$budget) {
               echo Html::a('<i class="fa fa-plus"></i> Add AWPB Input', ['create'], ['class' => 'btn btn-success btn-sm']);
            }
        
 if ($quarter === "Q1") {




        $id3=1;
        $_quarter= "Fund Requisition for Quarter One";
?>

<?php
 
          
            

      $gridColumns = [
          [
    'class'=>'kartik\grid\SerialColumn',
    'contentOptions'=>['class'=>'kartik-sheet-style'],
    'width'=>'36px',
    
],
//             [
//            'attribute' => 'component',
//            'label' => 'Component', 
//            'vAlign' => 'middle',
//            'width' => '180px',
//            'value' => function ($model) {
//          
//               $name = \backend\models\AwpbComponent::findOne(['id' =>  $model->component_id]);
//              return !empty( $name) ? Html::a( $name->code, ['awpb-component/view', 'id' => $model->component_id], ['class' => 'awbp-output']):"";
//          
//            },
//           
//            'filterType' => GridView::FILTER_SELECT2,
//            'filter' =>  \backend\models\AwpbActivity::getAwpbActivitiesList($access_level), 
//            'filterWidgetOptions' => [
//                'pluginOptions' => ['allowClear' => true],
//                'options' => ['multiple' => true]
//            ],
//            'filterInputOptions' => ['placeholder' => 'Filter by component'],
//            'format' => 'raw'
//        ],
//            
//  
//        [
//            'attribute' => 'activity_id',
//            'label' => 'Activity', 
//            'vAlign' => 'middle',
//            'width' => '180px',
//
//            'value' => function ($model) {
//                $name =  \backend\models\AwpbActivity::findOne(['id' =>  $model->activity_id])->activity_code;
//                return Html::a($name, ['awpb-activity/view', 'id' => $model->activity_id], ['class' => 'awbp-activity']);
//            },
//           
//            'filterType' => GridView::FILTER_SELECT2,
//            'filter' =>  \backend\models\AwpbActivity::getAwpbActivitiesList($access_level), 
//            'filterWidgetOptions' => [
//                'pluginOptions' => ['allowClear' => true],
//                'options' => ['multiple' => true]
//            ],
//            'filterInputOptions' => ['placeholder' => 'Filter by activity'],
//            'format' => 'raw'
//        ],

                        [
                            'class' => 'kartik\grid\EditableColumn',
                            'label' => 'Input Description',
                            'attribute' => 'name',
                            'readonly' => true,
                            'filter' => false,
                            'editableOptions' => [
                                'header' => 'Name',
                                'inputType' => \kartik\editable\Editable::INPUT_TEXT,
                            ],
                            'hAlign' => 'left',
                            'vAlign' => 'left',
                        // 'width' => '7%',
                        ],
                        [
                            'class' => 'kartik\grid\EditableColumn',
                            'attribute' => 'unit_cost',
                            'readonly' => true,
                            'refreshGrid' => true,'filter' => false,
                            'editableOptions' => [
                                'header' => 'Unit Cost',
                                'inputType' => \kartik\editable\Editable::INPUT_SPIN,
                                'options' => [
                                    'pluginOptions' => ['min' => 0, 'max' => 999999999999999999999]
                                ]
                            ],
                            'hAlign' => 'right',
                            'vAlign' => 'middle',
                            'width' => '7%',
                            'format' => ['decimal', 2],
                            'pageSummary' => false
                        ],
                        [
                            'class' => 'kartik\grid\EditableColumn',
                            'attribute' => 'mo_1',
                            'readonly' => true,
                            'refreshGrid' => true,'filter' => false,
                            'editableOptions' => [
                                'header' => 'Q1 Qty',
                                'inputType' => \kartik\editable\Editable::INPUT_SPIN,
                                'options' => [
                                    'pluginOptions' => ['min' => 0, 'max' => 999999999999999999999]
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
                            'attribute' => 'mo_2',
                            'readonly' => true,

                            'refreshGrid' => true,'filter' => false,
                            'editableOptions' => [
                                'header' => 'Feb',
                                'inputType' => \kartik\editable\Editable::INPUT_SPIN,
                                'options' => [
                                    'pluginOptions' => ['min' => 0, 'max' => 999999999999999999999]
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
                            'attribute' => 'mo_3',
                            'readonly' => true,
                            'refreshGrid' => true,'filter' => false,
                            'editableOptions' => [
                                'header' => 'Mar',
                                'inputType' => \kartik\editable\Editable::INPUT_SPIN,
                                'options' => [
                                    'pluginOptions' => ['min' => 0, 'max' => 999999999999999999999]
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
                            'attribute' => 'mo_1_amount',
                            'readonly' => true,
                            'refreshGrid' => true,'filter' => false,
                            'editableOptions' => [
                                'header' => 'Jan',
                                'inputType' => \kartik\editable\Editable::INPUT_SPIN,
                                'options' => [
                                    'pluginOptions' => ['min' => 0, 'max' => 999999999999999999999]
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
                            'attribute' => 'mo_2_amount',
                            'readonly' => true,

                            'refreshGrid' => true,'filter' => false,
                            'editableOptions' => [
                                'header' => 'Feb',
                                'inputType' => \kartik\editable\Editable::INPUT_SPIN,
                                'options' => [
                                    'pluginOptions' => ['min' => 0, 'max' => 999999999999999999999]
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
                            'attribute' => 'mo_3_amount',
                            'readonly' => true,
                            'refreshGrid' => true,'filter' => false,
                            'editableOptions' => [
                                'header' => 'Mar',
                                'inputType' => \kartik\editable\Editable::INPUT_SPIN,
                                'options' => [
                                    'pluginOptions' => ['min' => 0, 'max' => 999999999999999999999]
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
                            'attribute' => 'quarter_one_amount',
                            'readonly' => true,
                            'refreshGrid' => true,'filter' => false,
                            'editableOptions' => [
                                'header' => 'Total Qtr 1',
                                'inputType' => \kartik\editable\Editable::INPUT_SPIN,
                                'options' => [
                                    'pluginOptions' => ['min' => 0, 'max' => 999999999999999999999]
                                ]
                            ],
                            'hAlign' => 'right',
                            'vAlign' => 'middle',
                            'width' => '7%',
                            'format' => ['decimal', 2],
                            'pageSummary' => true
                        ],      
                        
                                    
                            
                    
                    ['class' => 'yii\grid\ActionColumn',
                    'options' => ['style' => 'width:150px;'],
                    'template' => '{view}{update}{delete}',
                    'buttons' => [
                        'view' => function ($url, $model) {
                            if ( User::userIsAllowedTo('View AWPB')||User::userIsAllowedTo('Request Funds') ) {
                                return Html::a(
                                                '<span class="fa fa-eye"></span>', ['awpb-actual-input/view', 'id' => $model->id], [
                                            'title' => 'View input',
                                            'data-toggle' => 'tooltip',
                                            'data-placement' => 'top',
                                            'data-pjax' => '0',
                                            'style' => "padding:5px;",
                                            'class' => 'bt btn-lg'
                                                ]
                                );
                            }
                        },
                        'update' => function ($url, $model) use ($user, $quarter) {
 if (User::userIsAllowedTo('Request Funds') && ($user->district_id > 0 || $user->district_id != '')) {  
                return Html::a(
                                                '<span class="fas fa-edit"></span>', ['awpb-actual-input/update', 'id' => $model->id,'quarter'=>$quarter], [
                                            'title' => 'Update input',
                                            'data-toggle' => 'tooltip',
                                            'data-placement' => 'top',
                                            // 'target' => '_blank',)
                                            'data-pjax' => '0',
                                            'style' => "padding:5px;",
                                            'class' => 'bt btn-lg'
                                                ]
                                );
                            }
                        },
                        'delete' => function ($url, $model) use ($user) {
                          if ( User::userIsAllowedTo('Request Funds') && ($user->district_id > 0 || $user->district_id != '')) {
          return Html::a(
                                                '<span class="fa fa-trash"></span>', ['awpb-actual-input/delete', 'id' => $model->id], [
                                            'title' => 'delete input',
                                            'data-toggle' => 'tooltip',
                                            'data-placement' => 'top',
                                            'data' => [
                                                'confirm' => 'Are you sure you want to delete this input?',
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
                    ];

             ?>
<div class="row" style="">
   
              <div class="col-lg-4">
                   <?php
                   
                   $funds_requisition_status = "<p style='margin:4px; text-align: center;padding:4px;display:inline-block;' class='alert alert-success'> Total Activity Input Budget "
                            .Yii::$app->formatter->asDecimal($budget) ."</p><br>";     
//                    if ($funds_requisition->status_q_1 == \backend\models\AwpbDistrict::STATUS_QUARTER_CLOSED)
//                  {
//                      $funds_requisition_status = "<p style='margin:4px; text-align: center;padding:4px;display:inline-block;' class='alert alert-danger'> "
//                            . "Funds requisition window not open</p><br>";                              
//                  } 
//                  if ($funds_requisition->status_q_1 == \backend\models\AwpbDistrict::STATUS_QUARTER_OPEN)
//                  {
//                      $funds_requisition_status = "<p style='margin:4px; text-align: center;padding:4px;display:inline-block;' class='alert alert-danger'> "
//                            . "Funds not requested</p><br>";                              
//                  } 
//                   if ($funds_requisition->status_q_1 == \backend\models\AwpbDistrict::STATUS_QUARTER_REQUESTED )
//                  {
//                      $funds_requisition_status = "<p style='margin:4px; text-align: center;padding:4px;display:inline-block;' class='alert alert-danger'> "
//                            . "Funds requested</p><br>";                              
//                  } 
//                     if ($funds_requisition->status_q_1 == \backend\models\AwpbDistrict::STATUS_QUARTER_APPROVED  )
//                  {
//                      $funds_requisition_status = "<p style='margin:4px; text-align: center;padding:4px;display:inline-block;' class='alert alert-danger'> "
//                            . "Funds request approved</p><br>";                              
//                  } 
//                  if ($funds_requisition->status_q_1 == \backend\models\AwpbDistrict::STATUS_QUARTER_DISBURSED  )
//                  {
//                      $funds_requisition_status = "<p style='margin:4px; text-align: center;padding:4px;display:inline-block;' class='alert alert-danger'> "
//                            . "Funds disbursed</p><br>";                              
//                  } 
                  ?>
        <h6><?=  $funds_requisition_status ?></h6>
    </div>
             <div class="col-lg-5">
        <?php
        //if ($funds_requisition->funds_request==0) {
             if ( $funds_requisition->status_q_1==\backend\models\AwpbDistrict::STATUS_QUARTER_OPEN && User::userIsAllowedTo('Request Funds') && ($user->district_id > 0 || $user->district_id != '') )
             {
             
            echo Html::a(
                        '<span class="float-right btn btn-success btn-sm btn-space">Submit request</span>', ['awpb-district/submit', 'id' => $id, 'id2' => $id2,'id3' => $id3, 'status' => \backend\models\AwpbBudget:: STATUS_SUBMITTED], [
                    'title' => 'Submit Request',
                    'data-toggle' => 'tooltip',
                    'data-placement' => 'top',
                    // 'target' => '_blank',
                    'data-pjax' => '0',
                    // 'style' => "padding:5px;",
                    'class' => 'bt btn-lg'
                        ]
                );
        }

        ?> 
        </div></div>
          <?php
            $searchModel = new AwpbActualInputSearch();

$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

$dataProvider->query->andFilterWhere(['budget_id'=>$id4]);
if ($dataProvider->getCount() > 0) {

//    // echo ' </p>';
//    echo ExportMenu::widget([
//        'dataProvider' => $dataProvider,
//        'columns' => $gridColumns,
//        'fontAwesome' => true,
//        'dropdownOptions' => [
//            'label' => 'Export All',
//            'class' => 'btn btn-default'
//        ],
//        'filename' => 'AWPB Activity Lines' . date("YmdHis")
//    ]);
}

        echo GridView::widget([
            'dataProvider' => $dataProvider,
           // 'filterModel' => $searchModel,
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
 
            }
       
     //$gridColumns ="";
 if ($quarter === "Q2") {
     $id3=2;
    $_quarter= "Fund Requisition for Quarter Two";
      $gridColumns = [
             [
            'attribute' => 'component',
            'label' => 'Component', 
            'vAlign' => 'middle',
            'width' => '180px',
            'value' => function ($model) {
          
               $name = \backend\models\AwpbComponent::findOne(['id' =>  $model->component_id]);
              return !empty( $name) ? Html::a( $name->code, ['awpb-component/view', 'id' => $model->component_id], ['class' => 'awbp-output']):"";
          
            },
           
            'filterType' => GridView::FILTER_SELECT2,
            'filter' =>  \backend\models\AwpbActivity::getAwpbActivitiesList($access_level), 
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
                'options' => ['multiple' => true]
            ],
            'filterInputOptions' => ['placeholder' => 'Filter by component'],
            'format' => 'raw'
        ],
            [
            'attribute' => 'output_id', 
            'vAlign' => 'middle',
            'width' => '150px',
            'value' => function ($model, $key, $index, $widget) {
                $outcome= \backend\models\AwpbOutput::findOne(['id' => $model->output_id]);						
            
            return     !empty( $outcome) ? Html::a( $outcome->code, ['awpb-output/view', 'id' => $model->output_id], ['class' => 'awbp-output']):"";
           
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
            'label' => 'Activity', 
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
                            'class' => 'kartik\grid\EditableColumn',
                            'label' => 'Input Description',
                            'attribute' => 'name',
                            'readonly' => true,
                            'filter' => false,
                            'editableOptions' => [
                                'header' => 'Name',
                                'inputType' => \kartik\editable\Editable::INPUT_TEXT,
                            ],
                            'hAlign' => 'left',
                            'vAlign' => 'left',
                        // 'width' => '7%',
                        ],
                        [
                            'class' => 'kartik\grid\EditableColumn',
                            'attribute' => 'unit_cost',
                            'readonly' => true,
                            'refreshGrid' => true,'filter' => false,
                            'editableOptions' => [
                                'header' => 'Unit Cost',
                                'inputType' => \kartik\editable\Editable::INPUT_SPIN,
                                'options' => [
                                    'pluginOptions' => ['min' => 0, 'max' => 999999999999999999999]
                                ]
                            ],
                            'hAlign' => 'right',
                            'vAlign' => 'middle',
                            'width' => '7%',
                            'format' => ['decimal', 2],
                            'pageSummary' => false
                        ],
                        [
                            'class' => 'kartik\grid\EditableColumn',
                            'attribute' => 'mo_4',
                            'readonly' => true,
                            'refreshGrid' => true,'filter' => false,
                            'editableOptions' => [
                                'header' => 'Q1 Qty',
                                'inputType' => \kartik\editable\Editable::INPUT_SPIN,
                                'options' => [
                                    'pluginOptions' => ['min' => 0, 'max' => 999999999999999999999]
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
                            'attribute' => 'mo_5',
                            'readonly' => true,

                            'refreshGrid' => true,'filter' => false,
                            'editableOptions' => [
                                'header' => 'Feb',
                                'inputType' => \kartik\editable\Editable::INPUT_SPIN,
                                'options' => [
                                    'pluginOptions' => ['min' => 0, 'max' => 999999999999999999999]
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
                            'attribute' => 'mo_6',
                            'readonly' => true,
                            'refreshGrid' => true,'filter' => false,
                            'editableOptions' => [
                                'header' => 'Mar',
                                'inputType' => \kartik\editable\Editable::INPUT_SPIN,
                                'options' => [
                                    'pluginOptions' => ['min' => 0, 'max' => 999999999999999999999]
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
                            'attribute' => 'mo_4_amount',
                            'readonly' => true,
                            'refreshGrid' => true,'filter' => false,
                            'editableOptions' => [
                                'header' => 'Jan',
                                'inputType' => \kartik\editable\Editable::INPUT_SPIN,
                                'options' => [
                                    'pluginOptions' => ['min' => 0, 'max' => 999999999999999999999]
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
                            'attribute' => 'mo_5_amount',
                            'readonly' => true,

                            'refreshGrid' => true,'filter' => false,
                            'editableOptions' => [
                                'header' => 'Feb',
                                'inputType' => \kartik\editable\Editable::INPUT_SPIN,
                                'options' => [
                                    'pluginOptions' => ['min' => 0, 'max' => 999999999999999999999]
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
                            'attribute' => 'mo_6_amount',
                            'readonly' => true,
                            'refreshGrid' => true,'filter' => false,
                            'editableOptions' => [
                                'header' => 'Mar',
                                'inputType' => \kartik\editable\Editable::INPUT_SPIN,
                                'options' => [
                                    'pluginOptions' => ['min' => 0, 'max' => 999999999999999999999]
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
                            'readonly' => true,
                            'refreshGrid' => true,'filter' => false,
                            'editableOptions' => [
                                'header' => 'Total Qtr 1',
                                'inputType' => \kartik\editable\Editable::INPUT_SPIN,
                                'options' => [
                                    'pluginOptions' => ['min' => 0, 'max' => 999999999999999999999]
                                ]
                            ],
                            'hAlign' => 'right',
                            'vAlign' => 'middle',
                            'width' => '7%',
                            'format' => ['decimal', 2],
                            'pageSummary' => true
                        ],      
                        
                                    
                            
                    
                    ];
 
 ?>

          <?php
            $searchModel = new AwpbInputSearch();

$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

$dataProvider->query->andFilterWhere(['awpb_template_id' => $id,'district_id'=>$id2]);
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
        'filename' => 'AWPB ' . date("YmdHis")
    ]);
}

        echo GridView::widget([
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
            }
            
     if ($quarter === "Q3") {
         $id3=3;
        $_quarter= "Fund Requisition for Quarter Three";
      $gridColumns = [
             [
            'attribute' => 'component',
            'label' => 'Component', 
            'vAlign' => 'middle',
            'width' => '180px',
            'value' => function ($model) {
          
               $name = \backend\models\AwpbComponent::findOne(['id' =>  $model->component_id]);
              return !empty( $name) ? Html::a( $name->code, ['awpb-component/view', 'id' => $model->component_id], ['class' => 'awbp-output']):"";
          
            },
           
            'filterType' => GridView::FILTER_SELECT2,
            'filter' =>  \backend\models\AwpbActivity::getAwpbActivitiesList($access_level), 
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
                'options' => ['multiple' => true]
            ],
            'filterInputOptions' => ['placeholder' => 'Filter by component'],
            'format' => 'raw'
        ],
            [
            'attribute' => 'output_id', 
            'vAlign' => 'middle',
            'width' => '150px',
            'value' => function ($model, $key, $index, $widget) {
                $outcome= \backend\models\AwpbOutput::findOne(['id' => $model->output_id]);						
            
            return     !empty( $outcome) ? Html::a( $outcome->code, ['awpb-output/view', 'id' => $model->output_id], ['class' => 'awbp-output']):"";
           
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
            'label' => 'Activity', 
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
                            'class' => 'kartik\grid\EditableColumn',
                            'label' => 'Input Description',
                            'attribute' => 'name',
                            'readonly' => true,
                            'filter' => false,
                            'editableOptions' => [
                                'header' => 'Name',
                                'inputType' => \kartik\editable\Editable::INPUT_TEXT,
                            ],
                            'hAlign' => 'left',
                            'vAlign' => 'left',
                        // 'width' => '7%',
                        ],
                        [
                            'class' => 'kartik\grid\EditableColumn',
                            'attribute' => 'unit_cost',
                            'readonly' => true,
                            'refreshGrid' => true,'filter' => false,
                            'editableOptions' => [
                                'header' => 'Unit Cost',
                                'inputType' => \kartik\editable\Editable::INPUT_SPIN,
                                'options' => [
                                    'pluginOptions' => ['min' => 0, 'max' => 999999999999999999999]
                                ]
                            ],
                            'hAlign' => 'right',
                            'vAlign' => 'middle',
                            'width' => '7%',
                            'format' => ['decimal', 2],
                            'pageSummary' => false
                        ],
                        [
                            'class' => 'kartik\grid\EditableColumn',
                            'attribute' => 'mo_7',
                            'readonly' => true,
                            'refreshGrid' => true,'filter' => false,
                            'editableOptions' => [
                                'header' => 'Q1 Qty',
                                'inputType' => \kartik\editable\Editable::INPUT_SPIN,
                                'options' => [
                                    'pluginOptions' => ['min' => 0, 'max' => 999999999999999999999]
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
                            'attribute' => 'mo_8',
                            'readonly' => true,

                            'refreshGrid' => true,'filter' => false,
                            'editableOptions' => [
                                'header' => 'Feb',
                                'inputType' => \kartik\editable\Editable::INPUT_SPIN,
                                'options' => [
                                    'pluginOptions' => ['min' => 0, 'max' => 999999999999999999999]
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
                            'attribute' => 'mo_9',
                            'readonly' => true,
                            'refreshGrid' => true,'filter' => false,
                            'editableOptions' => [
                                'header' => 'Mar',
                                'inputType' => \kartik\editable\Editable::INPUT_SPIN,
                                'options' => [
                                    'pluginOptions' => ['min' => 0, 'max' => 999999999999999999999]
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
                            'attribute' => 'mo_7_amount',
                            'readonly' => true,
                            'refreshGrid' => true,'filter' => false,
                            'editableOptions' => [
                                'header' => 'Jan',
                                'inputType' => \kartik\editable\Editable::INPUT_SPIN,
                                'options' => [
                                    'pluginOptions' => ['min' => 0, 'max' => 999999999999999999999]
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
                            'attribute' => 'mo_8_amount',
                            'readonly' => true,

                            'refreshGrid' => true,'filter' => false,
                            'editableOptions' => [
                                'header' => 'Feb',
                                'inputType' => \kartik\editable\Editable::INPUT_SPIN,
                                'options' => [
                                    'pluginOptions' => ['min' => 0, 'max' => 999999999999999999999]
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
                            'attribute' => 'mo_9_amount',
                            'readonly' => true,
                            'refreshGrid' => true,'filter' => false,
                            'editableOptions' => [
                                'header' => 'Mar',
                                'inputType' => \kartik\editable\Editable::INPUT_SPIN,
                                'options' => [
                                    'pluginOptions' => ['min' => 0, 'max' => 999999999999999999999]
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
                            'readonly' => true,
                            'refreshGrid' => true,'filter' => false,
                            'editableOptions' => [
                                'header' => 'Total Qtr 1',
                                'inputType' => \kartik\editable\Editable::INPUT_SPIN,
                                'options' => [
                                    'pluginOptions' => ['min' => 0, 'max' => 999999999999999999999]
                                ]
                            ],
                            'hAlign' => 'right',
                            'vAlign' => 'middle',
                            'width' => '7%',
                            'format' => ['decimal', 2],
                            'pageSummary' => true
                        ],      
                        
                                    
                            
                    
                    ];
 
 ?>
        
            <?php
            $searchModel = new AwpbInputSearch();

$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

$dataProvider->query->andFilterWhere(['awpb_template_id' => $id,'district_id'=>$id2]);
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
        'filename' => 'AWPB Lines' . date("YmdHis")
    ]);
}

        echo GridView::widget([
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

            }
          
            if ($quarter === "Q4") {
                $id3=4;
$_quarter= "Fund Requisition for Quarter Four";
      $gridColumns = [
             [
            'attribute' => 'component',
            'label' => 'Component', 
            'vAlign' => 'middle',
            'width' => '180px',
            'value' => function ($model) {
          
               $name = \backend\models\AwpbComponent::findOne(['id' =>  $model->component_id]);
              return !empty( $name) ? Html::a( $name->code, ['awpb-component/view', 'id' => $model->component_id], ['class' => 'awbp-output']):"";
          
            },
           
            'filterType' => GridView::FILTER_SELECT2,
            'filter' =>  \backend\models\AwpbActivity::getAwpbActivitiesList($access_level), 
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
                'options' => ['multiple' => true]
            ],
            'filterInputOptions' => ['placeholder' => 'Filter by component'],
            'format' => 'raw'
        ],
            [
            'attribute' => 'output_id', 
            'vAlign' => 'middle',
            'width' => '150px',
            'value' => function ($model, $key, $index, $widget) {
                $outcome= \backend\models\AwpbOutput::findOne(['id' => $model->output_id]);						
            
            return     !empty( $outcome) ? Html::a( $outcome->code, ['awpb-output/view', 'id' => $model->output_id], ['class' => 'awbp-output']):"";
           
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
            'label' => 'Activity', 
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
                            'class' => 'kartik\grid\EditableColumn',
                            'label' => 'Input Description',
                            'attribute' => 'name',
                            'readonly' => true,
                            'filter' => false,
                            'editableOptions' => [
                                'header' => 'Name',
                                'inputType' => \kartik\editable\Editable::INPUT_TEXT,
                            ],
                            'hAlign' => 'left',
                            'vAlign' => 'left',
                        // 'width' => '7%',
                        ],
                        [
                            'class' => 'kartik\grid\EditableColumn',
                            'attribute' => 'unit_cost',
                            'readonly' => true,
                            'refreshGrid' => true,'filter' => false,
                            'editableOptions' => [
                                'header' => 'Unit Cost',
                                'inputType' => \kartik\editable\Editable::INPUT_SPIN,
                                'options' => [
                                    'pluginOptions' => ['min' => 0, 'max' => 999999999999999999999]
                                ]
                            ],
                            'hAlign' => 'right',
                            'vAlign' => 'middle',
                            'width' => '7%',
                            'format' => ['decimal', 2],
                            'pageSummary' => false
                        ],
                        [
                            'class' => 'kartik\grid\EditableColumn',
                            'attribute' => 'mo_10',
                            'readonly' => true,
                            'refreshGrid' => true,'filter' => false,
                            'editableOptions' => [
                                'header' => 'Q1 Qty',
                                'inputType' => \kartik\editable\Editable::INPUT_SPIN,
                                'options' => [
                                    'pluginOptions' => ['min' => 0, 'max' => 999999999999999999999]
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
                            'attribute' => 'mo_11',
                            'readonly' => true,

                            'refreshGrid' => true,'filter' => false,
                            'editableOptions' => [
                                'header' => 'Feb',
                                'inputType' => \kartik\editable\Editable::INPUT_SPIN,
                                'options' => [
                                    'pluginOptions' => ['min' => 0, 'max' => 999999999999999999999]
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
                            'attribute' => 'mo_12',
                            'readonly' => true,
                            'refreshGrid' => true,'filter' => false,
                            'editableOptions' => [
                                'header' => 'Mar',
                                'inputType' => \kartik\editable\Editable::INPUT_SPIN,
                                'options' => [
                                    'pluginOptions' => ['min' => 0, 'max' => 999999999999999999999]
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
                            'attribute' => 'mo_10_amount',
                            'readonly' => true,
                            'refreshGrid' => true,'filter' => false,
                            'editableOptions' => [
                                'header' => 'Jan',
                                'inputType' => \kartik\editable\Editable::INPUT_SPIN,
                                'options' => [
                                    'pluginOptions' => ['min' => 0, 'max' => 999999999999999999999]
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
                            'attribute' => 'mo_11_amount',
                            'readonly' => true,

                            'refreshGrid' => true,'filter' => false,
                            'editableOptions' => [
                                'header' => 'Feb',
                                'inputType' => \kartik\editable\Editable::INPUT_SPIN,
                                'options' => [
                                    'pluginOptions' => ['min' => 0, 'max' => 999999999999999999999]
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
                            'attribute' => 'mo_12_amount',
                            'readonly' => true,
                            'refreshGrid' => true,'filter' => false,
                            'editableOptions' => [
                                'header' => 'Mar',
                                'inputType' => \kartik\editable\Editable::INPUT_SPIN,
                                'options' => [
                                    'pluginOptions' => ['min' => 0, 'max' => 999999999999999999999]
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
                            'readonly' => true,
                            'refreshGrid' => true,'filter' => false,
                            'editableOptions' => [
                                'header' => 'Total Qtr 1',
                                'inputType' => \kartik\editable\Editable::INPUT_SPIN,
                                'options' => [
                                    'pluginOptions' => ['min' => 0, 'max' => 999999999999999999999]
                                ]
                            ],
                            'hAlign' => 'right',
                            'vAlign' => 'middle',
                            'width' => '7%',
                            'format' => ['decimal', 2],
                            'pageSummary' => true
                        ],      
                        
                                    
                            
                    
                    ];
 ?>

        
 
          <?php
            $searchModel = new AwpbInputSearch();

$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

$dataProvider->query->andFilterWhere(['awpb_template_id' => $id,'district_id'=>$id2]);
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
        'filename' => 'AWPB ' . date("YmdHis")
    ]);
}

        echo GridView::widget([
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
            }
            }
            else
            {
               
            Yii::$app->session->setFlash('error', 'No budget to request funds from.');
           
            } }
            else
            {
               
            Yii::$app->session->setFlash('error', 'No budget to request funds from.');
           
            }
}
 } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
 return $this->redirect(['site/home']);

            }
            ?>


        
    </div>
</div>
        <?php
        $this->registerCss('.popover-x {display:none}');
        ?>