<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AwpbTemplateActivity */

<<<<<<< HEAD
$this->title = 'Link Activity to AWPB Template ';
$this->params['breadcrumbs'][] = ['label' => 'AWPB Template and Activities', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card card-success card-outline">
    <div class="card-body">
<div class="awpb-template-create">
=======
$this->title = 'Create Awpb Template Activity';
$this->params['breadcrumbs'][] = ['label' => 'Awpb Template Activities', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="awpb-template-activity-create">
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<<<<<<< HEAD
</div></div>


=======
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
