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
use backend\models\AwpbBudget;
use backend\models\AwpbActivityLineSearch;
use yii\web\Controller;
use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CommodityPriceCollectionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'AWPB by District';
//$province_id = backend\models\Districts::findOne([Yii::$app->getUser()->identity->district_id])->province_id;
$this->params['breadcrumbs'][] = $this->title;

//$this->params['breadcrumbs'][] = \backend\models\Provinces::findOne($province_id)->name;
//$this->params['breadcrumbs'][] = \backend\models\Districts::findOne([Yii::$app->getUser()->identity->district_id])->name;

$user = User::findOne(['id' => Yii::$app->user->id]);

$access_level = 1;
$time = new \DateTime('now');
$today = $time->format('Y-m-d');
$id=0;
$template_model = \backend\models\AwpbTemplate::find()->where(['status' => \backend\models\AwpbTemplate::STATUS_PUBLISHED])->one();
if (!empty($template_model)){
    $id= $template_model->id;
}
$awpb_province = \backend\models\AwpbProvince::findOne(['awpb_template_id' => $id, 'province_id' => $id2]);
$status = 100;
if (!empty($awpb_province)) {
    $status = $awpb_province->status;
}
//var_dump($status);
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
            if (User::userIsAllowedTo('Manage AWPB') &&  
                   !empty($template_model)&&
                   strtotime($template_model->review_deadline) >= strtotime($today) && 
                   ($user->province_id > 0 || $user->province_id != '')&&
                   ($user->district_id==0 ||$user->district_id== '') 
                   )
                   {
         echo "<li>Budget Review Deadline:" .$template_model->submission_deadline. "</li>"; 
        }
      elseif(User::userIsAllowedTo('Manage AWPB') && ( $user->province_id == 0 || $user->province_id == ''))
        {
         echo "<li>Budget Submission Deadline:" . $template_model->incorpation_deadline_pco_moa_mfl . "</li>"; 
         }
         elseif (User::userIsAllowedTo("Approve AWPB")  &&  ( $user->province_id == 0 || $user->province_id == '')){
   
         echo "<li>Budget Review Deadline:" .$template_model->submission_deadline_ifad. "</li>"; 
        }
 else {
     echo "";
 }
         ?>
        
        </ul>
            </div>
        </div>
   
        
            
            
<?php


                   
//        
// if ((User::userIsAllowedTo('Manage AWPB')  && ($user->province_id > 0 || $user->province_id !== ''))||
//         
//         (User::userIsAllowedTo('Manage AWPB') && ( $user->province_id == 0 || $user->province_id == ''))) {
//          


         if((User::userIsAllowedTo('Manage AWPB') || User::userIsAllowedTo('Manage PW AWPB'))&& strtotime($template_model->incorpation_deadline_pco_moa_mfl) >= strtotime($today)&& ( $user->province_id == 0 || $user->province_id == '')) {
            
                 echo "  <div class='row'>";
  
              echo "<div class='col-md-2'>";
                
                echo Html::a('Add a District AWPB Activity', ['createcspco','template_id'=>$template_model->id], ['class' => 'btn btn-success btn-sm']);
                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                   echo "</div>";
                      echo "<div class='col-md-2'>";
                 echo Html::a('Add a Programm-wide AWPB Activity', ['createpw','template_id'=>$template_model->id], ['class' => 'btn btn-success btn-sm']);
                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                   echo "</div>";
                    echo "<div class='col-md-3'>";
                    echo "</div>";
                     echo "</div>";
           }
           else if (User::userIsAllowedTo('Manage AWPB') && strtotime($template_model->submission_deadline) >= strtotime($today) && ($user->province_id > 0 || $user->province_id !== '')&&($user->district_id == 0 || $user->district_id == '')){
         
               echo "  <div class='row'>";
  
              echo "<div class='col-md-2'>";
                
                echo Html::a('Add a District AWPB Activity', ['createcspco','template_id'=>$template_model->id], ['class' => 'btn btn-success btn-sm']);
                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                   echo "</div>";
                      
                     echo "</div>";;
           }




