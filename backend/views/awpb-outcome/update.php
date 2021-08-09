<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AwpbOutcome */

$this->title = 'Update AWPB Outcome: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'AWPB Outcomes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="card card-success card-outline">
    <div class="card-body">
<div class="awpb-outcome-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
       
    ]) ?>

</div>
</div>