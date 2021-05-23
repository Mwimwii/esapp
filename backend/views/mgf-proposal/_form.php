<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfProposal */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mgf-proposal-form" style="width:50%">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'project_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mgf_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'project_background')->textarea(['rows' => 4]) ?>

    <?= $form->field($model, 'problem_statement')->textarea(['rows' => 4]) ?>

    <?= $form->field($model, 'overall_objective')->textarea(['rows' => 4]) ?>

    <?= $form->field($model, 'summary_description')->textarea(['rows' => 4]) ?>

    <div class="form-group">
    <?= Html::a('<i class="glyphicon glyphicon-backward"></i>Back', ['index'], ['class' => 'btn btn-default']);?>
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
