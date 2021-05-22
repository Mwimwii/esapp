<?php


use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;
use \backend\models\User;


/* @var $this yii\web\View */
/* @var $model backend\models\AwpbTemplate */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Awpb Templates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="awpb-template-view">

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
            'fiscal_year',
            'budget_theme:ntext',
            'comment:ntext',
            'guideline_file',
            'status',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
        ],
    ]) ?>

</div>
