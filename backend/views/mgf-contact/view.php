<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfContact */

$this->title = "MGF Contacts";
\yii\web\YiiAsset::register($this);
?>
<div class="mgf-contact-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'first_name',
            'last_name',
            'mobile',
            'tel_no',
            'physical_address',
            'organisation.cooperative',
            'position.position',
            'applicant_id',
            'date_created',
        ],
    ]), Html::a('<i class="glyphicon glyphicon-backward"></i>Back', ['index'], ['class' => 'btn btn-default'])?>

</div>
