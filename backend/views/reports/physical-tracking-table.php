<?php

use kartik\grid\EditableColumn;
use kartik\grid\GridView;
use yii\helpers\Html;
use kartik\editable\Editable;
use backend\models\User;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Physical tracking table';
$this->params['breadcrumbs'][] = "Reports";
$this->params['breadcrumbs'][] = $this->title;
$year = "";
if (isset($_GET['AwbpActivitySearch'])) {
    $year = $_GET['AwbpActivitySearch']['year'];
} else {
    $year = date('Y');
}
?>
<div class="card card-success card-outline">
    <div class="card-body">
        <h4>Instructions</h4>
        <ol>
            <li>Below is the Physical tracking table for the year <?= $year ?></li>
            <li>Apply a filter below to view 'The Physical tracking table' for the previous years and/or province/district</li>
        </ol>
        <?php
        echo $this->render('_search_physical_tracking_table', ['model' => $searchModel,"year"=>$fiscal_year]);
        ?>

        <hr class="dotted short">
        <p class="float-right">
            <?php
            $province_id = "";
            $district_id = "";
            $year = "";
            if (isset($_GET['AwbpActivitySearch'])) {
                $province_id = !empty($_GET['AwbpActivitySearch']['province_id']) ? $_GET['AwbpActivitySearch']['province_id'] : "";
                $district_id = !empty($_GET['AwbpActivitySearch']['district_id']) ? $_GET['AwbpActivitySearch']['district_id'] : "";
                $year = !empty($_GET['AwbpActivitySearch']['year']) ? $_GET['AwbpActivitySearch']['year'] : "";
            }
            if ($dataProvider->getCount() > 0) {
                echo Html::a('<span class="fas fa-file-excel"></span> Export to Excel',
                        ['reports/download-physical-tracking-table'], [
                    'data-method' => 'POST',
                    'data-params' => [
                        'province_id' => $province_id,
                        'district_id' => $district_id,
                        'year' => $year,
                        //'data' => json_encode($dataProvider->getModels())
                    ],
                    'title' => 'Download report in excel',
                    'data-toggle' => 'tooltip',
                    'data-placement' => 'top',
                    'class' => 'btn btn-success btn-xs'
                ]);
            }
            ?>
        </p>
        <?php
      //  var_dump($dataProvider->getModels());
        if ($dataProvider->getCount() > 0) {
            echo GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'condensed' => true,
                'responsive' => true,
                'beforeHeader' => [
                    [
                        'columns' => [
                            ['content' => 'Physical Progress Tracking Table', 'options' => ['colspan' => 6, 'class' => 'text-center warning']],
                            ['content' => 'Planned AWPB ' . $year, 'options' => ['colspan' => 5, 'class' => 'text-center warning', 'style' => 'font-size:14px;font-weight:normal']],
                            ['content' => 'Actual AWPB ' . $year, 'options' => ['colspan' => 5, 'class' => 'text-center warning', 'style' => 'font-size:14px;font-weight:normal']],
                            ['content' => ' ', 'options' => ['colspan' => 5, 'class' => 'text-center warning', 'style' => 'font-size:14px;font-weight:normal']],
                        ],
                    ]
                ],
                'hover' => true,
                'columns' => [
                    // ['class' => 'yii\grid\SerialColumn'],
                    // 'id',

                    [
                        'headerOptions' => ['class' => 'text-center', 'style' => 'font-size:14px;font-weight:normal'],
                        'contentOptions' => ['class' => 'text-left', 'style' => 'font-size:13px;font-weight:normal'],
                        'label' => 'Comp#',
                        'group' => true,
                        'value' => function ($model) {
                            $component = "";
                            $component_model = backend\models\AwpbComponent::findOne($model->component_id);
                            if (!empty($component_model)) {
                                if ($component_model->subcomponent == "Subcomponent") {
                                    $component = backend\models\AwpbComponent::findOne($component_model->parent_component_id)->code;
                                } else {
                                    $component = $component_model->code;
                                }
                            }
                            return $component;
                        }
                    ],
                    [
                        'headerOptions' => ['class' => 'text-center', 'style' => 'font-size:14px;font-weight:normal'],
                        'contentOptions' => ['class' => 'text-left', 'style' => 'font-size:13px;font-weight:normal'],
                        'label' => 'Sub-comp',
                        //'group' => true,
                        'value' => function ($model) {
                            $component = "";
                            $component_model = backend\models\AwpbComponent::findOne($model->component_id);
                            if (!empty($component_model)) {
                                if ($component_model->subcomponent == "Subcomponent") {
                                    $component = $component_model->code;
                                }
                            }
                            return $component;
                        }
                    ],
                    [
                        'headerOptions' => ['class' => 'text-center', 'style' => 'font-size:14px;font-weight:normal'],
                        'contentOptions' => ['class' => 'text-left', 'style' => 'font-size:13px;font-weight:normal'],
                        'attribute' => 'name',
                        'filter' => false,
                        'label' => 'Activity Description',
                        'value' => function ($model) {
                            $awpb_activity = \backend\models\AwpbActivity::findOne($model->activity_id);
                            return !empty($awpb_activity) ? $awpb_activity->description : "";
                        }
                    ],
                    [
                        'headerOptions' => ['class' => 'text-center', 'style' => 'font-size:14px;font-weight:normal'],
                        'contentOptions' => ['class' => 'text-left', 'style' => 'font-size:13px;font-weight:normal'],
                        'label' => 'Indicator',
                        'attribute' => 'indicator_id',
                        'enableSorting' => true,
                        'filter' => false,
                        'value' => function ($model) {
                            $awpb_indicator = \backend\models\AwpbIndicator::findOne($model->indicator_id);
                            return !empty($awpb_indicator) ? $awpb_indicator->name : "";
                        }
                    ],
                    [
                        'headerOptions' => ['class' => 'text-center', 'style' => 'font-size:14px;font-weight:normal'],
                        'contentOptions' => ['class' => 'text-left', 'style' => 'font-size:13px;font-weight:normal'],
                        'label' => 'Unity',
                        'enableSorting' => true,
                        'value' => function ($model) {
                            return !empty($model->unit_of_measure_id) ? backend\models\AwpbUnitOfMeasure::findOne($model->unit_of_measure_id)->name : "";
                        }
                    ],
                    [
                        'headerOptions' => ['class' => 'text-center', 'style' => 'font-size:13px;font-weight:normal'],
                        'label' => 'AWPB target',
                        'enableSorting' => true,
                        'filter' => false,
                        'attribute' => 'total_quantity',
                        'value' => function ($model) use($fiscal_year) {
                            $awpb_template = \backend\models\AwpbTemplate::findOne(['fiscal_year' => $fiscal_year]);
                            $q_total = 0;
                            if (!empty($awpb_template)) {
                                //Get all activity lines that belongs to this subactivity
                                $activity_lines = \backend\models\AwpbActivity::find()
                                        ->where(['id' => $model->id])
                                        ->andWhere(['awpb_template_id' => $awpb_template->id])
                                        ->all();
                                if (!empty($activity_lines)) {
                                    foreach ($activity_lines as $_line) {
                                        $q_total += $_line['mo_1'];
                                        $q_total += $_line['mo_2'];
                                        $q_total += $_line['mo_3'];
                                        $q_total += $_line['mo_4'];
                                        $q_total += $_line['mo_5'];
                                        $q_total += $_line['mo_6'];
                                        $q_total += $_line['mo_7'];
                                        $q_total += $_line['mo_8'];
                                        $q_total += $_line['mo_9'];
                                        $q_total += $_line['mo_10'];
                                        $q_total += $_line['mo_11'];
                                        $q_total += $_line['mo_12'];
                                    }
                                }
                            }

                            return $q_total;
                        }
                    ],
                    [
                        'headerOptions' => ['class' => 'text-center', 'style' => 'font-size:14px;font-weight:normal'],
                        'contentOptions' => ['class' => 'text-left', 'style' => 'font-size:13px;font-weight:normal'],
                        'label' => 'Q1',
                        'enableSorting' => true,
                        'attribute' => 'quarter_one_quantity',
                        'filter' => false,
                    ],
                    [
                        'headerOptions' => ['class' => 'text-center', 'style' => 'font-size:14px;font-weight:normal'],
                        'contentOptions' => ['class' => 'text-left', 'style' => 'font-size:13px;font-weight:normal'],
                        'label' => 'Q2',
                        'enableSorting' => true,
                        'attribute' => 'quarter_two_quantity',
                        'filter' => false,
                    ],
                    [
                        'headerOptions' => ['class' => 'text-center', 'style' => 'font-size:14px;font-weight:normal'],
                        'contentOptions' => ['class' => 'text-left', 'style' => 'font-size:13px;font-weight:normal'],
                        'label' => 'Q3',
                        'enableSorting' => true,
                        'attribute' => 'quarter_three_quantity',
                        'filter' => false,
                    ],
                    [
                        'headerOptions' => ['class' => 'text-center', 'style' => 'font-size:14px;font-weight:normal'],
                        'contentOptions' => ['class' => 'text-left', 'style' => 'font-size:13px;font-weight:normal'],
                        'label' => 'Q4',
                        'enableSorting' => true,
                        'filter' => false,
                        'attribute' => 'quarter_four_quantity',
                    ],
                    [
                        'headerOptions' => ['class' => 'text-center', 'style' => 'font-size:14px;font-weight:normal'],
                        'contentOptions' => ['class' => 'text-left', 'style' => 'font-size:13px;font-weight:normal'],
                        'label' => 'Total',
                        'enableSorting' => true,
                        'filter' => false,
                        'value' => function ($model) {
                            $q_total = 0;
                            $q_total += $model->quarter_one_quantity;
                            $q_total += $model->quarter_two_quantity;
                            $q_total += $model->quarter_three_quantity;
                            $q_total += $model->quarter_four_quantity;
                            return $q_total;
                        }
                    ],
                    [
                        'headerOptions' => ['class' => 'text-center', 'style' => 'font-size:14px;font-weight:normal'],
                        'contentOptions' => ['class' => 'text-left', 'style' => 'font-size:13px;font-weight:normal'],
                        //    'headerOptions' => ['class' => 'text-center', 'style' => 'font-size:13px;font-weight:normal'],
                        'label' => 'Q1',
                        'enableSorting' => true,
                        'filter' => false,
                        'attribute' => 'quarter_one_actual',
                    ],
                    [
                        'headerOptions' => ['class' => 'text-center', 'style' => 'font-size:14px;font-weight:normal'],
                        'contentOptions' => ['class' => 'text-left', 'style' => 'font-size:13px;font-weight:normal'],
                        // 'headerOptions' => ['class' => 'text-center', 'style' => 'font-size:13px;font-weight:normal'],
                        'label' => 'Q2',
                        'enableSorting' => true,
                        'filter' => false,
                        'attribute' => 'quarter_two_actual',
                    ],
                    [
                        'headerOptions' => ['class' => 'text-center', 'style' => 'font-size:14px;font-weight:normal'],
                        'contentOptions' => ['class' => 'text-left', 'style' => 'font-size:13px;font-weight:normal'],
                        // 'headerOptions' => ['class' => 'text-center', 'style' => 'font-size:13px;font-weight:normal'],
                        'label' => 'Q3',
                        'enableSorting' => true,
                        'filter' => false,
                        'attribute' => 'quarter_three_actual',
                    ],
                    [
                        'headerOptions' => ['class' => 'text-center', 'style' => 'font-size:14px;font-weight:normal'],
                        'contentOptions' => ['class' => 'text-left', 'style' => 'font-size:13px;font-weight:normal'],
                        // 'headerOptions' => ['class' => 'text-center', 'style' => 'font-size:13px;font-weight:normal'],
                        'label' => 'Q4',
                        'enableSorting' => true,
                        'filter' => false,
                        'attribute' => 'quarter_four_actual',
                    ],
                    [
                        'headerOptions' => ['class' => 'text-center', 'style' => 'font-size:14px;font-weight:normal'],
                        'contentOptions' => ['class' => 'text-left', 'style' => 'font-size:13px;font-weight:normal'],
                        // 'headerOptions' => ['class' => 'text-center', 'style' => 'font-size:13px;font-weight:normal'],
                        'label' => 'Total',
                        'enableSorting' => true,
                        'filter' => false,
                        'value' => function ($model) {
                            $q_total = 0;
                            $q_total += $model->quarter_one_actual;
                            $q_total += $model->quarter_two_actual;
                            $q_total += $model->quarter_three_actual;
                            $q_total += $model->quarter_four_actual;
                            return $q_total;
                        }
                    ],
                    [
                        'headerOptions' => ['class' => 'text-center', 'style' => 'font-size:14px;font-weight:normal'],
                        'contentOptions' => ['class' => 'text-left', 'style' => 'font-size:13px;font-weight:normal'],
                        // 'headerOptions' => ['class' => 'text-center', 'style' => 'font-size:13px;font-weight:normal'],
                        'label' => '% AWPB Achieved',
                        'enableSorting' => true,
                        'filter' => false,
                        'value' => function ($model) {
                            $q_total = 0;
                            $q_total1 = 0;
                            $result = 0;

                            $q_total += $model->quarter_one_quantity;
                            $q_total += $model->quarter_two_quantity;
                            $q_total += $model->quarter_three_quantity;
                            $q_total += $model->quarter_four_quantity;
                            $q_total1 += $model->quarter_one_actual;
                            $q_total1 += $model->quarter_two_actual;
                            $q_total1 += $model->quarter_three_actual;
                            $q_total1 += $model->quarter_four_actual;
                            if ($q_total > 0) {
                                $result = round(($q_total1 / $q_total) * 100, 1);
                            }
                            return $result;
                        }
                    ],
                    [
                        'headerOptions' => ['class' => 'text-center', 'style' => 'font-size:14px;font-weight:normal'],
                        'contentOptions' => ['class' => 'text-left', 'style' => 'font-size:13px;font-weight:normal'],
                        // 'headerOptions' => ['class' => 'text-center', 'style' => 'font-size:13px;font-weight:normal'],
                        'label' => 'Cum Actual',
                        'enableSorting' => true,
                        'filter' => false,
                        'value' => function ($model) use($fiscal_year) {
                            return !empty($model->cumulative_actual) ? $model->cumulative_actual : 0;
                        }
                    ],
                    [
                        'headerOptions' => ['class' => 'text-center', 'style' => 'font-size:14px;font-weight:normal'],
                        'contentOptions' => ['class' => 'text-left', 'style' => 'font-size:13px;font-weight:normal'],
                        // 'headerOptions' => ['class' => 'text-center', 'style' => 'font-size:13px;font-weight:normal'],
                        'label' => 'Appr Target',
                        'enableSorting' => true,
                        'filter' => false,
                        'value' => function ($model) {
                            return !empty($model->programme_target) ? $model->programme_target : 0;
                        }
                    ],
                    [
                        'headerOptions' => ['class' => 'text-center', 'style' => 'font-size:14px;font-weight:normal'],
                        'contentOptions' => ['class' => 'text-left', 'style' => 'font-size:13px;font-weight:normal'],
                        // 'headerOptions' => ['class' => 'text-center', 'style' => 'font-size:13px;font-weight:normal'],
                        'label' => '% Appr Target',
                        'enableSorting' => true,
                        'filter' => false,
                        'value' => function ($model) {
                            $appr_percentage = 0;
                            $appr = !empty($model->programme_target) ? $model->programme_target : 0;
                            $cum_actual = !empty($model->cumulative_actual) ? $model->cumulative_actual : 0;
                            if ($appr > 0) {
                                $appr_percentage = round(($cum_actual / $appr) * 100, 2);
                            }
                            return $appr_percentage;
                        }
                    ],
                    [
                        'headerOptions' => ['class' => 'text-center', 'style' => 'font-size:14px;font-weight:normal'],
                        'contentOptions' => ['class' => 'text-left', 'style' => 'font-size:13px;font-weight:normal'],
                        // 'headerOptions' => ['class' => 'text-center', 'style' => 'font-size:13px;font-weight:normal'],
                        'label' => 'Remarks',
                        'filter' => false,
                    ],
                //'updated_at',
                //'created_by',
                //'updated_by',
                ],
            ]);
        } else {
            echo "<p>No data was found for your search query!</p>";
        }
        ?>
    </div>
</div>
