<?php


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AwpbActivityLine */

$this->title = 'Add AWPB Indicator';
$this->params['breadcrumbs'][] = ['label' => 'AWPB Indicator', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
//$province_id = backend\models\Districts::findOne([Yii::$app->getUser()->identity->district_id])->province_id;
//$this->params['breadcrumbs'][] = \backend\models\Provinces::findOne($province_id)->name;
//$this->params['breadcrumbs'][] = \backend\models\Districts::findOne([Yii::$app->getUser()->identity->district_id])->name;
?>
<div class="card card-success card-outline">
    <div class="card-body">
<div class="awpb-activity-line-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
                        'model' => $model,
                        'template_id'=>$template_id
                        
            ]) ?>

</div>
</div>
</div>