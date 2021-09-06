<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfOrganisationSearch */
/* @var $form yii\widgets\ActiveForm */
?>
    <style>
        .search{
            width: 190px;
            display: inline-block;
        }
    </style>

    <?php $form = ActiveForm::begin(['action' => ['index'],'method' => 'get',]); ?>

    <div class="search">
        <?= $form->field($model, 'cooperative') ?>
    </div>

    <div class="search">
        <?= $form->field($model, 'acronym') ?>
    </div>

    <div class="search">
        <?= $form->field($model, 'registration_type') ?>
    </div>

    <div class="search">
        <?= $form->field($model, 'registration_no') ?>
    </div>

    <div class="search">
        <?= $form->field($model, 'trade_license_no') ?>
    </div>

    <div class="search">
        <?= $form->field($model, 'email_address') ?>
    </div>

        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
    <?php ActiveForm::end(); ?>


