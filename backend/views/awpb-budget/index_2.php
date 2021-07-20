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

$this->title = 'AWPB';
//$province_id = backend\models\Districts::findOne([Yii::$app->getUser()->identity->district_id])->province_id;
$this->params['breadcrumbs'][] = $this->title;

//$this->params['breadcrumbs'][] = \backend\models\Provinces::findOne($province_id)->name;
//$this->params['breadcrumbs'][] = \backend\models\Districts::findOne([Yii::$app->getUser()->identity->district_id])->name;


$user = User::findOne(['id' => Yii::$app->user->id]);
$role = \common\models\Role::findOne(['id' => $user->role])->role;
$access_level =1;
$time = new \DateTime('now');
$today = $time->format('Y-m-d');
$template_model =  \backend\models\AwpbTemplate::find()->where(['status' =>\backend\models\AwpbTemplate::STATUS_CURRENT_BUDGET])->one();

//$awpb_district = \backend\models\AwpbDistrict::findOne(['awpb_template_id'=> $id,'district_id'=>$user->district_id]);
//$_awpb_district = new \backend\models\AwpbDistrict();
$awpb_district =  \backend\models\AwpbDistrict::findOne(['awpb_template_id' =>$id, 'district_id'=>$user->district_id]);
$status=100;

 
 //$awpb_district->status=0;
?>
<div class="card card-success card-outline">
    <div class="card-body" style="overflow: auto;">
   <p>
           
            <?php
   
          
  //  if (User::userIsAllowedTo('Manage AWPB')&& $user->district_id>0 ||$user->district_id!='') {
     
  if (User::userIsAllowedTo("Request Funds")) 
       {
                                 
        

                       
$awpb_district = \backend\models\AwpbDistrict::findOne(['awpb_template_id' => $id, 'district_id'=>$user->district_id]);
$awpb_province = \backend\models\AwpbProvince::findOne(['awpb_template_id' => $id, 'province_id'=>$user->province_id]);
//$budgeted_input = \backend\models\AwpbInput::find()->where(['budget_id'=>$id4])->sum('total_amount');
//$budget = \backend\models\AwpbActualInput::find()->where(['budget_id'=>$id4])->sum('total_amount');
           
       
  if($awpb_province->status== \backend\models\AwpbBudget::STATUS_MINISTRY && $awpb_district->status== \backend\models\AwpbBudget::STATUS_MINISTRY ) 
  {
            ?>

        </p>



        <?php
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
                        'view' => function ($url, $model) use ($status){
                            if (  User::userIsAllowedTo('View AWPB')) {
                                return Html::a(
                                                '<span class="fa fa-eye"></span>', ['view_1', 'id' =>$model->budget_id], [
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
            $searchModel = new \backend\models\AwpbInput();
            $query = $searchModel::find();
            
            $query->select(['awpb_template_id',  'component_id','activity_id','budget_id','SUM(quarter_one_amount) as quarter_one_amount',  'SUM(quarter_two_amount) as quarter_two_amount',  'SUM(quarter_three_amount) as quarter_three_amount', 'SUM(quarter_four_amount) as quarter_four_amount','SUM(total_amount) as total_amount']);
            //$query->join('LEFT JOIN', 'awpb_district', 'awpb_district.district_id = districk.id');
            $query->where(['awpb_template_id' => $id]);
            $query->where(['district_id' => $user->district_id]);
           // $query->andWhere(['>', 'district_id', 0]);
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
   else
            {
               
            Yii::$app->session->setFlash('error', 'No budget to request funds from.');
           
            }

 } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
 return $this->redirect(['site/home']);

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