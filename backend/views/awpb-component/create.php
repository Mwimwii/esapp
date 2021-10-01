<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AwpbComponent */




$this->title = 'Create Component';
$this->params['breadcrumbs'][] = ['label' => 'Components', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="card card-success card-outline">
    <div class="card-body">

    <?= $this->render('_form', [
        'model' => $model,
        "sub_component" => $sub_component
        
    ]) ?>
    </div>
</div>
