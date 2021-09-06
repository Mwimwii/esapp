<?php

use yii\helpers\ArrayHelper;
use backend\models\MgfPosition;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfContact */

$this->title = 'Update Contact';
?>

<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
    <h3><?= Html::encode($this->title) ?></h3>
    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'tel_no')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'physical_address')->textarea(['maxlength' => true]) ?>

        <?= $form->field($model, 'position_id')->dropDownList(
            ArrayHelper::map(MgfPosition::find()->all(),'id','position'),
            ['prompt'=>'Position']
        ) ?>

        <div class="form-group">
        <?= Html::a('<i class="glyphicon glyphicon-backward"></i>Back', ['/mgf-organisation/view','id'=>$model->organisation_id], ['class' => 'btn btn-default'])?>
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

    <?php ActiveForm::end(); ?>
        
    </div>
    <div class="col-md-3"></div>
</div>

