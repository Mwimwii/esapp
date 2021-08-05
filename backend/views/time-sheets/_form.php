<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TimeSheetsDistrictStaff */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="time-sheets-district-staff-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'rate_id')->textInput() ?>

    <?= $form->field($model, 'month')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'designation')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'activity_description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'hours_field_esapp_activities')->textInput() ?>

    <?= $form->field($model, 'hours_office_esapp_activities')->textInput() ?>

    <?= $form->field($model, 'total_hours_worked')->textInput() ?>

    <?= $form->field($model, 'contribution')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'reviewer_comments')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
