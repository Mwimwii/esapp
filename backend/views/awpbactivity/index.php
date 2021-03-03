<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AwpbActivitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Awpb Activities';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="awpb-activity-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Awpb Activity', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'activity_code',
            'parent_activity_id',
            'component_id',
            'description',
            //'unit_of_measure_id',
            //'quarter_one_budget',
            //'quarter_two_budget',
            //'quarter_three_budget',
            //'quarter_four_budget',
            //'total_budget',
            //'expense_category_id',
            //'created_at',
            //'updated_at',
            //'created_by',
            //'updated_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
