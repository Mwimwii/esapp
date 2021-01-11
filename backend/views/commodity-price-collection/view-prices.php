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

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CommodityPriceCollectionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Commodity Prices';
$this->params['breadcrumbs'][] = $this->title;
$months = [
    1 => "January", 2 => "February", 3 => "March", 4 => "April", 5 => "May", 6 => "June",
    7 => "July", 8 => "August", 9 => "September", 10 => "October", 11 => "November", 12 => "December"
];
?>
<div class="card card-success card-outline">
    <div class="card-body" style="overflow: auto;">

        <p>
            <?php Html::a('Add commodity price', ['create'], ['class' => 'btn btn-success btn-sm']) ?>
        </p>


        <?php
        $gridColumns = [
            ['class' => 'yii\grid\SerialColumn'],
            // 'id',
            [
                'label' => 'Province',
                'attribute' => 'province_id',
                'filterType' => GridView::FILTER_SELECT2,
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filter' => \backend\models\Provinces::getProvinceList(),
                'filterInputOptions' => ['prompt' => 'Filter by Province', 'class' => 'form-control', 'id' => null],
                'value' => function ($model) {
                    $province_id = backend\models\Districts::findOne($model->district);
                    $name = backend\models\Provinces::findOne($province_id)->name;
                    return $name;
                },
            ],
            [
                'class' => EditableColumn::className(),
                'attribute' => 'district',
                'readonly' => true,
                'refreshGrid' => true,
                'filterType' => GridView::FILTER_SELECT2,
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filter' => \backend\models\Districts::getList(),
                'filterInputOptions' => ['prompt' => 'Filter by District', 'class' => 'form-control', 'id' => null],
                'editableOptions' => [
                    'asPopover' => true,
                    'type' => 'success',
                    'size' => PopoverX::SIZE_MEDIUM,
                    'options' => ['data' => \backend\models\Districts::getList()],
                    'inputType' => Editable::INPUT_SELECT2,
                ],
                'value' => function ($model) {
                    $name = backend\models\Districts::findOne($model->district)->name;
                    return $name;
                },
            ],
            [
                'class' => EditableColumn::className(),
                'attribute' => 'market_id',
                'readonly' => true,
                'refreshGrid' => true,
                'filterType' => GridView::FILTER_SELECT2,
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filter' => \backend\models\Markets::getList(),
                'filterInputOptions' => ['prompt' => 'Filter by Market', 'class' => 'form-control', 'id' => null],
                'editableOptions' => [
                    'asPopover' => true,
                    'type' => 'success',
                    'size' => PopoverX::SIZE_MEDIUM,
                    'options' => ['data' => \backend\models\Markets::getList()],
                    'inputType' => Editable::INPUT_SELECT2,
                ],
                'value' => function ($model) {
                    $name = backend\models\Markets::findOne($model->market_id)->name;
                    return $name;
                },
            ],
            [
                'class' => EditableColumn::className(),
                'attribute' => 'commodity_type_id',
                'readonly' => true,
                'refreshGrid' => true,
                'filterType' => GridView::FILTER_SELECT2,
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filter' => \backend\models\CommodityTypes::getList(),
                'filterInputOptions' => ['prompt' => 'Filter by type', 'class' => 'form-control', 'id' => null],
                'editableOptions' => [
                    'asPopover' => true,
                    'type' => 'success',
                    'size' => PopoverX::SIZE_MEDIUM,
                    'options' => ['data' => \backend\models\CommodityTypes::getList()],
                    'inputType' => Editable::INPUT_SELECT2,
                ],
                'value' => function ($model) {
                    $name = backend\models\CommodityTypes::findOne($model->commodity_type_id)->name;
                    return $name;
                },
            ],
            [
                'class' => EditableColumn::className(),
                'attribute' => 'price_level_id',
                'readonly' => true,
                'refreshGrid' => true,
                'filterType' => GridView::FILTER_SELECT2,
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filter' => \backend\models\CommodityPriceLevels::getList(),
                'filterInputOptions' => ['prompt' => 'Filter by price level', 'class' => 'form-control', 'id' => null],
                'editableOptions' => [
                    'asPopover' => true,
                    'type' => 'success',
                    'size' => PopoverX::SIZE_MEDIUM,
                    'options' => ['data' => \backend\models\CommodityPriceLevels::getList()],
                    'inputType' => Editable::INPUT_SELECT2,
                ],
                'value' => function ($model) {
                    $name = backend\models\CommodityPriceLevels::findOne($model->market_id)->level;
                    return $name;
                },
            ],
            [
                'attribute' => 'unit_of_measure',
                'filter' => false
            ],
            [
                'attribute' => 'price',
                'filter' => false
            ],
            [
                'options' => ['style' => 'width:250px;'],
                'label' => 'Avg price',
                //'readonly' => false,
                'value' => function ($model) {
                    $avg = 0;
                    $sum = backend\models\CommodityPriceCollection::find()
                            ->where(['year' => $model->year, "commodity_type_id" => $model->commodity_type_id])
                            ->sum("price");
                    $count = backend\models\CommodityPriceCollection::find()
                            ->where(['year' => $model->year, "commodity_type_id" => $model->commodity_type_id])
                            ->count();
                    $avg = $sum != 0 && $count != 0 ? $sum / $count : 0;
                    return $avg;
                },
            ],
            [
                'class' => EditableColumn::className(),
                'attribute' => 'month',
                'readonly' => true,
                'refreshGrid' => true,
                'filterType' => GridView::FILTER_SELECT2,
                'filterWidgetOptions' => [
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ],
                'filter' => $months,
                'filterInputOptions' => ['prompt' => 'Filter by month', 'class' => 'form-control', 'id' => null],
                'editableOptions' => [
                    'asPopover' => true,
                    'type' => 'success',
                    'placement' => kartik\popover\PopoverX::ALIGN_TOP_RIGHT,
                    'size' => PopoverX::SIZE_MEDIUM,
                    'options' => ['data' => $months],
                    'inputType' => Editable::INPUT_SELECT2,
                ],
                "value" => function ($model) {
                    return DateTime::createFromFormat('!m', $model->month)->format('F');
                }
            ],
            [
                'class' => EditableColumn::className(),
                'attribute' => 'year',
                'readonly' => true,
                'options' => ['style' => 'width:80px;'],
                'refreshGrid' => true,
                'filterType' => GridView::FILTER_SELECT2,
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true,
                    ],
                ],
                'filter' => \backend\models\CommodityPriceCollection::getYearsList(),
                'filterInputOptions' => ['prompt' => 'Filter by year', 'class' => 'form-control', 'id' => null],
                'editableOptions' => [
                    'asPopover' => true,
                    'type' => 'success',
                    'placement' => kartik\popover\PopoverX::ALIGN_TOP_RIGHT,
                    'size' => PopoverX::SIZE_MEDIUM,
                    'options' => ['data' => \backend\models\CommodityPriceCollection::getYearsList()],
                    'inputType' => Editable::INPUT_SELECT2,
                ],
            ],
        ];
        if (!empty($dataProvider) && $dataProvider->getCount() > 0) {

            $fullExportMenu = ExportMenu::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => $gridColumns,
                        'columnSelectorOptions' => [
                            'label' => 'Cols...',
                        ],
                        'batchSize' => 200,
                        'exportConfig' => [
                            ExportMenu::FORMAT_TEXT => false,
                            ExportMenu::FORMAT_HTML => false,
                            ExportMenu::FORMAT_EXCEL => false,
                            ExportMenu::FORMAT_PDF => false,
                            ExportMenu::FORMAT_CSV => false,
                        ],
                        'target' => ExportMenu::TARGET_BLANK,
                        'pjaxContainerId' => 'kv-pjax-container',
                        'exportContainer' => [
                            'class' => 'btn-group mr-2'
                        ],
                        'filename' => 'commodity_prices' . date("YmdHis"),
                        'dropdownOptions' => [
                            'label' => 'Export to excel',
                            'class' => 'btn btn-outline-secondary',
                            'itemsBefore' => [
                                '<div class="dropdown-header">Export All Data</div>',
                            ],
                        ],
            ]);
            echo GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => $gridColumns,
                'condensed' => true,
                'responsive' => true,
                'hover' => true,
               // 'pjax' => true,
                'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container']],
                'panel' => [
                    'type' => GridView::TYPE_DEFAULT,
                // 'heading' => '<h3 class="panel-title"><i class="fas fa-book"></i> Library</h3>',
                ],
                // set a label for default menu
                'export' => false,
                'exportContainer' => [
                    'class' => 'btn-group mr-2'
                ],
                // your toolbar can include the additional full export menu
                'toolbar' => [
                    '{export}',
                    $fullExportMenu,
                ]
            ]);
        } else {
            echo '<p>There are currently no market prices in the system!</p>';
        }
        ?>



    </div>
</div>
<?php
$this->registerCss('.popover-x {display:none}');
?>
