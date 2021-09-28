<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = "Update Component";

?>

<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
<h3><?= Html::encode($this->title) ?></h3>
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'component_no')->textInput(['disabled'=>true]) ?>
    <?= $form->field($model, 'component_name')->textInput() ?>

    <div class="form-group">
    <?= Html::a('<i class="glyphicon glyphicon-backward"></i>Back', ['index'], ['class' => 'btn btn-default'])?>
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
    
    </div>
    <div class="col-md-3"></div>
</div>
