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
use backend\models\AwpbActivityLine;
use backend\models\AwpbActivityLineSearch;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\CommodityPriceCollectionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Provincial AWPB';
//$province_id = backend\models\Districts::findOne([Yii::$app->getUser()->identity->district_id])->province_id;
$this->params['breadcrumbs'][] = $this->title;

$user = User::findOne(['id' => Yii::$app->user->id]);
$access_level=1;
 global $province_id;
 $province_id = 0;
 
 $time = new \DateTime('now');
$today = $time->format('Y-m-d');
$template_model =  \backend\models\AwpbTemplate::find()->where(['status' =>\backend\models\AwpbTemplate::STATUS_PUBLISHED])->one();

?>
<div class="card card-success card-outline">
    <div class="card-body" style="overflow: auto;">
   <p>
           


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
        // [
        //     'attribute' => 'district_id',
        //     'format' => 'raw',
        //     'label' => 'District',
        //     'value' => function ($model) {
        //         return !empty($model->district_id) && $model->district_id > 0 ? Html::a($name, ['awpb-activity-line/index', 'id' => $model->district_id], ['class' => 'awbp-activity-line']): "";
        //     },
        //     'visible' => !empty($model->district_id) && $model->district_id > 0 ? TRUE : FALSE,
        // ],
         [
             'attribute' => 'province_id',
             'format' => 'raw',
             'label' => 'Province',
             'value' => function ($model)  {
                 return !empty($model->province_id) && $model->province_id > 0 ?  Html::a(backend\models\Provinces::findOne($model->province_id)->name,['awpb-budget/mpc', 'id'=>$model->awpb_template_id,'id2'=>$model->province_id,'status'=> \backend\models\AwpbBudget::STATUS_REVIEWED], ['class' => 'awbp-activity-line']):"";
                 ;
             },
         //     'visible' => !empty($model->district_id) && $model->district_id > 0 ? TRUE : FALSE,
          ],
