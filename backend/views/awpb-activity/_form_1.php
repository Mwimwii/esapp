<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use borales\extensions\phoneInput\PhoneInput;
use kartik\form\ActiveForm;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use backend\models\AwpbComponent;
use backend\models\AwpbActivity;
use backend\models\AwpbTemplate;
use backend\models\AwpbIndicator;


// ?>

<div class="awpb-activity-form">

	  <?php 
//	$form = ActiveForm::begin(['type' => ActiveForm::TYPE_VERTICAL, 'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL]]);
$form = ActiveForm::begin(); 
echo $form->field($model, 'activity_type')->hiddenInput(['value'=> $sub])->label(false);
	?>
	<div class="row">
		<div class="col-md-6">
	
		<?php
	 if ($model->activity_type=== "Main Activity")
	  {
		echo '
		</div>
				
		   </div>
		   <div class="row">
			   <div class="col-md-6">';	  
	
			
		
	 	
	 echo $form->field($model,'component_id')->dropDownList((AwpbComponent::getAwpbSubComponentsList()),
	  [
		'prompt'=>'Select component','id'=>'comp_id']);

		echo $form->field($model, 'activity_code')->textInput(['maxlength' => true]);	
		echo $form->field($model, 'name')->textInput(['maxlength' => true]);
		echo $form->field($model, 'description')->textarea(['rows' => 3],['maxlength' => true]);
		echo '
		</div>
                			   <div class="col-md-6">
 <h4>Instructions</h4>
        <ol>
            
                <li>Fields marked with * are required</li>
                <ol></div>
                ' ;
           
            
           
      
	
			echo '
			</div>
			  </div>
		  <div class="row">
			  <div class="col-md-12">
			  <div class="form-group">';
			  echo Html::submitButton('Save', ['class' => 'btn btn-success']) ;
			  echo '</div>
			   </div>
				</div>';
				}
				
 if ($model->activity_type=== "Subactivity")
 {	
	echo '
	</div>
			
	   </div>
            <div class="row">
		   <div class="col-md-6">
                   </h4>
        <ol>
            
                <li>Fields marked with * are required</li>
                <ol>
                   </div></div>
	   <div class="row">
		   <div class="col-md-6">';   	

	
		echo 	
        $form->field($model, 'component_id')
->dropDownList(
		\backend\models\AwpbComponent::getAwpbSubComponentsList(), ['id' => 'comp_id', 'custom' => true, 'required' => true,'disabled' => ($model->isNewRecord) ? 'disabled' : true] 
);
		echo
			$form->field($model, 'parent_activity_id')
			->dropDownList(
			\backend\models\AwpbActivity::getParentAwpbActivity($model->parent_activity_id), ['id' => 'paract_id', 'custom' => true, 'required' => true,'disabled' => ($model->isNewRecord) ? 'disabled' : true] 
			);

        

echo $form->field($model,'commodity_type_id')->dropDownList((\backend\models\AwpbCommodityTypes::getCommodityTypes()),
[
	'prompt'=>'Select commodity type','id'=>'ty_id']);

//				echo $form->field($model,'component_id')->hiddenInput(['value' => '0'])->label(false);
//					
//				echo $form->field($model, 'activity_code')->textInput(['maxlength' => true]);
		
				// echo                
				//    $form->field($model, 'unit_of_measure_id')
				// 	   ->dropDownList(
				// 			   \backend\models\AwpbUnitOfMeasure::getAwpbUnitOfMeasuresList(), ['id' => 'unit_of_measure_id', 'custom' => true, 'prompt' => 'Please select a unit of measure', 'required' => false]);
					   
				//    ;
				echo $form->field($model, 'name')->textInput(['maxlength' => true]);
		
				   echo '
				   </div>

						  <div class="col-md-6">';
						  
						  echo $form->field($model, 'description')->textarea(['rows' => 4],['maxlength' => true]);
			
				  
				echo $form->field($model, 'programme_target')->textInput(['maxlength' => true]);
	  
			echo $form->field($model, 'expense_category_id')
			->dropDownList(
					\backend\models\AwpbExpenseCategory::getAwpbExpenseCategoryList(), ['id' => 'expense_category_id', 'custom' => true, 'prompt' => 'Please select an expense category', 'required' => false]);
			
		;
			echo $form->field($model, 'gl_account_code')->textInput(['maxlength' => true]);                
		
				//   echo $form->field($model, 'expense_category_id')->hiddenInput(['value' => '0'])->label(true);
//echo  $form->field($model, 'unit_of_measure_id')->hiddenInput(['value' => '0'])->label(false);
				  
				
					   echo '
					   </div>
						 </div>
					 <div class="row">
						 <div class="col-md-12">
						 <div class="form-group">';
						 echo Html::submitButton('Save', ['class' => 'btn btn-success']) ;
						 echo '</div>
						  </div>
						   </div>';
						   }

		
?>
    <?php ActiveForm::end(); ?>

	
