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
if (!empty($_GET['MeFaabsTrainingAttendanceSheetSearch']['year'])) {
    $model->year = $_GET['MeFaabsTrainingAttendanceSheetSearch']['year'];
}
if (!empty($_GET['MeFaabsTrainingAttendanceSheetSearch']['quarter'])) {
    $model->quarter = $_GET['MeFaabsTrainingAttendanceSheetSearch']['quarter'];
}
$form = ActiveForm::begin([
            'action' => ['facilitation-imporoved-technologies'],
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
                    \backend\models\Camps::getListByDistrictId(Yii::$app->user->identity->district_id),
                    [
                        'prompt' => 'Please select a camp',
                        'required' => true,
                        'custom' => true
                    ]
            )->label("Camp");
    ?>
    <?=
            $form->field($model, "year", ['enableAjaxValidation' => true])
            ->dropDownList(\backend\models\CommodityPriceCollection::getYearsList(),
                    ['custom' => true, 'prompt' => 'Select year', 'required' => true,
                        'value' => date("Y")]
            )->label("Year");
    ?>
    <?=
    $form->field($model, 'quarter', [
    ])->dropDownList(
            [
                1 => 'Quarter one',
                2 => 'Quarter two',
                3 => 'Quarter three',
                4 => 'Quarter four',
            ], [
        'custom' => true,
        'prompt' => 'Please select a Quarter',
        'required' => false,
            ]
    );
    ?>

    <?= Html::submitButton('<span class="fas fa-search"></span> Search', ['class' => 'btn btn-success btn-sm']) ?>


</div>

<?php ActiveForm::end(); ?>


