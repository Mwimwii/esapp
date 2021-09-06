<?php

use backend\models\MgfApplicant;
use kartik\form\ActiveForm;
use kartik\widgets\DatePicker;
use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $model frontend\models\MgfOrganisation */
$userid=Yii::$app->user->identity->id;
$applicant=MgfApplicant::findOne(['user_id'=>$userid]);
if($applicant->applicant_type=="Category-A"){
    $window=1;
}else{
    $window=2;
}

$this->title = 'Form 1: Profile of the Organisation';
?>

<?php $form = ActiveForm::begin(); ?>

<div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <h3><?= Html::encode($this->title) ?></h3>
        </div>
        <div class="col-md-1"></div>
    </div>


<div class="row">
    <div class="col-md-2"></div>

    <div class="col-md-4">
        
        <?= $form->field($model, 'cooperative')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'registration_type')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'business_objective')->textarea(['rows' => 4,'required'=>true]) ?>

        <?= $form->field($model, 'registration_date')->widget(DatePicker::className(),
        ['pluginOptions' => ['autoclose'=>true,'format' => 'yyyy-mm-dd']]);?>        

        <?= $form->field($model, 'email_address')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'organisational_branches')->dropDownList([ 1 => 'YES', 0 => 'NO', ], ['prompt' => 'SELECT','required'=>true]);?>
    </div>

    <div class="col-md-4">
        <?= $form->field($model, 'acronym')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'registration_no')->textInput(['maxlength' => true]) ?>

        <?php if($window==2){?>
            <?= $form->field($model, 'trade_license_no')->textInput(['maxlength' => true,'required'=>true]) ?>
        <?php } ?>

        <?= $form->field($model, 'physical_address')->textarea(['maxlength' => true,'rows' => 4]) ?>

        <?= $form->field($model, 'tel_no')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'fax_no')->textInput(['maxlength' => true]) ?>

    </div>
        
    <div class="col-md-1"></div>
    </div>

    <div class="row">
        <div class="col-md-5"></div>
        <div class="col-md-4">
            <?= Html::a('<i class="fa fa-home"></i>Home', ['/mgf-applicant/profile'], ['class' => 'btn btn-default'])?>
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>
        <div class="col-md-1"></div>
    </div>
<?php ActiveForm::end(); ?>