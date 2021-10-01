<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfValueOfProduct */

$this->title = 'Update Mgf Value Of Product: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Mgf Value Of Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mgf-value-of-product-update">

    <h1><?= Html::encode($this->title) ?></h1>
<<<<<<< HEAD
    <?= Html::a('Home', ['/mgf-applicant/profile',], ['class' => 'btn btn-success']);?>    
    <?= Html::a('<i class="fa fa-backward"></i>Back', ['/mgf-value-of-product/index',], ['class' => 'btn btn-success']);?>
=======
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
