<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfScreening */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="mgf-screening-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'conceptnote_id')->textInput() ?>

    <?= $form->field($model, 'organisation_id')->textInput() ?>

    <?= $form->field($model, 'criterion')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'satisfactory')->textInput() ?>

    <?= $form->field($model, 'approve_submittion')->textInput() ?>

    <?= $form->field($model, 'verified_by')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::a('<i class="glyphicon glyphicon-backward"></i>Back', ['index'], ['class' => 'btn btn-default']);?>
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
