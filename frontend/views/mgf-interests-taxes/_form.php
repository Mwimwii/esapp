<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfInterestsTaxes */
/* @var $form yii\widgets\ActiveForm */
use frontend\models\MgfApplicant;
use frontend\models\MgfProposal;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfProfitBeforeInterestTaxes */
/* @var $form yii\widgets\ActiveForm */

$userid=Yii::$app->user->identity->id;
$applicant=MgfApplicant::findOne(['user_id'=>$userid]);
$proposal=MgfProposal::find()->where(['is_active'=>1,'organisation_id'=>$applicant->organisation_id])->one();
?>

<div class="mgf-interests-taxes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'interest_tax_type')->dropDownList([ 'Interest' => 'Interest', 'Tax' => 'Tax', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'interest_tax_percent')->textInput() ?>

    <?= $form->field($model, 'interest_tax_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'proposal_id')->hiddenInput(['value'=>$proposal->id, 'maxlength' => true])->label(false) ?>

   

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
