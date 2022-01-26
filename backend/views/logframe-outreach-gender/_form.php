<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\number\NumberControl;

/* @var $this yii\web\View */
/* @var $model backend\models\LogframeOutreachPersonsGender */
/* @var $form yii\widgets\ActiveForm */
$Baseline_females = 0;
$Baseline_males = 0;
$mid_target_males = 0;
$mid_target_females = 0;
$end_target_males = 0;
$end_target_females = 0;
$females_programme_targets_model = \backend\models\LogframeProgrammeTargets::findOne(['record_type' => "Females - Number", 'indicator' => "Persons receiving services promoted or supported by the project"]);
$males_programme_targets_model = \backend\models\LogframeProgrammeTargets::findOne(['record_type' => "Males - Number", 'indicator' => "Persons receiving services promoted or supported by the project"]);
if (!empty($females_programme_targets_model)) {
    $Baseline_females = $females_programme_targets_model->baseline;
    $mid_target_females = $females_programme_targets_model->mid_term;
    $end_target_females = $females_programme_targets_model->end_target;
}
if (!empty($males_programme_targets_model)) {
    $Baseline_males = $males_programme_targets_model->baseline;
    $mid_target_males = $males_programme_targets_model->mid_term;
    $end_target_males = $males_programme_targets_model->end_target;
}
?>
<ol>
    <li><label>Indicator:</label>  Persons receiving services promoted or supported by the project</li>
    <li>
        Log framework Programme target - Females number
        <ul>
            <?php
            echo '<strong>Baseline: </strong>' . $Baseline_females . ', <strong>Mid-term: </strong>' . $mid_target_females . ", <strong>End target: </strong>" . $end_target_females;
            ?>
        </ul>
    </li>
    <li>
        Log framework Programme target - Males number
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
                $form->field($model, "gender", ['enableAjaxValidation' => true])
                ->dropDownList(['females' => "Females", "males" => "Males"],
                        ['custom' => true, 'prompt' => 'Select gender', 'required' => true]
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


