<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfActivity */

$this->title = $model->activity_name;
?>
<div class="mgf-activity-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'activity_no',
            'activity_name',
            'componet.component_name',
            'date_created',
            'createdby',
        ],
    ]), Html::a('<i class="glyphicon glyphicon-backward"></i>Back', ['index'], ['class' => 'btn btn-default'])?>

</div>