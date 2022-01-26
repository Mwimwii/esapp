<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\number\NumberControl;

/* @var $this yii\web\View */
/* @var $model backend\models\LogframeHouseholdHeadType */
/* @var $form yii\widgets\ActiveForm */

$Baseline_females = 0;
$Baseline_males = 0;
$mid_target_males = 0;
$mid_target_females = 0;
$end_target_males = 0;
$end_target_females = 0;
$females_programme_targets_model = \backend\models\LogframeProgrammeTargets::findOne(['record_type' => "Women-headed households - Number", 'indicator' => "1.a Corresponding number of households reached  "]);
$males_programme_targets_model = \backend\models\LogframeProgrammeTargets::findOne(['record_type' => "Non-women-headed households - Number", 'indicator' => "1.a Corresponding number of households reached  "]);
if (!empty($females_programme_targets_model)) {
    $Baseline_females = $females_programme_targets_model->baseline;
    $mid_target_males = $females_programme_targets_model->mid_term;
    $end_target_males = $females_programme_targets_model->end_target;
}
if (!empty($males_programme_targets_model)) {
    $Baseline_males = $males_programme_targets_model->baseline;
    $mid_target_females = $males_programme_targets_model->mid_term;
    $end_target_females = $males_programme_targets_model->end_target;
}
?>
<ol>
    <li><label>Indicator:</label>  1.a Corresponding number of households reached</li>
    <li>
        Log framework Programme target - Women-headed households - Number
        <ul>
            <?php
            echo '<strong>Baseline: </strong>' . $Baseline_females . ', <strong>Mid-term: </strong>' . $mid_target_females . ", <strong>End target: </strong>" . $end_target_females;
            ?>
        </ul>
    </li>
    <li>
        Log framework Programme target - Non-women-headed households - Number
        <ul>
            <?php
            echo '<strong>Baseline: </strong>' . $Baseline_males . ', <strong>Mid-term: </strong>' . $mid_target_males . ", <strong>End target: </strong>" . $end_target_males;
            ?>
        </ul>
    </li>
</ol>
<hr class="dotted"/>


<?php $form = ActiveForm::begin(); ?>
<div class="row">
    <div class="col-lg-4">
        <?=
                $form->field($model, "year", ['enableAjaxValidation' => true])
                ->dropDownList(\backend\models\CommodityPriceCollection::getYearsList(),
                        ['custom' => true, 'prompt' => 'Select year', 'required' => true]
        );
        ?>
        <?=
                $form->field($model, "headed_type", ['enableAjaxValidation' => true])
                ->dropDownList(['Women headed' => "Women headed", "Non-Women headed" => "Non-Women headed"],
                        ['custom' => true, 'prompt' => 'Select Head Type', 'required' => true]
        );
        ?>
        <?=
        $form->field($model, 'yr_target', ['enableAjaxValidation' => true])->widget(NumberControl::classname(), [
            'maskedInputOptions' => [
                // 'prefix' => '$ ',
                'suffix' => '',
                'allowMinus' => false,
                'min' => 0,
                'max' => 10000000
            ],
        ])->label("Year target");
        ?>
        <?=
        $form->field($model, 'yr_results', ['enableAjaxValidation' => true])->widget(NumberControl::classname(), [
            'maskedInputOptions' => [
                // 'prefix' => '$ ',
                'suffix' => '',
                'allowMinus' => false,
                'min' => 0,
                'max' => 10000000
            ],
        ])->label("Year result");
        ?>
    </div>
    <div class="col-lg-6">
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
