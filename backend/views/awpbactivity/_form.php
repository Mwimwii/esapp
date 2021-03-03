<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AwpbActivity */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="awpb-activity-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'activity_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'parent_activity_id')->textInput() ?>

    <?= $form->field($model, 'component_id')->textInput() ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'unit_of_measure_id')->textInput() ?>

    <?= $form->field($model, 'quarter_one_budget')->textInput() ?>

    <?= $form->field($model, 'quarter_two_budget')->textInput() ?>

    <?= $form->field($model, 'quarter_three_budget')->textInput() ?>

    <?= $form->field($model, 'quarter_four_budget')->textInput() ?>

    <?= $form->field($model, 'total_budget')->textInput() ?>

    <?= $form->field($model, 'expense_category_id')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
