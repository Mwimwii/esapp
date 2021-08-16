<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\MgfApplicant;
use frontend\models\MgfProposal;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfProfitBeforeInterestTaxes */
/* @var $form yii\widgets\ActiveForm */

$userid=Yii::$app->user->identity->id;
$applicant=MgfApplicant::findOne(['user_id'=>$userid]);
$proposal=MgfProposal::find()->where(['is_active'=>1,'organisation_id'=>$applicant->organisation_id])->one();
?>

<div class="mgf-profit-before-interest-taxes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'profit_yr1_value')->textInput() ?>

    <?= $form->field($model, 'profit_yr2_value')->textInput() ?>

    <?= $form->field($model, 'profit_yr3_value')->textInput() ?>

    <?= $form->field($model, 'profit_yr4_value')->textInput() ?>

    <?= $form->field($model, 'proposal_id')->hiddenInput(['value'=>$proposal->id, 'maxlength' => true])->label(false) ?>

   
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
