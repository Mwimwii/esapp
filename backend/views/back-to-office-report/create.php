<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MeBackToOfficeReport */

$this->title = 'Submit Back to office report';
$this->params['breadcrumbs'][] = ['label' => 'My Back to office reports', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card card-success card-outline">
    <div class="card-body">
        <h5>Instructions</h5>
        <ol>
            <li>The system assumes that the logged in user is the officer who went out to the field or out on assignment hence you will not edit <code>'Names of the officer'</code>
            </li>
            <li>Fill out the form below and click <span class="badge badge-success">Save as draft</span> to save the report for later editing and
                click <span class="badge badge-info">Submit for review</span> to submit for review
            </li>
            <li>Fields marked with <i style="color:red;">*</i> are required
            </li>
        </ol>  

        <?=
        $this->render('_form', [
            'model' => $model,
        ])
        ?>

    </div>
</div>
