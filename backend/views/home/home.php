<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use backend\models\User;
use kartik\grid\GridView;
use yii\data\ActiveDataProvider;

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

<h6 class="mt-2 mb-1">Downloads</h6>

<div class="row">
    <div class="col-lg-3">
        <?php
        echo Html::a(
                '<div class="info-box mb-3 bg-danger">
                            <span class="info-box-icon"><i class="fas fa-file-alt"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Interview guide template</span>
                                <span class="info-box-number">Download</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>', ['/interview-guide-template/download-template',], [
            'title' => 'Download interview guide template',
            'target' => '_blank',
            'data-toggle' => 'tooltip',
            'data-placement' => 'top',
            'data-pjax' => '0',
            'style' => "padding:5px;",
                ]
        );
        ?>
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

        if ($count > 0) {
            if ($dataProvider->count > 0) {
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
        }

        if ($count === 0) {
            echo "<p>You have no tasks!</p>";
        }
        ?>
    </div>
</div>


