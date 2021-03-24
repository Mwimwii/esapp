<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\MeCampSubprojectRecordsMonthlyPlannedActivitiesActual */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Me Camp Subproject Records Monthly Planned Activities Actuals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="me-camp-subproject-records-monthly-planned-activities-actual-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'planned_activity_id',
            'hours_worked_field',
            'hours_worked_office',
            'hours_worked_total',
            'achieved_activity_target',
            'beneficiary_target_achieved_total',
            'beneficiary_target_achieved_women',
            'beneficiary_target_achieved_youth',
            'beneficiary_target_achieved_women_headed',
            'remarks:ntext',
            'year',
            'month',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
        ],
    ]) ?>

</div>
