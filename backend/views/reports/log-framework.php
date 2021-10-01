<?php

use kartik\grid\EditableColumn;
use kartik\grid\GridView;
use yii\helpers\Html;
use kartik\editable\Editable;
use backend\models\User;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Log Framework';
$this->params['breadcrumbs'][] = "Reports";
$this->params['breadcrumbs'][] = $this->title;

//Outreach records
//1. Females/Males
$Baseline_females = 0;
$Baseline_males = 0;
$mid_target_males = 0;
$mid_target_females = 0;
$end_target_males = 0;
$end_target_females = 0;
$females_programme_targets_model = \backend\models\LogframeProgrammeTargets::findOne(['record_type' => "Females - Number", 'indicator' => "Persons receiving services promoted or supported by the project"]);
$males_programme_targets_model = \backend\models\LogframeProgrammeTargets::findOne(['record_type' => "Males - Number", 'indicator' => "Persons receiving services promoted or supported by the project"]);
if (!empty($females_programme_targets_model)) {
    $Baseline_females = trim($females_programme_targets_model->baseline);
    $mid_target_males = trim($females_programme_targets_model->mid_term);
    $end_target_males = trim($females_programme_targets_model->end_target);
}
if (!empty($males_programme_targets_model)) {
    $Baseline_males = trim($males_programme_targets_model->baseline);
    $mid_target_females = trim($males_programme_targets_model->mid_term);
    $end_target_females = trim($males_programme_targets_model->end_target);
}

$baseline_total = (int) $Baseline_females + (int) $Baseline_males;
$mid_target_total = (int) $mid_target_females + (int) $mid_target_males;
$end_target_total = (int) $end_target_females + (int) $end_target_males;

//2. Young/Not young
$Baseline_young = 0;
$Baseline_not_young = 0;
$mid_target_not_young = 0;
$mid_target_young = 0;
$end_target_not_young = 0;
$end_target_young = 0;
$young_programme_targets_model = \backend\models\LogframeProgrammeTargets::findOne(['record_type' => "Young - Number", 'indicator' => "Persons receiving services promoted or supported by the project"]);
$not_young_programme_targets_model = \backend\models\LogframeProgrammeTargets::findOne(['record_type' => "Not Young - Number", 'indicator' => "Persons receiving services promoted or supported by the project"]);
if (!empty($young_programme_targets_model)) {
    $Baseline_young = trim($young_programme_targets_model->baseline);
    $mid_target_young = trim($young_programme_targets_model->mid_term);
    $end_target_young = trim($young_programme_targets_model->end_target);
}
if (!empty($not_young_programme_targets_model)) {
    $Baseline_not_young = trim($not_young_programme_targets_model->baseline);
    $mid_target_not_young = trim($not_young_programme_targets_model->mid_term);
    $end_target_not_young = trim($not_young_programme_targets_model->end_target);
}

$baseline_yny_total = (int) $Baseline_young + (int) $Baseline_not_young;
$mid_yny_total = (int) $mid_target_young + (int) $mid_target_not_young;
$end_target_yny_total = (int) $end_target_young + (int) $end_target_not_young;
//3. Year results :- we expect each table to hold only a single record for each year
//2018
$outreach_females_2018_records = backend\models\LogframeOutreachPersonsGender::findOne(["year" => 2018, "gender" => "females"]);
$outreach_males_2018_records = backend\models\LogframeOutreachPersonsGender::findOne(["year" => 2018, "gender" => "males"]);
$outreach_young_2018_records = backend\models\LogframeOutreachPersonsYoung::findOne(["year" => 2018, "young_not_young" => "Young"]);
$outreach_not_young_2018_records = backend\models\LogframeOutreachPersonsYoung::findOne(["year" => 2018, "young_not_young" => "Not Young"]);

