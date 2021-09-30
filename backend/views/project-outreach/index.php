<?php

use yii\helpers\Html;
use backend\models\User;
use yii\grid\ActionColumn;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProjectOutreachSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Project Outreach records';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card card-success card-outline">
    <div class="card-body">
        <p>
            All project outreach records are for <code>Component 2: Sustainable Agribusiness Partnerships</code>
        </p>
        <p>
            <?php
            if (User::userIsAllowedTo('Submit project outreach records')) {
                echo Html::a('Submit record', ['create'], ['class' => 'btn btn-success']);
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
                //'id',
                // 'component:ntext',
                [
                    'attribute' => 'sub_component',
                    'filter' => false,
                    'format' => 'raw',
                ],
                [
                    'attribute' => 'year',
                    'filter' => false,
                    'format' => 'raw',
                ],
                [
                    'attribute' => 'quarter',
                    'filter' => false,
                    'format' => 'raw',
                ],
                [
                    'attribute' => 'number_females',
                    'filter' => false,
                    'format' => 'raw',
                ],
                [
                    'attribute' => 'number_males',
                    'filter' => false,
                    'format' => 'raw',
                ],
                [
                    'attribute' => 'number_young',
                    'filter' => false,
                    'format' => 'raw',
                ],
                [
                    'attribute' => 'number_not_young',
                    'filter' => false,
                    'format' => 'raw',
                ],
                [
                    'attribute' => 'number_women_headed_households',
                    'filter' => false,
                    'format' => 'raw',
                ],
                [
                    'attribute' => 'number_households',
                    'filter' => false,
                    'format' => 'raw',
                ],
                [
                    'attribute' => 'number_household_members',
                    'filter' => false,
                    'format' => 'raw',
                ],
                // 'province_id',
                //'district_id',
                //'created_at',
                //'updated_at',
                //'created_by',
                //'updated_by',
                ['class' => ActionColumn::className(),
                    'options' => ['style' => 'width:160px;'],
                    'template' => '{view} {update} {delete}',
                    'buttons' => [
                        'view' => function ($url, $model) {
                            return Html::a(
                                            '<span class="fa fa-eye"></span>', ['view', 'id' => $model->id], [
                                        'title' => 'View record',
                                        'data-toggle' => 'tooltip',
                                        'data-placement' => 'top',
                                        'data-pjax' => '0',
                                        'style' => "padding:10px;",
                                        'class' => 'bt btn-lg'
                                            ]
                            );
                        },
                        'update' => function ($url, $model) {
                            if (User::userIsAllowedTo('Submit project outreach records')) {
                                return Html::a(
                                                '<span class="fa fa-edit"></span>', ['update', 'id' => $model->id], [
                                            'title' => 'Edit record',
                                            'data-toggle' => 'tooltip',
                                            'data-placement' => 'top',
                                            'data-pjax' => '0',
                                            'style' => "padding:10px;",
                                            'class' => 'bt btn-lg'
                                                ]
                                );
                            }
                        },
                        'delete' => function ($url, $model) {
                            if (User::userIsAllowedTo('Remove project outreach records')) {
                                return Html::a(
                                                '<span class="fa fa-trash"></span>', ['delete', 'id' => $model->id], [
                                            'title' => 'Remove record',
                                            'data-toggle' => 'tooltip',
                                            'data-placement' => 'top',
                                            'data' => [
                                                'confirm' => 'Are you sure you want to remove this record?',
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
