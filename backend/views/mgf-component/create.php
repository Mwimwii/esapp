<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = 'Create Component for '.$proposal->project_title;
?>

<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <h3> <strong></strong></h3>
        
        <h2>Inputs Required (by Component(s), Activities and Items of Cost)</h2>
    </div>

    <div class="col-md-2"></div>
</div>

<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-5">
        <h3> <strong></strong></h3>
        
       
        <h3><?= Html::encode($this->title) ?></h3>
            <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($model, 'component_name')->textInput() ?>
            <div class="form-group">
            <?= Html::a('<i class="glyphicon glyphicon-backward"></i>Back', ['/mgf-component/components'], ['class' => 'btn btn-default'])?>
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>
            </div>

    <div class="col-md-3"></div>
</div>




