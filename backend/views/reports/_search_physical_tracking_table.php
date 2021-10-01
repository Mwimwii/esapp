<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;

/* @var $this yii\web\View */
<<<<<<< HEAD
/* @var $model backend\models\AwbpActivitySearch */
=======
/* @var $model backend\models\AwpbBudgetSearch */
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
/* @var $form yii\widgets\ActiveForm */
?>



<?php
<<<<<<< HEAD
if (!empty($_GET['AwbpActivitySearch']['province_id'])) {
    $model->province_id = $_GET['AwbpActivitySearch']['province_id'];
}
if (!empty($_GET['AwbpActivitySearch']['district_id'])) {
    $model->district_id = $_GET['AwbpActivitySearch']['district_id'];
}
if (!empty($_GET['AwbpActivitySearch']['year'])) {
    $model->year = $_GET['AwbpActivitySearch']['year'];
=======
if (!empty($_GET['AwpbBudgetSearch']['province_id'])) {
    $model->province_id = $_GET['AwpbBudgetSearch']['province_id'];
}
if (!empty($_GET['AwpbBudgetSearch']['district_id'])) {
    $model->district_id = $_GET['AwpbBudgetSearch']['district_id'];
}
if (!empty($_GET['AwpbBudgetSearch']['year'])) {
    $model->year = $_GET['AwpbBudgetSearch']['year'];
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
}
$form = ActiveForm::begin([
            'action' => ['physical-tracking-table'],
            'method' => 'get',
            'type' => ActiveForm::TYPE_INLINE,
            'fieldConfig' => ['options' => ['class' => 'form-group mr-4']]
        ]);
?>
<div class="row" style="">
    <?php
    echo
            $form->field($model, 'province_id')
            ->dropDownList(
                    \backend\models\Provinces::getProvinceList(),
                    ['id' => 'prov_id', 'custom' => true, 'prompt' => 'Please select a province',
                        'required' => false]
            )->label("Province");

<<<<<<< HEAD
    $model->isNewRecord = !empty($_GET['AwbpActivitySearch']['province_id']) ? false : true;
=======
    $model->isNewRecord = !empty($_GET['AwpbBudgetSearch']['province_id']) ? false : true;
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
    echo Html::hiddenInput('selected_id', $model->isNewRecord ? '' : $model->district_id, ['id' => 'selected_id']);

    echo $form->field($model, 'district_id')->widget(DepDrop::classname(), [
        'options' => ['id' => 'dist_id', 'custom' => true, 'required' => false, 'style' => "width:330px;", 'placeholder' => 'Please select a district',],
        'pluginOptions' => [
            'depends' => ['prov_id'],
            'initialize' => $model->isNewRecord ? false : true,
            'placeholder' => 'Please select a district',
            'url' => Url::to(['/camps/district']),
            'params' => ['selected_id'],
        ]
    ])->label("District");

<<<<<<< HEAD
    if (isset($_GET['AwbpActivitySearch']['year']) && !empty($_GET['AwbpActivitySearch']['year'])) {
=======
    if (isset($_GET['AwpbBudgetSearch']['year']) && !empty($_GET['AwpbBudgetSearch']['year'])) {
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
        echo $form->field($model, "year")
                ->dropDownList(\backend\models\CommodityPriceCollection::getYearsList(),
                        ['custom' => true, 'prompt' => 'Select year', 'required' => true,
                        ]
                )->label("Year");
    } else {
        echo $form->field($model, "year")
                ->dropDownList(\backend\models\CommodityPriceCollection::getYearsList(),
                        ['custom' => true, 'prompt' => 'Select year', 'required' => true,
                            'value' => date("Y")]
                )->label("Year");
    }
    ?>

    <?= Html::submitButton('<span class="fas fa-search"></span> Search', ['class' => 'btn btn-success btn-sm']) ?>
</div>

<?php ActiveForm::end(); ?>


