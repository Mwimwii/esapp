<?php

/////use kartik\editable\Editable;
//use kartik\grid\EditableColumn;
//use kartik\grid\GridView;
//use yii\helpers\Html;
//use kartik\form\ActiveForm;
//use yii\grid\ActionColumn;
//use backend\models\User;
//use \kartik\popover\PopoverX;
//use kartik\depdrop\DepDrop;
//use yii\helpers\Url;
use kartik\export\ExportMenu;
//use kartik\money\MaskMoney;
//use yii\helpers\ArrayHelper;
//use yii\helpers\Json;
//use yii\data\ActiveDataProvider;
//use ivankff\yii2ModalAjax\ModalAjax;
use backend\models\AwpbActivityLine;
use backend\models\AwpbActivityLineSearch;
//use yii\web\Controller;
use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;
use yii\data\ActiveDataProvider;
use backend\models\User;
use kartik\form\ActiveForm;
use kartik\number\NumberControl;
use kartik\editable\Editable;
use kartik\grid\EditableColumn;
use yii\grid\ActionColumn;
use kartik\touchspin\TouchSpin;
use ivankff\yii2ModalAjax\ModalAjax;
use yii\helpers\ArrayHelper;
use backend\models\AwpbBudget;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CommodityPriceCollectionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */



$this->title = 'AWPB Activities';
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
  
            <div class="col-md-3">
               
        <ul>          
            <li>Click "<span class="badge badge-success">Add</span>" button  to add an AWPB Activity.</li>
            
        </ul>
            </div>
               <div class="col-md-2">
               
        <ul>          
            <li>Click "<span style="color:#007bff;"><i class="fa fa-edit"></i></span>" to edit an AWPB Activity.</li>
          
        </ul>
            </div>
              <div class="col-md-2">
               
        <ul>          
             <li>Click "<span style="color:#007bff;"><i class="fa fa-trash"></i></span>" to delete an AWPB Activity.</li>
             
        </ul>
            </div>
              <div class="col-md-2">
               
        <ul>          
            
              <li>Click "<span style="color:#007bff;"><i class="fa fa-eye"></i></span>" to view an AWPB Activity.</li>
        </ul>
            </div>  
            <div class="col-md-3">      
        <ul>  
            <?php
         if (User::userIsAllowedTo("Approve AWPB - Provincial")  && ($user->province_id > 0 || $user->province_id !== '')){
   
         echo "<li>Budget Review Deadline:" .$template_model->review_deadline. "</li>"; 
        }
      elseif(User::userIsAllowedTo('Approve AWPB - PCO') && ( $user->province_id == 0 || $user->province_id == ''))
        {
         echo "<li>Budget Submission Deadline:" . $template_model->incorpation_deadline_pco_moa_mfl . "</li>"; 
         }
         elseif (User::userIsAllowedTo("Approve AWPB - Ministry")  &&  ( $user->province_id == 0 || $user->province_id == '')){
   
         echo "<li>Budget Review Deadline:" .$template_model->submission_deadline_ifad. "</li>"; 
        }
 else {
     echo "";
 }
         ?>
        
        </ul>
            </div>
        </div>
   <p>
        
            
