<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AwpbBudget */

$this->title = 'Update AWPB : ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'AWPB', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['viewpw', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="card card-success card-outline">
    <div class="card-body">
<div class="awpb-activity-line-create">


    <h1><?= Html::encode($this->title) ?></h1>

    <?php
 
   echo $this->render('_form_1', [
        'model' => $model,
         'template_id'=>$model->awpb_template_id,
        'status'=>$status
    ]) ;
    

    // ($user->district_id > 0 || $user->district_id != '') 
            ?>
</div>
</div>
</div>