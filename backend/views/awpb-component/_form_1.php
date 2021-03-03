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

    

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'outcome')->textarea(['rows' => 3]) ?>

    <?= $form->field($model, 'output')->textarea(['rows' => 3]) ?>

    

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    </div>
    </div>