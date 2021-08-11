<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfNetprofit */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mgf-netprofit-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'netprofit_yr1_value')->textInput() ?>

    <?= $form->field($model, 'netprofit_yr2_value')->textInput() ?>

    <?= $form->field($model, 'netprofit_yr3_value')->textInput() ?>

    <?= $form->field($model, 'netprofit_yr4_value')->textInput() ?>

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
