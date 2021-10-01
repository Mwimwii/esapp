<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfBusinessPerfomanceIndicator */

$this->title = 'Update Mgf Business Perfomance Indicator';
$this->params['breadcrumbs'][] = ['label' => 'Mgf Business Perfomance Indicators', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mgf-business-perfomance-indicator-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
    <?= Html::a('Home', ['mgf-applicant/profile'], ['class' => 'btn btn-success']) ?>
    <?= Html::a('Back', ['mgf-business-perfomance-indicator/index'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
