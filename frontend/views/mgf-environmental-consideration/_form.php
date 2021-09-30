<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfEnvironmentalConsideration */
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

<div class="mgf-environmental-consideration-form">

    <?php $form = ActiveForm::begin(); ?>

<<<<<<< HEAD
    <?= $form->field($model, 'description')->textArea(['maxlength' => true]) ?>
=======
    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d

    <?= $form->field($model, 'proposal_id')->hiddenInput(['value'=>$proposal->id, 'maxlength' => true])->label(false) ?>
    
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
