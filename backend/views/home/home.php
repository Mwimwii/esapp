<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use backend\models\User;
use kartik\grid\GridView;
use yii\data\ActiveDataProvider;
use kartik\form\ActiveForm;
use kartik\depdrop\DepDrop;

$this->title = 'Home';
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- Info boxes -->
<?php
if (User::userIsAllowedTo("View commodity prices") || User::userIsAllowedTo('Collect commodity prices')) {
    echo '<h6 class="mt-2 mb-1"> Commodity price statistics</h6>';
    if (Yii::$app->getUser()->identity->district_id > 0) {
        $Camps = backend\models\Camps::find()->where(['district_id' => Yii::$app->getUser()->identity->district_id])->count();
        $markets = \backend\models\CommodityPriceCollection::find()
                ->select(["market_id"])
                ->where(["created_by" => Yii::$app->getUser()->identity->id])
                ->distinct()
                ->count();
        $collected_commodity_prices = backend\models\CommodityPriceCollection::find()
                ->where(["created_by" => Yii::$app->getUser()->identity->id])
                ->andWhere(["year" => date("Y")])
                ->count();
        $collected_commodity_types = backend\models\CommodityPriceCollection::find()
                ->select(["commodity_type_id"])
                ->where(["created_by" => Yii::$app->getUser()->identity->id])
                ->andWhere(["year" => date("Y")])
                ->distinct()
                ->count();
        ?>
        <div class="row">
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-suitcase"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Commodity prices-<?= date("Y") ?></span>
                        <span class="info-box-number"><?= $collected_commodity_prices ?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-bacon"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Commodity types</span>
                        <span class="info-box-number">
                            <?= $collected_commodity_types ?>
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>

            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-cart-plus"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Markets</span>
                        <span class="info-box-number"><?= $markets ?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>

            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-map-marker"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Camps</span>
                        <span class="info-box-number"> <?= $Camps ?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>

        </div>
        <?php
    } else {
        $provinces = backend\models\Provinces::find()->count();
        $Districts = backend\models\Districts::find()->count();
        $Camps = backend\models\Camps::find()->count();
        $markets = \backend\models\Markets::find()->count();
        ?>
        <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-location-arrow"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Provinces</span>
                        <span class="info-box-number">
                            <?= $provinces ?>
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-map-pin"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Districts</span>
                        <span class="info-box-number"><?= $Districts ?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>

            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-map-marker"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Camps</span>
                        <span class="info-box-number"> <?= $Camps ?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-cart-plus"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Markets</span>
                        <span class="info-box-number"><?= $markets ?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
        <?php
    }
}
?>

