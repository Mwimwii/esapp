<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

use kartik\form\ActiveForm;
use yii\helpers\Html;

$this->title = 'Resend verification email';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
<div class="col-md-4"></div>
<div class="col-md-4">
    <h3><?= Html::encode($this->title) ?></h3>
    <p>Please fill out your email. A verification email will be sent there.</p>

    <div class="panel with-nav-tabs panel-primary">
        <div class="panel-body">
            <?php $form = ActiveForm::begin(['id' => 'resend-verification-email-form']); ?>
            <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>
            <div class="form-group">
                <?= Html::a('<i class="glyphicon glyphicon-backward"></i>Back', ['login'],['class' => 'btn btn-default'])?>
                <?= Html::submitButton('Send', ['class' => 'btn btn-primary']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<div class="col-md-3">
</div>
</div>