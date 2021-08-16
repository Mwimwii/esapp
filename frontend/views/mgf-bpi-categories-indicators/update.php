<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfBpiCategoriesIndicators */

$this->title = 'Update Mgf Bpi Categories Indicators: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Mgf Bpi Categories Indicators', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mgf-bpi-categories-indicators-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
