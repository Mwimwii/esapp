<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\LogframeOutputInvestmentsProsmallholderMsmeMatchingGrants */

$this->title = 'Add record';
$this->params['breadcrumbs'][] = ['label' => 'Logframe / Output Investments through Pro-Smallholder MGF records', 'url' => ['index']];
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
