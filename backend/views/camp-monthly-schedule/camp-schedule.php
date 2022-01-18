<?php

use yii\helpers\Html;

$model_activities = \backend\models\MeCampSubprojectRecordsMonthlyPlannedActivities::find()
                ->where(['work_effort_id' => $model->id])->all();

$actual_array = [];
if (!empty($model_activities)) {
    foreach ($model_activities as $Model) {
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

$camp = !empty($model->camp) ? $model->camp->name : "";
$district = !empty($model->camp) ? $model->camp->district->name : "";
$province = !empty($model->camp) ? $model->camp->district->province->name : "";
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
    <p style="">
        <span style="font-size: 11px;"> Province: </span>
        <span style="font-size:1em;">
            <span style="font-size: 11px;border-bottom: 2px dotted;width: 100%;display: block !important;">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                <?= Html::encode($province) ?> 
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;

            </span>
        </span>
        &nbsp;&nbsp;&nbsp;
        <span style="font-size: 11px;">District:</span>
        <span style="font-size:1em;">
            <span style="font-size: 11px;border-bottom: 2px dotted;width: 100%;display: block !important;">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                <?= Html::encode($province) ?> 
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;

            </span>
        </span>
        &nbsp;&nbsp;&nbsp;
        <span style="font-size: 11px;">Camp:</span>
        <span style="font-size:1em;">
            <span style="font-size: 11px;border-bottom: 2px dotted;width: 100%;display: block !important;">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                <?= Html::encode($province) ?> 
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;

            </span>
        </span>
        &nbsp;&nbsp;&nbsp;
        <span style="font-size: 11px;">Date:</span>
        <span style="font-size:1em;">
            <span style="font-size: 11px;border-bottom: 2px dotted;width: 100%;display: block !important;">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                <?= Date("d F, Y") ?> 
                &nbsp;&nbsp;&nbsp;

            </span>
        </span>
    </p>
    <p></p>


    <p style="font-size: 11px;">
        <span style="font-weight: normal;">Designation/Title of Camp Extension Officer:</span>
        <span style="font-size: 11px;border-bottom: 2px dotted;width: 100%;display: block !important;">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <?php
            $desig = !empty($model->rate) ? $model->rate->designation . "/" : "";
            echo Html::encode($desig . $user->getFullName());
            ?> 
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </span>
    </p>

    <p></p>
    <p class="text-center">
        PLANNING FOR <?= DateTime::createFromFormat('!m', $model->month)->format('F') . "/" . $model->year ?> ACTIVITIES
    </p>
    <p></p>
    <p >
        1. Planned work effort (Days)
    <table class="table table-bordered table-sm">
        <tr>
            <th colspan="1" class="" style="font-size: 11px;font-weight: normal;">Number of calender days this month</th> 
            <th colspan="1" class="text-center text-black-50" style="font-size: 11px;font-weight: normal;"><?= $model->days_in_month ?> Days</th> 
        </tr>
        <tr>
            <th colspan="1" class="" style="font-size: 11px;font-weight: normal;">Number of Days in the Field</th> 
            <th colspan="1" class="text-center text-black-50" style="font-size: 11px;font-weight: normal;"><?= $model->days_field ?> Days</th> 
        </tr>
        <tr>
            <th colspan="1" class="" style="font-size: 11px;font-weight: normal;">Number of Days in the office</th> 
            <th colspan="1" class="text-center text-black-50" style="font-size: 11px;font-weight: normal;"><?= $model->days_office ?> Days</th> 
        </tr>
        <tr>
            <th colspan="1" class="" style="font-size: 11px;font-weight: normal;">Total Number of Days (Field + Office)</th> 
            <th colspan="1" class="text-center text-black-50" style="font-size: 11px;font-weight: normal;"><?php echo $model->days_office + $model->days_field ?> Days</th> 
        </tr>
        <tr>
            <th colspan="1" class="" style="font-size: 11px;font-weight: normal;">Number of Days for other activities (non- E-SAPP activities)</th> 
            <th colspan="1" class="text-center text-black-50" style="font-size: 11px;font-weight: normal;"><?= $model->days_other_non_esapp_activities ?> Days</th> 
        </tr>
    </table>
</p>
<p>
    2. Planned Activities
<table class="table table-bordered table table-sm">
    <tr> 
        <th colspan="2" class="text-center" style="font-size: 11px;"><?= DateTime::createFromFormat('!m', $model->month)->format('F') ?> Planned Activity</th> 
        <th colspan="1" class="text-center text-black-50" style="font-size: 11px;">FaaBS</th> 
        <th  colspan="4" class="text-center text-black-50" style="font-size: 11px;"><?= DateTime::createFromFormat('!m', $model->month)->format('F') ?> Beneficiary Target</th> 
    </tr>
    <tr>
        <td style="font-size: 11px;">Activity</td>
        <td style="font-size: 11px;">Activity Target</td>
        <td style="font-size: 11px;">FaaBS</td>
        <td style="font-size: 11px;">Target Women</td>
        <td style="font-size: 11px;">Target Youth</td>
        <td style="font-size: 11px;">Target Women Headed</td>
        <td style="font-size: 11px;">Target Total</td>
    </tr>
    <?php
    if (!empty($model_activities)) {
        foreach ($model_activities as $p_activities) {
            ?>
            <tr>
                <td style="font-size: 11px;">
                    <?php
                    $activit_model = backend\models\AwpbActivity::findOne($p_activities['activity_id']);
                    echo!empty($activit_model) ? $activit_model->name : "";
                    ?>
                </td>
                <td style="font-size: 11px;"><?= $p_activities['activity_target'] ?></td>
                <td style="font-size: 11px;">
                    <?php
                    $faabs_model = backend\models\MeFaabsGroups::findOne($p_activities['faabs_id']);
                    echo!empty($faabs_model) ? $faabs_model->name : "";
                    ?>
                </td>
                <td style="font-size: 11px;"><?= $p_activities['beneficiary_target_women'] ?></td>
                <td style="font-size: 11px;"><?= $p_activities['beneficiary_target_youth'] ?></td>
                <td style="font-size: 11px;"><?= $p_activities['beneficiary_target_women_headed'] ?></td>
                <td style="font-size: 11px;"><?= $p_activities['beneficiary_target_total'] ?></td>
            </tr>
            <?php
        }
    }
    ?>
</table>
</p>
<p>
    3. Actual/Achieved For  <?= DateTime::createFromFormat('!m', $model->month)->format('F') ?>
<table class="table table-bordered table table-sm">
    <tr> 
        <th colspan="2" class="text-center" style="font-size: 11px;">
            <?= DateTime::createFromFormat('!m', $model->month)->format('F') ?> Achieved target
        </th> 
        <th colspan="1" class="text-center text-black-50" style="font-size: 11px;">FaaBS</th> 
        <th colspan="3" class="text-center text-black-50" style="font-size: 11px;">Hours Worked</th> 
        <th  colspan="4" class="text-center text-black-50" style="font-size: 11px;"><?= DateTime::createFromFormat('!m', $model->month)->format('F') ?> Beneficiary Target</th> 
        <th colspan="1" class="text-center text-black-50" style="font-size: 11px;">Remarks</th> 
    </tr>
    <tr>
        <td style="font-size: 11px;">Activity</td>
        <td style="font-size: 11px;">Activity Target</td>
        <td style="font-size: 11px;">FaaBS</td>
        <td style="font-size: 11px;">Field</td>
        <td style="font-size: 11px;">Office</td>
        <td style="font-size: 11px;">Total</td>
        <td style="font-size: 11px;">Women</td>
        <td style="font-size: 11px;">Youth</td>
        <td style="font-size: 11px;">Women Headed</td>
        <td style="font-size: 11px;">Total</td>
        <td style="font-size: 11px;"></td>
    </tr>
    <?php
    if (!empty($activity_actuals)) {
        foreach ($activity_actuals as $a_activities) {
            ?>
            <tr>
                <td style="font-size: 11px;">
                    <?php
                    $Model = backend\models\MeCampSubprojectRecordsMonthlyPlannedActivities::findOne($a_activities['planned_activity_id']);
                    $activit_model = !empty($Model) ? backend\models\AwpbActivity::findOne($Model->activity_id) : "";

                    echo!empty($activit_model) ? $activit_model->name : "";
                    ?>
                </td>
                <td style="font-size: 11px;"><?= $a_activities['achieved_activity_target'] ?></td>
                <td style="font-size: 11px;">
                    <?php
                    $planned_model = backend\models\MeCampSubprojectRecordsMonthlyPlannedActivities::findOne($a_activities['planned_activity_id']);
                    $faabs_model = !empty($planned_model) ? backend\models\MeFaabsGroups::findOne($planned_model->faabs_id) : "";

                    echo!empty($faabs_model) ? $faabs_model->name : "";
                    ?>
                </td>
                <td style="font-size: 11px;"><?= $a_activities['hours_worked_field'] ?></td>
                <td style="font-size: 11px;"><?= $a_activities['hours_worked_office'] ?></td>
                <td style="font-size: 11px;"><?= $a_activities['hours_worked_total'] ?></td>
                <td style="font-size: 11px;"><?= $a_activities['beneficiary_target_achieved_women'] ?></td>
                <td style="font-size: 11px;"><?= $a_activities['beneficiary_target_achieved_youth'] ?></td>
                <td style="font-size: 11px;"><?= $a_activities['beneficiary_target_achieved_women_headed'] ?></td>
                <td style="font-size: 11px;"><?= $a_activities['beneficiary_target_achieved_total'] ?></td>
                <td style="font-size: 11px;"><?= $a_activities['remarks'] ?></td>
            </tr>
            <?php
        }
    }
    ?>
</table>
</p>
<p>
    4. Actual work effort-Time Sheet
</p>
<p style="font-size: 11px;"><span style="font-weight: normal;">Start Date:</span>
    <span style="font-size: 11px;border-bottom: 2px dotted;width: 100%;display: block !important;">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <?php //Html::encode($user->getFullName()) ?> 
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </span>
</p>
<p style="font-size: 11px;"><span style="font-weight: normal;">End Date:</span>
    <span style="font-size: 11px;border-bottom: 2px dotted;width: 100%;display: block !important;">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <?php //Html::encode($user->getFullName()) ?> 
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </span>
</p>
<p style="font-size: 11px;"><span style="font-weight: normal;">Duration (Calendar Days):</span> 
    <span style="font-size: 11px;border-bottom: 2px dotted;width: 100%;display: block !important;">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <?= Html::encode($daysTotal . " Days") ?> 
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </span>
</p>
<table class="table table-bordered table table-sm">
    <tr>
        <th colspan="1"></th> 
        <th colspan="1" class="text-center" style="font-size: 11px;">Designation/Title</th> 
        <th colspan="1" class="text-center text-black-50" style="font-size: 11px;">Total Hours Worked</th> 
        <th  colspan="1" class="text-center text-black-50" style="font-size: 11px;">Rate ZMW/Hour</th> 
        <th  colspan="1" class="text-center text-black-50" style="font-size: 11px;">Contribution(ZMW)</th> 
    </tr>
    <tr>
        <td style="font-size: 11px;">Work Effort/Designation or Title of Officer</td>
        <td style="font-size: 11px;"><?php echo!empty($model->rate) ? $model->rate->designation : "Not Set" ?></td>
        <td ></td>
        <td ></td>
        <td ></td>
    </tr>
    <tr>
        <td style="font-size: 11px;">Number of hours spent in the Field on E-SAPP activities</td>
        <td >-</td>
        <td style="font-size: 11px;"><?= $totalHoursField ?></td>
        <td style="font-size: 11px;"><?php echo!empty($model->rate) ? $model->rate->rate : 0 ?></td>
        <td style="font-size: 11px;"><?php echo!empty($model->rate) ? $model->rate->rate * $totalHoursField : 0 ?></td>
    </tr>
    <tr>
        <td style="font-size: 11px;">Number of hours spent in the office on E-SAPP activities</td>
        <td >-</td>
        <td style="font-size: 11px;"><?= $totalHoursOffice ?></td>
        <td style="font-size: 11px;"><?php echo!empty($model->rate) ? $model->rate->rate : 0 ?></td>
        <td style="font-size: 11px;"><?php echo!empty($model->rate) ? $model->rate->rate * $totalHoursOffice : 0 ?></td>
    </tr>
    <tr>
        <td class="text-bold text-right" style="font-size: 11px;font-weight: bold;">Total</td>
        <td style="font-size: 11px;font-weight: bold;">-</td>
        <td style="font-size: 11px;font-weight: bold;"><?= $totalHours ?></td>
        <td style="font-size: 11px;font-weight: bold;"><?php echo!empty($model->rate) ? $model->rate->rate : 0 ?></td>
        <td style="font-size: 11px;font-weight: bold;"><?php echo!empty($model->rate) ? $model->rate->rate * $totalHours : 0 ?></td>

    </tr>
</table>
</div>


