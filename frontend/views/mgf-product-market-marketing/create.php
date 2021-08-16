<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfProductMarketMarketing */

$this->title = 'Create Mgf Product Market Marketing';
$this->params['breadcrumbs'][] = ['label' => 'Mgf Product Market Marketings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mgf-product-market-marketing-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
