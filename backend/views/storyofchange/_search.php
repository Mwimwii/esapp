<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\StoryofchangeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="storyofchange-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'category_id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'interviewee_names') ?>

    <?= $form->field($model, 'interviewer_names') ?>

    <?php // echo $form->field($model, 'date_interviewed') ?>

    <?php // echo $form->field($model, 'introduction') ?>

    <?php // echo $form->field($model, 'challenge') ?>

    <?php // echo $form->field($model, 'actions') ?>

    <?php // echo $form->field($model, 'results') ?>

    <?php // echo $form->field($model, 'conclusions') ?>

    <?php // echo $form->field($model, 'sequel') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'paio_review_status') ?>

    <?php // echo $form->field($model, 'paio_comments') ?>

    <?php // echo $form->field($model, 'ikmo_review_status') ?>

    <?php // echo $form->field($model, 'ikmo_comments') ?>

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
