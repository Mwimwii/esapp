<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use backend\models\User;
use kartik\grid\GridView;
use yii\data\ActiveDataProvider;
use kartik\form\ActiveForm;
use kartik\depdrop\DepDrop;
use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\overlays\InfoWindow;
use dosamigos\google\maps\overlays\Marker;
use dosamigos\google\maps\Map;
use dosamigos\google\maps\overlays\Polygon;

$this->title = 'Home';
$this->params['breadcrumbs'][] = $this->title;


$provinces_model = \backend\models\Provinces::find()
        ->cache(Yii::$app->params['cache_duration'])
        ->select(['id', 'name', 'ST_AsGeoJSON(polygon) as polygon'])
        ->all();
$counter = 0;
$colors = ["#ed5151", "#149ece", "#a7c636", "#9e559c", "#fc921f", "purple", "#006D2C", ' #2a4858', '#fafa6e', 'lime'];

//Default map settings
$coord = new LatLng([
    'lat' => -13.445529118205,
    'lng' => 28.983639375
        ]);

$map = new Map(
        [
    'center' => $coord,
    'zoom' => Yii::$app->params['polygon_zoom'],
    'width' => '100%',
    'height' => 500,
    'scrollwheel' => false,
    'draggable' => true,
    'draggingCursor' => true,
    'streetViewControl' => false,
    'mapTypeControl' => false,
    'styles' => new \yii\web\JsExpression("[{ featureType: 'poi',  elementType: 'labels', stylers: [{ visibility: 'off' }] } ]")
        ]
);
$map2 = new Map(
        [
    'center' => $coord,
    'zoom' => Yii::$app->params['polygon_zoom'],
    'width' => '100%',
    'height' => 500,
    'scrollwheel' => false,
    'draggable' => true,
    'draggingCursor' => true,
    'streetViewControl' => false,
    'mapTypeControl' => false,
    'styles' => new \yii\web\JsExpression("[{ featureType: 'poi',  elementType: 'labels', stylers: [{ visibility: 'off' }] } ]")
        ]
);
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
        $provinces = backend\models\MeFaabsGroups::find()->count();
        $Districts = backend\models\Districts::find()->count();
        $Camps = backend\models\Camps::find()->count();
        $markets = \backend\models\Markets::find()->count();
        ?>
        <div class="row">

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
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-location-arrow"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">FaaBS Groups</span>
                        <span class="info-box-number">
                            <?= $provinces ?>
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
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
                                // 'target' => '_blank',
                                "data-toggle" => "modal",
                                "data-target" => "#faabsModal",
                                // 'data-toggle' => 'tooltip',
                                // 'data-placement' => 'top',
                                'data-pjax' => '0',
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

    <div class="col-lg-5">
        <!-- TO DO List -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="ion ion-clipboard mr-1"></i>
                    AWPB Downloads
                </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <ul class="todo-list" data-widget="todo-list">
                    <li>
                        <?php
                        $awpb_template = \backend\models\AwpbTemplate::findOne([
                                    'status' => \backend\models\AwpbTemplate::STATUS_PUBLISHED,
                        ]);
                        $fiscal_y = !empty($awpb_template->fiscal_year) ? $awpb_template->fiscal_year : "";
                        echo Html::a(
                                '<div  class="icheck-primary d-inline ml-2">
                            <i class="fa fa-file-pdf fa-2x"></i>
                        </div>
                        <!-- todo text -->
                        <span class="text">' . $fiscal_y . ' Budget Guidelines</span>
                        <div class="tools">
                            <i class="fas fa-download fa-2x"></i>
                        </div>',
                                ['awpb-template/read', 'id' => (!empty($awpb_template->id) ? $awpb_template->id : ""),], [
                            'title' => $fiscal_y . ' budget uidelines',
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
                            <i class="fa fa-file-excel fa-2x"></i>
                        </div>
                        <!-- todo text -->
                        <span class="text">' . $fiscal_y . ' Sage Pastel Budget File</span>
                        <div class="tools">
                            <i class="fas fa-download fa-2x"></i>
                        </div>',
                                ['reports/download-budget', 'id' => (!empty($awpb_template->id) ? $awpb_template->id : ""),
                                ], [
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
                        /* if (!empty(Yii::$app->user->identity->district_id)) {
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
                          } */
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
<div class="card card-success card-outline card-tabs">
    <div class="card-header">
        <h3 class="card-title">
            Camp/FaaBS locations
        </h3>
    </div>
    <div class="card-body">
        <div class="card-header p-0 pt-1 border-bottom-0">
            <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">
                        Camps
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false">
                        Farming as a Business Schools
                    </a>
                </li>
            </ul>
        </div>
        <div class="tab-content" id="custom-tabs-three-tabContent">
            <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                <?php
                if (!empty(Yii::$app->user->identity->district_id)) {
                    $dataProviderCamps = \backend\models\Camps::find()
                            ->cache(Yii::$app->params['cache_duration'])
                            ->where(['district_id' => Yii::$app->user->identity->district_id])
                            ->all();
                    $district_model = \backend\models\Districts::findOne(Yii::$app->user->identity->district_id);
                    $province_id = !empty($district_model) ? $district_model->province_id : "";

                    $prov_model = \backend\models\Provinces::find()->cache(Yii::$app->params['cache_duration'])
                                    ->select(['id', 'name', 'ST_AsGeoJSON(polygon) as polygon'])
                                    ->where(["id" => $province_id])->one();
                    if (!empty($prov_model)) {
                        $coords = \backend\models\Provinces::getCoordinates(json_decode($prov_model->polygon, true)['coordinates']);
                        $coord = json_decode($prov_model->polygon, true)['coordinates'][0][0];
                        $center = round(count($coord) / 2);
                        $center_coords = $coord[$center];
                        if (!empty($center_coords)) {
                            $coord = new LatLng([
                                'lat' => $center_coords[1],
                                'lng' => $center_coords[0]
                            ]);
                        } else {
                            $coord = new LatLng([
                                'lat' => Yii::$app->params['center_lat'],
                                'lng' => Yii::$app->params['center_lng']
                            ]);
                        }
                        $map = new Map([
                            'center' => $coord,
                            'scrollwheel' => false,
                            'draggable' => true,
                            'draggingCursor' => true,
                            'streetViewControl' => false,
                            'mapTypeControl' => false,
                            'zoom' => 8,
                            'width' => '100%',
                            'height' => 500,
                            'styles' => new \yii\web\JsExpression("[{ featureType: 'poi',  elementType: 'labels', stylers: [{ visibility: 'off' }] } ]")
                        ]);

                        foreach ($provinces_model as $model) {
                            if (!empty($model->polygon)) {
                                //We pick a color for each province polygon
                                $stroke_color = $colors[$counter];
                                $counter++;

                                $coords = \backend\models\Provinces::getCoordinates(json_decode($model->polygon, true)['coordinates']);

                                $polygon = new Polygon([
                                    'paths' => $coords,
                                    'strokeColor' => $stroke_color,
                                    'strokeOpacity' => 0.8,
                                    'strokeWeight' => 2,
                                    'fillColor' => $stroke_color,
                                    'fillOpacity' => 0.35,
                                ]);

                                $map->addOverlay($polygon);

                                foreach ($dataProviderCamps as $_model) {
                                    //var_dump($_model);
                                    // var_dump($_model->name);
                                    $faabs = backend\models\MeFaabsGroups::find()->where(['camp_id' => $_model->id])->count();
                                    if (!empty($_model->latitude) && !empty($_model->longitude)) {
                                        $coord = new LatLng(['lat' => $_model->latitude, 'lng' => $_model->longitude]);
                                        $marker = new Marker([
                                            'position' => $coord,
                                            'title' => $_model->name,
                                                //'icon' => \yii\helpers\Url::to('@web/img/map_icon.png')
                                        ]);

                                        $type_str = "";
                                        $type_str .= "<b>Province: </b>" . \backend\models\Provinces::findOne(backend\models\Districts::findOne($_model->district_id)->province_id)->name . "<br>";
                                        $type_str .= "<b>District: </b>" . backend\models\Districts::findOne($_model->district_id)->name . "<br>";
                                        $type_str .= "<b>Number of FaaBS: </b>" . $faabs . "<br>";
                                        //$type_str .= Html::a('View more details', ['/camps/view', 'id' => $_model->id], ["class" => "text-sm"]);
                                        $marker->attachInfoWindow(
                                                new InfoWindow([
                                                    'content' => '<p><strong><span class="text-center">' . $_model->name . '</span></strong><hr>'
                                                    . $type_str . '</p>'])
                                        );

                                        $map->addOverlay($marker);
                                    }
                                }
                            }
                        }
                        echo $map->display();
                    }
                } else {
                    if (!empty($provinces_model)) {
                        foreach ($provinces_model as $model) {
                            if (!empty($model->polygon)) {
                                //We pick a color for each province polygon
                                $stroke_color = $colors[$counter];
                                $counter++;

                                $coords = \backend\models\Provinces::getCoordinates(json_decode($model->polygon, true)['coordinates']);

                                $polygon = new Polygon([
                                    'paths' => $coords,
                                    'strokeColor' => $stroke_color,
                                    'strokeOpacity' => 0.8,
                                    'strokeWeight' => 2,
                                    'fillColor' => $stroke_color,
                                    'fillOpacity' => 0.35,
                                ]);
                                $map->addOverlay($polygon);
                                $dataProviderCamps = \backend\models\Camps::find()
                                        ->cache(Yii::$app->params['cache_duration'])
                                        // ->where(['district_id' => Yii::$app->user->identity->district_id])
                                        ->all();

                                foreach ($dataProviderCamps as $_model) {
                                    //var_dump($_model);
                                    // var_dump($_model->name);
                                    $faabs = backend\models\MeFaabsGroups::find()->where(['camp_id' => $_model->id])->count();
                                    if (!empty($_model->latitude) && !empty($_model->longitude)) {
                                        $coord = new LatLng(['lat' => $_model->latitude, 'lng' => $_model->longitude]);
                                        $marker = new Marker([
                                            'position' => $coord,
                                            'title' => $_model->name,
                                                //'icon' => \yii\helpers\Url::to('@web/img/map_icon.png')
                                        ]);

                                        $type_str = "";
                                        $type_str .= "<b>Province: </b>" . \backend\models\Provinces::findOne(backend\models\Districts::findOne($_model->district_id)->province_id)->name . "<br>";
                                        $type_str .= "<b>District: </b>" . backend\models\Districts::findOne($_model->district_id)->name . "<br>";
                                        $type_str .= "<b>Number of FaaBS: </b>" . $faabs . "<br>";
                                        $type_str .= Html::a('View more details', ['/camps/view', 'id' => $_model->id], ["class" => "text-sm"]);
                                        $marker->attachInfoWindow(
                                                new InfoWindow([
                                                    'content' => '<p><strong><span class="text-center">' . $_model->name . '</span></strong><hr>'
                                                    . $type_str . '</p>'])
                                        );

                                        $map->addOverlay($marker);
                                    }
                                }
                            }
                        }
                    }

                    echo $map->display();
                }
                ?>
            </div>
            <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
                <?php
                $counter1 = 0;
                if (!empty(Yii::$app->user->identity->district_id)) {
                    $dataProviderCamps = \backend\models\Camps::find()
                            ->cache(Yii::$app->params['cache_duration'])
                            ->where(['district_id' => Yii::$app->user->identity->district_id])
                            ->all();
                    $district_model = \backend\models\Districts::findOne(Yii::$app->user->identity->district_id);
                    $province_id = !empty($district_model) ? $district_model->province_id : "";

                    $prov_model = \backend\models\Provinces::find()->cache(Yii::$app->params['cache_duration'])
                                    ->select(['id', 'name', 'ST_AsGeoJSON(polygon) as polygon'])
                                    ->where(["id" => $province_id])->one();
                    if (!empty($prov_model)) {
                        $coords = \backend\models\Provinces::getCoordinates(json_decode($prov_model->polygon, true)['coordinates']);
                        $coord = json_decode($prov_model->polygon, true)['coordinates'][0][0];
                        $center = round(count($coord) / 2);
                        $center_coords = $coord[$center];
                        if (!empty($center_coords)) {
                            $coord = new LatLng([
                                'lat' => $center_coords[1],
                                'lng' => $center_coords[0]
                            ]);
                        } else {
                            $coord = new LatLng([
                                'lat' => Yii::$app->params['center_lat'],
                                'lng' => Yii::$app->params['center_lng']
                            ]);
                        }
                        $map2 = new Map([
                            'center' => $coord,
                            'scrollwheel' => false,
                            'draggable' => true,
                            'draggingCursor' => true,
                            'streetViewControl' => false,
                            'mapTypeControl' => false,
                            'zoom' => 8,
                            'width' => '100%',
                            'height' => 500,
                            'styles' => new \yii\web\JsExpression("[{ featureType: 'poi',  elementType: 'labels', stylers: [{ visibility: 'off' }] } ]")
                        ]);

                        $counter = 0;
                        foreach ($provinces_model as $model) {
                            if (!empty($model->polygon)) {
                                //We pick a color for each province polygon
                                $stroke_color = $colors[$counter];
                                $counter++;

                                $coords = \backend\models\Provinces::getCoordinates(json_decode($model->polygon, true)['coordinates']);

                                $polygon = new Polygon([
                                    'paths' => $coords,
                                    'strokeColor' => $stroke_color,
                                    'strokeOpacity' => 0.8,
                                    'strokeWeight' => 2,
                                    'fillColor' => $stroke_color,
                                    'fillOpacity' => 0.35,
                                ]);

                                $map2->addOverlay($polygon);
                                //We create an array to be used to get the faabs in the province
                                $camp_ids = [];
                                if (!empty($dataProviderCamps)) {
                                    foreach ($dataProviderCamps as $id) {
                                        array_push($camp_ids, $id['id']);
                                    }
                                }
                                //We now get the faabs in the province
                                $faabs_model = backend\models\MeFaabsGroups::find()
                                        ->cache(Yii::$app->params['cache_duration'])
                                        ->where(['IN', 'camp_id', $camp_ids])
                                        ->all();

                                if (!empty($faabs_model)) {
                                    foreach ($faabs_model as $_model) {
                                        //var_dump($_model);
                                        // var_dump($_model->name);
                                        $faabs_farmers = backend\models\MeFaabsCategoryAFarmers::find()
                                                ->where(['faabs_group_id' => $_model->id])
                                                ->count();
                                        if (!empty($_model->latitude) && !empty($_model->longitude)) {
                                            $coord = new LatLng(['lat' => $_model->latitude, 'lng' => $_model->longitude]);
                                            $marker = new Marker([
                                                'position' => $coord,
                                                'title' => $_model->name,
                                                    //'icon' => \yii\helpers\Url::to('@web/img/map_icon.png')
                                            ]);

                                            $type_str = "";
                                            $type_str .= "<b>Province: </b>" . \backend\models\Provinces::findOne(backend\models\Districts::findOne(Yii::$app->user->identity->district_id)->province_id)->name . "<br>";
                                            $type_str .= "<b>District: </b>" . backend\models\Districts::findOne(Yii::$app->user->identity->district_id)->name . "<br>";
                                            $type_str .= "<b>Camp: </b>" . backend\models\Camps::findOne($_model->camp_id)->name . "<br>";
                                            $type_str .= "<b>Total farmers: </b>" . $faabs_farmers . "<br>";
                                            //$type_str .= Html::a('View more details', ['/camps/view', 'id' => $_model->id], ["class" => "text-sm"]);
                                            $marker->attachInfoWindow(
                                                    new InfoWindow([
                                                        'content' => '<p><strong><span class="text-center">' . $_model->name . '</span></strong><hr>'
                                                        . $type_str . '</p>'])
                                            );

                                            $map2->addOverlay($marker);
                                        }
                                    }
                                }
                            }
                        }
                        echo $map2->display();
                    }
                } else {
                    if (!empty($provinces_model)) {
                        foreach ($provinces_model as $model) {
                            if (!empty($model->polygon)) {
                                //We pick a color for each province polygon
                                $stroke_color = $colors[$counter1];
                                $counter1++;

                                $coords = \backend\models\Provinces::getCoordinates(json_decode($model->polygon, true)['coordinates']);

                                $polygon = new Polygon([
                                    'paths' => $coords,
                                    'strokeColor' => $stroke_color,
                                    'strokeOpacity' => 0.8,
                                    'strokeWeight' => 2,
                                    'fillColor' => $stroke_color,
                                    'fillOpacity' => 0.35,
                                ]);
                                $map2->addOverlay($polygon);
                                $faabs_model = backend\models\MeFaabsGroups::find()
                                        ->cache(Yii::$app->params['cache_duration'])
                                        // ->where(['IN', 'camp_id', $camp_ids])
                                        ->all();

                                if (!empty($faabs_model)) {
                                    foreach ($faabs_model as $_model) {
                                        //var_dump($_model);
                                        // var_dump($_model->name);
                                        $faabs_farmers = backend\models\MeFaabsCategoryAFarmers::find()
                                                ->where(['faabs_group_id' => $_model->id])
                                                ->count();
                                        $camp_model = backend\models\Camps::findOne($_model->camp_id);
                                        $district_model = !empty($camp_model) ? \backend\models\Districts::findOne($camp_model->district_id) : "";
                                        $province_model = !empty($district_model) ? \backend\models\Provinces::findOne($district_model->province_id) : "";

                                        $district = !empty($district_model) ? $district_model->name : "";
                                        $camp_name = !empty($camp_model) ? $camp_model->name : "";
                                        $_province = !empty($province_model) ? $province_model->name : "";

                                        if (!empty($_model->latitude) && !empty($_model->longitude)) {
                                            $coord = new LatLng(['lat' => $_model->latitude, 'lng' => $_model->longitude]);
                                            $marker = new Marker([
                                                'position' => $coord,
                                                'title' => $_model->name,
                                                    //'icon' => \yii\helpers\Url::to('@web/img/map_icon.png')
                                            ]);

                                            $type_str = "";
                                            $type_str .= "<b>Province: </b>" . $_province . "<br>";
                                            $type_str .= "<b>District: </b>" . $district . "<br>";
                                            $type_str .= "<b>Camp: </b>" . $camp_name . "<br>";
                                            $type_str .= "<b>Total farmers: </b>" . $faabs_farmers . "<br>";
                                            $type_str .= Html::a('View more details', ['/faabs-groups/view', 'id' => $_model->id], ["class" => "text-sm"]);
                                            $marker->attachInfoWindow(
                                                    new InfoWindow([
                                                        'content' => '<p><strong><span class="text-center">' . $_model->name . '</span></strong><hr>'
                                                        . $type_str . '</p>'])
                                            );

                                            $map2->addOverlay($marker);
                                        }
                                    }
                                }
                            }
                        }
                    }

                    echo $map2->display();
                }
                ?>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="faabsModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content card-success card-outline">
            <div class="modal-header">
                <h5 class="modal-title">Select FaaBS group that will be trained and the topic they will be trained on</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php
            $faabs_model = new \backend\models\Downloads();
            ?>
            <?php
            $form = ActiveForm::begin([
                        'action' => 'faabs-attendance-sheet',
                            // 'options' => ['data-pjax'=>0,"rel" => "noopener",'target' => '_blank',]
                    ])
            ?>
            <div class="modal-body">

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


                echo $form->field($faabs_model, 'topic')->widget(DepDrop::classname(), [
                    'options' => ['id' => 'topic_id', 'custom' => true, 'required' => TRUE],
                    'pluginOptions' => [
                        'depends' => ['faabs_id'],
                        //  'initialize' => $model->isNewRecord ? false : true,
                        'placeholder' => 'Please select a topic',
                        'url' => yii\helpers\Url::to(['/faabs-groups/topic']),
                        'params' => ['selected_id'],
                    ]
                ]);


//echo $form->field($faabs_model, 'topic')->multiselect(\backend\models\MeFaabsTrainingTopics::getList(), ['selector' => 'radio']);

                echo $form->field($faabs_model, 'topic')->multiselect(\backend\models\MeFaabsTrainingTopics::getList(), ['selector' => 'radio']);
                ?>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal"><span class="fa fa-times-circle"></span> <span class="text-xs">Close</span></button>
                <?= Html::submitButton('<span class="fa fa-download"></span> <span class="text-xs">Download</span>', ['class' => 'btn btn-success btn-xs']) ?>
            </div>
            <?php ActiveForm::end() ?>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal-dialog -->
</div>

