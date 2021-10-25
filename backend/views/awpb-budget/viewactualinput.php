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

$this->title = 'AWPB Activity: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'AWPB', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->id;
\yii\web\YiiAsset::register($this);

$user = User::findOne(['id' => Yii::$app->user->id]);
$access_level = 1;
$act = "";
$fis = "";
$activity = \backend\models\AwpbActivity::findOne(['id' => $model->activity_id]);
//$status = $model->status;
if (!empty($activity)) {
    $act = $activity->name;
    $fis = $activity->awpb_template_id;
}

$tem = "";
$template_model = \backend\models\AWPBTemplate::findOne(['id' => $model->awpb_template_id]);

if (!empty($template_model)) {
    $tem = $template_model->fiscal_year;
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

 $awpb_district =  \backend\models\AwpbDistrict::findOne(['awpb_template_id' =>$model->awpb_template_id, 'district_id'=>$user->district_id]);
$status=100;
if (!empty($awpb_district)) {
  $status= $awpb_district->status;
   
}
$cost_centre = "";
$cc = \backend\models\AwpbCostCentre::findOne(['id' => $model->cost_centre_id]);

if (!empty($cc)) {
    $cost_centre = $cc->name;
}
?>




<div class="card card-success card-outline">
    <div class="card-body">
        <h1><?= Html::encode($tem) ?> <?= Html::encode($this->title) ?></h1>

        <p>


    <div clas="row">
            <div class="col-lg-12">

            <?php
            $attributes = [
          
                [
                    'columns' => [
                        [
                            'attribute' => 'province_id',
                            'label' => 'Province',
                            'displayOnly' => true,
                            'labelColOptions' => ['style' => 'width:7%'],
                            'valueColOptions' => ['style' => 'width:15%'],
                            'value' => $pro,
                        ],
                        [
                            'attribute' => 'district_id',
                            'label' => 'District',
                            'displayOnly' => true,
                            'labelColOptions' => ['style' => 'width:7%'],
                            'valueColOptions' => ['style' => 'width:15%'],
                            'value' => $dist,
                        ],
                           [
                            'attribute' => 'camp_id',
                            'label' => 'Camp',
                            'displayOnly' => true,
                            'labelColOptions' => ['style' => 'width:6%'],
                            'valueColOptions' => ['style' => 'width:10%'],
                            'value' => $cam,
                        ],
                         [
                            'attribute' => 'cost_centre_id',
                            'label' => 'Cost Centre',
                            'displayOnly' => true,
                            'labelColOptions' => ['style' => 'width:10%'],
                            'valueColOptions' => ['style' => 'width:20%'],
                            'value' => $cost_centre,
                        ],
                        [
                            'label' => 'Fiscal Year',
                            'format' => 'raw',
                            'value' => $tem,
                            'labelColOptions' => ['style' => 'width:5%'],
                            'valueColOptions' => ['style' => 'width:5%'],
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
                            'attribute' => 'number_of_females',
                            'label' => 'Females',
                            'displayOnly' => true,
                           // 'format' => ['decimal', 2],
                            'labelColOptions' => ['style' => 'width:5%'],
                            'valueColOptions' => ['style' => 'width:10%'],
                        ],
                        [
                            'attribute' => 'number_of_males',
                            'label' => 'Males',
                            'displayOnly' => true,
                          //  'format' => ['decimal', 2],
                            'labelColOptions' => ['style' => 'width:5%'],
                            'valueColOptions' => ['style' => 'width:10%'],
                        ],
                        [
                          'attribute' => 'number_of_young_people',
                            'displayOnly' => true,
                            'label' => 'Young',
                            //'format' => ['decimal', 2],
                            'labelColOptions' => ['style' => 'width:5%'],
                            'valueColOptions' => ['style' => 'width:10%'],
                        ],
                        [
                            'attribute' => 'number_of_not_young_people',
                            'label' => 'Not young',
                            'displayOnly' => true,
                           // 'format' => ['decimal', 2],
                            'labelColOptions' => ['style' => 'width:8%'],
                            'valueColOptions' => ['style' => 'width:15%'],
                        ],
                       
                    ],
                ],
            
                
                                    [
                    'columns' => [
                        [
                            'attribute' => 'number_of_women_headed_households',
                              'label' => 'Women headed households',
                            'displayOnly' => true,
                           // 'format' => ['decimal', 2],
                            'labelColOptions' => ['style' => 'width:10%'],
                            'valueColOptions' => ['style' => 'width:10%'],
                        ],
                        [
                          'attribute' => 'number_of_non_women_headed_households',
                               'label' => 'Non-women headed households',
                             'displayOnly' => true,
                          //  'format' => ['decimal', 2],
                            'labelColOptions' => ['style' => 'width:10%'],
                            'valueColOptions' => ['style' => 'width:10%'],
                        ],
                        [
                            'attribute' => 'number_of_household_members',
                            'label' => 'Household members',
                            'displayOnly' => true,
                           // 'format' => ['decimal', 2],
                            'labelColOptions' => ['style' => 'width:10%'],
                            'valueColOptions' => ['style' => 'width:10%'],
                        ],
                       
                       
                    ],
                ],
                
       
                [
                    'columns' => [
                      
                        [
                            'attribute' => 'mo_1',
                            'displayOnly' => true,
                            'format' => ['decimal', 2],
                            'labelColOptions' => ['style' => 'width:5%'],
                            'valueColOptions' => ['style' => 'width:10%'],
                        ],
                        [
                            'attribute' => 'mo_2',
                            'displayOnly' => true,
                            'format' => ['decimal', 2],
                            'labelColOptions' => ['style' => 'width:5%'],
                            'valueColOptions' => ['style' => 'width:10%'],
                        ],
                        [
                            'attribute' => 'mo_3',
                            'displayOnly' => true,
                            'format' => ['decimal', 2],
                            'labelColOptions' => ['style' => 'width:5%'],
                            'valueColOptions' => ['style' => 'width:10%'],
                        ],
                        [
                            'attribute' => 'quarter_one_quantity',
                            'label' => 'Q1 Qty',
                            'format' => ['decimal', 2],
                            'labelColOptions' => ['style' => 'width:8%'],
                            'valueColOptions' => ['style' => 'width:15%'],
                        ],
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
                            'attribute' => 'mo_4',
                            'displayOnly' => true,
                            'format' => ['decimal', 2],
                            'labelColOptions' => ['style' => 'width:5%'],
                            'valueColOptions' => ['style' => 'width:10%'],
                        ],
                        [
                            'attribute' => 'mo_5',
                            'displayOnly' => true,
                            'format' => ['decimal', 2],
                            'labelColOptions' => ['style' => 'width:5%'],
                            'valueColOptions' => ['style' => 'width:10%'],
                        ],
                        [
                            'attribute' => 'mo_6',
                            'displayOnly' => true,
                            'format' => ['decimal', 2],
                            'labelColOptions' => ['style' => 'width:5%'],
                            'valueColOptions' => ['style' => 'width:10%'],
                        ],
                        [
                            'attribute' => 'quarter_two_quantity',
                            'label' => 'Q2 Qty',
                            'format' => ['decimal', 2],
                            'labelColOptions' => ['style' => 'width:8%'],
                            'valueColOptions' => ['style' => 'width:15%'],
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
                            'attribute' => 'mo_7',
                            'displayOnly' => true,
                            'format' => ['decimal', 2],
                            'labelColOptions' => ['style' => 'width:5%'],
                            'valueColOptions' => ['style' => 'width:10%'],
                        ],
                        [
                            'attribute' => 'mo_8',
                            'displayOnly' => true,
                            'format' => ['decimal', 2],
                            'labelColOptions' => ['style' => 'width:5%'],
                            'valueColOptions' => ['style' => 'width:10%'],
                        ],
                        [
                            'attribute' => 'mo_9',
                            'displayOnly' => true,
                            'format' => ['decimal', 2],
                            'labelColOptions' => ['style' => 'width:5%'],
                            'valueColOptions' => ['style' => 'width:10%'],
                        ],
                        [
                            'attribute' => 'quarter_three_quantity',
                            'label' => 'Q3 Qty',
                            'displayOnly' => true,
                            'format' => ['decimal', 2],
                            'labelColOptions' => ['style' => 'width:8%'],
                            'valueColOptions' => ['style' => 'width:15%'],
                        ],
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
                            'attribute' => 'mo_10',
                            'displayOnly' => true,
                            'format' => ['decimal', 2],
                            'labelColOptions' => ['style' => 'width:5%'],
                            'valueColOptions' => ['style' => 'width:10%'],
                        ],
                        [
                            'attribute' => 'mo_11',
                            'displayOnly' => true,
                            'format' => ['decimal', 2],
                            'labelColOptions' => ['style' => 'width:5%'],
                            'valueColOptions' => ['style' => 'width:10%'],
                        ],
                        [
                            'attribute' => 'mo_12',
                            'displayOnly' => true,
                            'format' => ['decimal', 2],
                            'labelColOptions' => ['style' => 'width:5%'],
                            'valueColOptions' => ['style' => 'width:10%'],
                        ],
                        [
                            'attribute' => 'quarter_four_quantity',
                            'label' => 'Q4 Qty',
                            'displayOnly' => true,
                            'format' => ['decimal', 2],
                            'labelColOptions' => ['style' => 'width:8%'],
                            'valueColOptions' => ['style' => 'width:15%'],
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
                            'attribute' => 'total_quantity',
                            'label' => 'Total Quantity',
                            'displayOnly' => true,
                            'format' => ['decimal', 2],
                            'labelColOptions' => ['style' => 'width:10%'],
                            'valueColOptions' => ['style' => 'width:10%'],
                        ],
                        [
                            'attribute' => 'total_amount',
                            'label' => 'Total Budget',
                            'displayOnly' => true,
                            'format' => ['decimal', 2],
                            'labelColOptions' => ['style' => 'width:15%'],
                            'valueColOptions' => ['style' => 'width:25%'],
                        ],
                              [
                            'attribute' => 'total_actual_amount',
                            'label' => 'Total Actual Expenditure',
                            'displayOnly' => true,
                            'format' => ['decimal', 2],
                            'labelColOptions' => ['style' => 'width:15%'],
                            'valueColOptions' => ['style' => 'width:25%'],
                        ],
                        
                    ],
                ],
        
                
                ];
             $budget_amount = round($model->total_amount,2);
            $actual_amount =  round($model->total_actual_amount,2);
            
