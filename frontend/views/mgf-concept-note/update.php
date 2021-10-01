<?php

use kartik\widgets\DatePicker;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\MgfOperation;
$this->title = 'Update MGF Concept Note ';
/* @var $this yii\web\View */
/* @var $model frontend\models\MgfConceptNote */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-5">
        <div class="mgf-concept-note-form">
        <h3><?= Html::encode($this->title) ?></h3>
            <?php $form = ActiveForm::begin(); ?>
                <?= $form->field($model, 'project_title')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'estimated_cost')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'implimentation_period')->dropDownList([ '1' => '1 Year', '2' => '2 Years','3' => '3 Years', '4' => '5 Years','6' => '6 Years', '7' => '7 Years','8' => '8 Years', ], ['prompt' => 'SELECT','required'=>true]) ?>
                <?= $form->field($model, 'operation_id')->dropDownList(ArrayHelper::map(MgfOperation::find()->all(),'id','operation_type'),['prompt'=>'Operational Type']) ?>
                <?= $form->field($model, 'starting_date')->widget(DatePicker::className(),['pluginOptions' => ['autoclose'=>true,'format' => 'yyyy-mm-dd']]);?>
                <?= $form->field($model, 'other_operation_type')->textarea(['rows' => 5]) ?>
                <div class="form-group">
                    <?= Html::a('<i class="glyphicon glyphicon-backward"></i>Back', ['/mgf-applicant/profile'], ['class' => 'btn btn-default']);?>
                    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
    <div class="col-md-3"></div>
</div>

