<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfReviewer */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Mgf Reviewers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="mgf-reviewer-view">

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
            'title',
            'login_code',
            'first_name',
            'last_name',
            'mobile',
            'reviewer_type',
            'area_of_expertise:ntext',
            'user_id',
            'confirmed',
            'createdBy',
            'total_assigned_1',
            'total_assigned_2',
            'email:email',
            'date_created',
        ],
    ]) ?>

</div>
