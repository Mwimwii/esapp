<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfImplementationScheduleShort */

$this->title = 'Create Mgf Implementation Schedule Short';
$this->params['breadcrumbs'][] = ['label' => 'Mgf Implementation Schedule Shorts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mgf-implementation-schedule-short-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
