<?php
use backend\models\AwpbBudget;
use backend\models\AwpbInput;
use backend\models\AwpbInputSearch;
use backend\models\AwpbActualInput;
use backend\models\AwpbActualInputSearch;
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

$user = User::findOne(['id' => Yii::$app->user->id]);
//$budget = AwpbBudget::findOne(['id'=>$modid]);
//$model = new backend\models\AwpbInput();
//$access_level=1;
$status=1;
$template_model =  \backend\models\AwpbTemplate::find()->where(['status' =>\backend\models\AwpbTemplate::STATUS_CURRENT_BUDGET])->one();
$this->title = 'Quarterly Operations Funds Requisition for Quarter '. $template_model->quarter;
//$province_id = backend\models\Districts::findOne([Yii::$app->getUser()->identity->district_id])->province_id;
$this->params['breadcrumbs'][] = $this->title;

//$this->params['breadcrumbs'][] = \backend\models\Provinces::findOne($province_id)->name;
//$this->params['breadcrumbs'][] = \backend\models\Districts::findOne([Yii::$app->getUser()->identity->district_id])->name;

?>
<div class="card card-success card-outline">
    <div class="card-body" style="overflow: auto;">
         <h3><?= Html::encode($this->title) ?></h3>

        <p>
            <?php
           // var_dump($template_model->id);
            if (User::userIsAllowedTo("Request Funds")&& ($user->province_id == 0 || $user->province_id == '')) {

              $status=0;
                      echo Html::a(
                                        '<span class="btn btn-success float-right">Submit Request</span>',['awpb-district/submit','id'=>$template_model->id,'id2'=>$user->district_id,'status'=> \backend\models\AwpbDistrict::STATUS_QUARTER_REQUESTED], [ 
                                    'title' => 'Submit Funds Request',
                                    'data-toggle' => 'tooltip',
                                    'data-placement' => 'top',
                                    // 'target' => '_blank',
                                    'data-pjax' => '0',
                                   // 'style' => "padding:5px;",
                                    'class' => 'bt btn-lg'
                                        ]
                        );
            }
            ?>

        </p>

   <?php
 //$gridColumns ="";
