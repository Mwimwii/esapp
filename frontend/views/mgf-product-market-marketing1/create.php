<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfProductMarketMarketing1 */

$this->title = 'Create Mgf Product Market Marketing1';
$this->params['breadcrumbs'][] = ['label' => 'Mgf Product Market Marketing1s', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mgf-product-market-marketing1-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
