<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MgfApprovalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'MGF Approvals';
?>
<div class="card card-success card-outline">
    <div class="card-body">
    <h3><?= Html::encode($this->title) ?></h3> 
    <hr class="dotted short">  
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'application.organisation.cooperative',
            'conceptnote.',
            'scores',
            'review_remark:ntext',
            'review_submission',
            'reviewed_by',
            'certify_remark:ntext',
            'certify_submission',
            'certified_by',
            'approval_remark:ntext',
            'approve_submittion',
            'approved_by',
            ['class' => 'yii\grid\ActionColumn','template'=>'{view}'],
        ],
    ]); ?>
</div>
</div>
