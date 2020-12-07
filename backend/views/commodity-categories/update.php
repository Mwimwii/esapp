<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CommodityCategories */

$this->title = 'Update Commodity Categories: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Commodity Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="commodity-categories-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
