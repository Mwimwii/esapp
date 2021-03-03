<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AwpbActivityLineSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Awpb Activity Lines';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="awpb-activity-line-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Awpb Activity Line', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'activity_id',
            'name',
            'unit_cost',
            'mo_1',
            //'mo_2',
            //'mo_3',
            //'mo_4',
            //'mo_5',
            //'mo_6',
            //'mo_7',
            //'mo_8',
            //'mo_9',
            //'mo_10',
            //'mo_11',
            //'mo_12',
            //'quarter_one_quantity',
            //'quarter_two_quantity',
            //'quarter_three_quantity',
            //'quarter_four_quantity',
            //'total_quantity',
            //'total_amount',
            //'status',
            //'district_id',
            //'province_id',
            //'created_at',
            //'updated_at',
            //'created_by',
            //'updated_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
