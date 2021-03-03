<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\AwpbActivityLine */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Awpb Activity Lines', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="awpb-activity-line-view">

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
            'activity_id',
            'name',
            'unit_cost',
            'mo_1',
            'mo_2',
            'mo_3',
            'mo_4',
            'mo_5',
            'mo_6',
            'mo_7',
            'mo_8',
            'mo_9',
            'mo_10',
            'mo_11',
            'mo_12',
            'quarter_one_quantity',
            'quarter_two_quantity',
            'quarter_three_quantity',
            'quarter_four_quantity',
            'total_quantity',
            'total_amount',
            'status',
            'district_id',
            'province_id',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
        ],
    ]) ?>

</div>
