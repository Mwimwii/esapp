<?php

<<<<<<< HEAD
use yii\helpers\Html;
use borales\extensions\phoneInput\PhoneInput;
use kartik\form\ActiveForm;
use kartik\widgets\DatePicker;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfOrganisation */

$this->title = 'Update Organisation';
?>
<div class="card card-success card-outline">
    <div class="card-body">
=======
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

>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
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

<<<<<<< HEAD
    <?= $form->field($model, 'registration_date')->widget(DatePicker::className(),
        ['pluginOptions' => ['autoclose'=>true,'format' => 'yyyy-mm-dd']]);?>

        <?= $form->field($model, 'business_objective')->textarea(['rows' => 4,'required'=>true]) ?>

        <?= $form->field($model, 'email_address')->textInput(['maxlength' => true]) ?>
=======
        <?= $form->field($model, 'business_objective')->textarea(['rows' => 4,'required'=>true]) ?>

        <?= $form->field($model, 'registration_no')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'email_address')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'organisational_branches')->dropDownList([ 1 => 'YES', 0 => 'NO', ], ['prompt' => 'SELECT','required'=>true]);?>

>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
    </div>

    <div class="col-md-4">
        <?= $form->field($model, 'acronym')->textInput(['maxlength' => true]) ?>

<<<<<<< HEAD
        <?= $form->field($model, 'registration_no')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'trade_license_no')->textInput(['maxlength' => true]) ?>
=======
        <?= $form->field($model, 'registration_date')->widget(DatePicker::className(),
        ['pluginOptions' => ['autoclose'=>true,'format' => 'yyyy-mm-dd']]);?>

        <?php if($window==2){?>
            <?= $form->field($model, 'trade_license_no')->textInput(['maxlength' => true,'required'=>true]) ?>
        <?php } ?>
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d

        <?= $form->field($model, 'physical_address')->textarea(['maxlength' => true,'rows' => 4]) ?>

        <?= $form->field($model, 'tel_no')->textInput(['maxlength' => true]) ?>
<<<<<<< HEAD
=======
        <?= $form->field($model, 'fax_no')->textInput(['maxlength' => true]) ?>
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d

    </div>
        
    <div class="col-md-1"></div>
    </div>

    <div class="row">
        <div class="col-md-5"></div>
        <div class="col-md-4">
<<<<<<< HEAD
            <?= Html::a('<i class="glyphicon glyphicon-backward"></i>Back', ['index',], ['class' => 'btn btn-default'])?>
=======
            <?= Html::a('<i class="fa fa-backward"></i>Back', ['/mgf-organisation/view','id'=>$_GET['id']], ['class' => 'btn btn-default'])?>
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>
        <div class="col-md-1"></div>
    </div>
<<<<<<< HEAD
<?php ActiveForm::end(); ?>
    </div>
</div>


=======
<?php ActiveForm::end(); ?>
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
