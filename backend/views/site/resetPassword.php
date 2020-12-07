
<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model backend\models\LoginForm */

use yii\helpers\Html;
use kartik\form\ActiveForm;

$this->title = 'Password Reset';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-lg-9">
    <div class="card card-success card-outline">
        <div class="card card-header">
            <h5 class="card-title m-0" ><?= Html::encode($this->title) ?></h5>
        </div>
        <div class="card-body ">
            <div class="row">
                <div class="col-lg-5">
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
                    <div class="form-group">
                        <?=
                        $form->field($model, 'password', [
                            'addon' => ['prepend' => ['content' => ' <span class="fas fa-lock"></span>']]
                        ])->passwordInput(['class' => 'form-control ', 'autocorrect' => 'off', 'autocapitalize' => 'none',
                            'autofocus' => false, 'placeholder' => 'Password',])->label(false);
                        ?>
                    </div>
                    <div class="form-group">
                        <?=
                        $form->field($model, 'confirm_password', [
                            'addon' => ['prepend' => ['content' => ' <span class="fas fa-lock"></span>']]
                        ])->passwordInput(['class' => 'form-control ', 'autocorrect' => 'off', 'autocapitalize' => 'none',
                            'autofocus' => false, 'placeholder' => 'Confirm Password',])->label(false);
                        ?>
                    </div>
                    <div class="form-group">
                        <?= Html::submitButton('Reset', ['class' => 'btn btn-block btn-success btn-sm', 'name' => 'login-button']) ?>
                    </div>
                    <div style="color:#999;margin:1em 0">
                        <?= Html::a('Login', ['site/login']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>

                <div class="col-lg-7 text-sm">
                    <h6>Password must meet below requirements</h6>
                    <ol>
                        <li>Password should contain at least 10 characters</li>
                        <li>Password should contain at least one upper case character</li>
                        <li>Password should contain at least one numeric / digit character</li>
                        <li>Password should contain at least one special character</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>