<div class="row">
    <div class="col-lg-5">
        <!-- TO DO List -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="ion ion-clipboard mr-1"></i>
                    Downloads
                </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <ul class="todo-list" data-widget="todo-list">
                    <li>
                        <?php
                        echo Html::a(
                                '<div  class="icheck-primary d-inline ml-2">
                            <i class="fa fa-file-pdf fa-2x"></i>
                        </div>
                        <!-- todo text -->
                        <span class="text">Interview Guide template</span>
                        <div class="tools">
                            <i class="fas fa-download fa-2x"></i>
                        </div>',
                                ['/interview-guide-template/download-template',], [
                            'title' => 'Download interview guide template',
                            'target' => '_blank',
                            'data-toggle' => 'tooltip',
                            'data-placement' => 'top',
                            'data-pjax' => '0',
                            'style' => "padding:5px;",
                                ]
                        );
                        ?>

                    </li>
                    <li>
                        <?php
                        echo Html::a(
                                '<div  class="icheck-primary d-inline ml-2">
                            <i class="fa fa-file-pdf fa-2x"></i>
                        </div>
                        <!-- todo text -->
                        <span class="text">Category A Farmer registration form</span>
                        <div class="tools">
                            <i class="fas fa-download fa-2x"></i>
                        </div>',
                                ['/downloads/farmer-registration-form',], [
                            'title' => 'Download Cat A farmer registration form',
                            'target' => '_blank',
                            'data-toggle' => 'tooltip',
                            'data-placement' => 'top',
                            'data-pjax' => '0',
                            'style' => "padding:5px;",
                                ]
                        );
                        ?>
                    </li>
                    <!--<li>-->
                    <?php
                    /* echo Html::a(
                      '<div  class="icheck-primary d-inline ml-2">
                      <i class="fa fa-file-pdf fa-2x"></i>
                      </div>
                      <!-- todo text -->
                      <span class="text">Farming as Business(FaaBS) Register form</span>
                      <div class="tools">
                      <i class="fas fa-download fa-2x"></i>
                      </div>',
                      ['/interview-guide-template/download-template',], [
                      'title' => 'Download interview guide template',
                      'target' => '_blank',
                      'data-toggle' => 'tooltip',
                      'data-placement' => 'top',
                      'data-pjax' => '0',
                      'style' => "padding:5px;",
                      ]
                      ); */
                    ?>
                    <!-- </li>-->
                    <li>
                        <?php
                        if (!empty(Yii::$app->user->identity->district_id)) {
                            echo Html::a(
                                    '<div  class="icheck-primary d-inline ml-2">
                            <i class="fa fa-file-pdf fa-2x"></i>
                        </div>
                        <!-- todo text -->
                        <span class="text">Farming as Business(FaaBS) Attendance Sheet</span>
                        <div class="tools">
                            <i class="fas fa-download fa-2x"></i>
                        </div>',
                                    ['',], [
                                'title' => 'Download FaaBS training attendance sheet',
                                'target' => '_blank',
                                "data-toggle" => "modal",
                                "data-target" => "#faabsModal",
                                // 'data-toggle' => 'tooltip',
                                // 'data-placement' => 'top',
                                // 'data-pjax' => '0',
                                'style' => "padding:5px;",
                                    ]
                            );
                        } else {
                            echo Html::a(
                                    '<div  class="icheck-primary d-inline ml-2">
                          <i class="fa fa-file-pdf fa-2x"></i>
                          </div>
                          <!-- todo text -->
                          <span class="text">Farming as Business(FaaBS) Attendance Sheet</span>
                          <div class="tools">
                          <i class="fas fa-download fa-2x"></i>
                          </div>',
                                    ['/downloads/faabs-attendance-sheet',], [
                                'title' => 'Download FaaBS training attendance sheet',
                                'target' => '_blank',
                                'data-toggle' => 'tooltip',
                                'data-placement' => 'top',
                                'data-pjax' => '0',
                                'style' => "padding:5px;",
                                    ]
                            );
                        }
                        ?>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="card card-success card-outline">
    <div class="card-header">
        <h3 class="card-title">
            Your Tasks
        </h3>
    </div>
    <div class="card-body">
        <?php
        $count = 0;
        //Lets get case study stories that needs to be reviewed
        $_case_study_model = backend\models\Storyofchange::find()
                ->where(['status' => 2]);
        if (!empty($_case_study_model)) {
            $dataProvider = new ActiveDataProvider([
                'query' => $_case_study_model,
            ]);
            if ($dataProvider->count > 0) {
                $count++;
            }
        }

        //Lets get BTOR reports that needs to be reviewed
        $_btor_model = backend\models\MeBackToOfficeReport::find()
                ->where(['status' => 2]);
        if (!empty($_btor_model)) {
            $btor_dataProvider = new ActiveDataProvider([
                'query' => $_btor_model,
            ]);
            if ($btor_dataProvider->count > 0) {
                $count++;
            }
        }

        if ($count > 0) {
            if ($dataProvider->count > 0) {
                //Case study review tasks
                if (User::userIsAllowedTo('Review Story of change')) {
                    ?>
                    <h6>Unreviewed Case study/Success stories</h6>
                    <?=
                    GridView::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            //'id',
                            [
                                'attribute' => 'province_id',
                                'filter' => false,
                                'value' => function ($model) {
                                    //$province_id = backend\models\Districts::findOne($model->district_id)->province_id;
                                    $name = !empty($model->province_id) ? backend\models\Provinces::findOne($model->province_id)->name : "";
                                    return $name;
                                },
                            ],
                            [
                                'attribute' => 'district_id',
                                'filter' => false,
                                'value' => function ($model) {
                                    $name = !empty($model->district_id) ? backend\models\Districts::findOne($model->district_id)->name : "";
                                    return $name;
                                },
                            ],
                            [
                                'attribute' => 'category_id',
                                'filter' => false,
                                'format' => 'raw',
                                'value' => function($model) {
                                    return !empty($model->category_id) ? backend\models\LkmStoryofchangeCategory::findOne($model->category_id)->name : "";
                                }
                            ],
                            [
                                'attribute' => 'title',
                                'filter' => false,
                                'format' => 'raw',
                            ],
                            [
                                'label' => 'Action',
                                'filter' => false,
                                'format' => 'raw',
                                'value' => function($row) {
                                    return Html::a("Review story", ["storyofchange/story-view", 'id' => $row->id]);
                                }
                            ],
                        ],
                    ]);
                    ?>
                    <hr class="dotted short">
                    <?php
                }
            }
            if ($btor_dataProvider->count > 0) {
                //BtOR review tasks
                if (User::userIsAllowedTo('Review back to office report')) {
                    ?>
                    <h6>Unreviewed Back to office reports</h6>
                    <?=
                    GridView::widget([
                        'dataProvider' => $btor_dataProvider,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
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
                            [
                                'label' => 'Date submitted',
                                'value' => function($model) {
                                    return date('d/m/y H:i:s', $model->created_at);
                                }
                            ],
                            [
                                'label' => 'Action',
                                'filter' => false,
                                'format' => 'raw',
                                'value' => function($row) {
                                    return Html::a("Review report", ["back-to-office-report/btor-report-view", 'id' => $row->id]);
                                }
                            ],
                        ],
                    ]);
                }
            }
            ?>
            <hr class="dotted short">
            <?php
        }


        if ($count === 0) {
            echo "<p>You have no tasks!</p>";
        }
        ?>
    </div>
