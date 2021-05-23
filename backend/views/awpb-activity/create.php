<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AwpbActivity */

$this->title = 'Create AWPB Activity';
$this->params['breadcrumbs'][] = ['label' => 'Awpb Activities', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card card-success card-outline">
    <div class="card-body">
<div class="awpb-activity-create">
    <?= $this->render('_form', [
        'model' => $model,  "sub" => $sub
    ]) ?>

</div>
</div>
