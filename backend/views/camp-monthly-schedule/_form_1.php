<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\number\NumberControl;

/* @var $this yii\web\View */
/* @var $model backend\models\MeCampSubprojectRecordsPlannedWorkEffort */
/* @var $form yii\widgets\ActiveForm */
$max_days = date('t');

?>

<div class="me-camp-subproject-records-planned-work-effort-form">

    <?php
    $form = ActiveForm::begin([
              //  'action' => 'work-effort',
              //  'enableAjaxValidation' => true,
                    // 'enableClientValidation' => true,
            ])
    ?>
    <div class="row">
        <div class="col-lg-5">


            <?php
            echo
                    $form->field($model, 'camp_id', ['enableAjaxValidation' => true])
                    ->dropDownList(
                            \backend\models\Camps::getListByDistrictId(Yii::$app->user->identity->district_id), ['prompt' => 'Please select a camp', 'required' => true]
            );
            ?>
            <?php
            echo $form->field($model, 'days_office', ['enableAjaxValidation' => true])->widget(NumberControl::classname(), [
                'maskedInputOptions' => [
                    // 'prefix' => '$ ',
                    'suffix' => ' days',
                    'allowMinus' => false,
                    'min' => 0,
                    'max' => $max_days
                ],
            ]);
            ?>
            <?php
            echo $form->field($model, 'days_field', ['enableAjaxValidation' => true])->widget(NumberControl::classname(), [
                'maskedInputOptions' => [
                    // 'prefix' => '$ ',
                    'suffix' => ' days',
                    'allowMinus' => false,
                    'digits' => 0,
                    'min' => 0,
                    'max' => $max_days
                ],
            ]);
            ?>
            <?php
            echo $form->field($model, 'days_other_non_esapp_activities', ['enableAjaxValidation' => true])->widget(NumberControl::classname(), [
                'maskedInputOptions' => [
                    // 'prefix' => '$ ',
                    'suffix' => ' days',
                    'allowMinus' => false,
                    'digits' => 0,
                    'min' => 0,
                    'max' => $max_days
                ],
            ]);
            ?>
            <div class="justify-content-between">
                <?= Html::submitButton('Save work effort', ['class' => 'btn btn-success btn-xs']) ?>

            </div>
        </div>
        <div class="col-lg-7">
            <h5>Instructions</h5>
            <ol>
                <li>Fields marked with <i style="color: red;">*</i> are required</span>
                </li>
                <!--<li>If you do not see a camp in the dropdown it means you have already added a record for this month</span>
                </li>-->
                <li>The Total days for <?php echo date("F"); ?> is <?php echo date("t"); ?>
                </li>
                <li>The sum of (Days office + Days field + Days non-esapp activities) cannot exceed the total days in a month 
                </li>
                <li>You will only be able to add planned activities after adding the work effort
                </li>
            </ol>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
