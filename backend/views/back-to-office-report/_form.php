<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\daterange\DateRangePicker;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\MeBackToOfficeReport */
/* @var $form yii\widgets\ActiveForm */
/* if (empty($model->name_of_officer)) {
  $_model = \backend\models\User::findOne(Yii::$app->user->identity->id);
  $model->name_of_officer = $_model->first_name . " " . $_model->other_name . " " . $_model->last_name;
  } */
?>

<div class="me-back-to-office-report-form">

    <?php $form = ActiveForm::begin(['tooltipStyleFeedback' => false,]); ?>
    <hr class="dotted">
    <div class="row">

        <?php
        $_model = \backend\models\User::findOne(Yii::$app->user->identity->id);
        $model->name_of_officer = $_model->first_name . " " . $_model->other_name . " " . $_model->last_name;

        echo $form->field($model, 'name_of_officer')->hiddenInput()->label(false);
//$form->field($model, 'name_of_officer')->textInput(['maxlength' => true]);
        ?>


        <div class="col-lg-6 form-group">
            <?php
            echo $form->field($model, 'travel_dates', [
                'enableAjaxValidation' => true,
                'addon' => ['prepend' => ['content' => '<i class="fa fa-calendar"></i>']],
                'options' => ['class' => 'drp-container form-group']
            ])->widget(DateRangePicker::classname(), [
                'useWithAddon' => true,
                'convertFormat' => true,
                'startAttribute' => 'start_date',
                'endAttribute' => 'end_date',
                'options' => ['placeholder' => 'Select travel date range'],
                'pluginOptions' => [
                    'locale' => [
                        'format' => 'yy-m-d',
                        'separator' => ' to ',
                    ],
                    'autoclose' => true,
                    'opens' => 'bottom'
                ]
            ])->label("Travel dates");
            ?>

        </div>
        <div class="col-lg-6 form-group">
            <?php
            echo $form->field($model, 'team_members')->widget(Select2::classname(), [
                'data' => \backend\models\User::getUsers(),
                'options' => ['placeholder' => 'Select a team member ...', 'multiple' => true],
                'theme' => Select2::THEME_MATERIAL,
                'size' => Select2::SMALL,
                'pluginOptions' => [
                    'tags' => true,
                    'tokenSeparators' => [','],
                    'maximumInputLength' => 10
                ],
            ])->label("Team members")->hint("Use commas to separate team members");

            /* echo $form->field($model, 'team_members')->widget(Select2::classname(), [
              'data' => \backend\models\User::getUsers(),
              'options' => ['placeholder' => 'Select team members....', 'custom' => true, 'multiple' => true],
              'theme' => Select2::THEME_MATERIAL,
              'size' => Select2::SMALL,
              'pluginOptions' => [
              'allowClear' => true,
              'tags' => true,
              //'multiple' => true
              ],
              ]); */
            ?>
        </div>
        <div class="col-lg-6 form-group">
            <?=
            $form->field($model, 'key_partners')->widget(\yii\redactor\widgets\Redactor::className(),
                    [
                        'clientOptions' => [
                            'plugins' => ['clips', 'fontcolor', 'imagemanager']
                        ]
            ])->label("Key partners");
            ?>
        </div>
        <div class="col-lg-6 form-group">
            <?=
            $form->field($model, 'purpose_of_assignment', ['enableAjaxValidation' => true,])->widget(\yii\redactor\widgets\Redactor::className(),
                    [
                        'clientOptions' => [
                            'plugins' => ['clips', 'fontcolor', 'imagemanager']
                        ]
            ])->label("Purpose of assignment");
            ?>
        </div>
        <div class="col-lg-6 form-group">
            <?=
            $form->field($model, 'summary_of_assignment_outcomes', ['enableAjaxValidation' => true,])->widget(\yii\redactor\widgets\Redactor::className(),
                    [
                        'clientOptions' => [
                            'plugins' => ['clips', 'fontcolor', 'imagemanager']
                        ]
            ])->label("Summary of assignment outcomes");
            ?>
        </div>
        <div class="col-lg-6 form-group">
            <?=
            $form->field($model, 'key_findings', ['enableAjaxValidation' => true,])->widget(\yii\redactor\widgets\Redactor::className(),
                    [
                        'clientOptions' => [
                            'plugins' => ['clips', 'fontcolor', 'imagemanager']
                        ]
            ])->label("Key findings");
            ?>
        </div>
        <div class="col-lg-6 form-group">
            <?=
            $form->field($model, 'key_recommendations', ['enableAjaxValidation' => true,])->widget(\yii\redactor\widgets\Redactor::className(),
                    [
                        'clientOptions' => [
                            'plugins' => ['clips', 'fontcolor', 'imagemanager']
                        ]
            ])->label("Key recommendations");
            ?>
        </div>
        <div class="col-lg-6 form-group">
            <?php
            /*$form->field($model, 'annexes')->widget(\yii\redactor\widgets\Redactor::className(),
                    [
                        'clientOptions' => [
                            'plugins' => ['clips', 'fontcolor', 'imagemanager']
                        ]
            ])->label("Annexes");*/
            ?>
        </div>

        <div class="col-lg-12 form-group">
            <?= Html::submitButton('Save as draft', ['class' => 'btn bg-gradient-success btn-xs', 'name' => "save as draft"]) ?>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <?= Html::submitButton('Submit for review', ['class' => 'btn bg-gradient-info btn-xs', 'name' => "submit for review", 'value' => 'true']) ?>
        </div>

    </div>
    <?php ActiveForm::end(); ?>

</div>