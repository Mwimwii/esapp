<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AwpbActivityFunder */

$this->title = 'Create Awpb Activity Funder';
$this->params['breadcrumbs'][] = ['label' => 'Awpb Activity Funders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="awpb-activity-funder-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