$year_target_female_2018 = !empty($outreach_females_2018_records) ? trim($outreach_females_2018_records->yr_target) : 0;
$year_results_female_2018 = !empty($outreach_females_2018_records) ? trim($outreach_females_2018_records->yr_results) : 0;
$year_female_cum_2018 = !empty($outreach_females_2018_records) ? trim($outreach_females_2018_records->cumulative) : 0;
$year_female_cum_percentage_2018 = !empty($outreach_females_2018_records) ? trim($outreach_females_2018_records->cumulative_percentage) : 0;

$year_target_male_2018 = !empty($outreach_males_2018_records) ? trim($outreach_males_2018_records->yr_target) : 0;
$year_results_male_2018 = !empty($outreach_males_2018_records) ? trim($outreach_males_2018_records->yr_results) : 0;
$year_male_cum_2018 = !empty($outreach_males_2018_records) ? trim($outreach_males_2018_records->cumulative) : 0;
$year_male_cum_percentage_2018 = !empty($outreach_males_2018_records) ? trim($outreach_males_2018_records->cumulative_percentage) : 0;

$year_target_young_2018 = !empty($outreach_young_2018_records) ? trim($outreach_young_2018_records->yr_target) : 0;
$year_results_young_2018 = !empty($outreach_young_2018_records) ? trim($outreach_young_2018_records->yr_results) : 0;
$year_young_cum_2018 = !empty($outreach_young_2018_records) ? trim($outreach_young_2018_records->cumulative) : 0;
$year_young_cum_percentage_2018 = !empty($outreach_young_2018_records) ? trim($outreach_young_2018_records->cumulative_percentage) : 0;

$year_target_notyoung_2018 = !empty($outreach_not_young_2018_records) ? trim($outreach_not_young_2018_records->yr_target) : 0;
$year_results_notyoung_2018 = !empty($outreach_not_young_2018_records) ? trim($outreach_not_young_2018_records->yr_results) : 0;
$year_notyoung_cum_2018 = !empty($outreach_not_young_2018_records) ? trim($outreach_not_young_2018_records->cumulative) : 0;
$year_notyoung_cum_percentage_2018 = !empty($outreach_not_young_2018_records) ? trim($outreach_not_young_2018_records->cumulative_percentage) : 0;

$year_target_2018_total_fm = $year_target_female_2018 + $year_target_male_2018;
$year_results_2018_total_fm = $year_results_female_2018 + $year_results_male_2018;
$year_cum_2018_total_fm = $year_male_cum_2018 + $year_female_cum_2018;
$year_cum_percentage_2018_total_fm = $year_male_cum_percentage_2018 + $year_female_cum_percentage_2018;
$year_target_2018_total_yny = $year_target_young_2018 + $year_target_notyoung_2018;
$year_results_2018_total_yny = $year_results_young_2018 + $year_results_notyoung_2018;
$year_cum_2018_total_yny = $year_notyoung_cum_2018 + $year_young_cum_2018;
$year_cum_percentage_2018_total_yny = $year_young_cum_percentage_2018 + $year_notyoung_cum_percentage_2018;

//2019
$outreach_females_2019_records = backend\models\LogframeOutreachPersonsGender::findOne(["year" => 2019, "gender" => "females"]);
$outreach_males_2019_records = backend\models\LogframeOutreachPersonsGender::findOne(["year" => 2019, "gender" => "males"]);
$outreach_young_2019_records = backend\models\LogframeOutreachPersonsYoung::findOne(["year" => 2019, "young_not_young" => "Young"]);
$outreach_not_young_2019_records = backend\models\LogframeOutreachPersonsYoung::findOne(["year" => 2019, "young_not_young" => "Not Young"]);

$year_target_female_2019 = !empty($outreach_females_2019_records) ? trim($outreach_females_2019_records->yr_target) : 0;
$year_results_female_2019 = !empty($outreach_females_2019_records) ? trim($outreach_females_2019_records->yr_results) : 0;
$year_female_cum_2019 = !empty($outreach_females_2019_records) ? trim($outreach_females_2019_records->cumulative) : 0;
$year_female_cum_percentage_2019 = !empty($outreach_females_2019_records) ? trim($outreach_females_2019_records->cumulative_percentage) : 0;

