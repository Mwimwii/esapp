<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfProjectRisksAndMitigationMeasures */

<<<<<<< HEAD
$this->title = 'Update Project Risks And Mitigation Measures: ' . $model->id;
=======
$this->title = 'Update Mgf Project Risks And Mitigation Measures: ' . $model->id;
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
$this->params['breadcrumbs'][] = ['label' => 'Mgf Project Risks And Mitigation Measures', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mgf-project-risks-and-mitigation-measures-update">

    <h1><?= Html::encode($this->title) ?></h1>

<<<<<<< HEAD
    <?= Html::a('Home', ['/mgf-applicant/profile',], ['class' => 'btn btn-success']);?>    
    <?= Html::a('<i class="fa fa-backward"></i>Back', ['/mgf-project-risks-and-mitigation-measures/index',], ['class' => 'btn btn-success']);?>

=======
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
