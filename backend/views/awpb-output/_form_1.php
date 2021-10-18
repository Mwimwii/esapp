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
/* @var $model backend\models\AwpbOutput */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="card">

<div class="card-body">
<div class="row">
		<div class="col-md-12">

        <?php
    $form = ActiveForm::begin(['type' => ActiveForm::TYPE_HORIZONTAL]);
   echo  $form->field($model, 'component_id')
    ->dropDownList(
        \backend\models\AwpbComponent::getAwpbSubComponentsList(), ['id' => 'comp_id', 'custom' => true, 'required' => true,'disabled' => ($model->isNewRecord) ? 'disabled' : true] 
    );
      
            echo
              $form->field($model, 'outcome_id')
              ->dropDownList(
              \backend\models\AwpbOutcome::getOutcomes($model->outcome_id), ['id' => 'paract_id', 'custom' => true, 'required' => true,'disabled' => ($model->isNewRecord) ? 'disabled' : true] 
              );
        
        echo $form->field($model, 'name')->textInput(['maxlength' => true]);
        echo $form->field($model, 'output_description')->textInput(['maxlength' => true]);

 ?>
</div>
</div>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>
