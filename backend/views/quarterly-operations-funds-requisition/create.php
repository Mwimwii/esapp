<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MeQuarterlyOperationsFundsRequisition */

$this->title = 'Create Me Quarterly Operations Funds Requisition';
$this->params['breadcrumbs'][] = ['label' => 'Me Quarterly Operations Funds Requisitions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="me-quarterly-operations-funds-requisition-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
