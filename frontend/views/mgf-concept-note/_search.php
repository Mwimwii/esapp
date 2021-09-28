<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfConceptNoteSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mgf-concept-note-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'project_title') ?>

    <?= $form->field($model, 'estimated_cost') ?>

    <?= $form->field($model, 'starting_date') ?>

    <?= $form->field($model, 'operation_id') ?>

    <?php // echo $form->field($model, 'implimentation_period') ?>

    <?php // echo $form->field($model, 'other_operation_type') ?>

    <?php // echo $form->field($model, 'application_id') ?>

    <?php // echo $form->field($model, 'organisation_id') ?>

    <?php // echo $form->field($model, 'date_created') ?>

    <?php // echo $form->field($model, 'date_submitted') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
