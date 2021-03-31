
<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use kartik\form\ActiveForm;

$this->title = 'User login';
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
            $form->field($model, 'email', [
                'addon' => ['prepend' => ['content' => ' <span class="fas fa-envelope"></span>']]
            ])->textInput(['class' => 'form-control ', 'autocorrect' => 'off', 'autocapitalize' => 'none',
                'autofocus' => false, 'placeholder' => 'Enter email',])->label(false);
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
            <?= Html::a('Forgot password?', ['site/request-password-reset'], ['class' => "breadcrumb-item active"]) ?>
        </p>
    </div>
    <!-- /.card-body -->
</div>
