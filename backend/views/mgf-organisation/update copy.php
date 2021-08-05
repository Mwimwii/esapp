<?php

use yii\helpers\Html;
//use yii\bootstrap4\ActiveForm;
use common\models\Role;
use borales\extensions\phoneInput\PhoneInput;
use kartik\form\ActiveForm;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfOrganisation */

$this->title = 'Update Organisation';
?>
<div class="card card-success card-outline">
<div class="card-body">
<?php $form = ActiveForm::begin(); ?>

<div class="row">
        <div class="col-md-5"></div>
        <div class="col-md-4">
            <h3><?= Html::encode($this->title) ?></h3>
        </div>
        <div class="col-md-1"></div>
    </div>


<div class="row">
    <div class="col-md-2"></div>

    <div class="col-md-4">
        
        <?= $form->field($model, 'cooperative')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'registration_type')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'registration_date')->widget(DatePicker::className(), 
        ['clientOptions' => ['autoclose' => true,'format' => 'yyyy-mm-dd']]);?>

        <?= $form->field($model, 'business_objective')->textarea(['rows' => 4,'required'=>true]) ?>

        <?= $form->field($model, 'email_address')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-md-4">
        <?= $form->field($model, 'acronym')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'registration_no')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'trade_license_no')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'physical_address')->textarea(['maxlength' => true,'rows' => 4]) ?>

        <?= $form->field($model, 'tel_no')->textInput(['maxlength' => true]) ?>

    </div>
        
    <div class="col-md-1"></div>
    </div>

    <div class="row">
        <div class="col-md-5"></div>
        <div class="col-md-4">
            <?= Html::a('<i class="glyphicon glyphicon-backward"></i>Back', ['index',], ['class' => 'btn btn-default'])?>
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>
        <div class="col-md-1"></div>
    </div>
<?php ActiveForm::end(); ?>
</div>
</div>


<?php
$form = ActiveForm::begin(['action' => 'update?id=' . $model->id, 'type' => ActiveForm::TYPE_VERTICAL, 'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL]]);
?>



<hr class="dotted short">
<div class="row">
    <?php
   
        echo '<div class="col-md-6">';

        echo $form->field($model, 'cooperative')->textInput(['maxlength' => true]);

        echo $form->field($model, 'registration_type')->textInput(['maxlength' => true]);

        echo $form->field($model, 'registration_date')->widget(DatePicker::className(), 
        ['clientOptions' => ['autoclose' => true,'format' => 'yyyy-mm-dd']]);

        echo $form->field($model, 'business_objective')->textarea(['rows' => 4,'required'=>true]);

        echo $form->field($model, 'email_address')->textInput(['maxlength' => true]);    

        echo '</div>
    <div class="col-md-6">';

        echo $form->field($model, 'acronym')->textInput(['maxlength' => true]);

        echo $form->field($model, 'registration_no')->textInput(['maxlength' => true]);

        echo $form->field($model, 'trade_license_no')->textInput(['maxlength' => true]);

        echo $form->field($model, 'physical_address')->textarea(['maxlength' => true,'rows' => 4]);

        echo $form->field($model, 'tel_no')->textInput(['maxlength' => true]);
       
        echo '</div>';

    ?>
    <div class="form-group col-lg-12">
    <?= Html::a('<i class="glyphicon glyphicon-backward"></i>Back', ['index'], ['class' => 'btn btn-default'])?>

        <?= Html::submitButton('Update', ['class' => 'btn btn-success btn-sm']); ?>
    </div>

</div>
<?php ActiveForm::end(); ?>



