<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfProjectRisksAndMitigationMeasures */

$this->title = 'Update Project Risks And Mitigation Measures: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Mgf Project Risks And Mitigation Measures', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mgf-project-risks-and-mitigation-measures-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= Html::a('Home', ['/mgf-applicant/profile',], ['class' => 'btn btn-success']);?>    
    <?= Html::a('<i class="fa fa-backward"></i>Back', ['/mgf-project-risks-and-mitigation-measures/index',], ['class' => 'btn btn-success']);?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
