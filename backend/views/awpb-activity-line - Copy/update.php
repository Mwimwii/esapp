<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AwpbActivityLine */

$this->title = 'Update Awpb Activity Line: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Awpb Activity Lines', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="awpb-activity-line-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
