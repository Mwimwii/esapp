<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\MeQuarterlyWorkPlanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="me-quarterly-work-plan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'activity_id') ?>

    <?= $form->field($model, 'province_id') ?>

    <?= $form->field($model, 'district_id') ?>

    <?= $form->field($model, 'month') ?>

    <?php // echo $form->field($model, 'quarter') ?>

    <?php // echo $form->field($model, 'year') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'district_approval_status') ?>

    <?php // echo $form->field($model, 'provincial_approval_status') ?>

    <?php // echo $form->field($model, 'Remarks') ?>

    <?php // echo $form->field($model, 'esapp_comments') ?>

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
