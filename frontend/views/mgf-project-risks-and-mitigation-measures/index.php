<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MgfProjectRisksAndMitigationMeasuresSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mgf Project Risks And Mitigation Measures';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mgf-project-risks-and-mitigation-measures-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
<<<<<<< HEAD
    <?= Html::a('Home', ['/mgf-applicant/profile',], ['class' => 'btn btn-success']);?>
    <?= Html::a('Create Project Risks And Mitigation Measures', ['create'], ['class' => 'btn btn-success']) ?>
        
=======
        <?= Html::a('Create Mgf Project Risks And Mitigation Measures', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<i class="fa fa-Home"></i>Home', ['/mgf-applicant/profile',], ['class' => 'btn btn-default']);?>
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'expected_risks',
            'consequences_of_risk',
            'mitigation_measures_planned',
             //'proposal_id',
            //'date_created',
            //'date_update',
            //'created_by',
            //'updated_by',

            [
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => [],
                'header'=>'Actions',
                'template' => '{view} {update} {delete}',
                'visibleButtons'=>[
                ]
            ],
        ],
    ]); ?>


</div>
