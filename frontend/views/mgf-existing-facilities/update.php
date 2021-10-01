<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MgfExistingFacilities */

$this->title = 'Update Mgf Existing Facilities: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Mgf Existing Facilities', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<<<<<<< HEAD
<p>
    <?= Html::a('<i class="fa fa-Home"></i>Home', ['/mgf-applicant/profile',], ['class' => 'btn btn-default']);?>    
    <?= Html::a('<i class="fa fa-backward"></i>Back', ['/mgf-existing-facilities/index',], ['class' => 'btn btn-default']);?>
       
    </p>
=======
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
<div class="mgf-existing-facilities-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
