<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\MgfApproval;
$this->title="Add Final Comment";
?>
<div class="mgf-application-form" style="width:40%">
<h3><?= Html::encode($this->title)?></h3>


<?php $form = ActiveForm::begin(); ?>
<?php
$approval=MgfApproval::find();
?>
<?= $form->field($model, 'application_status')->textarea(['maxlength' => true]) ?>
<<<<<<< HEAD
=======

>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
    <div class="form-group">
    <?= Html::a('<i class="glyphicon glyphicon-backward"></i>Back', ['mgf-organisation/open','id'=>$model->organisation_id], ['class' => 'btn btn-default'])?>
        <?= Html::submitButton('Submit', ['class' => 'btn btn-success']) ?>
    </div>
<?php ActiveForm::end(); ?>
</div>