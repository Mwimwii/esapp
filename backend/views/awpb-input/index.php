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

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CommodityPriceCollectionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'AWPB Input';
//$province_id = backend\models\Districts::findOne([Yii::$app->getUser()->identity->district_id])->province_id;
$this->params['breadcrumbs'][] = $this->title;

//$this->params['breadcrumbs'][] = \backend\models\Provinces::findOne($province_id)->name;
//$this->params['breadcrumbs'][] = \backend\models\Districts::findOne([Yii::$app->getUser()->identity->district_id])->name;
$months = [
    1 => "January", 2 => "February", 3 => "March", 4 => "April", 5 => "May", 6 => "June",
    7 => "July", 8 => "August", 9 => "September", 10 => "October", 11 => "November", 12 => "December"
];
$user = User::findOne(['id' => Yii::$app->user->id]);
//$budget = AwpbBudget::findOne(['id'=>$model->budget_id]);
$access_level = 1;
?>
<div class="card card-success card-outline">
    <div class="card-body" style="overflow: auto;">
        <p>

            <?php
         //   if (User::userIsAllowedTo('Manage AWPB Input') && $user->district_id > 0 || $user->district_id != '') {

                echo Html::a('Add AWPB Input', ['create'], ['class' => 'btn btn-success btn-sm']);
                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                echo Html::a('Submit District AWPB', ['submit', 'id' => $id, 'id2' => $user->district_id, 'status' => AwpbInput:: STATUS_SUBMITTED], ['class' => 'float-right btn btn-success btn-sm btn-space']);
         //   }
            ?>

        </p>



<?php

$gridColumns = [
    [
        'class' => 'kartik\grid\SerialColumn',
        'contentOptions' => ['class' => 'kartik-sheet-style'],
        'width' => '36px',
        'pageSummary' => 'Total',
        'pageSummaryOptions' => ['colspan' => 6],
        'header' => '',
        'headerOptions' => ['class' => 'kartik-sheet-style']
    ],
    [
        'attribute' => 'activity_id',
        'label' => 'Activity Code',
        'vAlign' => 'middle',
        'width' => '180px',
        'value' => function ($model) {
            $name = \backend\models\AwpbActivity::findOne(['id' => $model->activity_id])->activity_code;
            return Html::a($name, ['awpb-activity/view', 'id' => $model->activity_id], ['class' => 'awbp-activity']);
        },
        'filterType' => GridView::FILTER_SELECT2,
        'filter' => \backend\models\AwpbActivity::getAwpbActivitiesList($access_level),
        'filterWidgetOptions' => [
            'pluginOptions' => ['allowClear' => true],
            'options' => ['multiple' => true]
        ],
        'filterInputOptions' => ['placeholder' => 'Filter by activity'],
        'format' => 'raw'
    ],
    [
        'attribute' => 'awpb_template_id',
        'label' => 'Fiscal Year',
        'vAlign' => 'middle',
        'width' => '180px',
        'value' => function ($model) {
            $name = \backend\models\AwpbTemplate::findOne(['id' => $model->awpb_template_id])->fiscal_year;
            return Html::a($name, ['awpb-template/view', 'id' => $model->awpb_template_id], ['class' => 'awbp-template']);
        },
        'filterType' => GridView::FILTER_SELECT2,
        'filter' => \backend\models\AwpbActivity::getAwpbActivitiesList($access_level),
        'filterWidgetOptions' => [
            'pluginOptions' => ['allowClear' => true],
            'options' => ['multiple' => true]
        ],
        'filterInputOptions' => ['placeholder' => 'Filter by activity'],
        'format' => 'raw'
    ],
    [
        'label' => 'Activity Name',
        'value' => function ($model) {
            $name = \backend\models\AwpbActivity::findOne(['id' => $model->activity_id])->name;
            return $name;
        }
    ],
    [
        'class' => 'kartik\grid\EditableColumn',
        'label' => 'Commodity Description',
        'attribute' => 'name',
        'readonly' => true,
        'editableOptions' => [
            'header' => 'Name',
            'inputType' => \kartik\editable\Editable::INPUT_TEXT,
        ],
        'hAlign' => 'left',
        'vAlign' => 'left',
    // 'width' => '7%',
    ],
    [
        'class' => 'kartik\grid\EditableColumn',
        'attribute' => 'unit_cost',
        'readonly' => true,
        'refreshGrid' => true,
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
        'attribute' => 'quarter_one_quantity',
        'readonly' => true,
        'refreshGrid' => true,
        'editableOptions' => [
            'header' => 'Q1 Qty',
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
        'attribute' => 'quarter_two_quantity',
        'readonly' => true,
        'refreshGrid' => true,
        'editableOptions' => [
            'header' => 'Q2 Qty',
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
        'attribute' => 'quarter_three_quantity',
        'readonly' => true,
        'refreshGrid' => true,
        'editableOptions' => [
            'header' => 'Q3 Qty',
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
        'attribute' => 'quarter_four_quantity',
        'readonly' => true,
        'refreshGrid' => true,
        'editableOptions' => [
            'header' => 'Q4 Qty',
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
        'class' => 'kartik\grid\FormulaColumn',
        'attribute' => 'total_quantity',
        'header' => 'Total <br> Quantity',
        // 'refreshGrid' => true,
        'vAlign' => 'middle',
        'value' => function ($model, $key, $index, $widget) {
            $p = compact('model', 'key', 'index');
            return $widget->col(6, $p) + $widget->col(7, $p) + $widget->col(8, $p) + $widget->col(9, $p);
        },
        'headerOptions' => ['class' => 'kartik-sheet-style'],
        'hAlign' => 'right',
        'width' => '7%',
        'format' => ['decimal', 2],
        'mergeHeader' => true,
        'pageSummary' => true,
        'footer' => true
    ],
    [
        'class' => 'kartik\grid\FormulaColumn',
        'attribute' => 'total_amount',
        'header' => 'Total <br> Amount',
        'vAlign' => 'middle',
        'hAlign' => 'right',
        'width' => '7%',
        'value' => function ($model, $key, $index, $widget) {
            $p = compact('model', 'key', 'index');
            return $widget->col(10, $p) != 0 ? $widget->col(5, $p) * $widget->col(10, $p) : 0;
        },
        'format' => ['decimal', 2],
        'headerOptions' => ['class' => 'kartik-sheet-style'],
        'mergeHeader' => true,
        'pageSummary' => true,
        'pageSummaryFunc' => GridView::F_SUM,
        'footer' => true
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign' => 'middle',
        'template' => '{delete} {view}',
        'urlCreator' => function ($action, $model, $key, $index) {
            return Url::to([$action, 'id' => $key]);
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
}
?>


        <?=
        GridView::widget([
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
        ?>


    </div>
</div>
        <?php
        $this->registerCss('.popover-x {display:none}');
        ?>