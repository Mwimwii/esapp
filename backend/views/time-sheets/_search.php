<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TimeSheetsDistrictStaffSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="time-sheets-district-staff-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'rate_id') ?>

    <?= $form->field($model, 'month') ?>

    <?= $form->field($model, 'designation') ?>

    <?= $form->field($model, 'activity_description') ?>

    <?php // echo $form->field($model, 'hours_field_esapp_activities') ?>

    <?php // echo $form->field($model, 'hours_office_esapp_activities') ?>

    <?php // echo $form->field($model, 'total_hours_worked') ?>

    <?php // echo $form->field($model, 'contribution') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'reviewer_comments') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
