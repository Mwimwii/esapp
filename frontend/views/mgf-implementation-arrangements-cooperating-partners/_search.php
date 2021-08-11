<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfImplementationArrangementsCooperatingPartnersSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mgf-implementation-arrangements-cooperating-partners-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'main_activities') ?>

    <?= $form->field($model, 'respobility') ?>

    <?= $form->field($model, 'experience') ?>

    <?= $form->field($model, 'comment') ?>

    <?php // echo $form->field($model, 'typee') ?>

    <?php // echo $form->field($model, 'proposal_id') ?>

    <?php // echo $form->field($model, 'date_created') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
