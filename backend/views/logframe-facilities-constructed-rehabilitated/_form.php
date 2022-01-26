<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\number\NumberControl;

/* @var $this yii\web\View */
/* @var $model backend\models\LogframeHouseholdMembers */
/* @var $form yii\widgets\ActiveForm */
$Baseline = 0;
$mid_target = 0;
$end_target = 0;

$programme_targets_model = \backend\models\LogframeProgrammeTargets::findOne([
            'record_type' => "value chain infrastructure - Number",
            'indicator' => "2.1.6 Number of market, processing or storage facilities constructed or rehabilitated"]);
if (!empty($programme_targets_model)) {
    $Baseline = $programme_targets_model->baseline;
    $mid_target = $programme_targets_model->mid_term;
    $end_target = $programme_targets_model->end_target;
}
?>
<ol>
    <li><label>Indicator:</label>2.1.6 Number of market, processing or storage facilities constructed or rehabilitated</li>
    <li>
        Log framework Programme target - Value chain infrastructure - Number
        <ul>
            <?php
            echo '<strong>Baseline: </strong>' . $Baseline . ', <strong>Mid-term: </strong>'
                    . $mid_target . ", <strong>End target: </strong>" . $end_target;
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

