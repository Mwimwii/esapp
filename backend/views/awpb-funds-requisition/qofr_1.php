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



//$this->params['breadcrumbs'][] = \backend\models\Provinces::findOne($province_id)->name;
//$this->params['breadcrumbs'][] = \backend\models\Districts::findOne([Yii::$app->getUser()->identity->district_id])->name;

$user = User::findOne(['id' => Yii::$app->user->id]);
//$budget = AwpbBudget::findOne(['id'=>$modid]);
//$model = new backend\models\AwpbInput();
//$access_level=1;
$status = 1;
$template_model = \backend\models\AwpbTemplate::find()->where(['status' => \backend\models\AwpbTemplate::STATUS_CURRENT_BUDGET])->one();
//district_model = \backend\models\AwpbDistrict::findOne(['district_id' => $user->district_id,'awpb_template_id'=>$template_model->id]);

?>
<div class="card card-success card-outline">
    <div class="card-body" style="overflow: auto;">

<?php

if (User::userIsAllowedTo('Request Funds') && ( $user->district_id > 0 || $user->district_id != '')) {
    $status = 0;
    if (!empty($district_model)){
        
          if (
                  ($template_model->quarter==1 && $district_model->status_q_1 ==0 )||
                  ($template_model->quarter== 2 &&$district_model->status_q_2 ==0 )||
                  ($template_model->quarter== 3 &&$district_model->status_q_32 ==0 )||
                  ($template_model->quarter== 4 &&$district_model->status_q_4 ==0 )
                  )
            {
              
        
        
    echo Html::a(
            '<span class="btn btn-success float-right">Submit Funds Request</span>', ['awpb-funds-requisition/frd'], [
        'title' => 'Submit Funds Request',
        'data-toggle' => 'tooltip',
        'data-placement' => 'top',
        // 'target' => '_blank',
        'data-pjax' => '0',
        // 'style' => "padding:5px;",
        'class' => 'bt btn-lg',
               'data'=>[

        'method' => 'post',

       
             'params'=>['id' => $user->district_id],
       // 'params'=>['MyParam1'=>'100', 'MyParam2'=>true],

            ]]
    );
    }
 else {
          echo Html::a('<span class="btn btn-small btn-info"> <h6>  Quarter '.$template_model->quarter.' funds have already been requested.</h6></span>',"",  [
                                            'title' => '',
                                            'data-toggle' => 'tooltip',
                                            'data-placement' => '',
                                            'data-pjax' => '0',
                                            'style' => "padding:5px;",
                                            'class' => 'float-right bt btn-lg'
         
                                                ]
                                );
    }
    } 
}
?>

        <?php
        $mo1="";
           $mo2="";
              $mo3="";
          if ($template_model->quarter==1 ){
              $mo1="Jan";
           $mo2="Feb";
              $mo3="Mar";
          }
             if ($template_model->quarter==2 ){
              $mo1="Apr";
           $mo2="May";
              $mo3="Jun";
          }
               if ($template_model->quarter==3 ){
              $mo1="Jul";
           $mo2="Aug";
              $mo3="Sep";
          }  
             if ($template_model->quarter==2 ){
              $mo1="Oct";
           $mo2="Nov";
              $mo3="Dec";
          }
           
        
        
        
        
        //$gridColumns ="";
        //$id3 = 0;

        //$id3 = 1;
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
                    return Yii::$app->controller->renderPartial('qofri_1', ['id' => $model->budget_id]);
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
            ], [
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
                },],
            [
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'camp_id',
                'header' => 'Camp',
                'pageSummary' => 'Total',
                'vAlign' => 'middle',
                'width' => '50px',
                'readonly' => true,
                'value' => function ($model) {
                    return !empty($model->camp_id) && $model->camp_id > 0 ? backend\models\Camps::findOne($model->camp_id)->name : "";
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
                'label' => $mo1. ' Budget',
                'readonly' => function ($model, $key, $index, $widget) {
                    return (!$model->status); // do not allow editing of inactive records
                },
                'editableOptions' => [
                    'header' => $mo1. ' Budget',
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
                'label' => $mo2. ' Budget',
                'attribute' => 'mo_2_amount', 'readonly' => true,
//    'readonly' => 
//    'readonly' => function($model, $key, $index, $widget) {
//        return (!$model->status); // do not allow editing of inactive records
//    },
                'editableOptions' => [
                    'header' => $mo2. ' Budget',
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
                'label' => $mo3. ' Budget',
                'attribute' => 'mo_3_amount',
                'readonly' => true,
//    'readonly' => 
//                            function($model, $key, $index, $widget) {
//        return (!$model->status); // do not allow editing of inactive records
//    },
                'editableOptions' => [
                    'header' => $mo3. ' Budget',
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
                'label' => 'Q' .$template_model->quarter. ' Budget',
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
//            ['class' => 'yii\grid\ActionColumn',
//                'options' => ['style' => 'width:50px;'],
//                'header' => 'Action',
//                'template' => '{view}',
//                'buttons' => [
//                    'view' => function ($url, $model) use ($user) {
//                        if (User::userIsAllowedTo('Request Funds') && ( $user->district_id > 0 || $user->district_id != '')) {
//                            return Html::a(
//                                            '<span class="fa fa-eye"></span>', ['awpb-budget/view_1', 'id' => $model->budget_id, 'status' => 0], [
//                                        'title' => 'View AWPB',
//                                        'data-toggle' => 'tooltip',
//                                        'data-placement' => 'top',
//                                        'data-pjax' => '0',
//                                        'style' => "padding:5px;",
//                                        'class' => 'bt btn-lg'
//                                            ]
//                            );
//                        }
//                    },
////                   
////               
//                ]]
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


       

        if (User::userIsAllowedTo('Request Funds') && ( $user->district_id != 0 || $user->district_id != '')) {
             $searchModel = new AwpbActualInput();
            if ($template_model->quarter == 1) {
                $query = $searchModel::find();
                $query->select(['awpb_actual_input.awpb_template_id as awpb_template_id',
                    'awpb_actual_input.district_id as district_id', 
                    'awpb_actual_input.component_id as component_id',
                    'awpb_actual_input.activity_id as activity_id', 
                     'awpb_actual_input.camp_id as camp_id',  'id',
                    'budget_id',
                    'SUM(awpb_actual_input.mo_1_amount) as mo_1_amount',
                    'SUM(awpb_actual_input.mo_2_amount) as mo_2_amount',
                    'SUM(awpb_actual_input.mo_3_amount) as mo_3_amount',
                    'SUM(awpb_actual_input.quarter_one_amount) as quarter_one_amount']);
                 $query->where(['=', 'awpb_actual_input.awpb_template_id',$template_model->id]);
                $query->andWhere(['=', 'awpb_actual_input.district_id', $id2]);
                $query->groupBy('budget_id');
                $query->all();

                $query->all();
                $dataProvider = new ActiveDataProvider([
                    'query' => $query,
                ]);
            } elseif ($template_model->quarter == 2) {
             $query = $searchModel::find();
                $query->select(['awpb_actual_input.awpb_template_id as awpb_template_id',
                    'awpb_actual_input.district_id as district_id', 
                    'awpb_actual_input.component_id as component_id',
                    'awpb_actual_input.activity_id as activity_id', 
                     'awpb_actual_input.camp_id as camp_id',  'id',
                    'budget_id', 
                    'SUM(awpb_actual_input.mo_4_amount) as mo_1_amount', 
                    'SUM(awpb_actual_input.mo_5_amount) as mo_2_amount', 
                    'SUM(awpb_actual_input.mo_6_amount) as mo_3_amount', 
                    'SUM(awpb_actual_input.quarter_two_amount) as quarter_one_amount']);
                $query->where(['=', 'awpb_actual_input.awpb_template_id',$template_model->id]);
                $query->andWhere(['=', 'awpb_actual_input.district_id', $id2]);
                $query->groupBy('budget_id');
                $query->all();
                $dataProvider = new ActiveDataProvider([
                    'query' => $query,
                ]);
            } elseif ($template_model->quarter == 3) {
             $query = $searchModel::find();
                $query->select(['awpb_actual_input.awpb_template_id as awpb_template_id',
                    'awpb_actual_input.district_id as district_id', 
                    'awpb_actual_input.component_id as component_id',
                    'awpb_actual_input.activity_id as activity_id', 
                     'awpb_actual_input.camp_id as camp_id',  'id',
                    'budget_id', 
                    'SUM(awpb_actual_input.mo_7_amount) as mo_1_amount', 
                    'SUM(awpb_actual_input.mo_8_amount) as mo_2_amount', 
                    'SUM(awpb_actual_input.mo_9_amount) as mo_3_amount', 
                    'SUM(awpb_actual_input.quarter_three_amount) as quarter_one_amount']);
                $query->where(['=', 'awpb_actual_input.awpb_template_id',$template_model->id]);
                $query->andWhere(['=', 'awpb_actual_input.district_id', $id2]);
                $query->groupBy('budget_id');
                $query->all();
                $dataProvider = new ActiveDataProvider([
                    'query' => $query,
                ]);
            } elseif ($template_model->quarter == 4) {
                $query = $searchModel::find();
                $query->select(['awpb_actual_input.awpb_template_id as awpb_template_id',
                    'awpb_actual_input.district_id as district_id', 
                    'awpb_actual_input.component_id as component_id',
                    'awpb_actual_input.activity_id as activity_id', 
                     'awpb_actual_input.camp_id as camp_id',  'id',
                    'budget_id', 
                    'SUM(awpb_actual_input.mo_10_amount) as mo_1_amount', 
                    'SUM(awpb_actual_input.mo_11_amount) as mo_2_amount', 
                    'SUM(awpb_actual_input.mo_12_amount) as mo_3_amount', 
                    'SUM(awpb_actual_input.quarter_four_amount) as quarter_one_amount']);
                $query->where(['=', 'awpb_actual_input.awpb_template_id',$template_model->id]);
                $query->andWhere(['=', 'awpb_actual_input.district_id', $id2]);
                $query->groupBy('budget_id');
                $query->all();
                $dataProvider = new ActiveDataProvider([
                    'query' => $query,
                ]);
            }
//        } elseif (User::userIsAllowedTo('Review Funds Request') && ( $user->province_id != 0 || $user->province_id != '')) {
//            $query = $searchModel::find();
//            $query->select(['awpb_template_id', 'district_id', 'component_id', 'activity_id', 'camp_id', 'cost_centre_id', 'budget_id', 'SUM(mo_7_amount) as mo_1_amount', 'SUM(mo_8_amount) as mo_2_amount', 'SUM(mo_9_amount) as mo_3_amount', 'SUM(quarter_three_amount) as quarter_amount']);
//            $query->where(['=', 'awpb_template_id', $template_model->id]);
//            $query->andWhere(['=', 'district_id', $id2]);
//            $query->andWhere(['=', 'quarter_number', $template_model->quarter]);
//            $query->andWhere(['=', 'status', AwpbActualInput::STATUS_DISTRICT]);
//            $query->groupBy('budget_id');
//            $query->all();
//
//            $dataProvider = new ActiveDataProvider([
//                'query' => $query,
//            ]);
        }
        elseif (User::userIsAllowedTo('Approve Funds Requisition') && ($user->province_id == 0 || $user->province_id == '')) 
        {
            if ($id3==1){
            $searchModel = new backend\models\AwpbFundsRequisition();     
            $query = $searchModel::find();
            $query->select(['awpb_template_id', 'district_id', 'component_id', 'activity_id', 'camp_id', 'cost_centre_id', 'budget_id',
                'SUM(mo_1_amount) as mo_1_amount', 'SUM(mo_2_amount) as mo_2_amount', 'SUM(mo_3_amount) as mo_3_amount', 'SUM(quarter_amount) as quarter_amount']);
            $query->where([ 'awpb_template_id'=> $template_model->id]);
            
            $query->andWhere([ 'district_id'=> $id2]);
                     
            $query->andWhere([ 'quarter_number'=> $template_model->quarter]);
            //$query->andWhere(['=', 'status', AwpbActualInput::STATUS_PROVINCIAL]);
            $query->groupBy('budget_id');
            $query->all();

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);
        }else if ($id3==2){
            
             $searchModel = new backend\models\AwpbFundsRequisition();     
            $query = $searchModel::find();
            $query->select(['awpb_template_id', 'district_id', 'component_id', 'activity_id', 'camp_id', 'cost_centre_id', 'budget_id',
                'SUM(mo_1_amount) as mo_1_amount', 'SUM(mo_2_amount) as mo_2_amount', 'SUM(mo_3_amount) as mo_3_amount', 'SUM(quarter_amount) as quarter_amount']);
            $query->where([ 'awpb_template_id'=> $template_model->id]);
          
            $query->andWhere([ 'cost_centre_id'=> $id2]);
             
            $query->andWhere([ 'quarter_number'=> $template_model->quarter]);
            //$query->andWhere(['=', 'status', AwpbActualInput::STATUS_PROVINCIAL]);
            $query->groupBy('budget_id');
            $query->all();

        }
            
            
            
        }
        elseif (User::userIsAllowedTo('Disburse Funds') && ($user->province_id == 0 || $user->province_id == '')) {
           if ($id3==1){
            $searchModel = new backend\models\AwpbFundsRequisition();  
            $query = $searchModel::find();
            $query->select(['awpb_template_id', 'district_id', 'component_id', 'activity_id', 'camp_id', 'cost_centre_id', 'budget_id',
                'SUM(mo_1_amount) as mo_1_amount', 'SUM(mo_2_amount) as mo_2_amount', 'SUM(mo_3_amount) as mo_3_amount', 'SUM(quarter_amount) as quarter_amount']);
            $query->where(['awpb_template_id'=> $template_model->id]);
            $query->andWhere(['quarter_number'=> $template_model->quarter]);
             $query->andWhere([ 'district_id'=> $id2]);
            //$query->andWhere(['=', 'status', AwpbActualInput::STATUS_SPECIALIST]);
            $query->groupBy('budget_id');
            $query->all();

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);
            
             }else if ($id3==2){
                 
                 $searchModel = new backend\models\AwpbFundsRequisition();  
            $query = $searchModel::find();
            $query->select(['awpb_template_id', 'district_id', 'component_id', 'activity_id', 'camp_id', 'cost_centre_id', 'budget_id',
                'SUM(mo_1_amount) as mo_1_amount', 'SUM(mo_2_amount) as mo_2_amount', 'SUM(mo_3_amount) as mo_3_amount', 'SUM(quarter_amount) as quarter_amount']);
            $query->where(['awpb_template_id'=> $template_model->id]);
         
            $query->andWhere([ 'cost_centre_id'=> $id2]);
           
            $query->andWhere(['quarter_number'=> $template_model->quarter]);
            //$query->andWhere(['=', 'status', AwpbActualInput::STATUS_SPECIALIST]);
            $query->groupBy('budget_id');
            $query->all();

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);
            
             }
             
        } else {
            $query = $searchModel::find();
            $query->select(['awpb_template_id', 'district_id', 'component_id', 'activity_id', 'camp_id', 'cost_centre_id', 'budget_id',
                'SUM(mo_1_amount) as mo_1_amount', 'SUM(mo_2_amount) as mo_2_amount', 'SUM(mo_3_amount) as mo_3_amount', 'SUM(quarter_amount) as quarter_amount']);
            $query->where(['=', 'awpb_template_id',0]);
            $query->andWhere(['=', 'district_id', 0]);
            $query->andWhere(['=', 'quarter_number', 0]);
            $query->andWhere(['=', 'status', 10]);
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