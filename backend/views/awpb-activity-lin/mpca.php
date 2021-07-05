<?php

// use kartik\editable\Editable;
// use kartik\grid\EditableColumn;
// use kartik\grid\GridView;
// use yii\helpers\Html;
// use kartik\form\ActiveForm;
// use yii\grid\ActionColumn;
// use backend\models\User;
// use \kartik\popover\PopoverX;
// use kartik\depdrop\DepDrop;

// use kartik\export\ExportMenu;
// use kartik\money\MaskMoney;

// use yii\helpers\Json;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use backend\models\AwpbActivityLine;
use backend\models\AwpbActivityLineSearch;
use kartik\export\ExportMenu;
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

$this->title = 'District AWPB Activity Lines';
//$province_id = backend\models\Districts::findOne([Yii::$app->getUser()->identity->district_id])->province_id;
$this->params['breadcrumbs'][] = $this->title;

// $request = Yii::$app->request;
 
// $models = $dataProvider->getModels(); 
// // returns all parameters
// $params = $request->bodyParams;
//var_dump($models);
// // returns the parameter "id"
// $id = $request->getBodyParam('id');

$newQuery = clone $dataProvider->query;
$model1 = $newQuery->limit(1)->one();

//var_dump($model->district_id);
//$this->params['breadcrumbs'][] = \backend\models\Provinces::findOne($province_id)->name;
//$this->params['breadcrumbs'][] = \backend\models\Districts::findOne([Yii::$app->getUser()->identity->district_id])->name;
$months = [
    1 => "January", 2 => "February", 3 => "March", 4 => "April", 5 => "May", 6 => "June",
    7 => "July", 8 => "August", 9 => "September", 10 => "October", 11 => "November", 12 => "December"
];
$user = User::findOne(['id' => Yii::$app->user->id]);
//$access_level=1;
?>
<div class="card card-success card-outline">
    <div class="card-body">
   <p>
           
    
<?php
  echo Html::a('<span class="fas fa-arrow-left fa-2x"></span>', ['mpcd', 'id' =>$distr,'awpb_template_id'=>$model1->awpb_template_id], [
    'title' => 'back',
    'data-toggle' => 'tooltip',
    'data-placement' => 'top',
]);
  if (User::userIsAllowedTo('Submit Provincial AWPB') ) 
  {          echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    //  echo Html::a('Decline District AWPB',   ['awpb-comment/create', 'id' =>$model->district_id,'template_id'],  ['class' => 'float-right btn btn-success btn-sm btn-space']);       
     // ['awpb-activity-line/mpca', 'id' => $model->activity_id,'district_id'=>$model->district_id]
    
      // ["back-to-office-report/btor-report-view", 'id' => $row->id]

    //  'id' => $model->activity_id,'district_id'=>$model->district_id

    echo '<button class="float-right btn btn-success btn-sm btn-space" href="#" onclick="$(\'#addNewModal\').modal(); 
                            return false;"></i> Decline District AWPB </button>';
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
            [
                'attribute' => 'name',
                'format' => 'raw',
                'label' => 'Name',
                
             
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
    
                [
                    'class' => 'kartik\grid\ActionColumn',
                    'dropdown' => false,
                    'vAlign'=>'middle',
                    'template' => '{view}',
                    'urlCreator' => function($action, $model, $key, $index) { 
                            return Url::to(['viewp','id'=>$key]);
                    },
                      
                  
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
        }
        ?>
      

    <?=  GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
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
            
           echo $form->field($_model, 'awpb_template_id')->hiddenInput(['value'=>$model1->awpb_template_id])->label(false);
           echo $form->field($_model, 'district_id')->hiddenInput(['value'=> $distr])->label(false);
               
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