//        [
//            'attribute' => 'district_id',
//            'format' => 'raw',
//            'label' => 'District',
//            'value' => function ($model) {
//                return !empty($model->district_id) && $model->district_id > 0 ?  Html::a(backend\models\Districts::findOne($model->district_id)->name,['mpcd','district_id' =>  $model->district_id,'awpb_template_id'=>$model->awpb_template_id], ['class' => 'mpcd']):"";
//                ;
//            },
//        //     'visible' => !empty($model->district_id) && $model->district_id > 0 ? TRUE : FALSE,
//         ],

        // [
        //     'attribute' => 'district_id',
        //     'label' => 'District', 
        //     'vAlign' => 'middle',
        //     'width' => '180px',

        //     'value' => function ($model) {
        //         $name =  \backend\models\Districts::findOne(['id' =>  $model->district_id])->name;
        //         return !empty($model->district_id) && $model->district_id > 0 ? Html::a($name, ['awpb-activity-line/index', 'id' => $model->district_id], ['class' => 'awbp-activity-line']): "";
        //           },
           
        //     // 'filterType' => GridView::FILTER_SELECT2,
        //     // 'filter' =>  \backend\models\AwpbActivity::getAwpbActivitiesList($access_level), 
        //     // 'filterWidgetOptions' => [
        //     //     'pluginOptions' => ['allowClear' => true],
        //     //     'options' => ['multiple' => true]
        //     // ],
        //     // 'filterInputOptions' => ['placeholder' => 'Filter by activity'],
        //     // 'format' => 'raw'
        // ],

        // [
        //     'label' => 'Activity Name',
        //           'value' =>  function ($model) {
        //             $name =  \backend\models\AwpbActivity::findOne(['id' =>  $model->activity_id])->name;
        //             return $name;
                      
        //           }
        //       ],

          
   

            // [
            //     'class' => 'kartik\grid\EditableColumn',
            //     'label' => 'Item Description',
            //     'attribute' => 'name',
            //     'readonly' =>true,
            //     'editableOptions' => [
            //         'header' => 'Name', 
            //         'inputType' => \kartik\editable\Editable::INPUT_TEXT,
                    
            //     ],
            //     'hAlign' => 'left', 
            //     'vAlign' => 'left',
            //    // 'width' => '7%',
              
            // ],


            // [
            //     'class' => 'kartik\grid\EditableColumn',
            //     'attribute' => 'unit_cost',
            //     'readonly' =>true,
            //     'refreshGrid' => true,
            //     'editableOptions' => [
            //         'header' => 'Unit Cost', 
            //         'inputType' => \kartik\editable\Editable::INPUT_SPIN,
            //         'options' => [
            //             'pluginOptions' => ['min' => 0, 'max'=>999999999999999999999]
            //         ]
            //     ],
            //     'hAlign' => 'right', 
            //     'vAlign' => 'middle',
            //     'width' => '7%',
            //     'format' => ['decimal', 2],
            //     'pageSummary' => false
            // ],

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
                                 [
                'class' => 'kartik\grid\ActionColumn',
                'vAlign'=>'middle',
                                     'width' => '7%',
            'template' => '{update} {delete}',
            'buttons' => [
                
                'update' => function ($url, $model) use ($user){
                  $awpb_province =  \backend\models\AwpbProvince::findOne(['awpb_template_id' =>$model->awpb_template_id, 'province_id'=>$model->province_id]);
                            $status=100;
                            if (!empty($awpb_province)) {
                              $status= $awpb_province->status;

                            }
                    if (((User::userIsAllowedTo('Approve AWPB - PCO') && $status == \backend\models\AwpbBudget::STATUS_REVIEWED) || (User::userIsAllowedTo('Approve AWPB - Ministry') && $status == \backend\models\AwpbBudget::STATUS_APPROVED ))&& ($user->province_id == 0 || $user->province_id == '')) {

                              
                        return Html::a(
                                        '<span class="fas fa-check"></span>',['submit','id'=>$model->awpb_template_id,'id2'=>$model->province_id,'status'=> \backend\models\AwpbBudget:: STATUS_APPROVED], [ 
                                    'title' => 'Approve Provincial AWPB',
                                    'data-toggle' => 'tooltip',
                                    'data-placement' => 'top',
                                    // 'target' => '_blank',
                                    'data-pjax' => '0',
                                   // 'style' => "padding:5px;",
                                    'class' => 'bt btn-lg'
                                        ]
                        );
                        
                    }
                },
                           'delete' => function ($url, $model) use ($user) {
                            $awpb_province =  \backend\models\AwpbProvince::findOne(['awpb_template_id' =>$model->awpb_template_id,'province_id'=>$model->province_id]);
                            $status=100;
                            if (!empty($awpb_province)) {
                              $status= $awpb_province->status;

                            }
                  if (((User::userIsAllowedTo('Approve AWPB - PCO') && $status == \backend\models\AwpbBudget::STATUS_REVIEWED) || (User::userIsAllowedTo('Approve AWPB - Ministry') && $status == \backend\models\AwpbBudget::STATUS_APPROVED ))&& ($user->province_id == 0 || $user->province_id == '')) {

                          
                        $province_id = $model->province_id;
                        return Html::a('<span class="fas fa-times-circle"></span>',
                    ['mp','province_id' => $model->province_id], 
                    [
                        'title' => 'Decline Provincial AWPB',
                        'data-toggle'=>'modal',
                        'data-target'=>'#addNewModal',
                    ]
                   );



                    }
                },
               
            ]]

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


            // [
            //     'attribute' => 'status', 'format' => 'raw',
            //     'value' => function($model) {
            //         $str = "";
            //         $id = 1;
            //         //if ($model->status == AwpbActivityLine::STATUS_SUBMITTED) {
            //             if ($id== 1) {
            //             $str = "<p style='margin:2px;padding:2px;display:inline-block;' class='badge badge-success'> "
            //                     . "<i class='fa fa-check'></i> Accepted</p><br>";
            //         } else {
            //             $str = "<p style='margin:2px;padding:2px;display:inline-block;' class='badge badge-info'> "
            //                     . "<i class='fa fa-hourglass-half'></i> Pending IKMO review</p><br>";
            //         }
            //         return $str;
            //     },
            // ],

            ];



        if ($dataProvider->getCount() > 0) {
            
        }
   
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
    //    }
        ?>
      

    <?=  GridView::widget([
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

                $form = ActiveForm::begin(['action' => Yii::$app->urlManager->createUrl(['awpb-budget/declinep']),])
                //$form = ActiveForm::begin(['action' => Yii::$app->urlManager->createUrl(['awpb-activity-line/decline','district_id' => $district_id,'awpb_template_id'=>  $awpb_template_id]),])
       
               //  'action' => 'add-activity?work_effort_id=' . $work_effort_id,
       ?>
        <?php
             //   $form = ActiveForm::begin(['type' => ActiveForm::TYPE_VERTICAL, 'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL],'options' => ['enctype' => 'multipart/form-data']]);
            //  $form = ActiveForm::begin(); 
           echo $form->field($_model, 'awpb_template_id')->hiddenInput(['value'=>$id ])->label(false);
           echo $form->field($_model, 'province_id')->hiddenInput(['value'=> $GLOBALS['province_id']])->label(false);
               
               // echo $form->field($_model, 'awpb_template_id')->textInput(['maxlength' => true,'value'=>$fiscal, 'class' => "form-control"]);
              //  echo $form->field($_model, 'district_id')->textInput(['maxlength' => true,'value'=>$distr,'class' => "form-control"]);
                //echo $form->field($model, 'name')->textInput(['maxlength' => true, 'class' => "form-control", 'placeholder' => 'Item description'])->label("Item description");
     
                           ?>
                
                <div class="row">
                    <div class="col-md-8">
        
                      
                        <?= $form->field($_model, 'description')->textarea(['rows' => 11, 'placeholder' =>"Comment"])->label("Comment");?>
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