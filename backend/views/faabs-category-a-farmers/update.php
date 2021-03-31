<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MeFaabsCategoryAFarmers */
$name = $model->title . "" . $model->first_name . " " . $model->other_names . " " . $model->last_name;
$this->title = 'Update Category \'A\' Farmer: ';
$this->params['breadcrumbs'][] = ['label' => 'Category \'A\' Farmers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="card card-success card-outline">
    <div class="card-body">

        <?=
        $this->render('_form', [
            'model' => $model,
        ])
        ?>

    </div>
</div>
