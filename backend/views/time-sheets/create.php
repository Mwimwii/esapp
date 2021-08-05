<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TimeSheetsDistrictStaff */

$this->title = 'Create Time Sheets District Staff';
$this->params['breadcrumbs'][] = ['label' => 'Time Sheets District Staff', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="time-sheets-district-staff-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
