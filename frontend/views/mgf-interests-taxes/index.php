<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MgfInterestsTaxesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mgf Interests Taxes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mgf-interests-taxes-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Mgf Interests Taxes', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'interest_tax_type',
            'interest_tax_percent',
            'interest_tax_name',
            'interest_yr1_value',
            //'interest_yr2_value',
            //'interest_yr3_value',
            //'interest_yr4_value',
            //'proposal_id',
            //'date_created',
            //'date_update',
            //'created_by',
            //'updated_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
