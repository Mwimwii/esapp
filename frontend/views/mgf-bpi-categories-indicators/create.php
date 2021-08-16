<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfBpiCategoriesIndicators */

$this->title = 'Create Mgf Bpi Categories Indicators';
$this->params['breadcrumbs'][] = ['label' => 'Mgf Bpi Categories Indicators', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mgf-bpi-categories-indicators-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
