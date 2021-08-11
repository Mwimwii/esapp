<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
use frontend\models\MgfOperation;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfConceptNote */
/* @var $form yii\widgets\ActiveForm */
?>

<style>
        .style{
            width: 350px;
            display: inline-block;
        }
    </style>

<div class="mgf-concept-note-form" style="width:50%">

    <?php $form = ActiveForm::begin(); ?>

    <div class="style">
        <?= $form->field($model, 'project_title')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="style">
        <?= $form->field($model, 'estimated_cost')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="style">
        <?= $form->field($model, 'implimentation_period')->dropDownList([ '1' => '1 Year', '2' => '2 Years','3' => '3 Years', '4' => '5 Years' ], ['prompt' => 'SELECT','required'=>true]) ?>
    </div>

    <div class="style">
    <?= $form->field($model, 'operation_id')->dropDownList(
        ArrayHelper::map(MgfOperation::find()->all(),'id','operation_type'),
        ['prompt'=>'Operational Type']
    ) ?>
    </div>

    
    <?= $form->field($model, 'starting_date')->widget(DatePicker::className(), ['clientOptions' => ['autoclose' => true,'format' => 'yyyy-mm-dd']]);?>


    <?= $form->field($model, 'other_operation_type')->textarea(['rows' => 5]) ?>

    <div class="form-group">
        <?= Html::a('<i class="glyphicon glyphicon-backward"></i>Back', ['index'], ['class' => 'btn btn-default'])?>
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
