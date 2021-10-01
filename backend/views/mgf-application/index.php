<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MgfApplicationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>

<div class="card card-success card-outline">
    <div class="card-body">
        <h3><?= Html::encode($this->title) ?></h3>
        <hr class="dotted short">
<?php include('tab.php');?>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function ($model) {
            if ($model->is_active==1) {
                return ['class'=>'success'];
            } else {
                return ['class'=>'danger'];
            }
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['label'=>'Applicant','value'=>'applicant.first_name'],
            //'applicant.first_name','applicant.last_name',
            'organisation.cooperative',
            //'attachements',
            'application_status',
            'date_created',
            'date_submitted',
            [
                'class' => 'yii\grid\ActionColumn','template' => '{view}',
                'visibleButtons' => [
                    'update' => function ($model) {
                        return $model->application_status == 'Created';
                    },
                     'open' => function ($model) {
                         return $model->application_status == 'Submitted';
                     }
                ]
            ]
        ],
    ]); ?>

   
</div>
</div>
