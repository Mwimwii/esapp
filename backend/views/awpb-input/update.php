<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AwpbBudget */

$this->title = 'Update AWPB Input: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'AWPB Input', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="card card-success card-outline">
    <div class="card-body">
<div class="awpb-activity-line-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
         'id'=>$model->budget_id
    ]) ?>

</div></div>
</div>

