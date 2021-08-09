<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AwpbTemplate */

$this->title = 'Change '.$model->fiscal_year.' fiscal year quarter';
$this->params['breadcrumbs'][] = ['label' => 'AWPB Templates', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->fiscal_year, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Change Quarter';
?>
<div class="card card-success card-outline">
    <div class="card-body">
<div class="awpb-template-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_2', [
        'model' => $model,
    ]) ?>

</div></div></idiv>
