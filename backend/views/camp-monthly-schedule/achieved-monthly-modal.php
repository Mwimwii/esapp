<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\touchspin\TouchSpin;

$_model = backend\models\MeCampSubprojectRecordsMonthlyPlannedActivities::findOne($id);
$model->target_women= $_model->beneficiary_target_women;
$model->target_youth=$_model->beneficiary_target_youth;
$model->target_women_headed= $_model->beneficiary_target_women_headed;

$form = ActiveForm::begin([
        ]);
?>
<div class="row">
    <div class="col-lg-6">
        <?php
        echo $form->field($model, 'hours_worked_field')->widget(TouchSpin::classname(), [
            'options' => [],
            'pluginOptions' => [
                'min' => 0,
                'max' => 24,
            ],
        ]);
        echo $form->field($model, 'hours_worked_office')->widget(TouchSpin::classname(), [
            'options' => [],
            'pluginOptions' => [
                'min' => 0,
                'max' => 24,
            ],
        ]);

        echo $form->field($model, 'achieved_activity_target')->widget(TouchSpin::classname(), [
            'options' => [],
            'pluginOptions' => [
                // 'initval' => 3.00,
                'min' => 0,
                'max' => $_model->activity_target,
            // 'max' => 10000,
            ],
        ]);
        echo $form->field($model, 'beneficiary_target_achieved_women')->widget(TouchSpin::classname(), [
            'options' => [],
            'pluginOptions' => [
                // 'initval' => 3.00,
                'min' => 0,
                //  'max' => $_model->beneficiary_target_women,
                'max' => 10000,
            ],
        ]);
        echo $form->field($model, 'beneficiary_target_achieved_youth')->widget(TouchSpin::classname(), [
            'options' => [],
            'pluginOptions' => [
                // 'initval' => 3.00,
                'min' => 0,
                'max' => 10000,
            ],
        ]);

        echo $form->field($model, 'beneficiary_target_achieved_women_headed')->widget(TouchSpin::classname(), [
            'options' => [],
            'pluginOptions' => [
                // 'initval' => 3.00,
                'min' => 0,
                'max' => 10000,
            ],
        ]);
        echo $form->field($model, 'remarks')->textarea(['rows' => 4, 'placeholder' =>
            'Any remarks'])->label("Remarks ");
        ?>
    </div>
    <div class="col-lg-6">
        <b>Instructions</b>
        <ol>
            <li>Fields marked with <i style="color: red;">*</i> are required</span>
            </li>
            <li>The system will do the total calculations in the background
            </li>
            <li>below are the planned for activity targets
            </li>
        </ol>
        <hr class="dotted">
        <p>
        <strong><?= \backend\models\AwpbActivity::findOne($_model->activity_id)->name ?> activity <?= DateTime::createFromFormat('!m', backend\models\MeCampSubprojectRecordsPlannedWorkEffort::findOne($_model->work_effort_id)->month)->format('F') ?> planned targets</strong>
        <ul>
            <b>FaaBS:</b> <?= backend\models\MeFaabsGroups::findOne($_model->faabs_id)->name ?><br/>
            <b>Activity target:</b> <?= $_model->activity_target ?><br/>
            <b>Beneficiary target women:</b> <?= $_model->beneficiary_target_women ?><br/>
            <b>Beneficiary target youth:</b> <?= $_model->beneficiary_target_youth ?><br/>
            <b>Beneficiary target women headed:</b> <?= $_model->beneficiary_target_women_headed ?><br/>
            <b>Beneficiary total:</b> <?= $_model->beneficiary_target_total ?><br/>
        </ul>
        </p>
    </div>
</div>

<div class="col-md-12">
    <hr class="dotted"/>
    <?= Html::submitButton('Submit activity actual', ['class' => 'btn btn-success btn-xs']) ?>

</div>
</div>
<?php ActiveForm::end(); ?>
