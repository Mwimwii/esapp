<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\number\NumberControl;

/* @var $this yii\web\View */
/* @var $model backend\models\LogframeHouseAssets */
/* @var $form yii\widgets\ActiveForm */
$Baseline_cat_a = 0;
$Baseline_cat_b = 0;
$Baseline_cat_c = 0;

$mid_target_cat_a = 0;
$mid_target_cat_b = 0;
$mid_target_cat_c = 0;

$end_target_cat_a = 0;
$end_target_cat_b = 0;
$end_target_cat_c = 0;

$cat_a_programme_targets_model = \backend\models\LogframeProgrammeTargets::findOne(['record_type' => "Category A Gross Value - ZMW", 'indicator' => "Annual gross value of all farm sales (crops & livestock) by smallholder HHs to buyers (ZMW)"]);
$cat_b_programme_targets_model = \backend\models\LogframeProgrammeTargets::findOne(['record_type' => "Category B Gross Value - ZMW", 'indicator' => "Annual gross value of all farm sales (crops & livestock) by smallholder HHs to buyers (ZMW)"]);
$cat_c_programme_targets_model = \backend\models\LogframeProgrammeTargets::findOne(['record_type' => "Category C Gross Value - ZMW", 'indicator' => "Annual gross value of all farm sales (crops & livestock) by smallholder HHs to buyers (ZMW)"]);
if (!empty($cat_a_programme_targets_model)) {
    $Baseline_cat_a = $cat_a_programme_targets_model->baseline;
    $mid_target_cat_a = $cat_a_programme_targets_model->mid_term;
    $end_target_cat_a = $cat_a_programme_targets_model->end_target;
}
if (!empty($cat_b_programme_targets_model)) {
    $Baseline_cat_b = $cat_b_programme_targets_model->baseline;
    $mid_target_cat_b = $cat_b_programme_targets_model->mid_term;
    $end_target_cat_b = $cat_b_programme_targets_model->end_target;
}
if (!empty($cat_c_programme_targets_model)) {
    $Baseline_cat_c = $cat_c_programme_targets_model->baseline;
    $mid_target_cat_c = $cat_c_programme_targets_model->mid_term;
    $end_target_cat_c = $cat_c_programme_targets_model->end_target;
}
?>

<p>
<ol>
    <li><label>Indicator:</label>  Annual gross value of all farm sales (crops & livestock) by smallholder HHs to buyers (ZMW)</li>
    <li>
        Log framework Programme target - Category A ZMW
        <ul>
            <?php
            echo '<strong>Baseline: </strong>' . $Baseline_cat_a . ', <strong>Mid-term: </strong>' . $mid_target_cat_a . ", <strong>End target: </strong>" . $end_target_cat_a;
            ?>
        </ul>
    </li>
    <li>
        Log framework Programme target - Category B ZMW
        <ul>
            <?php
            echo '<strong>Baseline: </strong>' . $Baseline_cat_b . ', <strong>Mid-term: </strong>' . $mid_target_cat_b . ", <strong>End target: </strong>" . $end_target_cat_b;
            ?>
        </ul>
    </li>
    <li>
        Log framework Programme target - Category C ZMW
        <ul>
            <?php
            echo '<strong>Baseline: </strong>' . $Baseline_cat_c . ', <strong>Mid-term: </strong>' . $mid_target_cat_c . ", <strong>End target: </strong>" . $end_target_cat_c;
            ?>
        </ul>
    </li>
</ol>
<hr class="dotted"/>
</p>
<?php $form = ActiveForm::begin(); ?>
<div class="row">
    <div class="col-lg-5">
        <?=
                $form->field($model, "year", ['enableAjaxValidation' => true])
                ->dropDownList(\backend\models\CommodityPriceCollection::getYearsList(),
                        ['custom' => true, 'prompt' => 'Select year', 'required' => true]
        );
        ?>
        <?=
                $form->field($model, "category", ['enableAjaxValidation' => true])
                ->dropDownList(\backend\models\LogframeHouseAssets::CATEGORIES,
                        ['custom' => true, 'prompt' => 'Select Category', 'required' => true]
        );
        ?>
        <?=
        $form->field($model, 'yr_target', ['enableAjaxValidation' => true])->widget(NumberControl::classname(), [
            'maskedInputOptions' => [
                 'prefix' => 'ZMW ',
               // 'suffix' => '',
                'allowMinus' => false,
                'min' => 0,
                'max' => 10000000
            ],
        ])->label("Year target");
        ?>
        <?=
        $form->field($model, 'yr_results', ['enableAjaxValidation' => true])->widget(NumberControl::classname(), [
            'maskedInputOptions' => [
                'prefix' => 'ZMW ',
                //'suffix' => '',
                'allowMinus' => false,
                'min' => 0,
                'max' => 10000000
            ],
        ])->label("Year result");
        ?>
    </div>
    <div class="col-lg-7">
        <h4>Instructions</h4>
        <ol>
            <li>Fields marked with <code>*</code> are required</li>
        </ol>
    </div>
    <div class="form-group col-lg-12">
        <?= Html::submitButton('Save record', ['class' => 'btn btn-success btn-sm']) ?>
    </div>
</div>
<?php ActiveForm::end(); ?>