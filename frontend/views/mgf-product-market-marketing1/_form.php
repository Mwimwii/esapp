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
/* @var $this yii\web\View */
/* @var $model frontend\models\MgfProductMarketMarketing1 */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mgf-product-market-marketing1-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'description')->textArea(['maxlength' => true]) ?>
    <?= $form->field($model, 'proposal_id')->hiddenInput(['value'=>$proposal->id, 'maxlength' => true])->label(false) ?>

    <!-- <?= $form->field($model, 'proposal_id')->textInput() ?>

    <?= $form->field($model, 'date_created')->textInput() ?>

   <?= $form->field($model, 'date_update')->textInput() ?>

   <?= $form->field($model, 'created_by')->textInput() ?>

  <?= $form->field($model, 'updated_by')->textInput() ?>
 -->
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
