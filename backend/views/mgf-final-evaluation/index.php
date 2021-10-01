<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MgfFinalEvaluationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>

<div class="card card-success card-outline">
    <div class="card-body">
    <?php include('tab.php');?>
    <hr class="dotted short"> 
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'proposal.project_title',
            'organisation.cooperative',
            'finalscore',
            'decision',
            'date_created',
            ['class' => 'yii\grid\ActionColumn', 'template' => '{view}'],
        ],
    ]); ?>
</div>
</div>


