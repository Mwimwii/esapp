<?php

<<<<<<< HEAD
//use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use backend\models\AwpbComponent;
use kartik\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\form\ActiveForm;
=======
use yii\helpers\Html;
use backend\models\AwpbComponent;
use yii\helpers\ArrayHelper;
use kartik\form\ActiveForm;
use kartik\builder\Form;
use kartik\detail\DetailView;
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
/* @var $this yii\web\View */
/* @var $model backend\models\AwpbTemplateActivity */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="card">

<<<<<<< HEAD
<div class="card-body">
<div class="row">
		<div class="col-md-6">
        <?php
    $form = ActiveForm::begin(['type' => ActiveForm::TYPE_HORIZONTAL]);
     echo   $form->field($model, 'awpb_template_id')
            ->dropDownList(
                \backend\models\AwpbTemplate::getAwpbTemplates(),
                ['id' => 'template_id', 'custom' => true, 'required' => true]
            );
        
 
      echo
        $form->field($model, 'activity_id')
            ->dropDownList(
                \backend\models\AwpbActivity::getSubActivities(),
                ['id' => 'activity_id', 'custom' => true, 'required' => true]
            );
        ?>
</div>
</div>
<div class="row">
		<div class="col-md-12">
   
    <div class="form-group">
    <?= Html::submitButton('Update', ['class' => 'btn btn-success btn-sm']) ?>
    </div>
</div>  
<?php ActiveForm::end(); ?>
 </div>
</div></div>

=======
    <div class="card-body">

          
        <div class="form-group row mb-0">
             <div class="col-sm-10">

    <?php $form = ActiveForm::begin(); ?>
<?=
    
    $form->field($model, 'component_id')
->dropDownList(
		\backend\models\AwpbComponent::getAwpbSubComponentsList(), ['custom' => true, 'required' => true,'disabled' => true]);
    
    ?>
                 <?=
    
    $form->field($model, 'activity_id')
->dropDownList(
        \backend\models\AwpbActivity::getSubActivityList(), ['custom' => true, 'required' => true,'disabled' => true]);
    
    ?>  </div>
        </div>  <div class="form-group row mb-0">
                  <div class="col-sm-5">
        
                 <?=                
			$form->field($model, 'expense_category_id')
                ->dropDownList(
                        \backend\models\AwpbExpenseCategory::getAwpbExpenseCategoryList(), ['custom' => true, 'required' => true,'disabled' => true]);
				
			?>
                  </div>
                 <div class="col-sm-5">
    <?= $form->field($model, 'budget_amount')->textInput(['disabled' => true]) ?>

 
    
             </div>
        </div>  <div class="form-group row mb-0">
                  <div class="col-sm-5">

    <?= $form->field($model, 'ifad',['enableAjaxValidation' => false])->textInput(['maxlength' => true, 'placeholder' => 'Enter percentage']);?>

    <?= $form->field($model, 'ifad_grant',['enableAjaxValidation' => false])->textInput(['maxlength' => true, 'placeholder' => 'Enter percentage']);?>

    <?= $form->field($model, 'grz',['enableAjaxValidation' => false])->textInput(['maxlength' => true, 'placeholder' => 'Enter percentage']);?>

    <?= $form->field($model, 'beneficiaries',['enableAjaxValidation' => false])->textInput(['maxlength' => true, 'placeholder' => 'Enter percentage']);?>
                  </div>
                        <div class="col-sm-5">


    <?= $form->field($model, 'private_sector',['enableAjaxValidation' => false])->textInput(['maxlength' => true, 'placeholder' => 'Enter percentage']);?>

    <?= $form->field($model, 'iapri',['enableAjaxValidation' => false])->textInput(['maxlength' => true, 'placeholder' => 'Enter percentage']);?>

    <?= $form->field($model, 'parm',['enableAjaxValidation' => false])->textInput(['maxlength' => true, 'placeholder' => 'Enter percentage']);?>
   
</div>
    </div>  
<div class="row">
	<div class="col-md-12">
    <div class="form-group">
            <?= Html::submitButton('Save', ['class' => ' btn btn-success']) ?>
        </div>
    </div>  </div>
    </div>
    <?php ActiveForm::end(); ?>
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
