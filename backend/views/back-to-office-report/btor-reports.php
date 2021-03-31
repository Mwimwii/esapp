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

$this->title = 'BtOR reports';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card card-success card-outline">
    <div class="card-body">
        <h5>Instructions</h5>
        <ol>
            <?php
            if (User::userIsAllowedTo('Review back to office report')) {
                echo '<li>You can review BtOR reports marked with status  
                <span class="badge badge-info"><span class="fa fa-hourglass-half"></span> Pending review</span>
                and accept the report if its OK or Send it back for more information.
            </li>
             <li>Click the icon
                <span class="badge badge-primary"><span class="fa fa-eye fa-1x"></span></span> 
                to view/review the full report details
            </li>';
            } else {
                echo '<li>Click the icon
                <span class="badge badge-primary"><span class="fa fa-eye fa-1x"></span></span> 
                to view the full report details
            </li>';
            }
            ?>

        </ol>
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
                    'filter' => [Storyofchange::_accepted => 'Accepted', Storyofchange::_submitted_for_review => 'Pending review'],
                    'filterInputOptions' => ['prompt' => 'Filter by Status', 'class' => 'form-control', 'id' => null],
                    'format' => 'raw',
                    'value' => function($model) {
                        $str = "";
                        if ($model->status == Storyofchange::_accepted) {
                            $str = "<p style='margin:2px;padding:2px;display:inline-block;' class='badge badge-success'> "
                                    . "<i class='fa fa-check'></i> Accepted</p><br>";
                        } else {
                            $str = "<p style='margin:2px;padding:2px;display:inline-block;' class='badge badge-info'> "
                                    . "<i class='fa fa-hourglass-half'></i> Pending review</p><br>";
                        }
                        return $str;
                    },
                ],
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
                                            '<span class="fa fa-eye"></span>', ['btor-report-view', 'id' => $model->id], [
                                        'title' => 'View full report details',
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
