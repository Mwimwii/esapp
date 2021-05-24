<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MeQuarterlyOperationsFundsRequisition */

$this->title = 'Update Me Quarterly Operations Funds Requisition: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Me Quarterly Operations Funds Requisitions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="me-quarterly-operations-funds-requisition-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
