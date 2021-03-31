<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MeFaabsCategoryAFarmers */

$this->title = ' Add Category \'A\' Farmer';
$this->params['breadcrumbs'][] = ['label' => 'Category \'A\' Farmers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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
