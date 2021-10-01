<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfApproval */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mgf-approval-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'application_id')->textInput() ?>

    <?= $form->field($model, 'review_remark')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'review_submission')->textInput() ?>

    <?= $form->field($model, 'reviewed_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'certify_remark')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'certify_submission')->textInput() ?>

    <?= $form->field($model, 'certified_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'review2_remark')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'review2_submission')->textInput() ?>

    <?= $form->field($model, 'reviewed2_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'approval_remark')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'approve_submittion')->textInput() ?>

    <?= $form->field($model, 'approved_by')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
