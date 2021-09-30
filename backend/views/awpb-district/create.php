<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AwpbDistrict */

$this->title = 'Create Awpb District';
$this->params['breadcrumbs'][] = ['label' => 'Awpb Districts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="awpb-district-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
