<?php

use yii\helpers\Html;

$model_activities = \backend\models\MeCampSubprojectRecordsMonthlyPlannedActivities::find()
        ->where(['work_effort_id' => $model->id]);

$actual_array = [];
if (!empty($model_activities->all())) {
    foreach ($model_activities->all() as $Model) {
        array_push($actual_array, $Model['id']);
    }
}

$activity_actuals = \backend\models\MeCampSubprojectRecordsMonthlyPlannedActivitiesActual::find()
                ->where(['IN', 'planned_activity_id', $actual_array])->all();

//Get totals
$totalHoursField = 0;
$totalHoursOffice = 0;
$totalHours = 0;
foreach ($activity_actuals as $mo) {
    $totalHoursField += $mo['hours_worked_field'];
    $totalHoursOffice += $mo['hours_worked_office'];
}
$totalHours += $totalHoursField;
$totalHours += $totalHoursOffice;

$daysTotal = $model->days_office + $model->days_field;
?>

<div class="container ">
    <div class="row">
        <div class="text-left">
            <?= Html::img('@web/img/coa.png', ['style' => 'width:100px; height: 100px']); ?>
        </div>
        <div style="margin-top: -100px;" class="text-right">
            <?= Html::img('@web/img/ifad.png', ['style' => 'width:100px; height: 100px']); ?>
        </div>
    </div>
    <div class="text-center" style="margin-top: 20px;margin-bottom: 60px;margin-top: -100px;font-weight: bold;">
        <p>
            Ministry of Agriculture<br>
            Enhanced Smallholder Agribusiness Promotion Programme<br>
            <?= DateTime::createFromFormat('!m', $model->month)->format('F') . "/" . $model->year ?> Actual work effort Time Sheet
        </p>
    </div>
    <p style="font-size: 11px;"><span style="font-weight: bold;">Designation/Title of Camp Extension Officer:</span> <?= $user->getFullName() ?></p>
    <p style="font-size: 11px;"><span style="font-weight: bold;">Start Date:</span></p>
    <p style="font-size: 11px;"><span style="font-weight: bold;">End Date:</span> </p>
    <p style="font-size: 11px;"><span style="font-weight: bold;">Duration (Calendar Days):</span> <?= $daysTotal ?> Days</p>

    <table class="table table-bordered table table-sm">
        <tr>
            <th colspan="1"></th> 
            <th colspan="1" class="text-center" style="font-size: 12px;">Designation/Title</th> 
            <th colspan="1" class="text-center text-black-50" style="font-size: 12px;">Total Hours Worked</th> 
            <th  colspan="1" class="text-center text-black-50" style="font-size: 12px;">Rate ZMW/Hour</th> 
            <th  colspan="1" class="text-center text-black-50" style="font-size: 12px;">Contribution(ZMW)</th> 
        </tr>
        <tr>
            <td style="font-size: 12px;">Work Effort/Designation or Title of Officer</td>
            <td style="font-size: 12px;"><?php echo!empty($model->rate) ? $model->rate->designation : "Not Set" ?></td>
            <td ></td>
            <td ></td>
            <td ></td>
        </tr>
        <tr>
            <td style="font-size: 12px;">Number of hours spent in the Field on E-SAPP activities</td>
            <td >-</td>
            <td style="font-size: 12px;"><?= $totalHoursField ?></td>
            <td style="font-size: 12px;"><?php echo!empty($model->rate) ? $model->rate->rate : 0 ?></td>
            <td style="font-size: 12px;"><?php echo!empty($model->rate) ? $model->rate->rate * $totalHoursField : 0 ?></td>
        </tr>
        <tr>
            <td style="font-size: 12px;">Number of hours spent in the office on E-SAPP activities</td>
            <td >-</td>
            <td style="font-size: 12px;"><?= $totalHoursOffice ?></td>
            <td style="font-size: 12px;"><?php echo!empty($model->rate) ? $model->rate->rate : 0 ?></td>
            <td style="font-size: 12px;"><?php echo!empty($model->rate) ? $model->rate->rate * $totalHoursOffice : 0 ?></td>
        </tr>
        <tr>
            <td class="text-bold text-right" style="font-size: 12px;font-weight: bold;">Total</td>
            <td style="font-size: 12px;font-weight: bold;">-</td>
            <td style="font-size: 12px;font-weight: bold;"><?= $totalHours ?></td>
            <td style="font-size: 12px;font-weight: bold;"><?php echo!empty($model->rate) ? $model->rate->rate : 0 ?></td>
            <td style="font-size: 12px;font-weight: bold;"><?php echo!empty($model->rate) ? $model->rate->rate * $totalHours : 0 ?></td>

        </tr>
    </table>
</div>


