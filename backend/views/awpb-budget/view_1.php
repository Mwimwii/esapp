<?php

//use kartik\grid\GridView;
use yii\helpers\Html;
//use kartik\form\ActiveForm;

//use kartik\detail\DetailView;
//use \backend\models\User;
//use kartik\file\FileInput;

//use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap4\ActiveForm;
//use yii\widgets\DetailView;
use kartik\grid\GridView;
use kartik\detail\DetailView;
use yii\helpers\Url;
use kartik\export\ExportMenu;
use backend\models\User;
use backend\models\AwpbTemplate;

/* @var $this yii\web\View */
/* @var $model backend\models\AwpbTemplate */

$this->title = 'AWPB : ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'AWPB', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->id;
\yii\web\YiiAsset::register($this);

$user = User::findOne(['id' => Yii::$app->user->id]);
$access_level = 1;
$act = "";
$fis = "";
$activity = \backend\models\AwpbActivity::findOne(['id' => $model->activity_id]);
$status = $model->status;
if (!empty($activity)) {
    $act = $activity->name;
    $fis = $activity->awpb_template_id;
}

$tem = "";
$template = \backend\models\AWPBTemplate::findOne(['id' => $model->awpb_template_id]);

if (!empty($template)) {
    $tem = $template->fiscal_year;
}

$dist = "";
$district = \backend\models\Districts::findOne(['id' => $model->district_id]);

if (!empty($district)) {
    $dist = $district->name;
}
$pro = "";
$province = \backend\models\Provinces::findOne(['id' => $model->province_id]);

if (!empty($province)) {
    $pro = $province->name;

}
$cam = "";
$camp = \backend\models\Camps::findOne(['id' => $model->camp_id]);

if (!empty($camp)) {
    $cam = $camp->name;
}
$time = new \DateTime('now');
$today = $time->format('Y-m-d');
$template_model =  \backend\models\AwpbTemplate::find()->where(['status' =>\backend\models\AwpbTemplate::STATUS_CURRENT_BUDGET])->one();

 $awpb_district =  \backend\models\AwpbDistrict::findOne(['awpb_template_id' =>$model->awpb_template_id, 'district_id'=>$user->district_id]);
        
        
       // $awpb_district = \backend\models\AwpbDistrict::findOne(['awpb_template_id' => $id, 'district_id'=>$id2]);
