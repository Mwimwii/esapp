<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TimeSheetsDistrictStaff */

$this->title = 'Update Time Sheets District Staff: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Time Sheets District Staff', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => "Timesheet #:".$model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="card card-success card-outline">
    <div class="card-body">
        <h5>Instructions</h5>
        <ol>
            <li>Make sure all fields are correct before submitting for approval. You will not be able to make changes once submitted
            </li>
            <!--<li>Fill out the form below and click <span class="badge badge-success">Save as draft</span> to save the report for later editing and
                click <span class="badge badge-info">Submit for approval</span> to submit for approval
            </li>-->
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
