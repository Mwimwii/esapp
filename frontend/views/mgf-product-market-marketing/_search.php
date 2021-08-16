<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfProductMarketMarketingSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mgf-product-market-marketing-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'marketing') ?>

    <?= $form->field($model, 'market_outlets') ?>

    <?= $form->field($model, 'sales_contract') ?>

    <?= $form->field($model, 'person_responsible') ?>

    <?php // echo $form->field($model, 'competition_penetration') ?>

    <?php // echo $form->field($model, 'future_prospects') ?>

    <?php // echo $form->field($model, 'branding_market_penetration') ?>

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
