<?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\models\MgfApplicant;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MgfProposalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'MFG Proposals';
$userid=Yii::$app->user->identity->id;
$applicant=MgfApplicant::find()->where(['user_id'=>$userid])->one();

?>
<div class="card card-success card-outline">
    <div class="card-body">


    <?php include('tab.php');?>

    <hr class="dotted short"> 
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
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
            ['class' => 'yii\grid\ActionColumn',
            'template' => '{view}',
            'buttons' => [
                'view' => function ($url, $model) {
                        return Html::a(
                            '<span class="fa fa-folder"></span>', ['mgf-concept-note/view', 'id' => $model->id], [
                            'title' => 'Open',
                            'data-toggle' => 'tooltip',
                            'data-placement' => 'top',
                            'data-pjax' => '0',
                            'style' => "padding:5px;",
                            'class' => 'bt btn-lg'
                        ]
                    );       
                }, 
            ]],

            ['class' => 'yii\grid\ActionColumn',
            'template' => '{view}',
            'buttons' => [
                'view' => function ($url, $model) {
                        return Html::a(
                            '<span class="fa fa-eye"></span>', ['mgf-proposal/view-concept', 'id' => $model->id], [
                            'title' => 'View',
                            'data-toggle' => 'tooltip',
                            'data-placement' => 'top',
                            'data-pjax' => '0',
                            'style' => "padding:5px;",
                            'class' => 'bt btn-lg'
                        ]
                    );       
                }, 
            ]],
        ],
    ]); ?>
</div>
</div>

