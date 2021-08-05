<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\BackToOfficeAnnexes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="back-to-office-annexes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'btor_id')->textInput() ?>

    <?= $form->field($model, 'file')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->dropDownList([ 'Image' => 'Image', 'Video' => 'Video', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
