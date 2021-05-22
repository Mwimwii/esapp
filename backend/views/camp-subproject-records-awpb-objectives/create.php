<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MeCampSubprojectRecordsAwpbObjectives */

$this->title = 'Create Me Camp Subproject Records Awpb Objectives';
$this->params['breadcrumbs'][] = ['label' => 'Me Camp Subproject Records Awpb Objectives', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="me-camp-subproject-records-awpb-objectives-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
