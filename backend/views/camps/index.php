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
/* @var $searchModel backend\models\CampsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Camps';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card card-success card-outline">
    <div class="card-body">

        <?php
        if (User::userIsAllowedTo('Manage camps')) {
            echo Html::a('<i class="fa fa-plus"></i> <span class="text-xs">Add Camp</span>', ['create'], ['class' => 'btn btn-success btn-xs']);
            echo '<hr class="dotted short">';
        }
        $gridColumns = [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            [
                'attribute' => 'province_id',
                'filterType' => GridView::FILTER_SELECT2,
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filter' => true,
                'filter' => \backend\models\Provinces::getProvinceList(),
                'filterInputOptions' => ['prompt' => 'Filter by Province', 'class' => 'form-control', 'id' => null],
                'value' => function ($model) {
                    $province_id = backend\models\Districts::findOne($model->district_id)->province_id;
                    $name = backend\models\Provinces::findOne($province_id)->name;
                    return $name;
                },
            ],
            [
               // 'class' => EditableColumn::className(),
                'attribute' => 'district_id',
                //'readonly' => false,
                //'refreshGrid' => true,
                'filterType' => GridView::FILTER_SELECT2,
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filter' => \backend\models\Districts::getList(),
                'filterInputOptions' => ['prompt' => 'Filter by District', 'class' => 'form-control', 'id' => null],
               /* 'editableOptions' => [
                    'asPopover' => true,
                    'type' => 'success',
                    'size' => PopoverX::SIZE_MEDIUM,
                    'options' => ['data' => \backend\models\Districts::getList()],
                    'inputType' => Editable::INPUT_SELECT2,
                ],*/
                'value' => function ($model) {
                    $name = backend\models\Districts::findOne($model->district_id)->name;
                    return $name;
                },
            ],
            [
                //'class' => EditableColumn::className(),
                'enableSorting' => true,
                'attribute' => 'name',
                /*'editableOptions' => [
                    'type' => 'success',
                    'asPopover' => true,
                    'size' => PopoverX::SIZE_MEDIUM,
                ],*/
                'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filter' => \backend\models\Camps::getNames(),
                'filterInputOptions' => ['prompt' => 'Filter by camp name', 'class' => 'form-control',],
                'format' => 'raw',
               // 'refreshGrid' => true,
            ],
            [
                // 'class' => EditableColumn::className(),
                'enableSorting' => true,
                'attribute' => 'description',
                /* 'editableOptions' => [
                  'asPopover' => true,
                  'type' => 'success',
                  'inputType' => Editable::INPUT_TEXTAREA,
                  'submitOnEnter' => false,
                  'placement' => \kartik\popover\PopoverX::ALIGN_LEFT,
                  'size' => PopoverX::SIZE_LARGE,
                  'options' => [
                  'class' => 'form-control',
                  'rows' => 6,
                  'placeholder' => 'Enter camp description...'
                  ]
                  ], */
                'filter' => false,
                'format' => 'raw',
            //   'refreshGrid' => true,
            ],
            [
                'label' => 'Latitude/Longitude',
                'value' => function ($model) {
                    return $model->longitude . "/" . $model->latitude;
                },
            ],
            // 'description:ntext',
            // 'latitude',
            //'longitude',
            //'created_at',
            //'updated_at',
            //'created_by',
            //'updated_by',
            ['class' => ActionColumn::className(),
                'options' => ['style' => 'width:130px;'],
                'template' => '{view}{update}{delete}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a(
                                        '<span class="fa fa-eye"></span>', ['view', 'id' => $model->id], [
                                    'title' => 'View camp',
                                    'data-toggle' => 'tooltip',
                                    'data-placement' => 'top',
                                    'data-pjax' => '0',
                                    'style' => "padding:5px;",
                                    'class' => 'bt btn-lg'
                                        ]
                        );
                    },
                    'update' => function ($url, $model) {
                        if (User::userIsAllowedTo('Manage camps')) {
                            return Html::a(
                                            '<span class="fas fa-edit"></span>', ['update', 'id' => $model->id], [
                                        'title' => 'Update camp',
                                        'data-toggle' => 'tooltip',
                                        'data-placement' => 'top',
                                        'data-pjax' => '0',
                                        'style' => "padding:5px;",
                                        'class' => 'bt btn-lg'
                                            ]
                            );
                        }
                    },
                    'delete' => function ($url, $model) {
                        if (User::userIsAllowedTo('Remove camps')) {
                            return Html::a(
                                            '<span class="fa fa-trash"></span>', ['delete', 'id' => $model->id], [
                                        'title' => 'Remove camp',
                                        'data-toggle' => 'tooltip',
                                        'data-placement' => 'top',
                                        'data' => [
                                            'confirm' => 'Are you sure you want to remove camp ' . $model->name . '?<br>'
                                            . 'Camp will only be removed if its not being used by the system!',
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
        ?>
        <?php
        $fullExportMenu = "";
        if (!empty($dataProvider) && $dataProvider->getCount() > 0) {

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
                        'filename' => 'camps' . date("YmdHis"),
                        'dropdownOptions' => [
                            'label' => 'Export to excel',
                            'class' => 'btn btn-outline-success btn-sm',
                            'itemsBefore' => [
                                '<div class="dropdown-header">Export All Data</div>',
                            ],
                        ],
            ]);
        }
        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
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
        ?>


    </div>
</div>
<div class="modal fade" id="addNewModal">
    <div class="modal-dialog">
        <div class="modal-content card-success card-outline">
            <div class="modal-header">
                <h5 class="modal-title">Add new Camp</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                $form = ActiveForm::begin([
                            'action' => 'create',
                        ])
                ?>

                <?php
                echo
                        $form->field($model, 'province_id')
                        ->dropDownList(
                                \backend\models\Provinces::getProvinceList(), ['id' => 'prov_id', 'custom' => true, 'prompt' => 'Please select a province', 'required' => true]
                );

                echo Html::hiddenInput('selected_id', $model->isNewRecord ? '' : $model->district_id, ['id' => 'selected_id']);

                echo $form->field($model, 'district_id')->widget(DepDrop::classname(), [
                    'options' => ['id' => 'dist_id', 'custom' => true, 'required' => TRUE],
                    'pluginOptions' => [
                        'depends' => ['prov_id'],
                        'initialize' => $model->isNewRecord ? false : true,
                        'placeholder' => 'Please select a district',
                        'url' => Url::to(['/camps/district']),
                        'params' => ['selected_id'],
                    ]
                ]);
                ?>
                <?=
                $form->field($model, 'name', ['enableAjaxValidation' => true])->textInput(['maxlength' => true, 'placeholder' =>
                    'Name of camp', 'id' => "province", 'required' => true,])
                ?>
                <?=
                $form->field($model, 'description')->textarea(['rows' => 4, 'placeholder' =>
                    'Camp description'])->label("Description ");
                ?>

            </div>
            <div class="modal-footer justify-content-between">
                <?= Html::submitButton('Save camp', ['class' => 'btn btn-success btn-sm']) ?>
                <?php ActiveForm::end() ?>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<?php
$this->registerCss('.popover-x {display:none}');
?>
