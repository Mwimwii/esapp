<?php

use yii\helpers\Html;
use yii\grid\ActionColumn;
use backend\models\User;
use kartik\popover\PopoverX;
use kartik\export\ExportMenu;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MeFaabsTrainingTopicsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'FaaBS training topics';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card card-success card-outline">
    <div class="card-body">

        <p>
            <?php
            if (User::userIsAllowedTo('Manage FaaBS training topics')) {
                echo Html::a('<i class="fa fa-plus"></i> <span class="text-xs">Add training topic</span>', ['create'], ['class' => 'btn btn-success btn-xs']);
            }
            ?>
        </p>

        <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                // 'id',
                [
                    'attribute' => 'subcomponent',
                    'format' => 'raw',
                    //'group' => true,
                    'filterType' => GridView::FILTER_SELECT2,
                    'filterWidgetOptions' => [
                        'pluginOptions' => ['allowClear' => true],
                    ],
                    'filter' => [
                        'Sub-component 2.1' => 'Sub-component 2.1',
                        'Sub-component 2.2' => 'Sub-component 2.2'
                    ],
                    'filterInputOptions' => ['prompt' => 'Filter by sub-component', 'class' => 'form-control', 'id' => null],
                ],
                [
                    'attribute' => 'category',
                    'format' => 'raw',
                    'group' => true,
                    'filterType' => GridView::FILTER_SELECT2,
                    'filterWidgetOptions' => [
                        'pluginOptions' => ['allowClear' => true],
                    ],
                    'filter' => [
                        'Crops' => 'Crops',
                        'Livestock' => 'Livestock',
                        'Aquaculture' => 'Aquaculture'
                    ],
                    'filterInputOptions' => ['prompt' => 'Filter by category', 'class' => 'form-control', 'id' => null],
                ],
                [
                    'attribute' => 'topic',
                    'filter' => false,
                ],
                [
                    'attribute' => 'output_level_indicator',
                    'filter' => false,
                ],
                ['class' => ActionColumn::className(),
                    'options' => ['style' => 'width:130px;'],
                    'template' => '{view}{update}{delete}',
                    'buttons' => [
                        'view' => function ($url, $model) {
                            return Html::a(
                                            '<span class="fa fa-eye"></span>', ['view', 'id' => $model->id], [
                                        'title' => 'View topic',
                                        'data-toggle' => 'tooltip',
                                        'data-placement' => 'top',
                                        'data-pjax' => '0',
                                        'style' => "padding:5px;",
                                        'class' => 'bt btn-lg'
                                            ]
                            );
                        },
                        'update' => function ($url, $model) {
                            if (User::userIsAllowedTo('Manage FaaBS training topics')) {
                                return Html::a(
                                                '<span class="fas fa-edit"></span>', ['update', 'id' => $model->id], [
                                            'title' => 'Update topic',
                                            'data-toggle' => 'tooltip',
                                            'data-placement' => 'top',
                                            'data-pjax' => '0',
                                            'style' => "padding:5px;",
                                            'class' => 'bt btn-lg'
                                                ]
                                );
                            }
                        },
                        'delete' => function ($url, $model) {
                            if (User::userIsAllowedTo('Remove FaaBS training topics')) {
                                return Html::a(
                                                '<span class="fa fa-trash"></span>', ['delete', 'id' => $model->id], [
                                            'title' => 'Remove topic',
                                            'data-toggle' => 'tooltip',
                                            'data-placement' => 'top',
                                            'data' => [
                                                'confirm' => 'Are you sure you want to delete this topic?<br>'
                                                . 'Topic will only be removed if its not being used by the system!',
                                                'method' => 'post',
                                            ],
                                            'style' => "padding:5px;",
                                            'class' => 'bt btn-lg'
                                                ]
                                );
                            }
                        },
                    ]
                ],
            ],
        ]);
        ?>


    </div>
</div>
