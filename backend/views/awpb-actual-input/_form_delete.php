<?php

use yii\helpers\Html;
use borales\extensions\phoneInput\PhoneInput;
use kartik\form\ActiveForm;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use kartik\money\MaskMoney;
use yii\widgets\MaskedInput;
use backend\models\User;
$user = User::findOne(['id' => Yii::$app->user->id]);
$_model = \backend\models\AwpbBudget::findOne(['id' => $id]);

$awpb_district =  \backend\models\AwpbDistrict::findOne(['awpb_template_id' =>$_model->awpb_template_id, 'district_id'=>$user->district_id]);
$awpb_province = \backend\models\AwpbProvince::findOne(['awpb_template_id' => $_model->awpb_template_id, 'province_id'=>$awpb_district->province_id]);
$budget = \backend\models\AwpbInput::find()->where(['budget_id'=>$_model->id])->sum('total_amount');

$unsubmitted_input = \backend\models\AwpbActualInput::find()->where(['budget_id'=>$_model->id])->sum('quarter_amount');         
$total=0.0;
$balance=0.0;
                 $funds_requested= 0.0;   
$form = ActiveForm::begin(['type' => ActiveForm::TYPE_HORIZONTAL]);
//$form = ActiveForm::begin();
 
         if($awpb_province->status== \backend\models\AwpbBudget::STATUS_MINISTRY && $awpb_district->status== \backend\models\AwpbBudget::STATUS_MINISTRY ) 
  {
      
      if($awpb_district->status_q_1== \backend\models\AwpbBudget::STATUS_SUBMITTED)
      {
          $funds_requested =+$_model->quarter_one_actual_amount;
      }
       if($awpb_district->status_q_2== \backend\models\AwpbBudget::STATUS_SUBMITTED)
      {
          $funds_requested =+ $_model->quarter_two_actual_amount;
      }
          if($awpb_district->status_q_3== \backend\models\AwpbBudget::STATUS_SUBMITTED)
      {
          $funds_requested =+ $_model->quarter_three_actual_amount;
      }
              if($awpb_district->status_q_4== \backend\models\AwpbBudget::STATUS_SUBMITTED)
      {
          $funds_requested =+ $_model->quarter_four_actual_amount;
      }
     
          $total = $unsubmitted_input + $funds_requested;
                 $balance = $budget -  $total;
  }
                 
?>
<div class="card">

    <div class="card-body">
          <div class="form-group row mb-0">
              <div class="col-sm-10"> <?php
//     echo Html::a('<span class="fas fa-arrow-left fa-2x"></span>',Yii::$app->request->referrer, [
//    'title' => 'back',
//    'data-toggle' => 'tooltip',
//    'data-placement' => 'top',
//]);
     ?></div>
            <div class="col-sm-2">
               <h5><p style='margin:4px; text-align: right;padding:4px;display:inline-block;' class='alert alert-success'> Budget variance <?=
                 Yii::$app->formatter->asDecimal( $balance)?></p></h5><br>
            </div></div>
                <div class="form-group row mb-0">
              <div class="col-sm-8">   
      
        <?=
        $form->field($model, 'name')->textInput(['maxlength' => true, 'class' => "form-control", 'placeholder' => 'Input description'])->label("Input description");
        ?>  
                
        <?=                
                $form->field($model, 'unit_of_measure_id')->dropDownList(
                          \backend\models\AwpbUnitOfMeasure::getAwpbUnitOfMeasuresList(), ['id' => 'unit_of_measure_id', 'custom' => true, 'prompt' => 'Please select a unit of measure', 'required' => false]);          ;
           ?>     
      
        <?=
        $form->field($model, 'unit_cost', ['enableAjaxValidation' => false])->widget(MaskMoney::classname(), [
            'pluginOptions' => [
                'allowZero' => false,
                'allowNegative' => false,
            ]
        ])->label("Unit Cost");
           
      //      if($awpb_district->status_q_1== \backend\models\AwpbBudget::STATUS_DRAFT)
     // {
        ?>
                    <?=
        $form->field($model, 'quarter_number')->dropDownList(
                [
            '1' => 'Quarter 1',
                      '2' => 'Quarter 2',
                      '3' => 'Quarter 3',
                      '4' => 'Quarter 4',
           
                ], [
            'custom' => true,
            'prompt' => 'Please select a quarter',
            'required' => true,
                ]
        );
        ?>
         <?=
            $form->field($model, 'mo_1', ['enableAjaxValidation' => false])->textInput(['maxlength' => true, 'placeholder' => 'Enter quantity'])->label("Month 1");
            //$form->field($model, 'from_date',['showLabels'=>false])->textInput(['placeholder'=>'From Date'])->hint('Enter begin date'); 
            ?>
        <?=
        $form->field($model, 'mo_2', ['enableAjaxValidation' => false])->textInput(['maxlength' => true, 'placeholder' => 'Enter quantity'])
        ->label("Month 2");
// $form->field($model, 'to_date',['showLabels'=>false])->textInput(['placeholder'=>'To Date'])->hint('Enter end date'); 
?>
     <?=
        $form->field($model, 'mo_3', ['enableAjaxValidation' => false])->textInput(['maxlength' => true, 'placeholder' => 'Enter quantity'])
        ->label("Month 3");

//$form->field($model, 'begin_date',['showLabels'=>false])->textInput(['placeholder'=>'Begin Date']); 
?>
                       <?=
        $form->field($model, 'quarter_amount', ['enableAjaxValidation' => false])->textInput(['maxlength' => true, 'placeholder' => 'Enter quantity','disabled' => true])
        ->label("Current Quarter Budget");

//$form->field($model, 'begin_date',['showLabels'=>false])->textInput(['placeholder'=>'Begin Date']); 
?>
  </div>
                          <div class="col-sm-4"> 
                              </div>

        </div>
    <?php
      //}
 
        
       ?>
 <div class="card-footer text-left">
                <?= Html::submitButton('Save', ['class' => ' btn btn-success']) ?>
        </div>
    </div>
        <?= $form->field($model, 'budget_id')->hiddenInput(['value' => $_model->id])->label(false);
        
      
        ?>
    </div></div>
<?php ActiveForm::end(); ?>