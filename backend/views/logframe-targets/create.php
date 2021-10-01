<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\LogframeProgrammeTargets */

$this->title = 'Create Logframe Programme Targets';
$this->params['breadcrumbs'][] = ['label' => 'Logframe Programme Targets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="logframe-programme-targets-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
