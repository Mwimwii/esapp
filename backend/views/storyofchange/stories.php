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

$this->title = 'Stories of change';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card card-success card-outline">
    <div class="card-body">
        <h5>Instructions</h5>
        <ol>
            <li>You can review stories marked with status  
                <span class="badge badge-info"><span class="fa fa-hourglass-half"></span> Pending IKMO review</span>
                and accept the story if its OK or Send it back for changes.
            </li>
            <li>Click the icon
                <span class="badge badge-primary"><span class="fa fa-eye fa-2x"></span></span> 
                to view/review the story details
            </li>
        </ol>

        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                //'id',
                [
                    'attribute' => 'province_id',
                    'filterType' => GridView::FILTER_SELECT2,
                    'filterWidgetOptions' => [
                        'pluginOptions' => ['allowClear' => true],
                    ],
                    'filter' => true,
                    'filter' => \backend\models\Provinces::getProvinceList(),
                    'filterInputOptions' => ['prompt' => 'Filter by Province', 'class' => 'form-control', 'id' => null],
                    'value' => function ($model) {
                        //$province_id = backend\models\Districts::findOne($model->district_id)->province_id;
                        $name = !empty($model->province_id) ? backend\models\Provinces::findOne($model->province_id)->name : "";
                        return $name;
                    },
                ],
                [
                    'attribute' => 'district_id',
                    'filterType' => GridView::FILTER_SELECT2,
                    'filterWidgetOptions' => [
                        'pluginOptions' => ['allowClear' => true],
                    ],
                    'filter' => \backend\models\Districts::getList(),
                    'filterInputOptions' => ['prompt' => 'Filter by District', 'class' => 'form-control', 'id' => null],
                    'value' => function ($model) {
                        $name = !empty($model->district_id) ? backend\models\Districts::findOne($model->district_id)->name : "";
                        return $name;
                    },
                ],
                [
                    'attribute' => 'camp_id',
                    'filterType' => GridView::FILTER_SELECT2,
                    'filterWidgetOptions' => [
                        'pluginOptions' => ['allowClear' => true],
                    ],
                    'filter' => \backend\models\Camps::getList(),
                    'filterInputOptions' => ['prompt' => 'Filter by camp', 'class' => 'form-control', 'id' => null],
                    'value' => function ($model) {
                        $name = !empty($model->camp_id) ? backend\models\Camps::findOne($model->camp_id)->name : "";
                        return $name;
                    },
                ],
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
                    'filter' => [Storyofchange::_accepted => 'Accepted', Storyofchange::_submitted_for_review => 'Pending IKMO review'],
                    'filterInputOptions' => ['prompt' => 'Filter by Status', 'class' => 'form-control', 'id' => null],
                    'format' => 'raw',
                    'value' => function($model) {
                        $str = "";
                        if ($model->status == Storyofchange::_accepted) {
                            $str = "<p style='margin:2px;padding:2px;display:inline-block;' class='badge badge-success'> "
                                    . "<i class='fa fa-check'></i> Accepted</p><br>";
                        } else {
                            $str = "<p style='margin:2px;padding:2px;display:inline-block;' class='badge badge-info'> "
                                    . "<i class='fa fa-hourglass-half'></i> Pending IKMO review</p><br>";
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
                    'options' => ['style' => 'width:50px;'],
                    'template' => '{view}',
                    'buttons' => [
                        'view' => function ($url, $model) {
                            return Html::a(
                                            '<span class="fa fa-eye"></span>', ['story-view', 'id' => $model->id], [
                                        'title' => 'View story details',
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
<?php
$this->registerCss('.popover-x {display:none}');
?>
