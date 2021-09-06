<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MgfProjectEvaluationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Assigned Proposals';
include("C:/xampp/htdocs/esapp-mgf/frontend/views/mgf-applicant/mgfmenu.php");
?>
 <?php include('tab.php');?>
 <h1><?= Html::encode($this->title) ?></h1>
<div class="panel with-nav-tabs panel-primary">
<div class="panel-body">
<div class="mgf-project-evaluation-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
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
</div>
