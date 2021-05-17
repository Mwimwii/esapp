<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AwpbComponent */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="card card-success card-outline">
    <div class="card-body">
    <?php $form = ActiveForm::begin(); ?>
    <?php
    if ($model->type ==0) {

        echo $form->field($model, 'name')->textInput(['maxlength' => true]);
        echo  $form->field($model, 'description')->textInput(['maxlength' => true]);

        echo  $form->field($model, 'outcome')->textarea(['rows' => 3]) ;

        echo  $form->field($model, 'output')->textarea(['rows' => 3]) ;

        echo  $form->field($model, 'access_level')->dropDownList(
                [
                    '0' => 'All',
            '1' => 'District',
            '2' => 'Programme',

                ], ['prompt' => 'Select the access level', 'custom' => true, 'required' => false]
            );
        }
        else{
            
    echo $form->field($model, 'name')->textInput(['maxlength' => true]);
    echo  $form->field($model, 'description')->textInput(['maxlength' => true]);

echo  $form->field($model, 'outcome')->textarea(['rows' => 3]) ;

echo  $form->field($model, 'output')->textarea(['rows' => 3]) ;
echo $form->field($model, 'gl_account_code')->textInput(['maxlength' => true]);

        }
        ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    </div>
    </div>