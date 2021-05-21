<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\MeQuarterlyOperationsFundsRequisition */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="me-quarterly-operations-funds-requisition-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'quarter_workplan_id')->textInput() ?>

    <?= $form->field($model, 'budget_estimate_month_1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'budget_estimate_month_2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'budget_estimate_month_3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
