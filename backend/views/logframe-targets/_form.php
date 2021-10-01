<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\LogframeProgrammeTargets */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="logframe-programme-targets-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'baseline')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mid_term')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'end_target')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'record_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'indicator')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
