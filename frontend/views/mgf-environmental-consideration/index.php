<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MgfEnvironmentalConsiderationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mgf Environmental Considerations';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="mgf-environmental-consideration-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Home', ['/mgf-applicant/profile',], ['class' => 'btn btn-success']);?>
        <?= Html::a('Create Mgf Environmental Consideration', ['create'], ['class' => 'btn btn-success']) ?>
       
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
            //'date_created',
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
