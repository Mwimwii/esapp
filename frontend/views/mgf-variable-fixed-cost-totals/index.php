<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MgfVariableFixedCostTotalsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mgf Variable Fixed Cost Totals';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mgf-variable-fixed-cost-totals-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Mgf Variable Fixed Cost Totals', ['create'], ['class' => 'btn btn-success']) ?>
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
