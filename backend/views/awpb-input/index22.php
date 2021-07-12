<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AwpbInputSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Awpb Inputs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="awpb-input-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Awpb Input', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'activity_id',
            'awpb_template_id',
            'indicator_id',
            'name',
            //'unit_cost',
            //'mo_1',
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
            //'mo_1_amount',
            //'mo_2_amount',
            //'mo_3_amount',
            //'mo_4_amount',
            //'mo_5_amount',
            //'mo_6_amount',
            //'mo_7_amount',
            //'mo_8_amount',
            //'mo_9_amount',
            //'mo_10_amount',
            //'mo_11_amount',
            //'mo_12_amount',
            //'quarter_one_amount',
            //'quarter_two_amount',
            //'quarter_three_amount',
            //'quarter_four_amount',
            //'total_amount',
            //'mo_1_actual',
            //'mo_2_actual',
            //'mo_3_actual',
            //'mo_4_actual',
            //'mo_5_actual',
            //'mo_6_actual',
            //'mo_7_actual',
            //'mo_8_actual',
            //'mo_9_actual',
            //'mo_10_actual',
            //'mo_11_actual',
            //'mo_12_actual',
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
