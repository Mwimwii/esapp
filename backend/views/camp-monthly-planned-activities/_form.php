<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\MeCampSubprojectRecordsMonthlyPlannedActivities */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="me-camp-subproject-records-monthly-planned-activities-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'camp_id')->textInput() ?>

    <?= $form->field($model, 'activity_id')->textInput() ?>

    <?= $form->field($model, 'faabs_id')->textInput() ?>

    <?= $form->field($model, 'month')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'year')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'zone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'activity_target')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'beneficiary_target_total')->textInput() ?>

    <?= $form->field($model, 'beneficiary_target_women')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'beneficiary_target_youth')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'beneficiary_target_women_headed')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
