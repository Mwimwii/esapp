<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfAttachementsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mgf-attachements-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'registration_certificate') ?>

    <?= $form->field($model, 'articles_of_assoc') ?>

    <?= $form->field($model, 'audit_reports') ?>

    <?= $form->field($model, 'mou_contract') ?>

    <?php // echo $form->field($model, 'board_resolution') ?>

    <?php // echo $form->field($model, 'application_attachement') ?>

    <?php // echo $form->field($model, 'application_id') ?>

    <?php // echo $form->field($model, 'date_created') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
