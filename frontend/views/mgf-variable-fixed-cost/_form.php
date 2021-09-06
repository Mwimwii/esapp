<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\MgfApplicant;
use frontend\models\MgfProposal;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfVariableFixedCost */
/* @var $form yii\widgets\ActiveForm */

$userid=Yii::$app->user->identity->id;
$applicant=MgfApplicant::findOne(['user_id'=>$userid]);
$proposal=MgfProposal::find()->where(['is_active'=>1,'organisation_id'=>$applicant->organisation_id])->one();
?>

<div class="mgf-variable-fixed-cost-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cost_name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'cost_type')->dropDownList([ 'Variable' => 'Variable', 'Fixed' => 'Fixed',], ['prompt' => '']) ?>
    <?= $form->field($model, 'cost_yr1_value')->textInput() ?>

    <?= $form->field($model, 'cost_yr2_value')->textInput() ?>

    <?= $form->field($model, 'cost_yr3_value')->textInput() ?>

    <?= $form->field($model, 'cost_yr4_value')->textInput() ?>

    <?= $form->field($model, 'comment')->textInput(['maxlength' => true]) ?>

    <?=$form->field($model, 'proposal_id')->hiddenInput(['value'=>$proposal->id, 'maxlength' => true])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
