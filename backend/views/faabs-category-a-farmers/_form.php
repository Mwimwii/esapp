<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use borales\extensions\phoneInput\PhoneInput;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\MeFaabsCategoryAFarmers */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="row">
    <div class="col-lg-6">
        <h4>Instructions</h4>
        <ol>
            <li>Fields marked with <span class="text-red">*</span> are required</li>

        </ol>
    </div>
</div>
<hr class="dotted short">
<?php $form = ActiveForm::begin(); ?>
<div class="row">

    <div class="col-lg-6 form-group">


        <?=
                $form->field($model, 'faabs_group_id',['enableAjaxValidation' => true])
                ->dropDownList(
                        \backend\models\MeFaabsGroups::getListByCampIds(), ['prompt' => 'Select farmers FaaBS group', 'required' => true]
        );
        ?>
         <?=
        $form->field($model, 'title')->dropDownList(
                [
                    'Mr.' => 'Mr',
                    'Mrs.' => 'Mrs',
                    'Miss.' => 'Miss',
                    'Ms.' => 'Ms',
                    'Dr.' => 'Dr',
                    'Prof.' => 'Prof'
                ], ['prompt' => 'Select title', 'custom' => true, 'required' => false]
        );
        ?>

        <?= $form->field($model, 'first_name')->textInput(['placeholder' => 'Enter farmers first name', 'maxlength' => true,]) ?>

        <?= $form->field($model, 'other_names')->textInput(['maxlength' => true, 'placeholder' => 'Enter farmers other names',]) ?>

        <?= $form->field($model, 'last_name')->textInput(['placeholder' => 'Enter farmers last name', 'maxlength' => true]) ?>


        <?=
        $form->field($model, 'dob')->widget(DatePicker::classname(), [
            'options' => ['placeholder' => 'Enter farmers date of birth i.e. YYYY-MM-DD', 'maxlength' => true, 'style' => 'width:320px;',],
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd',
                'startView' => 'year',
                'todayHighlight' => TRUE
            ]
        ]);
        ?>

        <?= $form->field($model, 'nrc',['enableAjaxValidation' => true])->textInput(['placeholder' => 'Enter farmers NRC number', 'maxlength' => true]) ?>
        <?= $form->field($model, 'marital_status')->radioList(['Married' => "Married", "Single" => "Single"], ['inline' => true]); ?>
        <?= $form->field($model, 'sex')->radioList(['Male' => "Male", "Female" => "Female"], ['inline' => true]); ?>
       

    </div>
    <div class="col-lg-6 form-group">
        <?=
        $form->field($model, 'contact_number')->widget(PhoneInput::className(), [
            'options' => ['maxlength' => true],
            'jsOptions' => [
                'allowExtensions' => true,
                'preferredCountries' => ['ZM'],
            ]
        ]);
        ?>
        <?=
        $form->field($model, 'registration_date')->widget(DatePicker::classname(), [
            'options' => ['id' => "reg_date", 'placeholder' => 'Enter farmers date of registration i.e. YYYY-MM-DD', 'maxlength' => true, 'style' => 'width:320px;',],
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd',
                'startView' => 'year',
                'todayHighlight' => TRUE
            ]
        ]);
        ?>
        <?= $form->field($model, 'relationship_to_household_head')->textInput(['placeholder' => 'Enter relationship to household head', 'maxlength' => true]) ?>

        <?= $form->field($model, 'household_size')->textInput(['placeholder' => 'Enter farmers household size', 'maxlength' => true]) ?>

        <?= $form->field($model, 'village')->textInput(['placeholder' => 'Enter farmers village', 'maxlength' => true]) ?>

        <?= $form->field($model, 'chiefdom')->textInput(['placeholder' => 'Enter farmers chiefdom', 'maxlength' => true]) ?>

        <?= $form->field($model, 'block')->textInput(['placeholder' => 'Enter farmers block', 'maxlength' => true]) ?>

        <?= $form->field($model, 'zone')->textInput(['placeholder' => 'Enter farmers zone', 'maxlength' => true]) ?>

        <?= $form->field($model, 'commodity')->textInput(['placeholder' => 'Enter farmers commodity', 'maxlength' => true]) ?>
    </div>

    <div class="col-lg-12 form-group">
        <?= Html::submitButton('<span class="text-xs">Save farmer</span>', ['class' => 'btn btn-success btn-sm']) ?>
    </div>



</div>
<?php ActiveForm::end(); ?>
