<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AwpbBudget */

$this->title = 'Update AWPB : ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'AWPB', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="awpb-activity-line-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    if (($model->cost_centre_id != 0 || $model->cost_centre_id != '') && ($model->province_id == 0 || $model->province_id == '')) {
   echo $this->render('_form_1', [
        'model' => $model,
         'template_id'=>$model->awpb_template_id,
        'status'=>$status
    ]) ;
    }
 else {
        echo  $this->render('_form', [
        'model' => $model,
         'template_id'=>$model->awpb_template_id,
        'status'=>$status
    ]) ;
    }
            ?>

</div>
