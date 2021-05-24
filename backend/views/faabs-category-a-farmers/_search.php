<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\MeFaabsCategoryAFarmersSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="me-faabs-category-afarmers-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'faabs_group_id') ?>

    <?= $form->field($model, 'first_name') ?>

    <?= $form->field($model, 'other_names') ?>

    <?= $form->field($model, 'last_name') ?>

    <?php // echo $form->field($model, 'sex') ?>

    <?php // echo $form->field($model, 'dob') ?>

    <?php // echo $form->field($model, 'nrc') ?>

    <?php // echo $form->field($model, 'marital_status') ?>

    <?php // echo $form->field($model, 'contact_number') ?>

    <?php // echo $form->field($model, 'relationship_to_household_head') ?>

    <?php // echo $form->field($model, 'registration_date') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'household_size') ?>

    <?php // echo $form->field($model, 'village') ?>

    <?php // echo $form->field($model, 'chiefdom') ?>

    <?php // echo $form->field($model, 'block') ?>

    <?php // echo $form->field($model, 'zone') ?>

    <?php // echo $form->field($model, 'commodity') ?>

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
