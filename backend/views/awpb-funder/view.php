<?php
use yii\helpers\Html;
//use yii\widgets\DetailView;
//use kartik\grid\GridView;
use kartik\detail\DetailView;
use \backend\models\User;
//use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model backend\models\AwpbFunder */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Awpb Funders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="card card-success card-outline">
    <div class="card-body">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    
            <?php
            if (\backend\models\User::userIsAllowedTo('Manage AWPB Funders')) {
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
                        'confirm' => 'Are you sure you want to remove this template?',
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
                'attribute'=>'status', 
                'label'=>'Status',
                'format'=>'raw',
                'value'=>$model->status ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Blocked</span>',
                'type'=>DetailView::INPUT_SWITCH,
                'widgetOptions' => [
                    'pluginOptions' => [
                        'onText' => 'Active',
                        'offText' => 'Blocked',
                    ]
                ],
                'valueColOptions'=>['style'=>'width:30%']
            ],

            'code',
            'name',
            'description',
    
            // 'created_at',
            // 'updated_at',
            // 'created_by',
            // 'updated_by',
        ],
    ]) ?>

</div>
</div>