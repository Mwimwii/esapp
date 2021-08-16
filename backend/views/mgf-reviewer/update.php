<?php


/* @var $this yii\web\View */
/* @var $model frontend\models\MgfReviewer */

$this->title = 'Update Mgf Reviewer';
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\MgfOperation;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfReviewer */
/* @var $form yii\widgets\ActiveForm */

?>
<div class="card card-success card-outline">
    <div class="card-body">
    
    <div class="row">
    <div class="col-md-3"></div>

    <div class="col-md-5">
    <h3><?= Html::encode($this->title) ?></h3>
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->dropDownList([ 'Mr.' => 'Mr.', 'Mrs.' => 'Mrs.', 'Ms.' => 'Ms.', 'Miss.' => 'Miss.', 'Dr.' => 'Dr.', 'Prof.' => 'Prof.', 'Rev.' => 'Rev.', ], ['prompt' => 'SELECT','required'=>true]) ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'reviewer_type')->dropDownList([ 'Internal' => 'Internal', 'External' => 'External', ], ['prompt' => 'SELECT']) ?>

    <?= $form->field($model, 'area_of_expertise')->dropDownList(ArrayHelper::map(MgfOperation::find()->all(),'operation_type','operation_type'),['prompt' => 'SELECT','required'=>true]);?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
    <?= Html::a('<i class="fa fa-backward"></i>Back', ['index'],['class' => 'btn btn-default'])?>
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    </div>
        
    <div class="col-md-1"></div>
    </div>

   

    <?php ActiveForm::end(); ?>

</div>
    </div>
</div>
