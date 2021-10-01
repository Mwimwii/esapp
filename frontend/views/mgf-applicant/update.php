<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Districts;
use frontend\models\MgfApplicant;
use backend\models\MeFaabsCategoryAFarmers;
/* @var $this yii\web\View */
/* @var $model frontend\models\MgfApplicant */
/* @var $form yii\widgets\ActiveForm */
//include("check.php");
$this->title = 'Update MGF Applicant Profile';
$applicant=MgfApplicant::findOne($_GET['id']);
$userID=Yii::$app->user->identity->nrc;
$userEmail=Yii::$app->user->identity->email;
if(MeFaabsCategoryAFarmers::find()->where(['nrc'=>$userID])->exists()){
    $farmer_type='Category-A';
}else{
    $farmer_type='Category-B';
}
?>

<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-6">
        <h3><?= Html::encode($this->title) ?></h3>
        <?php if ($applicant->district_id>0) {}else{ Yii::$app->session->setFlash('warning', 'Please Upted Your Profile to Proceed.');}?>
    </div>
</div>
<div class="row">
    <div class="col-md-2"></div>
        <div class="col-md-4">
            <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($model, 'title')->dropDownList(['Mr.' => 'Mr.', 'Mrs.' => 'Mrs.','Ms.'=>'Ms.','Miss.'=>'Miss.','Dr.'=>'Dr.','Prof.'=>'Prof.','Rev.'=>'Rev.'],['required'=>true,'prompt' => 'Title']) ?>
            <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>
            <?php if($applicant->district_id>0){?>
                <?= $form->field($model, 'district_id')->dropDownList(ArrayHelper::map(Districts::find()->all(),'id','name'),['disabled'=>true]);?>
            <?php }else{ ?>
                <?= $form->field($model, 'district_id')->dropDownList(ArrayHelper::map(Districts::find()->all(),'id','name'),['prompt' => 'Dstrict','required'=>true]);?>
            <?php } ?>

            <?= $form->field($model, 'address')->textarea(['rows' => 5,'required'=>true]) ?>
        
        </div>

    <div class="col-md-4">
        
        <label>Email</label>
        <input value=<?=$userEmail?> disabled class="form-control"><br/>
        <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'nationalid')->textInput(['maxlength' => true,'value'=>$userID,'required'=>true]) ?>
        
        <?= $form->field($model, 'applicant_type')->textInput(['maxlength' => true,'value'=>$farmer_type,'required'=>true,'disabled'=>true]) ?>

        <br/><br/>
            <?php if($applicant->district_id>0){?>
                <?=  Html::a('<i class="fa fa-home"></i>Back', ['/mgf-applicant/profile'], ['class' => 'btn btn-default'])?>
            <?php } ?>
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        <?php ActiveForm::end(); ?>
    </div>
<div class="col-md-2"></div>
</div>



