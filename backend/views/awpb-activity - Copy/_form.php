<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use borales\extensions\phoneInput\PhoneInput;
use kartik\form\ActiveForm;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model backend\models\AwpbActivity */
/* @var $form yii\widgets\ActiveForm */

if (isset(Yii::$app->session['fiscal_year']))
 {
       $fiscal_year = Yii::$app->session['fiscal_year'];
	    $awpb_template_id = Yii::$app->session['awpb_template_id'];
    } 
	else 
	{
        $fiscal_year = null;
    }
   

?>

<div class="awpb-activity-form">

	  <?php 
	$form = ActiveForm::begin(['type' => ActiveForm::TYPE_VERTICAL, 'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL]]);
	//$form = ActiveForm::begin(); 
	?>
	<div class="row">
		<div class="col-md-6">
	
	 <?php  
	  
	  echo $form->field($model, 'awpb_template_id')->hiddenInput(['value' => $awpb_template_id])->label(false);
		
	  echo $form->field($model, 'activity_code')->hiddenInput(['value' => $fiscal_year])->label(false);
		
	
	 ?>
	 
	
<?= $form->field($model,'component_id')->dropDownList(
 ArrayHelper::map(\backend\models\AwpbComponent::find()->orderBy('component_description')->asArray()->all(), 'id', 'component_description'),
 [
'prompt'=>'Select component',
'onchange'=>'
	$.post("index.php?r=awpb-activity/lists&id='.'"+$(this).val(), function(data){
		$("select#awpbactivity-parent_activity_id").html(data);
	});'
]);?>

	<?= $form->field($model,'parent_activity_id')->dropDownList(
 ArrayHelper::map(\backend\models\AwpbActivity::find()->orderBy('description')->asArray()->all(), 'id', 'description'),
 [
'prompt'=>'Select parent activity',

]);?>		
	
	
					
	

 </div>
 		
    </div>
	<div class="row">
		<div class="col-md-6">
       <?= $form->field($model, 'description')->textarea(['rows' => 3],['maxlength' => true]) ?>
	<?=                
			$form->field($model, 'unit_of_measure_id')
                ->dropDownList(
                        \backend\models\AwpbUnitOfMeasure::getAwpbUnitOfMeasuresList(), ['id' => 'unit_of_measure_id', 'custom' => true, 'prompt' => 'Please select a unit of measure', 'required' => false]);
				
			?>
		 <?=                
			$form->field($model, 'expense_category_id')
                ->dropDownList(
                        \backend\models\AwpbExpenseCategory::getAwpbExpenseCategoriesList(), ['id' => 'expense_category_id', 'custom' => true, 'prompt' => 'Please select an expense category', 'required' => false]);
				
			?>	
  


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

	
