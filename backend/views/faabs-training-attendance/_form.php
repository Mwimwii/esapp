<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\date\DatePicker;
use kartik\widgets\TimePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\MeFaabsTrainingAttendanceSheet */
/* @var $form yii\widgets\ActiveForm */
?>



<?php $form = ActiveForm::begin(); ?>
<div class="row">
    <div class="col-lg-4">
        <?=
                $form->field($model, "faabs_group_id", ['enableAjaxValidation' => true])
                ->dropDownList(
                        \backend\models\MeFaabsGroups::getListByCampIds(), ['custom' => true, 'prompt' => 'Select FaaBS group', 'required' => true]
        );
        ?>

    </div>
    <div class="col-lg-4">
        <?=
                $form->field($model, "farmer_id", ['enableAjaxValidation' => true])
                ->dropDownList(\backend\models\MeFaabsCategoryAFarmers::getActiveFarmers(), ['custom' => true, 'prompt' => 'Select farmer name', 'required' => true]
        );
        ?>
    </div>
    <div class="col-lg-4">
        <?=
                $form->field($model, "household_head_type", ['enableAjaxValidation' => true])
                ->dropDownList(['Female headed' => "Female headed", "Male headed" => "Male headed"], ['custom' => true, 'prompt' => 'Select household head type', 'required' => true]
        );
        ?>

    </div>

    <div class="col-lg-6">
        <?= $form->field($model, 'topic')->textInput(['placeholder' => 'Enter training course(Topic)']) ?>
    </div>
    <div class="col-lg-6">
        <?= $form->field($model, 'facilitators')->textInput(['placeholder' => 'Enter facilitators']) ?>
    </div>
    <div class="col-lg-4">
        <?= $form->field($model, 'partner_organisations')->textInput(['placeholder' => 'Enter partner organisations']) ?>
    </div>
    <div class="col-lg-4">
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
    </div>
    <div class="col-lg-4">
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
    </div>

    <div class="col-lg-12 form-group">
        <hr class="dotted short">
        <?= Html::submitButton('<span class="text-xs">Save record</span>', ['class' => 'btn btn-success btn-xs']) ?>
    </div>
</div>
<?php ActiveForm::end(); ?>


