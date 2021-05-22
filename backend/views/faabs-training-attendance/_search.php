<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\MeFaabsTrainingAttendanceSheetSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="me-faabs-training-attendance-sheet-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'faabs_group_id') ?>

    <?= $form->field($model, 'farmer_id') ?>

    <?= $form->field($model, 'household_head_type') ?>

    <?= $form->field($model, 'topic') ?>

    <?php // echo $form->field($model, 'facilitators') ?>

    <?php // echo $form->field($model, 'partner_organisations') ?>

    <?php // echo $form->field($model, 'training_date') ?>

    <?php // echo $form->field($model, 'duration') ?>

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
