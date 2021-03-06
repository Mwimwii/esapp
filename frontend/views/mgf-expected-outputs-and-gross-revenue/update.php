<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfExpectedOutputsAndGrossRevenue */


$this->title = 'Update Mgf Expected Outputs And Gross Revenue';
$this->params['breadcrumbs'][] = ['label' => 'Mgf Expected Outputs And Gross Revenues', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';

?>
<p>
<?= Html::a('<i class="fa fa-Home"></i>Home', ['/mgf-applicant/profile',], ['class' => 'btn btn-default']);?>    
<?= Html::a('<i class="fa fa-backward"></i>Back', ['/mgf-expected-outputs-and-gross-revenue/index',], ['class' => 'btn btn-default']);?>
</p>
<div class="mgf-expected-outputs-and-gross-revenue-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