$year_target_male_2019 = !empty($outreach_males_2019_records) ? trim($outreach_males_2019_records->yr_target) : 0;
$year_results_male_2019 = !empty($outreach_males_2019_records) ? trim($outreach_males_2019_records->yr_results) : 0;
$year_male_cum_2019 = !empty($outreach_males_2019_records) ? trim($outreach_males_2019_records->cumulative) : 0;
$year_male_cum_percentage_2019 = !empty($outreach_males_2019_records) ? trim($outreach_males_2019_records->cumulative_percentage) : 0;

$year_target_young_2019 = !empty($outreach_young_2019_records) ? trim($outreach_young_2019_records->yr_target) : 0;
$year_results_young_2019 = !empty($outreach_young_2019_records) ? trim($outreach_young_2019_records->yr_results) : 0;
$year_young_cum_2019 = !empty($outreach_young_2019_records) ? trim($outreach_young_2019_records->cumulative) : 0;
$year_young_cum_percentage_2019 = !empty($outreach_young_2019_records) ? trim($outreach_young_2019_records->cumulative_percentage) : 0;

$year_target_notyoung_2019 = !empty($outreach_not_young_2019_records) ? trim($outreach_not_young_2019_records->yr_target) : 0;
$year_results_notyoung_2019 = !empty($outreach_not_young_2019_records) ? trim($outreach_not_young_2019_records->yr_results) : 0;
$year_notyoung_cum_2019 = !empty($outreach_not_young_2019_records) ? trim($outreach_not_young_2019_records->cumulative) : 0;
$year_notyoung_cum_percentage_2019 = !empty($outreach_not_young_2019_records) ? trim($outreach_not_young_2019_records->cumulative_percentage) : 0;

$year_target_2019_total_fm = $year_target_female_2019 + $year_target_male_2019;
$year_results_2019_total_fm = $year_results_female_2019 + $year_results_male_2019;
$year_cum_2019_total_fm = $year_male_cum_2019 + $year_female_cum_2019;
$year_cum_percentage_2019_total_fm = $year_male_cum_percentage_2019 + $year_female_cum_percentage_2019;
$year_target_2019_total_yny = $year_target_young_2019 + $year_target_notyoung_2019;
$year_results_2019_total_yny = $year_results_young_2019 + $year_results_notyoung_2019;
$year_cum_2019_total_yny = $year_notyoung_cum_2019 + $year_young_cum_2019;
$year_cum_percentage_2019_total_yny = $year_young_cum_percentage_2019 + $year_notyoung_cum_percentage_2019;


//2020
$outreach_females_2020_records = backend\models\LogframeOutreachPersonsGender::findOne(["year" => 2020, "gender" => "females"]);
$outreach_males_2020_records = backend\models\LogframeOutreachPersonsGender::findOne(["year" => 2020, "gender" => "males"]);
$outreach_young_2020_records = backend\models\LogframeOutreachPersonsYoung::findOne(["year" => 2020, "young_not_young" => "Young"]);
$outreach_not_young_2020_records = backend\models\LogframeOutreachPersonsYoung::findOne(["year" => 2020, "young_not_young" => "Not Young"]);

$year_target_female_2020 = !empty($outreach_females_2020_records) ? trim($outreach_females_2020_records->yr_target) : 0;
$year_results_female_2020 = !empty($outreach_females_2020_records) ? trim($outreach_females_2020_records->yr_results) : 0;
$year_female_cum_2020 = !empty($outreach_females_2020_records) ? trim($outreach_females_2020_records->cumulative) : 0;
$year_female_cum_percentage_2020 = !empty($outreach_females_2020_records) ? trim($outreach_females_2020_records->cumulative_percentage) : 0;

$year_target_male_2020 = !empty($outreach_males_2020_records) ? trim($outreach_males_2020_records->yr_target) : 0;
$year_results_male_2020 = !empty($outreach_males_2020_records) ? trim($outreach_males_2020_records->yr_results) : 0;
$year_male_cum_2020 = !empty($outreach_males_2020_records) ? trim($outreach_males_2020_records->cumulative) : 0;
$year_male_cum_percentage_2020 = !empty($outreach_males_2020_records) ? trim($outreach_males_2020_records->cumulative_percentage) : 0;

