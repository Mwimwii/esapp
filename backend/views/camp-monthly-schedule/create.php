<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MeCampSubprojectRecordsPlannedWorkEffort */

$this->title = 'Add Camp monthly planned work effort';
$this->params['breadcrumbs'][] = ['label' => 'Camp monthly schedules', 'url' => ['index']];
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
