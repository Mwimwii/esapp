<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfEnvironmentalConsideration */

$this->title = 'Create Mgf Environmental Consideration';
$this->params['breadcrumbs'][] = ['label' => 'Mgf Environmental Considerations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mgf-environmental-consideration-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
