<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfVariableFixedCostTotals */

$this->title = 'Create Mgf Variable Fixed Cost Totals';
$this->params['breadcrumbs'][] = ['label' => 'Mgf Variable Fixed Cost Totals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mgf-variable-fixed-cost-totals-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
