<?php
use yii\helpers\ArrayHelper;
use frontend\models\MgfComponent;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\MgfActivity;
$this->title = "Update Activity";
$activityid=$_GET['id'];
$activity=MgfActivity::findOne($activityid);
?>

<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
       
    <h3><?= Html::encode($this->title) ?></h3>
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'componet_id')->dropDownList(ArrayHelper::map(MgfComponent::find()->all(),'id','component_name'),
        ['prompt'=>'Component','disabled' => true]) ?>

    <?= $form->field($model, 'activity_name')->textInput() ?>

    <div class="form-group">
    <?= Html::a('<i class="glyphicon glyphicon-backward"></i>Back', ['mgf-component/manage','id'=>$activity->componet_id], ['class' => 'btn btn-default'])?>
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>


    </div>

    <div class="col-md-3"></div>
</div>


