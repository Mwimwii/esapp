<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AwpbComment */

$this->title = ' AWPB Decline Comment';
$this->params['breadcrumbs'][] = ['label' => 'AWPB Decline Comment', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card card-success card-outline">
    <div class="card-body">
 <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form_1', [
        'model' => $model,
        'id'=>$id,
    ]) ?>

</div>
</div>
