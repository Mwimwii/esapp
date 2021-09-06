<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfImplementationArrangementsCooperatingPartners */

$this->title = "Implementation Arrangements";
$this->params['breadcrumbs'][] = ['label' => 'Mgf Implementation Arrangements', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="mgf-implementation-arrangements-cooperating-partners-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<i class="fa fa-backward"></i>Back', ['/mgf-implementation-arrangements-cooperating-partners/index',], ['class' => 'btn btn-default']);?>
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
            'main_activities',
            'respobility',
            'experience',
            'comment',
            'typee',
            'proposal_id',
            //'date_created',
            //'created_by',
            //'created_at',
            //'updated_by',
        ],
    ]) ?>

</div>
