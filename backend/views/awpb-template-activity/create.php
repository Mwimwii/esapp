<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AwpbTemplateActivity */

$this->title = 'Link Activity to AWPB Template ';
$this->params['breadcrumbs'][] = ['label' => 'AWPB Template and Activities', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card card-success card-outline">
    <div class="card-body">
<div class="awpb-template-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div></div>


