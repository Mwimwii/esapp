<?php

use frontend\models\MgfOrganisation;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MgfOrganisationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'MGF Organisations';
include("C:/xampp/htdocs/esapp-mgf/frontend/views/mgf-applicant/mgfmenu.php");

$organisations = MgfOrganisation::find()->joinWith('applicant')->where(['user_id'=>$userid,'is_active'=>1])->count();
?>

    <h2><?= Html::encode($this->title) ?></h2>
<div class="panel with-nav-tabs panel-primary">
<div class="panel-body">
    

    
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="col-8">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'cooperative',
            'acronym',
            'registration_type',
            'registration_no',
            //'trade_license_no',
            //'registration_date',
            //'business_objective:ntext',
            'email_address:email',
            'district.name',
            //'physical_address',
            //'tel_no',
            //'applicant_id',
            //'date_created',

            ['class' => 'yii\grid\ActionColumn', 'template' => '{view} {update}'],
        ],
    ]); ?>

</div>
</div>
</div>
</div>
