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
use backend\models\AwpbTemplate;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\CommodityPriceCollectionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'AWPB Activities';
//$province_id = backend\models\Districts::findOne([Yii::$app->getUser()->identity->district_id])->province_id;
$this->params['breadcrumbs'][] = $this->title;

//$this->params['breadcrumbs'][] = \backend\models\Provinces::findOne($province_id)->name;
//$this->params['breadcrumbs'][] = \backend\models\Districts::findOne([Yii::$app->getUser()->identity->district_id])->name;


$user = User::findOne(['id' => Yii::$app->user->id]);

$access_level =1;
$time = new \DateTime('now');
$today = $time->format('Y-m-d');
$template_model =  \backend\models\AwpbTemplate::find()->where(['status' =>\backend\models\AwpbTemplate::STATUS_PUBLISHED])->one();
 
 //$awpb_district->status=0;
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
               <div class="col-md-3">
               
        <ul>          
            <li>Click "<span style="color:#007bff;"><i class="fa fa-edit"></i></span>" to edit an AWPB Activity.</li>
          
        </ul>
            </div>
              <div class="col-md-3">
               
        <ul>          
             <li>Click "<span style="color:#007bff;"><i class="fa fa-trash"></i></span>" to delete an AWPB Activity.</li>
             
        </ul>
            </div>
              <div class="col-md-3">
               
        <ul>          
            
              <li>Click "<span style="color:#007bff;"><i class="fa fa-eye"></i></span>" to view an AWPB Activity.</li>
        </ul>
            </div>  </div>
            <div class="row">
               <div class="col-md-3">      
        <ul>              
            <li>Budget Submission Deadline: <?= Html::encode($template_model->submission_deadline) ?></li>  
        </ul>
            </div>
        </div>
   <p>
           
            <?php
   
          
    if (User::userIsAllowedTo('Manage AWPB') && !empty($template_model)&& $user->district_id>0 ||$user->district_id!='') {
       //if (User::userIsAllowedTo("Manage AWPB") || User::userIsAllowedTo("Approve AWPB - Provincial") || User::userIsAllowedTo('Approve AWPB - PCO') || User::userIsAllowedTo('Approve AWPB - Ministry')) {
                                 
        


if(strtotime($template_model->submission_deadline) >= strtotime($today)){
 
                echo Html::a('Add AWPB Activity', ['create','template_id'=>$template_model->id], ['class' => 'btn btn-success btn-sm']);
                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
          
                // echo  $template_model->submission_deadline ;
                // echo "<br /><br /><br /><br />";
                // echo  $today;
        }
    
            ?>

        </p>



        <?php
       $gridColumns = [
        [
            'class'=>'kartik\grid\SerialColumn',
            'contentOptions'=>['class'=>'kartik-sheet-style'],
            'width'=>'36px',
            'pageSummary'=>'Total',
            'pageSummaryOptions' => ['colspan' => 4],
            'header'=>'',
            'headerOptions'=>['class'=>'kartik-sheet-style']
        ],
        
        [
            'attribute' => 'component_id', 
            'label' => 'Component', 
            'vAlign' => 'middle',
            'width' => '150px',
            'value' => function ($model, $key, $index, $widget) {
                $component= \backend\models\AwpbComponent::findOne(['id' => $model->component_id]);						
            
            return     !empty( $component) ?  $component->code:"";
           
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
            'width' => '180px',

            'value' => function ($model) {
                $name =  \backend\models\AwpbActivity::findOne(['id' =>  $model->activity_id]);
            
            return     $name->activity_code .' '.$name->name;
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
                'attribute' => 'quarter_one_quantity', 
                'readonly' =>true,
                //='readonly' => function($model, $key, $index, $widget) {
                //    return (!$model->status); // do not allow editing of inactive records
               // },
               'filterType' =>false,
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
                'attribute' => 'quarter_three_quantity', 
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
                'attribute' => 'quarter_four_quantity', 
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
           
          
                    
                
                    
                           [
                'class' => 'kartik\grid\EditableColumn',
                           'attribute' => 'total_amount',
 'label' => 'Budget', 
                'readonly' =>true,
                //'readonly' => function($model, $key, $index, $widget) {
                //    return (!$model->status); // do not allow editing of inactive records
               // },
//                                'value' => function ($model) {
//               //  \backend\models\AwpbInput::findOne(['id' =>  $model->indicator_id])->name;
//               $total_amount =\backend\models\AwpbInput::find()->where(['budget_id'=>$model->id])->sum('total_amount');
//                return $total_amount; // Html::a($name, ['awpb-ind/view', 'id' => $model->indicator_id], ['class' => 'awbp-indicator']);
          //  },
               'refreshGrid' => true,
                'editableOptions' => [
                    'header' => 'Budget', 
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
           
                    
                    
                    
                    
            // // //'id',
            // [
            //     'class' => 'kartik\grid\CheckboxColumn',
            //     'headerOptions' => ['class' => 'kartik-sheet-style'],
            //     'pageSummary' => '<small>(amounts in $)</small>',
            //     'pageSummaryOptions' => ['colspan' => 3, 'data-colspan-dir' => 'rtl']
            // ],

     
                    ['class' => 'yii\grid\ActionColumn',
                    'options' => ['style' => 'width:50px;'],
                         'header' => 'Action', 
                    'template' => '{view}{update}{delete}',
                    'buttons' => [
                        'view' => function ($url, $model) use ($status){
                            if (  User::userIsAllowedTo('View AWPB')||User::userIsAllowedTo('Manage AWPB') ) {
                                return Html::a(
                                                '<span class="fa fa-eye"></span>', ['view', 'id' => $model->id,'status'=>$status], [
                                            'title' => 'View AWPB',
                                            'data-toggle' => 'tooltip',
                                            'data-placement' => 'top',
                                            'data-pjax' => '0',
                                            'style' => "padding:5px;",
                                            'class' => 'bt btn-lg'
                                                ]
                                );
                            }
                        },
                        'update' => function ($url, $model) use ($editable,$user,$template_model,$today,$status) {
                            if (User::userIsAllowedTo('Manage AWPB') && ($user->district_id != 0 || $user->district_id != '')) {
                        if(strtotime($template_model->submission_deadline) >= strtotime($today)){
                                return Html::a(
                                                '<span class="fas fa-edit"></span>', ['update', 'id' => $model->id,'status'=>$status], [
                                            'title' => 'Update AWPB',
                                            'data-toggle' => 'tooltip',
                                            'data-placement' => 'top',
                                            // 'target' => '_blank',
                                            'data-pjax' => '0',
                                            'style' => "padding:5px;",
                                            'class' => 'bt btn-lg'
                                                ]
                                );
                            }}
                        },
                        'delete' => function ($url, $model)  use ($editable,$user,$template_model,$today,$status ) {
                            if (User::userIsAllowedTo('Manage AWPB') && ($user->district_id != 0 || $user->district_id != '')) {
                             if(strtotime($template_model->submission_deadline) >= strtotime($today)){
           
                                    
        if ($model->total_amount<= 0)
        {
                                      return Html::a(
                                                '<span class="fa fa-trash"></span>', ['delete', 'id' => $model->id,'id2'=>$model->awpb_template_id,'status'=>$status], [
                                            'title' => 'delete AWPB',
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
                        },
                    ]
                ],



            ];



       // if ($dataProvider->getCount() > 0) {
   
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
        //}
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
    }    
 ?>

<div class="row">
		<div class="col-md-12">
    
       </div>
</div>
    </div>
</div>
<?php
$this->registerCss('.popover-x {display:none}');
?>