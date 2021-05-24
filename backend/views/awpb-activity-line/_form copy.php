<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
//use yii\bootstrap4\ActiveForm;
use borales\extensions\phoneInput\PhoneInput;
use kartik\form\ActiveForm;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use kartik\money\MaskMoney;

?>

<div class="awpb-template-form">

    <?php 
	$form = ActiveForm::begin(['type' => ActiveForm::TYPE_VERTICAL, 'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL],'options' => ['enctype' => 'multipart/form-data']]);
	//$form = ActiveForm::begin(); 
	?>
	<div class="row">
		<div class="col-md-2">
    <?=         
        $form->field($model, 'activity_id')
        ->dropDownList(
                
                \backend\models\AWPBActivity::getAwpbActivitiesList(1),['custom' => true, 'prompt' => 'Please select an activity', 'required' => true]
);?>
		
 </div>

    <?php
    //For other user types
   
        echo '<div class="col-md-6">';


        

        echo $form->field($model, 'name')->textInput(['maxlength' => true, 'class' => "form-control", 'placeholder' => 'Item description'])->label("Item description");
        echo '</div>';


        echo '<div class="col-md-2">';



        echo  $form->field($model, 'unit_cost',['enableAjaxValidation' => true])->widget(MaskMoney::classname(), [
            'pluginOptions' => [
                'allowZero' => false,
                'allowNegative' => false,
            ]
        ])->label("Unit Cost");
        echo '</div>';
        echo '</div>';
        echo '<div class="row">';
        echo '<div class="col-md-1"> <b>Quarter One </b> </div>';
        echo '<div class="col-md-2">';

        echo  $form->field($model, 'mo_1',['enableAjaxValidation' => true])->textInput(['value'=>'0','maxlength' => true])
        ->label("Jan");
        echo '</div>';
        echo '<div class="col-md-2">';
        echo  $form->field($model, 'mo_2',['enableAjaxValidation' => true])->textInput(['value'=>'0','maxlength' => true])
        ->label("Feb");
        echo '</div>';
        echo '<div class="col-md-2">';
        echo  $form->field($model, 'mo_3',['enableAjaxValidation' => true])->textInput(['value'=>'0','maxlength' => true])
        ->label("Mar");
        echo '</div>';
        echo '</div>';
        echo '<div class="row">';
        echo '<div class="col-md-1"> <b>Quarter Two </b></div>';
     
        echo '<div class="col-md-2">';
        
        echo  $form->field($model, 'mo_4',['enableAjaxValidation' => true])->textInput(['value'=>'0','maxlength' => true])
        ->label("Apr");
        echo '</div>';
        echo '<div class="col-md-2">';
        echo  $form->field($model, 'mo_5',['enableAjaxValidation' => true])->textInput(['value'=>'0','maxlength' => true])
        ->label("May");
        echo '</div>';
        echo '<div class="col-md-2">';
        echo  $form->field($model, 'mo_6',['enableAjaxValidation' => true])->textInput(['value'=>'0','maxlength' => true])
        ->label("Jun");
        echo '</div>';
        echo '</div>';
        echo '<div class="row">';
        echo '<div class="col-md-1"><b>Quarter Two </b> </div>';
        echo '<div class="col-md-2">';
        echo  $form->field($model, 'mo_7',['enableAjaxValidation' => true])->textInput(['value'=>'0','maxlength' => true])
        ->label("Jul");
        echo '</div>';
        echo '<div class="col-md-2">';
        echo  $form->field($model, 'mo_8',['enableAjaxValidation' => true])->textInput(['value'=>'0','maxlength' => true])
        ->label("Aug");
        echo '</div>';
        echo '<div class="col-md-2">';
        echo  $form->field($model, 'mo_9',['enableAjaxValidation' => true])->textInput(['value'=>'0','maxlength' => true])
        ->label("Sep");
        echo '</div>';
        echo '</div>';
        echo '<div class="row">';
        echo '<div class="col-md-1"><b>Quarter Two </b></div>';
        echo '<div class="col-md-2">';
        echo  $form->field($model, 'mo_10',['enableAjaxValidation' => true])->textInput(['value'=>'0','maxlength' => true])
        ->label("Oct");
        echo '</div>';
        echo '<div class="col-md-2">';
        echo  $form->field($model, 'mo_11',['enableAjaxValidation' => true])->textInput(['value'=>'0','maxlength' => true])
        ->label("Nov");
        echo '</div>';
        echo '<div class="col-md-2">';
        echo  $form->field($model, 'mo_12',['enableAjaxValidation' => true])->textInput(['value'=>'0','maxlength' => true])
        ->label("Dec");

        echo '</div>';
       
echo '</div>';
    
    ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
