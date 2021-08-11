<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfFinalEvaluationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mgf-final-evaluation-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'proposal_id') ?>

    <?= $form->field($model, 'organisation_id') ?>

    <?= $form->field($model, 'status') ?>

    <?= $form->field($model, 'finalscore') ?>

    <?php // echo $form->field($model, 'decision') ?>

    <?php // echo $form->field($model, 'date_created') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
