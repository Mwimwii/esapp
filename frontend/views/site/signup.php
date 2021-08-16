<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use kartik\form\ActiveForm;
use yii\helpers\Html;
use borales\extensions\phoneInput\PhoneInput;

$this->title = 'APPLICATION FOR PARTICIPATION IN:';
$this->params['breadcrumbs'][] = $this->title;

function login_code(){
    $date=date("m").''.date("y");
    $rand = rand(1000, 10000);
    $login_code='MGF'.$date.''.$rand;
    return $login_code;
}
?>

<div style="text-align:center">
    <p class="login-box-msg text-sm breadcrumb-item active">
        <strong><h3><?= Html::encode($this->title) ?></h3></strong>

        <h5><?= 'ENHANCED SMALLHOLDER AGRIBUSINESS PROMOTION PROGRAMME (E-SAPP)' ?></h5>
        <h6><?= 'MATCHING GRANT FACILITY (MGF) WINDOW 1 or 2' ?></h6>
    </p>
</div>

<div class="card card-outline card-success" >
<div class="card-body">
<?php $form = ActiveForm::begin(); ?>
<div class="row">
    <div class="col-md-1"></div>

    <div class="col-md-5">
            <?= $form->field($model, 'username')->textInput(['value'=>login_code(),'autofocus' => true,'readonly'=>true]) ?>
            <?= $form->field($model, 'first_name')->textInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'phone')->textInput(['autofocus' => true])->widget(PhoneInput::className(), [
            'jsOptions' => ['allowExtensions' => true,'preferredCountries' => ['ZM'],]],
            ['maxlength' => true, 'id' => "phone"]); ?>
            <?= $form->field($model, 'password')->passwordInput() ?>
    </div>

    <div class="col-md-5">
            <?= $form->field($model, 'email') ?>
            <?= $form->field($model, 'last_name')->textInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'nrc')->textInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'other_name')->passwordInput() ?>
    </div>
        
    <div class="col-md-1"></div>
    </div>

        <div class="form-group">
            <?= Html::submitButton('Register', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?><br>
        </div>
            
    <?php ActiveForm::end(); ?>
    <p class="mb-1 text-sm">
            Already Have an Account? <?= Html::a('Login', ['site/login']) ?>
        </p>
</div>
</div>
