<?php

//use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use backend\models\AwpbComponent;
use kartik\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\form\ActiveForm;
/* @var $this yii\web\View */
/* @var $model backend\models\AwpbTemplateActivity */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="card">

<div class="card-body">
<div class="row">
		<div class="col-md-6">
        <?php
    $form = ActiveForm::begin(['type' => ActiveForm::TYPE_HORIZONTAL]);
     echo   $form->field($model, 'awpb_template_id')
            ->dropDownList(
                \backend\models\AwpbTemplate::getAwpbTemplates(),
                ['id' => 'template_id', 'custom' => true, 'required' => true]
            );
        
 
      echo
        $form->field($model, 'activity_id')
            ->dropDownList(
                \backend\models\AwpbActivity::getSubActivities(),
                ['id' => 'activity_id', 'custom' => true, 'required' => true]
            );
        ?>
</div>
</div>
<div class="row">
		<div class="col-md-12">
   
    <div class="form-group">
    <?= Html::submitButton('Update', ['class' => 'btn btn-success btn-sm']) ?>
    </div>
</div>  
<?php ActiveForm::end(); ?>
 </div>
</div></div>