$actual_input_amount = round(\backend\models\AwpbActualInput::find()->where(['budget_id'=>$model->id])->sum('total_amount'),2);

                 
                 
                 $balance_actual_input =  round($budget_amount,2) -   round($actual_input_amount,2);
                  $balance_actual_exp =  round($budget_amount,2) -   round($actual_amount,2);
                
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
             
                if (!empty($model->name)) {
                     
  echo Html::a('<span class="btn btn-small btn-info"> <h6> Total Budget Less Actual Expenditure : '.   Yii::$app->formatter->asDecimal(round($balance_actual_exp,2)).'</h6></span>',"",  [
                                            'title' => '',
                                            'data-toggle' => 'tooltip',
                                            'data-placement' => '',
                                            'data-pjax' => '0',
                                            'style' => "padding:5px;",
                                            'class' => 'float-right bt btn-lg'
         
                                                ]
                                );
                             echo Html::a('<span class="btn btn-small btn-info"> <h6>Total Budget Less Actual Inputs   : '.   Yii::$app->formatter->asDecimal(round($balance_actual_input,2)).'</h6></span>',"",  [
                                            'title' => '',
                                            'data-toggle' => 'tooltip',
                                            'data-placement' => '',
                                            'data-pjax' => '0',
                                            'style' => "padding:5px;",
                                            'class' => 'float-right bt btn-lg'
         
                                                ]
                                );

                   
                    
                     if ((User::userIsAllowedTo('Manage AWPB') && ($user->district_id > 0 || $user->district_id != '') )||
         (User::userIsAllowedTo('Manage AWPB') && ( $user->province_id == 0 || $user->province_id == ''))||
         (User::userIsAllowedTo('Manage AWPB') && ($user->province_id > 0 || $user->province_id !== ''))){
  
                         if (round($actual_amount,2) < round($budget_amount,2) && round($balance_actual_input,2) > 0){
                            // $balance = $model->total_amount - $model->total_actual_amount;
                            // if($model->total_amount)
                //echo Html::a('Add AWPB Input', );
          //   echo Html::a('<i class="fa fa-plus"></i> Add component', ['create'], ['class' => 'btn btn-success btn-sm']);
               
                             
                             echo Html::a('<span class="btn btn-success"><h6> Add AWPB Input</h6></span>', ['awpb-actual-input/create', 'id'=>$model->id, ],  [
                                            'title' => 'Add AWPB Input',
                                            'data-toggle' => 'tooltip',
                                            'data-placement' => 'top',
                                            'data-pjax' => '0',
                                            'style' => "padding:5px;",
                                            'class' => 'float-right bt btn-lg'
         
                                                ]
                                );
                         }
                         
                         
         }
                    $searchModel = new \backend\models\AwpbActualInputSearch();

                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                    $dataProvider->query->andFilterWhere(['budget_id' =>$model->id]);
?>
           
                              
 <?php
                    $gridColumns = [
                                                [
                            'class' => 'kartik\grid\EditableColumn',
                            'label' => 'id',
                            'attribute' => 'id',
                            'readonly' => true,
                            'filter' => false,
                            'editableOptions' => [
                                'header' => 'id',
                                'inputType' => \kartik\editable\Editable::INPUT_TEXT,
                            ],
                            'hAlign' => 'left',
                            'vAlign' => 'left',
                        // 'width' => '7%',
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
                            'attribute' => 'quarter_one_quantity',
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
                            'attribute' => 'quarter_two_quantity',
                            'readonly' => true,

                            'refreshGrid' => true,'filter' => false,
                            'editableOptions' => [
                                'header' => 'Q2 Qty',
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
                            'attribute' => 'quarter_three_quantity',
                            'readonly' => true,
                            'refreshGrid' => true,'filter' => false,
                            'editableOptions' => [
                                'header' => 'Q3 Qty',
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
                            'attribute' => 'quarter_four_quantity',
                            'readonly' => true,
                            'refreshGrid' => true,'filter' => false,
                            'editableOptions' => [
                                'header' => 'Q4 Qty',
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
                            'attribute' => 'total_quantity',
                            'readonly' => true,
                            'refreshGrid' => true,'filter' => false,
                            'editableOptions' => [
                                'header' => 'Q4 Qty',
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
                            'attribute' => 'total_amount',
                            'readonly' => true,
                            'refreshGrid' => true,'filter' => false,
                            'editableOptions' => [
                                'header' => 'Q4 Qty',
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
                        'header'=>'Action',
                    'buttons' => [
                        'view' => function ($url, $model) use($actual_amount, $budget_amount) {
                            if ( User::userIsAllowedTo('View AWPB')||User::userIsAllowedTo('Manage AWPB') ) {
                                  if ($actual_amount < $budget_amount){
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
                            }}
                        },
                        'update' => function ($url, $model) use ($status, $user,$template_model,$today,$actual_amount,$budget_amount) {
 if ((User::userIsAllowedTo('Manage AWPB') && ($user->district_id > 0 || $user->district_id != '')  )||
         (User::userIsAllowedTo('Manage AWPB') && ( $user->province_id == 0 || $user->province_id == ''))||
         (User::userIsAllowedTo('Manage AWPB') && ($user->province_id > 0 || $user->province_id !== '') &&($user->district_id == 0 || $user->district_id == ''))){
   if ($actual_amount < $budget_amount){
                return Html::a(
                                                '<span class="fas fa-edit"></span>', ['awpb-actual-input/update', 'id' => $model->id], [
                                            'title' => 'Update input',
                                            'data-toggle' => 'tooltip',
                                            'data-placement' => 'top',
                                            // 'target' => '_blank',)
                                            'data-pjax' => '0',
                                            'style' => "padding:5px;",
                                            'class' => 'bt btn-lg'
                                                ]
    );}
                            }
                        },
                        'delete' => function ($url, $model) use ($status,$user,$template_model,$today,$actual_amount,$budget_amount) {
                          if ((User::userIsAllowedTo('Manage AWPB') && ($user->district_id > 0 || $user->district_id != '')  )||
         (User::userIsAllowedTo('Manage AWPB') && ( $user->province_id == 0 || $user->province_id == ''))||
          (User::userIsAllowedTo('Manage AWPB') && ($user->province_id > 0 || $user->province_id !== '') &&($user->district_id == 0 || $user->district_id == ''))){
    if ($actual_amount < $budget_amount){
          return Html::a(
                                                '<span class="fa fa-trash"></span>', ['awpb-actual-input/delete', 'id' => $model->id,'id2'=>$model->budget_id,'status'=>$status], [
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
         }}
                        },
                    ]
                ]
                    ];


                    ?>
   

                                    <?=
                                    GridView::widget([
                                        'dataProvider' => $dataProvider,
                                        'filterModel' => $searchModel,
                                        'columns' => $gridColumns,
                                       // 'pjax' => true,
                                        'filterModel' => null,
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
                                } else {
                                    $content_user = "<p>No activities have been selected</p>";
                                }
         
                                ?>
                            
                           
                        </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>

            </div>
                             
        </div>

    </div>

</div>
</div>