</div>


<div class="modal fade" id="faabsModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content card-success card-outline">
            <div class="modal-header">
                <h5 class="modal-title">Select FaaBS group that will be trained</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                $faabs_model = new \backend\models\Downloads();
                ?>
                <?php
                $form = ActiveForm::begin([
                            'action' => 'faabs-attendance-sheet',
                            'options' => ['target' => '_blank']
                        ])
                ?>
                <?php
                echo $form->field($faabs_model, 'camp')
                        ->dropDownList(
                                \backend\models\Camps::getListByDistrictId(Yii::$app->user->identity->district_id), ['id' => 'camp_id', 'custom' => true, 'prompt' => 'Please select a camp', 'required' => true]
                );


                echo $form->field($faabs_model, 'faabs_group')->widget(DepDrop::classname(), [
                    'options' => ['id' => 'faabs_id', 'custom' => true, 'required' => TRUE],
                    'pluginOptions' => [
                        'depends' => ['camp_id'],
                        // 'initialize' => $model->isNewRecord ? false : true,
                        'placeholder' => 'Please select FaaBS group',
                        'url' => yii\helpers\Url::to(['/faabs-groups/faabs-by-camp']),
                        'params' => ['selected_id'],
                    ]
                ]);
                ?>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal"><span class="fa fa-times-circle"></span> <span class="text-xs">Close</span></button>
                <?= Html::submitButton('<span class="fa fa-download"></span> <span class="text-xs">Download</span>', ['class' => 'btn btn-success btn-xs']) ?>
                <?php ActiveForm::end() ?>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal-dialog -->
</div>

