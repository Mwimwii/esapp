<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfImplementationArrangementsCooperatingPartners */

$this->title = 'Update Mgf Implementation Arrangements Cooperating Partners: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Mgf Implementation Arrangements Cooperating Partners', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mgf-implementation-arrangements-cooperating-partners-update">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= Html::a('<i class="fa fa-Home"></i>Home', ['/mgf-applicant/profile',], ['class' => 'btn btn-default']);?>    
    <?= Html::a('<i class="fa fa-backward"></i>Back', ['/mgf-implementation-arrangements-cooperating-partners/index',], ['class' => 'btn btn-default']);?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