$year_target_young_2020 = !empty($outreach_young_2020_records) ? trim($outreach_young_2020_records->yr_target) : 0;
$year_results_young_2020 = !empty($outreach_young_2020_records) ? trim($outreach_young_2020_records->yr_results) : 0;
$year_young_cum_2020 = !empty($outreach_young_2020_records) ? trim($outreach_young_2020_records->cumulative) : 0;
$year_young_cum_percentage_2020 = !empty($outreach_young_2020_records) ? trim($outreach_young_2020_records->cumulative_percentage) : 0;

$year_target_notyoung_2020 = !empty($outreach_not_young_2020_records) ? trim($outreach_not_young_2020_records->yr_target) : 0;
$year_results_notyoung_2020 = !empty($outreach_not_young_2020_records) ? trim($outreach_not_young_2020_records->yr_results) : 0;
$year_notyoung_cum_2020 = !empty($outreach_not_young_2020_records) ? trim($outreach_not_young_2020_records->cumulative) : 0;
$year_notyoung_cum_percentage_2020 = !empty($outreach_not_young_2020_records) ? trim($outreach_not_young_2020_records->cumulative_percentage) : 0;

$year_target_2020_total_fm = $year_target_female_2020 + $year_target_male_2020;
$year_results_2020_total_fm = $year_results_female_2020 + $year_results_male_2020;
$year_cum_2020_total_fm = $year_male_cum_2020 + $year_female_cum_2020;
$year_cum_percentage_2020_total_fm = $year_male_cum_percentage_2020 + $year_female_cum_percentage_2020;
$year_target_2020_total_yny = $year_target_young_2020 + $year_target_notyoung_2020;
$year_results_2020_total_yny = $year_results_young_2020 + $year_results_notyoung_2020;
$year_cum_2020_total_yny = $year_notyoung_cum_2020 + $year_young_cum_2020;
$year_cum_percentage_2020_total_yny = $year_young_cum_percentage_2020 + $year_notyoung_cum_percentage_2020;


//2021
$outreach_females_2021_records = backend\models\LogframeOutreachPersonsGender::findOne(["year" => 2021, "gender" => "females"]);
$outreach_males_2021_records = backend\models\LogframeOutreachPersonsGender::findOne(["year" => 2021, "gender" => "males"]);
$outreach_young_2021_records = backend\models\LogframeOutreachPersonsYoung::findOne(["year" => 2021, "young_not_young" => "Young"]);
$outreach_not_young_2021_records = backend\models\LogframeOutreachPersonsYoung::findOne(["year" => 2021, "young_not_young" => "Not Young"]);

$year_target_female_2021 = !empty($outreach_females_2021_records) ? trim($outreach_females_2021_records->yr_target) : 0;
$year_results_female_2021 = !empty($outreach_females_2021_records) ? trim($outreach_females_2021_records->yr_results) : 0;
$year_female_cum_2021 = !empty($outreach_females_2021_records) ? trim($outreach_females_2021_records->cumulative) : 0;
$year_female_cum_percentage_2021 = !empty($outreach_females_2021_records) ? trim($outreach_females_2021_records->cumulative_percentage) : 0;

$year_target_male_2021 = !empty($outreach_males_2021_records) ? trim($outreach_males_2021_records->yr_target) : 0;
$year_results_male_2021 = !empty($outreach_males_2021_records) ? trim($outreach_males_2021_records->yr_results) : 0;
$year_male_cum_2021 = !empty($outreach_males_2021_records) ? trim($outreach_males_2021_records->cumulative) : 0;
$year_male_cum_percentage_2021 = !empty($outreach_males_2021_records) ? trim($outreach_males_2021_records->cumulative_percentage) : 0;

