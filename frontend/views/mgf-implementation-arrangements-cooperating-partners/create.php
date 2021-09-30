<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfImplementationArrangementsCooperatingPartners */

<<<<<<< HEAD
$this->title = 'Create Implementation Arrangements';
=======
$this->title = 'Create Mgf Implementation Arrangements Cooperating Partners';
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
$this->params['breadcrumbs'][] = ['label' => 'Mgf Implementation Arrangements Cooperating Partners', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mgf-implementation-arrangements-cooperating-partners-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
