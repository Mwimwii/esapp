<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfExpectedOutputsAndGrossRevenue */

<<<<<<< HEAD
$this->title = 'Create Expected Outputs and Gross Revenue';
$this->params['breadcrumbs'][] = ['label' => 'Expected Outputs and Gross Revenues', 'url' => ['index']];
=======
$this->title = 'Create Mgf Expected Outputs And Gross Revenue';
$this->params['breadcrumbs'][] = ['label' => 'Mgf Expected Outputs And Gross Revenues', 'url' => ['index']];
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mgf-expected-outputs-and-gross-revenue-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
