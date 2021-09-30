<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MgfSustainabilityScalabilitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

<<<<<<< HEAD
$this->title = 'Sustainability Scalabilities';
=======
$this->title = 'Mgf Sustainability Scalabilities';
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mgf-sustainability-scalability-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
<<<<<<< HEAD
    <?= Html::a('Home', ['/mgf-applicant/profile',], ['class' => 'btn btn-success']);?>
    <?= Html::a('Create Mgf Sustainability Scalability', ['create'], ['class' => 'btn btn-success']) ?>
        
=======
        <?= Html::a('Create Mgf Sustainability Scalability', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<i class="fa fa-Home"></i>Home', ['/mgf-applicant/profile',], ['class' => 'btn btn-default']);?>
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
            'description',
            //'proposal_id',
           // 'date_created',
           // 'date_update',
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
