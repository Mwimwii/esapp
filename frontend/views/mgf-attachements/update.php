<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\MgfApplicant;
use frontend\models\MgfApplication;
use frontend\models\MgfAttachements;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfAttachements */
/* @var $form yii\widgets\ActiveForm */
$userid=Yii::$app->user->identity->id;
$applicant=MgfApplicant::find()->where(['user_id'=>$userid])->one();
$application=MgfApplication::find()->where(['organisation_id'=>$applicant->organisation_id,'is_active'=>1])->one();
$attachement = MgfAttachements::find()->where(['application_id'=>$application->id])->one();
$this->title = 'Form 4: Attachements';
?>

<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
    <h3><?= Html::encode($this->title) ?></h3>
    <?php if($applicant->applicant_type=="Category-A"){ ?>
    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>

    <?= $form->field($model, 'registration_certificate')->fileInput() ?>
    
    <?= $form->field($model, 'articles_of_assoc')->fileInput() ?>

    <?= $form->field($model, 'mou_contract')->fileInput() ?>

    <?= $form->field($model, 'board_resolution')->fileInput() ?>


    <div class="form-group">
        <?= Html::a('<i class="glyphicon glyphicon-backward"></i> Back', ['/mgf-attachements/view','id'=>$_GET['id']], ['class' => 'btn btn-default']) ?>
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>

    <?php }else{ ?>

        <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>

            <?= $form->field($model, 'registration_certificate')->fileInput() ?>

            <?= $form->field($model, 'articles_of_assoc')->fileInput() ?>

            <?= $form->field($model, 'audit_reports')->fileInput() ?>

            <?= $form->field($model, 'mou_contract')->fileInput() ?>

            <?= $form->field($model, 'board_resolution')->fileInput() ?>

            <?= $form->field($model, 'application_attachement')->fileInput() ?>

            <div class="form-group">
                <?= Html::a('<i class="glyphicon glyphicon-backward"></i> Back', ['/mgf-attachements/view','id'=>$_GET['id']], ['class' => 'btn btn-default']) ?>
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>
        <?php ActiveForm::end(); ?>

    <?php } ?>

    </div>
    <div class="col-md-3"></div>
</div>
