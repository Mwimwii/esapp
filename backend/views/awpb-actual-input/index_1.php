<?php
use backend\models\AwpbBudget;
use backend\models\AwpbInput;
use backend\models\AwpbInputSearch;
use backend\models\AuditTrail;
use backend\models\User;
use backend\models\AwpbDistrict;
use kartik\editable\Editable;
use kartik\grid\EditableColumn;
use kartik\grid\GridView;
use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\grid\ActionColumn;
use \kartik\popover\PopoverX;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use kartik\export\ExportMenu;
use kartik\money\MaskMoney;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\base\Model;
use yii\caching\DbDependency;
use yii\data\ActiveDataProvider;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;






/* @var $this yii\web\View */
/* @var $searchModel backend\models\CommodityPriceCollectionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Quarterly Operations Funds Requisition';
//$province_id = backend\models\Districts::findOne([Yii::$app->getUser()->identity->district_id])->province_id;
$this->params['breadcrumbs'][] = $this->title;

//$this->params['breadcrumbs'][] = \backend\models\Provinces::findOne($province_id)->name;
//$this->params['breadcrumbs'][] = \backend\models\Districts::findOne([Yii::$app->getUser()->identity->district_id])->name;

$user = User::findOne(['id' => Yii::$app->user->id]);
//$budget = AwpbBudget::findOne(['id'=>$modid]);
$model = new backend\models\AwpbInput();
$access_level=1;

?>
<div class="card card-success card-outline">
    <div class="card-body" style="overflow: auto;">
        <p>

            <?php
             if (User::userIsAllowedTo('Request Funds') && ( $user->district_id > 0 || $user->district_id != ''))
             {
            ?>

        </p>

        <?php $form = ActiveForm::begin(); ?>
<div class="row" style="">
    <div class="col-lg-12">
        <div class="row" style="">
    <div class="col-lg-4">
        <?=
        $form->field($model, 'quarter', [
            'addon' => [
                'append' => [
                    'content' => Html::submitButton('Filter', ['name' => 'addQuarter', 'value' => 'true', 'class' => 'btn btn-success btn-sm']),
                    'asButton' => true
                ]
            ]
        ])->dropDownList(
                [
            'Q1' => 'Quarter 1',
                      'Q2' => 'Quarter 2',
                      'Q3' => 'Quarter 3',
                      'Q4' => 'Quarter 4',
           
                ], [
            'custom' => true,
            'prompt' => 'Filter by quarter',
            'required' => true,
                ]
        );
        ?>
    </div>
    <div class="col-lg-2">
        &nbsp;
    </div>
    <div class="col-lg-6">
        <h4>Instructions</h4>
        <ol>
            <li>Select the quarter  from the list</li>
            <li>Click on filter to view.</li>
           
            <li>Click on <i class="fa fa-check" style="color:blue"></i> to approve the funds request.</li>
<!--            if (!empty($sub)) {
                echo '<li>Fields marked with * are required</li>
           
            <li>Fill in the fields below to add a <b>' . $sub . '</b></li>';
            }-->
            
        </ol>
    </div>
</div>

<?php ActiveForm::end(); ?>
<?php
 //$gridColumns ="";
$id3=0;
 if ($quarter === "Q1") {
$id3=1;
$gridColumns = [
[
    'class'=>'kartik\grid\SerialColumn',
    'contentOptions'=>['class'=>'kartik-sheet-style'],
    'width'=>'36px',
    'pageSummary'=>'Total',
    'pageSummaryOptions' => ['colspan' => 5],
    'header'=>'',
    'headerOptions'=>['class'=>'kartik-sheet-style']
],
//[
//    'class' => 'kartik\grid\RadioColumn',
//    'width' => '36px',
//    'headerOptions' => ['class' => 'kartik-sheet-style'],
//],
[
    'class' => 'kartik\grid\ExpandRowColumn',
    'width' => '50px',
    'value' => function ($model, $key, $index, $column) {
        return GridView::ROW_COLLAPSED;
    },
    // uncomment below and comment detail if you need to render via ajax
    // 'detailUrl' => Url::to(['/site/book-details']),
    'detail' => function ($model, $key, $index, $column) use ($id){
       return Yii::$app->controller->renderPartial('index_1_1', ['id' => $id,'id2'=>$model->district_id,'id4'=>$model->budget_id,'quarter'=>'Q1']);
    },
    'headerOptions' => ['class' => 'kartik-sheet-style'] ,
    'expandOneOnly' => true
],
            
                      [
    'class' => 'kartik\grid\EditableColumn',
    'attribute' => 'component_id',
     'header' => 'Component', 
    'pageSummary' => 'Total',
    'vAlign' => 'middle',
    'width' => '50px',
     'readonly' => true,
     'value' => function ($model) {
         return !empty($model->component_id) && $model->component_id > 0 ? backend\models\AwpbComponent::findOne($model->component_id)->code : "";
                        
      },

],          [
    'class' => 'kartik\grid\EditableColumn',
    'attribute' => 'activity_id',
     'header' => 'Activity Code', 
    'pageSummary' => 'Total',
    'vAlign' => 'middle',
    'width' => '50px',
     'readonly' => true,
     'value' => function ($model) {
         return !empty($model->activity_id) && $model->activity_id > 0 ? backend\models\AwpbActivity::findOne($model->activity_id)->activity_code : "";
                        ;
      },

],
            [
    'class' => 'kartik\grid\EditableColumn',
    'attribute' => 'budget_id',
     'header' => 'Activity Name', 
    'pageSummary' => 'Total',
    'vAlign' => 'middle',
    'width' => '450px',
     'readonly' => true,
     'value' => function ($model) {
         return !empty($model->activity_id) && $model->activity_id > 0 ? backend\models\AwpbActivity::findOne($model->activity_id)->name : "";
                        ;
      },

],

//[
//    'class' => 'kartik\grid\EditableColumn',
//    'attribute' => 'district_id',
//     'header' => 'District', 
//    'pageSummary' => 'Total',
//    'vAlign' => 'middle',
//    'width' => '210px',
//     'readonly' => true,
//     'value' => function ($model) {
//         return !empty($model->district_id) && $model->district_id > 0 ?backend\models\Districts::findOne($model->district_id)->name : "";
//                        ;
//      },
//
//],


[
    'class' => 'kartik\grid\EditableColumn',
    'attribute' => 'mo_1_amount', 
    'readonly' => function($model, $key, $index, $widget) {
        return (!$model->status); // do not allow editing of inactive records
    },
    'editableOptions' => [
        'header' => 'Jan Budget', 
        'inputType' => \kartik\editable\Editable::INPUT_SPIN,
        'options' => [
            'pluginOptions' => ['min' => 0, 'max' => 5000]
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
    'attribute' => 'mo_2_amount',  'readonly' => true,
//    'readonly' => 
//    'readonly' => function($model, $key, $index, $widget) {
//        return (!$model->status); // do not allow editing of inactive records
//    },
    'editableOptions' => [
        'header' => 'Feb Budget', 
        'inputType' => \kartik\editable\Editable::INPUT_SPIN,
        'options' => [
            'pluginOptions' => ['min' => 0, 'max' => 5000]
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
//    'readonly' => 
//                            function($model, $key, $index, $widget) {
//        return (!$model->status); // do not allow editing of inactive records
//    },
    'editableOptions' => [
        'header' => 'Mar Budget', 
        'inputType' => \kartik\editable\Editable::INPUT_SPIN,
        'options' => [
            'pluginOptions' => ['min' => 0, 'max' => 5000]
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

    'editableOptions' => [
        'header' => 'Qtr Budget', 
        'inputType' => \kartik\editable\Editable::INPUT_SPIN,
        'options' => [
            'pluginOptions' => ['min' => 0, 'max' => 5000]
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

    'editableOptions' => [
        'header' => 'Activity Budget', 
        'inputType' => \kartik\editable\Editable::INPUT_SPIN,
        'options' => [
            'pluginOptions' => ['min' => 0, 'max' => 5000]
        ]
    ],
    'hAlign' => 'right', 
    'vAlign' => 'middle',
    'width' => '7%',
    'format' => ['decimal', 2],
    'pageSummary' => true
],
            
//        [
//    'class' => 'kartik\grid\EditableColumn',
//    'attribute' => 'total_actual_amount', 
//                            'readonly' => true,
//
//    'editableOptions' => [
//        'header' => 'Actual', 
//        'inputType' => \kartik\editable\Editable::INPUT_SPIN,
//        'options' => [
//            'pluginOptions' => ['min' => 0, 'max' => 5000]
//        ]
//    ],
//    'hAlign' => 'right', 
//    'vAlign' => 'middle',
//    'width' => '7%',
//    'format' => ['decimal', 2],
//    'pageSummary' => true
//],
//                 
         
 
            [
                'class' => 'kartik\grid\EditableColumn',
                 'readonly' => true,
                 'width' => '12.5%',
    //'class' => 'kartik\grid\BooleanColumn',
    'attribute' => 'status', 
    'vAlign' => 'middle',
                 'format' => 'raw',
                    'value' => function ($model) {
        $funds_requisition =  AwpbDistrict::findOne(['awpb_template_id' => $model->awpb_template_id, 'district_id'=>$model->district_id]);

                    
          if ($funds_requisition->status==backend\models\AwpbBudget::STATUS_MINISTRY) {
       
         if ($funds_requisition->status_q_1 == \backend\models\AwpbDistrict::STATUS_QUARTER_CLOSED)
                  {
                     $funds_requisition_status = "<p style='margin:4px; text-align: center;padding:4px;display:inline-block;' class='alert alert-danger'> "
                            . "Not open</p><br>";   
                     
                  } 
                  elseif ($funds_requisition->status_q_1 == \backend\models\AwpbDistrict::STATUS_QUARTER_OPEN)
                  {
                      $funds_requisition_status = "<p style='margin:2px; text-align: center;padding:2px;display:inline-block;' class='alert alert-danger'> "
                            . "Funds not requested</p><br>";      
                      
                  } 
                   elseif ($funds_requisition->status_q_1 == \backend\models\AwpbDistrict::STATUS_QUARTER_REQUESTED )
                  {
                      $funds_requisition_status = "<p style='margin:4px; text-align: center;padding:4px;display:inline-block;' class='alert alert-danger'> "
                            . "Pending approval</p><br>";    
                        
                      
                  } 
                     elseif ($funds_requisition->status_q_1 == \backend\models\AwpbDistrict::STATUS_QUARTER_APPROVED )
                  {
                      $funds_requisition_status = "<p style='margin:4px; text-align: center;padding:4px;display:inline-block;' class='alert alert-danger'> "
                            . "Funds request approved</p><br>";   
                     
                  } 
                  elseif ($funds_requisition->status_q_1 == \backend\models\AwpbDistrict::STATUS_QUARTER_DISBURSED)
                  {
                      $funds_requisition_status = "<p style='margin:4px; text-align: center;padding:4px;display:inline-block;' class='alert alert-danger'> "
                            . " Funds disbursed</p><br>";   
                     
                  } 
 else {
      $funds_requisition_status ="";
 }
                    return $funds_requisition_status;
          }     
      },
], 
            
            
//[
//    'class' => 'kartik\grid\ActionColumn',
//    'dropdown' => true,
//    'dropdownOptions' => ['class' => 'float-right'],
//    'urlCreator' => function($action, $model, $key, $index) { return '#'; },
//    'viewOptions' => ['title' => 'This will launch the book details page. Disabled for this demo!', 'data-toggle' => 'tooltip'],
//    'updateOptions' => ['title' => 'This will launch the book update page. Disabled for this demo!', 'data-toggle' => 'tooltip'],
//    'deleteOptions' => ['title' => 'This will launch the book delete action. Disabled for this demo!', 'data-toggle' => 'tooltip'],
//    'headerOptions' => ['class' => 'kartik-sheet-style'],
//],

//     [
//                'class' => 'kartik\grid\ActionColumn',
//                'vAlign'=>'middle',
//                                     'width' => '7%',
//            'template' => '{update}',
//            'buttons' => [
//                
//                'update' => function ($url, $model) use ($id,$id3){
//                
//                    
//                             $funds_requisition =  AwpbDistrict::findOne(['awpb_template_id' => $model->awpb_template_id, 'district_id'=>$model->district_id]);
//
//                    
//          if ($funds_requisition->status==backend\models\AwpbBudget::STATUS_MINISTRY) {
//       
//         if ($funds_requisition->status_q_1 == \backend\models\AwpbDistrict::STATUS_QUARTER_REQUESTED){
//                              
//                        return Html::a(
//                                        '<span class="fas fa-check"></span>',['awpb-district/submit','id'=>$model->awpb_template_id,'id2'=>$model->district_id,'id3'=>$id3,'status'=> \backend\models\AwpbDistrict::STATUS_QUARTER_APPROVED], [ 
//                                    'title' => 'Approve Funds Requisition',
//                                    'data-toggle' => 'tooltip',
//                                    'data-placement' => 'top',
//                                    // 'target' => '_blank',
//                                    'data-pjax' => '0',
//                                   // 'style' => "padding:5px;",
//                                    'class' => 'bt btn-lg'
//                                        ]
//                        );
//                        
//                }}
// },
//                   
//               
//            ]]          
              
              
];







?>
<div class="row" style="">
    <div class="col-lg-12">
        <div class="row" style="">
    <div class="col-lg-5">
       
    </div>
              
   
             <div class="col-lg-5">
        <?php
        //if ($funds_requisition->funds_request==0) {
            
         
      

        ?> </div>
        </div></div></div>
          <?php
           
        //  $query->join('LEFT JOIN', 'post', 'post.user_id = user.id');
            $searchModel = new AwpbInput();
            $query = $searchModel::find();
            
            $query->select(['awpb_template_id',  'district_id','component_id','activity_id','budget_id','SUM(mo_1_amount) as mo_1_amount',  'SUM(mo_2_amount) as mo_2_amount',  'SUM(mo_3_amount) as mo_3_amount', 'SUM(quarter_one_amount) as quarter_one_amount','SUM(total_amount) as total_amount']);
            //$query->join('LEFT JOIN', 'awpb_district', 'awpb_district.district_id = districk.id');
            $query->where(['awpb_template_id' => $id]);
          
            $query->andWhere(['>', 'district_id', 0]);
          //  $query->andWhere(['=', 'status', $status]);
            $query->groupBy('budget_id'); 
            $query->all();

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);
          
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



 if ($quarter === "Q2") {
$id3=2;
$gridColumns = [
[
    'class'=>'kartik\grid\SerialColumn',
    'contentOptions'=>['class'=>'kartik-sheet-style'],
    'width'=>'36px',
    'pageSummary'=>'Total',
    'pageSummaryOptions' => ['colspan' => 3],
    'header'=>'',
    'headerOptions'=>['class'=>'kartik-sheet-style']
],
//[
//    'class' => 'kartik\grid\RadioColumn',
//    'width' => '36px',
//    'headerOptions' => ['class' => 'kartik-sheet-style'],
//],
[
    'class' => 'kartik\grid\ExpandRowColumn',
    'width' => '50px',
    'value' => function ($model, $key, $index, $column) {
        return GridView::ROW_COLLAPSED;
    },
    // uncomment below and comment detail if you need to render via ajax
    // 'detailUrl' => Url::to(['/site/book-details']),
    'detail' => function ($model, $key, $index, $column) use ($id){
        return Yii::$app->controller->renderPartial('index_3', ['id' => $id,'id2'=>$model->district_id,'quarter'=>'Q2']);
    },
    'headerOptions' => ['class' => 'kartik-sheet-style'] ,
    'expandOneOnly' => true
],
[
    'class' => 'kartik\grid\EditableColumn',
    'attribute' => 'district_id',
     'header' => 'District', 
    'pageSummary' => 'Total',
    'vAlign' => 'middle',
    'width' => '210px',
     'readonly' => true,
     'value' => function ($model) {
         return !empty($model->district_id) && $model->district_id > 0 ?backend\models\Districts::findOne($model->district_id)->name : "";
                        ;
      },

],


[
    'class' => 'kartik\grid\EditableColumn',
    'attribute' => 'mo_4_amount', 
    'readonly' => function($model, $key, $index, $widget) {
        return (!$model->status); // do not allow editing of inactive records
    },
    'editableOptions' => [
        'header' => 'Apr Budget', 
        'inputType' => \kartik\editable\Editable::INPUT_SPIN,
        'options' => [
            'pluginOptions' => ['min' => 0, 'max' => 5000]
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
    'attribute' => 'mo_5_amount',  'readonly' => true,
//    'readonly' => 
//    'readonly' => function($model, $key, $index, $widget) {
//        return (!$model->status); // do not allow editing of inactive records
//    },
    'editableOptions' => [
        'header' => 'May Budget', 
        'inputType' => \kartik\editable\Editable::INPUT_SPIN,
        'options' => [
            'pluginOptions' => ['min' => 0, 'max' => 5000]
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
//    'readonly' => 
//                            function($model, $key, $index, $widget) {
//        return (!$model->status); // do not allow editing of inactive records
//    },
    'editableOptions' => [
        'header' => 'Jun Budget', 
        'inputType' => \kartik\editable\Editable::INPUT_SPIN,
        'options' => [
            'pluginOptions' => ['min' => 0, 'max' => 5000]
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

    'editableOptions' => [
        'header' => 'Qtr Budget', 
        'inputType' => \kartik\editable\Editable::INPUT_SPIN,
        'options' => [
            'pluginOptions' => ['min' => 0, 'max' => 5000]
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
                 'readonly' => true,
                 'width' => '12.5%',
    //'class' => 'kartik\grid\BooleanColumn',
    'attribute' => 'status', 
    'vAlign' => 'middle',
                 'format' => 'raw',
                    'value' => function ($model) {
        $funds_requisition =  AwpbDistrict::findOne(['awpb_template_id' => $model->awpb_template_id, 'district_id'=>$model->district_id]);

                    
          if ($funds_requisition->status==backend\models\AwpbBudget::STATUS_MINISTRY) {
       
         if ($funds_requisition->status_q_2 == \backend\models\AwpbDistrict::STATUS_QUARTER_CLOSED)
                  {
                     $funds_requisition_status = "<p style='margin:4px; text-align: center;padding:4px;display:inline-block;' class='alert alert-danger'> "
                            . "Not open</p><br>";   
                     
                  } 
                  elseif ($funds_requisition->status_q_2 == \backend\models\AwpbDistrict::STATUS_QUARTER_OPEN)
                  {
                      $funds_requisition_status = "<p style='margin:2px; text-align: center;padding:2px;display:inline-block;' class='alert alert-danger'> "
                            . "Funds not requested</p><br>";      
                      
                  } 
                   elseif ($funds_requisition->status_q_2 == \backend\models\AwpbDistrict::STATUS_QUARTER_REQUESTED )
                  {
                      $funds_requisition_status = "<p style='margin:4px; text-align: center;padding:4px;display:inline-block;' class='alert alert-danger'> "
                            . "Pending approval</p><br>";    
                        
                      
                  } 
                     elseif ($funds_requisition->status_q_2 == \backend\models\AwpbDistrict::STATUS_QUARTER_APPROVED )
                  {
                      $funds_requisition_status = "<p style='margin:4px; text-align: center;padding:4px;display:inline-block;' class='alert alert-danger'> "
                            . "Funds request approved</p><br>";   
                     
                  } 
                  elseif ($funds_requisition->status_q_2 == \backend\models\AwpbDistrict::STATUS_QUARTER_DISBURSED)
                  {
                      $funds_requisition_status = "<p style='margin:4px; text-align: center;padding:4px;display:inline-block;' class='alert alert-danger'> "
                            . " Funds disbursed</p><br>";   
                     
                  } 
 else {
      $funds_requisition_status ="";
 }
                    return $funds_requisition_status;
          }     
      },
], 
            
            


     [
                'class' => 'kartik\grid\ActionColumn',
                'vAlign'=>'middle',
                                     'width' => '7%',
            'template' => '{update}',
            'buttons' => [
                
                'update' => function ($url, $model) use ($id,$id3){
                
                    
                             $funds_requisition =  AwpbDistrict::findOne(['awpb_template_id' => $model->awpb_template_id, 'district_id'=>$model->district_id]);

                    
          if ($funds_requisition->status==backend\models\AwpbBudget::STATUS_MINISTRY) {
       
         if ($funds_requisition->status_q_2 == \backend\models\AwpbDistrict::STATUS_QUARTER_REQUESTED){
                              
                        return Html::a(
                                        '<span class="fas fa-check"></span>',['awpb-district/submit','id'=>$model->awpb_template_id,'id2'=>$model->district_id,'id3'=>$id3,'status'=> \backend\models\AwpbDistrict::STATUS_QUARTER_APPROVED], [ 
                                    'title' => 'Approve Funds Requisition',
                                    'data-toggle' => 'tooltip',
                                    'data-placement' => 'top',
                                    // 'target' => '_blank',
                                    'data-pjax' => '0',
                                   // 'style' => "padding:5px;",
                                    'class' => 'bt btn-lg'
                                        ]
                        );
                        
                }}
 },
                   
               
            ]]          
              
              
];







?>
<div class="row" style="">
    <div class="col-lg-12">
        <div class="row" style="">
    <div class="col-lg-5">
       
    </div>
              
   
             <div class="col-lg-5">
        <?php
        //if ($funds_requisition->funds_request==0) {
            
         
      

        ?> </div>
        </div></div></div>
          <?php
           
        //  $query->join('LEFT JOIN', 'post', 'post.user_id = user.id');
            $searchModel = new AwpbInput();
            $query = $searchModel::find();
            
            $query->select(['awpb_template_id', 'district_id', 'SUM(mo_4_amount) as mo_4_amount',  'SUM(mo_5_amount) as mo_5_amount',  'SUM(mo_6_amount) as mo_6_amount', 'SUM(quarter_two_amount) as quarter_two_amount']);
            //$query->join('LEFT JOIN', 'awpb_district', 'awpb_district.district_id = districk.id');
            $query->where(['awpb_template_id' => $id]);
          
            $query->andWhere(['>', 'district_id', 0]);
          //  $query->andWhere(['=', 'status', $status]);
            $query->groupBy('district_id');
            $query->all();

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);
          
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
$gridColumns = [
[
    'class'=>'kartik\grid\SerialColumn',
    'contentOptions'=>['class'=>'kartik-sheet-style'],
    'width'=>'36px',
    'pageSummary'=>'Total',
    'pageSummaryOptions' => ['colspan' => 3],
    'header'=>'',
    'headerOptions'=>['class'=>'kartik-sheet-style']
],
//[
//    'class' => 'kartik\grid\RadioColumn',
//    'width' => '36px',
//    'headerOptions' => ['class' => 'kartik-sheet-style'],
//],
[
    'class' => 'kartik\grid\ExpandRowColumn',
    'width' => '50px',
    'value' => function ($model, $key, $index, $column) {
        return GridView::ROW_COLLAPSED;
    },
    // uncomment below and comment detail if you need to render via ajax
    // 'detailUrl' => Url::to(['/site/book-details']),
    'detail' => function ($model, $key, $index, $column) use ($id){
        return Yii::$app->controller->renderPartial('index_3', ['id' => $id,'id2'=>$model->district_id,'quarter'=>'Q3']);
    },
    'headerOptions' => ['class' => 'kartik-sheet-style'] ,
    'expandOneOnly' => true
],
[
    'class' => 'kartik\grid\EditableColumn',
    'attribute' => 'district_id',
     'header' => 'District', 
    'pageSummary' => 'Total',
    'vAlign' => 'middle',
    'width' => '210px',
     'readonly' => true,
     'value' => function ($model) {
         return !empty($model->district_id) && $model->district_id > 0 ?backend\models\Districts::findOne($model->district_id)->name : "";
                        ;
      },

],


[
    'class' => 'kartik\grid\EditableColumn',
    'attribute' => 'mo_7_amount', 
    'readonly' => function($model, $key, $index, $widget) {
        return (!$model->status); // do not allow editing of inactive records
    },
    'editableOptions' => [
        'header' => 'July Budget', 
        'inputType' => \kartik\editable\Editable::INPUT_SPIN,
        'options' => [
            'pluginOptions' => ['min' => 0, 'max' => 5000]
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
    'attribute' => 'mo_8_amount',  'readonly' => true,
//    'readonly' => 
//    'readonly' => function($model, $key, $index, $widget) {
//        return (!$model->status); // do not allow editing of inactive records
//    },
    'editableOptions' => [
        'header' => 'Aug Budget', 
        'inputType' => \kartik\editable\Editable::INPUT_SPIN,
        'options' => [
            'pluginOptions' => ['min' => 0, 'max' => 5000]
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
//    'readonly' => 
//                            function($model, $key, $index, $widget) {
//        return (!$model->status); // do not allow editing of inactive records
//    },
    'editableOptions' => [
        'header' => 'Sep Budget', 
        'inputType' => \kartik\editable\Editable::INPUT_SPIN,
        'options' => [
            'pluginOptions' => ['min' => 0, 'max' => 5000]
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

    'editableOptions' => [
        'header' => 'Qtr Budget', 
        'inputType' => \kartik\editable\Editable::INPUT_SPIN,
        'options' => [
            'pluginOptions' => ['min' => 0, 'max' => 5000]
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
                 'readonly' => true,
                 'width' => '12.5%',
    //'class' => 'kartik\grid\BooleanColumn',
    'attribute' => 'status', 
    'vAlign' => 'middle',
                 'format' => 'raw',
                    'value' => function ($model) {
        $funds_requisition =  AwpbDistrict::findOne(['awpb_template_id' => $model->awpb_template_id, 'district_id'=>$model->district_id]);

                    
          if ($funds_requisition->status==backend\models\AwpbBudget::STATUS_MINISTRY) {
       
         if ($funds_requisition->status_q_3 == \backend\models\AwpbDistrict::STATUS_QUARTER_CLOSED)
                  {
                     $funds_requisition_status = "<p style='margin:4px; text-align: center;padding:4px;display:inline-block;' class='alert alert-danger'> "
                            . "Not open</p><br>";   
                     
                  } 
                  elseif ($funds_requisition->status_q_3 == \backend\models\AwpbDistrict::STATUS_QUARTER_OPEN)
                  {
                      $funds_requisition_status = "<p style='margin:2px; text-align: center;padding:2px;display:inline-block;' class='alert alert-danger'> "
                            . "Funds not requested</p><br>";      
                      
                  } 
                   elseif ($funds_requisition->status_q_3 == \backend\models\AwpbDistrict::STATUS_QUARTER_REQUESTED )
                  {
                      $funds_requisition_status = "<p style='margin:4px; text-align: center;padding:4px;display:inline-block;' class='alert alert-danger'> "
                            . "Pending approval</p><br>";    
                        
                      
                  } 
                     elseif ($funds_requisition->status_q_3 == \backend\models\AwpbDistrict::STATUS_QUARTER_APPROVED )
                  {
                      $funds_requisition_status = "<p style='margin:4px; text-align: center;padding:4px;display:inline-block;' class='alert alert-danger'> "
                            . "Funds request approved</p><br>";   
                     
                  } 
                  elseif ($funds_requisition->status_q_3 == \backend\models\AwpbDistrict::STATUS_QUARTER_DISBURSED)
                  {
                      $funds_requisition_status = "<p style='margin:4px; text-align: center;padding:4px;display:inline-block;' class='alert alert-danger'> "
                            . " Funds disbursed</p><br>";   
                     
                  } 
 else {
      $funds_requisition_status ="";
 }
                    return $funds_requisition_status;
          }     
      },
], 
            


     [
                'class' => 'kartik\grid\ActionColumn',
                'vAlign'=>'middle',
                                     'width' => '7%',
            'template' => '{update}',
            'buttons' => [
                
                'update' => function ($url, $model) use ($id,$id3){
                
                    
                             $funds_requisition =  AwpbDistrict::findOne(['awpb_template_id' => $model->awpb_template_id, 'district_id'=>$model->district_id]);

                    
          if ($funds_requisition->status==backend\models\AwpbBudget::STATUS_MINISTRY) {
       
         if ($funds_requisition->status_q_3 == \backend\models\AwpbDistrict::STATUS_QUARTER_REQUESTED){
                              
                        return Html::a(
                                        '<span class="fas fa-check"></span>',['awpb-district/submit','id'=>$model->awpb_template_id,'id2'=>$model->district_id,'id3'=>$id3,'status'=> \backend\models\AwpbDistrict::STATUS_QUARTER_APPROVED], [ 
                                    'title' => 'Approve Funds Requisition',
                                    'data-toggle' => 'tooltip',
                                    'data-placement' => 'top',
                                    // 'target' => '_blank',
                                    'data-pjax' => '0',
                                   // 'style' => "padding:5px;",
                                    'class' => 'bt btn-lg'
                                        ]
                        );
                        
                }}
 },
                   
               
            ]]          
              
              
];







?>
<div class="row" style="">
    <div class="col-lg-12">
        <div class="row" style="">
    <div class="col-lg-5">
       
    </div>
              
   
             <div class="col-lg-5">
        <?php
        //if ($funds_requisition->funds_request==0) {
            
         
      

        ?> </div>
        </div></div></div>
          <?php
           
        //  $query->join('LEFT JOIN', 'post', 'post.user_id = user.id');
            $searchModel = new AwpbInput();
            $query = $searchModel::find();
            
            $query->select(['awpb_template_id', 'district_id', 'SUM(mo_7_amount) as mo_7_amount',  'SUM(mo_8_amount) as mo_8_amount',  'SUM(mo_9_amount) as mo_9_amount', 'SUM(quarter_three_amount) as quarter_three_amount']);
            //$query->join('LEFT JOIN', 'awpb_district', 'awpb_district.district_id = districk.id');
            $query->where(['awpb_template_id' => $id]);
          
            $query->andWhere(['>', 'district_id', 0]);
          //  $query->andWhere(['=', 'status', $status]);
            $query->groupBy('district_id');
            $query->all();

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);
          
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
$gridColumns = [
[
    'class'=>'kartik\grid\SerialColumn',
    'contentOptions'=>['class'=>'kartik-sheet-style'],
    'width'=>'36px',
    'pageSummary'=>'Total',
    'pageSummaryOptions' => ['colspan' => 3],
    'header'=>'',
    'headerOptions'=>['class'=>'kartik-sheet-style']
],
//[
//    'class' => 'kartik\grid\RadioColumn',
//    'width' => '36px',
//    'headerOptions' => ['class' => 'kartik-sheet-style'],
//],
[
    'class' => 'kartik\grid\ExpandRowColumn',
    'width' => '50px',
    'value' => function ($model, $key, $index, $column) {
        return GridView::ROW_COLLAPSED;
    },
    // uncomment below and comment detail if you need to render via ajax
    // 'detailUrl' => Url::to(['/site/book-details']),
    'detail' => function ($model, $key, $index, $column) use ($id){
        return Yii::$app->controller->renderPartial('index_3', ['id' => $id,'id2'=>$model->district_id,'quarter'=>'Q4']);
    },
    'headerOptions' => ['class' => 'kartik-sheet-style'] ,
    'expandOneOnly' => true
],
[
    'class' => 'kartik\grid\EditableColumn',
    'attribute' => 'district_id',
     'header' => 'District', 
    'pageSummary' => 'Total',
    'vAlign' => 'middle',
    'width' => '210px',
     'readonly' => true,
     'value' => function ($model) {
         return !empty($model->district_id) && $model->district_id > 0 ?backend\models\Districts::findOne($model->district_id)->name : "";
                        ;
      },

],


[
    'class' => 'kartik\grid\EditableColumn',
    'attribute' => 'mo_10_amount', 
    'readonly' => function($model, $key, $index, $widget) {
        return (!$model->status); // do not allow editing of inactive records
    },
    'editableOptions' => [
        'header' => 'Oct Budget', 
        'inputType' => \kartik\editable\Editable::INPUT_SPIN,
        'options' => [
            'pluginOptions' => ['min' => 0, 'max' => 5000]
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
    'attribute' => 'mo_11_amount',  'readonly' => true,
//    'readonly' => 
//    'readonly' => function($model, $key, $index, $widget) {
//        return (!$model->status); // do not allow editing of inactive records
//    },
    'editableOptions' => [
        'header' => 'Nov Budget', 
        'inputType' => \kartik\editable\Editable::INPUT_SPIN,
        'options' => [
            'pluginOptions' => ['min' => 0, 'max' => 5000]
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
//    'readonly' => 
//                            function($model, $key, $index, $widget) {
//        return (!$model->status); // do not allow editing of inactive records
//    },
    'editableOptions' => [
        'header' => 'Dec Budget', 
        'inputType' => \kartik\editable\Editable::INPUT_SPIN,
        'options' => [
            'pluginOptions' => ['min' => 0, 'max' => 5000]
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

    'editableOptions' => [
        'header' => 'Qtr Budget', 
        'inputType' => \kartik\editable\Editable::INPUT_SPIN,
        'options' => [
            'pluginOptions' => ['min' => 0, 'max' => 5000]
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
                 'readonly' => true,
                 'width' => '12.5%',
    //'class' => 'kartik\grid\BooleanColumn',
    'attribute' => 'status', 
    'vAlign' => 'middle',
                 'format' => 'raw',
                    'value' => function ($model) {
        $funds_requisition =  AwpbDistrict::findOne(['awpb_template_id' => $model->awpb_template_id, 'district_id'=>$model->district_id]);

                    
          if ($funds_requisition->status==backend\models\AwpbBudget::STATUS_MINISTRY) {
       
         if ($funds_requisition->status_q_4 == \backend\models\AwpbDistrict::STATUS_QUARTER_CLOSED)
                  {
                     $funds_requisition_status = "<p style='margin:4px; text-align: center;padding:4px;display:inline-block;' class='alert alert-danger'> "
                            . "Not open</p><br>";   
                     
                  } 
                  elseif ($funds_requisition->status_q_4 == \backend\models\AwpbDistrict::STATUS_QUARTER_OPEN)
                  {
                      $funds_requisition_status = "<p style='margin:2px; text-align: center;padding:2px;display:inline-block;' class='alert alert-danger'> "
                            . "Funds not requested</p><br>";      
                      
                  } 
                   elseif ($funds_requisition->status_q_4 == \backend\models\AwpbDistrict::STATUS_QUARTER_REQUESTED )
                  {
                      $funds_requisition_status = "<p style='margin:4px; text-align: center;padding:4px;display:inline-block;' class='alert alert-danger'> "
                            . "Pending approval</p><br>";    
                        
                      
                  } 
                     elseif ($funds_requisition->status_q_4 == \backend\models\AwpbDistrict::STATUS_QUARTER_APPROVED )
                  {
                      $funds_requisition_status = "<p style='margin:4px; text-align: center;padding:4px;display:inline-block;' class='alert alert-danger'> "
                            . "Funds request approved</p><br>";   
                     
                  } 
                  elseif ($funds_requisition->status_q_4 == \backend\models\AwpbDistrict::STATUS_QUARTER_DISBURSED)
                  {
                      $funds_requisition_status = "<p style='margin:4px; text-align: center;padding:4px;display:inline-block;' class='alert alert-danger'> "
                            . " Funds disbursed</p><br>";   
                     
                  } 
 else {
      $funds_requisition_status ="";
 }
                    return $funds_requisition_status;
          }     
      },
], 
            
            
//[
//    'class' => 'kartik\grid\ActionColumn',
//    'dropdown' => true,
//    'dropdownOptions' => ['class' => 'float-right'],
//    'urlCreator' => function($action, $model, $key, $index) { return '#'; },
//    'viewOptions' => ['title' => 'This will launch the book details page. Disabled for this demo!', 'data-toggle' => 'tooltip'],
//    'updateOptions' => ['title' => 'This will launch the book update page. Disabled for this demo!', 'data-toggle' => 'tooltip'],
//    'deleteOptions' => ['title' => 'This will launch the book delete action. Disabled for this demo!', 'data-toggle' => 'tooltip'],
//    'headerOptions' => ['class' => 'kartik-sheet-style'],
//],

     [
                'class' => 'kartik\grid\ActionColumn',
                'vAlign'=>'middle',
                                     'width' => '7%',
            'template' => '{update}',
            'buttons' => [
                
                'update' => function ($url, $model) use ($id,$id3){
                
                    
                             $funds_requisition =  AwpbDistrict::findOne(['awpb_template_id' => $model->awpb_template_id, 'district_id'=>$model->district_id]);

                    
          if ($funds_requisition->status==backend\models\AwpbBudget::STATUS_MINISTRY) {
       
         if ($funds_requisition->status_q_4 == \backend\models\AwpbDistrict::STATUS_QUARTER_REQUESTED){
                              
                        return Html::a(
                                        '<span class="fas fa-check"></span>',['awpb-district/submit','id'=>$model->awpb_template_id,'id2'=>$model->district_id,'id3'=>$id3,'status'=> \backend\models\AwpbDistrict::STATUS_QUARTER_APPROVED], [ 
                                    'title' => 'Approve Funds Requisition',
                                    'data-toggle' => 'tooltip',
                                    'data-placement' => 'top',
                                    // 'target' => '_blank',
                                    'data-pjax' => '0',
                                   // 'style' => "padding:5px;",
                                    'class' => 'bt btn-lg'
                                        ]
                        );
                        
                }}
 },
                   
               
            ]]          
              
              
];







?>
<div class="row" style="">
    <div class="col-lg-12">
        <div class="row" style="">
    <div class="col-lg-5">
       
    </div>
              
   
             <div class="col-lg-5">
        <?php
        //if ($funds_requisition->funds_request==0) {
            
         
      

        ?> </div>
        </div></div></div>
          <?php
           
        //  $query->join('LEFT JOIN', 'post', 'post.user_id = user.id');
            $searchModel = new AwpbInput();
            $query = $searchModel::find();
            
            $query->select(['awpb_template_id', 'district_id', 'SUM(mo_10_amount) as mo_10_amount',  'SUM(mo_11_amount) as mo_11_amount',  'SUM(mo_12_amount) as mo_12_amount', 'SUM(quarter_four_amount) as quarter_four_amount']);
            //$query->join('LEFT JOIN', 'awpb_district', 'awpb_district.district_id = districk.id');
            $query->where(['awpb_template_id' => $id]);
          
            $query->andWhere(['>', 'district_id', 0]);
          //  $query->andWhere(['=', 'status', $status]);
            $query->groupBy('district_id');
            $query->all();

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);
          
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