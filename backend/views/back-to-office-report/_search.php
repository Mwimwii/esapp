<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\MeBackToOfficeReportSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="me-back-to-office-report-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'start_date') ?>

    <?= $form->field($model, 'end_date') ?>

    <?= $form->field($model, 'name_of_officer') ?>

    <?= $form->field($model, 'team_members') ?>

    <?php // echo $form->field($model, 'key_partners') ?>

    <?php // echo $form->field($model, 'purpose_of_assignment') ?>

    <?php // echo $form->field($model, 'summary_of_assignment_outcomes') ?>

    <?php // echo $form->field($model, 'key_findings') ?>

    <?php // echo $form->field($model, 'key_recommendations') ?>

    <?php // echo $form->field($model, 'copy_sent_to') ?>

    <?php // echo $form->field($model, 'annexes') ?>

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
