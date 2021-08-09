<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AwpbTemplateActivity */

$this->title = 'Create Awpb Template Activity';
$this->params['breadcrumbs'][] = ['label' => 'Awpb Template Activities', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="awpb-template-activity-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
