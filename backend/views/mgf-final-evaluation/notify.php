<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfProposal */
/* @var $form yii\widgets\ActiveForm */
if ($model->status==4) {
    $this->title="Differe ".$model->proposal->project_title.' for ' .$model->organisation->cooperative;
}else{
    $this->title="Reject ".$model->proposal->project_title.' for ' .$model->organisation->cooperative;
}
?>

<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">

    <div class="mgf-proposal-form">
    <h2><?= Html::encode($this->title) ?></h2>
    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'finalcomment')->textarea(['rows' => 12,'required'=>true]) ?>

    <div class="form-group">
    <?= Html::a('<i class="glyphicon glyphicon-backward"></i>Back', ['evaluations','status'=>4], ['class' => 'btn btn-default']);?>
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

    </div>

    <div class="col-md-3"></div>
</div>
