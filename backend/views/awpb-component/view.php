<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\tabs\TabsX;
use kartik\icons\Icon;
use lo\widgets\modal\ModalAjax;
/* @var $this yii\web\View */
/* @var $model backend\models\AwpbComponent */

$this->title = 'Component : '. $model->code;
$this->params['breadcrumbs'][] = ['label' => 'Components', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

?>
<div class="card card-success card-outline">
    <div class="card-body">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    
            <?php
            if (\backend\models\User::userIsAllowedTo('Manage components')) {
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
                        'confirm' => 'Are you sure you want to remove this component?',
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
           
            'code',
           
            [
                'attribute' => 'parent_component_id',
                'format' => 'raw',
                'label' => 'Parent Component',
                'value' => function ($model) {
                    return !empty($model->parent_component_id) && $model->parent_component_id > 0 ? backend\models\AwpbComponent::findOne($model->parent_component_id)->name: "";
                },
                'visible' => !empty($model->parent_component_id) && $model->parent_component_id > 0 ? TRUE : FALSE,
            ],
            [
                'label' => 'Component Type',
                'value' => function($model) {
                    if ($model->type==0)
                    {
                        return "Main";    
                    }
                    else
                    {
                        return "Sub";
                    } }
            ],
            'name',
            'description',
     
           
        
            'outcome:ntext',
            'output:ntext',
            'gl_account_code',
            
            [
             'label' => 'Access Level',
             'value' => function($model) {
                 if ($model->access_level==1)
                 {
                     return "District";
                       
                 }
                 if ($model->access_level==2)
                 {
                     return "Provincial";
                       
                 }
                 if ($model->access_level==3)
                 {
                     return "Programme";
                       
                 }}
                 
         ],
            // 'subcomponent',
            // 'created_at',
            // 'updated_at',
            // 'created_by',
            // 'updated_by',

        ],
    ]) 
    
    
  ?>
 


</div>
</div>
