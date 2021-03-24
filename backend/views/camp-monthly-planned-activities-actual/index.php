<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MeCampSubprojectRecordsMonthlyPlannedActivitiesActualSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Me Camp Subproject Records Monthly Planned Activities Actuals';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="me-camp-subproject-records-monthly-planned-activities-actual-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Me Camp Subproject Records Monthly Planned Activities Actual', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'planned_activity_id',
            'hours_worked_field',
            'hours_worked_office',
            'hours_worked_total',
            //'achieved_activity_target',
            //'beneficiary_target_achieved_total',
            //'beneficiary_target_achieved_women',
            //'beneficiary_target_achieved_youth',
            //'beneficiary_target_achieved_women_headed',
            //'remarks:ntext',
            //'year',
            //'month',
            //'created_at',
            //'updated_at',
            //'created_by',
            //'updated_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
