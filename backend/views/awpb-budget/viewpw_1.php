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

$this->title = 'Programme-Wide AWPB Activity : ' . $model->name;
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
    <div class="card-body" style="overflow: auto;">
        <h1><?= Html::encode($template_model->fiscal_year) ?> <?= Html::encode($this->title) ?></h1>
        <div class="row">
  
            <div class="col-md-4">
               
        <ul>          
            <li>Click "<span class="badge badge-success">Add</span>" button  to add an AWPB Activity.</li>
            
        </ul>
            </div>
             
              <div class="col-md-4">
               
        <ul>          
            
              <li>Click "<span style="color:#007bff;"><i class="fa fa-eye"></i></span>" to view the District AWPB Activities.</li>
        </ul>
            </div>  
            <div class="col-md-4">      
        <ul>  
            <?php
            if (User::userIsAllowedTo("Approve AWPB")  &&  ( $user->province_id == 0 || $user->province_id == '')){
   
         echo "<li>Budget Review Deadline:" .$template_model->submission_deadline_ifad. "</li>"; 
        }
        elseif(User::userIsAllowedTo('Manage AWPB') && ( $user->province_id == 0 || $user->province_id == ''))
        {
         echo "<li>Budget Submission Deadline:" . $template_model->incorpation_deadline_pco_moa_mfl . "</li>"; 
         }
 else {
     echo "";
 }
         ?>
        
        </ul>
            </div>
        </div>



        <?php
        
                
 

           if(User::userIsAllowedTo('Manage AWPB')&& strtotime($template_model->incorpation_deadline_pco_moa_mfl) >= strtotime($today)&& ( $user->province_id == 0 || $user->province_id == '')) {
            
                 echo "  <div class='row'>";
  
              echo "<div class='col-md-2'>";
                
                
        echo Html::a(
                '<span class="fa fa-edit">'. $status.'</span>', ['updatepw', 'id' => $model->id,'status'=>$status], [
            'title' => 'Update AWPB',
            'data-toggle' => 'tooltip',
            'data-placement' => 'top',
            'data-pjax' => '0',
            'style' => "padding:20px;",
            'class' => 'bt btn-lg'
                ]
        );

                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                   echo "</div>";
                      echo "<div class='col-md-2'>";
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
    
}
                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                   echo "</div>";
                    echo "<div class='col-md-3'>";
                    echo "</div>";
                     echo "</div>";
           



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
                    
                     if ((User::userIsAllowedTo('Manage AWPB') && ($user->district_id > 0 || $user->district_id != '') && strtotime($template_model->submission_deadline) >= strtotime($today) )||
         (User::userIsAllowedTo('Manage AWPB')&& strtotime($template_model->incorpation_deadline_pco_moa_mfl) >= strtotime($today) && ( $user->province_id == 0 || $user->province_id == ''))||
         (User::userIsAllowedTo('Manage AWPB') && strtotime($template_model->review_deadline) >= strtotime($today) &&
                 ($user->province_id > 0 || $user->province_id !== ''))){
  
                echo Html::a('Add AWPB Input', ['awpb-input/create', 'id'=>$model->id], ['class' => 'float-right btn btn-success btn-sm btn-space']);
           
                  echo "<br \>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
             
   }
                    $searchModel = new \backend\models\AwpbInputSearch();

                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                    $dataProvider->query->andFilterWhere(['budget_id' =>$model->id]);

                    $gridColumns = [

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
                    'buttons' => [
                        'view' => function ($url, $model) {
                            if ( User::userIsAllowedTo('View AWPB')||User::userIsAllowedTo('Manage AWPB') ) {
                                return Html::a(
                                                '<span class="fa fa-eye"></span>', ['awpb-input/view', 'id' => $model->id], [
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
                        'update' => function ($url, $model) use ($status, $user,$template_model,$today) {
 if ((User::userIsAllowedTo('Manage AWPB') && ($user->district_id > 0 || $user->district_id != '') && strtotime($template_model->submission_deadline) >= strtotime($today) )||
         (User::userIsAllowedTo('Manage AWPB')&& strtotime($template_model->incorpation_deadline_pco_moa_mfl) >= strtotime($today) && ( $user->province_id == 0 || $user->province_id == ''))||
         (User::userIsAllowedTo('Manage AWPB') && strtotime($template_model->review_deadline) >= strtotime($today)
                 && ($user->province_id > 0 || $user->province_id !== ''))){
  
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
                        'delete' => function ($url, $model) use ($status,$user,$template_model,$today) {
                          if ((User::userIsAllowedTo('Manage AWPB') && ($user->district_id > 0 || $user->district_id != '') && strtotime($template_model->submission_deadline) >= strtotime($today) )||
         (User::userIsAllowedTo('Manage AWPB')&& strtotime($template_model->incorpation_deadline_pco_moa_mfl) >= strtotime($today) && ( $user->province_id == 0 || $user->province_id == ''))||
         (User::userIsAllowedTo('Manage AWPB') && strtotime($template_model->review_deadline) >= strtotime($today) 
                 && ($user->province_id > 0 || $user->province_id !== ''))){
  
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
