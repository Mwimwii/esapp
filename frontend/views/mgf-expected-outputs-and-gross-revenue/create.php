<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfExpectedOutputsAndGrossRevenue */

$this->title = 'Create Expected Outputs and Gross Revenue';
$this->params['breadcrumbs'][] = ['label' => 'Expected Outputs and Gross Revenues', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mgf-expected-outputs-and-gross-revenue-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
