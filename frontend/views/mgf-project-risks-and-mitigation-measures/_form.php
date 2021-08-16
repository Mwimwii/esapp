<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfProjectRisksAndMitigationMeasures */
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

<div class="mgf-project-risks-and-mitigation-measures-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'expected_risks')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'consequences_of_risk')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mitigation_measures_planned')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'proposal_id')->hiddenInput(['value'=>$proposal->id, 'maxlength' => true])->label(false) ?>

    

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
