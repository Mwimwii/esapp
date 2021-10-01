<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AwpbTemplateActivitySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="awpb-template-activity-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'activity_id') ?>

<<<<<<< HEAD
    <?= $form->field($model, 'component_id') ?>

    <?= $form->field($model, 'outcome_id') ?>

    <?= $form->field($model, 'output_id') ?>
=======
    <?= $form->field($model, 'activity_code') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'component_id') ?>

    <?php // echo $form->field($model, 'outcome_id') ?>

    <?php // echo $form->field($model, 'output_id') ?>
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d

    <?php // echo $form->field($model, 'awpb_template_id') ?>

    <?php // echo $form->field($model, 'funder_id') ?>

    <?php // echo $form->field($model, 'expense_category_id') ?>

<<<<<<< HEAD
=======
    <?php // echo $form->field($model, 'ifad') ?>

    <?php // echo $form->field($model, 'ifad_grant') ?>

    <?php // echo $form->field($model, 'grz') ?>

    <?php // echo $form->field($model, 'beneficiaries') ?>

    <?php // echo $form->field($model, 'private_sector') ?>

    <?php // echo $form->field($model, 'iapri') ?>

    <?php // echo $form->field($model, 'parm') ?>

    <?php // echo $form->field($model, 'access_level_district') ?>

    <?php // echo $form->field($model, 'access_level_province') ?>

    <?php // echo $form->field($model, 'access_level_programme') ?>

>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
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
