<<<<<<< HEAD
<?php
use kartik\helpers\Html;
//use yii\helpers\Html;
//use yii\widgets\ActiveForm;
//use yii\bootstrap4\ActiveForm;
use borales\extensions\phoneInput\PhoneInput;
use kartik\form\ActiveForm;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
?>

<div class="awpb-template-form">

    <?php 
// $model1->icons = [
//     'align-left' => Html::icon('align-left') . ' Align Left',
//     'align-center' => Html::icon('align-center') . ' Align Center',
//     'align-right' => Html::icon('align-right') . ' Align Right',
//     'align-justify' => Html::icon('align-justify') . ' Align Justify',
//     'arrow-down' => Html::icon('arrow-down') . ' Direction Down',
//     'arrow-up' => Html::icon('arrow-up') . ' Direction Up',
//     'arrow-left' => Html::icon('arrow-left') . ' Direction Left',
//     'arrow-right' => Html::icon('arrow-right') . ' Direction Right',
// ];

	$form = ActiveForm::begin(['type' => ActiveForm::TYPE_VERTICAL, 'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL],'options' => ['enctype' => 'multipart/form-data']]);
	//$form = ActiveForm::begin(); 
	?>
	<div class="row">
		<div class="col-md-4">
    <?= $form->field($model, 'fiscal_year')->textInput() ?>
		
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
    <?= $form->field($model, 'budget_theme')->textarea(['rows' => 3]) ?>

    <?= $form->field($model, 'comment')->textarea(['rows' => 4]) ?>



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

 


=======
<?php

use backend\models\AwpbTemplateActivity;
use kartik\helpers\Html;
use borales\extensions\phoneInput\PhoneInput;
use kartik\form\ActiveForm;
use kartik\date\DatePicker;
use kartik\widgets\TimePicker;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use backend\models\AwpbTemplate;
?>
<div class="card card-success card-outline">
    <div class="card-body">
    <?php 
// $model1->icons = [
//     'align-left' => Html::icon('align-left') . ' Align Left',
//     'align-center' => Html::icon('align-center') . ' Align Center',
//     'align-right' => Html::icon('align-right') . ' Align Right',
//     'align-justify' => Html::icon('align-justify') . ' Align Justify',
//     'arrow-down' => Html::icon('arrow-down') . ' Direction Down',
//     'arrow-up' => Html::icon('arrow-up') . ' Direction Up',
//     'arrow-left' => Html::icon('arrow-left') . ' Direction Left',
//     'arrow-right' => Html::icon('arrow-right') . ' Direction Right',
// ];

	$form = ActiveForm::begin(['type' => ActiveForm::TYPE_VERTICAL, 'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL],'options' => ['enctype' => 'multipart/form-data']]);
	//$form = ActiveForm::begin(); 
	?>
	<div class="row">
		<div class="col-md-6">

    <?php
        echo $form->field($model, 'budget_theme')->textarea(['rows' => 3]) ;
        echo $form->field($model, 'status')->hiddenInput(['value'=>AwpbTemplate::STATUS_DRAFT])->label(false);
        echo  $form->field($model, "fiscal_year" ,['enableAjaxValidation' => true])->widget(DatePicker::classname(), [
             
            'options' => ['placeholder' => 'Enter AWPB fiscal year i.e. YYYY', 'maxlength' => true,],
            'pluginOptions' => [
                'minViewMode'=>2,
                'maxViewMode'=>2,
                'autoclose' => true,
                'format' => 'yyyy',
                'startView' => 'year',
                'todayHighlight' => TRUE
            ],
        ]);        echo$form->field($model, "preparation_deadline_first_draft", ['enableAjaxValidation' => true])->widget(DatePicker::classname(), [
            'options' => ['placeholder' => 'Enter first draft preparation deadline i.e. YYYY-MM-DD', 'maxlength' => true,],
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd',
                'startView' => 'year',
                'todayHighlight' => TRUE
            ]
        ]);
        echo $form->field($model, "submission_deadline", ['enableAjaxValidation' => true])->widget(DatePicker::classname(), [
            'options' => ['placeholder' => 'Enter submission dealine i.e. YYYY-MM-DD', 'maxlength' => true,],
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd',
                'startView' => 'year',
                'todayHighlight' => TRUE
            ]
        ]);
        echo  $form->field($model, "consolidation_deadline", ['enableAjaxValidation' => true])->widget(DatePicker::classname(), [
            'options' => ['placeholder' => 'Enter consolidation deadline  i.e. YYYY-MM-DD', 'maxlength' => true,],
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd',
                'startView' => 'year',
                'todayHighlight' => TRUE
            ]
        ]);
        echo $form->field($model, "review_deadline", ['enableAjaxValidation' => true])->widget(DatePicker::classname(), [
            'options' => ['placeholder' => 'Enter review deadline i.e. YYYY-MM-DD', 'maxlength' => true,],
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd',
                'startView' => 'year',
                'todayHighlight' => TRUE
            ]
        ]);
        echo  $form->field($model, "preparation_deadline_second_draft", ['enableAjaxValidation' => true])->widget(DatePicker::classname(), [
            'options' => ['placeholder' => 'Enter second draft preparation deadline i.e. YYYY-MM-DD', 'maxlength' => true,],
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd',
                'startView' => 'year',
                'todayHighlight' => TRUE
            ]
        ]);
        echo  $form->field($model, "review_deadline_pco", ['enableAjaxValidation' => true])->widget(DatePicker::classname(), [
            'options' => ['placeholder' => 'Enter review deadline i.e. YYYY-MM-DD', 'maxlength' => true,],
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd',
                'startView' => 'year',
                'todayHighlight' => TRUE
            ]
        ]); 
  
        ?>
        </div>
        <div class="col-md-6">
        <?php
              echo  $form->field($model, "finalisation_deadline_pco", ['enableAjaxValidation' => true])->widget(DatePicker::classname(), [
                'options' => ['placeholder' => 'Enter finalisation deadline i.e. YYYY-MM-DD', 'maxlength' => true,],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',
                    'startView' => 'year',
                    'todayHighlight' => TRUE
                ]
            ]);
     
        echo  $form->field($model, "comment_deadline_ifad", ['enableAjaxValidation' => true])->widget(DatePicker::classname(), [
            'options' => ['placeholder' => 'Enter comment deadline i.e. YYYY-MM-DD', 'maxlength' => true,],
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd',
                'startView' => 'year',
                'todayHighlight' => TRUE
            ]
        ]); 
        echo  $form->field($model, "distribution_deadline", ['enableAjaxValidation' => true])->widget(DatePicker::classname(), [
            'options' => ['placeholder' => 'Enter distribution deadline i.e. YYYY-MM-DD', 'maxlength' => true,],
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd',
                'startView' => 'year',
                'todayHighlight' => TRUE
            ]
        ]);
        echo  $form->field($model, "submission_deadline_moa_mfl", ['enableAjaxValidation' => true])->widget(DatePicker::classname(), [
            'options' => ['placeholder' => 'Enter submission deadline i.e. YYYY-MM-DD', 'maxlength' => true,],
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd',
                'startView' => 'year',
                'todayHighlight' => TRUE
            ]
        ]);  
        echo $form->field($model, "approval_deadline_jpsc", ['enableAjaxValidation' => true])->widget(DatePicker::classname(), [
            'options' => ['placeholder' => 'Enter approval deadline i.e. YYYY-MM-DD', 'maxlength' => true,],
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd',
                'startView' => 'year',
                'todayHighlight' => TRUE
            ]
        ]);
        echo  $form->field($model, "incorpation_deadline_pco_moa_mfl", ['enableAjaxValidation' => true])->widget(DatePicker::classname(), [
            'options' => ['placeholder' => 'Enter deadline i.e. YYYY-MM-DD', 'maxlength' => true,],
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd',
                'startView' => 'year',
                'todayHighlight' => TRUE
            ]
        ]);
        echo    $form->field($model, "submission_deadline_ifad", ['enableAjaxValidation' => true])->widget(DatePicker::classname(), [
            'options' => ['placeholder' => 'Enter submission deadline i.e. YYYY-MM-DD', 'maxlength' => true,],
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd',
                'startView' => 'year',
                'todayHighlight' => TRUE
            ]
        ]);
        

   echo $form->field($model, 'comment')->textarea(['rows' => 3]);
    
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

</div></div>

 


>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
