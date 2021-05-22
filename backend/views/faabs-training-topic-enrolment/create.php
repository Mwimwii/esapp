<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MeFaabsTrainingTopicEnrolment */

$this->title = 'Create Me Faabs Training Topic Enrolment';
$this->params['breadcrumbs'][] = ['label' => 'Me Faabs Training Topic Enrolments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="me-faabs-training-topic-enrolment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
