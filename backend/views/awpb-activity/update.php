<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AwpbActivity */

$this->title = 'Update AWPB Activity ' . $model->activity_code;
$this->params['breadcrumbs'][] = ['label' => 'AWPB Activities', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->activity_code, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="card card-success card-outline">
    <div class="card-body">

<div class="awpb-activity-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_1', [
        'model' => $model,  "sub" => $sub
    ]) ?>

</div>
</div>
