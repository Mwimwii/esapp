<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\BackToOfficeAnnexes */

$this->title = 'Create Back To Office Annexes';
$this->params['breadcrumbs'][] = ['label' => 'Back To Office Annexes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="back-to-office-annexes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
