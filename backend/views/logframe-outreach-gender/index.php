<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\grid\ActionColumn;
use backend\models\User;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\LogframeOutreachPersonsGenderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Logframe / Outreach persons gender';
$this->params['breadcrumbs'][] = $this->title;
$Baseline_females = 0;
$Baseline_males = 0;
$mid_target_males = 0;
$mid_target_females = 0;
$end_target_males = 0;
$end_target_females = 0;
$females_programme_targets_model = \backend\models\LogframeProgrammeTargets::findOne(['record_type' => "Females - Number", 'indicator' => "Persons receiving services promoted or supported by the project"]);
$males_programme_targets_model = \backend\models\LogframeProgrammeTargets::findOne(['record_type' => "Males - Number", 'indicator' => "Persons receiving services promoted or supported by the project"]);
if (!empty($females_programme_targets_model)) {
    $Baseline_females = $females_programme_targets_model->baseline;
    $mid_target_males = $females_programme_targets_model->mid_term;
    $end_target_males = $females_programme_targets_model->end_target;
}
if (!empty($males_programme_targets_model)) {
    $Baseline_males = $males_programme_targets_model->baseline;
    $mid_target_females = $males_programme_targets_model->mid_term;
    $end_target_females = $males_programme_targets_model->end_target;
}
?>
<div class="card card-success card-outline">
    <div class="card-body">
        <p>
        <ol>
            <li><label>Indicator:</label>  Persons receiving services promoted or supported by the project</li>
            <li>
                Log framework Programme target - Females number
                <ul>
                    <?php
                    echo '<strong>Baseline: </strong>' . $Baseline_females . ', <strong>Mid-term: </strong>' . $mid_target_females . ", <strong>End target: </strong>" . $end_target_females;
                    ?>
                </ul>
            </li>
            <li>
                Log framework Programme target - Males number
                <ul>
                    <?php
                    echo '<strong>Baseline: </strong>' . $Baseline_males . ', <strong>Mid-term: </strong>' . $mid_target_males . ", <strong>End target: </strong>" . $end_target_males;
                    ?>
                </ul>
            </li>
        </ol>

        <hr class="dotted"/>
        </p>

        <?php
        if (User::userIsAllowedTo('Submit logframe data')) {
            echo Html::a('<i class="fa fa-plus"></i> '
                    . '<span class="text-xs">Submit record</span>', ['create'], ['class' => 'btn btn-success btn-xs']);
            echo '<hr class="dotted short">';
        }
        $gridColumns = [
            ['class' => 'yii\grid\SerialColumn'],
            // 'id',
            [
                'attribute' => 'year',
                'options' => ['style' => 'width:80px;'],
                'filterType' => GridView::FILTER_SELECT2,
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true,
                    ],
                ],
                'filter' => \backend\models\CommodityPriceCollection::getYearsList(),
                'filterInputOptions' => ['prompt' => 'Filter by year', 'class' => 'form-control', 'id' => null],
            ],
