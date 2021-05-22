<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MeFaabsTrainingTopics */

$this->title = 'Update FaaBS training topic';
$this->params['breadcrumbs'][] = ['label' => 'FaaBS training topics', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => "Topic #".$model->id, 'url' => ['view', 'id' => $model->id]];
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
