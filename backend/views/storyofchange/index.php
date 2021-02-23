<?php

use kartik\editable\Editable;
use kartik\grid\EditableColumn;
use kartik\grid\GridView;
use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\grid\ActionColumn;
use backend\models\User;
use kartik\popover\PopoverX;
use backend\models\Storyofchange;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\StoryofchangeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'My Stories of change';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card card-success card-outline">
    <div class="card-body">
        <h5>Instructions</h5>
        <ol>
            <li>Click <span class="badge badge-success">Add Story of change</span> button below to 
                add a new story of change
            </li>
            <li>You can only edit stories which you have not Submitted for review or those which have been Resent back for changes
            </li>
            <li>To edit full details of a Story, click the 
                <span class="badge badge-primary"><span class="fa fa-edit fa-2x"></span></span> 
                icon in the table below
            </li>
            <li>To view full details of a Story, click the 
                <span class="badge badge-primary"><span class="fa fa-eye fa-2x"></span></span> 
                icon in the table below
            </li>
            <li>You can delete Stories that you have not yet submitted for review. To delete a story, click the
                <span class="badge badge-primary"><span class="fa fa-trash fa-2x"></span></span> 
                icon in the table below
            </li>
        </ol>
        <p>
            <?= Html::a('<i class="fa fa-plus"></i> Add Story of change', ['create'], ['class' => 'btn btn-success btn-xs']) ?>
        </p>

        <?php // echo $this->render('_search', ['model' => $searchModel]);   ?>

        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                //'id',
                [
                    'attribute' => 'category_id',
                    'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
                    'filterWidgetOptions' => [
                        'pluginOptions' => ['allowClear' => true],
                    ],
                    'filter' => \backend\models\LkmStoryofchangeCategory::getList(),
                    'filterInputOptions' => ['prompt' => 'Filter by story category', 'class' => 'form-control',],
                    'format' => 'raw',
                    'value' => function($model) {
                        return !empty($model->category_id) ? backend\models\LkmStoryofchangeCategory::findOne($model->category_id)->name : "";
                    }
                ],
                [
                    'attribute' => 'title', 'filter' => false,
                    'format' => 'raw',
                ],
                //'interviewee_names:ntext',
                // 'interviewer_names:ntext',
                //'date_interviewed',
                //'introduction:ntext',
                //'challenge:ntext',
                //'actions:ntext',
                //'results:ntext',
                //'conclusions:ntext',
                //'sequel:ntext',
                [
                    'attribute' => 'status',
                    //'class' => EditableColumn::className(),
                    'enableSorting' => true,
                    'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
                    'filterWidgetOptions' => [
                        'pluginOptions' => ['allowClear' => true],
                    ],
                    'filter' => [
                        Storyofchange::_status_pending_review_submission => 'Pending submision for review',
                        Storyofchange::_accepted => 'Accepted',
                        Storyofchange::_submitted_for_review => 'Submitted for review',
                        Storyofchange::_resent_back => 'Resent back. Requires changes'
                    ],
                    'filterInputOptions' => ['prompt' => 'Filter by Status', 'class' => 'form-control', 'id' => null],
                    'format' => 'raw',
                    'value' => function($model) {
                        $str = "";
                        if ($model->status == Storyofchange::_accepted) {
                            $str = "<p style='margin:2px;padding:2px;display:inline-block;' class='badge badge-success'> "
                                    . "<i class='fa fa-check'></i> Accepted</p><br>";
                        } elseif ($model->status == Storyofchange::_submitted_for_review) {
                            $str = "<p style='margin:2px;padding:2px;display:inline-block;' class='badge badge-info'> "
                                    . "<i class='fa fa-times'></i> Submitted for review</p><br>";
                        } elseif ($model->status == Storyofchange::_resent_back) {
                            $str = "<p style='margin:2px;padding:2px;display:inline-block;' class='badge badge-warning'> "
                                    . "<i class='fa fa-times'></i> Resent back. Requires changes</p><br>";
                        } else {
                            $str = "<p style='margin:2px;padding:2px;display:inline-block;' class='badge badge-danger'> "
                                    . "<i class='fa fa-times'></i> Pending submision for review</p><br>";
                        }
                        return $str;
                    },
                ],
                //'paio_review_status',
                //'paio_comments:ntext',
                //'ikmo_review_status',
                //'ikmo_comments:ntext',
                //'created_at',
                //'updated_at',
                //'created_by',
                //'updated_by',
                ['class' => ActionColumn::className(),
                    'options' => ['style' => 'width:150px;'],
                    'template' => '{view}{update}{delete}',
                    'buttons' => [
                        'view' => function ($url, $model) {
                            return Html::a(
                                            '<span class="fa fa-eye"></span>', ['view', 'id' => $model->id], [
                                        'title' => 'View story details',
                                        'data-toggle' => 'tooltip',
                                        'data-placement' => 'top',
                                        'data-pjax' => '0',
                                        'style' => "padding:10px;",
                                        'class' => 'bt btn-lg'
                                            ]
                            );
                        },
                        'update' => function ($url, $model) {
                            if ($model->status == 0 || $model->status == 3) {
                                return Html::a(
                                                '<span class="fa fa-edit"></span>', ['check-list', 'id' => $model->id], [
                                            'title' => 'Edit Story',
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
                            if ($model->status == 0) {
                                return Html::a(
                                                '<span class="fa fa-trash"></span>', ['delete', 'id' => $model->id], [
                                            'title' => 'Remove Story',
                                            'data-toggle' => 'tooltip',
                                            'data-placement' => 'top',
                                            'data' => [
                                                'confirm' => 'Are you sure you want to remove story:' . $model->title . '?',
                                                'method' => 'post',
                                            ],
                                            'style' => "padding:10px;",
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
<?php
$this->registerCss('.popover-x {display:none}');
?>
