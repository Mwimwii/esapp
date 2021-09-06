<?php

use yii\helpers\Html;
//use yii\bootstrap4\ActiveForm;
use borales\extensions\phoneInput\PhoneInput;
use kartik\form\ActiveForm;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use common\models\Role;
/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Create MGF Reviewer';
?>
 <h3><?= Html::encode($this->title) ?></h3>
<?php
    
    $form = ActiveForm::begin(['type' => ActiveForm::TYPE_VERTICAL, 'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL]]);
?>
<hr class="dotted short">
<div class="row">
    <?php
    //For other user types
   
        echo '<div class="col-md-6">';
        echo $form->field($model, 'first_name')->textInput(['maxlength' => true, 'class' => "form-control", 'placeholder' => 'First name'])->label("First name");
        echo $form->field($model, 'last_name')->textInput(['maxlength' => true, 'class' => "form-control", 'placeholder' => 'Last name'])->label("Last name");
        echo $form->field($model, 'title')->dropDownList([ 'Mr.' => 'Mr.', 'Mrs.' => 'Mrs.', 'Ms.' => 'Ms.', 'Miss.' => 'Miss.', 'Dr.' => 'Dr.', 'Prof.' => 'Prof.', 'Rev.' => 'Rev.', ], ['prompt' => 'SELECT','required'=>true]);    
        echo $form->field($model, 'user_type')->dropDownList([ 'Internal' => 'Internal', 'External' => 'External', ], ['prompt' => 'SELECT'])->label("Reviewer Type");
        echo '</div>
    <div class="col-md-6">';
        echo $form->field($model, 'nrc', ['enableAjaxValidation' => true])->textInput(['maxlength' => true, 'placeholder' => 'NRC i.e. 100000/10/1']);

        echo "<label class='label' for='phone'>Phone</label>";
        echo $form->field($model, 'phone')->widget(PhoneInput::className(), [
            'jsOptions' => ['allowExtensions' => true,'preferredCountries' => ['ZM'],]],
            ['maxlength' => true, 'id' => "phone"])->label(false);
        echo $form->field($model, 'email', ['enableAjaxValidation' => true])->textInput(['maxlength' => true, 'type' => 'email', 'placeholder' => 'email address', 'required' => true])->label("Email");
        echo '</div>
        <div class="form-group col-lg-12">';
        echo Html::a('<i class="f fa-backward"></i>Back', ['index'], ['class' => 'btn btn-default']);
        echo Html::submitButton('Save', ['class' => 'btn btn-success btn-sm']);
        echo '</div>';
    ?>

</div>
<?php ActiveForm::end(); ?>
