<?php


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AwpbBudget */

$this->title = 'Add AWPB Activity Input';
$this->params['breadcrumbs'][] = ['label' => 'AWPB Input', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
//$province_id = backend\models\Districts::findOne([Yii::$app->getUser()->identity->district_id])->province_id;
//$this->params['breadcrumbs'][] = \backend\models\Provinces::findOne($province_id)->name;
//$this->params['breadcrumbs'][] = \backend\models\Districts::findOne([Yii::$app->getUser()->identity->district_id])->name;
?>
<div class="card card-success card-outline">
    <div class="card-body">
<div class="awpb-activity-line-create">

    <h1><?= Html::encode($this->title) ?></h1>

     <h5>Instructions</h5>
                <ol>
                                     <li>Fields marked with <i style="color:red;">*</i> are required
                    </li>
                </ol>    
    <?= $this->render('_form', [
                        'model' => $model,
        'id'=>$id
                        
            ]) ?>

</div>
</div>
</div>