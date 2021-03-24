<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\MeCampSubprojectRecordsMonthlyPlannedActivitiesActualSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="me-camp-subproject-records-monthly-planned-activities-actual-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'planned_activity_id') ?>

    <?= $form->field($model, 'hours_worked_field') ?>

    <?= $form->field($model, 'hours_worked_office') ?>

    <?= $form->field($model, 'hours_worked_total') ?>

    <?php // echo $form->field($model, 'achieved_activity_target') ?>

    <?php // echo $form->field($model, 'beneficiary_target_achieved_total') ?>

    <?php // echo $form->field($model, 'beneficiary_target_achieved_women') ?>

    <?php // echo $form->field($model, 'beneficiary_target_achieved_youth') ?>

    <?php // echo $form->field($model, 'beneficiary_target_achieved_women_headed') ?>

    <?php // echo $form->field($model, 'remarks') ?>

    <?php // echo $form->field($model, 'year') ?>

    <?php // echo $form->field($model, 'month') ?>

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
