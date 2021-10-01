<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MgfProjectEvaluationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Assigned Proposals';
?>
<<<<<<< HEAD
=======

>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
 <h3><?= Html::encode($this->title) ?></h3> 
<div class="card card-success card-outline">
    <div class="card-body">
    <hr class="dotted short">   
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'proposal.project_title',
            'organisation.cooperative',
            'window',
            'observation:ntext',
            'declaration:ntext',
            'totalscore',
            'date_created',
            'date_submitted',
            'date_reviewed',
            [
                'class' => 'yii\grid\ActionColumn','template' => '{view} {open}',
                'visibleButtons' => [
                    'open' => function ($model) {
                        return $model->proposal->proposal_status == 'Submitted' || $model->proposal->proposal_status == 'Under_Review';
                    }
                ]
            ],
        ],
    ]); ?>
</div>
</div>

