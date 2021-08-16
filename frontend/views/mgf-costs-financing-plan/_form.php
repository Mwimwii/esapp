<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\MgfComponent;
use backend\models\MgfActivity;
use backend\models\MgfInputItem;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfCostsFinancingPlan */
/* @var $form yii\widgets\ActiveForm */

// $components = ArrayHelper::map(MgfComponent::find()->groupBy('component_no')->all(), 'id', 'component_name');
// $activities = ArrayHelper::map(MgfActivity::find()->groupBy('activity_no')->all(), 'id', 'activity_name');
// $inputs = ArrayHelper::map(MgfInputItem::find()->all(), 'id', 'input_name');
?>

<div class="mgf-costs-financing-plan-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'input_name')->textInput(['maxlength' => true,]) ?>

    <?= $form->field($model, 'Applicant_in_kind')->textInput(['maxlength' => true,]) ?>

    <?= $form->field($model, 'Applicant_in_cash')->textInput(['maxlength' => true,]) ?>

    <?= $form->field($model, 'mgf_grant')->textInput(['maxlength' => true,]) ?>

    <?= $form->field($model, 'other_sources')->textInput(['maxlength' => true,]) ?>

    <div class="form-group">

    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    <?= Html::a('<i class="fa fa-backward"></i>Back', ['/mgf-costs-financing-plan/index',], ['class' => 'btn btn-default']);?>
    
    <?php ActiveForm::end(); ?>

</div>
