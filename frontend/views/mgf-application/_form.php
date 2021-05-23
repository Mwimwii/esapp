<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

use frontend\models\MgfOrganisation;
use frontend\models\MgfApplicant;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfApplication */
/* @var $form yii\widgets\ActiveForm */

$userid=Yii::$app->user->identity->id;
$applicant=MgfApplicant::find()->where(["user_id"=>$userid])->one();
$applicantid=$applicant->id;
?>

<div class="mgf-application-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'organisation_id')->dropDownList(
        ArrayHelper::map(MgfOrganisation::find()->where(['applicant_id'=>$applicantid])->all(),'id','cooperative'),
        ['prompt'=>'Organisation']
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
