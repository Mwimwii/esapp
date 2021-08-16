<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfCostsFinancingPlan */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Mgf Costs Financing Plans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="mgf-costs-financing-plan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<i class="fa fa-backward"></i>Back', ['/mgf-costs-financing-plan/index',], ['class' => 'btn btn-default']);?>
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
            'componentid',
            'activityid',
            'input_name',
            'total_Project_cost',
            'Applicant_in_kind',
            'Applicant_in_cash',
            'total_contribution',
            'mgf_grant',
            'other_sources',
            'total',
            'mgf_as_percent',
            'date_created',
            'date_update',
            'created_by',
            'updated_by',
        ],
    ]) ?>

</div>
