<?php

use backend\models\User;
use frontend\models\MgfConceptNote;
use yii\helpers\Html;
use yii\grid\GridView;
use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;
use dosamigos\datepicker\DatePicker;
use frontend\models\MgfOperation;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MgfConceptNoteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'MGF Project Concept Notes';
?>

<div class="card card-success card-outline">
<div class="card-body">
<h3><?= Html::encode($this->title) ?></h3>
<hr class="dotted short">

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'rowOptions' => function ($model) {
        if ($model->application->is_active==1) {
            return ['class'=>'success'];
        } else {
            return ['class'=>'danger'];
        }
    },
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'project_title',
        'estimated_cost',
        'starting_date',
        'operation.operation_type',
        'implimentation_period',
        ['label'=>'Status','value'=>'application.application_status'],
        'organisation.cooperative',
        'date_created',
        'date_submitted',
        ['class' => 'yii\grid\ActionColumn','template' => '{view}']
    ],
]); ?>

</div>
</div>





