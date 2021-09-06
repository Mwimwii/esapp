<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MgfExistingFacilities */

$this->title = "Existing Facilities";
$this->params['breadcrumbs'][] = ['label' => 'Mgf Existing Facilities', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="mgf-existing-facilities-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<i class="fa fa-backward"></i>Back', ['/mgf-existing-facilities/index',], ['class' => 'btn btn-default']);?>
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
            //'id',
            'facility_name',
            'description',
            'quantity',
            'use_to_be_made',
            'estimate_cost',
            'comment',
            'proposal_id',
            //'date_created',
//'date_update',
           // 'created_by',
           // 'updated_by',
        ],
    ]) ?>

</div>
