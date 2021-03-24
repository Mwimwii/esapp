<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\MeCampSubprojectRecordsMonthlyPlannedActivitiesActual */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="me-camp-subproject-records-monthly-planned-activities-actual-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'planned_activity_id')->textInput() ?>

    <?= $form->field($model, 'hours_worked_field')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hours_worked_office')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hours_worked_total')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'achieved_activity_target')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'beneficiary_target_achieved_total')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'beneficiary_target_achieved_women')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'beneficiary_target_achieved_youth')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'beneficiary_target_achieved_women_headed')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'remarks')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'year')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'month')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
