<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MeFaabsTrainingTopicEnrolment */

$this->title = 'Update Me Faabs Training Topic Enrolment: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Me Faabs Training Topic Enrolments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="me-faabs-training-topic-enrolment-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
