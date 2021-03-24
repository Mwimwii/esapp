<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MeCampSubprojectRecordsMonthlyPlannedActivities */

$this->title = 'Create Me Camp Subproject Records Monthly Planned Activities';
$this->params['breadcrumbs'][] = ['label' => 'Me Camp Subproject Records Monthly Planned Activities', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="me-camp-subproject-records-monthly-planned-activities-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
