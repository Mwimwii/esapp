<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ProjectOutreach */

$this->title = 'Add Project outreach record';
$this->params['breadcrumbs'][] = ['label' => 'Project outreach records', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card card-success card-outline">
    <div class="card-body">
        <ol>
            <li>
                All project outreach records are for <code>Component 2: Sustainable Agribusiness Partnerships</code>
            </li>
            <li>Fields marked with <code>*</code> are required</li>
        </ol>
        <?=
        $this->render('_form', [
            'model' => $model,
        ])
        ?>

    </div>
</div>