//            [
//                'attribute' => 'indicator',
//                'filter' => false,
//                'format' => 'raw',
//            ],
            [
                'attribute' => 'yr_target',
                'filter' => false,
                'format' => 'raw',
            ],
            [
                'attribute' => 'yr_results',
                'filter' => false,
                'format' => 'raw',
            ],
            [
                //'class' => EditableColumn::className(),
                'enableSorting' => true,
                'attribute' => 'gender',
                'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filter' => ['females' => "Females", "males" => "Males"],
                'filterInputOptions' => ['prompt' => 'Filter by gender', 'class' => 'form-control',],
                'format' => 'raw',
            ],
            [
                'attribute' => 'cumulative',
                'filter' => false,
                'format' => 'raw',
            ],
            [
                'attribute' => 'cumulative_percentage',
                'filter' => false,
                'format' => 'raw',
            ],
            //'created_at',
            //'updated_at',
            //'created_by',
            //'updated_by',
            ['class' => ActionColumn::className(),
                'options' => ['style' => 'width:130px;'],
                'template' => '{view}{update}{delete}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a(
                                        '<span class="fa fa-eye"></span>', ['view', 'id' => $model->id], [
                                    'title' => 'View record',
                                    'data-toggle' => 'tooltip',
                                    'data-placement' => 'top',
                                    'data-pjax' => '0',
                                    'style' => "padding:5px;",
                                    'class' => 'bt btn-lg'
                                        ]
                        );
                    },
                    'update' => function ($url, $model) {
                        if (User::userIsAllowedTo('Submit logframe data')) {
                            return Html::a(
                                            '<span class="fas fa-edit"></span>', ['update', 'id' => $model->id], [
                                        'title' => 'Update record',
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
                        if (User::userIsAllowedTo('Submit logframe data')) {
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
        ];
        $gridColumns1 = [
            ['class' => 'yii\grid\SerialColumn'],
            // 'id',
            [
                'attribute' => 'year',
                'options' => ['style' => 'width:80px;'],
                'filterType' => GridView::FILTER_SELECT2,
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true,
                    ],
                ],
                'filter' => \backend\models\CommodityPriceCollection::getYearsList(),
                'filterInputOptions' => ['prompt' => 'Filter by year', 'class' => 'form-control', 'id' => null],
            ],
            [
                'attribute' => 'indicator',
                'filter' => false,
                'format' => 'raw',
            ],
            [
                'label' => 'baseline',
                'filter' => false,
                'format' => 'raw',
                'value' => function($model) use ($females_programme_targets_model, $males_programme_targets_model) {

                    if ($model->gender == "females") {
                        return !empty($females_programme_targets_model) ? $females_programme_targets_model->baseline : "";
                    } else {
                        return !empty($males_programme_targets_model) ? $males_programme_targets_model->baseline : "";
                    }
                }
            ],
            [
                'label' => 'mid_term',
                'filter' => false,
                'format' => 'raw',
                'value' => function($model) use ($females_programme_targets_model, $males_programme_targets_model) {
                    if ($model->gender == "females") {
                        return !empty($females_programme_targets_model) ? $females_programme_targets_model->mid_term : "";
                    } else {
                        return !empty($males_programme_targets_model) ? $males_programme_targets_model->mid_term : "";
                    }
                }
            ],
            [
                'label' => 'end_target',
                'filter' => false,
                'format' => 'raw',
                'value' => function($model) use ($females_programme_targets_model, $males_programme_targets_model) {
                    if ($model->gender == "females") {
                        return !empty($females_programme_targets_model) ? $females_programme_targets_model->end_target : "";
                    } else {
                        return !empty($males_programme_targets_model) ? $males_programme_targets_model->end_target : "";
                    }
                }
            ],
            [
                'attribute' => 'yr_target',
                'filter' => false,
                'format' => 'raw',
            ],
            [
                'attribute' => 'yr_results',
                'filter' => false,
                'format' => 'raw',
            ],
            [
                'enableSorting' => true,
                'attribute' => 'gender',
                'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filter' => ['females' => "Females", "male" => "Males"],
                'filterInputOptions' => ['prompt' => 'Filter by gender', 'class' => 'form-control',],
                'format' => 'raw',
            ],
            [
                'attribute' => 'cumulative',
                'filter' => false,
                'format' => 'raw',
            ],
            [
                'attribute' => 'cumulative_percentage',
                'filter' => false,
                'format' => 'raw',
            ],
            [
                'label' => 'Created by',
                'value' => function($model) {
                    $user = \backend\models\User::findOne(['id' => $model->created_by]);
                    return !empty($user) ? $user->email : "";
                }
            ],
            [
                'label' => 'Updated by',
                'value' => function($model) {
                    $user = \backend\models\User::findOne(['id' => $model->updated_by]);
                    return !empty($user) ? $user->email : "";
                }
            ],
            [
                'label' => 'Updated at',
                'value' => function($model) {
                    return date('d F Y H:i:s', $model->updated_at);
                }
            ],
            [
                'label' => 'Created at',
                'value' => function($model) {
                    return date('d F Y H:i:s', $model->created_at);
                }
            ],
        ];

        $fullExportMenu = "";
        if (!empty($dataProvider) && $dataProvider->getCount() > 0) {

            $fullExportMenu = ExportMenu::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => $gridColumns1,
                        'columnSelectorOptions' => [
                            'label' => 'Cols...',
                            'class' => 'btn btn-outline-success btn-sm',
                        ],
                        'batchSize' => 400,
                        'exportConfig' => [
                            ExportMenu::FORMAT_TEXT => false,
                            ExportMenu::FORMAT_HTML => false,
                            ExportMenu::FORMAT_EXCEL => false,
                            ExportMenu::FORMAT_PDF => false,
                            ExportMenu::FORMAT_CSV => false,
                        ],
                        'target' => ExportMenu::TARGET_BLANK,
                        'pjaxContainerId' => 'kv-pjax-container',
                        'exportContainer' => [
                            'class' => 'btn-group mr-2'
                        ],
                        'filename' => 'logframe_outreach_persons_receiving_services',
                        'dropdownOptions' => [
                            'label' => 'Export to excel',
                            'class' => 'btn btn-outline-success btn-sm',
                            'itemsBefore' => [
                                '<div class="dropdown-header">Export All Data</div>',
                            ],
                        ],
            ]);
        }
        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => $gridColumns,
            'condensed' => true,
            'responsive' => true,
            'hover' => true,
            // 'pjax' => true,
            'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container']],
            'panel' => [
                'type' => GridView::TYPE_DEFAULT,
            // 'heading' => '<h3 class="panel-title"><i class="fas fa-book"></i> Library</h3>',
            ],
            // set a label for default menu
            'export' => false,
            'exportContainer' => [
                'class' => 'btn-group mr-2'
            ],
            // your toolbar can include the additional full export menu
            'toolbar' => [
                '{export}',
                $fullExportMenu,
            ]
        ]);
        ?>
    </div>
</div>
