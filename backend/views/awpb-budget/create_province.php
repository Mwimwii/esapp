<?php


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AwpbBudget */

$this->title = 'Add AWPB Activity';
$this->params['breadcrumbs'][] = ['label' => 'AWPB', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
//$province_id = backend\models\Districts::findOne([Yii::$app->getUser()->identity->district_id])->province_id;
//$this->params['breadcrumbs'][] = \backend\models\Provinces::findOne($province_id)->name;
//$this->params['breadcrumbs'][] = \backend\models\Districts::findOne([Yii::$app->getUser()->identity->district_id])->name;
?>
<div class="card card-success card-outline">
    <div class="card-body">
<div class="awpb-activity-line-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <h4>Instructions</h4>
        <ol>
            <li>Field marked "<span style="color:#FF0000 ;">*</i></span>"are mandatory and should be filled in.</li>
                       
            <li>Click "<span class="badge badge-success">Save</span>" button to add an AWPB Activity.</li>
        </ol>
    
    
    
    <?= $this->render('_form_province', [
                        'model' => $model,
                        'template_id'=>$template_id
                        
            ]) ?>

</div>
</div>
</div>