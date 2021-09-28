<?php


use yii\helpers\Html;
//use yii\widgets\ActiveForm;
//use yii\bootstrap4\ActiveForm;
use borales\extensions\phoneInput\PhoneInput;
use kartik\form\ActiveForm;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\AwpbUnitOfMeasure */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="awpb-unit-of-measure-form">
    <?php 
	$form = ActiveForm::begin(['type' => ActiveForm::TYPE_VERTICAL, 'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL],'options' => ['enctype' => 'multipart/form-data']]);
	//$form = ActiveForm::begin(); 
	?>
	<div class="row">
		<div class="col-md-4">
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>	
 </div>
 		<div class="col-md-2">
       <?php 
	   
	    echo "<label class='label' for='status'>Status</label>";
        echo $form->field($model, 'status')->radioButtonGroup([
            '1' => 'Active',
            '0' => 'Blocked',
                ], [
            'maxlength' => true,
            'id' => "status",
            'class' => 'btn-group-sm',
                //'itemOptions' => ['labelOptions' => ['class' => 'btn btn-primary btn-sm']]
        ])->label(false);
       	   
	   ?>
	   </div>
	   	
    <div class="col-lg-6">
        <h4>Instructions</h4>
        <ol>
            <?php
             echo '<li>Fields marked with * are required</li>
           ';
            
            ?>
        </ol>
    </div>    	   
	
	   </div>
	 
	   
 </div>
    </div>
	<div class="row">
		<div class="col-md-6">
        
    

  </div>
    </div>
<div class="row">
	<div class="col-md-12">
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
	 </div>
	  </div>

    <?php ActiveForm::end(); ?>

</div>

