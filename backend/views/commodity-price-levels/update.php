<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CommodityPriceLevels */

$this->title = 'Update Commodity Price Levels: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Commodity Price Levels', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="commodity-price-levels-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
