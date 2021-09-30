<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AwpbFundsRequisition */

$this->title = 'Create Awpb Funds Requisition';
$this->params['breadcrumbs'][] = ['label' => 'Awpb Funds Requisitions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="awpb-funds-requisition-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
