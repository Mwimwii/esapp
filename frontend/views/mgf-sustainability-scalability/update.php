<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfSustainabilityScalability */

$this->title = 'Update Sustainability Scalability: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Mgf Sustainability Scalabilities', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mgf-sustainability-scalability-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= Html::a('Home', ['/mgf-applicant/profile',], ['class' => 'btn btn-success']);?>
    <?= Html::a('Back', ['/mgf-sustainability-scalability/index',], ['class' => 'btn btn-success']);?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
