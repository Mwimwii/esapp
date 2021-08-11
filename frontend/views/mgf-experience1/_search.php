<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfExperienceSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mgf-experience-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'financed_before') ?>

    <?= $form->field($model, 'project_name') ?>

    <?= $form->field($model, 'years_assisted') ?>

    <?= $form->field($model, 'amount_assisted') ?>

    <?php // echo $form->field($model, 'obligations_met') ?>

    <?php // echo $form->field($model, 'outcome_response') ?>

    <?php // echo $form->field($model, 'any_collaboration') ?>

    <?php // echo $form->field($model, 'collaboration_response') ?>

    <?php // echo $form->field($model, 'collaboration_will') ?>

    <?php // echo $form->field($model, 'willing_response') ?>

    <?php // echo $form->field($model, 'organisation_id') ?>

    <?php // echo $form->field($model, 'date_created') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
