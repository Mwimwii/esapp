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
 $model->year=date("Y");
if (!empty($_GET['ProjectOutreachSearch']['year'])) {
    $model->year = $_GET['ProjectOutreachSearch']['year'];
}
$form = ActiveForm::begin([
            'action' => ['project-outreach-report'],
            'method' => 'get',
        ]);
?>
<div class="row" style="">
    <div class="col-lg-6">
        <?=
        $form->field($model, 'year', [
            'addon' => [
                'append' => [
                    'content' => Html::submitButton('Filter', ['class' => 'btn btn-success btn-sm']),
                    'asButton' => true
                ]
            ]
        ])->dropDownList(\backend\models\CommodityPriceCollection::getYearsList(),
                ['custom' => true, 'prompt' => 'Select year', 'required' => true,
                    ]
        )->label(false);
        ?>
    </div>
</div>

<?php ActiveForm::end(); ?>
