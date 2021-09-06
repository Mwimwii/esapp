<?php

use frontend\models\MgfScreening;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MgfScreeningSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
include("C:/xampp/htdocs/esapp-mgf/frontend/views/mgf-applicant/mgfmenu.php");
$this->title = 'MGF Screenings';
//$columns;//='columns';
?>

<div class="card card-success card-outline">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
          ['class' => 'yii\grid\SerialColumn'],
        'conceptnote.project_title',
        'conceptnote.organisation.cooperative',
        'criterion',
        'satisfactory',
        'verified_by',
        //'province_id',
        //'district_id',
      ],
    ]); ?>
</div>
