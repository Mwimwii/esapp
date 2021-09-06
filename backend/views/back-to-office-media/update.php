<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\BackToOfficeAnnexes */

$this->title = 'Update Back To Office Annexes: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Back To Office Annexes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="back-to-office-annexes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
