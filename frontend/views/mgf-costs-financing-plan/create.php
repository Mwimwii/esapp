<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfCostsFinancingPlan */

$this->title = 'Create Mgf Costs Financing Plan';
$this->params['breadcrumbs'][] = ['label' => 'Mgf Costs Financing Plans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mgf-costs-financing-plan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
