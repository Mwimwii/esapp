<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfValueOfProductSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mgf-value-of-product-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'product_name') ?>

    <?= $form->field($model, 'product_unit') ?>

    <?= $form->field($model, 'product_yr1_qty') ?>

    <?= $form->field($model, 'product_yr1_price') ?>

    <?php // echo $form->field($model, 'product_yr1_value') ?>

    <?php // echo $form->field($model, 'product_yr2_qty') ?>

    <?php // echo $form->field($model, 'product_yr2_price') ?>

    <?php // echo $form->field($model, 'product_yr2_value') ?>

    <?php // echo $form->field($model, 'product_yr3_qty') ?>

    <?php // echo $form->field($model, 'product_yr3_price') ?>

    <?php // echo $form->field($model, 'product_yr3_value') ?>

    <?php // echo $form->field($model, 'product_yr4_qty') ?>

    <?php // echo $form->field($model, 'product_yr4_price') ?>

    <?php // echo $form->field($model, 'product_yr4_value') ?>

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
