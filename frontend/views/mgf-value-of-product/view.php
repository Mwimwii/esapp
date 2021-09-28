<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfValueOfProduct */

$this->title = "Value of Product";
$this->params['breadcrumbs'][] = ['label' => 'Mgf Value Of Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="mgf-value-of-product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= Html::a('Home', ['/mgf-applicant/profile',], ['class' => 'btn btn-success']);?>    
    <?= Html::a('<i class="fa fa-backward"></i>Back', ['/mgf-value-of-product/index',], ['class' => 'btn btn-success']);?>

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
           // 'id',
            'product_name',
            'product_unit',
            'product_yr1_qty',
            'product_yr1_price',
            'product_yr1_value',
            'product_yr2_qty',
            'product_yr2_price',
            'product_yr2_value',
            'product_yr3_qty',
            'product_yr3_price',
            'product_yr3_value',
            'product_yr4_qty',
            'product_yr4_price',
            'product_yr4_value',
            'comment',
            'proposal_id',
            'date_created',
            //'date_update',
            'created_by',
            //'updated_by',
        ],
    ]) ?>

</div>
