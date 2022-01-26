<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use yii\grid\ActionColumn;
use backend\models\User;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LogframeHouseAssetsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Logframe / Project Goals Household Assets';
$this->params['breadcrumbs'][] = $this->title;

$Baseline_bicycle_cat_a = 0;
$Baseline_hoe_cat_a = 0;
$Baseline_radio_cat_a = 0;
$Baseline_plough_cat_a = 0;
$Baseline_mobile_phone_cat_a = 0;
$Baseline_axe_cat_a = 0;

$Baseline_bicycle_cat_b = 0;
$Baseline_hoe_cat_b = 0;
$Baseline_radio_cat_b = 0;
$Baseline_plough_cat_b = 0;
$Baseline_mobile_phone_cat_b = 0;
$Baseline_axe_cat_b = 0;

$Baseline_bicycle_cat_c = 0;
$Baseline_hoe_cat_c = 0;
$Baseline_radio_cat_c = 0;
$Baseline_plough_cat_c = 0;
$Baseline_mobile_phone_cat_c = 0;
$Baseline_axe_cat_c = 0;

$mid_target_bicycle_cat_a = 0;
$mid_target_hoe_cat_a = 0;
$mid_target_radio_cat_a = 0;
$mid_target_plough_cat_a = 0;
$mid_target_mobile_phone_cat_a = 0;
$mid_target_axe_cat_a = 0;

$mid_target_bicycle_cat_b = 0;
$mid_target_hoe_cat_b = 0;
$mid_target_radio_cat_b = 0;
$mid_target_plough_cat_b = 0;
$mid_target_mobile_phone_cat_b = 0;
$mid_target_axe_cat_b = 0;

$mid_target_bicycle_cat_c = 0;
$mid_target_hoe_cat_c = 0;
$mid_target_radio_cat_c = 0;
$mid_target_plough_cat_c = 0;
$mid_target_mobile_phone_cat_c = 0;
$mid_target_axe_cat_c = 0;

$end_target_bicycle_cat_a = 0;
$end_target_hoe_cat_a = 0;
$end_target_radio_cat_a = 0;
$end_target_plough_cat_a = 0;
$end_target_mobile_phone_cat_a = 0;
$end_target_axe_cat_a = 0;

$end_target_bicycle_cat_b = 0;
$end_target_hoe_cat_b = 0;
$end_target_radio_cat_b = 0;
$end_target_plough_cat_b = 0;
$end_target_mobile_phone_cat_b = 0;
$end_target_axe_cat_b = 0;

$end_target_bicycle_cat_c = 0;
$end_target_hoe_cat_c = 0;
$end_target_radio_cat_c = 0;
$end_target_plough_cat_c = 0;
$end_target_mobile_phone_cat_c = 0;
$end_target_axe_cat_c = 0;

$bicycle_cat_a_programme_targets_model = \backend\models\LogframeProgrammeTargets::findOne(['record_type' => "bicycle - Percentage", 'indicator' => "Increase in household assets (%) - Category A"]);
$hoe_cat_a_programme_targets_model = \backend\models\LogframeProgrammeTargets::findOne(['record_type' => "hoe - Percentage", 'indicator' => "Increase in household assets (%) - Category A"]);
$radio_cat_a_programme_targets_model = \backend\models\LogframeProgrammeTargets::findOne(['record_type' => "radio - Percentage", 'indicator' => "Increase in household assets (%) - Category A"]);
$plough_cat_a_programme_targets_model = \backend\models\LogframeProgrammeTargets::findOne(['record_type' => "plough - Percentage", 'indicator' => "Increase in household assets (%) - Category A"]);
$mobile_phone_cat_a_programme_targets_model = \backend\models\LogframeProgrammeTargets::findOne(['record_type' => "mobile phone - Percentage", 'indicator' => "Increase in household assets (%) - Category A"]);
$axe_cat_a_programme_targets_model = \backend\models\LogframeProgrammeTargets::findOne(['record_type' => "axe - Percentage", 'indicator' => "Increase in household assets (%) - Category A"]);

