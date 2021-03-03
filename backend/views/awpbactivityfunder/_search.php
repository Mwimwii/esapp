<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AwpbActivityFunderSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="awpb-activity-funder-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'activity_id') ?>

    <?= $form->field($model, 'funder_id') ?>

    <?= $form->field($model, 'amount') ?>

    <?= $form->field($model, 'percentage') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
