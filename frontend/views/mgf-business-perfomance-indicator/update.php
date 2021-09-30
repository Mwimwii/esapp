<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfBusinessPerfomanceIndicator */

<<<<<<< HEAD
$this->title = 'Update Mgf Business Perfomance Indicator';
=======
$this->title = 'Update Mgf Business Perfomance Indicator: ' . $model->id;
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
$this->params['breadcrumbs'][] = ['label' => 'Mgf Business Perfomance Indicators', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mgf-business-perfomance-indicator-update">

    <h1><?= Html::encode($this->title) ?></h1>
<<<<<<< HEAD
    <p>
    <?= Html::a('Home', ['mgf-applicant/profile'], ['class' => 'btn btn-success']) ?>
    <?= Html::a('Back', ['mgf-business-perfomance-indicator/index'], ['class' => 'btn btn-success']) ?>
    </p>
=======
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
