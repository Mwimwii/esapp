<?php

use yii\helpers\Html;

use borales\extensions\phoneInput\PhoneInput;
use kartik\form\ActiveForm;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use kartik\money\MaskMoney;
use yii\widgets\MaskedInput;

$form = ActiveForm::begin(['type' => ActiveForm::TYPE_HORIZONTAL]);
//$form = ActiveForm::begin();
  echo $form->field($model, 'awpb_template_id')->hiddenInput(['value'=> $model->awpb_template_id])->label(false);
          //  echo $form->field($model, 'component_id')->hiddenInput(['value'=>$model->component_id])->label(false);
           // echo $form->field($model, 'output_id')->hiddenInput(['value'=>$model->output_id])->label(false);
            //echo $form->field($model, 'activity_id')->hiddenInput(['value'=>$model->activity_id])->label(false);
            //echo $form->field($model, 'indicator_id')->hiddenInput(['value'=>$model->indicator_id])->label(false);  
?>
<div class="card card-success card-outline">

    <div class="card-body">
        <?php
            
             echo $form->field($model, 'name')->textInput(['maxlength' => true, 'class' => "form-control", 'placeholder' => 'Description', 'disabled' => true])->label("Inputdescription");
      
        /*echo  $form->field($model, 'unit_cost', ['enableAjaxValidation' => false])->widget(MaskMoney::classname(), [
            'pluginOptions' => [
                'allowZero' => false,
                'allowNegative' => false,
            ]
        ])->label("Unit Cost");
        */
            
            ?>
        <div class="form-group row mb-0">
            <?= Html::activeLabel($model, 'mo_1', ['label' => 'Quarter One', 'class' => 'col-sm-2 col-form-label'])

            ?>
            <div class="col-sm-3">
                <?= $form->field($model, 'mo_1', ['enableAjaxValidation' => false])->textInput(['maxlength' => true, 'placeholder' => 'Enter quantity'])  ->label("Jan");
                //$form->field($model, 'from_date',['showLabels'=>false])->textInput(['placeholder'=>'From Date'])->hint('Enter begin date'); 
                ?>




            </div>
            <div class="col-sm-3">
                <?=
                $form->field($model, 'mo_2', ['enableAjaxValidation' => false])->textInput(['maxlength' => true, 'placeholder' => 'Enter quantity'])
                    ->label("Feb");
                // $form->field($model, 'to_date',['showLabels'=>false])->textInput(['placeholder'=>'To Date'])->hint('Enter end date'); 
                ?>
            </div>


            <div class="col-sm-3">
                <?= $form->field($model, 'mo_3', ['enableAjaxValidation' => false])->textInput(['maxlength' => true, 'placeholder' => 'Enter quantity'])
                    ->label("Mar");

                //$form->field($model, 'begin_date',['showLabels'=>false])->textInput(['placeholder'=>'Begin Date']); 
                ?>
            </div>

        </div>


        <div class="form-group row mb-0">
            <?= Html::activeLabel($model, 'mo_4', ['label' => 'Quarter Two', 'class' => 'col-sm-2 col-form-label'])

            ?>
            <div class="col-sm-3">
                <?= $form->field($model, 'mo_4', ['enableAjaxValidation' => false])->textInput(['maxlength' => true, 'placeholder' => 'Enter quantity'])
                    ->label("Apr");


                //$form->field($model, 'from_date',['showLabels'=>false])->textInput(['placeholder'=>'From Date'])->hint('Enter begin date'); 
                ?>
            </div>
            <div class="col-sm-3">
                <?=
                $form->field($model, 'mo_5', ['enableAjaxValidation' => false])->textInput(['maxlength' => true, 'placeholder' => 'Enter quantity'])
                    ->label("May");
                // $form->field($model, 'to_date',['showLabels'=>false])->textInput(['placeholder'=>'To Date'])->hint('Enter end date'); 
                ?>
            </div>
            <div class="col-sm-3">
                <?=
                $form->field($model, 'mo_6', ['enableAjaxValidation' => false])->textInput(['maxlength' => true, 'placeholder' => 'Enter quantity'])
                    ->label("Jun");
                // $form->field($model, 'to_date',['showLabels'=>false])->textInput(['placeholder'=>'To Date'])->hint('Enter end date'); 
                ?>
            </div>

        </div>


        <div class="form-group row mb-0">
            <?= Html::activeLabel($model, 'mo_7', ['label' => 'Quarter Three', 'class' => 'col-sm-2 col-form-label'])

            ?>
            <div class="col-sm-3">
                <?= $form->field($model, 'mo_7', ['enableAjaxValidation' => false])->textInput(['maxlength' => true, 'placeholder' => 'Enter quantity'])
                    ->label("Jul");


                //$form->field($model, 'from_date',['showLabels'=>false])->textInput(['placeholder'=>'From Date'])->hint('Enter begin date'); 
                ?>
            </div>
            <div class="col-sm-3">
                <?=
                $form->field($model, 'mo_8', ['enableAjaxValidation' => false])->textInput(['maxlength' => true, 'placeholder' => 'Enter quantity'])
                    ->label("Aug");
                // $form->field($model, 'to_date',['showLabels'=>false])->textInput(['placeholder'=>'To Date'])->hint('Enter end date'); 
                ?>
            </div>
            <div class="col-sm-3">
                <?=
                $form->field($model, 'mo_9', ['enableAjaxValidation' => false])->textInput(['maxlength' => true, 'placeholder' => 'Enter quantity'])
                    ->label("Sep");
                // $form->field($model, 'to_date',['showLabels'=>false])->textInput(['placeholder'=>'To Date'])->hint('Enter end date'); 
                ?>
            </div>

        </div>

        <div class="form-group row mb-0">
            <?= Html::activeLabel($model, 'mo_10', ['label' => 'Quarter Four', 'class' => 'col-sm-2 col-form-label'])

            ?>
            <div class="col-sm-3">
                <?= $form->field($model, 'mo_10', ['enableAjaxValidation' => false])->textInput(['maxlength' => true, 'placeholder' => 'Enter quantity'])
                    ->label("Oct");


                //$form->field($model, 'from_date',['showLabels'=>false])->textInput(['placeholder'=>'From Date'])->hint('Enter begin date'); 
                ?>
            </div>
            <div class="col-sm-3">
                <?=
                $form->field($model, 'mo_11', ['enableAjaxValidation' => false])->textInput(['maxlength' => true, 'placeholder' => 'Enter quantity'])
                    ->label("Nov");
                // $form->field($model, 'to_date',['showLabels'=>false])->textInput(['placeholder'=>'To Date'])->hint('Enter end date'); 
                ?>
            </div>
            <div class="col-sm-3">
                <?=
                $form->field($model, 'mo_12', ['enableAjaxValidation' => false])->textInput(['maxlength' => true, 'placeholder' => 'Enter quantity'])
                    ->label("Dec");
                // $form->field($model, 'to_date',['showLabels'=>false])->textInput(['placeholder'=>'Enter quantity'])->hint('Enter quantity'); 
                ?>
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