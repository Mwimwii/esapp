<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MeQuarterlyWorkPlan */

$this->title = 'Update Me Quarterly Work Plan: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Me Quarterly Work Plans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="me-quarterly-work-plan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
