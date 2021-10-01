<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\AwpbOutput */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Awpb Outputs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

    $comp="";
$component = \backend\models\AWPBComponent::findOne(['id' => $model->component_id]);
	
if (!empty($component)) {
    $comp=   $component->code. ' '.$component->name;
    }
?>

<div class="card card-success card-outline">
    <div class="card-body">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php

echo Html::a('<span class="fas fa-arrow-left fa-2x"></span>', ['index', 'id' => $model->id], [
    'title' => 'back',
    'data-toggle' => 'tooltip',
    'data-placement' => 'top',
]);
if (\backend\models\User::userIsAllowedTo('Setup AWPB')) {
      
    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
  
    echo Html::a('<span class="fas fa-edit fa-2x"></span>', ['update', 'id' => $model->id], [
        'title' => 'Update output',
        'data-toggle' => 'tooltip',
        'data-placement' => 'top',
    ]);
    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    
        echo Html::a(
            '<span class="fa fa-trash"></span>', ['delete', 'id' => $model->id], [
        'title' => 'delete output',
        'data-toggle' => 'tooltip',
        'data-placement' => 'top',
        'data' => [
            'confirm' => 'Are you sure you want to delete this output?',
            'method' => 'post',
        ],
        'style' => "padding:5px;",
        'class' => 'bt btn-lg'
            ]
);
}
$comp="";
$component = \backend\models\AWPBComponent::findOne(['id' => $model->component_id]);
if (!empty($component)) {
    $comp=  $component->name;
    }
$outc="";
$outcome = \backend\models\AWPBOutcome::findOne(['id' => $model->outcome_id]);
if (!empty($outcome)) {
    $outc=  $outcome->name;
    }
?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
          
        'attribute'=>'outcome_id',
        'format' => 'raw',
        'label' => 'Component',
        'value' => $outc
    ],
            'name',
            'output_description',     

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
         <?php  if (\backend\models\User::userIsAllowedTo('Setup AWPB')) {
        echo Html::a('<span class="fas fa-arrow-left fa-2x"></span>', ['index', 'id' => $model->id], [
            'title' => 'back',
            'data-toggle' => 'tooltip',
            'data-placement' => 'top',
        ]);
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
      
        echo Html::a('<span class="fas fa-edit fa-2x"></span>', ['update', 'id' => $model->id], [
            'title' => 'Update component',
            'data-toggle' => 'tooltip',
            'data-placement' => 'top',
        ]);
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        
            echo Html::a(
                '<span class="fa fa-trash"></span>', ['delete', 'id' => $model->id], [
            'title' => 'delete component',
            'data-toggle' => 'tooltip',
            'data-placement' => 'top',
            'data' => [
                'confirm' => 'Are you sure you want to remove this activitiy?',
                'method' => 'post',
            ],
            'style' => "padding:5px;",
            'class' => 'bt btn-lg'
                ]
);
        
    }?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'code',
             [
                'attribute'=>'component_id',
                'format' => 'raw',
                'label' => 'Component',
                'value' => $comp
                
            ],
           // 'outcome_id',
            'name',
            'description',
//            'created_at',
//            'updated_at',
//            'created_by',
//            'updated_by',
        ],
    ]) ?>

    </div></div>
        ],
    ]) ?>

</div>
</div>

