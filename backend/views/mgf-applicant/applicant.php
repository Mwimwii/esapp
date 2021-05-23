<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfApplicant */

$this->title = "Applicant Details";
\yii\web\YiiAsset::register($this);

include("check.php");
?>

<div class="mgf-applicant-view">
    <h2><?= Html::encode($this->title) ?></h2>
    <?php //if(allowed_to("mgf_view_applicants")){?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'title',
            'first_name',
            'last_name',
            'mobile',
            'nationalid',
            'applicant_type',
            'province.name',
            'district.name',
            'address:ntext',
            'date_created',
        ],
    ]) ,
    Html::a('<i class="glyphicon glyphicon-backward"></i>Back', ['/mgf-applicant/profile'], ['class' => 'btn btn-default']),
    Html::a('<i class="glyphicon glyphicon-edit"></i>Update', ['/mgf-applicant/update','id'=>$model->id], ['class' => 'btn btn-primary']);
    ?> 

    <?php //}?>
</div>
