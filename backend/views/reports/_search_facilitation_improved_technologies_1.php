<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\MeFaabsTrainingAttendanceSheetSearch */
/* @var $form yii\widgets\ActiveForm */
?>



<?php
$form = ActiveForm::begin([
            'action' => ['facilitation-imporoved-technologies'],
            'method' => 'get',
        ]);
?>
<div class="row" style="">
    <div class="col-lg-4">
        <?php
        echo
                $form->field($model, 'camp_id')
                ->dropDownList(
                        \backend\models\Camps::getListByDistrictId(Yii::$app->user->identity->district_id), ['prompt' => 'Please select a camp', 'required' => true]
        );
        ?>
    </div>
    <div class="col-lg-4">
        <?=
                $form->field($model, "year", ['enableAjaxValidation' => true])
                ->dropDownList(\backend\models\CommodityPriceCollection::getYearsList(),
                        ['custom' => true, 'prompt' => 'Select year', 'required' => true,
                            'value' => date("Y")]
                )->label("Year");
        ?>
    </div>
    <div class="col-lg-4">
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
    </div>
    <div class="col-lg-12 form-group">
        <?= Html::submitButton('<span class="fas fa-search"></span> Search', ['class' => 'btn btn-success btn-sm']) ?>
        &nbsp;
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary btn-sm', 'id' => '_reset']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>


