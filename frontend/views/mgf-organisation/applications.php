<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MgfOrganisationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

include("C:/xampp/htdocs/esapp-mgf/frontend/views/mgf-applicant/mgfmenu.php");
?>

<?php if($status==0){ ?>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php include('tab.php');?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'cooperative',
            'acronym',
            'business_objective:ntext',
            'email_address:email',
            'district.name',
            'physical_address',
            //'tel_no',
            //'applicant_id',
            //'date_created',

            ['class' => 'yii\grid\ActionColumn', 'template' => '{open}'],
        ],
    ]); ?>

<?php }elseif($status==1){ ?>

    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php include('tab.php');?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'cooperative',
            'acronym',
            'business_objective:ntext',
            'email_address:email',
            'district.name',
            'physical_address',
            //'tel_no',
            //'applicant_id',
            //'date_created',

            ['class' => 'yii\grid\ActionColumn', 'template' => '{manage}'],
        ],
    ]); ?>

<?php }elseif($status==2){ ?>

    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php include('tab.php');?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'cooperative',
            'acronym',
            'business_objective:ntext',
            'email_address:email',
            'district.name',
            'physical_address',
            //'tel_no',
            //'applicant_id',
            //'date_created',

            ['class' => 'yii\grid\ActionColumn', 'template' => '{verify}'],
        ],
    ]); ?>

<?php }else{ ?>

    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php include('tab.php');?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'cooperative',
            'acronym',
            'business_objective:ntext',
            'email_address:email',
            'district.name',
            'physical_address',
            //'tel_no',
            //'applicant_id',
            //'date_created',

            ['class' => 'yii\grid\ActionColumn', 'template' => '{open}'],
        ],
    ]); ?>

<?php } ?>