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
                <a class="nav-link active" id="custom-tabs-work-effort-tab" data-toggle="pill" href="#custom-tabs-work-effort" role="tab" aria-controls="custom-tabs-work-effort" aria-selected="true">Planned work effort</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Planned activities</a>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content" id="custom-tabs-one-tabContent">
            <div class="tab-pane fade show active" id="custom-tabs-work-effort" role="tabpanel" aria-labelledby="custom-tabs-work-effort-tab">
                <?=
                $this->render('_form', [
                    'model' => $model,
                ])
                ?>
            </div>
            <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
            </div>
        </div>

    </div>
</div>
