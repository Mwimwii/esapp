<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfProjectEvaluationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mgf-project-evaluation-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'proposal_id') ?>

    <?= $form->field($model, 'organisation_id') ?>

    <?= $form->field($model, 'window') ?>

    <?= $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'observation') ?>

    <?php // echo $form->field($model, 'declaration') ?>

    <?php // echo $form->field($model, 'totalscore') ?>

    <?php // echo $form->field($model, 'decision') ?>

    <?php // echo $form->field($model, 'date_created') ?>

    <?php // echo $form->field($model, 'date_submitted') ?>

    <?php // echo $form->field($model, 'date_reviewed') ?>

    <?php // echo $form->field($model, 'reviewedby') ?>

    <?php // echo $form->field($model, 'signature') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
