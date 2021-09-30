<?php

use yii\helpers\Html;;
use borales\extensions\phoneInput\PhoneInput;
use kartik\form\ActiveForm;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model backend\models\AwpbComment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="awpb-comment-form">

    <?php 
        $form = ActiveForm::begin(['type' => ActiveForm::TYPE_VERTICAL, 'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL],'options' => ['enctype' => 'multipart/form-data']]);
        //$form = ActiveForm::begin(); 
        echo $form->field($model, 'awpb_template_id')->hiddenInput(['value'=>'2022' ])->label(false);
        echo $form->field($model, 'district_id')->hiddenInput(['value'=> '49'])->label(false);
        echo $form->field($model, 'province_id')->hiddenInput(['value'=> $id])->label(false);
        ?>
        
        <div class="row">
            <div class="col-md-8">

              
                <?= $form->field($model, 'description')->textarea(['rows' => 11, 'placeholder' =>
                    'Type the reason for declining the budget'.$id])->label("Comment");?>
            </div>
            
            <div class="col-lg-4">
                <h4>Instructions</h4>
                <ol>
                    <?php
                    echo '<li>Fields marked with * are required</li>';
                    
                    ?>
                </ol>
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
