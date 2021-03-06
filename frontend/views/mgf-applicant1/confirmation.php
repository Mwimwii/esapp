<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Districts;
use frontend\models\MgfApplicant;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfApplicant */
/* @var $form yii\widgets\ActiveForm */
//include("check.php");
$this->title = 'Form 5: Confirmation';
$applicant=MgfApplicant::findOne($_GET['id']);
$userID=Yii::$app->user->identity->nrc;
$userEmail=Yii::$app->user->identity->email;
?>

<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-6">
        <h3><?= Html::encode($this->title) ?></h3>
    </div>
</div>
<div class="row">

    <div class="col-md-2"></div>
        <div class="col-md-4">
        <?php if($applicant->confirmed==0){ ?>
            <?php $form = ActiveForm::begin(); ?>
                <?= $form->field($model, 'title')->dropDownList(['Mr.' => 'Mr.', 'Mrs.' => 'Mrs.','Ms.'=>'Ms.','Miss.'=>'Miss.','Dr.'=>'Dr.','Prof.'=>'Prof.','Rev.'=>'Rev.'],) ?>

                <?= $form->field($model, 'first_name')->textInput(['maxlength' => true,]) ?>


                <?= $form->field($model, 'mobile')->textInput(['maxlength' => true,]) ?>

                <?= $form->field($model, 'address')->textarea(['rows' => 3,'required'=>true]) ?>
                
            </div>

            <div class="col-md-4">
                    
                <label>Email</label>
                <input value=<?=$userEmail?> disabled class="form-control"><br/>
                <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'nationalid')->textInput(['maxlength' => true,'value'=>$userID,'required'=>true]) ?>

                <label>Date</label>
                <input value=<?=date('Y-m-d H:i:s')?> disabled class="form-control"><br/>

                <br/><br/>
                <?= Html::a('<i class="glyphicon glyphicon-backward"></i>Back', ['/mgf-applicant/profile'], ['class' => 'btn btn-default']),
                    Html::submitButton('Confirm', ['class' => 'btn btn-success']) ?>
            <?php ActiveForm::end(); ?>

        <?php }else{ ?>

            <?php $form = ActiveForm::begin(); ?>
                <?= $form->field($model, 'title')->textInput(['maxlength' => true,'disabled'=>true]) ?>

                <?= $form->field($model, 'first_name')->textInput(['maxlength' => true,'disabled'=>true]) ?>

                <?= $form->field($model, 'mobile')->textInput(['maxlength' => true,'disabled'=>true]) ?>
                <?= $form->field($model, 'address')->textarea(['rows' => 2,'required'=>true,'disabled'=>true]) ?>
                
            </div>

            <div class="col-md-4">
                    
                <label>Email</label>
                <input value=<?=$userEmail?> disabled class="form-control"><br/>
                <?= $form->field($model, 'last_name')->textInput(['maxlength' => true,'disabled'=>true]) ?>

                <?= $form->field($model, 'nationalid')->textInput(['maxlength' => true,'disabled'=>true]) ?>

                <label>Date</label>
                <input value=<?=date('Y-m-d H:i:s')?> disabled class="form-control"><br/>

                <br/><br/>
                <?= Html::a('<i class="glyphicon glyphicon-backward"></i>Back', ['/mgf-applicant/profile'], ['class' => 'btn btn-default']) ?>
                <?php ActiveForm::end(); ?>

        <?php } ?>
    </div>
<div class="col-md-2"></div>
</div>



