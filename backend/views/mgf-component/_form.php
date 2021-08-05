<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfComponent */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="mgf-component-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'component_no')->textInput() ?>

    <?= $form->field($model, 'component_name')->textInput() ?>

    <?= $form->field($model, 'proposal_id')->textInput() ?>

    <?= $form->field($model, 'date_created')->textInput() ?>

    <?= $form->field($model, 'createdby')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
