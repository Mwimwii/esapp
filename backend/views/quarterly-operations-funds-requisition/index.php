<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MeQuarterlyOperationsFundsRequisitionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Me Quarterly Operations Funds Requisitions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="me-quarterly-operations-funds-requisition-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Me Quarterly Operations Funds Requisition', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'quarter_workplan_id',
            'budget_estimate_month_1',
            'budget_estimate_month_2',
            'budget_estimate_month_3',
            //'created_at',
            //'updated_at',
            //'created_by',
            //'updated_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
