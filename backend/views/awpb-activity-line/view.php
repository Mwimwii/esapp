<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\AwpbActivityLine */

//$this->title = $model->id;
$this->title = 'AWPB Activity line : '. $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Awpb Activity Lines', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="card card-success card-outline">
    <div class="card-body">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    
            <?php
             echo Html::a('<span class="fas fa-arrow-left fa-2x"></span>', ['index', 'id' => $model->id], [
                'title' => 'back',
                'data-toggle' => 'tooltip',
                'data-placement' => 'top',
            ]);
            if (\backend\models\User::userIsAllowedTo('Manage AWPB activity lines')) {
               
                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                
                    echo Html::a(
                        '<span class="fa fa-trash"></span>', ['delete', 'id' => $model->id], [
                    'title' => 'delete',
                    'data-toggle' => 'tooltip',
                    'data-placement' => 'top',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this budget line?',
                        'method' => 'post',
                    ],
                    'style' => "padding:5px;",
                    'class' => 'bt btn-lg'
                        ]
        );
                
            }
            ?>

<?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           
            [
                'attribute' => 'province_id',
                'format' => 'raw',
                'label' => 'Province',
                'value' => function ($model) {
                    return !empty($model->province_id) && $model->province_id> 0 ? backend\models\Provinces::findOne($model->province_id)->name: "";
                },
                'visible' => !empty($model->province_id) && $model->province_id > 0 ? TRUE : FALSE,
            ],
           
            [
                'attribute' => 'district_id',
                'format' => 'raw',
                'label' => 'District',
                'value' => function ($model) {
                    return !empty($model->district_id) && $model->district_id> 0 ? backend\models\Districts::findOne($model->district_id)->name: "";
                },
                'visible' => !empty($model->district_id) && $model->district_id > 0 ? TRUE : FALSE,
            ],
           
            [
                'attribute' => 'activityid_id',
                'format' => 'raw',
                'label' => 'Activity',
                'value' => function ($model) {
                    return !empty($model->activity_id) && $model->activity_id > 0 ? backend\models\AwpbActivity::findOne($model->activity_id)->activity_code: "";
                },
                'visible' => !empty($model->activity_id) && $model->activity_id > 0 ? TRUE : FALSE,
            ],
            [
               
                'format' => 'raw',
                'label' => 'Activity Name',
                'value' => function ($model) {
                    return !empty($model->activity_id) && $model->activity_id > 0 ? backend\models\AwpbActivity::findOne($model->activity_id)->name: "";
                },
                'visible' => !empty($model->activity_id) && $model->activity_id > 0 ? TRUE : FALSE,
            ],
            'name',
           
            [
                'attribute' => 'unit_of_measure_id',
                'format' => 'raw',
                'label' => 'Unit of Measure',
                'value' => function ($model) {
                    return !empty($model->unit_of_measure_id) && $model->unit_of_measure_id> 0 ? backend\models\AwpbUnitOfMeasure::findOne($model->unit_of_measure_id)->name: "";
                },
                'visible' => !empty($model->unit_of_measure_id) && $model->unit_of_measure_id > 0 ? TRUE : FALSE,
            ],
        
               
        
            'unit_cost',
            'quarter_one_quantity',
            'quarter_two_quantity',
            'quarter_three_quantity',
            'quarter_four_quantity',
            'total_quantity',
            'total_amount',
            // 'subcomponent',
            // 'created_at',
            // 'updated_at',
            // 'created_by',
            // 'updated_by',
        ],
    ]) ?>

</div>
</div>


    

  
