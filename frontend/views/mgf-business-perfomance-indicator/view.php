<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfBusinessPerfomanceIndicator */


$this->title = "Business Perfomance Indicators";

$this->params['breadcrumbs'][] = ['label' => 'Mgf Business Perfomance Indicators', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="mgf-business-perfomance-indicator-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
    <?= Html::a('Home', ['mgf-applicant/profile'], ['class' => 'btn btn-success']) ?>
    <?= Html::a('Back', ['mgf-business-perfomance-indicator/index'], ['class' => 'btn btn-success']) ?>
    </p>

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
            'category_id',
            'indicator_id',
            'status_at_application',
            'status_after_1yr',
            'status_after_2yr',
            'proposal_id',
            'date_created',
            'date_update',
            'created_by',
            'updated_by',
        ],
    ]) ?>

</div>
