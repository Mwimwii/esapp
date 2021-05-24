<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MgfProposalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Submitted Proposals';
include("C:/xampp/htdocs/esapp-mgf/frontend/views/mgf-applicant/mgfmenu.php");
$usertype=Yii::$app->user->identity->type_of_user;
?>
<div class="mgf-proposal-index">
<?php include('tab.php');?>
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="panel with-nav-tabs panel-primary">
<div class="panel-body">
    <?php  //echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if($usertype=="Applicant"){ ?>
    
    <?php }else{?>
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
                ['class' => 'yii\grid\ActionColumn','template' => '{view}',]
            ],
        ]); ?>

<?= Html::endForm(); ?>

<?php } ?>
</div>
</div>
</div>