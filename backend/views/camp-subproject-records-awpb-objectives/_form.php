<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\MeCampSubprojectRecordsAwpbObjectives */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="me-camp-subproject-records-awpb-objectives-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'camp_id')->textInput() ?>

    <?= $form->field($model, 'quarter')->textInput() ?>

    <?= $form->field($model, 'key_indicators')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'period_unit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'target')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'year')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
