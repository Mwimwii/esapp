<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AwpbOutputSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="awpb-output-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

<<<<<<< HEAD
=======
    <?= $form->field($model, 'code') ?>

    <?= $form->field($model, 'component_id') ?>

>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
    <?= $form->field($model, 'outcome_id') ?>

    <?= $form->field($model, 'name') ?>

<<<<<<< HEAD
    <?= $form->field($model, 'output_description') ?>

    <?= $form->field($model, 'created_at') ?>
=======
    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'created_at') ?>
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
