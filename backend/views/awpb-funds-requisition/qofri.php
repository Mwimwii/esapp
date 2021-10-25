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
use backend\models\AwpbActualInput;
use backend\models\AwpbActualInputSearch;
use backend\models\AwpbDistrict;
use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CommodityPriceCollectionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'Quarterly Operations Funds Requisition';
//$province_id = backend\models\Districts::findOne([Yii::$app->getUser()->identity->district_id])->province_id;
//$this->params['breadcrumbs'][] = $this->title;
//$this->params['breadcrumbs'][] = \backend\models\Provinces::findOne($province_id)->name;
//$this->params['breadcrumbs'][] = \backend\models\Districts::findOne([Yii::$app->getUser()->identity->district_id])->name;
$status = 1;
?>
<div class="card card-success card-outline">
    <div class="card-body" style="overflow: auto;">
<?php
$user = User::findOne(['id' => Yii::$app->user->id]);
$template_model = \backend\models\AwpbTemplate::find()->where(['status' => \backend\models\AwpbTemplate::STATUS_CURRENT_BUDGET])->one();
if (User::userIsAllowedTo('Request Funds') && ($user->district_id > 0 || $user->district_id != '')) {
//              $status=0;
//         echo Html::a('<span class="btn btn-success btn-sm">Click here to vary the Activty input/s</span>', ['awpb-budget/view_1', 'id' => $id], [
//                    'title' => 'Submit Provincial AWPB',
//                    'data-toggle' => 'tooltip',
//                    'data-placement' => 'top',
//                    // 'target' => '_blank',
//                    'data-pjax' => '0',
//                    // 'style' => "padding:5px;",
//                    'class' => 'bt btn-lg'
//                        ]
//                );
    //  echo Html::a('<i class="fa fa-plus"></i> Add AWPB Input', ['awpb-actual-input/create', 'id'=>$model->id], ['class' => 'btn btn-success btn-sm']);
}


$mo1 = "";
$mo2 = "";
$mo3 = "";
if ($template_model->quarter == 1) {
    $mo1 = "Jan";
    $mo2 = "Feb";
    $mo3 = "Mar";
}
if ($template_model->quarter == 2) {
    $mo1 = "Apr";
    $mo2 = "May";
    $mo3 = "Jun";
}
if ($template_model->quarter == 3) {
    $mo1 = "Jul";
    $mo2 = "Aug";
    $mo3 = "Sep";
}
if ($template_model->quarter == 2) {
    $mo1 = "Oct";
    $mo2 = "Nov";
    $mo3 = "Dec";
}

