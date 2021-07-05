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

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CommodityPriceCollectionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = 'District AWPB';
//$this->params['breadcrumbs'][] = ['label' => 'District AWPB', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

//$province_id = backend\models\Districts::findOne([Yii::$app->getUser()->identity->district_id])->province_id;
//$district_id = backend\models\Districts::findOne([Yii::$app->getUser()->identity->district_id])->province_id;
//$this->params['breadcrumbs'][] = $this->title;

//$this->params['breadcrumbs'][] = \backend\models\Provinces::findOne($province_id)->name;
//$this->params['breadcrumbs'][] = \backend\models\Districts::findOne([Yii::$app->getUser()->identity->district_id])->name;
$months = [
    1 => "January", 2 => "February", 3 => "March", 4 => "April", 5 => "May", 6 => "June",
    7 => "July", 8 => "August", 9 => "September", 10 => "October", 11 => "November", 12 => "December"
];
$user = User::findOne(['id' => Yii::$app->user->id]);
$access_level=1;
?>
<div class="card card-success card-outline">
    <div class="card-body" style="overflow: auto;">
   <p>
           
            <?php

echo Html::a('<span class="fas fa-arrow-left fa-2x"></span>', ['awpb-activity-line/mpcmp','id' =>  $province_id,'awpb_template_id'=>$awpb_template_id], [
    'title' => 'back',
    'data-toggle' => 'tooltip',
    'data-placement' => 'top',
]);
if (User::userIsAllowedTo('Approve AWPB - Ministry') )
  {          echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    //  echo Html::a('Decline District AWPB',   ['awpb-comment/create', 'id' =>$model->district_id,'template_id'],  ['class' => 'float-right btn btn-success btn-sm btn-space']);       
     // ['awpb-activity-line/mpca', 'id' => $model->activity_id,'district_id'=>$model->district_id]
    
      // ["back-to-office-report/btor-report-view", 'id' => $row->id]

    //  'id' => $model->activity_id,'district_id'=>$model->district_id

    // echo '<button class="float-right btn btn-success btn-sm btn-space" href="#" onclick="$(\'#addNewModal\').modal(); 
    //                         return false;"></i> Decline District AWPB </button>';
                  


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
            'pageSummaryOptions' => ['colspan' => 2],
            'header'=>'',
            'headerOptions'=>['class'=>'kartik-sheet-style']
        ],
    //    [
    //     'attribute' => 'district_id',
    //         'format' => 'raw',
    //         'label' => 'District',
    //         'value' => function ($model) {
    //             return !empty($model->district_id) && $model->district_id > 0 ?  Html::a(backend\models\Districts::findOne($model->district_id)->name,['mpcod','id' =>  $model->district_id,'awpb_template_id'=>$model->awpb_template_id], ['class' => 'mpcod']):"";
    //             ;
    //         },
    //     //     'visible' => !empty($model->district_id) && $model->district_id > 0 ? TRUE : FALSE,
    //      ],

     
        // [
        //     'attribute' => 'awpb_template_id',
        //     'label' => 'Fiscal Year', 
        //     'vAlign' => 'middle',
        //     'width' => '180px',

        //     'value' => function ($model) {
        //         $name =  \backend\models\AwpbTemplate::findOne(['id' =>  $model->awpb_template_id])->fiscal_year;
        //         return Html::a($name, ['awpb-template/view', 'id' => $model->awpb_template_id], ['class' => 'awbp-template']);
        //     },
           
        //     'filterType' => GridView::FILTER_SELECT2,
        //     'filter' =>  \backend\models\AwpbActivity::getAwpbActivitiesList($access_level), 
        //     'filterWidgetOptions' => [
        //         'pluginOptions' => ['allowClear' => true],
        //         'options' => ['multiple' => true]
        //     ],
        //     'filterInputOptions' => ['placeholder' => 'Filter by activity'],
        //     'format' => 'raw'
        // ],
        
 
         [
            'attribute' => 'activity_id',
            'label' => 'Activity Code', 
            'vAlign' => 'middle',
            'width' => '180px',

            'value' => function ($model) {
                $name =  \backend\models\AwpbActivity::findOne(['id' =>  $model->activity_id])->activity_code;
                return Html::a($name, ['awpb-activity-line/mpcma', 'id' => $model->activity_id,'district_id'=>$model->district_id,'awpb_template_id'=>$model->awpb_template_id], ['class' => 'awbp-activity-lined']);
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
            'label' => 'Activity Name',
                  'value' =>  function ($model) {
                    $name =  \backend\models\AwpbActivity::findOne(['id' =>  $model->activity_id])->name;
                   return $name;//Html::a($name, ['awpb-activity-line/mpcd', 'id' => $model->activity_id], ['class' => 'awbp-activity-line']);
  
                      
                  }
              ],
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



            ];



    //     //if ($dataProvider->getCount() > 0) {
   
    //       // echo ' </p>';
    //       $user = User::findOne(['id' => Yii::$app->user->id]);
    //       $query = $searchModel::find();
    //       $query->select(['district_id','activity_id','SUM(quarter_one_amount) as quarter_one_amount','SUM(quarter_two_amount) as quarter_two_amount','SUM(quarter_three_amount) as quarter_three_amount','SUM(quarter_four_amount) as quarter_four_amount','SUM(total_amount) as total_amount']);
          
    // //      $query->where('district_id = :field1', [':field1' =>$id]);
    //       $query->where(['district_id'=> '49', 'status' => \backend\models\AwpbActivityLine::STATUS_SUBMITTED]);

    //       $query->groupBy('activity_id');
    //       $query->all();
          
    //       $dataProvider = new ActiveDataProvider([
    //               'query' => $query,
    //               ]);


    //             //   $query = User::find()->where(['id' => '-2']);
    //             //   $dataProvider = new \yii\data\ActiveDataProvider([
    //             //       'query' => $query,
    //             //   ]);
    //             //   GridView::widget([
    //             //       'dataProvider' => $dataProvider,
    //             //   ]);
                  


            echo ExportMenu::widget([
                'dataProvider' => $dataProvider,
                'columns' => $gridColumns,
                'fontAwesome' => true,
                'dropdownOptions' => [
                    'label' => 'Export All',
                    'class' => 'btn btn-default'
                ],
                'filename' => 'AWPB Activity Lines' . date("YmdHis")
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
      //  'filterModel' => $searchModel,
        'columns' => $gridColumns,
      
        //'pjax' => true,
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



<div class="modal fade" id="addNewModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content card-success card-outline">
            <div class="modal-header">
                <h5 class="modal-title">Add AWPB Comments</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                 $_model = new backend\models\AwpbComment();
                 $controller = Yii::$app->controller;
                 $arrayParams = ['p1' => 'v1' , 'p2' => 'v2'];
                 
                 $params = array_merge(["{$controller->id}/{$controller->action->id}"], $arrayParams);
                 
                 Yii::$app->urlManager->createUrl($params);

                $form = ActiveForm::begin(['action' => Yii::$app->urlManager->createUrl(['awpb-activity-line/decline']),])
                //$form = ActiveForm::begin(['action' => Yii::$app->urlManager->createUrl(['awpb-activity-line/decline','district_id' => $district_id,'awpb_template_id'=>  $awpb_template_id]),])
       
               //  'action' => 'add-activity?work_effort_id=' . $work_effort_id,
       ?>
        <?php
             //   $form = ActiveForm::begin(['type' => ActiveForm::TYPE_VERTICAL, 'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL],'options' => ['enctype' => 'multipart/form-data']]);
            //  $form = ActiveForm::begin(); 
           echo $form->field($_model, 'awpb_template_id')->hiddenInput(['value'=>$awpb_template_id ])->label(false);
           echo $form->field($_model, 'district_id')->hiddenInput(['value'=> $id])->label(false);
               
               // echo $form->field($_model, 'awpb_template_id')->textInput(['maxlength' => true,'value'=>$fiscal, 'class' => "form-control"]);
              //  echo $form->field($_model, 'district_id')->textInput(['maxlength' => true,'value'=>$distr,'class' => "form-control"]);
                //echo $form->field($model, 'name')->textInput(['maxlength' => true, 'class' => "form-control", 'placeholder' => 'Item description'])->label("Item description");
     
                           ?>
                
                <div class="row">
                    <div class="col-md-8">
        
                      
                        <?= $form->field($_model, 'description')->textarea(['rows' => 11, 'placeholder' =>
                           $model->province_id])->label("Comment");?>
                    </div>
                    
                    <div class="col-lg-4">
                        <h4>Instructions</h4>
                        <ol>
                            <?php
                            echo '<li>Fields marked with * are required</li>';
                            
                            ?>
                        </ol>
                    </div>    	   
                
                </div>
                
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                    </div>
                </div>
            </div>
        
                <?php ActiveForm::end(); ?>   
        </div>

              

            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

<?php
$this->registerCss('.popover-x {display:none}');
?>