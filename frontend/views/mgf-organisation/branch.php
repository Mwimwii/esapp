<?php

use backend\models\Districts;
use yii\helpers\ArrayHelper;
use frontend\models\MgfPosition;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfContact */

$this->title = 'Update Branch';
?>

<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
    <h3><?= Html::encode($this->title) ?></h3>
    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'address')->textarea(['maxlength' => true]) ?>

        <?= $form->field($model, 'employess')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'district_id')->dropDownList(ArrayHelper::map(Districts::find()->all(),'id','name'),['prompt'=>'SELECT']
        ) ?>

        <div class="form-group">
        <?= Html::a('<i class="fa fa-backward"></i>Back', ['/mgf-organisation/view','id'=>$model->organisation_id], ['class' => 'btn btn-default'])?>
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

    <?php ActiveForm::end(); ?>
        
    </div>
    <div class="col-md-3"></div>
</div>