$bicycle_cat_b_programme_targets_model = \backend\models\LogframeProgrammeTargets::findOne(['record_type' => "bicycle - Percentage- Cat B", 'indicator' => "Increase in household assets (%) - Category B"]);
$hoe_cat_b_programme_targets_model = \backend\models\LogframeProgrammeTargets::findOne(['record_type' => "hoe - Percentage- Cat B", 'indicator' => "Increase in household assets (%) - Category B"]);
$radio_cat_b_programme_targets_model = \backend\models\LogframeProgrammeTargets::findOne(['record_type' => "radio - Percentage- Cat B", 'indicator' => "Increase in household assets (%) - Category B"]);
$plough_cat_b_programme_targets_model = \backend\models\LogframeProgrammeTargets::findOne(['record_type' => "plough - Percentage- Cat B", 'indicator' => "Increase in household assets (%) - Category B"]);
$mobile_phone_cat_b_programme_targets_model = \backend\models\LogframeProgrammeTargets::findOne(['record_type' => "mobile phone - Percentage- Cat B", 'indicator' => "Increase in household assets (%) - Category B"]);
$axe_cat_b_programme_targets_model = \backend\models\LogframeProgrammeTargets::findOne(['record_type' => "axe - Percentage- Cat B", 'indicator' => "Increase in household assets (%) - Category B"]);

$bicycle_cat_c_programme_targets_model = \backend\models\LogframeProgrammeTargets::findOne(['record_type' => "bicycle - Percentage- Cat C", 'indicator' => "Increase in household assets (%) - Category C"]);
$hoe_cat_c_programme_targets_model = \backend\models\LogframeProgrammeTargets::findOne(['record_type' => "hoe - Percentage- Cat C", 'indicator' => "Increase in household assets (%) - Category C"]);
$radio_cat_c_programme_targets_model = \backend\models\LogframeProgrammeTargets::findOne(['record_type' => "radio - Percentage- Cat C", 'indicator' => "Increase in household assets (%) - Category C"]);
$plough_cat_c_programme_targets_model = \backend\models\LogframeProgrammeTargets::findOne(['record_type' => "plough - Percentage- Cat C", 'indicator' => "Increase in household assets (%) - Category C"]);
$mobile_phone_cat_c_programme_targets_model = \backend\models\LogframeProgrammeTargets::findOne(['record_type' => "mobile phone - Percentage- Cat C", 'indicator' => "Increase in household assets (%) - Category C"]);
$axe_cat_c_programme_targets_model = \backend\models\LogframeProgrammeTargets::findOne(['record_type' => "axe - Percentage - Cat C", 'indicator' => "Increase in household assets (%) - Category C"]);

