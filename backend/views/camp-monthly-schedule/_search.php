<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CampSubprojectRecordsAwpbObjectivesSearch */
/* @var $form yii\widgets\ActiveForm */
$months = [
    1 => "January", 2 => "February", 3 => "March", 4 => "April", 5 => "May", 6 => "June",
    7 => "July", 8 => "August", 9 => "September", 10 => "October", 11 => "November", 12 => "December"
];
?>
<?php

$form = ActiveForm::begin([
            'action' => 'index',
            'method' => 'POST',
            'id' => 'login-form-inline',
            'type' => ActiveForm::TYPE_INLINE,
            'fieldConfig' => ['options' => ['class' => 'form-group mr-2']] // spacing form field groups
        ]);
?>
<?=

$form->field($model, 'camp_id')->dropDownList(
        backend\models\Camps::getListByDistrictId(Yii::$app->user->identity->district_id), ['prompt' => 'Filter by camp', 'custom' => true]
)
?>
<?=

        $form->field($model, "month")
        ->dropDownList($months,
                ['custom' => true, 'prompt' => 'Filter by month',
                    'value' => date("n")]
);
?>
<?=

        $form->field($model, "year")
        ->dropDownList(\backend\models\CommodityPriceCollection::getYearsList(),
                ['custom' => true, 'prompt' => 'Filter by year',
                    'value' => date("Y")]
);
?>
<?= Html::submitButton('<span class="fa fa-search"></span> Filter', ['class' => 'btn btn-success mr-1']) ?>
<?php ActiveForm::end(); ?>
