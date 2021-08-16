<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MgfBpiCategoriesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mgf Bpi Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mgf-bpi-categories-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Mgf Bpi Categories', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'category_id',
            'category_description',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
