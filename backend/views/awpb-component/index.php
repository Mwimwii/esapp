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
            if (\backend\models\User::userIsAllowedTo('Manage components')) {
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
                    'width' => '180px',
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
                    'width' => '180px',
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
                              
                        }
                       
                                           }
                ],
                

                // [
                //     'attribute' => 'description',
                //     'label' => ' Description',
                //     'format' => 'raw',
                //     'filterType' => GridView::FILTER_SELECT2,
                //     'filterWidgetOptions' => [
                //         'pluginOptions' => ['allowClear' => true],
                //     ],
                //     'filter' => \backend\models\AwpbComponent::getAwpbComponentsList(),
                //     'filterInputOptions' => ['prompt' => 'Filter by description', 'class' => 'form-control', 'id' => null],
                //     "value" => function ($model) {
                //         $name = "";
                //         $comp_model = \backend\models\AwpbComponent::findOne(["id" => $model->id]);
                //         if (!empty($comp_model)) {
                //             $name = $comp_model->description;
                //         }
                //         return $name;
                //     }
                // ],

                //        [
                //     'attribute' => 'expense_category_id',
                //     'label' => 'Expense Category',
                //     'format' => 'raw',
                //     'filterType' => GridView::FILTER_SELECT2,
                //     'filterWidgetOptions' => [
                //         'pluginOptions' => ['allowClear' => true],
                //     ],
                //     'filter' => \backend\models\AwpbExpenseCategory::getAwpbExpenseCategoryList(),
                //     'filterInputOptions' => ['prompt' => 'Filter by funder', 'class' => 'form-control', 'id' => null],
                //     "value" => function ($model) {
                //         $name = "";
                //         $expense_category = \backend\models\AwpbExpenseCategory::findOne(['id' => $model->expense_category_id]);
                              
                //         if (!empty($expense_category)) {
                //            $name =  $expense_category->name;
                //        }
                      
                //         return $name;
                //     }
                // ],
                // [
                //     'attribute' => 'funder_id',
                //     'label' => ' Funder',
                //     'format' => 'raw',
                //     'filterType' => GridView::FILTER_SELECT2,
                //     'filterWidgetOptions' => [
                //         'pluginOptions' => ['allowClear' => true],
                //     ],
                //     'filter' => \backend\models\AwpbFunder::getAwpbFunderList(),
                //     'filterInputOptions' => ['prompt' => 'Filter by funder', 'class' => 'form-control', 'id' => null],
                //     "value" => function ($model) {
                //         $name = "";
                //         $funder = \backend\models\AwpbFunder::findOne(['id' => $model->funder_id]);
                //         if (!empty($funder)) {
                //             $name = $funder->name;
                //         }
                //         return $name;
                //     }
                // ],
         'gl_account_code',
               'outcome',
                'output',
               
                    
                //'created_at',
                //'updated_at',
                //'updated_by',
                //'created_by',
                ['class' => 'yii\grid\ActionColumn',
                    'template' => '{view}{update}{delete}',
                    'buttons' => [
                        'view' => function ($url, $model) {
                            if (User::userIsAllowedTo('View components') ) {
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
                            if (User::userIsAllowedTo('Manage components') ) {
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
                            if (User::userIsAllowedTo('Manage components') ) {
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
