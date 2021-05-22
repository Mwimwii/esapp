<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MeQuarterlyWorkPlanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Quarterly Work schedules';
$this->params['breadcrumbs'][] = $this->title;
$quarter = \backend\models\MeFaabsTrainingAttendanceSheet::getQuarter(date('n'));

$previous = "";
if ($quarter == 2) {
    $previous = "1";
}
if ($quarter == 3) {
    $previous = "1,2";
}
if ($quarter == 4) {
    $previous = "1,2,3";
}

//We make sure that activities we are dealing with have not been submitted already
//and approved
$planned_activities = \backend\models\MeQuarterlyWorkPlan::find()
        ->where(["month" => date('n')])
        ->andWhere(['year' => date('Y')])
        ->andWhere(['status' => 1])
        ->all();

?>
<div class="card card-success card-outline">
    <div class="card-body">
        <h5>Instructions</h5>
        <ol>
            <li>
                You can only submit quarterly work schedule for activities that were planned and approved to be undertaken in quarter <?= $quarter ?> during AWPB
            </li>
            <?php if (!empty($previous)) { ?>
                <li>You can view the approved quarterly work schedules for the previous quarters (<code><?= $previous ?></code>) doing a filter below
                </li>
            <?php } ?>
        </ol>
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'id',
                'activity_id',
                'province_id',
                'district_id',
                'month',
                //'quarter',
                //'year',
                //'status',
                //'district_approval_status',
                //'provincial_approval_status',
                //'Remarks:ntext',
                //'esapp_comments:ntext',
                //'created_at',
                //'updated_at',
                //'created_by',
                //'updated_by',
                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]);
        ?>


    </div>
</div>
