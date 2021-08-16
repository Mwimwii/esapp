<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfSustainabilityScalability */

$this->title = 'Create Mgf Sustainability Scalability';
$this->params['breadcrumbs'][] = ['label' => 'Mgf Sustainability Scalabilities', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mgf-sustainability-scalability-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
