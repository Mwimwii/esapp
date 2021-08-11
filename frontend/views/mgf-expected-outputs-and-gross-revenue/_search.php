<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfExpectedOutputsAndGrossRevenueSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mgf-expected-outputs-and-gross-revenue-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'output_name') ?>

    <?= $form->field($model, 'unit_of_measure') ?>

    <?= $form->field($model, 'quantity') ?>

    <?= $form->field($model, 'expected_price') ?>

    <?php // echo $form->field($model, 'expected_gross_revenue') ?>

    <?php // echo $form->field($model, 'comment') ?>

    <?php // echo $form->field($model, 'proposal_id') ?>

    <?php // echo $form->field($model, 'date_created') ?>

    <?php // echo $form->field($model, 'date_update') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
