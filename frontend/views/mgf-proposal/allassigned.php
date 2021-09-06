<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MgfProposalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Assigned Proposals';
include("C:/xampp/htdocs/esapp-mgf/frontend/views/mgf-applicant/mgfmenu.php");
?>
<div class="mgf-proposal-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="panel with-nav-tabs panel-primary">
<div class="panel-body">
    <?php  //echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if($usertype=="Applicant"){ ?>
    
    <?php }else{ include('tab.php');?>
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
                            //return Html::a('<span class="glyphicon glyphicon-pencil"></span>');
                            //return Html::a('<span class="glyphicon glyphicon-pencil"></span> U N M A R K E D', $url);
                        }
                    ]
                ]
            ],
        ]); ?>
  


<?= Html::endForm(); ?>

<?php } ?>
</div>
</div>
</div>