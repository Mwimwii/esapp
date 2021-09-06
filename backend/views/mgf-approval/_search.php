<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfApprovalSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mgf-approval-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'application_id') ?>

    <?= $form->field($model, 'conceptnote_id') ?>

    <?= $form->field($model, 'scores') ?>

    <?= $form->field($model, 'review_remark') ?>

    <?php // echo $form->field($model, 'review_submission') ?>

    <?php // echo $form->field($model, 'reviewed_by') ?>

    <?php // echo $form->field($model, 'certify_remark') ?>

    <?php // echo $form->field($model, 'certify_submission') ?>

    <?php // echo $form->field($model, 'certified_by') ?>

    <?php // echo $form->field($model, 'review2_remark') ?>

    <?php // echo $form->field($model, 'review2_submission') ?>

    <?php // echo $form->field($model, 'reviewed2_by') ?>

    <?php // echo $form->field($model, 'approval_remark') ?>

    <?php // echo $form->field($model, 'approve_submittion') ?>

    <?php // echo $form->field($model, 'approved_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
