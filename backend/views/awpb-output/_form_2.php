<?php

use yii\helpers\Html;

use backend\models\AwpbComponent;
use borales\extensions\phoneInput\PhoneInput;
use kartik\form\ActiveForm;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use kartik\money\MaskMoney;
/* @var $this yii\web\View */
/* @var $model backend\models\AwpbOutput */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="card card-success card-outline">
    <div class="card-body">
<div class="row">
		<div class="col-md-12">

        <div class="awpb-output-create">
   
    <?php
    $form = ActiveForm::begin(['type' => ActiveForm::TYPE_HORIZONTAL]);
    $outputs = self::find()
    ->select(["CONCAT(code,' ',name) as name", 'id'])
    //->select(["CONCAT(CONCAT(CONCAT(title,'',first_name),' ',other_name),' ',last_name) as name", 'id'])
    ->where(['component_id' => $id])
    ->asArray()
    ->all();
    		
    var_dump(  $outputs);
	 echo $form->field($model,'component_id')->dropDownList((AwpbComponent::getAwpbSubComponentsList()),
     [
       'prompt'=>'Select component','id'=>'comp_id']);
       echo $form->field($model, 'code')->textInput(['maxlength' => true]) ;
        echo $form->field($model, 'name')->textInput(['maxlength' => true]);
        echo $form->field($model, 'description')->textInput(['maxlength' => true]);
?>
      
</div>
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
