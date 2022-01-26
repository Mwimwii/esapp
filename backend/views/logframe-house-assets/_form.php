<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\number\NumberControl;

/* @var $this yii\web\View */
/* @var $model backend\models\LogframeHouseAssets */
/* @var $form yii\widgets\ActiveForm */
?>


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
                $form->field($model, "asset", ['enableAjaxValidation' => true])
                ->dropDownList(\backend\models\LogframeHouseAssets::ASSETS_TYPES,
                        ['custom' => true, 'prompt' => 'Select Asset Type', 'required' => true]
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
    <div class="col-lg-7">
        <h4>Instructions</h4>
        <ol>
            <li>Add/Update record for <label>Indicator:</label> Increase in household assets</li>
            <li>Fields marked with <code>*</code> are required</li>
        </ol>
    </div>
    <div class="form-group col-lg-12">
        <?= Html::submitButton('Save record', ['class' => 'btn btn-success btn-sm']) ?>
    </div>
</div>
<?php ActiveForm::end(); ?>