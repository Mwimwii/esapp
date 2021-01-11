<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\CommodityPriceCollection */
$province_id = backend\models\Districts::findOne([Yii::$app->getUser()->identity->district_id])->province_id;
$this->title = 'Add commodity price';
$this->params['breadcrumbs'][] = ['label' => 'Commodity Prices', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['breadcrumbs'][] = \backend\models\Provinces::findOne($province_id)->name;
$this->params['breadcrumbs'][] = \backend\models\Districts::findOne([Yii::$app->getUser()->identity->district_id])->name;
?>
<div class="card card-success card-outline">
    <div class="card-body">
        <div class="col-lg-12">
            <ol>
                <li>The system automatically picks your province and district</li>
                <li>Click <span class="badge badge-success">Add record row</span> below to add  commodity price. You can add multiple commodity prices by clicking the same button</li>
            </ol>
        </div>
        <hr class="dotted short">
        <?=
        $this->render('_form', [
            'model' => $model,
           'modelForm' => $modelForm,
        ])
        ?>

    </div>
</div>
