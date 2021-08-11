<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MgfValueOfProductTotalsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mgf Value Of Product Totals';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mgf-value-of-product-totals-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Mgf Value Of Product Totals', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'total_yr1_value',
            'total_yr2_value',
            'total_yr3_value',
            'total_yr4_value',
            //'proposal_id',
            //'date_created',
            //'date_update',
            //'created_by',
            //'updated_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
