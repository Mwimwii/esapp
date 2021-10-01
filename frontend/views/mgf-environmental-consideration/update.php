<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfEnvironmentalConsideration */

$this->title = 'Update Mgf Environmental Consideration: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Mgf Environmental Considerations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mgf-environmental-consideration-update">

    <h1><?= Html::encode($this->title) ?></h1>
<<<<<<< HEAD
    <?= Html::a('Home', ['/mgf-applicant/profile',], ['class' => 'btn btn-success']);?>
    <?= Html::a('Back', ['/mgf-environmental-consideration/index',], ['class' => 'btn btn-success']);?>
=======
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
