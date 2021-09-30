<<<<<<< HEAD
<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AwpbIndicator */

$this->title = 'Create AWPB Indicator';
$this->params['breadcrumbs'][] = ['label' => 'AWPB Indicators', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card card-success card-outline">
    <div class="card-body">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div></div>
=======
<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AwpbIndicator */

$this->title = 'Create Programme Indicator';
$this->params['breadcrumbs'][] = ['label' => 'Programme Indicators', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card card-success card-outline">
    <div class="card-body">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div></div>
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
