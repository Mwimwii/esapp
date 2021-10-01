<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfVariableFixedCostTotals */

$this->title = 'Update Mgf Variable Fixed Cost Totals: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Mgf Variable Fixed Cost Totals', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mgf-variable-fixed-cost-totals-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
