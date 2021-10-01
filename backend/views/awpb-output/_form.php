<?php

use yii\helpers\Html;
<<<<<<< HEAD
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
=======

use kartik\form\ActiveForm;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use backend\models\AwpbComponent;

>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d

/* @var $this yii\web\View */
/* @var $model backend\models\AwpbOutput */
/* @var $form yii\widgets\ActiveForm */
?>

<<<<<<< HEAD
<div class="card">

<div class="card-body">
<div class="row">
		<div class="col-md-12">

        <?php
    $form = ActiveForm::begin(['type' => ActiveForm::TYPE_HORIZONTAL]);
    echo $form->field($model,'outcome_id')->dropDownList((AwpbOutcome::getOutcomes()),
     [
       'prompt'=>'Select outcomes','id'=>'out_id']);
       echo Html::hiddenInput('selected_outcome_id', $model->isNewRecord ? '' : $model->outcome_id, ['id' => 'selected_outcome_id']);
         
        echo $form->field($model, 'name')->textInput(['maxlength' => true]);
        echo $form->field($model, 'output_description')->textInput(['maxlength' => true]);

 ?>
</div>
</div>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

=======
<div class="card card-success card-outline">
    <div class="card-body">
<div class="row">
		<div class="col-md-12">

    <?php
    $form = ActiveForm::begin(['type' => ActiveForm::TYPE_HORIZONTAL]);
    		
   echo  $form->field($model, 'component_id')
    ->dropDownList(
        \backend\models\AwpbComponent::getAwpbSubComponentsList(), ['id' => 'comp_id', 'custom' => true, 'required' => true,] 
    );
      
    echo $form->field($model, 'code')->textInput(['maxlength' => true]);
        echo $form->field($model, 'name')->textInput(['maxlength' => true]);
        echo $form->field($model, 'description')->textInput(['maxlength' => true]);
?>
    
</div>
</div>
<div class="row">
		<div class="col-md-12">
   
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    </div>  </div>
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
    <?php ActiveForm::end(); ?>

</div>
</div>
<<<<<<< HEAD
=======


>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
