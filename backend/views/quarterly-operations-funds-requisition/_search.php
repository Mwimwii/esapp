<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\MeQuarterlyOperationsFundsRequisitionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="me-quarterly-operations-funds-requisition-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'quarter_workplan_id') ?>

    <?= $form->field($model, 'budget_estimate_month_1') ?>

    <?= $form->field($model, 'budget_estimate_month_2') ?>

    <?= $form->field($model, 'budget_estimate_month_3') ?>

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
