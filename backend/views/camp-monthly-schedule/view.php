<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;
use yii\data\ActiveDataProvider;
use backend\models\User;
use kartik\form\ActiveForm;
use yii\grid\ActionColumn;
use kartik\touchspin\TouchSpin;
use ivankff\yii2ModalAjax\ModalAjax;

$read_only = true;

/* @var $this yii\web\View */
/* @var $model backend\models\MeCampSubprojectRecordsPlannedWorkEffort */

$this->title = backend\models\Camps::findOne($model->camp_id)->name . " work schedule for " . DateTime::createFromFormat('!m', $model->month)->format('F');
$this->params['breadcrumbs'][] = ['label' => 'Camp monthly schedules', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="card card-success card-outline">
    <div class="card-body">
        <p>
        <h5>Instructions</h5>
        <ol>
            <li>Click the icon <span class="fa fa-edit"></span> to update the monthly work effort record
            </li>
            <li>Click the icon <span class="fa fa-trash"></span> to delete the monthly work effort record and its associated activities
            </li>

        </ol>
        <hr class="dotted">
        </p>

        <div class="row">
            <div class="col-lg-12">
                <div class="card-header">
                    <h3 class="card-title">Planned <?= DateTime::createFromFormat('!m', $model->month)->format('F') ?> work effort</h3>

                    <div class="card-tools">

                        <?php
                        if ($model->month == date('n')) {
                            $read_only = false;
                            echo Html::a(
                                    '<span class="fa fa-edit"></span>', ['update', 'id' => $model->id], [
                                'title' => 'Edit monthly work effort',
                                'data-toggle' => 'tooltip',
                                'data-placement' => 'top',
                                'data-pjax' => '0',
                                'style' => "padding:10px;",
                                'class' => 'bt btn-lg'
                                    ]
                            );
                        }
                        if (User::userIsAllowedTo('Remove planned camp monthly activities') && $model->month == date('n')) {
                            echo Html::a(
                                    '<span class="fa fa-trash"></span>', ['delete', 'id' => $model->id], [
                                'title' => 'Remove monthly activity records',
                                'data-toggle' => 'tooltip',
                                'data-placement' => 'top',
                                'data' => [
                                    'confirm' => 'Are you sure you want to remove this monthly camp schedule?<br>'
                                    . 'This action will remove the planned work effort and all activities for the month',
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

                    </div>
                </div>

                <?=
                DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        [
                            'attribute' => 'year',
                        ],
                        [
                            'attribute' => 'month',
                            "value" => function ($model) {
                                return DateTime::createFromFormat('!m', $model->month)->format('F');
                            }
                        ],
                        'days_in_month',
                        [
                            'attribute' => 'camp_id',
                            'value' => function ($model) {
                                $name = backend\models\Camps::findOne($model->camp_id)->name;
                                return $name;
                            },
                        ],
                        [
                            'attribute' => 'days_office',
                            'filter' => false,
                        ],
                        [
                            'attribute' => 'days_field',
                            'filter' => false,
                        ],
                        [
                            'attribute' => 'days_total',
                            'filter' => false,
                        ],
                        [
                            'attribute' => 'days_other_non_esapp_activities',
                            'filter' => false,
                        ],
                    // 'created_at',
                    // 'updated_at',
                    //  'created_by',
                    // 'updated_by',
                    ],
                ])
                ?>

            </div>


            <div class="col-lg-12">
                <p>
                <h5>Instructions</h5>
                <ol>
                    <?php
                    
                    if (!empty(\backend\models\MeCampSubprojectRecordsMonthlyPlannedActivities::getActivityListByDistrictId1(Yii::$app->user->identity->district_id, $model->year, $model->id, $model->month))) {
                        echo '<li>Click the button <span class="badge badge-success">Add Planned ' . DateTime::createFromFormat('!m', $model->month)->format('F') . ' activity</span> to add a planned activity for the month
                              </li>';
                    } else {
                        echo '<li>You have already added all activities that were approved in the AWPB for ' . DateTime::createFromFormat('!m', $model->month)->format('F') . '. If you want to make any changes, you can update the existing records below
                              </li>';
                    }
                    ?>


                    <li>Click the icon <span class="fa fa-edit"></span> to update the planned activity record
                    </li>
                    <li>Click the icon <span class="fa fa-trash"></span> to delete the monthly work effort record and its associative activities
                    </li>
                    <li>Click the icon <span class="fas fa-bullseye"></span> next to the activity line in the table below to submit actual achieved this month for the activity. 
                        If you have already submitted actuals/achieved, the icon wont be visible. You have to edit/remove the submitted actuals record before adding a new record
                    </li>

                </ol>
                <hr class="dotted">
                </p>
                <div class="card-header">
                    <h3 class="card-title">
                        Planned <?= DateTime::createFromFormat('!m', $model->month)->format('F') ?> activities
                    </h3>

                    <div class="card-tools">
                        <?php
                        if (User::userIsAllowedTo('Plan camp monthly activities') && !empty(\backend\models\MeCampSubprojectRecordsMonthlyPlannedActivities::getActivityListByDistrictId1(Yii::$app->user->identity->district_id, $model->year, $model->id, $model->month))) {
                            echo '<button class="btn btn-success btn-sm" href="#" onclick="$(\'#addNewModal\').modal(); 
                            return false;"><i class="fa fa-plus"></i> Add Planned ' . DateTime::createFromFormat('!m', $model->month)->format('F') . ' activity</button>';
                        }
                        ?>
                    </div>
                </div>

                <?php
                $model_activities = \backend\models\MeCampSubprojectRecordsMonthlyPlannedActivities::find()
                        ->where(['work_effort_id' => $model->id]);

                $_dataProvider = new ActiveDataProvider([
                    'query' => $model_activities,
                ]);
                $_dataProvider->setSort([
                    'attributes' => [
                        'created_at' => [
                            'desc' => ['created_at' => SORT_DESC],
                            'default' => SORT_DESC
                        ],
                    ],
                    'defaultOrder' => [
                        'created_at' => SORT_DESC
                    ]
                ]);

                echo GridView::widget([
                    'dataProvider' => $_dataProvider,
                    'condensed' => true,
                    'responsive' => true,
                    'beforeHeader' => [
                        [
                            'columns' => [
                                ['content' => DateTime::createFromFormat('!m', $model->month)->format('F') . ' Planned Activity', 'options' => ['colspan' => 2, 'class' => 'text-center warning']],
                                ['content' => 'FaaBS', 'options' => ['colspan' => 1, 'class' => 'text-center warning']],
                                ['content' => DateTime::createFromFormat('!m', $model->month)->format('F') . ' Beneficiary Target', 'options' => ['colspan' => 4, 'class' => 'text-center warning']],
                                ['content' => 'Action', 'options' => ['colspan' => 1, 'class' => 'text-center warning']],
                            ],
                        ]
                    ],
                    'columns' => [
                        //['class' => 'yii\grid\SerialColumn'],
                        // 'id',
                        [
                            // 'class' => EditableColumn::className(),
                            'contentOptions' => ['class' => 'text-left'],
                            'headerOptions' => ['class' => 'text-center', 'style' => 'font-size:14px;font-weight:normal'],
                            'attribute' => 'activity_id',
                            //'readonly' => false,
                            'options' => ['style' => 'width:200px;'],
                            "value" => function ($model) {
                                $_model = backend\models\AwpbActivityLine::findOne($model->activity_id);
                                return !empty($_model) ? $_model->name : "";
                            }
                        ],
                        [
                            'headerOptions' => ['class' => 'text-center', 'style' => 'font-size:14px;font-weight:normal'],
                            'enableSorting' => false,
                            'attribute' => 'activity_target',
                            'filter' => false,
                            'label' => " Activity Target",
                        ],
                        [
                            // 'class' => EditableColumn::className(),
                            'contentOptions' => ['class' => 'text-left'],
                            'headerOptions' => ['class' => 'text-center', 'style' => 'font-size:14px;font-weight:normal'],
                            'attribute' => 'faabs_id',
                            "value" => function ($model) {
                                $faabs_model = backend\models\MeFaabsGroups::findOne($model->faabs_id);
                                return !empty($faabs_model) ? $faabs_model->name : "";
                            }
                        ],
                        /* [
                          'attribute' => 'zone',
                          ], */
                        [
                            'headerOptions' => ['class' => 'text-center', 'style' => 'font-size:14px;font-weight:normal'],
                            'enableSorting' => false,
                            'attribute' => 'beneficiary_target_women',
                            'filter' => false,
                        ],
                        [
                            'headerOptions' => ['class' => 'text-center', 'style' => 'font-size:14px;font-weight:normal'],
                            'enableSorting' => false,
                            'attribute' => 'beneficiary_target_youth',
                            'filter' => false,
                        ],
                        [
                            'headerOptions' => ['class' => 'text-center', 'style' => 'font-size:14px;font-weight:normal'],
                            'enableSorting' => false,
                            'attribute' => 'beneficiary_target_women_headed',
                            'filter' => false,
                        ],
                        [
                            'headerOptions' => ['class' => 'text-center', 'style' => 'font-size:14px;font-weight:normal'],
                            'enableSorting' => false,
                            'attribute' => 'beneficiary_target_total',
                            'filter' => false,
                        ],
                        //'days_in_month',
                        //'created_at',
                        //'updated_at',
                        //'created_by',
                        //'updated_by',
                        ['class' => ActionColumn::className(),
                            'template' => '{update}&nbsp;{addactual}&nbsp;{delete}',
                            'buttons' => [
                                'update' => function ($url, $_model) use ($model) {
                                    if (User::userIsAllowedTo('Plan camp monthly activities') && $model->month == date('n')) {
                                        return ModalAjax::widget([
                                                    'header' => 'Update planned activity details',
                                                    'bootstrapVersion' => ModalAjax::BOOTSTRAP_VERSION_4,
                                                    'toggleButton' => [
                                                        'label' => '<span class="fa fa-edit"></span>',
                                                        //'class' => 'bt btn-lg',
                                                        'class' => "mb-xs mt-xs mr-xs btn btn-xs btn-default",
                                                        'title' => 'Update planned activity',
                                                    ],
                                                    'id' => "update_act_" . $_model->id,
                                                    'size' => 'modal-lg',
                                                    'options' => ['class' => 'header-default'],
                                                    'url' => \yii\helpers\Url::to(['/camp-monthly-schedule/update-activity', 'id' => $_model->id,
                                                        'source_id' => $model->id]),
                                                    'ajaxSubmit' => true, // Submit the contained form as ajax, true by default
                                                    'autoClose' => true,
                                        ]);
                                    }
                                },
                                'addactual' => function ($url, $_model) use($model) {
                                    if (User::userIsAllowedTo('Plan camp monthly activities') &&
                                            empty(\backend\models\MeCampSubprojectRecordsMonthlyPlannedActivitiesActual::findOne(['planned_activity_id' => $_model->id]))) {
                                        return ModalAjax::widget([
                                                    'header' => DateTime::createFromFormat('!m', backend\models\MeCampSubprojectRecordsPlannedWorkEffort::findOne($_model->work_effort_id)->month)->format('F') . ' activity targets actual/achieved',
                                                    'bootstrapVersion' => ModalAjax::BOOTSTRAP_VERSION_4,
                                                    'toggleButton' => [
                                                        'label' => '<span class="fa fa-bullseye"></span>',
                                                        'class' => "mb-xs mt-xs mr-xs btn btn-xs btn-default",
                                                        'title' => "Add actual/achieved targets",
                                                    ],
                                                    'size' => "modal-lg",
                                                    'id' => 'achieved_' . $_model->id,
                                                    'url' => \yii\helpers\Url::to(['/camp-monthly-schedule/achieved-monthly-modal', 'id' => $_model->id,
                                                        'source_id' => $model->id]),
                                                    'ajaxSubmit' => true,
                                                    'autoClose' => true,
                                        ]);
                                    }
                                },
                                'delete' => function ($url, $_model) use($model) {
                                    if (User::userIsAllowedTo('Remove planned camp monthly activities') && $model->month == date('n')) {
                                        return Html::a('<span class="fa fa-trash"></span>', ['delete-activity', 'id' => $_model->id, 'id1' => $model->id], [
                                                    'title' => 'Delete record',
                                                    'data-toggle' => 'tooltip',
                                                    'data-placement' => 'top',
                                                    'data' => [
                                                        'confirm' => 'Are you sure you want to delete this planned monthly activity?'
                                                        . '<br>Submitted actual/achieved targets will be removed aswell',
                                                        'method' => 'post',
                                                    ],
                                                    'style' => "padding:5px;",
                                                    'class' => 'bt btn-lg'
                                        ]);
                                    }
                                },
                            ],
                        ],
                    ],
                ]);
                ?>
            </div>

            <div class="col-lg-12">
                <p>
                <h5>Instructions</h5>
                <ol>
                    <li>Click the icon <span class="fa fa-edit"></span> to update the submitted achieved/actual activity target record
                    </li>
                    <li>Click the icon <span class="fa fa-trash"></span> to delete the submitted achieved/actual activity target record
                    </li>
                </ol>
                <hr class="dotted">
                </p>
                <div class="card-header">
                    <h3 class="card-title">
                        Actual/Achieved planned activity targets for <?= DateTime::createFromFormat('!m', $model->month)->format('F') ?>
                    </h3>
                </div>

                <?php
                $actual_array = [];
                if (!empty($model_activities->all())) {
                    foreach ($model_activities->all() as $Model) {
                        array_push($actual_array, $Model['id']);
                    }
                }

                $_dataProvider_actual_targets = new ActiveDataProvider([
                    'query' => \backend\models\MeCampSubprojectRecordsMonthlyPlannedActivitiesActual::find()
                            ->where(['IN', 'planned_activity_id', $actual_array]),
                ]);

                $_dataProvider_actual_targets->setSort([
                    'attributes' => [
                        'created_at' => [
                            'desc' => ['created_at' => SORT_DESC],
                            'default' => SORT_DESC
                        ],
                    ],
                    'defaultOrder' => [
                        'created_at' => SORT_DESC
                    ]
                ]);
                echo GridView::widget([
                    'dataProvider' => $_dataProvider_actual_targets,
                    'condensed' => true,
                    'responsive' => true,
                    'beforeHeader' => [
                        [
                            'columns' => [
                                ['content' => 'Activity', 'options' => ['colspan' => 2, 'class' => 'text-center warning']],
                                ['content' => 'FaaBS', 'options' => ['colspan' => 1, 'class' => 'text-center warning']],
                                ['content' => 'Hours worked', 'options' => ['colspan' => 3, 'class' => 'text-center warning']],
                                ['content' => DateTime::createFromFormat('!m', $model->month)->format('F') . ' Beneficiary Target-Achieved', 'options' => ['colspan' => 4, 'class' => 'text-center warning']],
                                ['content' => 'Remarks', 'options' => ['colspan' => 1, 'class' => 'text-center warning']],
                                ['content' => 'Action', 'options' => ['colspan' => 1, 'class' => 'text-center warning']],
                            ],
                        ]
                    ],
                    'columns' => [
                        //['class' => 'yii\grid\SerialColumn'],
                        // 'id',
                        [
                            'enableSorting' => false,
                            'contentOptions' => ['class' => 'text-left'],
                            'headerOptions' => ['class' => 'text-center', 'style' => 'font-size:14px;font-weight:normal'],
                            'attribute' => 'planned_activity_id',
                            'label' => 'Activity',
                            //'readonly' => false,
                            'options' => ['style' => 'width:200px;'],
                            "value" => function ($model) {
                                $Model = backend\models\MeCampSubprojectRecordsMonthlyPlannedActivities::findOne($model->planned_activity_id);
                                $_model = backend\models\AwpbActivityLine::findOne($Model->activity_id);
                                return !empty($_model) ? $_model->name : "";
                            }
                        ],
                        [
                            'contentOptions' => ['class' => 'text-left'],
                            'headerOptions' => ['class' => 'text-center', 'style' => 'font-size:14px;font-weight:normal'],
                            'enableSorting' => false,
                            'label' => DateTime::createFromFormat('!m', $model->month)->format('F') . " Achieved target",
                            'attribute' => 'achieved_activity_target',
                        ],
                        [
                            'contentOptions' => ['class' => 'text-left'],
                            'headerOptions' => ['class' => 'text-center', 'style' => 'font-size:14px;font-weight:normal'],
                            'attribute' => 'faabs_id',
                            'label' => 'FaaBS',
                            "value" => function ($model) {
                                $planned_model = backend\models\MeCampSubprojectRecordsMonthlyPlannedActivities::findOne($model->planned_activity_id);
                                $faabs_model = !empty($planned_model) ? backend\models\MeFaabsGroups::findOne($planned_model->faabs_id) : "";
                                return !empty($faabs_model) ? $faabs_model->name : "";
                            }
                        ],
                        [
                            'enableSorting' => false,
                            'contentOptions' => ['class' => 'text-left'],
                            'headerOptions' => ['class' => 'text-center', 'style' => 'font-size:14px;font-weight:normal'],
                            'label' => 'field',
                            'attribute' => 'hours_worked_field',
                        ],
                        [
                            'enableSorting' => false,
                            'contentOptions' => ['class' => 'text-left'],
                            'headerOptions' => ['class' => 'text-center', 'style' => 'font-size:14px;font-weight:normal'],
                            'label' => 'office',
                            'attribute' => 'hours_worked_office',
                        ],
                        [
                            'enableSorting' => false,
                            'contentOptions' => ['class' => 'text-left'],
                            'headerOptions' => ['class' => 'text-center', 'style' => 'font-size:14px;font-weight:normal'],
                            'label' => 'total',
                            'attribute' => 'hours_worked_total',
                        ],
                        [
                            // 'class' => EditableColumn::className(),
                            'contentOptions' => ['class' => 'text-left'],
                            'headerOptions' => ['class' => 'text-center', 'style' => 'font-size:14px;font-weight:normal'],
                            'enableSorting' => false,
                            'label' => 'Women',
                            'attribute' => 'beneficiary_target_achieved_women',
                            'filter' => false,
                        ],
                        [
                            // 'class' => EditableColumn::className(),
                            'contentOptions' => ['class' => 'text-left'],
                            'headerOptions' => ['class' => 'text-center', 'style' => 'font-size:14px;font-weight:normal'],
                            'enableSorting' => false,
                            'label' => 'Youth',
                            'attribute' => 'beneficiary_target_achieved_youth',
                            'filter' => false,
                        ],
                        [
                            // 'class' => EditableColumn::className(),
                            'contentOptions' => ['class' => 'text-left'],
                            'headerOptions' => ['class' => 'text-center', 'style' => 'font-size:14px;font-weight:normal'],
                            'enableSorting' => false,
                            'label' => 'Women headed',
                            'attribute' => 'beneficiary_target_achieved_women_headed',
                            'filter' => false,
                        ],
                        [
                            'contentOptions' => ['class' => 'text-left'],
                            'headerOptions' => ['class' => 'text-center', 'style' => 'font-size:14px;font-weight:normal'],
                            'enableSorting' => false,
                            'label' => 'Total',
                            'attribute' => 'beneficiary_target_achieved_total',
                            'filter' => false,
                        ],
                        [
                            'contentOptions' => ['class' => 'text-left'],
                            'headerOptions' => ['class' => 'text-center', 'style' => 'font-size:14px;font-weight:normal'],
                            'enableSorting' => false,
                            'label' => false,
                            'attribute' => 'remarks',
                            'filter' => false,
                        ],
                        //'days_in_month',
                        //'created_at',
                        //'updated_at',
                        //'created_by',
                        //'updated_by',
                        ['class' => ActionColumn::className(),
                            'template' => '{update}&nbsp;{delete}',
                            'buttons' => [
                                'update' => function ($url, $_model) use ($model) {
                                    if (User::userIsAllowedTo('Plan camp monthly activities') && $model->month == date('n')) {
                                        return ModalAjax::widget([
                                                    'header' => 'Update submitted achieve/actual activity target details',
                                                    'bootstrapVersion' => ModalAjax::BOOTSTRAP_VERSION_4,
                                                    'toggleButton' => [
                                                        'label' => '<span class="fa fa-edit"></span>',
                                                        //'class' => 'bt btn-lg',
                                                        'class' => "mb-xs mt-xs mr-xs btn btn-xs btn-default",
                                                        'title' => 'Update achieved activity target',
                                                    ],
                                                    'id' => "update_" . $_model->id,
                                                    'size' => 'modal-lg',
                                                    'options' => ['class' => 'header-default'],
                                                    'url' => \yii\helpers\Url::to(['/camp-monthly-schedule/update-achieved-target', 'id' => $_model->id,
                                                        'source_id' => $model->id]),
                                                    'ajaxSubmit' => true, // Submit the contained form as ajax, true by default
                                                    'autoClose' => true,
                                        ]);
                                    }
                                },
                                'delete' => function ($url, $_model) use($model) {
                                    if (User::userIsAllowedTo('Remove planned camp monthly activities') && $model->month == date('n')) {
                                        return Html::a('<span class="fa fa-trash"></span>', ['delete-achieved-activity-target', 'id' => $_model->id, 'id1' => $model->id], [
                                                    'title' => 'Delete achieved target',
                                                    'data-toggle' => 'tooltip',
                                                    'data-placement' => 'top',
                                                    'data' => [
                                                        'confirm' => 'Are you sure you want to delete this submitted achieved monthly activity target?',
                                                        'method' => 'post',
                                                    ],
                                                    'style' => "padding:5px;",
                                                    'class' => 'bt btn-lg'
                                        ]);
                                    }
                                },
                            ],
                        ],
                    ],
                ]);
                ?>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="addNewModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content card-success card-outline">
            <div class="modal-header">
                <h5 class="modal-title">Add <?= DateTime::createFromFormat('!m', $model->month)->format('F') ?> Planned activity</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                $_model = new backend\models\MeCampSubprojectRecordsMonthlyPlannedActivities();
                $form = ActiveForm::begin([
                            'action' => 'add-activity?work_effort_id=' . $work_effort_id,
                        ])
                ?>
                <div class="row">
                    <div class="col-lg-6">
                        <?php
                        echo
                                $form->field($_model, 'activity_id')
                                ->dropDownList(
                                        \backend\models\MeCampSubprojectRecordsMonthlyPlannedActivities::getActivityListByDistrictId1(Yii::$app->user->identity->district_id, $model->year, $model->id, $model->month),
                                        ['id' => 'activity', 'custom' => true, 'prompt' => 'Please select activity', 'required' => true]
                        );
                        ?>
                        <?php
                        echo
                                $form->field($_model, 'faabs_id')
                                ->dropDownList(
                                        \backend\models\MeFaabsGroups::getListByCampIds(), ['custom' => true, 'prompt' => 'Please select FaaBS', 'required' => true]
                        );
                        /* echo $form->field($_model, 'activity_target')->widget(TouchSpin::classname(), [
                          'options' => ['placeholder' => 'Activity target'],
                          'pluginOptions' => [
                          // 'initval' => 3.00,
                          'min' => 0,
                          // 'max' => 100,
                          ],
                          ]); */

                        /* echo $form->field($_model, 'beneficiary_target_women')->widget(TouchSpin::classname(), [
                          'options' => ['placeholder' => 'Beneficiary target women'],
                          'pluginOptions' => [
                          // 'initval' => 3.00,
                          'min' => 0,
                          //  'max' => 100,
                          // 'step' => 0.1,
                          // 'decimals' => 2,
                          // 'boostat' => 5,
                          // 'maxboostedstep' => 10,
                          // 'prefix' => '$',
                          ],
                          ]);
                          /* echo $form->field($_model, 'beneficiary_target_women', ['enableAjaxValidation' => true])->widget(NumberControl::classname(), [
                          'maskedInputOptions' => [
                          // 'prefix' => '$ ',
                          'suffix' => '',
                          'allowMinus' => false,
                          'min' => 0,
                          'max' => 10
                          ],
                          ]);
                          echo $form->field($_model, 'beneficiary_target_youth')->widget(TouchSpin::classname(), [
                          'options' => ['placeholder' => 'Beneficiary target youth'],
                          'pluginOptions' => [
                          // 'initval' => 3.00,
                          'min' => 0,
                          // 'max' => 100,
                          ],
                          ]);

                          echo $form->field($_model, 'beneficiary_target_women_headed')->widget(TouchSpin::classname(), [
                          'options' => ['placeholder' => 'Beneficiary target women headed'],
                          'pluginOptions' => [
                          // 'initval' => 3.00,
                          'min' => 0,
                          //'max' => 100,
                          ],
                          ]); */
                        ?>

                    </div>
                    <div class="col-lg-6">
                        <h5>Instructions</h5>
                        <ol>
                            <li>Fields marked with <i style="color: red;">*</i> are required</span>
                            </li>
                            <li>You will only be able to add activities that were not planned for in the previous months
                            </li>
                            <li>You will only be able to add activities whose planned target for <code><?= DateTime::createFromFormat('!m', $model->month)->format('F') ?></code> was greater than or equal to <code>One</code>
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <?= Html::submitButton('Add activity', ['class' => 'btn btn-success btn-sm']) ?>
                </div>
                <?php ActiveForm::end() ?>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <?php
    $this->registerCss('.popover-x {display:none}');
    ?>
