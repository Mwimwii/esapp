<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model backend\models\LoginForm */

use yii\helpers\Html;
use kartik\form\ActiveForm;

$this->title = 'Activate account';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card card-outline card-success">
    
         <div class="card-body">
        <div class="row">
            <div class="col-lg-6">
                <p class="login-box-msg text-sm breadcrumb-item active">
                    <strong>WELCOME</strong><br/>
                    Set your password below to your activate account
                </p>

                <?php
                $form = ActiveForm::begin([
                            'id' => 'reset-password-form',
                                /* 'fieldConfig' => [
                                  'options' => [
                                  'tag' => false,
                                  ],
                                  ], */
                ]);
                ?>
                <div style="width:360px;">
                    <?=
                    $form->field($model, 'password', [
                        'addon' => ['prepend' => ['content' => ' <span class="fas fa-lock"></span>']]
                    ])->passwordInput(['class' => 'form-control ', 'autocorrect' => 'off', 'autocapitalize' => 'none',
                        'autofocus' => false, 'placeholder' => 'Password',])->label(false);
                    ?>
                    <?=
                    $form->field($model, 'confirm_password', [
                        'addon' => ['prepend' => ['content' => ' <span class="fas fa-lock"></span>']]
                    ])->passwordInput(['class' => 'form-control ', 'autocorrect' => 'off', 'autocapitalize' => 'none',
                        'autofocus' => false, 'placeholder' => 'Confirm Password',])->label(false);
                    ?>
                    <div class="social-auth-links text-center mt-2 mb-3">
                        <?= Html::submitButton('Reset', ['class' => 'btn btn-block btn-sm btn-success text-white', 'name' => 'login-button']) ?>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
            <div class="col-lg-6">
                <div class=" text-sm breadcrumb-item active">
                    <h6>Password must meet below requirements</h6>
                    <ol>
                        <li>Password should contain at least 10 characters</li>
                        <li>Password should contain at least one upper case character</li>
                        <li>Password should contain at least one numeric / digit character</li>
                        <li>Password should contain at least one special character</li>
                    </ol>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
