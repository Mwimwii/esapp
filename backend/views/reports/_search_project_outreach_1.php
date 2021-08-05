<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\ProjectOutreachSearch */
/* @var $form yii\widgets\ActiveForm */
?>



<?php
$model->year = date("Y");
if (!empty($_GET['ProjectOutreachSearch']['year'])) {
    $model->year = $_GET['ProjectOutreachSearch']['year'];
}
$form = ActiveForm::begin([
            'action' => ['project-outreach-report'],
            'method' => 'get',
        ]);
?>
<div class="row" style="">
    <div class="col-lg-2">
        <?php
        echo
                $form->field($model, 'province_id')
                ->dropDownList(
                        \backend\models\Provinces::getProvinceList(),
                        ['id' => 'prov_id', 'custom' => true, 'prompt' => 'Select a province',
                            'required' => true]
                )->label("Province");
        ?>
    </div>
    <div class="col-lg-3">
        <?php
        $model->isNewRecord = !empty($_GET['ProjectOutreachSearch']['province_id']) ? false : true;
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
    <div class="col-lg-2">
        <?=
                $form->field($model, "year")
                ->dropDownList(\backend\models\CommodityPriceCollection::getYearsList(),
                        ['custom' => true, 'prompt' => 'Select year', 'required' => true,]
                )->label("Year");
        ?>
    </div>
    <div class="col-lg-12 form-group">
        <?= Html::submitButton('<span class="fas fa-search"></span> Filter', ['class' => 'btn btn-success btn-sm']) ?>
        &nbsp;
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary btn-sm', 'id' => '_reset']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>
