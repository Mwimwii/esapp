<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model backend\models\LoginForm */

use yii\helpers\Html;
//use yii\bootstrap4\ActiveForm;
//use kartik\form\ActiveField;
use kartik\form\ActiveForm;

$this->title = 'Password reset request';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card card-outline card-success">
    <div class="card-body">
        <p class="text-sm text-center breadcrumb-item active">
            Reset password link will be sent to your email
        </p>

        <?php
        $form = ActiveForm::begin([
        ]);
        ?>
        <div style="width:360px;">
            <?=
            $form->field($model, 'email', ['enableAjaxValidation' => true,
                'addon' => ['prepend' => ['content' => ' <span class="fas fa-envelope"></span>']]
            ])->textInput(['autofocus' => false, 'placeholder' => 'Enter email',])->label(false);
            ?>
        </div>
        <div class="social-auth-links text-center mt-2 mb-3">
            <?= Html::submitButton('Request link', ['class' => 'btn btn-block btn-sm btn-success', 'name' => 'login-button']) ?>
        </div>
        <?php ActiveForm::end(); ?>
        <div class="text-sm" style="color:#999;margin:1em 0">
            <?= Html::a('Back to Login', ['site/login'], ['class' => "breadcrumb-item active"]) ?>
        </div>
    </div>
    <!-- /.card-body -->
</div>
