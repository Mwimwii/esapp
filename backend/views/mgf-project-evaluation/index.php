<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MgfProjectEvaluationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Assigned Proposals';
?>
 
<div class="card card-success card-outline">
    <div class="card-body">
    <?php include('tab.php');?>
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

