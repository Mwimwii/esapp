<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use yii\grid\ActionColumn;
use backend\models\User;
use backend\models\Storyofchange;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MeBackToOfficeReportSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'My Back to office reports';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card card-success card-outline">
    <div class="card-body">
        <h5>Instructions</h5>
        <ol>
            <li>Click <span class="badge badge-success">Submit report</span> button below to 
                add a Back to office report
            </li>
            <li>You can only edit reports which you have not Submitted for review or those which have been Resent back for changes
            </li>
            <li>To edit a report, click the 
                <span class="badge badge-primary"><span class="fa fa-edit fa-1x"></span></span> 
                icon in the table below
            </li>
            <li>To view full details of a report, click the 
                <span class="badge badge-primary"><span class="fa fa-eye fa-1x"></span></span> 
                icon in the table below
            </li>
            <li>You can delete a report that you have not yet submitted for review. To delete a report, click the
                <span class="badge badge-primary"><span class="fa fa-trash fa-1x"></span></span> 
                icon in the table below
            </li>
        </ol>
        <p>
            <?= Html::a('<i class="fa fa-plus"></i> Submit report', ['create'], ['class' => 'btn btn-success btn-xs']) ?>
        </p>

        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                // ['class' => 'yii\grid\SerialColumn'],
                //'id',
                [
                    'attribute' => 'name_of_officer',
                    'filter' => false,
                    'format' => 'raw',
                ],
                [
                    'attribute' => 'team_members',
                    'filter' => false,
                    'format' => 'raw',
                ],
                [
                    'label' => 'Travel dates',
                    'attribute' => 'team_members',
                    'filter' => false,
                    'format' => 'raw',
                    'value' => function ($model) {
                        return $model->start_date . " to " . $model->end_date;
                    }
                ],
                //'key_partners:ntext',
                [
                    'attribute' => 'purpose_of_assignment',
                    'filter' => false,
                    'format' => 'raw',
                ],
                //'summary_of_assignment_outcomes:ntext',
                //'key_findings:ntext',
                //'key_recommendations:ntext',
                //'copy_sent_to:ntext',
                //'annexes:ntext',
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
                            $str = "<p class='badge badge-success'> "
                                    . "<i class='fa fa-check'></i> Accepted</p><br>";
                        } elseif ($model->status == Storyofchange::_submitted_for_review) {
                            $str = "<p class='badge badge-info'> "
                                    . "<i class='fa fa-hourglass-half'></i> Submitted for review</p><br>";
                        } elseif ($model->status == Storyofchange::_resent_back) {
                            $str = "<p class='badge badge-warning'> "
                                    . "<i class='fa fa-times'></i> Resent back. Requires changes</p><br>";
                        } else {
                            $str = "<p class='badge badge-danger'> "
                                    . "<i class='fa fa-times'></i> Pending submision for review</p><br>";
                        }
                        return $str;
                    },
                ],
                //'created_at',
                //'updated_at',
                //'created_by',
                //'updated_by',
                ['class' => ActionColumn::className(),
                    'options' => ['style' => 'width:200px;'],
                    'template' => '{view}{update}{submit}{delete}',
                    'buttons' => [
                        'view' => function ($url, $model) {
                            return Html::a(
                                            '<span class="fa fa-eye"></span>', ['view', 'id' => $model->id], [
                                        'title' => 'View full report details',
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
                                                '<span class="fa fa-edit"></span>', ['update', 'id' => $model->id], [
                                            'title' => 'Edit report',
                                            'data-toggle' => 'tooltip',
                                            'data-placement' => 'top',
                                            'data-pjax' => '0',
                                            'style' => "padding:10px;",
                                            'class' => 'bt btn-lg'
                                                ]
                                );
                            }
                        },
                        'submit' => function ($url, $model) {
                            if ($model->status == 0 || $model->status == 3) {
                                return Html::a(
                                                '<span class="fa fa-paper-plane"></span>', ['submit-for-review', 'id' => $model->id], [
                                            'title' => 'Submit for review',
                                            'data-toggle' => 'tooltip',
                                            'data-placement' => 'top',
                                            'data' => [
                                                'confirm' => 'Are you sure you want to submit this Back to office report?<br/>'
                                                . 'You will not be able to make changes to the report once submitted',
                                                'method' => 'post',
                                            ],
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
                                            'title' => 'Remove report',
                                            'data-toggle' => 'tooltip',
                                            'data-placement' => 'top',
                                            'data' => [
                                                'confirm' => 'Are you sure you want to remove this Back to office report:?',
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
