<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AwpbFundsRequisition */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="awpb-funds-requisition-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'component_id')->textInput() ?>

    <?= $form->field($model, 'output_id')->textInput() ?>

    <?= $form->field($model, 'activity_id')->textInput() ?>

    <?= $form->field($model, 'awpb_template_id')->textInput() ?>

    <?= $form->field($model, 'indicator_id')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'unit_cost')->textInput() ?>

    <?= $form->field($model, 'mo_1')->textInput() ?>

    <?= $form->field($model, 'mo_2')->textInput() ?>

    <?= $form->field($model, 'mo_3')->textInput() ?>

    <?= $form->field($model, 'mo_4')->textInput() ?>

    <?= $form->field($model, 'mo_5')->textInput() ?>

    <?= $form->field($model, 'mo_6')->textInput() ?>

    <?= $form->field($model, 'mo_7')->textInput() ?>

    <?= $form->field($model, 'mo_8')->textInput() ?>

    <?= $form->field($model, 'mo_9')->textInput() ?>

    <?= $form->field($model, 'mo_10')->textInput() ?>

    <?= $form->field($model, 'mo_11')->textInput() ?>

    <?= $form->field($model, 'mo_12')->textInput() ?>

    <?= $form->field($model, 'quarter_one_quantity')->textInput() ?>

    <?= $form->field($model, 'quarter_two_quantity')->textInput() ?>

    <?= $form->field($model, 'quarter_three_quantity')->textInput() ?>

    <?= $form->field($model, 'quarter_four_quantity')->textInput() ?>

    <?= $form->field($model, 'total_quantity')->textInput() ?>

    <?= $form->field($model, 'mo_1_amount')->textInput() ?>

    <?= $form->field($model, 'mo_2_amount')->textInput() ?>

    <?= $form->field($model, 'mo_3_amount')->textInput() ?>

    <?= $form->field($model, 'mo_4_amount')->textInput() ?>

    <?= $form->field($model, 'mo_5_amount')->textInput() ?>

    <?= $form->field($model, 'mo_6_amount')->textInput() ?>

    <?= $form->field($model, 'mo_7_amount')->textInput() ?>

    <?= $form->field($model, 'mo_8_amount')->textInput() ?>

    <?= $form->field($model, 'mo_9_amount')->textInput() ?>

    <?= $form->field($model, 'mo_10_amount')->textInput() ?>

    <?= $form->field($model, 'mo_11_amount')->textInput() ?>

    <?= $form->field($model, 'mo_12_amount')->textInput() ?>

    <?= $form->field($model, 'quarter_one_amount')->textInput() ?>

    <?= $form->field($model, 'quarter_two_amount')->textInput() ?>

    <?= $form->field($model, 'quarter_three_amount')->textInput() ?>

    <?= $form->field($model, 'quarter_four_amount')->textInput() ?>

    <?= $form->field($model, 'total_amount')->textInput() ?>

    <?= $form->field($model, 'mo_1_actual')->textInput() ?>

    <?= $form->field($model, 'mo_2_actual')->textInput() ?>

    <?= $form->field($model, 'mo_3_actual')->textInput() ?>

    <?= $form->field($model, 'mo_4_actual')->textInput() ?>

    <?= $form->field($model, 'mo_5_actual')->textInput() ?>

    <?= $form->field($model, 'mo_6_actual')->textInput() ?>

    <?= $form->field($model, 'mo_7_actual')->textInput() ?>

    <?= $form->field($model, 'mo_8_actual')->textInput() ?>

    <?= $form->field($model, 'mo_9_actual')->textInput() ?>

    <?= $form->field($model, 'mo_10_actual')->textInput() ?>

    <?= $form->field($model, 'mo_11_actual')->textInput() ?>

    <?= $form->field($model, 'mo_12_actual')->textInput() ?>

    <?= $form->field($model, 'quarter_one_actual')->textInput() ?>

    <?= $form->field($model, 'quarter_two_actual')->textInput() ?>

    <?= $form->field($model, 'quarter_three_actual')->textInput() ?>

    <?= $form->field($model, 'quarter_four_actual')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'number_of_females')->textInput() ?>

    <?= $form->field($model, 'number_of_males')->textInput() ?>

    <?= $form->field($model, 'number_of_young_people')->textInput() ?>

    <?= $form->field($model, 'number_of_not_young_people')->textInput() ?>

    <?= $form->field($model, 'number_of_women_headed_households')->textInput() ?>

    <?= $form->field($model, 'number_of_non_women_headed_households')->textInput() ?>

    <?= $form->field($model, 'number_of_household_members')->textInput() ?>

    <?= $form->field($model, 'number_of_females_actual')->textInput() ?>

    <?= $form->field($model, 'number_of_males_actual')->textInput() ?>

    <?= $form->field($model, 'number_of_young_people_actual')->textInput() ?>

    <?= $form->field($model, 'number_of_not_young_people_actual')->textInput() ?>

    <?= $form->field($model, 'number_of_women_headed_households_actual')->textInput() ?>

    <?= $form->field($model, 'number_of_non_women_headed_households_actual')->textInput() ?>

    <?= $form->field($model, 'number_of_household_members_actual')->textInput() ?>

    <?= $form->field($model, 'cost_centre_id')->textInput() ?>

    <?= $form->field($model, 'camp_id')->textInput() ?>

    <?= $form->field($model, 'district_id')->textInput() ?>

    <?= $form->field($model, 'province_id')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
