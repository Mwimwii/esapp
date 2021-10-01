<?php
use kartik\checkbox\CheckboxX;
use kartik\form\ActiveForm;
use yii\helpers\Html;
use frontend\models\MgfActivity;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model frontend\models\MgfImplementationSchedule */
/* @var $form yii\widgets\ActiveForm */

use frontend\models\MgfApplicant;
use frontend\models\MgfProposal;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfProfitBeforeInterestTaxes */
/* @var $form yii\widgets\ActiveForm */

$userid=Yii::$app->user->identity->id;
$applicant=MgfApplicant::findOne(['user_id'=>$userid]);
$proposal=MgfProposal::find()->where(['is_active'=>1,'organisation_id'=>$applicant->organisation_id])->one();

$activities = ArrayHelper::map(MgfActivity::find()->where(['createdby'=>$userid])->groupBy('activity_no')->all(), 'id', 'activity_name');
?>
<p>
        <?= Html::a('Back', ['index'], ['class' => 'btn btn-success']) ?>
        
</p>
<div class="mgf-implementation-schedule-form">

<?php $form = ActiveForm::begin(); ?>
<table style="width:100%; border-style: ridge;border-width: 2px;border-color: #8ebf42;background-color: #d9d9d9;">
<tr>
    <td style="padding: 10px;border: 2px solid #8ebf42;text-align: center;"><h5>Project Year</h5></td> <td style="padding: 10px;border: 2px solid #8ebf42;text-align: center;" colspan="4"><h5>Project Year 1</h5></td><td style="padding: 10px;border: 2px solid #8ebf42;text-align: center;" colspan="4"><h5>Project Year 2</h5></td><td style="padding: 10px;border: 2px solid #8ebf42;text-align: center;" colspan="4"><h5>Project Year 3</h5> </td><td style="padding: 10px;border-bottom: 2px solid #8ebf42;text-align: center;" colspan="4"><h5>Project Year 4</h5></td>
</tr>
<tr>
     <td><h5>Year Quarters</h5></td><td style="padding: 10px;border: 2px solid #8ebf42;text-align: center;"><h6>QRT 1</h6></td><td style="padding: 10px;border: 2px solid #8ebf42;text-align: center;"><h6>QRT 2</h6></td><td style="padding: 10px;border: 2px solid #8ebf42;text-align: center;"><h6>QRT 3</h6></td><td style="padding: 10px;border: 2px solid #8ebf42;text-align: center;"><h6>QRT 4</h6></td><td style="padding: 10px;border: 2px solid #8ebf42;text-align: center;"><h6>QRT 1</h6></td><td style="padding: 10px;border: 2px solid #8ebf42;text-align: center;"><h6>QRT 2</h6></td><td style="padding: 10px;border: 2px solid #8ebf42;text-align: center;"><h6>QRT 3</h6></td><td style="padding: 10px;border: 2px solid #8ebf42;text-align: center;"><h6>QRT 4</h6></td>
     <td style="padding: 10px;border: 2px solid #8ebf42;text-align: center;"><h6>QRT 1</h6></td><td style="padding: 10px;border: 2px solid #8ebf42;text-align: center;"><h6>QRT 2</h6></td><td style="padding: 10px;border: 2px solid #8ebf42;text-align: center;"><h6>QRT 3</h6></td><td style="padding: 10px;border: 2px solid #8ebf42;text-align: center;"><h6>QRT 4</h6></td><td style="padding: 10px;border: 2px solid #8ebf42;text-align: center;"><h6>QRT 1</h6></td><td style="padding: 10px;border: 2px solid #8ebf42;text-align: center;"><h6>QRT 2</h6></td><td style="padding: 10px;border: 2px solid #8ebf42;text-align: center;"><h6>QRT 3</h6></td><td style="padding: 10px;border: 2px solid #8ebf42;text-align: center;"><h6>QRT 4</h6></td>
</tr>
<tr><td style="padding: 10px;border: 2px solid #8ebf42;text-align: center;"> <?= $form->field($model, 'activity_id')->dropDownList($activities,['prompt'=>'Please select activity']);?></td>
<td style="padding: 10px;border: 2px solid #8ebf42;text-align: center;">
<?=$form->field($model, 'yr1qtr1')->widget(CheckboxX::classname(), [
    'initInputType' => CheckboxX::INPUT_CHECKBOX,
    'autoLabel' => false
])->label(false);?>

