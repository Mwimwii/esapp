<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AwpbActivity */

$this->title = 'Create Awpb Activity';
$this->params['breadcrumbs'][] = ['label' => 'Awpb Activities', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="awpb-activity-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
