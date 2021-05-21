<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MeCampSubprojectRecordsPlannedWorkEffort */

$this->title = 'Update work effort';
$this->params['breadcrumbs'][] = ['label' => 'Camp monthly schedules', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Planned work effort for camp:' . backend\models\Camps::findOne(['id'=>$model->camp_id])->name, 'url' => ['view', 'id' => $model->id,'camp_id'=>$model->camp_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="card card-success card-outline">
    <div class="card-body">

        <?=
        $this->render('_form_1', [
            'model' => $model,
        ])
        ?>

    </div>
</div>
