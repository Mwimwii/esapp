<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\LogframeOutreachPersonsGender */

$this->title = 'Update record';
$this->params['breadcrumbs'][] = ['label' => 'Logframe / Output People Trained Climate Services records', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => "View record:". $model->id, 'url' => ['view', 'id' => $model->id]];
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
