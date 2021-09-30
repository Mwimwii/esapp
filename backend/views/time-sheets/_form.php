<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\touchspin\TouchSpin;

/* @var $this yii\web\View */
/* @var $model backend\models\TimeSheetsDistrictStaff */
/* @var $form yii\widgets\ActiveForm */

$months = [
    "January" => "January", "February" => "February", "March" => "March", "April" => "April",
    "May" => "May", "June" => "June",
    "July" => "July", "August" => "August", "September" => "September",
    "October" => "October", "November" => "November", "December" => "December"
];

$model->month = empty($model->month) ? date("F") : $model->month;
$model->designation = !empty($model->designation) ? $model->rate_id:"";
?>

<div class="time-sheets-district-staff-form">

    <?php $form = ActiveForm::begin(['tooltipStyleFeedback' => false,]); ?>
    <hr class="dotted">
    <div class="row">
        <div class="col-lg-6 form-group">
            <?=
                    $form->field($model, "month", ['enableAjaxValidation' => true])
                    ->dropDownList($months,
                            ['custom' => true, 'prompt' => 'Select month', 'required' => true,
                            // 'value' => date("F")
                            ]
            );
            ?>
            <?=
                    $form->field($model, "year", ['enableAjaxValidation' => true])
                    ->dropDownList(\backend\models\CommodityPriceCollection::getYearsList(),
                            ['custom' => true, 'prompt' => 'Select year', 'required' => true,
                                'value' => date("Y")]
            );
            ?>

            <?=
            $form->field($model, 'hours_field_esapp_activities', ['enableAjaxValidation' => true])->widget(TouchSpin::classname(), [
                'options' => [],
                'pluginOptions' => [
                    'min' => 0,
                    'max' => 24,
                ],
            ]);
            ?>

            <?=
            $form->field($model, 'hours_office_esapp_activities', ['enableAjaxValidation' => true])->widget(TouchSpin::classname(), [
                'options' => [],
                'pluginOptions' => [
                    'min' => 0,
                    'max' => 24,
                ],
            ]);
            ?>
        </div>
        <div class="col-lg-6 form-group">
            <?=
                    $form->field($model, "designation", [])
                    ->dropDownList(\backend\models\HourlyRates::getDesignations(),
                            ['custom' => true, 'prompt' => 'Select Designation-Salary scale', 'required' => true,
                            // 'value' => date("F")
                            ]
            );
            ?>
            <?= $form->field($model, 'activity_description')->textarea(['rows' => 7.5]) ?>
        </div>
        <div class="col-lg-12 form-group">
            <?php //Html::submitButton('Save as draft', ['class' => 'btn bg-gradient-success btn-xs', 'name' => "save as draft"]) ?>
            <?= Html::submitButton('Submit for approval', ['class' => 'btn bg-gradient-success btn-xs','name' => "submit for review", 'value' => 'true']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
