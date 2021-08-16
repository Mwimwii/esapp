<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MgfCumulativeProfitSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mgf Cumulative Profits';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mgf-cumulative-profit-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Mgf Cumulative Profit', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'cumulative_profit_yr1_value',
            'cumulative_profit_yr2_value',
            'cumulative_profit_yr3_value',
            'cumulative_profit_yr4_value',
            //'proposal_id',
            //'date_created',
            //'date_update',
            //'created_by',
            //'updated_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
