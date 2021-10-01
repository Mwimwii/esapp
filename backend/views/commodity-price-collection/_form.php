<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use kartik\money\MaskMoney;

/* @var $this yii\web\View */
/* @var $model backend\models\CommodityPriceCollection */
/* @var $form yii\widgets\ActiveForm */

$js = 'jQuery(".dynamicform_wrapper").on("afterInsert", function(e, item) {

    jQuery(".dynamicform_wrapper .card-title-address").each(function(index) {

        jQuery(this).html("Commodity price row: " + (index + 1))

    });
});
jQuery(".dynamicform_wrapper").on("afterDelete", function(e) {

    jQuery(".dynamicform_wrapper .card-title-address").each(function(index) {

        jQuery(this).html("Commodity price row: " + (index + 1))

    });

});';

$this->registerJs($js);

$months = [
    1 => "Jan", 2 => "Feb", 3 => "Mar", 4 => "Apr", 5 => "May", 6 => "Jun",
    7 => "Jul", 8 => "Aug", 9 => "Sep", 10 => "Oct", 11 => "Nov", 12 => "Dec"
];
?>






<?php
$form = ActiveForm::begin(['id' => 'dynamic-form']);
DynamicFormWidget::begin([
    'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
    'widgetBody' => '.container-items', // required: css class selector
    'widgetItem' => '.item', // required: css class
    'limit' => 4, // the maximum times, an element can be cloned (default 999)
    'min' => 0, // 0 or 1 (default 1)
    'insertButton' => '.add-item', // css class
    'deleteButton' => '.remove-item', // css class
    'model' => $modelForm[0],
    'formId' => 'dynamic-form',
    'formFields' => [
        'market_id',
        'commodity_type_id',
        'price_level_id',
        'unit_of_measure',
        'price',
        'month',
        'year',
    ],
]);
?>

<div class="card-tools pull-right">
    <button type="button" class="add-item btn btn-success btn-xs">
        <i class="fa fa-plus"></i> Add record row</button>
</div>
<hr class="dotted short">
<div class="container-items"><!-- widgetContainer -->
    <?php foreach ($modelForm as $index => $modelprice): ?>
        <div class="item card card-success card-outline"><!-- widgetBody -->
            <div class="card-header">
                <span class="card-title-address">Commodity price: <?= ($index + 1) ?></span>
                <div class="card-tools">
                    <button type="button" class="pull-right remove-item btn btn-tool btn-xs">
                        <i class="fas fa-times"></i>
                    </button>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="card-body">
                <?php
                if (!$modelprice->isNewRecord) {
                    echo Html::activeHiddenInput($modelprice, "[{$index}]id");
                }
                ?>
                <div class="row">
                    <div class="col-lg-2">
                        <?=
                                $form->field($modelprice, "[{$index}]market_id", ['enableAjaxValidation' => true])
                                ->dropDownList(
                                        \backend\models\Markets::getByDistrict(Yii::$app->getUser()->identity->district_id), ['custom' => true, 'prompt' => 'Select market', 'required' => true]
                        );
                        ?>

                    </div>
                    <div class="col-lg-2">
                        <?=
                                $form->field($modelprice, "[{$index}]commodity_type_id", ['enableAjaxValidation' => true])
                                ->dropDownList(\backend\models\CommodityTypes::getList(), ['custom' => true, 'prompt' => 'Select commodity', 'required' => true]
                        );
                        ?>
                    </div>
                    <div class="col-lg-2">
                        <?=
                                $form->field($modelprice, "[{$index}]price_level_id", ['enableAjaxValidation' => true])
                                ->dropDownList(\backend\models\CommodityPriceLevels::getList(), ['custom' => true, 'prompt' => 'Select price level', 'required' => true]
                        );
                        ?>
                    </div>
                    <div class="col-lg-2">
                        <?=
                                $form->field($modelprice, "[{$index}]unit_of_measure", ['enableAjaxValidation' => true])->textInput(['maxlength' => true, "placeholder" => "i.e. 10KG, 2KG etc"])
                                ->label("Unit of measure");
                        ?>
                    </div>
                    <div class="col-lg-2">
                        <?=
                        $form->field($modelprice, "[{$index}]price", ['enableAjaxValidation' => true])->widget(MaskMoney::classname(), [
                            'pluginOptions' => [
                                'allowZero' => false,
                                'allowNegative' => false,
                            ]
                        ])->label("Price");
                        ?>
                    </div>
                    <div class="col-lg-1">
                        <?=
                                $form->field($modelprice, "[{$index}]year", ['enableAjaxValidation' => true])
                                ->dropDownList(\backend\models\CommodityPriceCollection::getYearsList(),
                                        ['custom' => true, 'prompt' => 'Select year', 'required' => true,
                                            'value' => date("Y")]
                        );
                        ?>
                    </div>
                    <div class="col-lg-1">
                        <?=
                                $form->field($modelprice, "[{$index}]month", ['enableAjaxValidation' => true])
                                ->dropDownList($months,
                                        ['custom' => true, 'prompt' => 'Select month', 'required' => true,
                                            'value' => date("m")]
                        );
                        ?>
                    </div>

                </div>


            </div>
        </div>

    <?php endforeach; ?>
</div>

<?php DynamicFormWidget::end(); ?>
<div class="form-group col-lg-12">
    <?= Html::submitButton('Save prices', ['class' => 'btn btn-success btn-sm']) ?>
</div>
<?php ActiveForm::end(); ?>

