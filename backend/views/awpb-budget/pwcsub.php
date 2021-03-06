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

$this->title = 'Programe-Wide AWPB Subcomponent';
//$province_id = backend\models\Districts::findOne([Yii::$app->getUser()->identity->district_id])->province_id;
$this->params['breadcrumbs'][] = $this->title;

$user = User::findOne(['id' => Yii::$app->user->id]);

$access_level = 1;
$time = new \DateTime('now');
$today = $time->format('Y-m-d');
$id=0;
$template_model = \backend\models\AwpbTemplate::find()->where(['status' => \backend\models\AwpbTemplate::STATUS_PUBLISHED])->one();
if (!empty($template_model)){
    $id= $template_model->id;
}
//$awpb_province = \backend\models\AwpbProvince::findOne(['awpb_template_id' => $id, 'province_id' => $id2]);
$status = 100;
\yii\web\YiiAsset::register($this);
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
                
                echo Html::a('Add a District AWPB Activity', ['createcspco','template_id'=>$template_model->id], ['class' => 'btn btn-success btn-sm']);
                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                   echo "</div>";
                      echo "<div class='col-md-2'>";
                 echo Html::a('Add an Programm-wide AWPB Activity', ['createpw','template_id'=>$template_model->id], ['class' => 'btn btn-success btn-sm']);
                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                   echo "</div>";
                    echo "<div class='col-md-3'>";
                    echo "</div>";
                     echo "</div>";
           }
//           if (User::userIsAllowedTo('Manage AWPB') &&  !empty($template_model)&& strtotime($template_model->review_deadline) >= strtotime($today) && ($user->province_id > 0 || $user->province_id !== '')){
//         
//                echo Html::a('Add an AWPB Activity', ['createcspco','template_id'=>$template_model->id], ['class' => 'btn btn-success btn-sm']);
//                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
//           }
?>
         <p>
             
             
                <?php
                $form = ActiveForm::begin([
                ]);
                ?>
             
             <div clas="row">
            <div class="col-lg-12">
                <div class="card card-success card-outline card-tabs">
                    <div class="card-header p-0 pt-1 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="component-tab" data-toggle="pill" href="#component" role="tabs" aria-controls="component" aria-selected="true">Component</a>
                            </li>

                            
                            
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-two-tabContent">


                            <div class="tab-pane fade show active" id="component" role="tabpanel" aria-labelledby="component-tab">
 <?php
        if (!empty($template_model)){  
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
             'attribute' => 'awpb_template_id',
             'label' => 'Fiscal Year', 
             'vAlign' => 'middle',
             'width' => '7%',

             'value' => function ($model) {
                 $name =  \backend\models\AwpbTemplate::findOne(['id' =>  $model->awpb_template_id])->fiscal_year;
                 return Html::a($name, ['awpb-template/view', 'id' => $model->awpb_template_id], ['class' => 'awbp-template']);
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
                    'attribute' => 'component_id',
                    'label' => 'Component',
                    'vAlign' => 'middle',
                    //'width' => '7%',
                    'value' => function ($model, $key, $index, $widget) use($user){
                        $component = \backend\models\AwpbComponent::findOne(['id' => $model->component_id]);

//                       // return !empty($component) ? $component->code .' '.$component->name : "";
//                          if (User::userIsAllowedTo('Manage AWPB') && ($user->province_id == 0 || $user->province_id == '')) {

                        return !empty($component) ? Html::a($component->code .' '.$component->name, ['pwca', 'id' => $model->component_id ], ['class' => 'mpcd']) : "";
//                          }
//                            if (User::userIsAllowedTo('Approve AWPB') && ($user->province_id == 0 || $user->province_id == '')) {
//
//                        return !empty($component) ? Html::a($component->code .' '.$component->name, ['pwca', 'id' => $model->component_id ], ['class' => 'mpcd']) : "";
//                          }
                          
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
        'vAlign' => 'middle',
        'width' => '10%',
        'template' => '{mpc}',
        'buttons' => [

            'mpc' => function ($url, $model) use ($user, $template_model, $today) {
                    return Html::a(
                                    '<span class="fa fa-eye"></span>', ['pwca', 'id' => $model->component_id ], [
                                'title' => 'View AWPB by District',
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
        }
?>
 
</div>
      
</div>
             
                    </div>
 <?php ActiveForm::end(); ?>


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
           //echo $form->field($_model, 'province_id')->hiddenInput(['value'=> $GLOBALS['province_id']])->label(false);
               
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