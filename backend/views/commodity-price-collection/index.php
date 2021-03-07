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

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CommodityPriceCollectionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Commodity price collections';
$province_id = backend\models\Districts::findOne([Yii::$app->getUser()->identity->district_id])->province_id;
$this->params['breadcrumbs'][] = $this->title;
$this->params['breadcrumbs'][] = \backend\models\Provinces::findOne($province_id)->name;
$this->params['breadcrumbs'][] = \backend\models\Districts::findOne([Yii::$app->getUser()->identity->district_id])->name;
$months = [
    1 => "January", 2 => "February", 3 => "March", 4 => "April", 5 => "May", 6 => "June",
    7 => "July", 8 => "August", 9 => "September", 10 => "October", 11 => "November", 12 => "December"
];
?>
<div class="card card-success card-outline">
    <div class="card-body" style="overflow: auto;">
        <div class="card-header">
        <div class="card-tools">
            
            <p>
                <?php
                if (User::userIsAllowedTo('Collect commodity prices')) {
                    if (empty(\backend\models\Markets::getByDistrict(Yii::$app->getUser()->identity->district_id))) {
                        echo "<div class='alert alert-warning'>The system has no markets for your district:<span class='badge badge-success'>"
                        . "" . \backend\models\Districts::findOne([Yii::$app->getUser()->identity->district_id])->name . "</span>"
                        . ". Hence you cannot add commodity prices</div>";
                    } elseif (empty(backend\models\CommodityTypes::getList())) {
                        echo "<div class='alert alert-warning'>The system has no commodity types. Hence you cannot add commodity prices</div>";
                    } elseif (empty(backend\models\CommodityPriceLevels::getList())) {
                        echo "<div class='alert alert-warning'>The system has no commodity price levels. Hence you cannot add commodity prices</div>";
                    } else {
                        echo Html::a('Add commodity price', ['create'], ['class' => 'float-right btn btn-success btn-sm']);
                    }
                }
                ?>
            </p>

        </div>
        </div>


        <?php
        $gridColumns = [
            ['class' => 'yii\grid\SerialColumn'],
            /* [
              'label' => 'Province',
              'visible' =>false,
              'filterType' => GridView::FILTER_SELECT2,
              'value' => function ($model) {
              $province_id = backend\models\Districts::findOne($model->district);
              $name = backend\models\Provinces::findOne($province_id)->name;
              return $name;
              },
              ], */
            [
                'class' => EditableColumn::className(),
                'attribute' => 'market_id',
                //'readonly' => false,
                'refreshGrid' => true,
                'filterType' => GridView::FILTER_SELECT2,
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filter' => \backend\models\Markets::getByDistrict(Yii::$app->getUser()->identity->district_id),
                'filterInputOptions' => ['prompt' => 'Filter by Market', 'class' => 'form-control', 'id' => null],
                'editableOptions' => [
                    'asPopover' => true,
                    'type' => 'success',
                    'size' => PopoverX::SIZE_MEDIUM,
                    'options' => ['data' => \backend\models\Markets::getByDistrict(Yii::$app->getUser()->identity->district_id)],
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
                //'readonly' => false,
                //'options' => ["style" => "width:120px;",],
                'refreshGrid' => true,
                'filterType' => GridView::FILTER_SELECT2,
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filter' => \backend\models\CommodityTypes::getList(),
                'filterInputOptions' => ['prompt' => 'Filter by commodity type', 'class' => 'form-control', 'id' => null],
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
                //'readonly' => false,
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
                    $name = backend\models\CommodityPriceLevels::findOne($model->price_level_id)->level;
                    return $name;
                },
            ],
            [
                'class' => EditableColumn::className(),
                'refreshGrid' => true,
                'attribute' => 'unit_of_measure',
                'filter' => false,
                'editableOptions' => [
                    'asPopover' => true,
                    'type' => 'success',
                    'placement' => kartik\popover\PopoverX::ALIGN_TOP_RIGHT,
                    'size' => PopoverX::SIZE_MEDIUM,
                    'options' => ['data' => \backend\models\CommodityPriceCollection::getYearsList()],
                    'inputType' => Editable::INPUT_TEXT,
                ],
            ],
            [
                'class' => EditableColumn::className(),
                'refreshGrid' => true,
                'attribute' => 'price',
                'filter' => false,
                'editableOptions' => [
                    'asPopover' => true,
                    'type' => 'success',
                    'placement' => kartik\popover\PopoverX::ALIGN_TOP_RIGHT,
                    'size' => PopoverX::SIZE_MEDIUM,
                    'options' => ['data' => \backend\models\CommodityPriceCollection::getYearsList()],
                    'inputType' => Editable::INPUT_MONEY,
                ],
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
                'attribute' => 'year',
                //'readonly' => false,
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
            [
                'class' => EditableColumn::className(),
                'attribute' => 'month',
                //'readonly' => false,
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
            // 'month',
            //'created_at',
            //'updated_at',
            //'created_by',
            //'updated_by',
            ['class' => ActionColumn::className(),
                'options' => ['style' => 'width:130px;'],
                'template' => '{delete}',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        if (User::userIsAllowedTo('Remove commodity price')) {
                            return Html::a(
                                            '<span class="fa fa-trash"></span>', ['delete', 'id' => $model->id], [
                                        'title' => 'Remove commodity price',
                                        'data-toggle' => 'tooltip',
                                        'data-placement' => 'top',
                                        'data' => [
                                            'confirm' => 'Are you sure you want to remove commodity price for ' . backend\models\CommodityTypes::findOne($model->commodity_type_id)->name . '?<br>',
                                            'method' => 'post',
                                        ],
                                        'style' => "padding:5px;",
                                        'class' => 'bt btn-lg'
                                            ]
                            );
                        }
                    },
                ]
            ],
        ];


        /* if ($dataProvider->getCount() > 0) {
          echo ExportMenu::widget([
          'dataProvider' => $dataProvider,
          'columns' => $gridColumns,
          'columnSelectorOptions' => [
          'label' => 'Cols...',
          ],
          'fontAwesome' => true,
          'dropdownOptions' => [
          'label' => 'Export All',
          'class' => 'btn btn-default'
          ],
          'filename' => 'commodity_prices' . date("YmdHis")
          ]);
          } */



        $fullExportMenu = ExportMenu::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => $gridColumns,
                    'columnSelectorOptions' => [
                        'label' => 'Cols...',
                         'class' => 'btn btn-outline-success btn-sm',
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
                         'class' => 'btn btn-outline-success btn-sm',
                        'itemsBefore' => [
                            '<div class="dropdown-header">Export All Data</div>',
                        ],
                    ],
        ]);

        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => $gridColumns,
            'filterModel' => $searchModel,
            'condensed' => true,
            'responsive' => true,
            'hover' => true,
            // 'pjax' => true,
            'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container']],
            'panel' => [
            //'type' => GridView::TYPE_DEFAULT,
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
        ?>
        <?php
        /* GridView::widget([
          'dataProvider' => $dataProvider,
          'filterModel' => $searchModel,
          'condensed' => true,
          'responsive' => true,
          'hover' => true,
          'columns' => $gridColumns
          ]); */
        ?>
    </div>
</div>
<?php
$this->registerCss('.popover-x {display:none}');
?>
