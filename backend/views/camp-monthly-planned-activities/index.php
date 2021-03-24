<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MeCampSubprojectRecordsMonthlyPlannedActivitiesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Me Camp Subproject Records Monthly Planned Activities';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="me-camp-subproject-records-monthly-planned-activities-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Me Camp Subproject Records Monthly Planned Activities', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'camp_id',
            'activity_id',
            'faabs_id',
            'month',
            //'year',
            //'zone',
            //'activity_target',
            //'beneficiary_target_total',
            //'beneficiary_target_women',
            //'beneficiary_target_youth',
            //'beneficiary_target_women_headed',
            //'created_at',
            //'updated_at',
            //'created_by',
            //'updated_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
