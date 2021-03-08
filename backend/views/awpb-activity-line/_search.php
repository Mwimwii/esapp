<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AwpbActivityLineSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="awpb-activity-line-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'activity_id') ?>
    <?= $form->field($model, 'awpb_template_id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'unit_cost') ?>

    <?= $form->field($model, 'mo_1') ?>

    <?php // echo $form->field($model, 'mo_2') ?>

    <?php // echo $form->field($model, 'mo_3') ?>

    <?php // echo $form->field($model, 'mo_4') ?>

    <?php // echo $form->field($model, 'mo_5') ?>

    <?php // echo $form->field($model, 'mo_6') ?>

    <?php // echo $form->field($model, 'mo_7') ?>

    <?php // echo $form->field($model, 'mo_8') ?>

    <?php // echo $form->field($model, 'mo_9') ?>

    <?php // echo $form->field($model, 'mo_10') ?>

    <?php // echo $form->field($model, 'mo_11') ?>

    <?php // echo $form->field($model, 'mo_12') ?>

    <?php // echo $form->field($model, 'quarter_one_quantity') ?>

    <?php // echo $form->field($model, 'quarter_two_quantity') ?>

    <?php // echo $form->field($model, 'quarter_three_quantity') ?>

    <?php // echo $form->field($model, 'quarter_four_quantity') ?>

    <?php // echo $form->field($model, 'total_quantity') ?>

    <?php // echo $form->field($model, 'total_amount') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'district_id') ?>

    <?php // echo $form->field($model, 'province_id') ?>

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
