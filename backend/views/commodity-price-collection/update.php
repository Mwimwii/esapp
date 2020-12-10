<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\CommodityPriceCollection */

$this->title = 'Update Commodity Price Collection: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Commodity Price Collections', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="commodity-price-collection-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
