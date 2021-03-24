<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MeCampSubprojectRecordsPlannedWorkEffort */

$this->title = 'Add Camp monthly planned work effort';
$this->params['breadcrumbs'][] = ['label' => 'Camp monthly schedules', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card card-success card-outline">
    <div class="card-header p-0 pt-1">
        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
            <li class="nav-item">
               <?= Html::a('Planned work effort', ['work-effort','id' => $id], ['class' => 'nav-link']); ?>
            </li>
            <li class="nav-item">
                <a class="nav-link active" id="custom-tabs-planned-activities-tab" data-toggle="pill" href="#custom-tabs-planned-activities" role="tab" aria-controls="custom-tabs-planned-activities" aria-selected="true">Planned activities</a>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content" id="custom-tabs-one-tabContent">
            <div class="tab-pane fade" id="custom-tabs-work-effort" role="tabpanel" aria-labelledby="custom-tabs-work-effort-tab">

            </div>
            <div class="tab-pane fade  show active" id="custom-tabs-planned-activities" role="tabpanel" aria-labelledby="custom-tabs-planned-activities-tab">
                here
            </div>
        </div>

    </div>
</div>

