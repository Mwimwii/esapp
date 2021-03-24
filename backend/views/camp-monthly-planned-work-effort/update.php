<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MeCampSubprojectRecordsPlannedWorkEffort */

$this->title = 'Update Me Camp Subproject Records Planned Work Effort: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Me Camp Subproject Records Planned Work Efforts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="me-camp-subproject-records-planned-work-effort-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
