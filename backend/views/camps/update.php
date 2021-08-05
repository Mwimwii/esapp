<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MeFaabsTrainingTopics */

$this->title = 'Update camp';
$this->params['breadcrumbs'][] = ['label' => 'Camps', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
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