$id3=0;
 
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
    'detail' => function ($model, $key, $index, $column) {
       return Yii::$app->controller->renderPartial('qofri', ['id' => $model->budget_id]);
    },
  //  'headerOptions' => ['class' => 'kartik-sheet-style'] ,
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
    'label' => 'Month 1 Budget', 
    'readonly' => function($model, $key, $index, $widget) {
        return (!$model->status); // do not allow editing of inactive records
    },
    'editableOptions' => [
        'header' => 'Month 1 Budget', 
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
                 'label' => 'Month 2 Budget', 
    'attribute' => 'mo_2_amount',  'readonly' => true,
//    'readonly' => 
//    'readonly' => function($model, $key, $index, $widget) {
//        return (!$model->status); // do not allow editing of inactive records
//    },
    'editableOptions' => [
        'header' => 'Month 2 Budget', 
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
                             'label' => 'Month 3 Budget', 
    'attribute' => 'mo_3_amount', 
                            'readonly' => true,
//    'readonly' => 
//                            function($model, $key, $index, $widget) {
//        return (!$model->status); // do not allow editing of inactive records
//    },
    'editableOptions' => [
        'header' => 'Month 3 Budget', 
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
                             'label' => 'Quarter Budget', 
    'attribute' => 'quarter_amount', 
                            'readonly' => true,

    'editableOptions' => [
        'header' => 'Quarter Budget', 
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
                        'view' => function ($url, $model) use($user){
                             if (User::userIsAllowedTo('Request Funds') && ( $user->district_id > 0 || $user->district_id != ''))
                             {
                                return Html::a(
                                                '<span class="fa fa-eye"></span>', ['awpb-budget/view_1', 'id' => $model->budget_id,'status'=>0], [
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
            

//                   
//               
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
          
//          // $awpb_district = \backend\models\AwpbTemplate::findOne(['awpb_template_id' =>$id, 'district_id'=>$user->district_id]);
//
//        //  $query->join('LEFT JOIN', 'post', 'post.user_id = user.id');
//            $searchModel = new AwpbActualInput();
//            $query = $searchModel::find();
//            
//            $query->select(['awpb_template_id',  'district_id','component_id','activity_id','budget_id','SUM(mo_1_amount) as mo_1_amount',  'SUM(mo_2_amount) as mo_2_amount',  'SUM(mo_3_amount) as mo_3_amount', 'SUM(quarter_amount) as quarter_amount']);
//            //$query->join('LEFT JOIN', 'awpb_district', 'awpb_district.district_id = districk.id');
//            $query->where(['=','awpb_template_id', $template_model->id]);
//          
//            $query->andWhere(['=', 'district_id',$id2]);
//           $query->andWhere(['=', 'quarter_number', $template_model->quarter]);
//           
//           $query->andWhere(['=','status',$status]);
//            $query->groupBy('budget_id'); 
//            $query->all();
//
//            $dataProvider = new ActiveDataProvider([
//                'query' => $query,
//            ]);
          

            $searchModel = new AwpbActualInput();
                    
               
      if (User::userIsAllowedTo("Request Funds")&& ($user->province_id == 0 || $user->province_id == '')) 
         {$searchModel = new \backend\models\AwpbFundsRequisition();
                $query = $searchModel::find();
                $query->select(['awpb_template_id',  'district_id','component_id','activity_id','budget_id','SUM(mo_1_amount) as mo_1_amount',  'SUM(mo_2_amount) as mo_2_amount',  'SUM(mo_3_amount) as mo_3_amount', 'SUM(quarter_amount) as quarter_one_amount']);
                $query->where(['=','awpb_template_id', $template_model->id]);
                $query->andWhere(['=', 'created_by',$user->id]);
                $query->andWhere(['=', 'quarter_number', $template_model->quarter]);
              //  $query->andWhere(['=','status', AwpbActualInput::STATUS_NOT_REQUESTED]);
                $query->groupBy('budget_id'); 
                $query->all();     
                $dataProvider = new ActiveDataProvider([
                    'query' => $query,
                ]);
              
//            }
//            elseif (User::userIsAllowedTo('Review Funds Request') && ( $user->province_id != 0 || $user->province_id != ''))
//            {
//                $query = $searchModel::find();
//                $query->select(['awpb_template_id',  'district_id','component_id','activity_id','budget_id','SUM(mo_1_amount) as mo_1_amount',  'SUM(mo_2_amount) as mo_2_amount',  'SUM(mo_3_amount) as mo_3_amount', 'SUM(quarter_amount) as quarter_amount']);
//                $query->where(['=','awpb_template_id', $template_model->id]);
//            $query->andWhere(['=', 'created_by',$user->id]);
//                $query->andWhere(['=', 'quarter_number', $template_model->quarter]);
//                $query->andWhere(['=','status', AwpbActualInput::STATUS_DISTRICT]);
//                $query->groupBy('budget_id'); 
//                $query->all();
//
//                $dataProvider = new ActiveDataProvider([
//                    'query' => $query,
//                ]);

                           } elseif (User::userIsAllowedTo('Approve Funds Requisition') && ($user->province_id == 0 || $user->province_id == '')) {
             $query = $searchModel::find();
                               $query->select(['awpb_template_id',  'district_id','component_id','activity_id','budget_id','SUM(mo_1_amount) as mo_1_amount',  'SUM(mo_2_amount) as mo_2_amount',  'SUM(mo_3_amount) as mo_3_amount', 'SUM(quarter_amount) as quarter_amount']);
            $query->where(['=','awpb_template_id', $template_model->id]);
           $query->andWhere(['=', 'created_by',$user->id]);
           // $query->andWhere(['=', 'quarter_number', $template_model->quarter]);
            $query->andWhere(['=','status', AwpbActualInput::STATUS_DISTRICT]);
            $query->groupBy('budget_id'); 
            $query->all();
            
             $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);

                
            } 
            elseif (User::userIsAllowedTo('Disburse Funds') && ($user->province_id == 0 || $user->province_id == '')) 
            {
                $query = $searchModel::find();
                $query->select(['awpb_template_id',  'district_id','component_id','activity_id','budget_id','SUM(mo_1_amount) as mo_1_amount',  'SUM(mo_2_amount) as mo_2_amount',  'SUM(mo_3_amount) as mo_3_amount', 'SUM(quarter_amount) as quarter_amount']);
                $query->where(['=','awpb_template_id', $template_model->id]);
             // $query->andWhere(['=', 'created_by',$user->id]);
                $query->andWhere(['=', 'quarter_number', $template_model->quarter]);
                $query->andWhere(['=','status', AwpbActualInput::STATUS_SPECIALIST]);
                $query->groupBy('budget_id'); 
                $query->all();

                 $dataProvider = new ActiveDataProvider([
                    'query' => $query,
                ]);
                
            }          
  else
            {
                $query = $searchModel::find();
                $query->select(['awpb_template_id',  'district_id','component_id','activity_id','budget_id','SUM(mo_1_amount) as mo_1_amount',  'SUM(mo_2_amount) as mo_2_amount',  'SUM(mo_3_amount) as mo_3_amount', 'SUM(quarter_amount) as quarter_amount']);
                $query->where(['=','awpb_template_id', $template_model->id]);
                $query->andWhere(['=', 'district_id',$id2]);
                $query->andWhere(['=', 'quarter_number', $template_model->quarter]);
                $query->andWhere(['=','status', 10]);
                $query->groupBy('budget_id'); 
                $query->all();

                 $dataProvider = new ActiveDataProvider([
                    'query' => $query,
                ]);
                
            }            
          
          
          
          
          
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
  




// } else {
//            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
//            return $this->redirect(['site/home']);
//
//            }
            ?>

        
    </div>
</div>
         <?php
        $this->registerCss('.popover-x {display:none}');
        ?>