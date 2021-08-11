<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfOrganisationalDetails */

$this->title = 'Business Management Capacity, Governance and Financial Status';
\yii\web\YiiAsset::register($this);
?>
<div class="mgf-organisational-details-view">

    <h3><?= Html::encode($this->title); ?></h3>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'organisation.cooperative',
            'mgt_Staff',
            'senior_Staff',
            'junior_Staff',
            'others',
            'last_board',
            'last_agm',
            'last_audit',
            'has_finance',
            'has_resources',
            'date_created',
        ],
    ]) ?>

<?= Html::a('<i class="glyphicon glyphicon-backward"></i>Back', ['/mgf-applicant/profile'], ['class' => 'btn btn-default']);?>
<?= Html::a('<i class="glyphicon glyphicon-edit"></i> Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);?>
</div>