?>


        </p>



<?php
$gridColumns = [
    [
        'class' => 'kartik\grid\SerialColumn',
        'contentOptions' => ['class' => 'kartik-sheet-style'],
        'width' => '36px',
        'pageSummary' => 'Total',
        'pageSummaryOptions' => ['colspan' => 2],
        'header' => '',
        'headerOptions' => ['class' => 'kartik-sheet-style']
    ],
    [
        'attribute' => 'awpb_template_id',
        'label' => 'Fiscal Year',
        'vAlign' => 'middle',
        'width' => '180px',
        'value' => function ($model) {
            $name = \backend\models\AwpbTemplate::findOne(['id' => $model->awpb_template_id])->fiscal_year;
            return $name; //Html::a($name, ['awpb-template/view', 'id' => $model->awpb_template_id], ['class' => 'awbp-template']);
        },
        'filterType' => GridView::FILTER_SELECT2,
        'filter' => \backend\models\AwpbActivity::getAwpbActivitiesList($access_level),
        'filterWidgetOptions' => [
            'pluginOptions' => ['allowClear' => true],
            'options' => ['multiple' => true]
        ],
        'filterInputOptions' => ['placeholder' => 'Filter by activity'],
        'format' => 'raw'
    ],
    [
        'attribute' => 'district_id',
        'format' => 'raw',
        'label' => 'District',
        'value' => function ($model) use ($status) {

            return !empty($model->district_id) && $model->district_id > 0 ? Html::a(backend\models\Districts::findOne($model->district_id)->name, ['mpcd', 'status' => $status, 'id' => $model->district_id, 'id2' => $model->province_id], ['class' => 'mpcd']) : "";
            ;
        },
    //     'visible' => !empty($model->district_id) && $model->district_id > 0 ? TRUE : FALSE,
    ],
    [
        'class' => 'kartik\grid\EditableColumn',
        'attribute' => 'quarter_one_amount',
        'readonly' => true,
        //='readonly' => function($model, $key, $index, $widget) {
        //    return (!$model->status); // do not allow editing of inactive records
        // },
        'refreshGrid' => true,
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
        'attribute' => 'quarter_two_amount',
        'readonly' => true,
        //'readonly' => function($model, $key, $index, $widget) {
        //    return (!$model->status); // do not allow editing of inactive records
        // },
        'refreshGrid' => true,
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
        'attribute' => 'quarter_three_amount',
        'readonly' => true,
        //'readonly' => function($model, $key, $index, $widget) {
        //    return (!$model->status); // do not allow editing of inactive records
        // },
        'refreshGrid' => true,
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
        'attribute' => 'quarter_four_amount',
        'readonly' => true,
        //'readonly' => function($model, $key, $index, $widget) {
        //    return (!$model->status); // do not allow editing of inactive records
        // },
        'refreshGrid' => true,
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
        'vAlign' => 'middle',
        'width' => '10%',
        'template' => '{mpcd}',
        'buttons' => [

            'mpcd' => function ($url, $model) use ($user, $template_model, $today) {
                    return Html::a(
                                    '<span class="fa fa-eye"></span>', ['mpcd', 'status' => 1, 'id' => $model->district_id, 'id2' => $model->province_id], [
                                'title' => 'View AWPB Activities',
                                'data-toggle' => 'tooltip',
                                'data-placement' => 'top',
                                // 'target' => '_blank',
                                'data-pjax' => '0',
                                // 'style' => "padding:5px;",
                                'class' => 'bt btn-lg'
                                    ]
                    );
                
            },
        ]]
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
        'filename' => 'AWPB' . date("YmdHis")
    ]);

    }
?>


        <?=
        GridView::widget([
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


    </div>
</div>

<?php
$this->registerCss('.popover-x {display:none}');
?>