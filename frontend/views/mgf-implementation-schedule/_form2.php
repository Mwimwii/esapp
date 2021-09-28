<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfImplementationSchedule */
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

<div class="mgf-implementation-schedule-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'activity_id')->textInput() ?>

    <?= $form->field($model, 'yr1qtr1')->textInput() ?>

    <?= $form->field($model, 'yr1qtr2')->textInput() ?>

    <?= $form->field($model, 'yr1qtr3')->textInput() ?>

    <?= $form->field($model, 'yr1qtr4')->textInput() ?>

    <?= $form->field($model, 'yr2qtr1')->textInput() ?>

    <?= $form->field($model, 'yr2qtr2')->textInput() ?>

    <?= $form->field($model, 'yr2qtr3')->textInput() ?>

    <?= $form->field($model, 'yr2qtr4')->textInput() ?>

    <?= $form->field($model, 'yr3qtr1')->textInput() ?>

    <?= $form->field($model, 'yr3qtr2')->textInput() ?>

    <?= $form->field($model, 'yr3qtr3')->textInput() ?>

    <?= $form->field($model, 'yr3qtr4')->textInput() ?>

    <?= $form->field($model, 'yr4qtr1')->textInput() ?>

    <?= $form->field($model, 'yr4qtr2')->textInput() ?>

    <?= $form->field($model, 'yr4qtr3')->textInput() ?>

    <?= $form->field($model, 'yr4qtr4')->textInput() ?>

    <?= $form->field($model, 'proposal_id')->hiddenInput(['value'=>$proposal->id, 'maxlength' => true])->label(false) ?>

   
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
