<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MgfProposalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Assigned Proposals';
?>

<div class="card card-success card-outline">
    <div class="card-body">
    <?php include('tab.php');?>
    <hr class="dotted short">     
    <?= Html::beginForm(['/mgf-proposal/select'], 'post'); ?>
    
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'project_title',
                'mgf_no',
                'organisation.cooperative',
                'proposal_status',
                'totalcost',
                'date_created',
                'date_submitted',
                'applicant_type',
                'district.name',
                'number_reviewers',
                [
                    'class' => 'yii\grid\CheckboxColumn',
                    'checkboxOptions' =>function($model,$key,$index,$widget){
                        return ["value"=>$model->id];
                    }
                ],
                [
                    'class' => 'yii\grid\ActionColumn','template' => '{view} {open}',
                    'visibleButtons' => [
                        'open' => function ($model) {
                            return $model->proposal_status == 'Submitted' || $model->proposal_status == 'Under_Review';
                        }
                    ]
                ]
            ],
        ]); ?>

<?= Html::endForm(); ?>

</div>
</div>
