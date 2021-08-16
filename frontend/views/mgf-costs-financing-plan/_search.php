<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfCostsFinancingPlanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mgf-costs-financing-plan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'componentid') ?>

    <?= $form->field($model, 'activityid') ?>

    <?= $form->field($model, 'input_name') ?>

    <?= $form->field($model, 'total_Project_cost') ?>

    <?php // echo $form->field($model, 'Applicant_in_kind') ?>

    <?php // echo $form->field($model, 'Applicant_in_cash') ?>

    <?php // echo $form->field($model, 'total_contribution') ?>

    <?php // echo $form->field($model, 'mgf_grant') ?>

    <?php // echo $form->field($model, 'other_sources') ?>

    <?php // echo $form->field($model, 'total') ?>

    <?php // echo $form->field($model, 'mgf_as_percent') ?>

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
