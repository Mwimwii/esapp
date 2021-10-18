<?php

use kartik\grid\EditableColumn;
use kartik\grid\GridView;
use yii\helpers\Html;
use kartik\editable\Editable;
use backend\models\User;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Components';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="card card-success card-outline">
    <div class="card-body">

        <p>
            <?php
            if (\backend\models\User::userIsAllowedTo('Setup AWPB')) {
               
                     echo Html::a('<i class="fa fa-plus"></i> Add component', ['create'], ['class' => 'btn btn-success btn-sm']);
                
            }
            ?>
        </p>
        <hr class="dotted short">
        <?php // echo $this->render('_search', ['model' => $searchModel]);   ?>

        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

             
                [
                    'attribute' => 'code', 
                    'vAlign' => 'top',
                    'width' => '50px',
                    'value' => function ($model, $key, $index, $widget) { 
                    return      Html::a($model->code, ['awpb-component/view', 'id' => $model->id], ['class' => 'awbp-component']);
                   
                    },
                    'filterType' => GridView::FILTER_SELECT2,
                    'filter' => ArrayHelper::map(backend\models\AwpbComponent::find()->orderBy('name')->asArray()->all(), 'id', 'code'), 
                    'filterWidgetOptions' => [
                        'pluginOptions' => ['allowClear' => true],
                        'options' => ['multiple' => true]
                    ],
                    'filterInputOptions' => ['placeholder' => 'Filter by code'],
                    'format' => 'raw'
                ],

                [
                    'attribute' => 'name', 
                    'vAlign' => 'top',
                    'width' => '800px',
                    'value' => function ($model, $key, $index, $widget) { 
                    return      Html::a($model->name, ['awpb-component/view', 'id' => $model->id], ['class' => 'awbp-component']);
                   
                    },
                    'filterType' => GridView::FILTER_SELECT2,
                    'filter' => ArrayHelper::map(backend\models\AwpbComponent::find()->orderBy('name')->asArray()->all(), 'id', 'name'), 
                    'filterWidgetOptions' => [
                        'pluginOptions' => ['allowClear' => true],
                        'options' => ['multiple' => true]
                    ],
                    'filterInputOptions' => ['placeholder' => 'Filter by name'],
                    'format' => 'raw'
                ],

                [
                    'attribute' => 'type', 
                    'vAlign' => 'top',
                    'width' => '120px',
                    'value' => function($model) {
                            if ($model->type==1)
                            {
                                return "Sub";
                                  
                            }
                            else
                            {
                               
                                return "Main";
                            }
            
                    },
                    'filterType' => GridView::FILTER_SELECT2,
                    'filter' => ArrayHelper::map(backend\models\AwpbComponent::find()->orderBy('type')->asArray()->all(), 'id', 'type'), 
                    'filterWidgetOptions' => [
                        'pluginOptions' => ['allowClear' => true],
                        'options' => ['multiple' => true]
                    ],
                    'filterInputOptions' => ['placeholder' => 'Filter by type'],
                    'format' => 'raw'
                ],

                [
                    'label' => 'Access Level',
                    'value' => function($model) {
                        $access="";
                        if ($model->access_level_district==1)
                        {
                            $access .= "District";
                            return  $access;
                        }
                        if ($model->access_level_province==1)
                        {
                            $access .= " Province";
                            return  $access;
                        }
                        if ($model->access_level_programme==1)
                        {
                            $access .= " Programme";
                            return  $access;
                        }
                           
                       
                                           }
                ],
         
                [
                    'attribute' =>  'gl_account_code', 
                    'vAlign' => 'top',
                    'width' => '150px',
                ],
         //'gl_account_code',
              // 'outcome',
               // 'output',
               
                    
                //'created_at',
                //'updated_at',
                //'updated_by',
                //'created_by',
                ['class' => 'yii\grid\ActionColumn',
                'options' => ['style' => 'width:150px;'],
                    'template' => '{view}{update}{delete}',
                    'buttons' => [
                        'view' => function ($url, $model) {
                            if (User::userIsAllowedTo('View AWPB') ) {
                                return Html::a(
                                                '<span class="fa fa-eye"></span>', ['view', 'id' => $model->id], [
                                            'title' => 'View component',
                                            'data-toggle' => 'tooltip',
                                            'data-placement' => 'top',
                                            'data-pjax' => '0',
                                            'style' => "padding:5px;",
                                            'class' => 'bt btn-lg'
                                                ]
                                );
                            }
                        },
                        'update' => function ($url, $model) {
                            if (User::userIsAllowedTo('Setup AWPB') ) {
                                return Html::a(
                                                '<span class="fas fa-edit"></span>', ['update', 'id' => $model->id], [
                                            'title' => 'Update component',
                                            'data-toggle' => 'tooltip',
                                            'data-placement' => 'top',
                                            // 'target' => '_blank',
                                            'data-pjax' => '0',
                                            'style' => "padding:5px;",
                                            'class' => 'bt btn-lg'
                                                ]
                                );
                            }
                        },
                        'delete' => function ($url, $model) {
                            if (User::userIsAllowedTo('Setup AWPB') ) {
                                return Html::a(
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
                        },
                    ]
                ]
            ],
        ]);
        ?>


    </div>
</div>
