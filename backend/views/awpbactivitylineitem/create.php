<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AwpbActivityLineItem */

$this->title = 'Create Awpb Activity Line Item';
$this->params['breadcrumbs'][] = ['label' => 'Awpb Activity Line Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="awpb-activity-line-item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