$year_target_young_2021 = !empty($outreach_young_2021_records) ? trim($outreach_young_2021_records->yr_target) : 0;
$year_results_young_2021 = !empty($outreach_young_2021_records) ? trim($outreach_young_2021_records->yr_results) : 0;
$year_young_cum_2021 = !empty($outreach_young_2021_records) ? trim($outreach_young_2021_records->cumulative) : 0;
$year_young_cum_percentage_2021 = !empty($outreach_young_2021_records) ? trim($outreach_young_2021_records->cumulative_percentage) : 0;

$year_target_notyoung_2021 = !empty($outreach_not_young_2021_records) ? trim($outreach_not_young_2021_records->yr_target) : 0;
$year_results_notyoung_2021 = !empty($outreach_not_young_2021_records) ? trim($outreach_not_young_2021_records->yr_results) : 0;
$year_notyoung_cum_2021 = !empty($outreach_not_young_2021_records) ? trim($outreach_not_young_2021_records->cumulative) : 0;
$year_notyoung_cum_percentage_2021 = !empty($outreach_not_young_2021_records) ? trim($outreach_not_young_2021_records->cumulative_percentage) : 0;

$year_target_2021_total_fm = $year_target_female_2021 + $year_target_male_2021;
$year_results_2021_total_fm = $year_results_female_2021 + $year_results_male_2021;
$year_cum_2021_total_fm = $year_male_cum_2021 + $year_female_cum_2021;
$year_cum_percentage_2021_total_fm = $year_male_cum_percentage_2021 + $year_female_cum_percentage_2021;
$year_target_2021_total_yny = $year_target_young_2021 + $year_target_notyoung_2021;
$year_results_2021_total_yny = $year_results_young_2021 + $year_results_notyoung_2021;
$year_cum_2021_total_yny = $year_notyoung_cum_2021 + $year_young_cum_2021;
$year_cum_percentage_2021_total_yny = $year_young_cum_percentage_2021 + $year_notyoung_cum_percentage_2021;
?>