<?php
//   echo Html::a('<span class="fas fa-arrow-left fa-2x float-left"></span>', ['mpc', 'id' => $awpb_template_id,'id2'=>$province_id,'status'=> $status], [
//    'title' => 'back',
//    'data-toggle' => 'tooltip',
//    'data-placement' => 'top',
//]);
//  
//
//   echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
//    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";

     
if(User::userIsAllowedTo('Approve AWPB - PCO')&& strtotime($template_model->incorpation_deadline_pco_moa_mfl) >= strtotime($today)&& ( $user->province_id == 0 || $user->province_id == '')) {
            
                 echo "  <div class='row'>";
  
              echo "<div class='col-md-2'>";
                
                echo Html::a('Add a District AWPB Activity', ['createcspco','template_id'=>$template_model->id], ['class' => 'btn btn-success btn-sm']);
                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                   echo "</div>";
                      echo "<div class='col-md-2'>";
                 echo Html::a('Add an Programm-wide AWPB Activity', ['createcspco','template_id'=>$template_model->id], ['class' => 'btn btn-success btn-sm']);
                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                   echo "</div>";
                    echo "<div class='col-md-3'>";
                    echo "</div>";
                     echo "</div>";
           }
           if (User::userIsAllowedTo("Approve AWPB - Provincial") &&  !empty($template_model)&& strtotime($template_model->review_deadline) >= strtotime($today) && ($user->province_id > 0 || $user->province_id !== '')){
         
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
                    'pageSummaryOptions' => ['colspan' => 3],
                    'header' => '',
                    'headerOptions' => ['class' => 'kartik-sheet-style']
                ],
                [
                    'attribute' => 'component_id',
                    'label' => 'Component',
                    'vAlign' => 'middle',
                    'width' => '7%',
                    'value' => function ($model, $key, $index, $widget) {
                        $component = \backend\models\AwpbComponent::findOne(['id' => $model->component_id]);

                        return !empty($component) ? $component->code : "";
                    },
                    'filterType' => GridView::FILTER_SELECT2,
                    'filter' => ArrayHelper::map(backend\models\AwpbComponent::find()->orderBy('code')->asArray()->all(), 'id', 'code'),
                    'filterWidgetOptions' => [
                        'pluginOptions' => ['allowClear' => true],
                        'options' => ['multiple' => true]
                    ],
                    'filterInputOptions' => ['placeholder' => 'Filter by component'],
                    'format' => 'raw'
                ],
                [
                    'attribute' => 'activity_id',
                    'label' => 'Activity',
                    'vAlign' => 'middle',
                    //'width' => '180px',
                    'value' => function ($model) {
//                        $name = \backend\models\AwpbActivity::findOne(['id' => $model->activity_id]);
//
//                        return $name->activity_code . ' ' . $name->name;
                        
                           return !empty($model->activity_id) && $model->activity_id > 0 ? Html::a(backend\models\AwpbActivity::findOne($model->activity_id)->name, ['viewp', 'id' => $model->id,'status' => $model->id ], ['class' => 'mpcd']) : "";
                 
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
            'attribute' => 'camp_id',
            'label' => 'Camp', 
            'vAlign' => 'middle',
            'width' => '180px',

            'value' => function ($model) {
               
            
             return !empty($model->camp_id) && $model->camp_id > 0 ? \backend\models\Camps::findOne(['id' => $model->camp_id])->name : "";
             
            },
           
            'filterType' => GridView::FILTER_SELECT2,
            'filter' =>  \backend\models\Camps::getListByDistrictId($user->district_id), 
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
                'options' => ['multiple' => true]
            ],
            'filterInputOptions' => ['placeholder' => 'Filter by camp'],
            'format' => 'raw'
        ],
                [
                    'class' => 'kartik\grid\EditableColumn',
                    'attribute' => 'quarter_one_amount',
                    'readonly' => true,
                    //='readonly' => function($model, $key, $index, $widget) {
                    //    return (!$model->status); // do not allow editing of inactive records
                    // },
                    'filterType' => false,
                    'refreshGrid' => true,
                    'editableOptions' => [
                        'header' => 'Q1 Budget',
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
                        'header' => 'Q2 Budget',
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
                        'header' => 'Q3 Budget',
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
                        'header' => 'Q4 Budget',
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
                // [
                //     'class' => 'kartik\grid\FormulaColumn', 
                //     'attribute' => 'total_quantity', 
                //     'header' => 'Total <br> Quantity', 
                //    // 'refreshGrid' => true,
                //     'vAlign' => 'middle',
                //     'value' => function ($model, $key, $index, $widget) { 
                //         $p = compact('model', 'key', 'index');
                //         return $widget->col(6, $p)+$widget->col(7, $p)+$widget->col(8, $p) + $widget->col(9, $p);
                //     },
                //     'headerOptions' => ['class' => 'kartik-sheet-style'],
                //     'hAlign' => 'right', 
                //     'width' => '7%',
                //     'format' => ['decimal', 2],
                //     'mergeHeader' => true,
                //     'pageSummary' => true,
                //     'footer' => true
                // ],
                // [
                //     'class' => 'kartik\grid\FormulaColumn', 
                //     'attribute' => 'total_amount', 
                //     'header' => 'Total <br> Amount', 
                //     'vAlign' => 'middle',
                //     'hAlign' => 'right', 
                //     'width' => '7%',
                //     'value' => function ($model, $key, $index, $widget) { 
                //         $p = compact('model', 'key', 'index');
                //         return $widget->col(10, $p) != 0 ? $widget->col(5, $p) * $widget->col(10, $p) : 0;
                //     },
                //     'format' => ['decimal', 2],
                //     'headerOptions' => ['class' => 'kartik-sheet-style'],
                //     'mergeHeader' => true,
                //     'pageSummary' => true,
                //     'pageSummaryFunc' => GridView::F_SUM,
                //     'footer' => true
                // ],
//                         [
//            'attribute' => 'total_amount',
//            'label' => 'Budget', 
//            'vAlign' => 'middle',
//            'width' => '180px',
//
//            'value' => function ($model) {
//               //  \backend\models\AwpbInput::findOne(['id' =>  $model->indicator_id])->name;
//               $total_amount =\backend\models\AwpbInput::find()->where(['budget_id'=>$model->id])->sum('total_amount');
//                return $total_amount; // Html::a($name, ['awpb-ind/view', 'id' => $model->indicator_id], ['class' => 'awbp-indicator']);
//            },
//           
//          
//        ],
                [
                    'class' => 'kartik\grid\EditableColumn',
                    'attribute' => 'total_amount',
                    'label' => 'Budget',
                    'readonly' => true,
                    //'readonly' => function($model, $key, $index, $widget) {
                    //    return (!$model->status); // do not allow editing of inactive records
                    // },
//                    'value' => function ($model) {
//                        //  \backend\models\AwpbInput::findOne(['id' =>  $model->indicator_id])->name;
//                        $total_amount = \backend\models\AwpbInput::find()->where(['budget_id' => $model->id])->sum('total_amount');
//                        return $total_amount; // Html::a($name, ['awpb-ind/view', 'id' => $model->indicator_id], ['class' => 'awbp-indicator']);
//                    },
                    'refreshGrid' => true,
                    'editableOptions' => [
                        'header' => 'Budget',
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
                // // //'id',
                // [
                //     'class' => 'kartik\grid\CheckboxColumn',
                //     'headerOptions' => ['class' => 'kartik-sheet-style'],
                //     'pageSummary' => '<small>(amounts in $)</small>',
                //     'pageSummaryOptions' => ['colspan' => 3, 'data-colspan-dir' => 'rtl']
                // ],
                ['class' => 'yii\grid\ActionColumn',
                    'options' => ['style' => 'width:100px;'],
                    'header' => 'Action',
                    'template' => '{view}{create}',
                    'buttons' => [
                        'view' => function ($url, $model) use ($status) {
                         //   if (User::userIsAllowedTo('View AWPB') || User::userIsAllowedTo('Manage AWPB')) {
                                return Html::a(
                                                '<span class="fa fa-eye"></span>', ['view', 'id' => $model->id, 'status' => $status], [
                                            'title' => 'View AWPB',
                                            'data-toggle' => 'tooltip',
                                            'data-placement' => 'top',
                                            'data-pjax' => '0',
                                            'style' => "padding:5px;",
                                            'class' => 'bt btn-lg'
                                                ]
                                );
                           //s }
                        },
                            'create' => function ($url, $model) use ($status) {
                     
                                return Html::a(
                                                '<span class="fa fa-comment"></span>', ['awpb-comment/create', 'id' => $model->activity_id, 'id2'=>$model->province_id,'id3'=>$model->district_id, 'status' =>0], [
                                            'title' => 'Comment',
                                            'data-toggle' => 'tooltip',
                                            'data-placement' => 'top',
                                            'data-pjax' => '0',
                                            'style' => "padding:5px;",
                                            'class' => 'bt btn-lg'
                                                ]
                                );
                          
                        },
                    ]
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
            }
            ?>


        <?=
        GridView::widget([
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