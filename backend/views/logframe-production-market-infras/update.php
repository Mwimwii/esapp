<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\LogframeOutputProductionMarketingInfrastructure */

$this->title = 'Update Record' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Logframe / Output Production/Marketing Insfrastructure records', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' =>"View record:". $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="card card-success card-outline">
    <div class="card-body">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>
