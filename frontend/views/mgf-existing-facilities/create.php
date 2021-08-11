<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MgfExistingFacilities */

$this->title = 'Create Mgf Existing Facilities';
$this->params['breadcrumbs'][] = ['label' => 'Mgf Existing Facilities', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mgf-existing-facilities-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
