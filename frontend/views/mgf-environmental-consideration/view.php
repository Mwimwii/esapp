<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfEnvironmentalConsideration */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Mgf Environmental Considerations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="mgf-environmental-consideration-view">

    <h1><?= Html::encode($this->title) ?></h1>
<<<<<<< HEAD
    <?= Html::a('Home', ['/mgf-applicant/profile',], ['class' => 'btn btn-success']);?>
    <?= Html::a('Back', ['/mgf-environmental-consideration/index',], ['class' => 'btn btn-success']);?>
=======

>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
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
            'description',
            'proposal_id',
            'date_created',
            'date_update',
            'created_by',
            'updated_by',
        ],
    ]) ?>

</div>
