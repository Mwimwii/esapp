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

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MeFaabsTrainingAttendanceSheetSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'FaaBS Training Attendance records';
$this->params['breadcrumbs'][] = $this->title;

$district_model = \backend\models\Districts::findOne(Yii::$app->user->identity->district_id);
$district = !empty($district_model) ? $district_model->name : "";

$_camp_ids = [];
$camp_ids = \backend\models\Camps::find()
        ->select(['id'])
        ->where(['district_id' => Yii::$app->user->identity->district_id])
        ->asArray()
        ->all();
if (!empty($camp_ids)) {
    foreach ($camp_ids as $id) {
        array_push($_camp_ids, $id['id']);
    }
}

$list = \backend\models\MeFaabsGroups::find()
        ->where(['IN', 'camp_id', $_camp_ids])
        ->andWhere(['status' => 1])
        ->orderBy(['name' => SORT_ASC])
        ->all();
$ready_only = true;
?>
<div class="card card-success card-outline">
    <div class="card-body">
        <p>
            <?php
            if (User::userIsAllowedTo('Submit FaaBS training records')) {
                if (!empty($list)) {
                    echo Html::a('<i class="fa fa-plus"></i> <span class="text-xs">Submit records</span>', ['create'], ['class' => 'btn btn-success btn-xs']);
                } else {
                    echo!empty($district_model) ?
                            "<p class='alert alert-warning'>There are no FaaBS groups in the system for $district district. The system will only allow you to add FaaBS training attendance records after FaaBS groups are added for the district!</p>" :
                            "There are no FaaBS groups in the system for your district. The system will only allow you to add FaaBS training attendance records after FaaBS groups are added for the district!";
                }
            }
            ?>
        </p>
        <?php
        $gridColumns = [
            // ['class' => 'yii\grid\SerialColumn'],
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
                    $camp_id = backend\models\MeFaabsGroups::findOne($model->faabs_group_id)->camp_id;
                    $district_id = \backend\models\Camps::findOne($camp_id)->district_id;
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
                    $camp_id = backend\models\MeFaabsGroups::findOne($model->faabs_group_id)->camp_id;
                    $district_id = \backend\models\Camps::findOne($camp_id)->district_id;
                    $name = backend\models\Districts::findOne($district_id)->name;
                    return $name;
                },
                'visible' => !empty(Yii::$app->user->identity->district_id) ? false : true
            ],
            [
                'attribute' => 'camp_id',
                'label' => 'Camp',
                'filterType' => GridView::FILTER_SELECT2,
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                //  'filter' => true,
                'filter' => !empty(Yii::$app->user->identity->district_id) ? \backend\models\Camps::getListByDistrictId(Yii::$app->user->identity->district_id) : backend\models\Camps::getList(),
                'filterInputOptions' => ['prompt' => 'Filter by camp', 'class' => 'form-control', 'id' => null],
                'value' => function ($model) {
                    $camp_id = backend\models\MeFaabsGroups::findOne($model->faabs_group_id)->camp_id;
                    $name = backend\models\Camps::findOne($camp_id)->name;
                    return $name;
                },
            ],
            [
                'attribute' => 'faabs_group_id',
                'enableSorting' => true,
                'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filter' => \backend\models\MeFaabsGroups::getList(),
                'filterInputOptions' => ['prompt' => 'Filter by FaaBS group', 'class' => 'form-control',],
                'format' => 'raw',
                'value' => function ($model) {
                    return backend\models\MeFaabsGroups::findOne($model->faabs_group_id)->name;
                },
            ],
            [
                'attribute' => 'farmer_id',
                'filter' => false,
                'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filter' => !empty(Yii::$app->user->identity->district_id) ? \backend\models\MeFaabsCategoryAFarmers::getActiveFarmers() : \backend\models\MeFaabsCategoryAFarmers::getList(),
                'filterInputOptions' => ['prompt' => 'Filter by farmer', 'class' => 'form-control', 'id' => null],
                'enableSorting' => true,
                'format' => 'raw',
                'value' => function($model) {
                    $_model = backend\models\MeFaabsCategoryAFarmers::findOne($model->farmer_id);
                    return !empty($_model) ? $_model->title . "" . $_model->first_name . " " . $_model->other_names . " " . $_model->last_name : "";
                },
                'format' => 'raw',
            ],
            [
                'attribute' => "household_head_type",
                'filter' => false,
                'visible' => empty(Yii::$app->user->identity->district_id) ? false : true
            ],
            [
                'attribute' => "topic",
                'filter' => false,
            ],
            [
                'attribute' => "facilitators",
                'filter' => false,
                'visible' => empty(Yii::$app->user->identity->district_id) ? false : true
            ],
            [
                'attribute' => "training_date",
                'filterType' => GridView::FILTER_DATE_RANGE,
                'filterWidgetOptions' => (
                [
                    'model' => $searchModel,
                    'presetDropdown' => TRUE,
                    'convertFormat' => FALSE,
                    'pluginOptions' =>
                    [
                        'allowClear' => true,
                        'format' => 'YYYY-MM-DD',
                        'autoUpdateInput' => false,
                        'opens' => 'left',
                        'locale' => [
                            'format' => 'YYYY-MM-DD',
                            'separator' => ' to ',
                        ],
                    ]
                ])
            ],
            [
                'attribute' => "duration",
                'filter' => false,
            ],
            ['class' => ActionColumn::className(),
                'options' => ['style' => 'width:160px;'],
                'template' => '{view}&nbsp;{update}&nbsp;{delete}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        if (User::userIsAllowedTo('View FaaBS training records') ||
                                User::userIsAllowedTo('Submit FaaBS training records')) {
                            return Html::a(
                                            '<span class="fa fa-eye"></span>', ['view', 'id' => $model->id], [
                                        'title' => 'View FaaBS Training attendance record',
                                        'data-toggle' => 'tooltip',
                                        'data-placement' => 'top',
                                        'data-pjax' => '0',
                                        'style' => "padding:5px;",
                                        'class' => 'bt btn-lg'
                                            ]
                            );
                        }
                    },
                    'update' => function ($url, $model) {
                        if (User::userIsAllowedTo('Submit FaaBS training records')) {
                            return Html::a(
                                            '<span class="fas fa-edit"></span>', ['update', 'id' => $model->id], [
                                        'title' => 'Update FaaBS Training attendance record',
                                        'data-toggle' => 'tooltip',
                                        'data-placement' => 'top',
                                        // 'target' => '_blank',
                                        'data-pjax' => '0',
                                        'style' => "padding:5px;",
                                        'class' => 'bt btn-lg'
                                            ]
                            );
                        }
                    },
                    'delete' => function ($url, $model) {
                        if (User::userIsAllowedTo('Remove FaaBS training records')) {
                            return Html::a(
                                            '<span class="fa fa-trash"></span>', ['delete', 'id' => $model->id], [
                                        'title' => 'Remove FaaBS training record',
                                        'data-toggle' => 'tooltip',
                                        'data-placement' => 'top',
                                        'data' => [
                                            'confirm' => 'Are you sure you want to remove this FaaBS training attendance record?',
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
        $gridColumns1 = [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            [
                'label' => "Province",
                'attribute' => 'province_id',
                'value' => function ($model) {
                    $camp_id = backend\models\MeFaabsGroups::findOne($model->faabs_group_id)->camp_id;
                    $district_id = \backend\models\Camps::findOne($camp_id)->district_id;
                    $province_id = backend\models\Districts::findOne($district_id)->province_id;
                    $name = backend\models\Provinces::findOne($province_id)->name;
                    return $name;
                },
                'visible' => !empty(Yii::$app->user->identity->district_id) ? false : true
            ],
            [
                'label' => "District",
                'attribute' => 'district_id',
                'value' => function ($model) {
                    $camp_id = backend\models\MeFaabsGroups::findOne($model->faabs_group_id)->camp_id;
                    $district_id = \backend\models\Camps::findOne($camp_id)->district_id;
                    $name = backend\models\Districts::findOne($district_id)->name;
                    return $name;
                },
                'visible' => !empty(Yii::$app->user->identity->district_id) ? false : true
            ],
            [
                'attribute' => 'camp_id',
                'label' => 'Camp',
                'value' => function ($model) {
                    $camp_id = backend\models\MeFaabsGroups::findOne($model->faabs_group_id)->camp_id;
                    $name = backend\models\Camps::findOne($camp_id)->name;
                    return $name;
                },
            ],
            [
                'attribute' => 'faabs_group_id',
                'format' => 'raw',
                'value' => function ($model) {
                    return backend\models\MeFaabsGroups::findOne($model->faabs_group_id)->name;
                },
            ],
            [
                'attribute' => 'farmer_id',
                'format' => 'raw',
                'value' => function($model) {
                    $_model = backend\models\MeFaabsCategoryAFarmers::findOne($model->farmer_id);
                    return !empty($_model) ? $_model->title . "" . $_model->first_name . " " . $_model->other_names . " " . $_model->last_name : "";
                },
            ],
            [
                'attribute' => "household_head_type",
                'filter' => false,
            //  'visible' => empty(Yii::$app->user->identity->district_id) ? false : true
            ],
            [
                'attribute' => "topic",
                'filter' => false,
            ],
            [
                'attribute' => "facilitators",
                'filter' => false,
            //   'visible' => empty(Yii::$app->user->identity->district_id) ? false : true
            ],
            [
                'attribute' => "training_date",
                'filter' => false,
            ],
            [
                'attribute' => "duration",
                'filter' => false,
            ],
        ];

        $fullExportMenu = "";
        if (!empty($dataProvider) && $dataProvider->getCount() > 0) {
            $_name = !empty($district) ? $district . "_" : "";
            $fullExportMenu = ExportMenu::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => $gridColumns1,
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
                        'filename' => $_name . 'FaaBS_training_attendance_records' . date("YmdHis"),
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
