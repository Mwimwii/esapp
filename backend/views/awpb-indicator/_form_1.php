<?php


use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use borales\extensions\phoneInput\PhoneInput;
use kartik\form\ActiveForm;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use backend\models\AwpbComponent;
use backend\models\AwpbOutput;
use backend\models\AwpbActivity;
use backend\models\UnitOfMeasure;

/* @var $this yii\web\View */
/* @var $model backend\models\AwpbIndicator */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="card card-success card-outline">
    <div class="card-body">
                  <?php 
                $form = ActiveForm::begin(['type' => ActiveForm::TYPE_VERTICAL, 'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL]]);
                ?>
           

           <div class="row">
                    <div class="col-md-6">      
                     <?php 
                echo $form->field($model,'component_id')->dropDownList(AwpbComponent::getAwpbSubComponentsList(),
                ['id' => 'component_id', 'custom' => true, 'required' => true,'disabled' => ($model->isNewRecord) ? 'disabled' : true] 
              )->label("Component");


              
              echo $form->field($model, 'output_id')->dropDownList(AwpbOutput::getOutputs(),  
              ['id' => 'output_id', 'custom' => true, 'required' => true,'disabled' => ($model->isNewRecord) ? 'disabled' : true] 
              )->label("Output");

              echo $form->field($model, 'activity_id')->dropDownList(AwpbActivity:: getSubActivityList(),
              ['id' => 'activit_id', 'custom' => true, 'required' => true,'disabled' => ($model->isNewRecord) ? 'disabled' : true] 
              )->label("Activity");
                echo                
                $form->field($model, 'unit_of_measure_id')->dropDownList(
                          \backend\models\AwpbUnitOfMeasure::getAwpbUnitOfMeasuresList(), ['id' => 'unit_of_measure_id', 'custom' => true, 'prompt' => 'Please select a unit of measure', 'required' => false]);          ;
                echo $form->field($model, 'name')->textInput(['maxlength' => true]);
                echo $form->field($model, 'description')->textarea(['rows' => 3],['maxlength' => true]);
                    ?>
                    
             </div>

             <div class="col-md-6">
                    <h4>Instructions</h4>
                    <ol>
                        <?php
                         echo '<li>Fields marked with * are required</li>
                       ';
                        
                        ?>
                    </ol>
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
            
                </div>    </div>