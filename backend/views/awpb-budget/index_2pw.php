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
use yii\data\ActiveDataProvider;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\CommodityPriceCollectionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$template_model = \backend\models\AwpbTemplate::find()->where(['status' => \backend\models\AwpbTemplate::STATUS_CURRENT_BUDGET])->one();
if (!empty($template_model)){
$this->title =$template_model->fiscal_year. ' AWPB Input Variation';
//$province_id = backend\models\Districts::findOne([Yii::$app->getUser()->identity->district_id])->province_id;
$this->params['breadcrumbs'][] = $this->title;
}
//$this->params['breadcrumbs'][] = \backend\models\Provinces::findOne($province_id)->name;
//$this->params['breadcrumbs'][] = \backend\models\Districts::findOne([Yii::$app->getUser()->identity->district_id])->name;


$user = User::findOne(['id' => Yii::$app->user->id]);
//$role = \common\models\Role::findOne(['id' => $user->role])->role;
$access_level =1;
$time = new \DateTime('now');
$today = $time->format('Y-m-d');

 
 //$awpb_district->status=0;

$form = ActiveForm::begin(); 
$model = new backend\models\AwpbBudget_1();
?>

<div class="card card-success card-outline">
    <div class="card-body" style="overflow: auto;">

        <h3><?= Html::encode($this->title) ?> : Q<?= $template_model->quarter ?> </h3>
        <h5>Instructions</h5>
        <div class="row" style="">
            <div class="col-lg-6">
                
                  <?=
        $form->field($model, 'cost_centre_id', [
            'addon' => [
                'append' => [
                    'content' => Html::submitButton('Filter', ['name' => 'costCentre', 'value' => 'true', 'class' => 'btn btn-success btn-sm']),
                    'asButton' => true
                ]
            ]
        ])->dropDownList(
                    \backend\models\AwpbCostCentre::getAwpbCostCentreList(), ['prompt' => 'Please select a cost centre', 'required' => true]
            );
        
        ?>
            </div>
            
    <div class="col-lg-6">
        <ol>
          <li>Select the cost centre you wish to request funds for and click <span class="badge badge-success">Filter</span> button to view the budget for cost centre.
            </li>
           
            <li>Click the 
                <span class="badge badge-primary"><span class="fa fa-eye fa-1x"></span></span> 
                icon to vary the inputs
            </li>

        </ol>
    </div>
           </div>
        <?php ActiveForm::end();?>
        <?php
       if (!empty($cost_centre_id)){  
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
//[
//    'class' => 'kartik\grid\RadioColumn',
//    'width' => '36px',
//    'headerOptions' => ['class' => 'kartik-sheet-style'],
//],
//[
//    'class' => 'kartik\grid\ExpandRowColumn',
//    'width' => '50px',
//    'value' => function ($model, $key, $index, $column) {
//        return GridView::ROW_COLLAPSED;
//    },
//    // uncomment below and comment detail if you need to render via ajax
//    // 'detailUrl' => Url::to(['/site/book-details']),
//    'detail' => function ($model, $key, $index, $column) use ($id){
//      //return Yii::$app->controller->renderPartial('index_1_1', ['id' => $id,'id2'=>$model->district_id,'id4'=>$model->budget_id,'quarter'=>'Q1']);
//    },
//    'headerOptions' => ['class' => 'kartik-sheet-style'] ,
//    'expandOneOnly' => true
//],
            
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
    'attribute' => 'id',
     'header' => 'Activity', 
    'pageSummary' => 'Total',
    'vAlign' => 'middle',
    'width' => '450px',
     'readonly' => true,
     'value' => function ($model) {
         return !empty($model->activity_id) && $model->activity_id > 0 ? backend\models\AwpbActivity::findOne($model->activity_id)->name : "";
                        ;
      },

],
      

         [
             'attribute' => 'cost_centre_id',
             'label' => 'Cost Cntre', 
             'vAlign' => 'middle',
           //  'width' => '180px',

             'value' => function ($model) {
           return !empty($model->cost_centre_id) && $model->cost_centre_id > 0 ? \backend\models\AwpbCostCentre::findOne($model->cost_centre_id)->name : "";
            
                     },
           
              'filterType' => GridView::FILTER_SELECT2,
              'filter' =>  \backend\models\AwpbActivity::getAwpbActivitiesList($access_level), 
//              'filterWidgetOptions' => [
//                  'pluginOptions' => ['allowClear' => true],
//                  'options' => ['multiple' => true]
//              ],
              'filterInputOptions' => ['placeholder' => 'Filter by activity'],
              'format' => 'raw'
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
    'attribute' => 'quarter_one_amount', 
    'readonly' => function($model, $key, $index, $widget) {
        return (!$model->status); // do not allow editing of inactive records
    },
    'editableOptions' => [
        'header' => 'Q1 Budget', 
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
    'attribute' => 'quarter_two_amount',  'readonly' => true,
//    'readonly' => 
//    'readonly' => function($model, $key, $index, $widget) {
//        return (!$model->status); // do not allow editing of inactive records
//    },
    'editableOptions' => [
        'header' => 'Q2 Budget', 
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
//    'readonly' => 
//                            function($model, $key, $index, $widget) {
//        return (!$model->status); // do not allow editing of inactive records
//    },
    'editableOptions' => [
        'header' => 'Q3 Budget', 
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
        'header' => 'Q4 Budget', 
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
        'header' => 'Total Activity Budget', 
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
            

          ['class' => 'yii\grid\ActionColumn',
                    'options' => ['style' => 'width:50px;'],
                         'header' => 'Action', 
                    'template' => '{view}',
                    'buttons' => [
                        'view' => function ($url, $model) {
                            if (  User::userIsAllowedTo('View AWPB')||User::userIsAllowedTo("Request Funds")) {
                                return Html::a(
                                                '<span class="fa fa-eye"></span>', ['viewactualinput', 'id' =>$model->id], [
                                            'title' => 'View AWPB Input',
                                            'data-toggle' => 'tooltip',
                                            'data-placement' => 'top',
                                            'data-pjax' => '0',
                                            'style' => "padding:5px;",
                                            'class' => 'bt btn-lg'
                                                ]
                                );
                            }
                        },
                        
              
                    ]
                ],  
              
              
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
            $searchModel = new \backend\models\AwpbBudget_1();
            $query = $searchModel::find();
            
            $query->select(['awpb_template_id',  'component_id','activity_id','cost_centre_id','id',
                'SUM(quarter_one_amount) as quarter_one_amount',
                'SUM(quarter_two_amount) as quarter_two_amount', 
                'SUM(quarter_three_amount) as quarter_three_amount', 
                'SUM(quarter_four_amount) as quarter_four_amount',
                'SUM(total_amount) as total_amount']);
            //$query->join('LEFT JOIN', 'awpb_district', 'awpb_district.district_id = districk.id');
            $query->where(['awpb_template_id' =>  $template_model->id]);
            $query->andWhere(['cost_centre_id' => $cost_centre_id]);
           // $query->andWhere(['>', 'district_id', 0]);
          //  $query->andWhere(['=', 'status', $status]);
            $query->groupBy('id'); 
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
//   else
//            {
//               
//            Yii::$app->session->setFlash('error', 'No budget to request funds from.');
//           
//            }
//
// } else {
//            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
// return $this->redirect(['site/home']);
//
//            }
// ?>

<div class="row">
		<div class="col-md-12">
     
       </div>
</div>
    </div>
</div>
<?php
$this->registerCss('.popover-x {display:none}');
?>