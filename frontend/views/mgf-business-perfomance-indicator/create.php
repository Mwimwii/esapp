<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfBusinessPerfomanceIndicator */

$this->title = 'Create Mgf Business Perfomance Indicator';
$this->params['breadcrumbs'][] = ['label' => 'Mgf Business Perfomance Indicators', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mgf-business-perfomance-indicator-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
