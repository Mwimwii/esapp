<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfValueOfProductTotals */

$this->title = 'Create Mgf Value Of Product Totals';
$this->params['breadcrumbs'][] = ['label' => 'Mgf Value Of Product Totals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mgf-value-of-product-totals-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
