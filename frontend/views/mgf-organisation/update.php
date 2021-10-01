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
$this->title = 'Update Organisation';
?>

<?php $form = ActiveForm::begin(); ?>

<div class="row">
        <div class="col-md-5"></div>
        <div class="col-md-4">
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

        <?= $form->field($model, 'registration_no')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'email_address')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'organisational_branches')->dropDownList([ 1 => 'YES', 0 => 'NO', ], ['prompt' => 'SELECT','required'=>true]);?>

    </div>

    <div class="col-md-4">
        <?= $form->field($model, 'acronym')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'registration_date')->widget(DatePicker::className(),
        ['pluginOptions' => ['autoclose'=>true,'format' => 'yyyy-mm-dd']]);?>

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
            <?= Html::a('<i class="fa fa-backward"></i>Back', ['/mgf-organisation/view','id'=>$_GET['id']], ['class' => 'btn btn-default'])?>
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>
        <div class="col-md-1"></div>
    </div>
<<<<<<< HEAD
<?php ActiveForm::end(); ?>
=======
<?php ActiveForm::end(); ?>
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
