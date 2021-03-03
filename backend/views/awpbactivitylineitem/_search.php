<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AwpbActivityLineItemSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="awpb-activity-line-item-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'activity_id') ?>

    <?= $form->field($model, 'commodity_type_id') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'unit_cost') ?>

    <?php // echo $form->field($model, 'quarter_one_quantity') ?>

    <?php // echo $form->field($model, 'quarter_two_quantity') ?>

    <?php // echo $form->field($model, 'quarter_three_quantity') ?>

    <?php // echo $form->field($model, 'quarter_four_quantity') ?>

    <?php // echo $form->field($model, 'total_quantity') ?>

    <?php // echo $form->field($model, 'district_id') ?>

    <?php // echo $form->field($model, 'province_id') ?>

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
