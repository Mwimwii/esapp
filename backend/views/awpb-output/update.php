<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AwpbOutput */

$this->title = 'Update Awpb Output: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Awpb Outputs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="card card-success card-outline">
    <div class="card-body">

    <h1><?= Html::encode($this->title) ?></h1>

<<<<<<< HEAD
    <?= $this->render('_form_1', [
=======
    <?= $this->render('_form', [
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
        'model' => $model,
    ]) ?>

    </div></div>
