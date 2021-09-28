<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfImplementationScheduleShort */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mgf-implementation-schedule-short-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'activity')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'implementation_year')->textInput() ?>

    <?= $form->field($model, 'qtr1')->textInput() ?>

    <?= $form->field($model, 'qtr2')->textInput() ?>

    <?= $form->field($model, 'qtr3')->textInput() ?>

    <?= $form->field($model, 'qtr4')->textInput() ?>

    <?= $form->field($model, 'proposal_id')->textInput() ?>

    <?= $form->field($model, 'date_created')->textInput() ?>

    <?= $form->field($model, 'date_update')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
