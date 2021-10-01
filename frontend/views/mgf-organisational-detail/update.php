<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
<<<<<<< HEAD
#use dosamigos\datepicker\DatePicker;
use kartik\widgets\DatePicker;
=======
use dosamigos\datepicker\DatePicker;
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfOrganisationalDetails */

$this->title = 'Form 2: Business Management Capacity, Governance and Financial Status';
?>

<?php $form = ActiveForm::begin(); ?>
<div class="row">
    <div class="col-md-3"></div>
        <div class="col-md-9">
            <h3><?= Html::encode($this->title) ?></h3>
        </div>
</div>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
        <strong>Proposed Business Establishment:</strong>
            <?= $form->field($model, 'mgt_Staff')->textInput() ?>

            <?= $form->field($model, 'senior_Staff')->textInput() ?>

            <?= $form->field($model, 'junior_Staff')->textInput() ?>

            <?= $form->field($model, 'others')->textInput() ?>

            <strong>Governance:</strong>
<<<<<<< HEAD

            <?= $form->field($model, 'last_board')->widget(DatePicker::className(),
                ['pluginOptions' => ['autoclose'=>true,'format' => 'yyyy-mm-dd']]);?> 

            <?= $form->field($model, 'last_agm')->widget(DatePicker::className(),
                            ['pluginOptions' => ['autoclose'=>true,'format' => 'yyyy-mm-dd']]);?> 


            <?= $form->field($model, 'last_audit')->widget(DatePicker::className(),
                            ['pluginOptions' => ['autoclose'=>true,'format' => 'yyyy-mm-dd']]);?> 
                
=======
            <?= $form->field($model, 'last_board')->widget(DatePicker::className(), 
                ['clientOptions' => ['autoclose' => true,'format' => 'yyyy-mm-dd']]);?> 
                
            <?= $form->field($model, 'last_agm')->widget(DatePicker::className(), 
                ['clientOptions' => ['autoclose' => true,'format' => 'yyyy-mm-dd']]);?> 
                
            <?= $form->field($model, 'last_audit')->widget(DatePicker::className(), 
                ['clientOptions' => ['autoclose' => true,'format' => 'yyyy-mm-dd']]);?>
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
        
            <strong>Financial Status:</strong>
            <?= $form->field($model, 'has_finance')->dropDownList([ 'YES' => 'YES', 'NO' => 'NO', ], ['prompt' => 'SELECT']) ?>

            <?= $form->field($model, 'has_resources')->dropDownList([ 'YES' => 'YES', 'NO' => 'NO', ], ['prompt' => 'SELECT']) ?>
        </div>
    </div>

    <div class="row">
    <div class="col-md-4"></div>
        <div class="col-md-8">
            <?= Html::a('<i class="glyphicon glyphicon-backward"></i>Back', ['/mgf-organisational-detail/view','id'=>$_GET['id']], ['class' => 'btn btn-default'])?>
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>
    </div>

<?php ActiveForm::end(); ?>

