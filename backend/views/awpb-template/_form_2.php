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
       
    $list = [1 => 'Quarter One', 2 => 'Quarter Two', 3 => 'Quarter Three',4 => 'Quarter Four'];
 
        /* Display a stacked checkbox list */
        echo $form->field($model, 'quarter')->radioList($list);
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

 


