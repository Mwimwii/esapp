<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LogframeOutputPeopleTrainedClimateSensitiveServicesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="logframe-output-people-trained-climate-sensitive-services-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'year') ?>

    <?= $form->field($model, 'indicator') ?>

    <?= $form->field($model, 'yr_target') ?>

    <?= $form->field($model, 'yr_results') ?>

    <?php // echo $form->field($model, 'people_type') ?>

    <?php // echo $form->field($model, 'cumulative') ?>

    <?php // echo $form->field($model, 'cumulative_percentage') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
