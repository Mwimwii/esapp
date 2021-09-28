<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfProjectRisksAndMitigationMeasures */

$this->title = "Project Risks And Mitigation Measures";
$this->params['breadcrumbs'][] = ['label' => 'Mgf Project Risks And Mitigation Measures', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="mgf-project-risks-and-mitigation-measures-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= Html::a('Home', ['/mgf-applicant/profile',], ['class' => 'btn btn-success']);?>    
    <?= Html::a('<i class="fa fa-backward"></i>Back', ['/mgf-project-risks-and-mitigation-measures/index',], ['class' => 'btn btn-success']);?>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'expected_risks',
            'consequences_of_risk',
            'mitigation_measures_planned',
            'proposal_id',
            'date_created',
            'date_update',
            'created_by',
            'updated_by',
        ],
    ]) ?>

</div>
