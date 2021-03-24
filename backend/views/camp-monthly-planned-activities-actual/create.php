<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MeCampSubprojectRecordsMonthlyPlannedActivitiesActual */

$this->title = 'Create Me Camp Subproject Records Monthly Planned Activities Actual';
$this->params['breadcrumbs'][] = ['label' => 'Me Camp Subproject Records Monthly Planned Activities Actuals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="me-camp-subproject-records-monthly-planned-activities-actual-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