</td>
<td style="padding: 10px;border: 2px solid #8ebf42;text-align: center;">
<?=$form->field($model, 'yr1qtr2')->widget(CheckboxX::classname(), [
    'initInputType' => CheckboxX::INPUT_CHECKBOX,
    'autoLabel' => false
])->label(false);?>
</td>
<td style="padding: 10px;border: 2px solid #8ebf42;text-align: center;">
<?=$form->field($model, 'yr1qtr3')->widget(CheckboxX::classname(), [
    'initInputType' => CheckboxX::INPUT_CHECKBOX,
    'autoLabel' => false
])->label(false);?>
</td>
<td style="padding: 10px;border: 2px solid #8ebf42;text-align: center;">
<?=$form->field($model, 'yr1qtr4')->widget(CheckboxX::classname(), [
    'initInputType' => CheckboxX::INPUT_CHECKBOX,
    'autoLabel' => false
])->label(false);?>
</td>
<td style="padding: 10px;border: 2px solid #8ebf42;text-align: center;">
<?=$form->field($model, 'yr2qtr1')->widget(CheckboxX::classname(), [
    'initInputType' => CheckboxX::INPUT_CHECKBOX,
    'autoLabel' => false
])->label(false);?>
</td>
<td style="padding: 10px;border: 2px solid #8ebf42;text-align: center;">
<?=$form->field($model, 'yr2qtr2')->widget(CheckboxX::classname(), [
    'initInputType' => CheckboxX::INPUT_CHECKBOX,
    'autoLabel' => false
])->label(false);?>
</td>
<td style="padding: 10px;border: 2px solid #8ebf42;text-align: center;">
<?=$form->field($model, 'yr2qtr3')->widget(CheckboxX::classname(), [
    'initInputType' => CheckboxX::INPUT_CHECKBOX,
    'autoLabel' => false
])->label(false);?>
</td>
<td style="padding: 10px;border: 2px solid #8ebf42;text-align: center;">
<?=$form->field($model, 'yr2qtr4')->widget(CheckboxX::classname(), [
    'initInputType' => CheckboxX::INPUT_CHECKBOX,
    'autoLabel' => false
])->label(false);?>
</td>
<td style="padding: 10px;border: 2px solid #8ebf42;text-align: center;">
<?=$form->field($model, 'yr3qtr1')->widget(CheckboxX::classname(), [
    'initInputType' => CheckboxX::INPUT_CHECKBOX,
    'autoLabel' => false
])->label(false);?>
</td>
<td style="padding: 10px;border: 2px solid #8ebf42;text-align: center;">
<?=$form->field($model, 'yr3qtr2')->widget(CheckboxX::classname(), [
    'initInputType' => CheckboxX::INPUT_CHECKBOX,
    'autoLabel' => false
])->label(false);?>
</td>
<td style="padding: 10px;border: 2px solid #8ebf42;text-align: center;">
<?=$form->field($model, 'yr3qtr3')->widget(CheckboxX::classname(), [
    'initInputType' => CheckboxX::INPUT_CHECKBOX,
    'autoLabel' => false
])->label(false);?>
</td>
<td style="padding: 10px;border: 2px solid #8ebf42;text-align: center;">
<?=$form->field($model, 'yr3qtr4')->widget(CheckboxX::classname(), [
    'initInputType' => CheckboxX::INPUT_CHECKBOX,
    'autoLabel' => false
])->label(false);?>
</td>
<td style="padding: 10px;border: 2px solid #8ebf42;text-align: center;">
<?=$form->field($model, 'yr4qtr1')->widget(CheckboxX::classname(), [
    'initInputType' => CheckboxX::INPUT_CHECKBOX,
    'autoLabel' => false
])->label(false);?>
</td>
<td style="padding: 10px;border: 2px solid #8ebf42;text-align: center;">
<?=$form->field($model, 'yr4qtr2')->widget(CheckboxX::classname(), [
    'initInputType' => CheckboxX::INPUT_CHECKBOX,
    'autoLabel' => false
])->label(false);?>
</td>
<td style="padding: 10px;border: 2px solid #8ebf42;text-align: center;">
<?=$form->field($model, 'yr4qtr3')->widget(CheckboxX::classname(), [
    'initInputType' => CheckboxX::INPUT_CHECKBOX,
    'autoLabel' => false
])->label(false);?>
</td>
<td style="padding: 10px;border: 2px solid #8ebf42;text-align: center;">
<?=$form->field($model, 'yr4qtr4')->widget(CheckboxX::classname(), [
    'initInputType' => CheckboxX::INPUT_CHECKBOX,
    'autoLabel' => false
])->label(false);?>
</td>
</tr>
</table>


<?= $form->field($model, 'proposal_id')->hiddenInput(['value'=>$proposal->id, 'maxlength' => true])->label(false) ?>
 
<div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>
</div>