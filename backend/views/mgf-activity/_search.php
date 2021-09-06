<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfActivitySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mgf-activity-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'activity_no') ?>

    <?= $form->field($model, 'activity_name') ?>

    <?= $form->field($model, 'componet_id') ?>

    <?= $form->field($model, 'date_created') ?>

    <?php // echo $form->field($model, 'createdby') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
