<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfImplementationScheduleSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mgf-implementation-schedule-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'activity_id') ?>

    <?= $form->field($model, 'yr1qtr1') ?>

    <?= $form->field($model, 'yr1qtr2') ?>

    <?= $form->field($model, 'yr1qtr3') ?>

    <?php // echo $form->field($model, 'yr1qtr4') ?>

    <?php // echo $form->field($model, 'yr2qtr1') ?>

    <?php // echo $form->field($model, 'yr2qtr2') ?>

    <?php // echo $form->field($model, 'yr2qtr3') ?>

    <?php // echo $form->field($model, 'yr2qtr4') ?>

    <?php // echo $form->field($model, 'yr3qtr1') ?>

    <?php // echo $form->field($model, 'yr3qtr2') ?>

    <?php // echo $form->field($model, 'yr3qtr3') ?>

    <?php // echo $form->field($model, 'yr3qtr4') ?>

    <?php // echo $form->field($model, 'yr4qtr1') ?>

    <?php // echo $form->field($model, 'yr4qtr2') ?>

    <?php // echo $form->field($model, 'yr4qtr3') ?>

    <?php // echo $form->field($model, 'yr4qtr4') ?>

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
