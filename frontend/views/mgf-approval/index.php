<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MgfApprovalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'MGF Approvals';
include("C:/xampp/htdocs/esapp-mgf/frontend/views/mgf-applicant/mgfmenu.php");

?>
<div class="mgf-approval-index">
    <h2><?= Html::encode($this->title) ?></h2>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
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
