<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MgfProfitBeforeInterestTaxesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mgf Profit Before Interest Taxes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mgf-profit-before-interest-taxes-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Mgf Profit Before Interest Taxes', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'profit_yr1_value',
            'profit_yr2_value',
            'profit_yr3_value',
            'profit_yr4_value',
            //'proposal_id',
            //'date_created',
            //'date_update',
            //'created_by',
            //'updated_by',

            [
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => [],
                'header'=>'Actions',
                'template' => '{view} {update} {delete}',
                'visibleButtons'=>[
                ]
            ],
        ],
    ]); ?>


</div>
