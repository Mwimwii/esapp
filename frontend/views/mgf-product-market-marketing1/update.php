<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfProductMarketMarketing1 */

$this->title = 'Update Mgf Product Market Marketing: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Mgf Product Market Marketing1s', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mgf-product-market-marketing1-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= Html::a('<i class="fa fa-Home"></i>Home', ['/mgf-applicant/profile',], ['class' => 'btn btn-default']);?>    
    <?= Html::a('<i class="fa fa-backward"></i>Back', ['/mgf-product-market-marketing1/index',], ['class' => 'btn btn-default']);?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
