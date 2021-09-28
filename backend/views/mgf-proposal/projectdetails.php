<?php

use backend\models\Districts;
use backend\models\Provinces;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\MgfApplicant;
use dosamigos\datepicker\DatePicker;
use frontend\models\MgfOperation;
/* @var $this yii\web\View */
/* @var $model frontend\models\MgfProposal */
/* @var $form yii\widgets\ActiveForm */
?>

    <style>
        .style{
            width: 320px;
            display: inline-block;
        }
    </style>

<div class="mgf-proposal-form" style="width:50%">
<h2><?= Html::encode($this->title) ?></h2>
   

</div>


<div class="row">
    <h3><?= Html::encode($this->title) ?></h3>
        <div class="col-md-2"></div>
        <div class="col-md-7">
        <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($model, 'project_title')->textInput(['maxlength' => true,'required'=>true]) ?>
            <?= $form->field($model, 'province_id')->dropDownList(ArrayHelper::map(Provinces::find()->all(),'id','name'),['disabled'=>true]);?>
            <?= $form->field($model, 'district_id')->dropDownList(ArrayHelper::map(Districts::find()->all(),'id','name'),['disabled'=>true]);?>
            <?= $form->field($model, 'starting_date')->widget(DatePicker::className(), ['clientOptions' => ['autoclose' => true,'format' => 'yyyy-mm-dd']]);?>
            <?= $form->field($model, 'project_length')->dropDownList(['1' => '1 Year', '2' => '2 Years','3'=>'3 Years','4'=>'4 Years','4'=>'4 Years','6'=>'6 Years'],['required'=>true,'prompt' => 'Project Period']) ?>
            <?= $form->field($model, 'project_operations')->dropDownList(ArrayHelper::map(MgfOperation::find()->all(),'operation_type','operation_type'),['prompt' => 'SELECT','required'=>true]);?>
            <?= $form->field($model, 'any_experience')->dropDownList([ 'YES' => 'YES', 'NO' => 'NO', ], ['prompt' => 'SELECT','required'=>true]);?>
            (If Yes, provide an overview of past experience/ If No, state the relationship with current operation)
            <?= $form->field($model, 'experience_response')->textarea(['rows' => 4]) ?>
            <?= $form->field($model, 'indicate_partnerships')->textarea(['rows' => 6]) ?>
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
