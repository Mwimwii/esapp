<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\AwpbIndicator */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Programme -Indicators', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="card card-success card-outline">
    <div class="card-body">
<div class="awpb-indicator-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    <?php
         
                echo Html::a('<span class="fas fa-arrow-left fa-2x"></span>', ['index', 'id' => $model->id], [
                    'title' => 'back',
                    'data-toggle' => 'tooltip',
                    'data-placement' => 'top',
                ]);
                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                if (\backend\models\User::userIsAllowedTo('Setup AWPB')) {
                echo Html::a('<span class="fas fa-edit fa-2x"></span>', ['update', 'id' => $model->id], [
                    'title' => 'Update indicator',
                    'data-toggle' => 'tooltip',
                    'data-placement' => 'top',
                ]);
                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                
                    echo Html::a(
                        '<span class="fa fa-trash"></span>', ['delete', 'id' => $model->id], [
                    'title' => 'delete indicator',
                    'data-toggle' => 'tooltip',
                    'data-placement' => 'top',
                    'data' => [
                        'confirm' => 'Are you sure you want to remove this indicator?',
                        'method' => 'post',
                    ],
                    'style' => "padding:5px;",
                    'class' => 'bt btn-lg'
                        ]
        );
                
            }
            ?>


    </p>
<?php
$act="";
$activity = \backend\models\AWPBActivity::findOne(['id' => $model->activity_id]);
if (!empty($activity)) {
    $act=  $activity->description;
}
$outi="";
$output = \backend\models\AWPBOutput::findOne(['id' => $model->output_id]);
if (!empty($output)) {
    $outi=  $output->description;
    }
    $comp="";
    $component = \backend\models\AWPBComponent::findOne(['id' => $model->component_id]);
        
    if (!empty($component)) {
        $comp=  $component->code;
        }
        $unit="";
    $unit_of_me = \backend\models\AwpbUnitOfMeasure::findOne(['id' => $model->unit_of_measure_id]);
        
    if (!empty($unit_of_me)) {
        $unit=  $unit_of_me->name;
        }
?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
          
                'attribute'=>'component_id',
                'format' => 'raw',
                'label' => 'Component',
                'value' => $comp
            ],
            [
          
                'attribute'=>'output_id',
                'format' => 'raw',
                'label' => 'Output',
                'value' => $outi
            ],
            [
          
                'attribute'=>'activity_id',
                'format' => 'raw',
                'label' => 'Activity',
                'value' => $act
            ],
            [
                'attribute'=>'unit_of_measure_id',
                'format' => 'raw',
                'label' => 'Unit of Measure',
                'value' => $unit
               ],
                    
            'name',
            'description',

            // 'unit_of_measure_id',
            // 'created_at',
            // 'updated_at',
            // 'created_by',
            // 'updated_by',
        ],
    ]) ?>

</div></div></div>
