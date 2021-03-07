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
