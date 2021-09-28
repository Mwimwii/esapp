<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfImplementationArrangementsCooperatingPartners */

$this->title = 'Create Implementation Arrangements';
$this->params['breadcrumbs'][] = ['label' => 'Mgf Implementation Arrangements Cooperating Partners', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mgf-implementation-arrangements-cooperating-partners-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
