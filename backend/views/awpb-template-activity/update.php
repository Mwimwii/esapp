<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AwpbTemplateActivity */

<<<<<<< HEAD
$this->title = 'Update Awpb Template Activity: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Awpb Template Activities', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
=======
$this->title = 'Update Awpb Template Activity: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Awpb Template Activities', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="awpb-template-activity-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
