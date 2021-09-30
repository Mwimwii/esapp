<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfExpectedOutputsAndGrossRevenue */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mgf-expected-outputs-and-gross-revenue-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'output_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'unit_of_measure')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'quantity')->textInput() ?>

    <?= $form->field($model, 'expected_price')->textInput(['maxlength' => true]) ?>

<<<<<<< HEAD
=======
    <?= $form->field($model, 'expected_gross_revenue')->textInput(['maxlength' => true]) ?>

>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
    <?= $form->field($model, 'comment')->textInput(['maxlength' => true]) ?>

     <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
