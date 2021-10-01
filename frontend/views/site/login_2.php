<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use kartik\form\ActiveForm;
use yii\helpers\Html;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="card card-outline card-success" >
    <div class="card-body">
        <p class="login-box-msg text-sm breadcrumb-item active">
            <strong>WELCOME</strong>
            <br/>Log in to your account
        </p>

        <?php
        $form = ActiveForm::begin([
                    'fieldConfig' => [
                    ],
        ]);
        ?>
        <div style="width:360px;">
            <?=
            $form->field($model, 'username', [
                'addon' => ['prepend' => ['content' => ' <span class="fas fa-user"></span>']]
            ])->textInput(['class' => 'form-control ', 'autocorrect' => 'off', 'autocapitalize' => 'none',
                'autofocus' => false, 'placeholder' => 'Enter Username',])->label(false);
            ?>
            <?=
            $form->field($model, 'password', [
                'addon' => ['prepend' => ['content' => ' <span class="fas fa-lock"></span>']]
            ])->passwordInput(['class' => 'form-control ', 'autocorrect' => 'off', 'autocapitalize' => 'none',
                'autofocus' => false, 'placeholder' => 'Enter password',])->label(false);
            ?>
        </div>
        <div class="social-auth-links text-center mt-2 mb-3">
            <?= Html::submitButton('Sign in', ['class' => 'btn btn-block btn-sm btn-success', 'name' => 'login-button']) ?>
        </div>
        <?php ActiveForm::end(); ?>
        <!-- /.social-auth-links -->

        <p class="mb-1 text-sm">
            <?= Html::a('Forgot password?', ['site/request-password-reset'], ['class' => "breadcrumb-item active"]) ?><br/>
            Do not have an account? <?= Html::a('Sign Up', ['site/signup']) ?>
        </p>
    </div>
    <!-- /.card-body -->
</div>
