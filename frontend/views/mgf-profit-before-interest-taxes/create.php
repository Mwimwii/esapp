<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfProfitBeforeInterestTaxes */

$this->title = 'Create Mgf Profit Before Interest Taxes';
$this->params['breadcrumbs'][] = ['label' => 'Mgf Profit Before Interest Taxes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mgf-profit-before-interest-taxes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
