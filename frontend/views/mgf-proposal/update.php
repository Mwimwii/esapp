<?php

use backend\models\Districts;
use backend\models\Provinces;
use kartik\form\ActiveForm;
use kartik\widgets\DatePicker;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use frontend\models\MgfOperation;
/* @var $this yii\web\View */
/* @var $model frontend\models\MgfProposal */
/* @var $form yii\widgets\ActiveForm */
$this->title = "Update Project Proposal";
?>

<div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-7">
        <h2><?= Html::encode($this->title) ?></h2>
        <?php $form = ActiveForm::begin(); ?>
        <?php if($applicant->applicant_type=="Category-B"){?>
            <?= $form->field($model, 'project_title')->textInput(['maxlength' => true,'disabled'=>true]) ?>
            <?= $form->field($model, 'any_experience')->dropDownList([ 'YES' => 'YES', 'NO' => 'NO', ], ['prompt' => 'SELECT','required'=>true]);?>
            (If Yes, provide an overview of past experience/ If No, state the relationship with current operation)
            <?= $form->field($model, 'experience_response')->textarea(['rows' => 4]) ?>
            <?= $form->field($model, 'province_id')->dropDownList(ArrayHelper::map(Provinces::find()->all(),'id','name'),['disabled'=>true]);?>
            <?= $form->field($model, 'district_id')->dropDownList(ArrayHelper::map(Districts::find()->all(),'id','name'),['disabled'=>true]);?>
            <?= $form->field($model, 'project_length')->dropDownList(['1' => '1 Year', '2' => '2 Years','3'=>'3 Years','4'=>'4 Years','5' => '5 Years', '6' => '6 Years','7'=>'7 Years','8'=>'8 Years'],['disabled'=>true]) ?>
            <?= $form->field($model, 'project_operations')->dropDownList(ArrayHelper::map(MgfOperation::find()->all(),'operation_type','operation_type'),['disabled'=>true]);?>
        <?php }else{ ?>
            <?= $form->field($model, 'project_title')->textInput(['maxlength' => true,'required'=>true]) ?>
            <?= $form->field($model, 'province_id')->dropDownList(ArrayHelper::map(Provinces::find()->all(),'id','name'),['disabled'=>true]);?>
            <?= $form->field($model, 'district_id')->dropDownList(ArrayHelper::map(Districts::find()->all(),'id','name'),['disabled'=>true]);?>
            <?= $form->field($model, 'starting_date')->widget(DatePicker::className(),['pluginOptions' => ['autoclose'=>true,'format' => 'yyyy-mm-dd']]);?>
            <?= $form->field($model, 'project_length')->dropDownList(['1' => '1 Year', '2' => '2 Years','3'=>'3 Years','4'=>'4 Years','5' => '5 Years', '6' => '6 Years','7'=>'7 Years','8'=>'8 Years'],['disabled'=>true]) ?>
            <?= $form->field($model, 'project_operations')->dropDownList(ArrayHelper::map(MgfOperation::find()->all(),'operation_type','operation_type'),['prompt' => 'SELECT','required'=>true]);?>
        <?php } ?>
            <?= $form->field($model, 'any_experience')->dropDownList([ 'YES' => 'YES', 'NO' => 'NO', ], ['prompt' => 'SELECT','required'=>true]);?>
            (If Yes, provide an overview of past experience/ If No, state the relationship with current operation)
            <?= $form->field($model, 'experience_response')->textarea(['rows' => 4]) ?>
            (What is the main problem that the proposed project will address in relation to the existing operation?)
            <?= $form->field($model, 'problem_statement')->textarea(['rows' => 6]) ?>
            (Provide the overall objective of the proposed project - please relate this to the problem statement above and objectives of E-SAPP)
            <?= $form->field($model, 'overall_objective')->textarea(['rows' => 6]) ?>
            <div class="form-group">
                <?= Html::a('<i class="glyphicon glyphicon-backward"></i>Back', ['/mgf-applicant/profile',], ['class' => 'btn btn-default']);?>
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
        <div class="col-md-1"></div>
</div>
