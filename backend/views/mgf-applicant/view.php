<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfApplicant */

$this->title = "Applicant Details";
\yii\web\YiiAsset::register($this);

$this->params['breadcrumbs'][] = ['label' => 'Applicants', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="mgf-applicant-view">
    <h2><?= Html::encode($this->title) ?></h2>
        <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'title',
            'province_id',
            'district_id',
            'first_name',
            'last_name',
            'mobile',
            'nationalid',
            'address:ntext',
            'applicant_type',
            'user_id',
            'organisation_id',
            'date_created',
        ],
    ]) , Html::a('<i class="fas fa-backward"></i>Back', ['index'], ['class' => 'btn btn-default']);?>

</div>
