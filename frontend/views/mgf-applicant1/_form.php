<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Districts;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfApplicant */
/* @var $form yii\widgets\ActiveForm */
include("check.php");
?>

<div class="mgf-applicant-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'applicant_type')->dropDownList(['Category-A' => 'Category A', 'Category-B' => 'Category B'], ['prompt' => 'Type of Applicant']) ?>

    <?= $form->field($model, 'district_id')->dropDownList(ArrayHelper::map(Districts::find()->all(),'id','name'),['prompt'=>'District']
    ) ?>

    <div class="form-group">
    <?php if(allowed_to("mgf_view_applicants")){?>
        <?=  Html::a('Back', ['/mgf-applicant/index'], ['class' => 'btn btn-default'])?>
        <?php }else{ ?>
        <?= Html::a('<i class="glyphicon glyphicon-backward"></i>Back', ['/mgf-applicant/profile'], ['class' => 'btn btn-default']) ?>
        <?php }?>
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    
    <?php ActiveForm::end(); ?>

</div>
