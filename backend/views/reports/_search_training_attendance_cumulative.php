<?php

use yii\helpers\Html;
use kartik\form\ActiveFormAsset;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\MeFaabsTrainingAttendanceSheetSearch */
/* @var $form yii\widgets\ActiveForm */
?>



<?php
if (!empty($_GET['MeFaabsTrainingAttendanceSheetSearch']['province_id'])) {
    $model->province_id = $_GET['MeFaabsTrainingAttendanceSheetSearch']['province_id'];
}
if (!empty($_GET['MeFaabsTrainingAttendanceSheetSearch']['district_id'])) {
    $model->district_id = $_GET['MeFaabsTrainingAttendanceSheetSearch']['district_id'];
}
if (!empty($_GET['MeFaabsTrainingAttendanceSheetSearch']['camp_id'])) {
    $model->camp_id = $_GET['MeFaabsTrainingAttendanceSheetSearch']['camp_id'];
}
if (!empty($_GET['MeFaabsTrainingAttendanceSheetSearch']['training_type'])) {
    $model->training_type = $_GET['MeFaabsTrainingAttendanceSheetSearch']['training_type'];
}
$form = ActiveForm::begin([
            'action' => ['training-attendance-cumulatives'],
            'method' => 'get',

        ]);
?>
<div class="row" style="">
    <div class="col-lg-2">
        <?php
        echo
                $form->field($model, 'province_id')
                ->dropDownList(
                        \backend\models\Provinces::getProvinceList(), ['id' => 'prov_id', 'custom' => true, 'prompt' => 'Please select a province', 'required' => true]
                )->label("Province");
        ?>
    </div>
    <div class="col-lg-3">
        <?php
        $model->isNewRecord = !empty($_GET['MeFaabsTrainingAttendanceSheetSearch']['province_id']) ? false : true;
        echo Html::hiddenInput('selected_id', $model->isNewRecord ? '' : $model->district_id, ['id' => 'selected_id']);

        echo $form->field($model, 'district_id')->widget(DepDrop::classname(), [
            'options' => ['id' => 'dist_id', 'custom' => true, 'required' => false],
            'pluginOptions' => [
                'depends' => ['prov_id'],
                'initialize' => $model->isNewRecord ? false : true,
                'placeholder' => 'Please select a district',
                'url' => Url::to(['/camps/district']),
                'params' => ['selected_id'],
            ]
        ])->label("District");
        ?>
    </div>
    <div class="col-lg-3">
        <?php
        echo Html::hiddenInput('selected_id3', $model->isNewRecord ? '' : $model->camp_id, ['id' => 'selected_id3']);
        echo $form->field($model, 'camp_id')->widget(DepDrop::classname(), [
            'options' => ['id' => 'cmp_id', 'custom' => true, 'required' => false],
            'pluginOptions' => [
                'depends' => ['dist_id'],
                'initialize' => $model->isNewRecord ? false : true,
                'placeholder' => 'Please select a camp',
                'url' => Url::to(['/camps/camp']),
                'params' => ['selected_id3'],
            ]
        ])->label("Camp");
        ?>
    </div>
    <div class="col-lg-3">
        <?=
                $form->field($model, "training_type")
                ->dropDownList(
                        [
                            'Participants under Direct/Intensive Training [Stream 1]' => "Direct/Intensive Training [Stream 1]",
                            "Participants under non-Direct/Other Training [Stream 2]" => "Non-Direct/Other Training [Stream 2]"
                        ], ['custom' => true, 'prompt' => 'Select training type', 'required' => true]
        );
        ?>

    </div>
    <div class="col-lg-12 form-group">
        <?= Html::submitButton('<span class="fas fa-search"></span> Search', ['class' => 'btn btn-success btn-sm']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>


