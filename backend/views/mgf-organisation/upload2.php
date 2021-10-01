<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfAttachements */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Upload Eligibility Minutes';
?>

<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
    <h3><?= Html::encode($this->title) ?></h3>
        <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>
                <?= $form->field($model, 'minutes')->fileInput() ?>
            <div class="form-group">
                <?=Html::a('<i class="fa fa-backward"></i>Back', ['applications2','status'=>0], ['class' => 'btn btn-default']);?>
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>
        <?php ActiveForm::end(); ?>

    </div>
    <div class="col-md-3"></div>
</div>
