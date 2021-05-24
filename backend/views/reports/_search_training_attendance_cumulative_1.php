<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\MeFaabsTrainingAttendanceSheetSearch */
/* @var $form yii\widgets\ActiveForm */
?>



<?php
if (!empty($_GET['MeFaabsTrainingAttendanceSheetSearch']['camp_id'])) {
    $model->camp_id = $_GET['MeFaabsTrainingAttendanceSheetSearch']['camp_id'];
}
if (!empty($_GET['MeFaabsTrainingAttendanceSheetSearch']['training_type'])) {
    $model->training_type = $_GET['MeFaabsTrainingAttendanceSheetSearch']['training_type'];
}
$form = ActiveForm::begin([
            'action' => ['training-attendance-cumulatives'],
            'method' => 'get',
            'type' => ActiveForm::TYPE_INLINE,
            'fieldConfig' => ['options' => ['class' => 'form-group mr-4']]
        ]);
?>
<div class="row" style="">

    <?php
    echo
            $form->field($model, 'camp_id')
            ->dropDownList(
                    \backend\models\Camps::getListByDistrictId(Yii::$app->user->identity->district_id), ['prompt' => 'Please select a camp', 'required' => true, 'custom' => true]
    );
    ?>

    <?=
            $form->field($model, "training_type")
            ->dropDownList(
                    [
                        'Participants under Direct/Intensive Training [Stream 1]' => "Direct/Intensive Training [Stream 1]",
                        "Participants under non-Direct/Other Training [Stream 2]" => "Non-Direct/Other Training [Stream 2]"
                    ], ['custom' => true, 'prompt' => 'Select training type', 'required' => true]
    );
    ?>
    <?= Html::submitButton('<span class="fas fa-search"></span> Search', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>


