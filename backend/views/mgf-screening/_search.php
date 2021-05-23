<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfScreeningSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mgf-screening-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'conceptnote_id') ?>

    <?= $form->field($model, 'organisation_id') ?>

    <?= $form->field($model, 'criterion') ?>

    <?= $form->field($model, 'satisfactory') ?>

    <?php // echo $form->field($model, 'approve_submittion') ?>

    <?php // echo $form->field($model, 'verified_by') ?>

    <?php // echo $form->field($model, 'province_id') ?>

    <?php // echo $form->field($model, 'district_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