if (!empty($bicycle_cat_a_programme_targets_model)) {
    $Baseline_bicycle_cat_a = $bicycle_cat_a_programme_targets_model->baseline;
    $mid_target_bicycle_cat_a = $bicycle_cat_a_programme_targets_model->mid_term;
    $end_target_bicycle_cat_a = $bicycle_cat_a_programme_targets_model->end_target;
}
if (!empty($hoe_cat_a_programme_targets_model)) {
    $Baseline_hoe_cat_a = $hoe_cat_a_programme_targets_model->baseline;
    $mid_target_hoe_cat_a = $hoe_cat_a_programme_targets_model->mid_term;
    $end_target_hoe_cat_a = $hoe_cat_a_programme_targets_model->end_target;
}
if (!empty($radio_cat_a_programme_targets_model)) {
    $Baseline_radio_cat_a = $radio_cat_a_programme_targets_model->baseline;
    $mid_target_radio_cat_a = $radio_cat_a_programme_targets_model->mid_term;
    $end_target_radio_cat_a = $radio_cat_a_programme_targets_model->end_target;
}
if (!empty($plough_cat_a_programme_targets_model)) {
    $Baseline_plough_cat_a = $plough_cat_a_programme_targets_model->baseline;
    $mid_target_plough_cat_a = $plough_cat_a_programme_targets_model->mid_term;
    $end_target_plough_cat_a = $plough_cat_a_programme_targets_model->end_target;
}
if (!empty($mobile_phone_cat_a_programme_targets_model)) {
    $Baseline_mobile_phone_cat_a = $mobile_phone_cat_a_programme_targets_model->baseline;
    $mid_target_mobile_phone_cat_a = $mobile_phone_cat_a_programme_targets_model->mid_term;
    $end_target_mobile_phone_cat_a = $mobile_phone_cat_a_programme_targets_model->end_target;
}
if (!empty($axe_cat_a_programme_targets_model)) {
    $Baseline_axe_cat_a = $axe_cat_a_programme_targets_model->baseline;
    $mid_target_axe_cat_a = $axe_cat_a_programme_targets_model->mid_term;
    $end_target_axe_cat_a = $axe_cat_a_programme_targets_model->end_target;
}
if (!empty($bicycle_cat_b_programme_targets_model)) {
    $Baseline_bicycle_cat_b = $bicycle_cat_b_programme_targets_model->baseline;
    $mid_target_bicycle_cat_b = $bicycle_cat_b_programme_targets_model->mid_term;
    $end_target_bicycle_cat_b = $bicycle_cat_b_programme_targets_model->end_target;
}
if (!empty($hoe_cat_b_programme_targets_model)) {
    $Baseline_hoe_cat_b = $hoe_cat_b_programme_targets_model->baseline;
    $mid_target_hoe_cat_b = $hoe_cat_b_programme_targets_model->mid_term;
    $end_target_hoe_cat_b = $hoe_cat_b_programme_targets_model->end_target;
}
if (!empty($radio_cat_b_programme_targets_model)) {
    $Baseline_radio_cat_b = $radio_cat_b_programme_targets_model->baseline;
    $mid_target_radio_cat_b = $radio_cat_b_programme_targets_model->mid_term;
    $end_target_radio_cat_b = $radio_cat_b_programme_targets_model->end_target;
}
if (!empty($plough_cat_b_programme_targets_model)) {
    $Baseline_plough_cat_b = $plough_cat_b_programme_targets_model->baseline;
    $mid_target_plough_cat_b = $plough_cat_b_programme_targets_model->mid_term;
    $end_target_plough_cat_b = $plough_cat_b_programme_targets_model->end_target;
}
if (!empty($mobile_phone_cat_b_programme_targets_model)) {
    $Baseline_mobile_phone_cat_b = $mobile_phone_cat_b_programme_targets_model->baseline;
    $mid_target_mobile_phone_cat_b = $mobile_phone_cat_b_programme_targets_model->mid_term;
    $end_target_mobile_phone_cat_b = $mobile_phone_cat_b_programme_targets_model->end_target;
}
if (!empty($axe_cat_b_programme_targets_model)) {
    $Baseline_axe_cat_b = $axe_cat_b_programme_targets_model->baseline;
    $mid_target_axe_cat_b = $axe_cat_b_programme_targets_model->mid_term;
    $end_target_axe_cat_b = $axe_cat_b_programme_targets_model->end_target;
}
if (!empty($bicycle_cat_c_programme_targets_model)) {
    $Baseline_bicycle_cat_c = $bicycle_cat_c_programme_targets_model->baseline;
    $mid_target_bicycle_cat_c = $bicycle_cat_c_programme_targets_model->mid_term;
    $end_target_bicycle_cat_c = $bicycle_cat_c_programme_targets_model->end_target;
}
if (!empty($hoe_cat_c_programme_targets_model)) {
    $Baseline_hoe_cat_c = $hoe_cat_c_programme_targets_model->baseline;
    $mid_target_hoe_cat_c = $hoe_cat_c_programme_targets_model->mid_term;
    $end_target_hoe_cat_c = $hoe_cat_c_programme_targets_model->end_target;
}
if (!empty($radio_cat_c_programme_targets_model)) {
    $Baseline_radio_cat_c = $radio_cat_c_programme_targets_model->baseline;
    $mid_target_radio_cat_c = $radio_cat_c_programme_targets_model->mid_term;
    $end_target_radio_cat_c = $radio_cat_c_programme_targets_model->end_target;
}
if (!empty($plough_cat_c_programme_targets_model)) {
    $Baseline_plough_cat_c = $plough_cat_c_programme_targets_model->baseline;
    $mid_target_plough_cat_c = $plough_cat_c_programme_targets_model->mid_term;
    $end_target_plough_cat_c = $plough_cat_c_programme_targets_model->end_target;
}
if (!empty($mobile_phone_cat_c_programme_targets_model)) {
    $Baseline_mobile_phone_cat_c = $mobile_phone_cat_c_programme_targets_model->baseline;
    $mid_target_mobile_phone_cat_c = $mobile_phone_cat_c_programme_targets_model->mid_term;
    $end_target_mobile_phone_cat_c = $mobile_phone_cat_c_programme_targets_model->end_target;
}
if (!empty($axe_cat_c_programme_targets_model)) {
    $Baseline_axe_cat_c = $axe_cat_c_programme_targets_model->baseline;
    $mid_target_axe_cat_c = $axe_cat_c_programme_targets_model->mid_term;
    $end_target_axe_cat_c = $axe_cat_c_programme_targets_model->end_target;
}
?>
<div class="card card-success card-outline">
    <div class="card-body">
        <p>

        <ol>
            <li>
                You can view the set <strong>Baseline,Mid Target and End Target</strong> by Viewing the full record details
            </li>
            <li>
                To view the full record details, clict the icon <span class="fas fa-eye"></span> next to the record
            </li>
        </ol>
        <hr class="dotted"/>
        </p>

        <?php
        if (User::userIsAllowedTo('Submit logframe data')) {
            echo Html::a('<i class="fa fa-plus"></i> '
                    . '<span class="text-xs">Submit record</span>', ['create'], ['class' => 'btn btn-success btn-xs']);
            echo '<hr class="dotted short">';
        }
        $gridColumns = [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'year',
                'options' => ['style' => 'width:100px;'],
                'filterType' => GridView::FILTER_SELECT2,
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true,
                    ],
                ],
                'filter' => \backend\models\CommodityPriceCollection::getYearsList(),
                'filterInputOptions' => ['prompt' => 'Filter by year', 'class' => 'form-control', 'id' => null],
            ],
            // 'indicator:ntext',
            [
                'attribute' => 'yr_target',
                'filter' => false,
                'format' => 'raw',
            ],
            [
                'attribute' => 'yr_results',
                'filter' => false,
                'format' => 'raw',
            ],
            [
                //'class' => EditableColumn::className(),
                'enableSorting' => true,
                'attribute' => 'asset',
                'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filter' => \backend\models\LogframeHouseAssets::ASSETS_TYPES,
                'filterInputOptions' => ['prompt' => 'Filter by Asset type', 'class' => 'form-control',],
                'format' => 'raw',
            ],
            [
                //'class' => EditableColumn::className(),
                'enableSorting' => true,
                'attribute' => 'category',
                'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filter' => \backend\models\LogframeHouseAssets::CATEGORIES,
                'filterInputOptions' => ['prompt' => 'Filter by Category', 'class' => 'form-control',],
                'format' => 'raw',
            ],
            [
                'attribute' => 'cumulative',
                'filter' => false,
                'format' => 'raw',
            ],
            [
                'attribute' => 'cumulative_percentage',
                'filter' => false,
                'format' => 'raw',
            ],
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
                            'title' => 'View record',
                            'data-toggle' => 'tooltip',
                            'data-placement' => 'top',
                            'data-pjax' => '0',
                            'style' => "padding:5px;",
                            'class' => 'bt btn-lg'
                                ]
                        );
                    },
                    'update' => function ($url, $model) {
                        if (User::userIsAllowedTo('Submit logframe data')) {
                            return Html::a(
                                            '<span class="fas fa-edit"></span>', ['update', 'id' => $model->id], [
                                        'title' => 'Update record',
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
                        if (User::userIsAllowedTo('Submit logframe data')) {
                            return Html::a(
                                            '<span class="fa fa-trash"></span>', ['delete', 'id' => $model->id], [
                                        'title' => 'Remove record',
                                        'data-toggle' => 'tooltip',
                                        'data-placement' => 'top',
                                        'data' => [
                                            'confirm' => 'Are you sure you want to remove this record?',
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
            // 'id',
            [
                'attribute' => 'year',
                'options' => ['style' => 'width:80px;'],
                'filterType' => GridView::FILTER_SELECT2,
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true,
                    ],
                ],
                'filter' => \backend\models\CommodityPriceCollection::getYearsList(),
                'filterInputOptions' => ['prompt' => 'Filter by year', 'class' => 'form-control', 'id' => null],
            ],
            [
                'attribute' => 'indicator',
                'filter' => false,
                'format' => 'raw',
            ],
            [
                'label' => 'baseline',
                'filter' => false,
                'format' => 'raw',
                'value' => function ($model) use ($bicycle_cat_a_programme_targets_model, $hoe_cat_a_programme_targets_model,
                        $radio_cat_a_programme_targets_model, $plough_cat_a_programme_targets_model,
                        $mobile_phone_cat_a_programme_targets_model, $axe_cat_a_programme_targets_model,
                        $bicycle_cat_b_programme_targets_model, $hoe_cat_b_programme_targets_model,
                        $radio_cat_b_programme_targets_model, $plough_cat_b_programme_targets_model,
                        $mobile_phone_cat_b_programme_targets_model, $axe_cat_b_programme_targets_model,
                        $bicycle_cat_c_programme_targets_model, $hoe_cat_c_programme_targets_model,
                        $radio_cat_c_programme_targets_model, $plough_cat_c_programme_targets_model,
                        $mobile_phone_cat_c_programme_targets_model, $axe_cat_c_programme_targets_model) {
                    if ($model->asset == "Bicycle" && $model->category == "Category A") {
                        return !empty($bicycle_cat_a_programme_targets_model) ? $bicycle_cat_a_programme_targets_model->baseline : "";
                    }
                    if ($model->asset == "Bicycle" && $model->category == "Category B") {
                        return !empty($bicycle_cat_b_programme_targets_model) ? $bicycle_cat_b_programme_targets_model->baseline : "";
                    }
                    if ($model->asset == "Bicycle" && $model->category == "Category C") {
                        return !empty($bicycle_cat_c_programme_targets_model) ? $bicycle_cat_c_programme_targets_model->baseline : "";
                    }
                    if ($model->asset == "Hoe" && $model->category == "Category A") {
                        return !empty($hoe_cat_a_programme_targets_model) ? $hoe_cat_a_programme_targets_model->baseline : "";
                    }
                    if ($model->asset == "Hoe" && $model->category == "Category B") {
                        return !empty($hoe_cat_b_programme_targets_model) ? $hoe_cat_b_programme_targets_model->baseline : "";
                    }
                    if ($model->asset == "Hoe" && $model->category == "Category C") {
                        return !empty($hoe_cat_c_programme_targets_model) ? $hoe_cat_c_programme_targets_model->baseline : "";
                    }
                    if ($model->asset == "Radio" && $model->category == "Category A") {
                        return !empty($radio_cat_a_programme_targets_model) ? $radio_cat_a_programme_targets_model->baseline : "";
                    }
                    if ($model->asset == "Radio" && $model->category == "Category B") {
                        return !empty($radio_cat_b_programme_targets_model) ? $radio_cat_b_programme_targets_model->baseline : "";
                    }
                    if ($model->asset == "Radio" && $model->category == "Category C") {
                        return !empty($radio_cat_c_programme_targets_model) ? $radio_cat_c_programme_targets_model->baseline : "";
                    }
                    if ($model->asset == "Plough" && $model->category == "Category A") {
                        return !empty($plough_cat_a_programme_targets_model) ? $plough_cat_a_programme_targets_model->baseline : "";
                    }
                    if ($model->asset == "Plough" && $model->category == "Category B") {
                        return !empty($plough_cat_b_programme_targets_model) ? $plough_cat_b_programme_targets_model->baseline : "";
                    }
                    if ($model->asset == "Plough" && $model->category == "Category C") {
                        return !empty($plough_cat_c_programme_targets_model) ? $plough_cat_c_programme_targets_model->baseline : "";
                    }
                    if ($model->asset == "Mobile Phone" && $model->category == "Category A") {
                        return !empty($mobile_phone_cat_a_programme_targets_model) ? $mobile_phone_cat_a_programme_targets_model->baseline : "";
                    }
                    if ($model->asset == "Mobile Phone" && $model->category == "Category B") {
                        return !empty($mobile_phone_cat_b_programme_targets_model) ? $mobile_phone_cat_b_programme_targets_model->baseline : "";
                    }
                    if ($model->asset == "Mobile Phone" && $model->category == "Category C") {
                        return !empty($mobile_phone_cat_c_programme_targets_model) ? $mobile_phone_cat_c_programme_targets_model->baseline : "";
                    }
                    if ($model->asset == "Axe" && $model->category == "Category A") {
                        return !empty($axe_cat_a_programme_targets_model) ? $axe_cat_a_programme_targets_model->baseline : "";
                    }
                    if ($model->asset == "Axe" && $model->category == "Category B") {
                        return !empty($axe_cat_b_programme_targets_model) ? $axe_cat_b_programme_targets_model->baseline : "";
                    }
                    if ($model->asset == "Axe" && $model->category == "Category C") {
                        return !empty($axe_cat_c_programme_targets_model) ? $axe_cat_c_programme_targets_model->baseline : "";
                    }
                }
            ],
            [
                'label' => 'mid_term',
                'filter' => false,
                'format' => 'raw',
                'value' => function ($model) use ($bicycle_cat_a_programme_targets_model, $hoe_cat_a_programme_targets_model,
                        $radio_cat_a_programme_targets_model, $plough_cat_a_programme_targets_model,
                        $mobile_phone_cat_a_programme_targets_model, $axe_cat_a_programme_targets_model,
                        $bicycle_cat_b_programme_targets_model, $hoe_cat_b_programme_targets_model,
                        $radio_cat_b_programme_targets_model, $plough_cat_b_programme_targets_model,
                        $mobile_phone_cat_b_programme_targets_model, $axe_cat_b_programme_targets_model,
                        $bicycle_cat_c_programme_targets_model, $hoe_cat_c_programme_targets_model,
                        $radio_cat_c_programme_targets_model, $plough_cat_c_programme_targets_model,
                        $mobile_phone_cat_c_programme_targets_model, $axe_cat_c_programme_targets_model) {
                    if ($model->asset == "Bicycle" && $model->category == "Category A") {
                        return !empty($bicycle_cat_a_programme_targets_model) ? $bicycle_cat_a_programme_targets_model->mid_term : "";
                    }
                    if ($model->asset == "Bicycle" && $model->category == "Category B") {
                        return !empty($bicycle_cat_b_programme_targets_model) ? $bicycle_cat_b_programme_targets_model->mid_term : "";
                    }
                    if ($model->asset == "Bicycle" && $model->category == "Category C") {
                        return !empty($bicycle_cat_c_programme_targets_model) ? $bicycle_cat_c_programme_targets_model->mid_term : "";
                    }
                    if ($model->asset == "Hoe" && $model->category == "Category A") {
                        return !empty($hoe_cat_a_programme_targets_model) ? $hoe_cat_a_programme_targets_model->mid_term : "";
                    }
                    if ($model->asset == "Hoe" && $model->category == "Category B") {
                        return !empty($hoe_cat_b_programme_targets_model) ? $hoe_cat_b_programme_targets_model->mid_term : "";
                    }
                    if ($model->asset == "Hoe" && $model->category == "Category C") {
                        return !empty($hoe_cat_c_programme_targets_model) ? $hoe_cat_c_programme_targets_model->mid_term : "";
                    }
                    if ($model->asset == "Radio" && $model->category == "Category A") {
                        return !empty($radio_cat_a_programme_targets_model) ? $radio_cat_a_programme_targets_model->mid_term : "";
                    }
                    if ($model->asset == "Radio" && $model->category == "Category B") {
                        return !empty($radio_cat_b_programme_targets_model) ? $radio_cat_b_programme_targets_model->mid_term : "";
                    }
                    if ($model->asset == "Radio" && $model->category == "Category C") {
                        return !empty($radio_cat_c_programme_targets_model) ? $radio_cat_c_programme_targets_model->mid_term : "";
                    }
                    if ($model->asset == "Plough" && $model->category == "Category A") {
                        return !empty($plough_cat_a_programme_targets_model) ? $plough_cat_a_programme_targets_model->mid_term : "";
                    }
                    if ($model->asset == "Plough" && $model->category == "Category B") {
                        return !empty($plough_cat_b_programme_targets_model) ? $plough_cat_b_programme_targets_model->mid_term : "";
                    }
                    if ($model->asset == "Plough" && $model->category == "Category C") {
                        return !empty($plough_cat_c_programme_targets_model) ? $plough_cat_c_programme_targets_model->mid_term : "";
                    }
                    if ($model->asset == "Mobile Phone" && $model->category == "Category A") {
                        return !empty($mobile_phone_cat_a_programme_targets_model) ? $mobile_phone_cat_a_programme_targets_model->mid_term : "";
                    }
                    if ($model->asset == "Mobile Phone" && $model->category == "Category B") {
                        return !empty($mobile_phone_cat_b_programme_targets_model) ? $mobile_phone_cat_b_programme_targets_model->mid_term : "";
                    }
                    if ($model->asset == "Mobile Phone" && $model->category == "Category C") {
                        return !empty($mobile_phone_cat_c_programme_targets_model) ? $mobile_phone_cat_c_programme_targets_model->mid_term : "";
                    }
                    if ($model->asset == "Axe" && $model->category == "Category A") {
                        return !empty($axe_cat_a_programme_targets_model) ? $axe_cat_a_programme_targets_model->mid_term : "";
                    }
                    if ($model->asset == "Axe" && $model->category == "Category B") {
                        return !empty($axe_cat_b_programme_targets_model) ? $axe_cat_b_programme_targets_model->mid_term : "";
                    }
                    if ($model->asset == "Axe" && $model->category == "Category C") {
                        return !empty($axe_cat_c_programme_targets_model) ? $axe_cat_c_programme_targets_model->mid_term : "";
                    }
                },
            ],
            [
                'label' => 'end_target',
                'filter' => false,
                'format' => 'raw',
                'value' => function ($model) use ($bicycle_cat_a_programme_targets_model, $hoe_cat_a_programme_targets_model,
                        $radio_cat_a_programme_targets_model, $plough_cat_a_programme_targets_model,
                        $mobile_phone_cat_a_programme_targets_model, $axe_cat_a_programme_targets_model,
                        $bicycle_cat_b_programme_targets_model, $hoe_cat_b_programme_targets_model,
                        $radio_cat_b_programme_targets_model, $plough_cat_b_programme_targets_model,
                        $mobile_phone_cat_b_programme_targets_model, $axe_cat_b_programme_targets_model,
                        $bicycle_cat_c_programme_targets_model, $hoe_cat_c_programme_targets_model,
                        $radio_cat_c_programme_targets_model, $plough_cat_c_programme_targets_model,
                        $mobile_phone_cat_c_programme_targets_model, $axe_cat_c_programme_targets_model) {
                    if ($model->asset == "Bicycle" && $model->category == "Category A") {
                        return !empty($bicycle_cat_a_programme_targets_model) ? $bicycle_cat_a_programme_targets_model->end_target : "";
                    }
                    if ($model->asset == "Bicycle" && $model->category == "Category B") {
                        return !empty($bicycle_cat_b_programme_targets_model) ? $bicycle_cat_b_programme_targets_model->end_target : "";
                    }
                    if ($model->asset == "Bicycle" && $model->category == "Category C") {
                        return !empty($bicycle_cat_c_programme_targets_model) ? $bicycle_cat_c_programme_targets_model->end_target : "";
                    }
                    if ($model->asset == "Hoe" && $model->category == "Category A") {
                        return !empty($hoe_cat_a_programme_targets_model) ? $hoe_cat_a_programme_targets_model->end_target : "";
                    }
                    if ($model->asset == "Hoe" && $model->category == "Category B") {
                        return !empty($hoe_cat_b_programme_targets_model) ? $hoe_cat_b_programme_targets_model->end_target : "";
                    }
                    if ($model->asset == "Hoe" && $model->category == "Category C") {
                        return !empty($hoe_cat_c_programme_targets_model) ? $hoe_cat_c_programme_targets_model->end_target : "";
                    }
                    if ($model->asset == "Radio" && $model->category == "Category A") {
                        return !empty($radio_cat_a_programme_targets_model) ? $radio_cat_a_programme_targets_model->end_target : "";
                    }
                    if ($model->asset == "Radio" && $model->category == "Category B") {
                        return !empty($radio_cat_b_programme_targets_model) ? $radio_cat_b_programme_targets_model->end_target : "";
                    }
                    if ($model->asset == "Radio" && $model->category == "Category C") {
                        return !empty($radio_cat_c_programme_targets_model) ? $radio_cat_c_programme_targets_model->end_target : "";
                    }
                    if ($model->asset == "Plough" && $model->category == "Category A") {
                        return !empty($plough_cat_a_programme_targets_model) ? $plough_cat_a_programme_targets_model->end_target : "";
                    }
                    if ($model->asset == "Plough" && $model->category == "Category B") {
                        return !empty($plough_cat_b_programme_targets_model) ? $plough_cat_b_programme_targets_model->end_target : "";
                    }
                    if ($model->asset == "Plough" && $model->category == "Category C") {
                        return !empty($plough_cat_c_programme_targets_model) ? $plough_cat_c_programme_targets_model->end_target : "";
                    }
                    if ($model->asset == "Mobile Phone" && $model->category == "Category A") {
                        return !empty($mobile_phone_cat_a_programme_targets_model) ? $mobile_phone_cat_a_programme_targets_model->end_target : "";
                    }
                    if ($model->asset == "Mobile Phone" && $model->category == "Category B") {
                        return !empty($mobile_phone_cat_b_programme_targets_model) ? $mobile_phone_cat_b_programme_targets_model->end_target : "";
                    }
                    if ($model->asset == "Mobile Phone" && $model->category == "Category C") {
                        return !empty($mobile_phone_cat_c_programme_targets_model) ? $mobile_phone_cat_c_programme_targets_model->end_target : "";
                    }
                    if ($model->asset == "Axe" && $model->category == "Category A") {
                        return !empty($axe_cat_a_programme_targets_model) ? $axe_cat_a_programme_targets_model->end_target : "";
                    }
                    if ($model->asset == "Axe" && $model->category == "Category B") {
                        return !empty($axe_cat_b_programme_targets_model) ? $axe_cat_b_programme_targets_model->end_target : "";
                    }
                    if ($model->asset == "Axe" && $model->category == "Category C") {
                        return !empty($axe_cat_c_programme_targets_model) ? $axe_cat_c_programme_targets_model->end_target : "";
                    }
                },
            ],
            [
                'attribute' => 'yr_target',
                'filter' => false,
                'format' => 'raw',
            ],
            [
                'attribute' => 'yr_results',
                'filter' => false,
                'format' => 'raw',
            ],
            [
                //'class' => EditableColumn::className(),
                'enableSorting' => true,
                'attribute' => 'asset',
                'format' => 'raw',
            ],
            [
                //'class' => EditableColumn::className(),
                'enableSorting' => true,
                'attribute' => 'category',
                'format' => 'raw',
            ],
            [
                'attribute' => 'cumulative',
                'filter' => false,
                'format' => 'raw',
            ],
            [
                'attribute' => 'cumulative_percentage',
                'filter' => false,
                'format' => 'raw',
            ],
            [
                'label' => 'Created by',
                'value' => function ($model) {
                    $user = \backend\models\User::findOne(['id' => $model->created_by]);
                    return !empty($user) ? $user->email : "";
                }
            ],
            [
                'label' => 'Updated by',
                'value' => function ($model) {
                    $user = \backend\models\User::findOne(['id' => $model->updated_by]);
                    return !empty($user) ? $user->email : "";
                }
            ],
            [
                'label' => 'Updated at',
                'value' => function ($model) {
                    return date('d F Y H:i:s', $model->updated_at);
                }
            ],
            [
                'label' => 'Created at',
                'value' => function ($model) {
                    return date('d F Y H:i:s', $model->created_at);
                }
            ],
        ];

        $fullExportMenu = "";
        if (!empty($dataProvider) && $dataProvider->getCount() > 0) {

            $fullExportMenu = ExportMenu::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => $gridColumns1,
                        'columnSelectorOptions' => [
                            'label' => 'Cols...',
                            'class' => 'btn btn-outline-success btn-sm',
                        ],
                        'batchSize' => 400,
                        'exportConfig' => [
                            ExportMenu::FORMAT_TEXT => false,
                            ExportMenu::FORMAT_HTML => false,
                            ExportMenu::FORMAT_EXCEL => false,
                            ExportMenu::FORMAT_PDF => false,
                            ExportMenu::FORMAT_CSV => false,
                        ],
                        //'target' => ExportMenu::TARGET_BLANK,
                       // 'pjaxContainerId' => 'kv-pjax-container',
                        'exportContainer' => [
                            'class' => 'btn-group mr-2'
                        ],
                        'filename' => 'logframe_increase_in_household_assets',
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
