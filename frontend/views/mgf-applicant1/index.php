<?php

use yii\helpers\Html;
use yii\grid\GridView;
//use Yii;
use frontend\models\MgfApplicant;
use frontend\models\MgfApplicantSearch;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MgfApplicantSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'MGF Applicants';
include('mgfmenu.php');
//$userid=Yii::$app->user->identity->username;
//echo time();

?>

<div class="mgf-applicant-index">
    <h3><?= Html::encode($this->title) ?></h3>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'first_name',
            'last_name',
            'mobile',
            'applicant_type',
            'district.name',
            'date_created',
            ['class' => 'yii\grid\ActionColumn', 'template' => '{view}'],
        ],
    ]); ?>

</div>
