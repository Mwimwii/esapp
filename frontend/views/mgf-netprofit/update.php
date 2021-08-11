<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfNetprofit */

$this->title = 'Update Mgf Netprofit: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Mgf Netprofits', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mgf-netprofit-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
