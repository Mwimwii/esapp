
<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\date\DatePicker;
use kartik\widgets\TimePicker;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\MeFaabsTrainingAttendanceSheet */
/* @var $form yii\widgets\ActiveForm */
?>



<?php $form = ActiveForm::begin(); ?>
<div class="row">
    <div class="col-lg-6">
        <?php
        echo $form->field($model, "faabs_group_id", ['enableAjaxValidation' => true])
                ->dropDownList(
                        \backend\models\MeFaabsGroups::getListByCampIds(), ['custom' => true, 'id' => 'faabs_id', 'prompt' => 'Select FaaBS group', 'required' => true]
        );
        echo Html::hiddenInput('selected_id', $model->isNewRecord ? '' : $model->farmer_id, ['id' => 'selected_id']);

        echo $form->field($model, 'farmer_id', ['enableAjaxValidation' => true])->widget(DepDrop::classname(), [
            'options' => ['id' => 'farm_id', 'custom' => true, 'required' => TRUE],
            'pluginOptions' => [
                'depends' => ['faabs_id'],
                'initialize' => $model->isNewRecord ? false : true,
                'placeholder' => 'Please select a farmer',
                'url' => Url::to(['/faabs-groups/farmers']),
                'params' => ['selected_id'],
            ]
        ]);

        echo $form->field($model, 'topic', ['enableAjaxValidation' => true])->widget(DepDrop::classname(), [
            'options' => ['id' => 'topic_id', 'custom' => true, 'required' => TRUE],
            'pluginOptions' => [
                'depends' => ['farm_id', 'faabs_id'],
                'initialize' => $model->isNewRecord ? false : true,
                'placeholder' => 'Please select a topic',
                'url' => Url::to(['/faabs-groups/topics']),
                'params' => ['selected_id'],
            ]
        ]);
        ?>
        <?php
        /*  $form->field($model, "training_type", ['enableAjaxValidation' => true])
          ->dropDownList(
          [
          'Participants under Direct/Intensive Training [Stream 1]' => "Participants under Direct/Intensive Training [Stream 1]",
          "Participants under non-Direct/Other Training [Stream 2]" => "Participants under non-Direct/Other Training [Stream 2]"
          ], ['custom' => true, 'prompt' => 'Select training type', 'required' => true]
          ); */
        ?>

        <?= $form->field($model, 'facilitators')->textInput(['placeholder' => 'Enter facilitators']) ?>

    </div>

    <div class="col-lg-6">
        <?php
        /* $form->field($model, 'topic')->multiselect(\backend\models\MeFaabsTrainingTopics::getList(), [
          'selector' => 'radio',
          'height' => "200px"
          ]); */
        ?>

        <?=
        $form->field($model, "training_date", ['enableAjaxValidation' => true])->widget(DatePicker::classname(), [
            'options' => ['placeholder' => 'Enter training date i.e. YYYY-MM-DD', 'maxlength' => true,],
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd',
                'startView' => 'year',
                'todayHighlight' => TRUE
            ]
        ]);
        ?>
        <?=
        $form->field($model, 'duration')->widget(TimePicker::classname(),
                [
                    'options' => [
                        'readonly' => true,
                    ],
                    'pluginOptions' => [
                        //  'showSeconds' => true,
                        'showMeridian' => false,
                    //  'minuteStep' => 1,
                    //   'secondStep' => 5,
                    ],
                    'addonOptions' => [
                        'asButton' => true,
                        'buttonOptions' => ['class' => 'btn btn-success']
                    ]
        ]);
        ?>
        <?= $form->field($model, 'partner_organisations')->textInput(['placeholder' => 'Enter partner organisations']) ?>
        <?=
                $form->field($model, "household_head_type", ['enableAjaxValidation' => true])
                ->dropDownList(['Female headed' => "Female headed", "Male headed" => "Male headed"], ['custom' => true, 'prompt' => 'Select household head type', 'required' => false]
        );
        ?>
    </div>

    <div class="col-lg-12 form-group">
        <hr class="dotted short">
        <?= Html::submitButton('<span class="text-xs">Save record</span>', ['class' => 'btn btn-success btn-xs']) ?>
    </div>
</div>
<?php ActiveForm::end(); ?>