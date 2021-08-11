<?php

use frontend\models\MgfActivity;
use frontend\models\MgfInputItem;
use frontend\models\MgfUnit;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfInputItem */

$itemid=$_GET['id'];
$item=MgfInputItem::findOne($itemid);
$activity=MgfActivity::findOne($item->activity_id);
$this->title = 'Update Project Input Item: '.$activity->activity_name;
?>

<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-5">
        <h3><?= Html::encode($this->title) ?></h3>

        <?php if($proposal->project_length==1){?>
                <?php $form = ActiveForm::begin(); ?>
                <?= $form->field($model, 'input_name')->textInput() ?>
                <?= $form->field($model, 'unit_of_measure')->dropDownList(ArrayHelper::map(MgfUnit::find()->all(),'synonym','unit'),['prompt' => 'SELECT']);?>
                <?= $form->field($model, 'project_year_1')->textInput() ?>
                <?= $form->field($model, 'unit_cost')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>
                <div class="form-group">
                <?= Html::a('<i class="glyphicon glyphicon-backward"></i>Back', ['mgf-component/inputitem','id'=>$activity->componet_id], ['class' => 'btn btn-default'])?>
                    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                </div>
                <?php ActiveForm::end(); ?>

            <?php }elseif($proposal->project_length==2){?>

                <?php $form = ActiveForm::begin(); ?>
                <?= $form->field($model, 'input_name')->textInput() ?>
                <?= $form->field($model, 'unit_of_measure')->dropDownList(ArrayHelper::map(MgfUnit::find()->all(),'synonym','unit'),['prompt' => 'SELECT']);?>         
                <?= $form->field($model, 'project_year_1')->textInput() ?>
                <?= $form->field($model, 'project_year_2')->textInput() ?>                          
                <?= $form->field($model, 'unit_cost')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>
                <div class="form-group">
                <?= Html::a('<i class="glyphicon glyphicon-backward"></i>Back', ['mgf-component/inputitem','id'=>$activity->componet_id], ['class' => 'btn btn-default'])?>
                    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                </div>
                <?php ActiveForm::end(); ?>

            <?php }elseif($proposal->project_length==3){?>

                <?php $form = ActiveForm::begin(); ?>
                <?= $form->field($model, 'input_name')->textInput() ?>
                <?= $form->field($model, 'unit_of_measure')->dropDownList(ArrayHelper::map(MgfUnit::find()->all(),'synonym','unit'),['prompt' => 'SELECT']);?>             
                <?= $form->field($model, 'project_year_1')->textInput() ?>
                <?= $form->field($model, 'project_year_2')->textInput() ?>                          
                <?= $form->field($model, 'project_year_3')->textInput() ?>             
                <?= $form->field($model, 'unit_cost')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>
                <div class="form-group">
                <?= Html::a('<i class="glyphicon glyphicon-backward"></i>Back', ['mgf-component/inputitem','id'=>$activity->componet_id], ['class' => 'btn btn-default'])?>
                    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            <?php }elseif($proposal->project_length==4){?>

                <?php $form = ActiveForm::begin(); ?>
                <?= $form->field($model, 'input_name')->textInput() ?>
                <?= $form->field($model, 'unit_of_measure')->dropDownList(ArrayHelper::map(MgfUnit::find()->all(),'synonym','unit'),['prompt' => 'SELECT']);?>             
                <?= $form->field($model, 'project_year_1')->textInput() ?>
                <?= $form->field($model, 'project_year_2')->textInput() ?>                          
                <?= $form->field($model, 'project_year_3')->textInput() ?>  
                <?= $form->field($model, 'project_year_4')->textInput() ?>             
                <?= $form->field($model, 'unit_cost')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>
                <div class="form-group">
                <?= Html::a('<i class="glyphicon glyphicon-backward"></i>Back', ['mgf-component/inputitem','id'=>$activity->componet_id], ['class' => 'btn btn-default'])?>
                    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                </div>
                <?php ActiveForm::end(); ?>

            <?php }elseif($proposal->project_length==5){?>

                <?php $form = ActiveForm::begin(); ?>
                <?= $form->field($model, 'input_name')->textInput() ?>
                <?= $form->field($model, 'unit_of_measure')->dropDownList(ArrayHelper::map(MgfUnit::find()->all(),'synonym','unit'),['prompt' => 'SELECT']);?>             
                <?= $form->field($model, 'project_year_1')->textInput() ?>
                <?= $form->field($model, 'project_year_2')->textInput() ?>                          
                <?= $form->field($model, 'project_year_3')->textInput() ?>  
                <?= $form->field($model, 'project_year_4')->textInput() ?>
                <?= $form->field($model, 'project_year_5')->textInput() ?>             
                <?= $form->field($model, 'unit_cost')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>
                <div class="form-group">
                <?= Html::a('<i class="glyphicon glyphicon-backward"></i>Back', ['mgf-component/inputitem','id'=>$activity->componet_id], ['class' => 'btn btn-default'])?>
                    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                </div>
                <?php ActiveForm::end(); ?>

            <?php }elseif($proposal->project_length==6){?>

                <?php $form = ActiveForm::begin(); ?>
                <?= $form->field($model, 'input_name')->textInput() ?>
                <?= $form->field($model, 'unit_of_measure')->dropDownList(ArrayHelper::map(MgfUnit::find()->all(),'synonym','unit'),['prompt' => 'SELECT']);?>             
                <?= $form->field($model, 'project_year_1')->textInput() ?>
                <?= $form->field($model, 'project_year_2')->textInput() ?>                          
                <?= $form->field($model, 'project_year_3')->textInput() ?>  
                <?= $form->field($model, 'project_year_4')->textInput() ?>
                <?= $form->field($model, 'project_year_5')->textInput() ?>
                <?= $form->field($model, 'project_year_6')->textInput() ?>
                <?= $form->field($model, 'unit_cost')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>
                <div class="form-group">
                <?= Html::a('<i class="glyphicon glyphicon-backward"></i>Back', ['mgf-component/inputitem','id'=>$activity->componet_id], ['class' => 'btn btn-default'])?>
                    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                </div>
                <?php ActiveForm::end(); ?>

            <?php }elseif($proposal->project_length==7){?>

                <?php $form = ActiveForm::begin(); ?>
                <?= $form->field($model, 'input_name')->textInput() ?>
                <?= $form->field($model, 'unit_of_measure')->dropDownList(ArrayHelper::map(MgfUnit::find()->all(),'synonym','unit'),['prompt' => 'SELECT']);?>             
                <?= $form->field($model, 'project_year_1')->textInput() ?>
                <?= $form->field($model, 'project_year_2')->textInput() ?>                          
                <?= $form->field($model, 'project_year_3')->textInput() ?> 
                <?= $form->field($model, 'project_year_4')->textInput() ?>
                <?= $form->field($model, 'project_year_5')->textInput() ?>  
                <?= $form->field($model, 'project_year_6')->textInput() ?>
                <?= $form->field($model, 'project_year_7')->textInput() ?>              
                <?= $form->field($model, 'unit_cost')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>
                <div class="form-group">
                <?= Html::a('<i class="glyphicon glyphicon-backward"></i>Back', ['mgf-component/inputitem','id'=>$activity->componet_id], ['class' => 'btn btn-default'])?>
                    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            <?php }else{?>

                <?php $form = ActiveForm::begin(); ?>
                <?= $form->field($model, 'input_name')->textInput() ?>
                <?= $form->field($model, 'unit_of_measure')->dropDownList(ArrayHelper::map(MgfUnit::find()->all(),'synonym','unit'),['prompt' => 'SELECT']);?>              
                <?= $form->field($model, 'project_year_1')->textInput() ?>
                <?= $form->field($model, 'project_year_2')->textInput() ?>                          
                <?= $form->field($model, 'project_year_3')->textInput() ?>             
                <?= $form->field($model, 'project_year_4')->textInput() ?>    
                <?= $form->field($model, 'project_year_5')->textInput() ?>
                <?= $form->field($model, 'project_year_6')->textInput() ?>  
                <?= $form->field($model, 'project_year_7')->textInput() ?>
                <?= $form->field($model, 'project_year_8')->textInput() ?>     
                <?= $form->field($model, 'unit_cost')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>
                <div class="form-group">
                <?= Html::a('<i class="glyphicon glyphicon-backward"></i>Back', ['mgf-component/inputitem','id'=>$activity->componet_id], ['class' => 'btn btn-default'])?>
                    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                </div>
                <?php ActiveForm::end(); ?>

            <?php } ?>

</div>
    <div class="col-md-3"></div>
</div>

