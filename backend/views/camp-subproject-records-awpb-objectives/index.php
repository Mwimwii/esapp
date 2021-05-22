<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\builder\TabularForm;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CampSubprojectRecordsAwpbObjectivesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Camp/Project AWPB objectives';
$this->params['breadcrumbs'][] = $this->title;

if (!empty($camp_id)) {
    $model->camp_id = $camp_id;
}
?>
<div class="card card-success card-outline">
    <div class="card-body">
        <h5>Instructions</h5>
        <ol>
            <li>You can set or view Camp/Project AWPB objectives here. Select the camp and year below
            </li>
            <li>You will only be able to set objectives for the current year. The other years you can only view
            </li>
        </ol>
        <?php echo $this->render('_search', ['model' => $model]); ?>
        <hr class="dotted">

        <?php
        if (!empty($dataProvider) && $dataProvider->getCount() > 0) {
          
            $form = ActiveForm::begin(['enableClientValidation' => true,
                        'action' => 'save-objectives?camp=' . $model->camp_id . "&year=" . $model->year,
                        'fieldConfig' => [
                            'options' => [
                            ],
                        ],
            ]);
            echo TabularForm::widget([
                'dataProvider' => $dataProvider,
                'form' => $form,
                'attributes' => \backend\models\MeCampSubprojectRecordsAwpbObjectives::getFormAttribs(),
                'actionColumn' => false,
                'checkboxColumn' => false,
                'gridSettings' => [
                    'condensed' => true,
                    'options' => ["style" => "font-size:12px;"],
                ],
            ]);
            echo '<div class="text-left"><hr class="dotted">' .
            Html::submitButton('Save camp objectives', ['class' => 'btn btn-success btn-sm']) .
            '<div>';
            ActiveForm::end();
        }
        ?>

    </div>
</div>
