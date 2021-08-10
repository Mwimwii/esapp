<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use yii\grid\ActionColumn;
use backend\models\TimeSheetsDistrictStaff;
use backend\models\User;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TimeSheetsDistrictStaffSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Time Sheets';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card card-success card-outline">
    <div class="card-body">
        <h5>Instructions</h5>
        <ol>
            <?php
            if (User::userIsAllowedTo('Review timesheets')) {
                echo '<li>You can approve time sheets marked with status  
                <span class="badge badge-warning"><span class="fa fa-hourglass-half"></span> Pending approval</span>
                and approve the time sheet if its OK or Send it back for more information.
            </li>
             <li>Click the icon
                <span class="badge badge-primary"><span class="fa fa-eye fa-1x"></span></span> 
                to view the full details and approve
            </li>';
            } else {
                echo '<li>Click the icon
                <span class="badge badge-primary"><span class="fa fa-eye fa-1x"></span></span> 
                to view the full details
            </li>';
            }
            ?>

        </ol>

        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                // 'id',
                [
                    'attribute' => 'province',
                    'filterType' => GridView::FILTER_SELECT2,
                    'filterWidgetOptions' => [
                        'pluginOptions' => ['allowClear' => true],
                    ],
                    'filter' => true,
                    'filter' => \backend\models\Provinces::getProvinceList(),
                    'filterInputOptions' => ['prompt' => 'Filter by Province', 'class' => 'form-control', 'id' => null],
                    'value' => function ($model) {
                        //$province_id = backend\models\Districts::findOne($model->district_id)->province_id;
                        $name = !empty($model->province) ? backend\models\Provinces::findOne($model->province)->name : "";
                        return $name;
                    },
                ],
                [
                    'attribute' => 'district',
                    'filterType' => GridView::FILTER_SELECT2,
                    'filterWidgetOptions' => [
                        'pluginOptions' => ['allowClear' => true],
                    ],
                    'filter' => \backend\models\Districts::getList(),
                    'filterInputOptions' => ['prompt' => 'Filter by District', 'class' => 'form-control', 'id' => null],
                    'value' => function ($model) {
                        $name = !empty($model->district) ? backend\models\Districts::findOne($model->district)->name : "";
                        return $name;
                    },
                ],
                [
                    'label' => 'Submitted by',
                    'value' => function($model) {
                        $user = \backend\models\User::findOne(['id' => $model->created_by]);
                        return !empty($user) ? $user->first_name . " " . $user->other_name . " " . $user->last_name : "";
                    }
                ],
                [
                    'attribute' => 'month',
                    'filter' => false,
                    'format' => 'raw',
                    'label' => 'Period',
                    'value' => function($model) {
                        return $model->month . "-" . $model->year;
                    },
                ],
                /*[
                    'attribute' => 'designation',
                    'filter' => false,
                    'format' => 'raw',
                ],*/
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
                  ], */
                /* [
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
                ], */
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
                        TimeSheetsDistrictStaff::_status_pending_approval => 'Pending approval'
                    ],
                    'filterInputOptions' => ['prompt' => 'Filter by Status', 'class' => 'form-control', 'id' => null],
                    'format' => 'raw',
                    'value' => function($model) {
                        $str = "";
                        if ($model->status == TimeSheetsDistrictStaff::_accepted) {
                            $str = "<p class='badge badge-success'> "
                                    . "<i class='fa fa-check'></i> Approved</p><br>";
                        } else {
                            $str = "<p class='badge badge-warning'> "
                                    . "<i class='fa fa-hourglass-half'></i> Pending approval</p><br>";
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
                    'options' => ['style' => 'width:50px;'],
                    'template' => '{view}',
                    'buttons' => [
                        'view' => function ($url, $model) {
                            return Html::a(
                                            '<span class="fa fa-eye"></span>', ['time-sheet-view', 'id' => $model->id], [
                                        'title' => 'View full details',
                                        'data-toggle' => 'tooltip',
                                        'data-placement' => 'top',
                                        'data-pjax' => '0',
                                        'style' => "padding:10px;",
                                        'class' => 'bt btn-lg'
                                            ]
                            );
                        },
                    ]
                ],
            ],
        ]);
        ?>


    </div>
</div>
