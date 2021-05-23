<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

use kartik\form\ActiveForm;
use yii\helpers\Html;

$this->title = 'Request password reset';
$this->params['breadcrumbs'][] = $this->title;
?>

<h3><?= Html::encode($this->title) ?></h3>
<div class="card card-outline card-success" >
<div class="card-body">
    <p>Please fill out your email. A link to reset password will be sent there.</p>
    <div class="panel with-nav-tabs panel-primary">
        <div class="panel-body">
            <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>

                <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

                <div class="form-group">
                <?= Html::a('<i class="glyphicon glyphicon-backward"></i>Back', ['login'],['class' => 'btn btn-default'])?>

                    <?= Html::submitButton('Send', ['class' => 'btn btn-primary']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
</div>


