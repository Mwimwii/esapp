<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AwpbActivityFunder */

$this->title = 'Update Awpb Activity Funder: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Awpb Activity Funders', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="awpb-activity-funder-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
