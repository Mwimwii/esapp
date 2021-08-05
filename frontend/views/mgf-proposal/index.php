<?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\models\MgfApplicant;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MgfProposalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'MFG Proposals';
include("C:/xampp/htdocs/esapp-mgf/frontend/views/mgf-applicant/mgfmenu.php");
$userid=Yii::$app->user->identity->id;
$applicant=MgfApplicant::find()->where(['user_id'=>$userid])->one();

?>
<div class="mgf-proposal-index">
    <?php include('tab.php'); ?>
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="panel with-nav-tabs panel-primary">
<div class="panel-body">
    <?php  //echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'rowOptions' => function ($model) {
            if ($model->is_active==1) {
                return ['class'=>'success'];
            } else {
                return ['class'=>'danger'];
            }
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'project_title',
            'mgf_no',
            'organisation.cooperative',
            'totalcost',
            'proposal_status',
            'date_created',
            'date_submitted',
            'applicant_type',
            'district.name',
            [
                'class' => 'yii\grid\ActionColumn','template' => '{view} {message}',
                'visibleButtons' => [
                    'update' => function ($model) {
                        return $model->proposal_status == 'Created' || $model->proposal_status == 'Updated' || $model->proposal_status == 'Cancelled';
                    },
                     'submit' => function ($model) {
                         return ($model->proposal_status == 'Updated' || $model->proposal_status == 'Cancelled') && ($model->totalcost > 0 && $model->is_active == 1);                                    
                    },
                    'message' => function ($model) {
                        return $model->proposal_status == 'Strongly Recommended' || $model->proposal_status == 'Recommended' || $model->proposal_status == 'Not Recommended';
                    },
                ]
            ] 
        ],
    ]); ?>
</div>
</div>
</div>
