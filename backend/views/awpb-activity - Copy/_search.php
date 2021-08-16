<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AwbpActivitySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="awpb-activity-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'activity_code') ?>

    <?= $form->field($model, 'parent_activity_id') ?>

    <?= $form->field($model, 'component_id') ?>

    <?= $form->field($model, 'awpb_template_id') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'unit_of_measure_id') ?>

    <?php // echo $form->field($model, 'quarter_one_budget') ?>

    <?php // echo $form->field($model, 'quarter_two_budget') ?>

    <?php // echo $form->field($model, 'quarter_three_budget') ?>

    <?php // echo $form->field($model, 'quarter_four_budget') ?>

    <?php // echo $form->field($model, 'total_budget') ?>

    <?php // echo $form->field($model, 'expense_category_id') ?>

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
