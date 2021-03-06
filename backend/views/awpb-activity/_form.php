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


/* @var $this yii\web\View */
/* @var $model backend\models\AwpbActivity */
/* @var $form yii\widgets\ActiveForm */

// if (isset(Yii::$app->session['fiscal_year']))
//  {
//         $fiscal_year = Yii::$app->session['fiscal_year'];
// 	    $awpb_template_id = Yii::$app->session['awpb_template_id'];
//     } 
// 	else 
// 	{
// 		$fiscal_year = null;
// 		$awpb_template_id=null;
//     }
   
//var_dump ( backend\models\AwpbActivity::getAwpbComponentActivities(8));

// ?>

<?php $form = ActiveForm::begin(); ?>
<div class="row" style="">
    <div class="col-lg-4">
        <?=
        $form->field($model, 'sub', [
            'addon' => [
                'append' => [
                    'content' => Html::submitButton('Filter', ['name' => 'addSub', 'value' => 'true', 'class' => 'btn btn-success btn-sm']),
                    'asButton' => true
                ]
            ]
        ])->dropDownList(
                [
            'Main Activity' => 'Main Activity',
            'Subactivity' => 'Subactivity',
                ], [
            'custom' => true,
            'prompt' => 'Filter by activity type',
            'required' => true,
                ]
        );
        ?>
    </div>
    <div class="col-lg-2">
        &nbsp;
    </div>
    <div class="col-lg-6">
        <h4>Instructions</h4>
        <ol>
            <li>Select the activity type you want to add</li>
            <?php
            if (!empty($sub)) {
                echo '<li>Fields marked with * are required</li>
           
            <li>Fill in the fields below to add a <b>' . $sub . '</b></li>';
            }
            ?>
        </ol>
    </div>
</div>

<?php ActiveForm::end(); ?>


<div class="awpb-activity-form">

	  <?php 
//	$form = ActiveForm::begin(['type' => ActiveForm::TYPE_VERTICAL, 'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL]]);
$form = ActiveForm::begin(); 
echo $form->field($model, 'activity_type')->hiddenInput(['value'=> $sub])->label(false);
	?>
	<div class="row">
		<div class="col-md-6">
	
		<?php
	 if ($sub === "Main Activity") {

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

			   <div class="col-md-6">';
	
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
				

if ($sub === "Subactivity") {	
	echo '
	</div>
			
	   </div>
	   <div class="row">
		   <div class="col-md-6">';   	

	 	
			echo $form->field($model,'component_id')->dropDownList((AwpbComponent::getAwpbSubComponentsList()),
			[
			  'prompt'=>'Select component','id'=>'comp_id']);
	  

		
echo Html::hiddenInput('selected_id', $model->isNewRecord ? '' : $model->parent_activity_id, ['id' => 'selected_id']);


echo $form->field($model,'parent_activity_id')->widget(DepDrop::classname(),[
	'options' => ['id' => 'parent_activity_id1', 'custom' => true, 'required' => TRUE],
	'pluginOptions' => [
		'depends' => ['comp_id'],
		'initialize' => $model->isNewRecord ? false : true,
		'placeholder' => 'Select a parent activity',
		'url' => Url::to(['/awpb-component/parentactivities']),
		'params' => ['comp_id'],
	]
]);

echo $form->field($model,'commodity_type_id')->dropDownList((\backend\models\AwpbCommodityTypes::getCommodityTypes()),
[
	'prompt'=>'Select commodity type','id'=>'ty_id']);
				echo $form->field($model,'component_id')->hiddenInput(['value' => '0'])->label(false);
					
				echo $form->field($model, 'activity_code')->textInput(['maxlength' => true]);
		
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

	
