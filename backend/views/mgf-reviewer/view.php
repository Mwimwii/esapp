<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfReviewer */

$this->title = $model->first_name." ".$model->last_name;
$this->params['breadcrumbs'][] = ['label' => 'Mgf Reviewers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="mgf-reviewer-view">

    <h3><?= Html::encode($this->title) ?></h3>
    <div class="card card-success card-outline">
    <div class="card-body">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'title',
            'first_name',
            'last_name',
            'mobile',
            'reviewer_type',
            'area_of_expertise:ntext',
            'confirmed',
            'total_assigned_1',
            'total_assigned_2',
            'email:email',
            'date_created',
        ],
    ]) ?>
    </div>
    </div>
</div>
