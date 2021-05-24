<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfOrganisationalDetailSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mgf-organisational-details-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'mgt_Staff') ?>

    <?= $form->field($model, 'senior_Staff') ?>

    <?= $form->field($model, 'junior_Staff') ?>

    <?= $form->field($model, 'others') ?>

    <?php // echo $form->field($model, 'last_board') ?>

    <?php // echo $form->field($model, 'last_agm') ?>

    <?php // echo $form->field($model, 'last_audit') ?>

    <?php // echo $form->field($model, 'has_finance') ?>

    <?php // echo $form->field($model, 'has_resources') ?>

    <?php // echo $form->field($model, 'organisation_id') ?>

    <?php // echo $form->field($model, 'date_created') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