$gridColumns = [
    [
        'class' => 'kartik\grid\SerialColumn',
        'contentOptions' => ['class' => 'kartik-sheet-style'],
        'width' => '36px',
        'pageSummary' => 'Total',
        'pageSummaryOptions' => ['colspan' => 4],
        'header' => '',
        'headerOptions' => ['class' => 'kartik-sheet-style']
    ],
//      [
//                            'class' => 'kartik\grid\EditableColumn',
//                            'label' => 'Quarter',
//                            'attribute' => 'quarter_number',
//                            'readonly' => true,
//                            'filter' => false,
//                            'editableOptions' => [
//                                'header' => 'Name',
//                                'inputType' => \kartik\editable\Editable::INPUT_TEXT,
//                            ],
//                            'hAlign' => 'left',
//                            'vAlign' => 'left',
//                         'width' => '7%',
//                        ],
    [
        'class' => 'kartik\grid\EditableColumn',
        'label' => 'Input Description',
        'attribute' => 'name',
        'readonly' => true,
        'filter' => false,
        'hAlign' => 'left',
        'vAlign' => 'left',
    // 'width' => '7%',
    ],
    [
        'class' => 'kartik\grid\EditableColumn',
        'label' => 'Unit of Measure',
        'attribute' => 'unit_of_measure_id',
        'value' => function ($model) {
            return !empty($model->unit_of_measure_id) && $model->unit_of_measure_id > 0 ? backend\models\AwpbUnitOfMeasure::findOne($model->unit_of_measure_id)->name : "";
        },
        'readonly' => true,
        'filter' => false,
        'hAlign' => 'left',
        'vAlign' => 'left',
        'width' => '7%',
    ],
    [
        'class' => 'kartik\grid\EditableColumn',
        'attribute' => 'unit_cost',
        'readonly' => true,
        'refreshGrid' => true, 'filter' => false,
        'editableOptions' => [
            'header' => 'Unit Cost',
            'inputType' => \kartik\editable\Editable::INPUT_SPIN,
            'options' => [
                'pluginOptions' => ['min' => 0, 'max' => 999999999999999999999]
            ]
        ],
        'hAlign' => 'right',
        'vAlign' => 'middle',
        'width' => '7%',
        'format' => ['decimal', 2],
        'pageSummary' => false
    ],
    [
        'class' => 'kartik\grid\EditableColumn',
        'attribute' => 'mo_1',
        'readonly' => true,
        'refreshGrid' => true, 'filter' => false,
        'editableOptions' => [
            'header' => $mo1 . ' Quantity',
            'inputType' => \kartik\editable\Editable::INPUT_SPIN,
            'options' => [
                'pluginOptions' => ['min' => 0, 'max' => 999999999999999999999]
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
        'attribute' => 'mo_2',
        'readonly' => true,
        'refreshGrid' => true, 'filter' => false,
        'editableOptions' => [
            'header' => $mo2 . ' Quantity',
            'inputType' => \kartik\editable\Editable::INPUT_SPIN,
            'options' => [
                'pluginOptions' => ['min' => 0, 'max' => 999999999999999999999]
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
        'attribute' => 'mo_3',
        'readonly' => true,
        'refreshGrid' => true, 'filter' => false,
        'editableOptions' => [
            'header' => $mo1 . ' Quantity',
            'inputType' => \kartik\editable\Editable::INPUT_SPIN,
            'options' => [
                'pluginOptions' => ['min' => 0, 'max' => 999999999999999999999]
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
        'attribute' => 'quarter_one_quantity',
        'readonly' => true,
        'refreshGrid' => true, 'filter' => false,
        'editableOptions' => [
            'header' => 'Q' . $template_model->quarter . ' Quantity',
            'inputType' => \kartik\editable\Editable::INPUT_SPIN,
            'options' => [
                'pluginOptions' => ['min' => 0, 'max' => 999999999999999999999]
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
        'label' => 'Q' . $template_model->quarter . ' Budget',
        'readonly' => true,
        'refreshGrid' => true, 'filter' => false,
        'editableOptions' => [
            'header' => 'Q' . $template_model->quarter . ' Budget',
            'inputType' => \kartik\editable\Editable::INPUT_SPIN,
            'options' => [
                'pluginOptions' => ['min' => 0, 'max' => 999999999999999999999]
            ]
        ],
        'hAlign' => 'right',
        'vAlign' => 'middle',
        'width' => '10%',
        'format' => ['decimal', 2],
        'pageSummary' => true
    ],
];

$budget = \backend\models\AwpbBudget::findOne(['id' => $id]);

if (User::userIsAllowedTo('Request Funds') && ( $user->district_id != 0 || $user->district_id != '')) {
    $searchModel = new AwpbActualInput();
    if ($template_model->quarter == 1) {



        $query = $searchModel::find();
        $query->select(['awpb_actual_input.awpb_template_id as awpb_template_id',
            'district_id', 'component_id',
            'activity_id', 'budget_id', 'awpb_actual_input.id',
            'awpb_actual_input.unit_cost', 'name', 'unit_of_measure_id',
            'SUM(awpb_actual_input.mo_1) as mo_1',
            'SUM(awpb_actual_input.mo_2) as mo_2',
            'SUM(awpb_actual_input.mo_3) as mo_3',
            'SUM(awpb_actual_input.quarter_one_quantity) as quarter_one_quantity',
            'SUM(awpb_actual_input.mo_1_amount) as mo_1_amount',
            'SUM(awpb_actual_input.mo_2_amount) as mo_2_amount',
            'SUM(awpb_actual_input.mo_3_amount) as mo_3_amount',
            'SUM(awpb_actual_input.quarter_one_amount) as quarter_one_amount']);

        $query->where(['=', 'awpb_actual_input.awpb_template_id', $template_model->id]);

        $query->andWhere(['=', 'awpb_actual_input.budget_id', $id]);
        $query->groupBy('awpb_actual_input.id');

        $query->all();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
    } elseif ($template_model->quarter == 2) {
        $query = $searchModel::find();
        $query = $searchModel::find();
        $query->select(['awpb_actual_input.awpb_template_id as awpb_template_id',
            'district_id', 'component_id',
            'activity_id', 'budget_id',
            'awpb_actual_input.unit_cost', 'name', 'unit_of_measure_id',
            'SUM(awpb_actual_input.mo_4) as mo_1',
            'SUM(awpb_actual_input.mo_5) as mo_2',
            'SUM(awpb_actual_input.mo_6) as mo_3',
            'SUM(awpb_actual_input.quarter_one_quantity) as quarter_one_quantity',
            'SUM(awpb_actual_input.mo_4_amount) as mo_1_amount',
            'SUM(awpb_actual_input.mo_5_amount) as mo_2_amount',
            'SUM(awpb_actual_input.mo_6_amount) as mo_3_amount',
            'SUM(awpb_actual_input.quarter_two_amount) as quarter_one_amount']);

        $query->where(['=', 'awpb_actual_input.awpb_template_id', $template_model->id]);

        $query->andWhere(['=', 'awpb_actual_input.budget_id', $id]);

        $query->all();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
    } elseif ($template_model->quarter == 3) {
        $query = $searchModel::find();
        $query->select(['awpb_actual_input.awpb_template_id as awpb_template_id',
            'district_id', 'component_id',
            'activity_id', 'budget_id',
            'awpb_actual_input.unit_cost', 'name', 'unit_of_measure_id',
            'SUM(awpb_actual_input.mo_7) as mo_1',
            'SUM(awpb_actual_input.mo_8) as mo_2',
            'SUM(awpb_actual_input.mo_9) as mo_3',
            'SUM(awpb_actual_input.quarter_one_quantity) as quarter_one_quantity',
            'SUM(awpb_actual_input.mo_7_amount) as mo_1_amount',
            'SUM(awpb_actual_input.mo_8_amount) as mo_2_amount',
            'SUM(awpb_actual_input.mo_9_amount) as mo_3_amount',
            'SUM(awpb_actual_input.quarter_three_amount) as quarter_one_amount']);

        $query->where(['=', 'awpb_actual_input.awpb_template_id', $template_model->id]);
        // $query->join('LEFT JOIN', 'awpb_budget', 'awpb_budget.id = awpb_actual_input.budget_id');
        $query->andWhere(['=', 'awpb_actual_input.budget_id', $id]);
        //  $query->andWhere(['=', 'quarter_number', $template_model->quarter]);
        //  $query->andWhere(['=','status', AwpbActualInput::STATUS_NOT_REQUESTED]);
        //$query->groupBy('camp_id');
        // $query->groupBy('budget_id'); 

        $query->all();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
    } elseif ($template_model->quarter == 4) {
        $query = $searchModel::find();
        $query->select(['awpb_actual_input.awpb_template_id as awpb_template_id',
            'district_id', 'component_id',
            'activity_id', 'budget_id',
            'awpb_actual_input.unit_cost', 'name', 'unit_of_measure_id',
            'SUM(awpb_actual_input.mo_10) as mo_1',
            'SUM(awpb_actual_input.mo_11) as mo_2',
            'SUM(awpb_actual_input.mo_12) as mo_3',
            'SUM(awpb_actual_input.quarter_one_quantity) as quarter_one_quantity',
            'SUM(awpb_actual_input.mo_10_amount) as mo_1_amount',
            'SUM(awpb_actual_input.mo_11_amount) as mo_2_amount',
            'SUM(awpb_actual_input.mo_12_amount) as mo_3_amount',
            'SUM(awpb_actual_input.quarter_four_amount) as quarter_one_amount']);

        $query->where(['=', 'awpb_actual_input.awpb_template_id', $template_model->id]);
        // $query->join('LEFT JOIN', 'awpb_budget', 'awpb_budget.id = awpb_actual_input.budget_id');
        $query->andWhere(['=', 'awpb_actual_input.budget_id', $id]);
        //  $query->andWhere(['=', 'quarter_number', $template_model->quarter]);
        //  $query->andWhere(['=','status', AwpbActualInput::STATUS_NOT_REQUESTED]);
        //$query->groupBy('camp_id');
        // $query->groupBy('budget_id'); 

        $query->all();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
    }
}
//            elseif (User::userIsAllowedTo('Review Funds Request') && ( $user->province_id != 0 || $user->province_id != '')) {
//                $searchModel = new \backend\models\AwpbFundsRequisitionSearch();
//                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
//                $dataProvider->query->andFilterWhere(['=', 'budget_id', $id])->andFilterWhere(['=', 'district_id', $budget->district_id])->andFilterWhere(['=', 'quarter_number', $template_model->quarter])->andFilterWhere(['=', 'status', AwpbActualInput::STATUS_DISTRICT]);
//
//                
//             
//            } 
//            elseif (User::userIsAllowedTo('Approve Funds Requisition') && ($user->province_id == 0 || $user->province_id == '')) {
//                $searchModel = new \backend\models\AwpbFundsRequisitionSearch();
//                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
//                $dataProvider->query->andFilterWhere(['=', 'budget_id', $id])->andFilterWhere(['=', 'district_id', $budget->district_id])->andFilterWhere(['=', 'quarter_number', $template_model->quarter])->andFilterWhere(['=', 'status', AwpbActualInput::STATUS_PROVINCIAL]);
//
//               
//            } 
//            elseif (User::userIsAllowedTo('Disburse Funds') && ($user->province_id == 0 || $user->province_id == '')) {
//                $searchModel = new \backend\models\AwpbFundsRequisitionSearch();
//                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
//                $dataProvider->query->andFilterWhere(['=', 'budget_id', $id])->andFilterWhere(['=', 'district_id', $budget->district_id])->andFilterWhere(['=', 'quarter_number', $template_model->quarter])->andFilterWhere(['=', 'status', AwpbActualInput::STATUS_SPECIALIST]);
//
//               
//            }  
else {
    $searchModel = new \backend\models\AwpbActualInputSearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    $dataProvider->query->andFilterWhere(['=', 'budget_id', $id])->andFilterWhere(['=', 'district_id', $budget->district_id])->andFilterWhere(['=', 'status', 10]);
}


echo GridView::widget([
    'dataProvider' => $dataProvider,
    // 'filterModel' => $searchModel,
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
// 
//                          
//}
//    else {
//            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
//            return $this->redirect(['site/home']);
//        }
?>
    </div>
    <!-- /.card -->

</div>
        <?php
        $this->registerCss('.popover-x {display:none}');
        ?>