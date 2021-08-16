<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AwpbTemplate */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="awpb-template-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fiscal_year')->textInput() ?>

    <?= $form->field($model, 'budget_theme')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'guideline_file')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>



    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
