<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfImplementationArrangementsCooperatingPartners */

<<<<<<< HEAD
$this->title = 'Update > Implementation Arrangements ';
=======
$this->title = 'Update Mgf Implementation Arrangements Cooperating Partners: ' . $model->id;
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
$this->params['breadcrumbs'][] = ['label' => 'Mgf Implementation Arrangements Cooperating Partners', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<<<<<<< HEAD


=======
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
<div class="mgf-implementation-arrangements-cooperating-partners-update">

    <h1><?= Html::encode($this->title) ?></h1>

<<<<<<< HEAD

    <?= Html::a('<i class="fa fa-Home"></i>Home', ['/mgf-applicant/profile',], ['class' => 'btn btn-default']);?>    
    <?= Html::a('<i class="fa fa-backward"></i>Back', ['/mgf-implementation-arrangements-cooperating-partners/index',], ['class' => 'btn btn-default']);?>

=======
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
