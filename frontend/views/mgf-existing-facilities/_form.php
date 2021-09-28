<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MgfExistingFacilities */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mgf-existing-facilities-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'facility_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'quantity')->textInput() ?>

    <?= $form->field($model, 'use_to_be_made')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'estimate_cost')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'comment')->textInput(['maxlength' => true]) ?>

    
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
