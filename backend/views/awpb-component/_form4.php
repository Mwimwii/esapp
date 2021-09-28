<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AwpbComponent */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="card card-success card-outline">
    <div class="card-body">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'component_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'parent_component_id')->textInput() ?>

    <?= $form->field($model, 'component_description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'component_outcome')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'component_output')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'subcomponent')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    </div>
    </div>