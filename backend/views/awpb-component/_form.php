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
			echo $form->field($model, 'outcome')->textarea(['rows' => 3]) ;
			echo $form->field($model, 'output')->textarea(['rows' => 3]) ;
		
			echo '<div class="form-group">';
					echo Html::submitButton('Save', ['class' => 'btn btn-success']);
			echo '</div>';
		echo '</div>';
	}
		
?>

<?php ActiveForm::end(); ?>
</div>

