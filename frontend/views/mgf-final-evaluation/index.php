<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MgfFinalEvaluationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

include("C:/xampp/htdocs/esapp-mgf/frontend/views/mgf-applicant/mgfmenu.php");
?>

<div class="mgf-final-evaluation-index">
<div class="panel with-nav-tabs panel-primary">
<div class="panel-body">
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php include('tab.php');?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'proposal.project_title',
            'organisation.cooperative',
            'finalscore',
            'decision',
            'date_created',
            ['class' => 'yii\grid\ActionColumn', 'template' => '{view}'],
        ],
    ]); ?>
</div>
</div>
</div>

