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

$this->title = 'AWPB PW Activity : ' . $model->name;
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
$cost_centre = "";
$cc = \backend\models\AwpbCostCentre::findOne(['id' => $model->cost_centre_id]);

if (!empty($cc)) {
    $cost_centre = $cc->name;
}
$time = new \DateTime('now');
$today = $time->format('Y-m-d');
$template_model =  \backend\models\AwpbTemplate::find()->where(['status' =>\backend\models\AwpbTemplate::STATUS_PUBLISHED])->one();

//$awpb_province  = \backend\models\AwpbProvince::findOne(['awpb_template_id'=>$model->awpb_template_id,'province_id'=>$model->province_id]);
//              
//if (!empty($awpb_province)) {
//  $status= $awpb_province->status;
//   
//}
?>




<div class="card card-success card-outline">
    <div class="card-body">
        <h1><?= Html::encode($this->title) ?></h1>

        <p>



<?php

//
//echo Html::a('<span class="fas fa-arrow-left fa-2x"></span>', ['mpcdoa','status'=>$status,'district_id' =>  $model->district_id,'province_id'=>$model->province_id,'awpb_template_id'=>$model->awpb_template_id,'output_id' => $model->output_id,'activity_id' => $model->activity_id], [
//    'title' => 'back',
//    'data-toggle' => 'tooltip',
//    'data-placement' => 'top',
//]);
//}


echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
if (\backend\models\User::userIsAllowedTo('Manage PW AWPB')|| User::userIsAllowedTo('Approve AWPB - PCO') ) {

if(strtotime($template_model->submission_deadline) >= strtotime($today) && $status == \backend\models\AwpbBudget::STATUS_DRAFT){
 
 
        echo Html::a(
                '<span class="fa fa-edit"></span>', ['updatepw', 'id' => $model->id,'status'=>$status], [
            'title' => 'Update AWPB',
            'data-toggle' => 'tooltip',
            'data-placement' => 'top',
            'data-pjax' => '0',
            'style' => "padding:20px;",
            'class' => 'bt btn-lg'
                ]
        );

        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
  if ($model->total_amount<= 0)
        {
        echo Html::a(
                '<span class="fa fa-trash"></span>', ['delete',  'id' => $model->id,'id2'=>$model->awpb_template_id,'status'=>$status], [
            'title' => 'Delete AWPB',
            'data-toggle' => 'tooltip',
            'data-placement' => 'top',
            'data' => [
                'confirm' => 'Are you sure you want to delete this AWPB?',
                'method' => 'post',
            ],
            'style' => "padding:5px;",
            'class' => 'bt btn-lg'
                ]
        );}
    
}}
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
//                        [
//                            'attribute' => 'unit_cost',
//                            'label' => 'Unit Cost',
//                            'displayOnly' => true,
//                            'format' => ['decimal', 2],
//                            'labelColOptions' => ['style' => 'width:10%'],
//                            'valueColOptions' => ['style' => 'width:10%'],
//                        ],
                        [
                            'attribute' => 'total_quantity',
                            'label' => 'Total Quantity',
                            'displayOnly' => true,
                            'format' => ['decimal', 2],
                            'labelColOptions' => ['style' => 'width:15%'],
                            'valueColOptions' => ['style' => 'width:20%'],
                        ],
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
                if (!empty($model->name)) {
                    
 if (User::userIsAllowedTo('Manage PW AWPB') && $status == \backend\models\AwpbBudget::STATUS_DRAFT && ($user->province_id==0 ||$user->province_id=='')) {
    
 
                echo Html::a('Add AWPB Input', ['awpb-input/create', 'id'=>$model->id], ['class' => 'float-right btn btn-success btn-sm btn-space']);
           
                  echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
             
   }
                    $searchModel = new \backend\models\AwpbInputSearch();

                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                    $dataProvider->query->andFilterWhere(['budget_id' =>$model->id]);

                    $gridColumns = [
//                        [
//                            'class' => 'kartik\grid\SerialColumn',
//                            'contentOptions' => ['class' => 'kartik-sheet-style'],
//                            'width' => '36px',
//                            'pageSummary' => 'Total',
//                            'pageSummaryOptions' => ['colspan' => 6],
//                            'header' => '',
//                            'headerOptions' => ['class' => 'kartik-sheet-style']
//                        ],
//                        [
//                            'attribute' => 'activity_id',
//                            'label' => 'Activity Code',
//                            'vAlign' => 'middle',
//                            'width' => '180px',
//                            'value' => function ($model) {
//                                $name = \backend\models\AwpbActivity::findOne(['id' => $model->activity_id])->activity_code;
//                                return Html::a($name, ['awpb-activity/view', 'id' => $model->activity_id], ['class' => 'awbp-activity']);
//                            },
//                            'filterType' => GridView::FILTER_SELECT2,
//                            'filter' => \backend\models\AwpbActivity::getAwpbActivitiesList($access_level),
//                            'filterWidgetOptions' => [
//                                'pluginOptions' => ['allowClear' => true],
//                                'options' => ['multiple' => true]
//                            ],
//                            'filterInputOptions' => ['placeholder' => 'Filter by activity'],
//                            'format' => 'raw'
//                        ],
//                        [
//                            'attribute' => 'awpb_template_id',
//                            'label' => 'Fiscal Year',
//                            'vAlign' => 'middle',
//                            'width' => '180px',
//                            'value' => function ($model) {
//                                $name = \backend\models\AwpbTemplate::findOne(['id' => $model->awpb_template_id])->fiscal_year;
//                                return Html::a($name, ['awpb-template/view', 'id' => $model->awpb_template_id], ['class' => 'awbp-template']);
//                            },
//                            'filterType' => GridView::FILTER_SELECT2,
//                            'filter' => \backend\models\AwpbActivity::getAwpbActivitiesList($access_level),
//                            'filterWidgetOptions' => [
//                                'pluginOptions' => ['allowClear' => true],
//                                'options' => ['multiple' => true]
//                            ],
//                            'filterInputOptions' => ['placeholder' => 'Filter by activity'],
//                            'format' => 'raw'
//                        ],
//                        [
//                            'label' => 'Activity Name',
//                            'value' => function ($model) {
//                                $name = \backend\models\AwpbActivity::findOne(['id' => $model->activity_id])->name;
//                                return $name;
//                            }
//                        ],
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
//                        [
//                            'class' => 'kartik\grid\FormulaColumn',
//                            'attribute' => 'total_quantity',
//                            'header' => 'Total Qty',
//                            // 'refreshGrid' => true,
//                            'filter' => false,
//                            'vAlign' => 'middle',
//                            'value' => function ($model, $key, $index, $widget) {
//                                $p = compact('model', 'key', 'index');
//                                return $widget->col(6, $p) + $widget->col(7, $p) + $widget->col(8, $p) + $widget->col(9, $p);
//                            },
//                            'headerOptions' => ['class' => 'kartik-sheet-style'],
//                            'hAlign' => 'right',
//                            'width' => '7%',
//                            'format' => ['decimal', 2],
//                          //  'mergeHeader' => true,
//                            'pageSummary' => true,
//                            'footer' => true
//                        ],
                             
//                            [
//                            'class' => 'kartik\grid\FormulaColumn',
//                            'attribute' => 'total_amount',
//                            'header' => 'Total Amt',
//                            'vAlign' => 'middle',
//                            'hAlign' => 'right',
//                            'width' => '7%',
//                            'filter' => false,
//                            'value' => function ($model, $key, $index, $widget) {
//                                $p = compact('model', 'key', 'index');
//                                return $widget->col(10, $p) != 0 ? $widget->col(5, $p) * $widget->col(10, $p) : 0;
//                            },
//                            'format' => ['decimal', 2],
//                            'headerOptions' => ['class' => 'kartik-sheet-style'],
//                          //  'mergeHeader' => true,
//                            'pageSummary' => true,
//                            'pageSummaryFunc' => GridView::F_SUM,
//                            'footer' => true
//                        ],
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
                    'buttons' => [
                        'view' => function ($url, $model) {
                           // if ( User::userIsAllowedTo('View AWPB') ) {
                                return Html::a(
                                                '<span class="fa fa-eye"></span>', ['awpb-input/viewpw', 'id' => $model->id], [
                                            'title' => 'View input',
                                            'data-toggle' => 'tooltip',
                                            'data-placement' => 'top',
                                            'data-pjax' => '0',
                                            'style' => "padding:5px;",
                                            'class' => 'bt btn-lg'
                                                ]
                                );
                           // }
                        },
                        'update' => function ($url, $model) use ($status, $user) {
 if (User::userIsAllowedTo('Manage PW AWPB') && $status == \backend\models\AwpbBudget::STATUS_DRAFT && ($user->province_id==0 ||$user->province_id=='')) {
    
   
  
                return Html::a(
                                                '<span class="fas fa-edit"></span>', ['awpb-input/update', 'id' => $model->id], [
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
                        'delete' => function ($url, $model) use ($status,$user) {
  if (User::userIsAllowedTo('Manage PW AWPB') && $status == \backend\models\AwpbBudget::STATUS_DRAFT && ($user->province_id==0 ||$user->province_id=='')) {
    
    
 
          return Html::a(
                                                '<span class="fa fa-trash"></span>', ['awpb-input/delete', 'id' => $model->id,'id2'=>$model->budget_id,'status'=>$status], [
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

//                    if ($dataProvider->getCount() > 0) {
//
//                        // echo ' </p>';
//                        echo ExportMenu::widget([
//                            'dataProvider' => $dataProvider,
//                            'columns' => $gridColumns,
//                            'fontAwesome' => true,
//                            'dropdownOptions' => [
//                                'label' => 'Export All',
//                                'class' => 'btn btn-default'
//                            ],
//                            'filename' => 'AWPB Input ' . date("YmdHis")
//                        ]);
//                    }
                    ?>


                                    <?=
                                    GridView::widget([
                                        'dataProvider' => $dataProvider,
                                        'filterModel' => $searchModel,
                                        'columns' => $gridColumns,
                                        'pjax' => true,
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