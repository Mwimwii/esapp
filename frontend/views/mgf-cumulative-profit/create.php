<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfCumulativeProfit */

$this->title = 'Create Mgf Cumulative Profit';
$this->params['breadcrumbs'][] = ['label' => 'Mgf Cumulative Profits', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mgf-cumulative-profit-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
