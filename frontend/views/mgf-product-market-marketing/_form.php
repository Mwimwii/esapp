<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\MgfApplicant;
use frontend\models\MgfProposal;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfProductMarketMarketing */
/* @var $form yii\widgets\ActiveForm */
$userid=Yii::$app->user->identity->id;
$applicant=MgfApplicant::findOne(['user_id'=>$userid]);
$proposal=MgfProposal::find()->where(['is_active'=>1,'organisation_id'=>$applicant->organisation_id])->one();
//echo $proposal->id;//$proposal->id;



?>

<div class="mgf-product-market-marketing-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'marketing')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'market_outlets')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sales_contract')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'person_responsible')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'competition_penetration')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'future_prospects')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'branding_market_penetration')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'proposal_id')->hiddenInput(['value'=>$proposal->id, 'maxlength' => true])->label(false) ?>
   
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
