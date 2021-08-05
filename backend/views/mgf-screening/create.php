<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfScreening */

$this->title = 'Create Mgf Screening';
$this->params['breadcrumbs'][] = ['label' => 'Mgf Screenings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mgf-screening-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
