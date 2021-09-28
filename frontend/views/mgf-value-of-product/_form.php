<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\MgfApplicant;
use frontend\models\MgfProposal;
$userid=Yii::$app->user->identity->id;
$applicant=MgfApplicant::findOne(['user_id'=>$userid]);
$proposal=MgfProposal::find()->where(['is_active'=>1,'organisation_id'=>$applicant->organisation_id])->one();

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfValueOfProduct */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mgf-value-of-product-form">

    <?php $form = ActiveForm::begin(); ?>
    
<!-- <div style="background-color:white;color:black;padding:20px;">
<?= $form->field($model, 'product_name')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'product_unit')->textInput(['maxlength' => true]) ?>
</div> -->
<!-- <div style="border: 5px outset red;  background-color: lightblue; text-align: center;">

    <?= $form->field($model, 'product_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'product_unit')->textInput(['maxlength' => true]) ?>
    <hr>
</div> -->
<table style="margin-left: auto;  margin-right: auto;width:100%;">
<tr>
    <td>
    <?= $form->field($model, 'product_name')->textInput() ?>
    </td>
    <td>
    <?= $form->field($model, 'product_unit')->textInput() ?>
    </td>
</tr>
<tr>
    <td>
        <?= $form->field($model, 'product_yr1_qty')->textInput() ?>
    </td>
    <td>
        <?= $form->field($model, 'product_yr1_price')->textInput() ?>
    </td>
</tr>
<tr>
    <td>
    <?= $form->field($model, 'product_yr2_qty')->textInput() ?>
    </td>
    <td>
    <?= $form->field($model, 'product_yr2_price')->textInput() ?>
    </td>
</tr>

<tr>
    <td>
    <?= $form->field($model, 'product_yr3_qty')->textInput() ?>
    </td>
    <td>
    <?= $form->field($model, 'product_yr3_price')->textInput() ?>
    </td>
</tr>

<tr>
    <td>
    <?= $form->field($model, 'product_yr4_qty')->textInput() ?>
    </td>
    <td>
    <?= $form->field($model, 'product_yr4_price')->textInput() ?>
    </td>
</tr>
<tr>
    <td colspan="2">
    <?= $form->field($model, 'comment')->textInput(['maxlength' => true]) ?>
    </td>
    <!-- <td>
   
    </td> -->
</tr>
<tr>
    <td colspan="2">
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    </td>
    <!-- <td>
   
    </td> -->
</tr>
</table>
    <!-- <?= $form->field($model, 'product_yr1_value')->textInput() ?> -->    

   <!-- <?= $form->field($model, 'product_yr2_value')->textInput() ?> -->    

    <!-- <?= $form->field($model, 'product_yr3_value')->textInput() ?> -->
   <!-- <?= $form->field($model, 'product_yr4_value')->textInput() ?> -->

    

    <?= $form->field($model, 'proposal_id')->hiddenInput(['value'=>$proposal->id, 'maxlength' => true])->label(false) ?>

   <!-- <?= $form->field($model, 'date_created')->textInput() ?> -->

   <!-- <?= $form->field($model, 'date_update')->textInput() ?> -->

   <!-- <?= $form->field($model, 'created_by')->textInput() ?> -->

    <!-- <?= $form->field($model, 'updated_by')->textInput() ?> -->

    

    <?php ActiveForm::end(); ?>

</div>
