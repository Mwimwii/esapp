<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfAttachements */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Upload Concept Note Minutes';
?>
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-5">
    <div class="card card-success card-outline">
    <div class="card-body">
        <h3><?= Html::encode($this->title) ?></h3>
        <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>
            <?= $form->field($model, 'certify_remark')->textarea(['rows' => 5,'required'=>true]) ?>
            <?= $form->field($model, 'province_minutes')->fileInput(['required'=>true]) ?>
            <div class="form-group">
                <?= Html::submitButton('<i class="fa fa-thumbs-down"></i>Send Back to District', ['class' => 'btn btn-danger']) ?>
            </div>
        <?php ActiveForm::end(); ?>
    </div>
    </div>
    </div>
    <div class="col-md-3"></div>
</div>

    
