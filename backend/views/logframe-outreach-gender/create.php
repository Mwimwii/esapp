<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\LogframeOutreachPersonsGender */

$this->title = 'Add record';
$this->params['breadcrumbs'][] = ['label' => 'Logframe / Outreach persons gender records', 'url' => ['index']];
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