<div class="card card-success card-outline">
    <div class="card-body">
        <h4>Instructions</h4>
        <ol>
            <li>The Log Framework gives data for the duration of the programme</li>

        </ol>
        <hr class="dotted short">
        <table class="table table-bordered table-sm" style="overflow-x: auto;white-space: nowrap;display: block;overflow: scroll;">

            <tbody>
                <tr>
                    <td rowspan="2"><strong>Results Hierarchy</strong></td>
                    <td><strong>Indicators</strong></td>
                    <td colspan="3"><strong>Progamme Targets</strong></td>
                    <td colspan="4"><strong>Project Yr(2018)</strong></td>
                    <td colspan="4"><strong>Project Yr(2019)</strong></td>
                    <td colspan="4"><strong>Project Yr(2020)</strong></td>
                    <td colspan="4"><strong>Project Yr(2021)</strong></td>
                </tr>
                <tr>
                    <td><strong>Name</strong></td>
                    <td><strong>Baseline</strong></td>
                    <td><strong>Mid-Term</strong></td>
                    <td><strong>End Target</strong></td>
                    <td><strong>Yr Target</strong></td>
                    <td><strong>Yr Result</strong></td>
                    <td><strong>Cum</strong></td>
                    <td><strong>Cum %</strong></td>
                    <td><strong>Yr Target</strong></td>
                    <td><strong>Yr Result</strong></td>
                    <td><strong>Cum</strong></td>
                    <td><strong>Cum %</strong></td>
                    <td><strong>Yr Target</strong></td>
                    <td><strong>Yr Result</strong></td>
                    <td><strong>Cum</strong></td>
                    <td><strong>Cum %</strong></td>
                    <td><strong>Yr Target</strong></td>
                    <td><strong>Yr Result</strong></td>
                    <td><strong>Cum</strong></td>
                    <td><strong>Cum %</strong></td>
                </tr>
                <tr>
                    <td rowspan="7"><strong>Outreach</strong></td>
                    <td><strong>1 Persons receiving services promoted or supported by the project</strong></td>
                    <td colspan="3"></td>
                    <td colspan="4"></td>
                    <td colspan="4"></td>
                    <td colspan="4"></td>
                    <td colspan="4"></td>
                </tr>
                <tr>
                    <td>Females - Number</td>
                    <td><?= $Baseline_females ?></td>
                    <td><?= $mid_target_females ?></td>
                    <td><?= $end_target_females ?></td>
                    <td><?= $year_target_female_2018 ?></td>
                    <td><?= $year_results_female_2018 ?></td>
                    <td><?= $year_female_cum_2018 ?></td>
                    <td><?= $year_female_cum_percentage_2018 ?></td>
                    <td><?= $year_target_female_2019 ?></td>
                    <td><?= $year_results_female_2019 ?></td>
                    <td><?= $year_female_cum_2019 ?></td>
                    <td><?= $year_female_cum_percentage_2019 ?></td>
                    <td><?= $year_target_female_2020 ?></td>
                    <td><?= $year_results_female_2020 ?></td>
                    <td><?= $year_female_cum_2020 ?></td>
                    <td><?= $year_female_cum_percentage_2020 ?></td>
                    <td><?= $year_target_female_2021 ?></td>
                    <td><?= $year_results_female_2021 ?></td>
                    <td><?= $year_female_cum_2021 ?></td>
                    <td><?= $year_female_cum_percentage_2021 ?></td>
                </tr>
                <tr>
                    <td>Males - Number</td>
                    <td><?= $Baseline_males ?></td>
                    <td><?= $mid_target_males ?></td>
                    <td><?= $end_target_males ?></td>
                    <td><?= $year_target_male_2018 ?></td>
                    <td><?= $year_results_male_2018 ?></td>
                    <td><?= $year_male_cum_2018 ?></td>
                    <td><?= $year_male_cum_percentage_2018 ?></td>
                    <td><?= $year_target_male_2019 ?></td>
                    <td><?= $year_results_male_2019 ?></td>
                    <td><?= $year_male_cum_2019 ?></td>
                    <td><?= $year_male_cum_percentage_2019 ?></td>
                    <td><?= $year_target_male_2020 ?></td>
                    <td><?= $year_results_male_2020 ?></td>
                    <td><?= $year_male_cum_2020 ?></td>
                    <td><?= $year_male_cum_percentage_2020 ?></td>
                    <td><?= $year_target_male_2021 ?></td>
                    <td><?= $year_results_male_2021 ?></td>
                    <td><?= $year_male_cum_2021 ?></td>
                    <td><?= $year_male_cum_percentage_2021 ?></td>
                </tr>
                <tr>
                    <td><strong>Total</strong> </td>
                    <td><strong><?= $baseline_total ?></strong></td>
                    <td><strong><?= $mid_target_total ?></strong></td>
                    <td><strong><?= $end_target_total ?></strong></td>
                    <td><strong><?= $year_target_2018_total_fm ?></strong></td>
                    <td><strong><?= $year_results_2018_total_fm ?></strong></td>
                    <td><strong><?= $year_cum_2018_total_fm ?></strong></td>
                    <td><strong><?= $year_cum_percentage_2018_total_fm ?></strong></td>
                    <td><strong><?= $year_target_2019_total_fm ?></strong></td>
                    <td><strong><?= $year_results_2019_total_fm ?></strong></td>
                    <td><strong><?= $year_cum_2019_total_fm ?></strong></td>
                    <td><strong><?= $year_cum_percentage_2019_total_fm ?></strong></td>
                    <td><strong><?= $year_target_2020_total_fm ?></strong></td>
                    <td><strong><?= $year_results_2020_total_fm ?></strong></td>
                    <td><strong><?= $year_cum_2020_total_fm ?></strong></td>
                    <td><strong><?= $year_cum_percentage_2020_total_fm ?></strong></td>
                    <td><strong><?= $year_target_2021_total_fm ?></strong></td>
                    <td><strong><?= $year_results_2021_total_fm ?></strong></td>
                    <td><strong><?= $year_cum_2021_total_fm ?></strong></td>
                    <td><strong><?= $year_cum_percentage_2021_total_fm ?></strong></td>
                </tr>
                <tr>
                    <td>Young - Number</td>
                    <td><?= $Baseline_young ?></td>
                    <td><?= $mid_target_young ?></td>
                    <td><?= $end_target_not_young ?></td>
                    <td><?= $year_target_young_2018 ?></td>
                    <td><?= $year_results_young_2018 ?></td>
                    <td><?= $year_young_cum_2018 ?></td>
                    <td><?= $year_young_cum_percentage_2018 ?></td>
                    <td><?= $year_target_young_2019 ?></td>
                    <td><?= $year_results_young_2019 ?></td>
                    <td><?= $year_young_cum_2019 ?></td>
                    <td><?= $year_young_cum_percentage_2019 ?></td>
                    <td><?= $year_target_young_2020 ?></td>
                    <td><?= $year_results_young_2020 ?></td>
                    <td><?= $year_young_cum_2020 ?></td>
                    <td><?= $year_young_cum_percentage_2020 ?></td>
                    <td><?= $year_target_young_2021 ?></td>
                    <td><?= $year_results_young_2021 ?></td>
                    <td><?= $year_young_cum_2021 ?></td>
                    <td><?= $year_young_cum_percentage_2021 ?></td>
                </tr>
                <tr>
                    <td>Not Young - Number</td>
                    <td><?= $Baseline_not_young ?></td>
                    <td><?= $mid_target_not_young ?></td>
                    <td><?= $end_target_not_young ?></td>
                    <td><?= $year_target_notyoung_2018 ?></td>
                    <td><?= $year_results_notyoung_2018 ?></td>
                    <td><?= $year_notyoung_cum_2018 ?></td>
                    <td><?= $year_notyoung_cum_percentage_2018 ?></td>
                    <td><?= $year_target_notyoung_2019 ?></td>
                    <td><?= $year_results_notyoung_2019 ?></td>
                    <td><?= $year_notyoung_cum_2019 ?></td>
                    <td><?= $year_notyoung_cum_percentage_2019 ?></td>
                    <td><?= $year_target_notyoung_2020 ?></td>
                    <td><?= $year_results_notyoung_2020 ?></td>
                    <td><?= $year_notyoung_cum_2020 ?></td>
                    <td><?= $year_notyoung_cum_percentage_2020 ?></td>
                    <td><?= $year_target_notyoung_2021 ?></td>
                    <td><?= $year_results_notyoung_2021 ?></td>
                    <td><?= $year_notyoung_cum_2021 ?></td>
                    <td><?= $year_notyoung_cum_percentage_2021 ?></td>
                </tr>
                <tr>
                    <td><strong>Total</strong> </td>
                    <td><strong><?= $baseline_yny_total ?></strong></td>
                    <td><strong><?= $mid_yny_total ?></strong></td>
                    <td><strong><?= $end_target_yny_total ?></strong></td>
                    <td><strong><?= $year_target_2018_total_yny ?></strong></td>
                    <td><strong><?= $year_results_2018_total_yny ?></strong></td>
                    <td><strong><?= $year_cum_2018_total_yny ?></strong></td>
                    <td><strong><?= $year_cum_percentage_2018_total_yny ?></strong></td>
                    <td><strong><?= $year_target_2019_total_yny ?></strong></td>
                    <td><strong><?= $year_results_2019_total_yny ?></strong></td>
                    <td><strong><?= $year_cum_2019_total_yny ?></strong></td>
                    <td><strong><?= $year_cum_percentage_2019_total_yny ?></strong></td>
                    <td><strong><?= $year_target_2020_total_yny ?></strong></td>
                    <td><strong><?= $year_results_2020_total_yny ?></strong></td>
                    <td><strong><?= $year_cum_2020_total_yny ?></strong></td>
                    <td><strong><?= $year_cum_percentage_2020_total_yny ?></strong></td>
                    <td><strong><?= $year_target_2021_total_yny ?></strong></td>
                    <td><strong><?= $year_results_2021_total_yny ?></strong></td>
                    <td><strong><?= $year_cum_2021_total_yny ?></strong></td>
                    <td><strong><?= $year_cum_percentage_2021_total_yny ?></strong></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
