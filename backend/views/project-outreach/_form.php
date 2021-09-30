<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\helpers\Url;
use kartik\number\NumberControl;

/* @var $this yii\web\View */
/* @var $model backend\models\ProjectOutreach */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-outreach-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-lg-6">
            <?=
            $form->field($model, 'sub_component', [
            ])->dropDownList(
                    [
                        "2.1: Strategic Linkages of Graduating Subsistence Farmers" => '2.1: Strategic Linkages of Graduating Subsistence Farmers',
                        "2.2: Enhancing Agro-Micro, Small & Medium Enterprises" => '2.2: Enhancing Agro-Micro, Small & Medium Enterprises',
                        "2.3: Facilitating Pro-Smallholder Market-Pull Agribusiness" => '2.3: Facilitating Pro-Smallholder Market-Pull Agribusiness',
                    ], [
                'custom' => true,
                'prompt' => 'Please select a sub-component',
                'required' => true,
                    ]
            );
            ?>
            <?=
                    $form->field($model, "year", ['enableAjaxValidation' => true])
                    ->dropDownList(\backend\models\CommodityPriceCollection::getYearsList(),
                            ['custom' => true, 'prompt' => 'Select year', 'required' => true,
                                'value' => date("Y")]
                    )->label("Year");
            ?>

            <?=
            $form->field($model, 'quarter', [
            ])->dropDownList(
                    [
                        1 => 'Quarter one',
                        2 => 'Quarter two',
                        3 => 'Quarter three',
                        4 => 'Quarter four',
                    ], [
                'custom' => true,
                'prompt' => 'Please select a Quarter',
                'required' => true,
                    ]
            );
            ?>

            <?=
            $form->field($model, 'number_females', ['enableAjaxValidation' => true])->widget(NumberControl::classname(), [
                'maskedInputOptions' => [
                    // 'prefix' => '$ ',
                    'suffix' => ' Females',
                    'allowMinus' => false,
                    'digits' => 0,
                    'min' => 0,
                ],
            ]);
            ?>
            <?=
            $form->field($model, 'number_males', ['enableAjaxValidation' => true])->widget(NumberControl::classname(), [
                'maskedInputOptions' => [
                    // 'prefix' => '$ ',
                    'suffix' => ' Males',
                    'allowMinus' => false,
                    'digits' => 0,
                    'min' => 0,
                ],
            ]);
            ?>
        </div>
        <div class="col-lg-6">
            <?=
            $form->field($model, 'number_young', ['enableAjaxValidation' => true])->widget(NumberControl::classname(), [
                'maskedInputOptions' => [
                    // 'prefix' => '$ ',
                    'suffix' => ' Young',
                    'allowMinus' => false,
                    'digits' => 0,
                    'min' => 0,
                ],
            ]);
            ?>
            <?=
            $form->field($model, 'number_not_young', ['enableAjaxValidation' => true])->widget(NumberControl::classname(), [
                'maskedInputOptions' => [
                    // 'prefix' => '$ ',
                    'suffix' => ' Not Young',
                    'allowMinus' => false,
                    'digits' => 0,
                    'min' => 0,
                ],
            ]);
            ?>
            <?=
            $form->field($model, 'number_women_headed_households', ['enableAjaxValidation' => true])->widget(NumberControl::classname(), [
                'maskedInputOptions' => [
                    // 'prefix' => '$ ',
                    'suffix' => ' Women headed households',
                    'allowMinus' => false,
                    'digits' => 0,
                    'min' => 0,
                ],
            ]);
            ?>
            <?=
            $form->field($model, 'number_non_women_headed_households', ['enableAjaxValidation' => true])->widget(NumberControl::classname(), [
                'maskedInputOptions' => [
                    // 'prefix' => '$ ',
                    'suffix' => ' Non women headed households',
                    'allowMinus' => false,
                    'digits' => 0,
                    'min' => 0,
                ],
            ]);
            ?>
            <?=
            $form->field($model, 'number_household_members', ['enableAjaxValidation' => true])->widget(NumberControl::classname(), [
                'maskedInputOptions' => [
                    // 'prefix' => '$ ',
                    'suffix' => ' Household members',
                    'allowMinus' => false,
                    'digits' => 0,
                    'min' => 0,
                ],
            ]);
            ?>
        </div>

        <div class="col-lg-12 form-group">
            <?= Html::submitButton('Save record', ['class' => 'btn btn-success btn-sm']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
