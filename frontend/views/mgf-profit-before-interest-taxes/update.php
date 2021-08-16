<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfProfitBeforeInterestTaxes */

$this->title = 'Update Mgf Profit Before Interest Taxes: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Mgf Profit Before Interest Taxes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mgf-profit-before-interest-taxes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
