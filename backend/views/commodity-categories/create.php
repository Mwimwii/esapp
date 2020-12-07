<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CommodityCategories */

$this->title = 'Create Commodity Categories';
$this->params['breadcrumbs'][] = ['label' => 'Commodity Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="commodity-categories-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
