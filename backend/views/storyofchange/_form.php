<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $model backend\models\Storyofchange */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">
    <div class="col-lg-6">
        <?php $form = ActiveForm::begin(); ?>

        <?=
                $form->field($model, 'category_id')
                ->dropDownList(
                        backend\models\LkmStoryofchangeCategory::getList(), ['custom' => true, 'prompt' => 'Select story category', 'required' => true]
        );
        ?>
        <?=
        $form->field($model, 'title', ['enableAjaxValidation' => true])->textInput(['maxlength' => true, 'placeholder' =>
            'Title of story', 'required' => true,])
        ?>
        <?=
        $form->field($model, 'interviewee_names', ['enableAjaxValidation' => true])->textInput(['maxlength' => true, 'placeholder' =>
            'Names of the person who was being interviewed', 'required' => true,])
        ?>
        <?=
        $form->field($model, 'interviewer_names', ['enableAjaxValidation' => true])->textInput(['maxlength' => true, 'placeholder' =>
            'Names of the person who was doing the interview', 'required' => true,])
        ?>
        <?=
        $form->field($model, 'date_interviewed', ['enableAjaxValidation' => true])->widget(DatePicker::classname(), [
            'options' => ['placeholder' => 'Enter date interview was conducted'],
            'pluginOptions' => [
                'autoclose' => true,
                'todayHighlight' => true,
                'startView' => 'year',
                'format' => 'yyyy-mm-dd'
            ]
        ])->label("Date of interview");
        ?>

        <?php /* $form->field($model, 'introduction')->textarea(['rows' => 6]) 

          $form->field($model, 'challenge')->textarea(['rows' => 6])
          $form->field($model, 'actions')->textarea(['rows' => 6])

          $form->field($model, 'results')->textarea(['rows' => 6])

          $form->field($model, 'conclusions')->textarea(['rows' => 6])

          $form->field($model, 'sequel')->textarea(['rows' => 6])

          $form->field($model, 'status')->textInput()

          $form->field($model, 'paio_review_status')->textInput()

          $form->field($model, 'paio_comments')->textarea(['rows' => 6])

          $form->field($model, 'ikmo_review_status')->textInput() ?>

          $form->field($model, 'ikmo_comments')->textarea(['rows' => 6])

          $form->field($model, 'created_at')->textInput()

          $form->field($model, 'updated_at')->textInput()

          $form->field($model, 'created_by')->textInput()

          $form->field($model, 'updated_by')->textInput() */ ?>
    </div>
    <div class="form-group col-lg-12">
        <?= Html::submitButton('Save story', ['class' => 'btn btn-success btn-sm']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
