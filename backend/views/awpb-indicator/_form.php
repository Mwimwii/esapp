<?php

use backend\models\AwpbActivity;
use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use borales\extensions\phoneInput\PhoneInput;
use kartik\form\ActiveForm;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use backend\models\AwpbComponent;
//use backend\models\AwpbActivity;
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
                echo $form->field($model,'component_id')->dropDownList((AwpbComponent::getAwpbSubComponentsList()),
                [
                'prompt'=>'Select component','id'=>'comp_id']);

                echo Html::hiddenInput('selected_id', $model->isNewRecord ? '' : $model->output_id, ['id' => 'selected_id']);


                echo $form->field($model, 'output_id')->widget(DepDrop::classname(), [
                  'options' => ['id' => 'output_id1', 'custom' => true, 'required' => TRUE],
                  'pluginOptions' => [
                    'depends' => ['comp_id'],
                    'initialize' => $model->isNewRecord ? false : true,
                    'placeholder' => 'Select an output',
                    'url' => Url::to(['/awpb-component/outputs']),
                    'params' => ['comp_id'],
                  ]
                ]);
                

//
//                echo Html::hiddenInput('selected_activity_id', $model->isNewRecord ? '' : $model->activity_id, ['id' => 'selected_activity_id']);
//
//
//                echo $form->field($model,'activity_id')->widget(DepDrop::classname(),[
//                'options' => ['id' => 'parent_activity_id1', 'custom' => true, 'required' => TRUE],
//                'pluginOptions' => [
//                'depends' => ['output_id1'],
//                'initialize' => $model->isNewRecord ? false : true,
//                'placeholder' => 'Select a parent activity',
//                'url' => Url::to(['/awpb-activity/childactivities']),
//                'params' => ['output_id1'],
//                ]
//                ]);

              echo $form->field($model, 'name')->textInput(['maxlength' => true]);
                echo $form->field($model, 'description')->textarea(['rows' => 3],['maxlength' => true]);
                          
               echo $form->field($model, 'unit_of_measure_id')->dropDownList(
                          \backend\models\AwpbUnitOfMeasure::getAwpbUnitOfMeasuresList(), ['id' => 'unit_of_measure_id', 'custom' => true, 'prompt' => 'Please select a unit of measure', 'required' => false]);          ;
               echo $form->field($model, 'programme_target')->textInput(['maxlength' => true]);
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