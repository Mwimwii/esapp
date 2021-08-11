<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfInterestsTaxes */

$this->title = 'Update Mgf Interests Taxes: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Mgf Interests Taxes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mgf-interests-taxes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
