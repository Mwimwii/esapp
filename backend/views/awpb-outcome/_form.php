<?php

use yii\helpers\Html;
use borales\extensions\phoneInput\PhoneInput;
use kartik\form\ActiveForm;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use kartik\money\MaskMoney;
use yii\widgets\MaskedInput;

use backend\models\AwpbComponent;
use backend\models\AwpbActivity;
use backend\models\AwpbTemplate;
use backend\models\AwpbIndicator;
/* @var $this yii\web\View */
/* @var $model backend\models\AwpbOutcome */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="card">

<div class="card-body">
<div class="row">
		<div class="col-md-12">

    <?php
    $form = ActiveForm::begin(['type' => ActiveForm::TYPE_HORIZONTAL]);
    		
	//  echo $form->field($model,'component_id')->dropDownList((AwpbComponent::getAwpbSubComponentsList()),
  //    [
  //      'prompt'=>'Select component','id'=>'comp_id']);
   
        echo $form->field($model, 'name')->textInput(['maxlength' => true]);
        echo $form->field($model, 'outcome_description')->textInput(['maxlength' => true]);
?>
    
</div>
</div>
<div class="row">
		<div class="col-md-12">
   
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    </div>  </div>
    <?php ActiveForm::end(); ?>

</div>
</div>
