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
/* @var $searchModel backend\models\HourlyRatesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Hourly Rates';
$this->params['breadcrumbs'][] = $this->title;
$readonly = true;
?>
<div class="card card-success card-outline">
    <div class="card-body">

        <p>
            <?php
            if (User::userIsAllowedTo('Manage staff hourly rates')) {
                $readonly = false;
                echo ' <h5>Instructions</h5>
                          <ol>
                          <li>Click the button <span class="badge badge-success"><i class="fa fa-plus"></i> Add rate</span> to add a new hourly rate</li>
                           <li>Clicking the table column allows you to edit the details of the column</li>
                          
                          </ol> ';
                echo '<button class="btn btn-success btn-sm" href="#" onclick="$(\'#addNewModal\').modal(); 
                    return false;"><i class="fa fa-plus"></i> Add rate</button>';
                echo '<hr class="dotted short">';
            }
            $gridColumns = [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'class' => EditableColumn::className(),
                    'attribute' => 'designation',
                    'filterType' => GridView::FILTER_SELECT2,
                    'filterWidgetOptions' => [
                        'pluginOptions' => ['allowClear' => true],
                    ],
                    'filter' => true,
                    'filter' => \backend\models\HourlyRates::getDesignations(),
                    'filterInputOptions' => ['prompt' => 'Filter by Designation', 'class' => 'form-control', 'id' => null],
                    'editableOptions' => [
                        'type' => 'success',
                        'asPopover' => true,
                        'size' => PopoverX::SIZE_MEDIUM,
                    ],
                    'refreshGrid' => true,
                    'readonly' => $readonly,
                ],
                [
                    'class' => EditableColumn::className(),
                    'attribute' => 'salary_scale',
                    'readonly' => $readonly,
                    'refreshGrid' => true,
                    'filterType' => GridView::FILTER_SELECT2,
                    'filterWidgetOptions' => [
                        'pluginOptions' => ['allowClear' => true],
                    ],
                    'filter' => \backend\models\HourlyRates::getSalaryScales(),
                    'filterInputOptions' => ['prompt' => 'Filter by salary scale', 'class' => 'form-control', 'id' => null],
                    'editableOptions' => [
                        'type' => 'success',
                        'asPopover' => true,
                        'size' => PopoverX::SIZE_MEDIUM,
                    ],
                ],
                [
                    'class' => EditableColumn::className(),
                    'enableSorting' => true,
                    'readonly' => $readonly,
                    'attribute' => 'rate',
                    'editableOptions' => [
                        'asPopover' => true,
                        'type' => 'success',
                        'placement' => kartik\popover\PopoverX::ALIGN_TOP_RIGHT,
                        'size' => PopoverX::SIZE_MEDIUM,
                        'inputType' => Editable::INPUT_MONEY,
                    ],
                    'refreshGrid' => true,
                    'filter' => false,
                    "value" => function ($model) {
                        return "ZMW " . $model->rate;
                    }
                ],
                ['class' => ActionColumn::className(),
                    'options' => ['style' => 'width:130px;'],
                    'template' => '{delete}',
                    'buttons' => [
                        'delete' => function ($url, $model) {
                            if (User::userIsAllowedTo('Manage staff hourly rates')) {
                                return Html::a(
                                                '<span class="fa fa-trash"></span>', ['delete', 'id' => $model->id], [
                                            'title' => 'Remove rate',
                                            'data-toggle' => 'tooltip',
                                            'data-placement' => 'top',
                                            'data' => [
                                                'confirm' => 'Are you sure you want to remove this hourly rate?<br>'
                                                . 'Rate will only be removed if its not being used by the system!',
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
                            'filename' => 'hourlyrates' . date("YmdHis"),
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
        </p>


    </div>
</div>
<div class="modal fade" id="addNewModal">
    <div class="modal-dialog">
        <div class="modal-content card-success card-outline">
            <div class="modal-header">
                <h5 class="modal-title">Add new staff hourly rate</h5>
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
                echo $form->field($model, 'designation', ['enableAjaxValidation' => true])->textInput(['maxlength' => true, 'placeholder' =>
                    'Enter designation', 'id' => "designation", 'required' => true,]);

                echo $form->field($model, 'salary_scale', ['enableAjaxValidation' => true])->textInput(['maxlength' => true, 'placeholder' =>
                    'Enter salary scale', 'id' => "salary_scale", 'required' => true,]);
                echo $form->field($model, "rate", ['enableAjaxValidation' => true])->widget(MaskMoney::classname(),
                        [
                            'options' => ['style' => ''],
                            'pluginOptions' =>
                            [
                                'allowZero' => true,
                                'allowNegative' => false,
                                'min' => 1,
                            ]
                ])->label("Rate");
                ?>

            </div>
            <div class="modal-footer justify-content-between">
                <?= Html::submitButton('Save rate', ['class' => 'btn btn-success btn-sm']) ?>
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
