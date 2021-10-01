<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MgfImplementationScheduleShortSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mgf Implementation Schedule Shorts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mgf-implementation-schedule-short-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Mgf Implementation Schedule Short', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'activity',
            'implementation_year',
            'qtr1',
            'qtr2',
            //'qtr3',
            //'qtr4',
            //'proposal_id',
            //'date_created',
            //'date_update',
            //'created_by',
            //'updated_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
