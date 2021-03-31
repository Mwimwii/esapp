<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\MeFaabsTrainingTopics */
/* @var $form yii\widgets\ActiveForm */
$data = [
    'Number of smallholders trained in the use of improved production technologies & best practices to enhance productivity that allow production to comply with market requirements (at least 3 improved production technologies facilitated)' => 'Number of smallholders trained in the use of improved production technologies & best practices to enhance productivity that allow production to comply with market requirements (at least 3 improved production technologies facilitated)',
    'Number of smallholders trained in improved Post-harvest technologies (at least 2 improved post-harvest technologies)' => 'Number of smallholders trained in improved Post-harvest technologies (at least 2 improved post-harvest technologies)',
    'Number of smallholders who have been trained in improved pre- and Post-harvest technologies (at least 2 improved post-harvest technologies) to minimize losses and increase market value of their produce' => 'Number of smallholders who have been trained in improved pre- and Post-harvest technologies (at least 2 improved post-harvest technologies) to minimize losses and increase market value of their produce',
    'Number of producer organizations/cooperatives/marketing groups established or strengthened [Strengthening of coordination & business models] ' => 'Number of producer organizations/cooperatives/marketing groups established or strengthened [Strengthening of coordination & business models]',
    'Number of smallholder producers (desegregated by gender) in organizations/cooperatives/marketing groups trained in crucial aspects for inclusion in VC i.e. identification of partnership opportunities, negotiation, market linkages, business management, governance etc [Strengthening of coordination & business models] ' => 'Number of smallholder producers (desegregated by gender) in organizations/cooperatives/marketing groups trained in crucial aspects for inclusion in VC i.e. identification of partnership opportunities, negotiation, market linkages, business management, governance etc [Strengthening of coordination & business models]',
    'Number of local service providers (farm & non-farm) strengthened and/or trained to provide services that allow production to meet market requirements [Strengthening of coordination & business models] ' => 'Number of local service providers (farm & non-farm) strengthened and/or trained to provide services that allow production to meet market requirements [Strengthening of coordination & business models]',
    'C..1.8 Number of Households reached with targeted support to improve their nutrition ' => 'C..1.8 Number of Households reached with targeted support to improve their nutrition',
        ]
?>

<div class="me-faabs-training-topics-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-lg-12">
            <ol>
                <li>Fields marked with <span class="text-red">*</span> are required</li>
            </ol>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'topic', ['enableAjaxValidation' => true])->textarea(['rows' => 4]) ?>
            <?=
                    $form->field($model, "category", ['enableAjaxValidation' => true])
                    ->dropDownList(
                            [
                                'Crops' => 'Crops',
                                'Livestock' => 'Livestock',
                                'Aquaculture' => 'Aquaculture'
                            ], ['custom' => true, 'prompt' => 'Select topic category', 'required' => true]
            );
            ?>
            <?=
                    $form->field($model, "subcomponent", ['enableAjaxValidation' => true])
                    ->dropDownList(
                            [
                                'Sub-component 2.1' => 'Sub-component 2.1',
                                'Sub-component 2.2' => 'Sub-component 2.2'
                            ], ['custom' => true, 'prompt' => 'Select topic sub-component', 'required' => true]
            );
            ?>
        </div>
        <div class="col-lg-8">
            <?php
            echo $form->field($model, 'output_level_indicator')->multiselect($data,
                    [
                        'selector' => 'radio',
                        'height' => 'auto',
                        'container' => ['class' => 'bg-white']
            ]);
            //$form->field($model, 'output_level_indicator')->textarea(['rows' => 6])
            ?>
        </div>
        <div class="col-lg-12 form-group">
            <hr class="dotted short">
            <?= Html::submitButton('Save topic', ['class' => 'btn btn-success']) ?>
        </div>


        <?php ActiveForm::end(); ?>

    </div>
