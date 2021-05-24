<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AwpbTemplateActivitySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="awpb-template-activity-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'activity_id') ?>

    <?= $form->field($model, 'component_id') ?>

    <?= $form->field($model, 'outcome_id') ?>

    <?= $form->field($model, 'output_id') ?>

    <?php // echo $form->field($model, 'awpb_template_id') ?>

    <?php // echo $form->field($model, 'funder_id') ?>

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
