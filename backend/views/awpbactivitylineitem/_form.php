<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AwpbActivityLineItem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="awpb-activity-line-item-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'activity_id')->textInput() ?>

    <?= $form->field($model, 'commodity_type_id')->textInput() ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'unit_cost')->textInput() ?>

    <?= $form->field($model, 'quarter_one_quantity')->textInput() ?>

    <?= $form->field($model, 'quarter_two_quantity')->textInput() ?>

    <?= $form->field($model, 'quarter_three_quantity')->textInput() ?>

    <?= $form->field($model, 'quarter_four_quantity')->textInput() ?>

    <?= $form->field($model, 'total_quantity')->textInput() ?>

    <?= $form->field($model, 'district_id')->textInput() ?>

    <?= $form->field($model, 'province_id')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
