<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfProjectRisksAndMitigationMeasures */

$this->title = 'Create Mgf Project Risks And Mitigation Measures';
$this->params['breadcrumbs'][] = ['label' => 'Mgf Project Risks And Mitigation Measures', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mgf-project-risks-and-mitigation-measures-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
