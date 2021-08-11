<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfCumulativeProfit */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Mgf Cumulative Profits', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="mgf-cumulative-profit-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'cumulative_profit_yr1_value',
            'cumulative_profit_yr2_value',
            'cumulative_profit_yr3_value',
            'cumulative_profit_yr4_value',
            'proposal_id',
            'date_created',
            'date_update',
            'created_by',
            'updated_by',
        ],
    ]) ?>

</div>
