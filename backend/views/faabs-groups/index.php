<?php

use kartik\editable\Editable;
use kartik\grid\EditableColumn;
use kartik\grid\GridView;
use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\grid\ActionColumn;
use backend\models\User;
use kartik\popover\PopoverX;
use kartik\export\ExportMenu;
use kartik\touchspin\TouchSpin;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MeFaabsGroupsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'FaaBS Groups';
$this->params['breadcrumbs'][] = $this->title;
$ready_only = true;
$district_model = \backend\models\Districts::findOne(Yii::$app->user->identity->district_id);
$district = !empty($district_model) ? $district_model->name : "";
?>
<div class="card card-success card-outline">
    <div class="card-body">

        <?php
        if (User::userIsAllowedTo('Manage faabs groups')) {
            if (!empty(backend\models\Camps::getListByDistrictId(Yii::$app->user->identity->district_id))) {
                $ready_only = false;

                echo '<p> 
                          <h5>Instructions</h5>
                          <ol>
                          <li>Click the button <span class="badge badge-success"><i class="fa fa-plus"></i> Add FaaBS Group</span> to add a new FaaBS group</li>
                           <li>Clicking the view icon: <span class="fas fa-eye"></span> next to the FaaBS in the table below
                           will allow you to add training topics/course that farmers will need to attend in order to graduat</li>
                          
                          </ol>
                     </p>';
               
                echo Html::a('<i class="fa fa-plus"></i> <span class="text-xs">Add FaaBS Group</span>', ['create'], ['class' => 'btn btn-success btn-xs']);
                echo '<hr class="dotted short">';
            } else {
                echo!empty($district_model) ?
                        "<p class='alert alert-warning'>There are no camps in the system for $district district. The system will only allow you to add FaaBS groups after camps are added for the district!</p>" :
                        "There are no camps in the system for your district. The system will only allow you to add FaaBS groups after camps are added for the district!";
            }
        }
        ?>

        <?php
        $gridColumns = [
            //['class' => 'yii\grid\SerialColumn'],
            //'id',
            [
                'label' => "Province",
                'attribute' => 'province_id',
                'filterType' => GridView::FILTER_SELECT2,
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filter' => \backend\models\Provinces::getProvinceList(),
                'filterInputOptions' => ['prompt' => 'Filter by Province', 'class' => 'form-control', 'id' => null],
                'value' => function ($model) {
                    $district_id = \backend\models\Camps::findOne($model->camp_id)->district_id;
                    $province_id = backend\models\Districts::findOne($district_id)->province_id;
                    $name = backend\models\Provinces::findOne($province_id)->name;
                    return $name;
                },
                'visible' => !empty(Yii::$app->user->identity->district_id) ? false : true
            ],
            [
                'label' => "District",
                'attribute' => 'district_id',
                'filterType' => GridView::FILTER_SELECT2,
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filter' => \backend\models\Districts::getList(),
                'filterInputOptions' => ['prompt' => 'Filter by District', 'class' => 'form-control', 'id' => null],
                'value' => function ($model) {
                    $district_id = \backend\models\Camps::findOne($model->camp_id)->district_id;
                    $name = backend\models\Districts::findOne($district_id)->name;
                    return $name;
                },
                'visible' => !empty(Yii::$app->user->identity->district_id) ? false : true
            ],
            [
                'class' => EditableColumn::className(),
                'attribute' => 'camp_id',
                'group' => true,
                'filterType' => GridView::FILTER_SELECT2,
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                //  'filter' => true,
                //'filter' => !empty(Yii::$app->user->identity->district_id) ? \backend\models\Camps::getListByDistrictId(Yii::$app->user->identity->district_id) : backend\models\Camps::getList(),
                'filter' => !empty(Yii::$app->user->identity->district_id) ? \backend\models\Camps::getListByDistrictId(Yii::$app->user->identity->district_id) : backend\models\Camps::getList(),
                'filterInputOptions' => ['prompt' => 'Filter by camp', 'class' => 'form-control', 'id' => null],
                'readonly' => $ready_only,
                'refreshGrid' => true,
                'editableOptions' => [
                    'asPopover' => true,
                    'type' => 'success',
                    'size' => PopoverX::SIZE_MEDIUM,
                    'options' => ['data' => \backend\models\Camps::getListByDistrictId(Yii::$app->user->identity->district_id)],
                    'inputType' => Editable::INPUT_SELECT2,
                ],
                'value' => function ($model) {
                    $name = backend\models\Camps::findOne($model->camp_id)->name;
                    return $name;
                },
            ],
            [
                'class' => EditableColumn::className(),
                'enableSorting' => true,
                'attribute' => 'name',
                'editableOptions' => [
                    'type' => 'success',
                    'asPopover' => true,
                    'size' => PopoverX::SIZE_MEDIUM,
                ],
                'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filter' => \backend\models\MeFaabsGroups::getNames(),
                'filterInputOptions' => ['prompt' => 'Filter by FaaBS name', 'class' => 'form-control',],
                'format' => 'raw',
                'refreshGrid' => true,
                'readonly' => $ready_only,
            ],
            [
                'class' => EditableColumn::className(),
                'enableSorting' => true,
                'attribute' => 'max_farmer_graduation_training_topics',
                'editableOptions' => [
                    'type' => 'success',
                    'asPopover' => true,
                    'size' => PopoverX::SIZE_MEDIUM,
                    'inputType' => Editable::INPUT_WIDGET,
                    'widgetClass' => '\kartik\touchspin\TouchSpin',
                ],
                'filter' => false,
                'format' => 'raw',
                'refreshGrid' => true,
                'readonly' => $ready_only,
            ],
            [
                'class' => EditableColumn::className(),
                'attribute' => 'status',
                'filter' => false,
                'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filter' => [1 => 'Active', 0 => 'Inactive'],
                'filterInputOptions' => ['prompt' => 'Filter by Status', 'class' => 'form-control', 'id' => null],
                'class' => EditableColumn::className(),
                'enableSorting' => true,
                'format' => 'raw',
                'readonly' => $ready_only,
                'editableOptions' => [
                    'asPopover' => false,
                    'options' => ['class' => 'form-control', 'prompt' => 'Select Status...'],
                    'inputType' => Editable::INPUT_DROPDOWN_LIST,
                    'data' => [1 => 'Active', 0 => 'Inactive'],
                ],
                'value' => function($model) {
                    $str = "";
                    if ($model->status == 1) {
                        $str = "<span class='badge badge-success'> "
                                . " Active</span><br>";
                    }
                    if ($model->status == 0) {
                        $str = "<span class='badge badge-danger'> "
                                . "Inactive</span><br>";
                    }
                    return $str;
                },
                'format' => 'raw',
                'refreshGrid' => true,
            ],
            [
                'filter' => false,
                'label' => 'Date created',
                'value' => function($model) {
                    return date('d F Y H:i:s', $model->created_at);
                }
            ],
            [
                'filter' => false,
                'contentOptions' => ['class' => 'text-center', 'style' => ''],
                'label' => 'Has training topics',
                'value' => function($model) {
                    $faabs_topic_model = backend\models\MeFaabsTrainingTopicEnrolment::find()
                            ->where(['faabs_id' => $model->id])
                            ->count();
                    $str = "";
                    if ($faabs_topic_model > 0) {
                        $str = "<span class='fas fa-check text-success'> "
                                . "</span><br>";
                    } else {
                        $str = "<span class='fas fa-times text-danger'> "
                                . "</span><br>";
                    }
                    return $str;
                },
                'format' => 'raw',
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
                                    'title' => 'Add training topics',
                                    'data-toggle' => 'tooltip',
                                    'data-placement' => 'top',
                                    'data-pjax' => '0',
                                    'style' => "padding:5px;",
                                    'class' => 'bt btn-lg'
                                        ]
                        );
                    },
                    'update' => function ($url, $model) {
                        if (User::userIsAllowedTo('Manage faabs groups')) {
                            return Html::a(
                                            '<span class="fas fa-edit"></span>', ['update', 'id' => $model->id], [
                                        'title' => 'Update group',
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
                        if (User::userIsAllowedTo('Remove faabs groups')) {
                            return Html::a(
                                            '<span class="fa fa-trash"></span>', ['delete', 'id' => $model->id], [
                                        'title' => 'Remove FaaBS group',
                                        'data-toggle' => 'tooltip',
                                        'data-placement' => 'top',
                                        'data' => [
                                            'confirm' => 'Are you sure you want to remove FaaBS group: ' . $model->name . '?<br>'
                                            . 'Group will only be removed if its not being used by the system!',
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
            $_name = !empty($district) ? $district . "_" : "";
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
                        'filename' => $_name . 'FaaBS_groups' . date("YmdHis"),
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
                <h5 class="modal-title">Add new FaaBS group</h5>
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
                        $form->field($model, 'camp_id')
                        ->dropDownList(
                                \backend\models\Camps::getListByDistrictId(Yii::$app->user->identity->district_id), ['prompt' => 'Please select a camp', 'required' => true]
                );
                ?>
                <?=
                $form->field($model, 'name', ['enableAjaxValidation' => true])->textInput(['maxlength' => true, 'placeholder' =>
                    'Enter name of FaaBS group', 'id' => "province", 'required' => true,])
                ?>
                <?=
                $form->field($model, 'max_farmer_graduation_training_topics')->widget(TouchSpin::classname(), [
                    'options' => ['placeholder' => 'Enter max topics farmer needs to graduate'],
                    'pluginOptions' => [
                        // 'initval' => 3.00,
                        'min' => 1,
                        'max' => 1000,
                    ],
                ])->hint("Enter the maximum number of topics farmer needs to graduate");
                ?>

            </div>
            <div class="modal-footer justify-content-between">
                <?= Html::submitButton('Save FaaBS group', ['class' => 'btn btn-success btn-xs']) ?>
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
