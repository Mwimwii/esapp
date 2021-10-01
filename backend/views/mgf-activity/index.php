<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MgfActivitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

include("C:/xampp/htdocs/esapp-mgf/frontend/views/mgf-applicant/mgfmenu.php");
$this->title = 'MFG Activities';
?>
<div class="mgf-activity-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'activity_name',
            'componet.component_name',
            'date_created',
            //'createdby',
            ['class' => 'yii\grid\ActionColumn', 'template'=>'{view}'],
        ],
    ]); ?>


</div>
