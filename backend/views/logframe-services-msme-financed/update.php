<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\LogframeServicesMsmeFinanced */

$this->title = 'Update Record';
$this->params['breadcrumbs'][] = ['label' => 'Logframe / Output Services MGF Financed records', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => "View record:".$model->id, 'url' => ['view', 'id' => $model->id]];
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
