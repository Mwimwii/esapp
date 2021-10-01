<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfDeclaration */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mgf-declaration-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'declaration_parta')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'declaration_partb')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'declaration_partc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rep_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rep_aproval')->textInput() ?>

    <?= $form->field($model, 'approval_date')->textInput() ?>

    <?= $form->field($model, 'rep_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'project_id')->textInput() ?>

    <?= $form->field($model, 'date_created')->textInput() ?>

    <?= $form->field($model, 'date_update')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