$awpb_province = \backend\models\AwpbProvince::findOne(['awpb_template_id' => $model->awpb_template_id, 'province_id'=>$awpb_district->province_id]);
//$budgeted_input = \backend\models\AwpbInput::find()->where(['budget_id'=>$id4])->sum('total_amount');
//$budget = \backend\models\AwpbActualInput::find()->where(['budget_id'=>$id4])->sum('total_amount');
    $funds_requested= 0.0;        
  //if (\backend\models\User::userIsAllowedTo('View AWPB')) {
     
  if($awpb_province->status== \backend\models\AwpbBudget::STATUS_MINISTRY && $awpb_district->status== \backend\models\AwpbBudget::STATUS_MINISTRY ) 
  {
      
      if($awpb_district->status_q_1== \backend\models\AwpbBudget::STATUS_SUBMITTED)
      {
          $funds_requested =+$model->quarter_one_actual_amount;
      }
       if($awpb_district->status_q_2== \backend\models\AwpbBudget::STATUS_SUBMITTED)
      {
          $funds_requested =+ $model->quarter_two_actual_amount;
      }
          if($awpb_district->status_q_3== \backend\models\AwpbBudget::STATUS_SUBMITTED)
      {
          $funds_requested =+ $model->quarter_three_actual_amount;
      }
              if($awpb_district->status_q_4== \backend\models\AwpbBudget::STATUS_SUBMITTED)
      {
          $funds_requested =+ $model->quarter_four_actual_amount;
      }
?>




<div class="card card-success card-outline">
    <div class="card-body">
        <h1><?= Html::encode($this->title) ?></h1>

        <p>



<?php


echo Html::a('<span class="fas fa-arrow-left fa-2x"></span>', Yii::$app->request->referrer, [
    'title' => 'back',
    'data-toggle' => 'tooltip',
    'data-placement' => 'top',
]);
//}

echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";

?>
        <div clas="row">
            <div class="col-lg-12">

            <?php
            $attributes = [
          
                [
                    'columns' => [
                        [
                            'attribute' => 'province_id',
                            'label' => 'Province Name',
                            'displayOnly' => true,
                            'labelColOptions' => ['style' => 'width:10%'],
                            'valueColOptions' => ['style' => 'width:15%'],
                            'value' => $pro,
                        ],
                        [
                            'attribute' => 'district_id',
                            'label' => 'District Name',
                            'displayOnly' => true,
                            'labelColOptions' => ['style' => 'width:10%'],
                            'valueColOptions' => ['style' => 'width:15%'],
                            'value' => $dist,
                        ],
                           [
                            'attribute' => 'camp_id',
                            'label' => 'Camp Name',
                            'displayOnly' => true,
                            'labelColOptions' => ['style' => 'width:10%'],
                            'valueColOptions' => ['style' => 'width:20%'],
                            'value' => $cam,
                        ],
                        [
                            'label' => 'Fiscal Year',
                            'format' => 'raw',
                            'value' => $tem,
                            'labelColOptions' => ['style' => 'width:10%'],
                            'valueColOptions' => ['style' => 'width:10%'],
                        ],
                    ],
                ],
                [
                    'columns' => [
                        [
                            'attribute' => 'activity_id',
                            'value' => $act,
                            'labelColOptions' => ['style' => 'width:15%'],
                            'valueColOptions' => ['style' => 'width:85%'],
                        ],
                    ],
                ],
                [
                    'columns' => [
                        [
                            'attribute' => 'name',
                            'labelColOptions' => ['style' => 'width:15%'],
                            'valueColOptions' => ['style' => 'width:85%'],
                        ],
                    ],
                ],
                      
       
                [
                    'columns' => [
                      
                        [
                            'attribute' => 'mo_1_amount',
                            'displayOnly' => true,
                            'format' => ['decimal', 2],
                            'labelColOptions' => ['style' => 'width:5%'],
                            'valueColOptions' => ['style' => 'width:10%'],
                        ],
                        [
                            'attribute' => 'mo_2_amount',
                            'displayOnly' => true,
                            'format' => ['decimal', 2],
                            'labelColOptions' => ['style' => 'width:5%'],
                            'valueColOptions' => ['style' => 'width:10%'],
                        ],
                        [
                            'attribute' => 'mo_3_amount',
                            'displayOnly' => true,
                            'format' => ['decimal', 2],
                            'labelColOptions' => ['style' => 'width:5%'],
                            'valueColOptions' => ['style' => 'width:10%'],
                        ],
//                        [
//                            'attribute' => 'quarter_one_quantity',
//                            'label' => 'Q1 Qty',
//                            'format' => ['decimal', 2],
//                            'labelColOptions' => ['style' => 'width:8%'],
//                            'valueColOptions' => ['style' => 'width:15%'],
//                        ],
                        [
                             'attribute' => 'quarter_one_amount',
                            'label' => 'Q1 Budget',
                           // 'value' => $model->unit_cost * $model->quarter_one_quantity,
                            'format' => ['decimal', 2],
                            'labelColOptions' => ['style' => 'width:12%'],
                            'valueColOptions' => ['style' => 'width:20%'],
                            // hide this in edit mode by adding `kv-edit-hidden` CSS class
                            'rowOptions' => ['class' => 'warning kv-edit-hidden', 'style' => 'border-top: 5px double #dedede'],
                        ],
                    ]
                ],
                [
                    'columns' => [
                  
                        [
                            'attribute' => 'mo_4_amount',
                            'displayOnly' => true,
                            'format' => ['decimal', 2],
                            'labelColOptions' => ['style' => 'width:5%'],
                            'valueColOptions' => ['style' => 'width:10%'],
                        ],
                        [
                            'attribute' => 'mo_5_amount',
                            'displayOnly' => true,
                            'format' => ['decimal', 2],
                            'labelColOptions' => ['style' => 'width:5%'],
                            'valueColOptions' => ['style' => 'width:10%'],
                        ],
                        [
                            'attribute' => 'mo_6_amount',
                            'displayOnly' => true,
                            'format' => ['decimal', 2],
                            'labelColOptions' => ['style' => 'width:5%'],
                            'valueColOptions' => ['style' => 'width:10%'],
                        ],

                        [
                             'attribute' => 'quarter_two_amount',
                            'label' => 'Q2 Budget',
                           // 'value' => $model->unit_cost * $model->quarter_two_quantity,
                            'format' => ['decimal', 2],
                            'labelColOptions' => ['style' => 'width:12%'],
                            'valueColOptions' => ['style' => 'width:20%'],
                            // hide this in edit mode by adding `kv-edit-hidden` CSS class
                            'rowOptions' => ['class' => 'warning kv-edit-hidden', 'style' => 'border-top: 5px double #dedede'],
                        ],
                    ],
                ],
                [
                    'columns' => [
                        [
                            'attribute' => 'mo_7_amount',
                            'displayOnly' => true,
                            'format' => ['decimal', 2],
                            'labelColOptions' => ['style' => 'width:5%'],
                            'valueColOptions' => ['style' => 'width:10%'],
                        ],
                        [
                            'attribute' => 'mo_8_amount',
                            'displayOnly' => true,
                            'format' => ['decimal', 2],
                            'labelColOptions' => ['style' => 'width:5%'],
                            'valueColOptions' => ['style' => 'width:10%'],
                        ],
                        [
                            'attribute' => 'mo_9_amount',
                            'displayOnly' => true,
                            'format' => ['decimal', 2],
                            'labelColOptions' => ['style' => 'width:5%'],
                            'valueColOptions' => ['style' => 'width:10%'],
                        ],
//                        [
//                            'attribute' => 'quarter_three_quantity',
//                            'label' => 'Q3 Qty',
//                            'displayOnly' => true,
//                            'format' => ['decimal', 2],
//                            'labelColOptions' => ['style' => 'width:8%'],
//                            'valueColOptions' => ['style' => 'width:15%'],
//                        ],
                        [
                             'attribute' => 'quarter_three_amount',
                            'label' => 'Q3 Budget',
                           // 'value' => $model->unit_cost * $model->quarter_three_quantity,
                            'format' => ['decimal', 2],
                            'labelColOptions' => ['style' => 'width:12%'],
                            'valueColOptions' => ['style' => 'width:20%'],
                            // hide this in edit mode by adding `kv-edit-hidden` CSS class
                            'rowOptions' => ['class' => 'warning kv-edit-hidden', 'style' => 'border-top: 5px double #dedede'],
                        ],
                    ],
                ],
                [
                    'columns' => [
                        [
                            'attribute' => 'mo_10_amount',
                            'displayOnly' => true,
                            'format' => ['decimal', 2],
                            'labelColOptions' => ['style' => 'width:5%'],
                            'valueColOptions' => ['style' => 'width:10%'],
                        ],
                        [
                            'attribute' => 'mo_11_amount',
                            'displayOnly' => true,
                            'format' => ['decimal', 2],
                            'labelColOptions' => ['style' => 'width:5%'],
                            'valueColOptions' => ['style' => 'width:10%'],
                        ],
                        [
                            'attribute' => 'mo_12_amount',
                            'displayOnly' => true,
                            'format' => ['decimal', 2],
                            'labelColOptions' => ['style' => 'width:5%'],
                            'valueColOptions' => ['style' => 'width:10%'],
                        ],

                        [
                             'attribute' => 'quarter_four_amount',
                            'label' => 'Q4 Budget',
                           // 'value' => $model->unit_cost * $model->quarter_four_quantity,
                            'format' => ['decimal', 2],
                            'labelColOptions' => ['style' => 'width:12%'],
                            'valueColOptions' => ['style' => 'width:20%'],
                            // hide this in edit mode by adding `kv-edit-hidden` CSS class
                            'rowOptions' => ['class' => 'warning kv-edit-hidden', 'style' => 'border-top: 5px double #dedede'],
                        ],
                    ],
                ],
                    
                         [
                    'columns' => [

                        [
                            'attribute' => 'total_amount',
                            'label' => 'Total Budget',
                            'displayOnly' => true,
                            'format' => ['decimal', 2],
                            'labelColOptions' => ['style' => 'width:15%'],
                            'valueColOptions' => ['style' => 'width:30%'],
                        ],
                    ],
                ],
        
                
                ];
            ?>
                <?=
                DetailView::widget([
                    'model' => $model,
                    'hAlign' => 'left',
                    'attributes' => $attributes,
                ])
                ?>

            </div></div>

         
        <div clas="row">
            <div class="col-lg-12">
                <div class="card card-success card-outline card-tabs">
                    <div class="card-header p-0 pt-1 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="activities-tab" data-toggle="pill" href="#activities" role="tabs" aria-controls="activities" aria-selected="true"><b>Inputs</b></a>
                            </li>

                          
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-two-tabContent">


                            <div class="tab-pane fade show active" id="activities" role="tabpanel" aria-labelledby="activities-tab">
                <?php

$budget = \backend\models\AwpbInput::find()->where(['budget_id'=>$model->id])->sum('total_amount');
$unsubmitted_input = \backend\models\AwpbActualInput::find()->where(['budget_id'=>$model->id])->sum('quarter_amount');

                 
                 $total = $unsubmitted_input + $funds_requested;
                 $balance =  $budget -   $total;
 //$gridColumns ="";
//$id2="";
?>
  <div class="form-group row mb-0">
   
            <div class="col-sm-12">
<!--               <h5><p style='margin:4px; text-align: right;padding:4px;display:inline-block;' class='alert alert-success'> You have </p></h5><br>-->
           
                <?php
                //      Yii::$app->formatter->asDecimal( $balance).
            if ($balance>0) {
               echo Html::a('<i class="fa fa-plus "></i> Add AWPB Input', ['awpb-actual-input/create', 'id'=>$model->id], ['class' => 'btn btn-success btn-sm float-right']);
           }
            echo Html::a('<i class="fa fa-plus "></i> Add AWPB Input', ['awpb-actual-input/create', 'id'=>$model->id], ['class' => 'btn btn-success btn-sm float-right']);
  
        ?>
            </div></div>
  <?php
                  $gridColumns = [
          [
    'class'=>'kartik\grid\SerialColumn',
    'contentOptions'=>['class'=>'kartik-sheet-style'],
    'width'=>'36px',
    
],

      [
                            'class' => 'kartik\grid\EditableColumn',
                            'label' => 'Quarter',
                            'attribute' => 'quarter_number',
                            'readonly' => true,
                            'filter' => false,
                            'editableOptions' => [
                                'header' => 'Name',
                                'inputType' => \kartik\editable\Editable::INPUT_TEXT,
                            ],
                            'hAlign' => 'left',
                            'vAlign' => 'left',
                         'width' => '7%',
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
                            'attribute' => 'mo_1',
                            'readonly' => true,
                            'refreshGrid' => true,'filter' => false,
                            'editableOptions' => [
                                'header' => 'Month 1 Quantity',
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
                                'header' => 'Month 2 Quantity',
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
                                'header' => 'Month 3 Quantity',
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
                            'attribute' => 'quarter_quantity',
                            'readonly' => true,
                            'refreshGrid' => true,'filter' => false,
                            'editableOptions' => [
                                'header' => 'Q4 Quantity',
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
                            'attribute' => 'quarter_amount',
                             'label' => 'Quarter Budget',
                            'readonly' => true,
                            'refreshGrid' => true,'filter' => false,
                            'editableOptions' => [
                                'header' => 'Quarter Budget',
                                'inputType' => \kartik\editable\Editable::INPUT_SPIN,
                                'options' => [
                                    'pluginOptions' => ['min' => 0, 'max' => 999999999999999999999]
                                ]
                            ],
                            'hAlign' => 'right',
                            'vAlign' => 'middle',
                            'width' => '10%',
                            'format' => ['decimal', 2],
                            'pageSummary' => true
                        ],
                        
                                    
                               
                    ['class' => 'yii\grid\ActionColumn',
                    'options' => ['style' => 'width:150px;'],
                    'template' => '{view}{update}',
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
                        'update' => function ($url, $model) use ($user) {
 if (User::userIsAllowedTo('Request Funds') && ($user->district_id > 0 || $user->district_id != '')) {  
                return Html::a(
                                                '<span class="fas fa-edit"></span>', ['awpb-actual-input/update', 'id' => $model->id,], [
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

                    ]
                ]
                    ];
                         $searchModel = new \backend\models\AwpbActualInputSearch();
$dataProvider="";

$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

$dataProvider->query->andFilterWhere(['=','budget_id',$model->id])->andFilterWhere(['=','status',0]);

 
  
  
  
//if ($dataProvider->getCount() > 0) {
//
////    // echo ' </p>';
////    echo ExportMenu::widget([
////        'dataProvider' => $dataProvider,
////        'columns' => $gridColumns,
////        'fontAwesome' => true,
////        'dropdownOptions' => [
////            'label' => 'Export All',
////            'class' => 'btn btn-default'
////        ],
////        'filename' => 'AWPB Activity Lines' . date("YmdHis")
////    ]);
//}

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
//}
//    else {
//            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
//            return $this->render(['site/home']);
//        }
?>
                            </div>
                           
                        </div>
                    </div>
                       </div>
                </div>
                        <!-- /.card -->
                
            </div>
                 </div> </div>             
        

