<?php

use yii\helpers\Html;

use kartik\form\ActiveForm;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use backend\models\AwpbComponent;


/* @var $this yii\web\View */
/* @var $model backend\models\AwpbOutput */
/* @var $form yii\widgets\ActiveForm */
?>

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
    <?php ActiveForm::end(); ?>

</div>
</div>


