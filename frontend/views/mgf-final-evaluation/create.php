<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfFinalEvaluation */

$this->title = 'Create Mgf Final Evaluation';
$this->params['breadcrumbs'][] = ['label' => 'Mgf Final Evaluations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mgf-final-evaluation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
