<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\number\NumberControl;

/* @var $this yii\web\View */
/* @var $model backend\models\LogframeOutreachPersonsYoung */
/* @var $form yii\widgets\ActiveForm */
$Baseline_young = 0;
$Baseline_not_young = 0;
$mid_target_not_young = 0;
$mid_target_young = 0;
$end_target_not_young = 0;
$end_target_young = 0;
$young_programme_targets_model = \backend\models\LogframeProgrammeTargets::findOne(['record_type' => "Young - Number", 'indicator' => "Persons receiving services promoted or supported by the project"]);
$not_young_programme_targets_model = \backend\models\LogframeProgrammeTargets::findOne(['record_type' => "Not Young - Number", 'indicator' => "Persons receiving services promoted or supported by the project"]);
if (!empty($young_programme_targets_model)) {
    $Baseline_young = $young_programme_targets_model->baseline;
    $mid_target_young = $young_programme_targets_model->mid_term;
    $end_target_young = $young_programme_targets_model->end_target;
}
if (!empty($not_young_programme_targets_model)) {
    $Baseline_not_young = $not_young_programme_targets_model->baseline;
    $mid_target_not_young = $not_young_programme_targets_model->mid_term;
    $end_target_not_young = $not_young_programme_targets_model->end_target;
}
?>
<p>
<ol>
    <li><label>Indicator:</label>  Persons receiving services promoted or supported by the project</li>
    <li>
        Log framework Programme target - Young numbers
        <ul>
            <?php
            echo '<strong>Baseline: </strong>' . $Baseline_young . ', <strong>Mid-term: </strong>' . $mid_target_young . ", <strong>End target: </strong>" . $end_target_young;
            ?>
        </ul>
    </li>
    <li>
        Log framework Programme target - Not Young numbers
        <ul>
            <?php
            echo '<strong>Baseline: </strong>' . $Baseline_not_young . ', <strong>Mid-term: </strong>' . $mid_target_not_young . ", <strong>End target: </strong>" . $end_target_not_young;
            ?>
        </ul>
    </li>
</ol>
<hr class="dotted"/>
</p>


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
                $form->field($model, "young_not_young", ['enableAjaxValidation' => true])
                ->dropDownList(['Young' => "Young", "Not Young" => "Not Young"],
                        ['custom' => true, 'prompt' => 'Select type', 'required' => true]
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
    <div class="col-lg-4">
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
