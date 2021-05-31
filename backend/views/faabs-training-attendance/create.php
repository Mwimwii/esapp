<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MeFaabsTrainingAttendanceSheet */

$this->title = 'Add FaaBS training attendance record';
$this->params['breadcrumbs'][] = ['label' => 'FaaBS Training Attendance records', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card card-success card-outline">
    <div class="card-body">
        <div class="col-lg-12">
            <ol>
                <li>The system automatically picks the farmers province,district and camp</li>
                <li>You can only save topics which the farmer has not yet be trained on and not yet saved in the system</li>
                <li>To pick a topic, select FaaBS and a farmer then the system will display topics which the farmer has not yet been trained on</li>
                <li>If you cannot see any topics, it means the farmer has been trained on all the topics assigned to the FaaBs</li>

                <li>The system will only allow you to enter records that you have not yet submitted</li>

                <li>The system will redirect you to this page after you click <span class="badge badge-success">Save record</span> so that you can add another record</li>
                <li>Fields marked with <span class="text-red">*</span> are required</li>
            </ol>
        </div>
        <hr class="dotted short">
        <?=
        $this->render('_form', [
            'model' => $model,
        ])
        ?>

    </div>
</div>
