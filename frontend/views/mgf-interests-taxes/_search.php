<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfInterestsTaxesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mgf-interests-taxes-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'interest_tax_type') ?>

    <?= $form->field($model, 'interest_tax_percent') ?>

    <?= $form->field($model, 'interest_tax_name') ?>

    <?= $form->field($model, 'interest_yr1_value') ?>

    <?php // echo $form->field($model, 'interest_yr2_value') ?>

    <?php // echo $form->field($model, 'interest_yr3_value') ?>

    <?php // echo $form->field($model, 'interest_yr4_value') ?>

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
