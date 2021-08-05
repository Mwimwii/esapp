<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use backend\models\User;
use kartik\grid\GridView;
use kartik\form\ActiveForm;
use ivankff\yii2ModalAjax\ModalAjax;
use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\overlays\InfoWindow;
use dosamigos\google\maps\overlays\Marker;
use dosamigos\google\maps\Map;

/* @var $this yii\web\View */
/* @var $model backend\models\MeFaabsTrainingTopics */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'FaaBS Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$id = $model->id;
$max_topics = $model->max_farmer_graduation_training_topics;
$camp_name = backend\models\Camps::findOne($model->camp_id)->name;
$faabs_topic_model = new backend\models\MeFaabsTrainingTopicEnrolment();
$topic_count = backend\models\MeFaabsTrainingTopicEnrolment::find()
        ->where(['faabs_id' => $model->id])
        ->count();
$faabs_farmers = backend\models\MeFaabsCategoryAFarmers::find()
        ->where(['faabs_group_id' => $model->id])
        ->count();


$district_id = \backend\models\Camps::findOne($model->camp_id)->district_id;
$province_id = backend\models\Districts::findOne($district_id)->province_id;
$province = backend\models\Provinces::findOne($province_id)->name;
$district = backend\models\Districts::findOne($district_id)->name;
$faabs = backend\models\MeFaabsGroups::find()->where(['camp_id' => $model->id])->count();
?>
<div class="card card-success card-outline">
    <div class="card-body">

        <p>
            <?php
            if (User::userIsAllowedTo('Manage faabs groups')) {
                echo Html::a('<span class="fas fa-edit fa-2x"></span>', ['update', 'id' => $model->id], [
                    'title' => 'Update FaaBS group',
                    'data-toggle' => 'tooltip',
                    'data-placement' => 'top',
                ]);
                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                echo Html::a('<i class="fas fa-trash fa-2x"></i>', ['delete', 'id' => $model->id], [
                    'title' => 'Remove FaaBS group',
                    'data-placement' => 'top',
                    'data-toggle' => 'tooltip',
                    'data' => [
                        'confirm' => 'Are you sure you want to remove FaaBS group: ' . $model->name . '?<br>'
                        . 'Group will only be removed if its not being used by the system!',
                        'method' => 'post',
                    ],
                ]);
            }
            //This is a hack, just to use pjax for the delete confirm button
            $query = User::find()->where(['id' => '-2']);
            $dataProvider = new \yii\data\ActiveDataProvider([
                'query' => $query,
            ]);
            GridView::widget([
                'dataProvider' => $dataProvider,
            ]);
            ?>
        </p>


        <?php
        $attributes = "";
        if (!empty(Yii::$app->user->identity->district_id)) {
            $attributes = [
                [
                    'columns' => [
                        [
                            'attribute' => 'Name',
                            'label' => 'FaaBS Name',
                            'displayOnly' => true,
                            'labelColOptions' => ['style' => 'width:15%'],
                            'valueColOptions' => ['style' => 'width:20%'],
                            'value' => $model->name,
                        ],
                        [
                            'attribute' => 'camp_id',
                            'label' => 'Camp',
                            'displayOnly' => true,
                            'labelColOptions' => ['style' => 'width:15%'],
                            'valueColOptions' => ['style' => 'width:30%'],
                            'value' => $camp_name,
                        ],
                    ],
                ],
            ];
        } else {
            $attributes = [
                [
                    'columns' => [
                        [
                            'attribute' => 'Name',
                            'label' => 'FaaBS Name',
                            'displayOnly' => true,
                            'labelColOptions' => ['style' => 'width:15%'],
                            'valueColOptions' => ['style' => 'width:20%'],
                            'value' => $model->name,
                        ],
                        [
                            'attribute' => 'camp_id',
                            'label' => 'Camp',
                            'displayOnly' => true,
                            'labelColOptions' => ['style' => 'width:15%'],
                            'valueColOptions' => ['style' => 'width:30%'],
                            'value' => $camp_name,
                        ],
                    ],
                ],
                [
                    'columns' => [
                        [
                            //'attribute' => 'Name',
                            'label' => 'Province',
                            'displayOnly' => true,
                            'labelColOptions' => ['style' => 'width:15%'],
                            'valueColOptions' => ['style' => 'width:20%'],
                            'value' => $province,
                        ],
                        [
                            // 'attribute' => 'camp_id',
                            'label' => 'District',
                            'displayOnly' => true,
                            'labelColOptions' => ['style' => 'width:15%'],
                            'valueColOptions' => ['style' => 'width:30%'],
                            'value' => $district,
                        ],
                    ],
                ],
            ];
        }
        echo DetailView::widget([
            'model' => $model,
            'mode' => DetailView::MODE_VIEW,
            'striped' => true,
            'responsive' => true,
            'hover' => true,
            'hAlign' => DetailView::ALIGN_LEFT,
            'vAlign' => DetailView::ALIGN_MIDDLE,
            'attributes' => $attributes,
        ])
        ?>
        <hr class="dotted short">
        <div class="row">
            <div class="col-12 col-sm-12">
                <div class="card card-success card-outline card-tabs">
                    <div class="card-header p-0 pt-1 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">
                                    FaaBS location
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-three-topics-tab" data-toggle="pill" href="#custom-tabs-three-topics" role="tab" aria-controls="custom-tabs-three-topics" aria-selected="false">
                                    FaaBS training topics
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false">
                                    Farmer training progress
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-three-tabContent">
                            <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">

                                <?php
                                $coords = [];
                                $center_coords = [];
                                if (empty($model->latitude) && empty($model->longitude)) {
                                    echo "<div class='alert alert-warning'>There are no location coordinates for camp:" . $model->name . "</div>";
                                } else {
                                    $coord = new LatLng(['lat' => $model->latitude, 'lng' => $model->longitude]);
                                    //$center = round(count($coord) / 2);
                                    $center_coords = $coord;
                                }
                                if (empty($coord)) {
                                    $coord = new LatLng([
                                        'lat' => Yii::$app->params['center_lat'],
                                        'lng' => Yii::$app->params['center_lng']
                                    ]);
                                }
                                $map = new Map([
                                    'center' => $coord,
                                    'streetViewControl' => false,
                                    'mapTypeControl' => true,
                                    'zoom' => 10,
                                    'width' => '100%',
                                    'height' => 500,
                                ]);
                                if (!empty($model->latitude) && !empty($model->longitude)) {
                                    $marker = new Marker([
                                        'position' => $coord,
                                        'title' => $model->name,
                                            // 'icon' => \yii\helpers\Url::to('@web/img/map_icon.png')
                                    ]);
                                    $type_str = "<b>Total number of farmers: </b>" . $faabs_farmers . "<br>";
                                    $marker->attachInfoWindow(
                                            new InfoWindow([
                                                'content' => '<p><b><span class="text-center">' . $model->name . '</span></b><hr>'
                                                . $type_str . '</p>'])
                                    );

                                    $map->addOverlay($marker);
                                }
                                echo $map->display();
                                ?>
                            </div>
                            <div class="tab-pane fade show" id="custom-tabs-three-topics" role="tabpanel" aria-labelledby="custom-tabs-three-topics-tab">
                                <h5>Instructions</h5>
                                <ol>
                                    <li>Below are the topics a farmer in this group will have to attend to graduate</li>
                                    <?php
                                    if (User::userIsAllowedTo('Manage faabs groups')) {
                                        if ($topic_count > 0) {
                                            echo '<li>Click the button <span class="badge badge-success"><i class="fa fa-pencil-alt"></i> Update FaaBS training topics</span> to update topics</li>';
                                        } else {
                                            echo '<li>Click the button <span class="badge badge-success"><i class="fa fa-plus"></i> Enrol FaaBS training topics</span> to add topics to FaaBS</li>';
                                        }
                                    }
                                    ?>
                                </ol>
                                <p class="float-right">
                                    <?php
                                    if (User::userIsAllowedTo('Manage faabs groups')) {
                                        if ($topic_count > 0) {
                                            echo ModalAjax::widget([
                                                'header' => 'Update training FaaBS topics',
                                                'bootstrapVersion' => ModalAjax::BOOTSTRAP_VERSION_4,
                                                'toggleButton' => [
                                                    'label' => '<i class="fa fa-pencil-alt"></i> Update FaaBS training topics',
                                                    //'class' => 'bt btn-lg',
                                                    'class' => "btn btn-success btn-xs",
                                                    'title' => 'Update FaaBS topics',
                                                ],
                                                'id' => "id",
                                                'size' => 'modal-lg',
                                                'options' => ['class' => 'header-success'],
                                                'url' => \yii\helpers\Url::to(['/faabs-groups/update-topics', 'id' => $model->id]),
                                                'ajaxSubmit' => true, // Submit the contained form as ajax, true by default
                                                'autoClose' => true,
                                            ]);
                                        } else {
                                            echo '<button class="btn btn-success btn-xs" href="#" onclick="$(\'#addNewModal\').modal(); 
                                                return false;"><i class="fa fa-plus"></i> Enrol FaaBS training topics</button>';
                                        }
                                    }
                                    ?>
                                </p>
                                <?php
                                $_dataProvider = new \yii\data\ActiveDataProvider([
                                    'query' => \backend\models\MeFaabsTrainingTopicEnrolment::find()
                                            ->where(['faabs_id' => $model->id]),
                                ]);
                                echo GridView::widget([
                                    'dataProvider' => $_dataProvider,
                                    'condensed' => true,
                                    'responsive' => true,
                                    'columns' => [
                                        ['class' => 'yii\grid\SerialColumn'],
                                        // 'id',
                                        [
                                            'enableSorting' => false,
                                            'contentOptions' => ['class' => 'text-left'],
                                            'attribute' => 'planned_activity_id',
                                            'label' => 'Topic',
                                            //'readonly' => false,
                                            ///  'options' => ['style' => 'width:200px;'],
                                            "value" => function ($model) {
                                                $_model = backend\models\MeFaabsTrainingTopics::findOne($model->topic_id);
                                                return !empty($_model) ? $_model->category . "-" . $_model->topic : "";
                                            }
                                        ],
                                        [
                                            'enableSorting' => false,
                                            'contentOptions' => ['class' => 'text-left'],
                                            'attribute' => 'training_type',
                                            'label' => 'Training type',
                                        ],
                                    ],
                                ]);
                                ?>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
                                <h5>Instructions</h5>
                                <ol>
                                    <li>A farmer in this FaaBS needs to attend <span class="badge badge-dark text-sm"><?= $model->max_farmer_graduation_training_topics ?> topic(s)</span> to graduate</li>
                                    <li>The icon <span class="fa fa-graduation-cap" style="color:green;"></span> under "Graduation status" shows that the farmer has been trained in all the FaaBS training topics</li>
                                </ol>                               
                                <?php
                                if ($faabs_farmers > 0) {
                                    $_dataProvider = new \yii\data\ActiveDataProvider([
                                        'query' => \backend\models\MeFaabsCategoryAFarmers::find()
                                                ->where(['faabs_group_id' => $model->id]),
                                    ]);
                                    echo GridView::widget([
                                        'dataProvider' => $_dataProvider,
                                        'condensed' => true,
                                        'responsive' => true,
                                        'columns' => [
                                            ['class' => 'yii\grid\SerialColumn'],
                                            // 'id',
                                            [
                                                'enableSorting' => false,
                                                'attribute' => 'first_name',
                                                'label' => 'Farmer',
                                                'format' => 'raw',
                                                'filterType' => GridView::FILTER_SELECT2,
                                                'filterWidgetOptions' => [
                                                    'pluginOptions' => ['allowClear' => true],
                                                ],
                                                'filter' => \backend\models\MeFaabsCategoryAFarmers::getFullNames(),
                                                'filterInputOptions' => ['prompt' => 'Filter by names', 'class' => 'form-control', 'id' => null],
                                                "value" => function ($model) {
                                                    $name = $model->title . " " . $model->first_name . " " . $model->other_names . " " . $model->last_name;
                                                    return Html::a(
                                                                    $name, ['faabs-category-a-farmers/view', 'id' => $model->id], [
                                                                'title' => 'View farmer',
                                                                'data-toggle' => 'tooltip',
                                                                'data-placement' => 'top',
                                                                'data-pjax' => '0',
                                                                    ]
                                                    );
                                                    //return $name;
                                                }
                                            ],
                                            [
                                                'enableSorting' => false,
                                                'contentOptions' => ['class' => 'text-left'],
                                                'label' => 'Total training topics',
                                                'value' => function($model) use ($id) {
                                                    $total = \backend\models\MeFaabsTrainingTopicEnrolment::find()
                                                            ->where(['faabs_id' => $id])
                                                            ->count();
                                                    return $total;
                                                }
                                            ],
                                            [
                                                'enableSorting' => false,
                                                'contentOptions' => ['class' => 'text-left'],
                                                'label' => 'Topics trained',
                                                'format' => 'raw',
                                                'value' => function($model) use ($id) {
                                                    $name = $model->title . " " . $model->first_name . " " . $model->other_names . " " . $model->last_name;
                                                    $trained_topics = backend\models\MeFaabsTrainingAttendanceSheet::find()
                                                            ->where(['faabs_group_id' => $id])
                                                            ->andWhere(['farmer_id' => $model->id])
                                                            ->count();
                                                    return ModalAjax::widget([
                                                                'header' => "Topics $name has undergone so far",
                                                                'bootstrapVersion' => ModalAjax::BOOTSTRAP_VERSION_4,
                                                                'toggleButton' => [
                                                                    'label' => $trained_topics . " topics",
                                                                    //'class' => 'bt btn-lg',
                                                                    'class' => "btn btn-success btn-xs",
                                                                    'title' => 'Topics ' . $name . ' has undergone so far',
                                                                ],
                                                                'id' => "topic_view_modal" . $model->id,
                                                                'size' => 'modal-lg',
                                                                'options' => ['class' => 'header-success'],
                                                                'url' => \yii\helpers\Url::to(['/faabs-groups/view-trained-topics', 'id' => $model->id, "faabs" => $id]),
                                                                'ajaxSubmit' => true, // Submit the contained form as ajax, true by default
                                                                'autoClose' => true,
                                                    ]);

                                                    /* return backend\models\MeFaabsTrainingAttendanceSheet::find()
                                                      ->where(['faabs_group_id' => $id])
                                                      ->andWhere(['farmer_id' => $model->id])
                                                      ->count(); */
                                                }
                                            ],
                                            [
                                                'enableSorting' => false,
                                                'contentOptions' => ['class' => 'text-left'],
                                                'label' => 'Remaining topics',
                                                'value' => function($model) use ($id, $max_topics) {
                                                    $trained = backend\models\MeFaabsTrainingAttendanceSheet::find()
                                                            ->where(['faabs_group_id' => $id])
                                                            ->andWhere(['farmer_id' => $model->id])
                                                            ->count();
                                                    /* $total = \backend\models\MeFaabsTrainingTopicEnrolment::find()
                                                      ->where(['faabs_id' => $id])
                                                      ->count(); */
                                                    return $max_topics - $trained;
                                                }
                                            ],
                                            [
                                                'enableSorting' => false,
                                                'contentOptions' => ['class' => 'text-left'],
                                                'label' => 'Graduationn status',
                                                'format' => 'raw',
                                                'value' => function($model) use ($id, $max_topics) {
                                                    $str = "";
                                                    $trained = backend\models\MeFaabsTrainingAttendanceSheet::find()
                                                            ->where(['faabs_group_id' => $id])
                                                            ->andWhere(['farmer_id' => $model->id])
                                                            ->count();
                                                    /* $total = \backend\models\MeFaabsTrainingTopicEnrolment::find()
                                                      ->where(['faabs_id' => $id])
                                                      ->count(); */
                                                    if ($max_topics == $trained) {
                                                        $str = "<span class='fa fa-graduation-cap fa-2x' style='color:green'></span>";
                                                    } else {
                                                        $str = "Remaining with " . ($max_topics - $trained) . " topic(s) to graduate";
                                                    }

                                                    return $str;
                                                }
                                            ],
                                        ],
                                    ]);
                                } else {
                                    echo "<p class='alert alert-success'>There are currently no farmers enrolled in this FaaBS group. Kindly add Catergory A farmers to this group!</p>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="addNewModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content card-success card-outline">
            <div class="modal-header">
                <h5 class="modal-title">Pick FaaBS training topics</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ol>
                    <li>Fields marked with <span class="text-red">*</span> are required</li>
                    <li>You can pick multiple topics from the list</li>
                </ol>
                <?php
                $form = ActiveForm::begin([
                            'action' => 'add-topics?id=' . $model->id,
                            'type' => ActiveForm::TYPE_VERTICAL
                        ])
                ?>

                <?=
                        $form->field($faabs_topic_model, "training_type")
                        ->dropDownList(
                                [
                                    'Participants under Direct/Intensive Training [Stream 1]' => "Participants under Direct/Intensive Training [Stream 1]",
                                    "Participants under non-Direct/Other Training [Stream 2]" => "Participants under non-Direct/Other Training [Stream 2]"
                                ], ['custom' => true, 'prompt' => 'Select training type', 'required' => true]
                        )->label("Training type");
                ?>
                <?php
                echo $form->field($faabs_topic_model, 'topics')->multiselect(\backend\models\MeFaabsTrainingTopics::getList(), [
                    //  'selector' => 'radio',
                    'height' => "auto"
                ])->label("Topics");
                ?>

            </div>
            <div class="modal-footer justify-content-between">
                <?= Html::submitButton('Save topics', ['class' => 'btn btn-success btn-xs']) ?>
<?php ActiveForm::end() ?>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
