<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MgfApplicationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Submitted Applications';
//include('../mgf-applicant/sidebar.php');
include("C:/xampp/htdocs/esapp-mgf/frontend/views/mgf-applicant/mgfmenu.php");
?>

<div class="mgf-application-index">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php if($usertype=="Applicant"){ ?>
    
    <?php }else{ include('tab.php');?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['label'=>'Applicant','value'=>'applicant.first_name'],
            //'applicant.first_name','applicant.last_name',
            'organisation.cooperative',
            //'attachements',
            'application_status',
            'date_created',
            'date_submitted',
            [
                'class' => 'yii\grid\ActionColumn','template' => '{view}',
                'visibleButtons' => [
                    'update' => function ($model) {
                        return $model->application_status == 'Created';
                    },
                     'open' => function ($model) {
                         return $model->application_status == 'Submitted';
                     }
                ]
            ]
        ],
    ]); ?>

<?php } ?>
</div>
