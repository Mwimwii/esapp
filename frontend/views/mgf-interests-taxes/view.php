<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfInterestsTaxes */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Mgf Interests Taxes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="mgf-interests-taxes-view">

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
            'interest_tax_type',
            'interest_tax_percent',
            'interest_tax_name',
            'interest_yr1_value',
            'interest_yr2_value',
            'interest_yr3_value',
            'interest_yr4_value',
            'proposal_id',
            'date_created',
            'date_update',
            'created_by',
            'updated_by',
        ],
    ]) ?>

</div>
