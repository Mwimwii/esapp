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
            'options' => ['id' => 'dist_id', 'custom' => true, 'required' => TRUE],
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
            'options' => ['id' => 'cmp_id', 'custom' => true, 'required' => TRUE],
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
    <div class="col-lg-2">
        <?=
                $form->field($model, "year", ['enableAjaxValidation' => true])
                ->dropDownList(\backend\models\CommodityPriceCollection::getYearsList(),
                        ['custom' => true, 'prompt' => 'Select year', 'required' => true,
                            'value' => date("Y")]
        )->label("Year");
        ?>
    </div>
    <div class="col-lg-2">
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


