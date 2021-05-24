<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CommodityPriceCollectionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="commodity-price-collection-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'district') ?>

    <?= $form->field($model, 'market_id') ?>

    <?= $form->field($model, 'commodity_type_id') ?>

    <?= $form->field($model, 'price_level_id') ?>

    <?php // echo $form->field($model, 'unit_of_measure') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
