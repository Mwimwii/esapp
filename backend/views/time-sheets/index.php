<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use yii\grid\ActionColumn;
use backend\models\TimeSheetsDistrictStaff;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TimeSheetsDistrictStaffSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'My Time Sheets';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card card-success card-outline">
    <div class="card-body">
        <h5>Instructions</h5>
        <ol>
            <li>Click <span class="badge badge-success">Submit time sheet</span> button below to 
                add a new time sheet
            </li>
            <li>You can only add time sheets for a month which you have not added already for the year the activity was done
            </li>
            <li>To edit a time sheet and submit for approval, click the 
                <span class="badge badge-primary"><span class="fa fa-edit fa-1x"></span></span> 
                icon in the table below
            </li>
            <li>You can only edit time sheets which you have not Submitted for review or those which have been Resent back for changes
            </li>
            <li>To view full details of a time sheet record, click the 
                <span class="badge badge-primary"><span class="fa fa-eye fa-1x"></span></span> 
                icon in the table below
            </li>
            <li>You can delete a time sheet record that you have not yet submitted for review. To delete a record, click the
                <span class="badge badge-primary"><span class="fa fa-trash fa-1x"></span></span> 
                icon in the table below
            </li>
        </ol>
        <p>
            <?= Html::a('<i class="fa fa-plus"></i> Submit time sheet', ['create'], ['class' => 'btn btn-success btn-xs']) ?>
        </p>

        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                // 'id',
                [
                    'attribute' => 'month',
                    'filter' => false,
                    'format' => 'raw',
                    'label' => 'Period',
                    'value' => function($model){
                    return $model->month."-".$model->year;
                    },
                ],
                /*[
                    'attribute' => 'month',
                    'filter' => false,
                    'format' => 'raw',
                ],
                [
                    'attribute' => 'year',
                    'filter' => false,
                    'format' => 'raw',
                ],*/
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
               /* [
                    'attribute' => 'total_hours_worked',
                    'filter' => false,
                    'format' => 'raw',
                ],*/
                [
                    'attribute' => 'rate_id',
                    'filter' => false,
                    'format' => 'raw',
                    'value' => function($model) {
                        return !empty($model->rate_id) ? \backend\models\HourlyRates::findOne($model->rate_id)->rate : 0;
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
                //'reviewer_comments:ntext',
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
                              if ($model->status == TimeSheetsDistrictStaff::_resent_back) {
                                return Html::a(
                                                '<span class="fa fa-edit"></span>', ['update', 'id' => $model->id], [
                                            'title' => 'Edit time sheet',
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
                            if ($model->status == TimeSheetsDistrictStaff::_resent_back) {
                                return Html::a(
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
                        },
                    ]
                ],
            ],
        ]);
        ?>


    </div>
</div>
