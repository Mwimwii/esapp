<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfDeclaration */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Mgf Declarations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="mgf-declaration-view">

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
            'declaration_parta',
            'declaration_partb',
            'declaration_partc',
            'rep_name',
            'rep_aproval',
            'approval_date',
            'rep_title',
            'address',
            'phone',
            'email:email',
            'project_id',
            'date_created',
            'date_update',
            'created_by',
            'updated_by',
        ],
    ]) ?>

</div>
