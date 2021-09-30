<?php

<<<<<<< HEAD
=======

>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
use backend\models\User;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MgfProposalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Submitted Proposals';
$usertype=Yii::$app->user->identity->type_of_user;
?>
<div class="card card-success card-outline">
    <div class="card-body">
<<<<<<< HEAD
    
=======

    <?php include('tab.php');?>

>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
    <hr class="dotted short"> 
    <?= Html::beginForm(['/mgf-proposal/select'], 'post'); ?>
    
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
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
<<<<<<< HEAD
=======
                [
                    'class' => 'yii\grid\CheckboxColumn',
                    'checkboxOptions' =>function($model,$key,$index,$widget){
                        return ["value"=>$model->id];
                    }
                ],

>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
                ['class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
                'buttons' => [
                    'view' => function ($url, $model) {
                            return Html::a(
                                '<span class="fa fa-cog"></span>', ['mgf-reviewer/reviewers', 'id' => $model->id], [
                                'title' => 'Assign To Reviewers',
                                'data-toggle' => 'tooltip',
                                'data-placement' => 'top',
                                'data-pjax' => '0',
                                'style' => "padding:5px;",
                                'class' => 'bt btn-lg'
                            ]
                        );
                        
                    }, 
                ]
            ]   
            ],
        ]); ?>

<?= Html::endForm(); ?>
</div>
</div>
