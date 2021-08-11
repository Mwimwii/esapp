<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\MgfApplicant;
use frontend\models\MgfProposal;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfImplementationArrangementsCooperatingPartners */
/* @var $form yii\widgets\ActiveForm */
$userid=Yii::$app->user->identity->id;
$applicant=MgfApplicant::findOne(['user_id'=>$userid]);
$proposal=MgfProposal::find()->where(['is_active'=>1,'organisation_id'=>$applicant->organisation_id])->one();

?>

<div class="mgf-implementation-arrangements-cooperating-partners-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'main_activities')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'respobility')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'experience')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'comment')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'typee')->dropDownList([ 'Staff' => 'Staff', 'Technical Assistance' => 'Technical Assistance', 'Collaborating Partners' => 'Collaborating Partners', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'proposal_id')->hiddenInput(['value'=>$proposal->id, 'maxlength' => true])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
