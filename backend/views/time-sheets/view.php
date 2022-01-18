<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;
use backend\models\TimeSheetsDistrictStaff;

/* @var $this yii\web\View */
/* @var $model backend\models\TimeSheetsDistrictStaff */

$this->title = "Time sheet #:" . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'My Time Sheets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="card card-success card-outline">
    <div class="card-body">
        <p>
            <?php
            if ($model->status == TimeSheetsDistrictStaff::_resent_back) {
                echo Html::a(
                        '<span class="fa fa-edit"></span>', ['update', 'id' => $model->id], [
                    'title' => 'Edit time sheet',
                    'data-toggle' => 'tooltip',
                    'data-placement' => 'top',
                    'data-pjax' => '0',
                    'style' => "padding:10px;",
                    'class' => 'bt btn-lg'
                        ]
                );
                echo Html::a(
                        '<span class="fa fa-trash"></span>', ['delete', 'id' => $model->id], [
                    'title' => 'Remove time sheet',
                    'data-toggle' => 'tooltip',
                    'data-placement' => 'top',
                    'data' => [
                        'confirm' => 'Are you sure you want to remove this Time sheet?',
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
                [
                    'attribute' => 'month',
                    'filter' => false,
                    'format' => 'raw',
                ],
                [
                    'attribute' => 'year',
                    'filter' => false,
                    'format' => 'raw',
                ],
                [
                    'attribute' => 'designation',
                    'filter' => false,
                    'format' => 'raw',
                ],
                [
                    'attribute' => 'activity_description',
                    'filter' => false,
                    'format' => 'raw',
                ],
                [
                    'attribute' => 'hours_field_esapp_activities',
                    'filter' => false,
                    'format' => 'raw',
                ],
                [
                    'attribute' => 'hours_office_esapp_activities',
                    'filter' => false,
                    'format' => 'raw',
                ],
                [
                    'attribute' => 'total_hours_worked',
                    'filter' => false,
                    'format' => 'raw',
                ],
                [
                    'attribute' => 'rate_id',
                    'filter' => false,
                    'format' => 'raw',
                    'value' => function($model) {
                        return !empty($model->rate) ? $model->rate->rate : 0;
                    }
                ],
                [
                    'attribute' => 'contribution',
                    'filter' => false,
                    'format' => 'raw',
                ],
                [
                    'attribute' => 'status',
                    //'class' => EditableColumn::className(),
                    'enableSorting' => true,
                    'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
                    'filterWidgetOptions' => [
                        'pluginOptions' => ['allowClear' => true],
                    ],
                    'filter' => [
                        TimeSheetsDistrictStaff::_accepted => 'Approved',
                        TimeSheetsDistrictStaff::_status_pending_approval => 'Pending approval',
                        TimeSheetsDistrictStaff::_resent_back => 'Sent back. Requires changes'
                    ],
                    'filterInputOptions' => ['prompt' => 'Filter by Status', 'class' => 'form-control', 'id' => null],
                    'format' => 'raw',
                    'value' => function($model) {
                        $str = "";
                        if ($model->status == TimeSheetsDistrictStaff::_accepted) {
                            $str = "<p class='badge badge-success'> "
                                    . "<i class='fa fa-check'></i> Approved</p><br>";
                        } elseif ($model->status == TimeSheetsDistrictStaff::_status_pending_approval) {
                            $str = "<p class='badge badge-warning'> "
                                    . "<i class='fa fa-hourglass-half'></i> Pending approval</p><br>";
                        } else {
                            $str = "<p class='badge badge-danger'> "
                                    . "<i class='fa fa-times'></i> Resent back. Requires changes</p><br>";
                        }
                        return $str;
                    },
                ],
                'reviewer_comments:ntext',
                [
                    'label' => 'Approved by',
                    'value' => function($model) {
                        $user = \backend\models\User::findOne(['id' => $model->approved_by]);
                        return !empty($user) ? $user->first_name . " " . $user->other_name . " " . $user->last_name . "-" . $user->email : "";
                    }
                ],
                /* [
                  'label' => 'Updated by',
                  'value' => function($model) {
                  $user = \backend\models\User::findOne(['id' => $model->updated_by]);
                  return !empty($user) ? $user->first_name . " " . $user->other_name . " " . $user->last_name . "-" . $user->email : "";
                  }
                  ],
                  [
                  'label' => 'Updated at',
                  'value' => function($model) {
                  return date('d-F-Y H:i:s', $model->updated_at);
                  }
                  ], */
                [
                    'label' => 'Date approved',
                    'value' => function($model) {

                        return !empty($model->approved_at) ? $model->approved_at : "";
                    }
                ],
                [
                    'label' => 'Date submitted',
                    'value' => function($model) {
                        return date('d-F-Y H:i:s', $model->created_at);
                    }
                ],
            ],
        ])
        ?>

    </div>
</div>
