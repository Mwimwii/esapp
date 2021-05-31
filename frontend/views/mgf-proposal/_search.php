<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfProposalSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mgf-proposal-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'project_title') ?>

    <?= $form->field($model, 'mgf_no') ?>

    <?= $form->field($model, 'organisation_id') ?>

    <?= $form->field($model, 'proposal_status') ?>

    <?php // echo $form->field($model, 'applicant_type') ?>

    <?php // echo $form->field($model, 'date_created') ?>

    <?php // echo $form->field($model, 'date_submitted') ?>

    <?php // echo $form->field($model, 'project_background') ?>

    <?php // echo $form->field($model, 'problem_statement') ?>

    <?php // echo $form->field($model, 'overall_objective') ?>

    <?php // echo $form->field($model, 'summary_description') ?>

    <?php // echo $form->field($model, 'is_active') ?>

    <?php // echo $form->field($model, 'province_id') ?>

    <?php // echo $form->field($model, 'district_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
