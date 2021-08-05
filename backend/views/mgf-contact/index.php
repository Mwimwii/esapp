<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MgfContactSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
include("C:/xampp/htdocs/esapp-mgf/frontend/views/mgf-applicant/mgfmenu.php");
$this->title = 'MGF Contacts';
?>
<div class="mgf-contact-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'first_name',
            'last_name',
            'mobile',
            'tel_no',
            ['label' => 'Organisation','value' => 'organisation.cooperative',],
            'position.position',
            ['class' => 'yii\grid\ActionColumn','template' =>'{view}'],
        ],
    ]); ?>


</div>
