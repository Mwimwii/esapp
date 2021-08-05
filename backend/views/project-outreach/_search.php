<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ProjectOutreachSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-outreach-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'component') ?>

    <?= $form->field($model, 'sub_component') ?>

    <?= $form->field($model, 'province_id') ?>

    <?= $form->field($model, 'district_id') ?>

    <?php // echo $form->field($model, 'year') ?>

    <?php // echo $form->field($model, 'quarter') ?>

    <?php // echo $form->field($model, 'number_females') ?>

    <?php // echo $form->field($model, 'number_males') ?>

    <?php // echo $form->field($model, 'number_young') ?>

    <?php // echo $form->field($model, 'number_not_young') ?>

    <?php // echo $form->field($model, 'number_women_headed_households') ?>

    <?php // echo $form->field($model, 'number_households') ?>

    <?php // echo $form->field($model, 'number_household_members') ?>

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
