<<<<<<< HEAD
<?php


use yii\helpers\Html;
//use yii\bootstrap4\ActiveForm;
use borales\extensions\phoneInput\PhoneInput;
use kartik\form\ActiveForm;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use backend\models\AwpbComponent;
use backend\models\AwpbActivity
//use common\models\Role;
/* @var $this yii\web\View */
/* @var $model app\models\AwpbComponent */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin(); ?>
<div class="row" style="">
    <div class="col-lg-4">
        <?=
        $form->field($model, 'sub_component', [
            'addon' => [
                'append' => [
                    'content' => Html::submitButton('Filter', ['name' => 'addComponent', 'value' => 'true', 'class' => 'btn btn-success btn-sm']),
                    'asButton' => true
                ]
            ]
        ])->dropDownList(
                [
            'Component' => 'Component',
            'Subcomponent' => 'Subcomponent',
                ], [
            'custom' => true,
            'prompt' => 'Filter by component type',
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
            <li>Select the component type you want to add</li>
            <?php
            if (!empty($sub_component)) {
                echo '<li>Fields marked with * are required</li>
           
            <li>Fill in the fields below to add a <b>' . $sub_component . '</b></li>';
            }
            ?>
        </ol>
    </div>
</div>

<?php ActiveForm::end(); ?>


<div class="awpb-component-form">

<?php
$form = ActiveForm::begin(['type' => ActiveForm::TYPE_VERTICAL, 'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL]]);

echo $form->field($model, 'subcomponent')->hiddenInput(['value'=> $sub_component])->label(false);
?>
<hr class="dotted short">
<div class="row">
    <?php
	 if ($sub_component === "Component") {
		echo '<div class="col-md-6">';
			echo $form->field($model, 'code')->textInput(['maxlength' => true]);		
			echo $form->field($model, 'name')->textInput(['maxlength' => true]);
            echo $form->field($model, 'description')->textarea(['rows' => 3],['maxlength' => true]);
            echo $form->field($model, 'access_level')->dropDownList(
                [
                    '0' => 'All',
            '1' => 'District',
            '2' => 'Programme',
    
                ], ['prompt' => 'Select the access level', 'custom' => true, 'required' => false]
        );
 
            // echo  $form->field($model, 'expense_category_id')
            // ->dropDownList(
            //         \backend\models\AwpbExpenseCategory ::getAwpbExpenseCategoryList(), ['id' => 'expense_category_id', 'custom' => true, 'prompt' => 'Please select an expense category', 'required' => false]);
            // ;
            // echo  $form->field($model, 'funder_id')
            // ->dropDownList(
            //         \backend\models\AwpbFunder::getAwpbFunderList(), ['id' => 'funder_id', 'custom' => true, 'prompt' => 'Please select a funder', 'required' => false]);
            // ;	 
            echo '</div>';
            echo '<div class="col-md-6">';
           // echo $form->field($model, 'outcome')->textarea(['rows' => 5]) ;
           // echo $form->field($model, 'output')->textarea(['rows' => 4]) ;
            echo '</div>';
            echo ' <div class="row">';
            echo '<div class="col-md-12">';
			echo '<div class="form-group">';
					echo Html::submitButton('Save', ['class' => 'btn btn-success']);
			echo '</div>';
		echo '</div>';
	}

		
	if ($sub_component=== "Subcomponent") 
	{
		echo '<div class="col-md-6">';
				               
		  echo  $form->field($model, 'parent_component_id')
			  ->dropDownList(
					  \backend\models\AwpbComponent::getAwpbComponentsList(), ['id' => 'component_id', 'custom' => true, 'prompt' => 'Please select a parent component', 'required' => false]);
			  ;	

	
			echo $form->field($model, 'name')->textInput(['maxlength' => true]) ;
            echo $form->field($model, 'description')->textarea(['rows' => 6],['maxlength' => true]); 
            echo '</div>
            <div class="col-md-6">';       
			echo $form->field($model, 'outcome')->textarea(['rows' => 3]) ;
			echo $form->field($model, 'output')->textarea(['rows' => 3]) ;
            echo $form->field($model, 'gl_account_code')->textInput(['maxlength' => true]);
            echo '</div></div>
            <div class="row">
            <div class="col-md-6">
            <div class="form-group">';
					echo Html::submitButton('Save', ['class' => 'btn btn-success']);
			echo '</div>';
		echo '</div>';
	}
		
?>

<?php ActiveForm::end(); ?>
</div>

=======
<?php


use yii\helpers\Html;
//use yii\bootstrap4\ActiveForm;
use borales\extensions\phoneInput\PhoneInput;
use kartik\form\ActiveForm;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use backend\models\AwpbComponent;
use backend\models\AwpbActivity;
use kartik\checkbox\CheckboxX;

//use common\models\Role;
/* @var $this yii\web\View */
/* @var $model app\models\AwpbComponent */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin(); ?>
<div class="row" style="">
    <div class="col-lg-4">
        <?=
        $form->field($model, 'sub_component', [
            'addon' => [
                'append' => [
                    'content' => Html::submitButton('Filter', ['name' => 'addComponent', 'value' => 'true', 'class' => 'btn btn-success btn-sm']),
                    'asButton' => true
                ]
            ]
        ])->dropDownList(
                [
            'Component' => 'Component',
            'Subcomponent' => 'Subcomponent',
                ], [
            'custom' => true,
            'prompt' => 'Filter by component type',
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
            <li>Select the component type you want to add</li>
            <?php
            if (!empty($sub_component)) {
                echo '<li>Fields marked with * are required</li>
           
            <li>Fill in the fields below to add a <b>' . $sub_component . '</b></li>';
            }
            ?>
        </ol>
    </div>
</div>

<?php ActiveForm::end(); ?>


<div class="awpb-component-form">

<?php
$form = ActiveForm::begin(['type' => ActiveForm::TYPE_VERTICAL, 'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL]]);

echo $form->field($model, 'subcomponent')->hiddenInput(['value'=> $sub_component])->label(false);
?>
<hr class="dotted short">
<div class="row">
    <?php
	 if ($sub_component === "Component") {
		echo '<div class="col-md-6">';
			echo $form->field($model, 'code')->textInput(['maxlength' => true]);		
			echo $form->field($model, 'name')->textInput(['maxlength' => true]);
            echo $form->field($model, 'description')->textarea(['rows' => 3],['maxlength' => true]);
          //  echo $form->field($model, 'access_level_district')->checkBox(['rows' => 3],['maxlength' => true]);
          echo '</div>';
          echo '</div>';
         
?>
          <!-- Krajee Flat Blue Theme -->
          <legend><h6>Component Access Level</h6></legend>
          <div class="form-group">
          

<?php
 echo '<div class="row">';
        
  echo '<div class="col-md-2">';
            echo $form->field($model, 'access_level_district')->widget(CheckboxX::classname(), [
                'initInputType' => CheckboxX::INPUT_CHECKBOX,
                'autoLabel' => true,
                'labelSettings' => [
                    'label' => 'District',
                    'position' => CheckboxX::LABEL_LEFT
                ]
            ])->label(false);
            echo '</div><div class="col-md-2">';
            echo $form->field($model, 'access_level_province')->widget(CheckboxX::classname(), [
                'initInputType' => CheckboxX::INPUT_CHECKBOX,
                'autoLabel' => true,
               // 'pluginOptions'=>['threeState'=>false],
                'labelSettings' => [
                    'label' => 'Province',
                    'position' => CheckboxX::LABEL_LEFT
                ]
            ])->label(false);
            echo '</div><div class="col-md-2">';
            echo $form->field($model, 'access_level_programme')->widget(CheckboxX::classname(), [
                'initInputType' => CheckboxX::INPUT_CHECKBOX,
                'autoLabel' => true,
                'labelSettings' => [
                    'label' => 'Programme',
                    'position' => CheckboxX::LABEL_LEFT
                ]
            ])->label(false);
             
         
          ?>
           </div></div></div>
              </label>
          <?php  
        //     echo $form->field($model, 'access_level')->dropDownList(
        //         [
        //             '0' => 'All',
        //     '1' => 'District',
        //     '2' => 'Programme',
    
        //         ], ['prompt' => 'Select the access level', 'custom' => true, 'required' => false]
        // );
 
        //     // echo  $form->field($model, 'expense_category_id')
        //     // ->dropDownList(
        //     //         \backend\models\AwpbExpenseCategory ::getAwpbExpenseCategoryList(), ['id' => 'expense_category_id', 'custom' => true, 'prompt' => 'Please select an expense category', 'required' => false]);
        //     // ;
        //     // echo  $form->field($model, 'funder_id')
        //     // ->dropDownList(
        //     //         \backend\models\AwpbFunder::getAwpbFunderList(), ['id' => 'funder_id', 'custom' => true, 'prompt' => 'Please select a funder', 'required' => false]);
        //     // ;	 
        //     echo '</div>';
        //     echo '<div class="col-md-6">';
        //    // echo $form->field($model, 'outcome')->textarea(['rows' => 5]) ;
        //    // echo $form->field($model, 'output')->textarea(['rows' => 4]) ;
        //     echo '</div>';
            echo ' <div class="row">';
            echo '<div class="col-md-12">';
			echo '<div class="form-group">';
					echo Html::submitButton('Save', ['class' => 'btn btn-success']);
			echo '</div>';
		echo '</div>';
	}

		
	if ($sub_component=== "Subcomponent") 
	{
		echo '<div class="col-md-6">';
				               
		  echo  $form->field($model, 'parent_component_id')
			  ->dropDownList(
					  \backend\models\AwpbComponent::getAwpbComponentsList(), ['id' => 'component_id', 'custom' => true, 'prompt' => 'Please select a parent component', 'required' => false]);
			  ;	
            
            echo $form->field($model, 'code')->textInput(['maxlength' => true]);	
			echo $form->field($model, 'name')->textInput(['maxlength' => true]) ;
            echo $form->field($model, 'description')->textarea(['rows' => 6],['maxlength' => true]); 
            echo $form->field($model, 'gl_account_code')->textInput(['maxlength' => true]);
          
            echo '</div>
            <div class="col-md-6">';       
			//echo $form->field($model, 'outcome')->textarea(['rows' => 3]) ;
			//echo $form->field($model, 'output')->textarea(['rows' => 3]) ;
             echo '</div></div>
            <div class="row">
            <div class="col-md-6">
            <div class="form-group">';
					echo Html::submitButton('Save', ['class' => 'btn btn-success']);
			echo '</div>';
		echo '</div>';
	}
		
?>

<?php ActiveForm::end(); ?>
</div>

>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
