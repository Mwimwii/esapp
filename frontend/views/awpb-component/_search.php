<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AwpbComponentSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="awpb-component-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'component_code') ?>

    <?= $form->field($model, 'parent_component_id') ?>

    <?= $form->field($model, 'component_description') ?>

    <?= $form->field($model, 'component_outcome') ?>

    <?php // echo $form->field($model, 'component_output') ?>

    <?php // echo $form->field($model, 'subcomponent') ?>

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
