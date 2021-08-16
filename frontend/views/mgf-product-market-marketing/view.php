<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfProductMarketMarketing */

$this->title = "Product and Marketing";
$this->params['breadcrumbs'][] = ['label' => 'Mgf Product Market Marketings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="mgf-product-market-marketing-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<i class="fa fa-backward"></i>Back', ['/mgf-product-market-marketing/index',], ['class' => 'btn btn-default']);?>
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
            //'id',
            'marketing',
            'market_outlets',
            'sales_contract',
            'person_responsible',
            'competition_penetration',
            'future_prospects',
            'branding_market_penetration',
            'proposal_id',
           // 'date_created',
            //'date_update',
            //'created_by',
            //'updated_by',
        ],
    ]) ?>

</div>
