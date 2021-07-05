<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\checkbox\CheckboxX;

/* @var $this yii\web\View */
/* @var $model backend\models\AwpbComponent */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="card card-success card-outline">
    <div class="card-body">
    <?php $form = ActiveForm::begin(); ?>
    <?php
    if ($model->type ==0) {

        echo $form->field($model, 'code')->textInput(['maxlength' => true]);		
        echo $form->field($model, 'name')->textInput(['maxlength' => true]);
        echo $form->field($model, 'description')->textarea(['rows' => 3],['maxlength' => true]);
      //  echo $form->field($model, 'access_level_district')->checkBox(['rows' => 3],['maxlength' => true]);
   
     
?>
      <!-- Krajee Flat Blue Theme -->
      <legend><h6>Component Access Level</h6></legend>
      <div class="form-group">
      

<?php
echo '<div class="row">';
    
echo '<div class="col-md-2">';
        echo $form->field($model, 'access_level_district')->widget(CheckboxX::classname(), [
            'initInputType' => CheckboxX::INPUT_CHECKBOX,
            'autoLabel' => true,
            'labelSettings' => [
                'label' => 'District',
                'position' => CheckboxX::LABEL_LEFT
            ]
        ])->label(false);
        echo '</div><div class="col-md-2">';
        echo $form->field($model, 'access_level_province')->widget(CheckboxX::classname(), [
            'initInputType' => CheckboxX::INPUT_CHECKBOX,
            'autoLabel' => true,
           // 'pluginOptions'=>['threeState'=>false],
            'labelSettings' => [
                'label' => 'Province',
                'position' => CheckboxX::LABEL_LEFT
            ]
        ])->label(false);
        echo '</div><div class="col-md-2">';
        echo $form->field($model, 'access_level_programme')->widget(CheckboxX::classname(), [
            'initInputType' => CheckboxX::INPUT_CHECKBOX,
            'autoLabel' => true,
            'labelSettings' => [
                'label' => 'Programme',
                'position' => CheckboxX::LABEL_LEFT
            ]
        ])->label(false);
         
     
      ?>
       </div></div></div>
          </label>
          
          <?php 
             echo '</div>';
             echo '</div>';
        }
        else{
            
    echo $form->field($model, 'code')->textInput(['maxlength' => true]);
    echo $form->field($model, 'name')->textInput(['maxlength' => true]);
    echo  $form->field($model, 'description')->textInput(['maxlength' => true]);
    echo $form->field($model, 'gl_account_code')->textInput(['maxlength' => true]);

        }
        ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    </div>
    </div>