<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CommodityPriceLevels */

$this->title = 'Create Commodity Price Levels';
$this->params['breadcrumbs'][] = ['label' => 'Commodity Price Levels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="commodity-price-levels-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
