<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AwpbActivityLineItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Awpb Activity Line Items';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="awpb-activity-line-item-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Awpb Activity Line Item', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'activity_id',
            'commodity_type_id',
            'description',
            'unit_cost',
            //'quarter_one_quantity',
            //'quarter_two_quantity',
            //'quarter_three_quantity',
            //'quarter_four_quantity',
            //'total_quantity',
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
