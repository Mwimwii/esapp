<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MeQuarterlyWorkPlan */

$this->title = 'Create Me Quarterly Work Plan';
$this->params['breadcrumbs'][] = ['label' => 'Me Quarterly Work Plans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="me-quarterly-work-plan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
