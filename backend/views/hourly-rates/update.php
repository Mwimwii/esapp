<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\HourlyRates */

$this->title = 'Update Hourly Rates: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Hourly Rates', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="hourly-rates-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
