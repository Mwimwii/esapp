<?php
use kartik\helpers\Html;
//use yii\helpers\Html;
//use yii\widgets\ActiveForm;
//use yii\bootstrap4\ActiveForm;
use borales\extensions\phoneInput\PhoneInput;
use kartik\form\ActiveForm;
use backend\models\AwpbComponent;
use yii\helpers\ArrayHelper;

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
  <div class="col-md-6">


  <?php

$data = \backend\models\AwpbActivity::find()->orderBy(['name' => SORT_ASC])
->where(['parent_activity_id'=>null])
->all();
$list = ArrayHelper::map($data, 'id','name');


       $model->icons=$list;
var_dump($model->icons);
      // echo $form->field($model, 'activities')->multiselect($model->icons);

      echo $form->field($model, 'activities')->checkboxList(ArrayHelper::map(\backend\models\AwpbActivity::getActivities(), 'right', 'right'), [
        'item' => function($index, $label, $name, $checked, $value) {
            $checked = $checked ? 'checked' : '';
            return "<label class='bt-df-checkbox col-lg-3' > <input type='checkbox' {$checked} name='{$name}' value='{$value}'> {$label} </label>";
        }
        , 'separator' => ' ', 'required' => true])->label(false)
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

</div>

 


