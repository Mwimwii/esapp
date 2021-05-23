<?php

use frontend\models\MgfApplicant;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MgfAttachementsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Uploaded Documents';
//include("C:/xampp/htdocs/esapp-mgf/frontend/views/mgf-applicant/mgfmenu.php");
$userid=Yii::$app->user->identity->id;
$applicant=MgfApplicant::find()->where(['user_id'=>$userid])->one();
?>
<div class="mgf-attachements-index">
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'registration_certificate:ntext',
                'articles_of_assoc:ntext',
                'audit_reports:ntext',
                'mou_contract:ntext',
                'board_resolution:ntext',
                'application_attachement:ntext',
                'date_created',
                'date_submitted',
            ],
        ]);
        ?>
</div>
