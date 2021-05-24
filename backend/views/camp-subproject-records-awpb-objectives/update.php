<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MeCampSubprojectRecordsAwpbObjectives */

$this->title = 'Update Me Camp Subproject Records Awpb Objectives: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Me Camp Subproject Records Awpb Objectives', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="me-camp-subproject-records-awpb-objectives-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
