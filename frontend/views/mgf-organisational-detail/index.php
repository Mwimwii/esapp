<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MgfOrganisationalDetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mgf Organisational Details';
?>
<div class="mgf-organisational-details-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Mgf Organisational Details', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'mgt_Staff',
            'senior_Staff',
            'junior_Staff',
            'others',
            //'last_board',
            //'last_agm',
            //'last_audit',
            //'has_finance',
            //'has_resources',
            //'organisation_id',
            //'date_created',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
