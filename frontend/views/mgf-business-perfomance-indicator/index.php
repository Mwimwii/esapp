<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MgfBusinessPerfomanceIndicatorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mgf Business Perfomance Indicators';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mgf-business-perfomance-indicator-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Mgf Business Perfomance Indicator', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            // 'category_id',
           // ['label'=>'BPI',
            'agribusiness_indicators',
            'status_at_application',
            'status_after_1yr',
            'status_after_2yr',
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
