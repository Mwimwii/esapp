<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;
use backend\models\Storyofchange;
/* @var $this yii\web\View */
/* @var $model backend\models\MeBackToOfficeReport */

$this->title = "BtOR report #" . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'My Back to office reports', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="card card-success card-outline">
    <div class="card-body">
        <p>
            <?php
            if ($model->status == 0 || $model->status == 3) {
                echo Html::a(
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

            if ($model->status == 0 || $model->status == 3) {
                echo Html::a(
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
            if ($model->status == 0) {
                echo Html::a(
                        '<span class="fa fa-trash"></span>', ['delete', 'id' => $model->id], [
                    'title' => 'Remove report',
                    'data-toggle' => 'tooltip',
                    'data-placement' => 'top',
                    'data' => [
                        'confirm' => 'Are you sure you want to remove this Back to office report?',
                        'method' => 'post',
                    ],
                    'style' => "padding:10px;",
                    'class' => 'bt btn-lg'
                        ]
                );
            }
            //This is a hack, just to use pjax for the delete confirm button
            $query = \backend\models\User::find()->where(['id' => '-2']);
            $dataProvider = new \yii\data\ActiveDataProvider([
                'query' => $query,
            ]);
            GridView::widget([
                'dataProvider' => $dataProvider,
            ]);
            ?>
        </p>

        <?=
        DetailView::widget([
            'model' => $model,
            'attributes' => [
                //  'id',
                'name_of_officer',
                [
                    'attribute' => "team_members",
                    'format' => 'raw',
                ],
                [
                    'attribute' => "travel_dates",
                    'format' => 'raw',
                    'value' => function($model) {
                        return $model->start_date . " to " . $model->end_date;
                    }
                ],
                [
                    'attribute' => "key_partners",
                    'format' => 'raw',
                ],
                [
                    'attribute' => "purpose_of_assignment",
                    'format' => 'raw',
                ],
                [
                    'attribute' => "summary_of_assignment_outcomes",
                    'format' => 'raw',
                ],
                [
                    'attribute' => "key_findings",
                    'format' => 'raw',
                ],
                [
                    'attribute' => "key_recommendations",
                    'format' => 'raw',
                ],
                [
                    'attribute' => "annexes",
                    'format' => 'raw',
                ],
                [
                    'attribute' => "reviewer_comments",
                    'format' => 'raw',
                ],
                [
                    'attribute' => 'status',
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
            // 'copy_sent_to:ntext',
            // 'created_at',
            // 'updated_at',
            // 'created_by',
            // 'updated_by',
            ],
        ])
        ?>

    </div>
</div>
