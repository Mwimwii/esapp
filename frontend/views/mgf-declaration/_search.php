<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfDeclarationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mgf-declaration-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'declaration_parta') ?>

    <?= $form->field($model, 'declaration_partb') ?>

    <?= $form->field($model, 'declaration_partc') ?>

    <?= $form->field($model, 'rep_name') ?>

    <?php // echo $form->field($model, 'rep_aproval') ?>

    <?php // echo $form->field($model, 'approval_date') ?>

    <?php // echo $form->field($model, 'rep_title') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'project_id') ?>

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
