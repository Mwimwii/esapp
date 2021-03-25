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
/* @var $searchModel backend\models\MeFaabsCategoryAFarmersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Category \'A\' Farmers';
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
?>
<div class="card card-success card-outline">
    <div class="card-body">

        <p>
            <?php
            if (User::userIsAllowedTo('Manage category A farmers')) {
                if (!empty($list)) {
                    echo Html::a('<i class="fa fa-plus"></i> <span class="text-xs">Add Farmer</span>', ['create'], ['class' => 'btn btn-success btn-xs']);
                } else {
                    echo!empty($district_model) ?
                            "<p class='alert alert-warning'>There are no FaaBS groups in the system for $district district. The system will only allow you to add Category \'A\' farmers after FaaBS groups are added for the district!</p>" :
                            "There are no FaaBS groups in the system for your district. The system will only allow you to add Category \'A\' farmers after FaaBS groups are added for the district!";
                }
            }
            ?>
        </p>

        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <?php
        $gridColumns = [
            // ['class' => 'yii\grid\SerialColumn'],
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
                    $camp_id = \backend\models\MeFaabsGroups::findOne($model->faabs_group_id)->camp_id;
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
                    $camp_id = \backend\models\MeFaabsGroups::findOne($model->faabs_group_id)->camp_id;
                    $district_id = \backend\models\Camps::findOne($camp_id)->district_id;
                    $name = backend\models\Districts::findOne($district_id)->name;
                    return $name;
                },
                'visible' => !empty(Yii::$app->user->identity->district_id) ? false : true
            ],
            [
                'label' => "Camp",
                'attribute' => 'camp_id',
                //  'group'=>true,
                'filterType' => GridView::FILTER_SELECT2,
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                //  'filter' => true,
                'filter' => !empty(Yii::$app->user->identity->district_id) ? \backend\models\Camps::getListByDistrictId(Yii::$app->user->identity->district_id) : backend\models\Camps::getList(),
                'filterInputOptions' => ['prompt' => 'Filter by camp', 'class' => 'form-control', 'id' => null],
                'value' => function ($model) {
                    $camp_id = \backend\models\MeFaabsGroups::findOne($model->faabs_group_id)->camp_id;
                    $name = backend\models\Camps::findOne($camp_id)->name;
                    return $name;
                },
            // 'visible' => !empty(Yii::$app->user->identity->district_id) ? false : true
            ],
            [
                'enableSorting' => true,
                'attribute' => 'faabs_group_id',
                'group' => true,
                'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filter' => \backend\models\MeFaabsGroups::getList(),
                'filterInputOptions' => ['prompt' => 'Filter by FaaBS group', 'class' => 'form-control',],
                'format' => 'raw',
                'value' => function ($model) {
                    $name = backend\models\MeFaabsGroups::findOne($model->faabs_group_id)->name;
                    return $name;
                },
            ],
            [
                'attribute' => 'first_name',
                'label' => 'Names',
                'format' => 'raw',
                'filterType' => GridView::FILTER_SELECT2,
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filter' => \backend\models\MeFaabsCategoryAFarmers::getFullNames(),
                'filterInputOptions' => ['prompt' => 'Filter by names', 'class' => 'form-control', 'id' => null],
                "value" => function ($model) {
                    $name = $model->title . "" . $model->first_name . " " . $model->other_names . " " . $model->last_name;
                    return $name;
                }
            ],
            [
                'enableSorting' => true,
                'attribute' => 'nrc',
                'filter' => false,
                'visible' => !empty(Yii::$app->user->identity->district_id) ? true : false
            ],
            [
                'enableSorting' => true,
                'attribute' => 'sex',
                'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filter' => ['Male' => "Male", "Female" => "Female"],
                'filterInputOptions' => ['prompt' => 'Filter by sex', 'class' => 'form-control',],
                'format' => 'raw',
            ],
            [
                'enableSorting' => true,
                'attribute' => 'dob',
                'filter' => false,
                'visible' => !empty(Yii::$app->user->identity->district_id) ? true : false
            ],
            [
                'filter' => false,
                'label' => 'Contact #',
                'attribute' => 'contact_number',
                'visible' => !empty(Yii::$app->user->identity->district_id) ? true : false
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
                'label' => 'Reg date',
                'attribute' => 'registration_date',
            ],
            // 'description:ntext',
            // 'latitude',
            //'longitude',
            //'created_at',
            //'updated_at',
            //'created_by',
            //'updated_by',
            ['class' => ActionColumn::className(),
                'options' => ['style' => 'width:170px;'],
                'template' => '{view}&nbsp;{update}&nbsp;{delete}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        if (User::userIsAllowedTo('Manage category A farmers') || User::userIsAllowedTo('View category A farmers')) {
                            return Html::a(
                                            '<span class="fa fa-eye"></span>', ['view', 'id' => $model->id], [
                                        'title' => 'View farmer',
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
                        if (User::userIsAllowedTo('Manage category A farmers')) {
                            return Html::a(
                                            '<span class="fas fa-edit"></span>', ['update', 'id' => $model->id], [
                                        'title' => 'Update farmer',
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
                        if (User::userIsAllowedTo('Remove category A farmers')) {
                            return Html::a(
                                            '<span class="fa fa-trash"></span>', ['delete', 'id' => $model->id], [
                                        'title' => 'Remove farmer',
                                        'data-toggle' => 'tooltip',
                                        'data-placement' => 'top',
                                        'data' => [
                                            'confirm' => 'Are you sure you want to remove Farmer?<br>'
                                            . 'Farmer will only be removed if the system is not using their record!',
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
        $gridColumns2 = [
            [
                'label' => "Province",
                'attribute' => 'province_id',
                'value' => function ($model) {
                    $camp_id = \backend\models\MeFaabsGroups::findOne($model->faabs_group_id)->camp_id;
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
                    $camp_id = \backend\models\MeFaabsGroups::findOne($model->faabs_group_id)->camp_id;
                    $district_id = \backend\models\Camps::findOne($camp_id)->district_id;
                    $name = backend\models\Districts::findOne($district_id)->name;
                    return $name;
                },
                'visible' => !empty(Yii::$app->user->identity->district_id) ? false : true
            ],
            [
                'label' => "Camp",
                'attribute' => 'camp_id',
                'value' => function ($model) {
                    $camp_id = \backend\models\MeFaabsGroups::findOne($model->faabs_group_id)->camp_id;
                    $name = backend\models\Camps::findOne($camp_id)->name;
                    return $name;
                },
                'visible' => !empty(Yii::$app->user->identity->district_id) ? false : true
            ],
            [
                'attribute' => 'first_name',
                'label' => 'Names',
                'format' => 'raw',
                "value" => function ($model) {
                    $name = $model->title . "" . $model->first_name . " " . $model->other_names . " " . $model->last_name;
                    return $name;
                }
            ],
            [
                'attribute' => 'faabs_group_id',
                'format' => 'raw',
                'value' => function ($model) {
                    $name = backend\models\MeFaabsGroups::findOne($model->faabs_group_id)->name;
                    return $name;
                },
            ],
            [
                'enableSorting' => true,
                'attribute' => 'nrc',
                'filter' => false,
            ],
            [
                'enableSorting' => true,
                'attribute' => 'sex',
                'format' => 'raw',
            ],
            [
                'enableSorting' => true,
                'attribute' => 'dob',
                'filter' => false,
            ],
            [
                'enableSorting' => true,
                'attribute' => 'age',
                'filter' => false,
            ],
            [
                'filter' => false,
                'label' => 'Contact #',
                'attribute' => 'contact_number',
            ],
            [
                'attribute' => 'status',
                'filter' => false,
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
            ],
            [
                'filter' => false,
                'label' => 'Reg date',
                'attribute' => 'registration_date',
            ],
            'marital_status',
            'relationship_to_household_head',
            'household_size',
            'village',
            'chiefdom',
            'block',
            'zone',
            'commodity',
        ];

        $fullExportMenu = "";
        if (!empty($dataProvider) && $dataProvider->getCount() > 0) {
            $_name = !empty($district) ? $district . "_" : "";
            $fullExportMenu = ExportMenu::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => $gridColumns2,
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
                        'filename' => $_name . 'Category_A_farmers' . date("YmdHis"),
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
