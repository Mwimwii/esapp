<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use backend\models\User;

$this->title = 'Home';
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- Info boxes -->
<?php
if (User::userIsAllowedTo("View commodity prices") || User::userIsAllowedTo('Collect commodity prices')) {
    echo '<p>
            Commodity price stats
        </p>';
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
<!-- /.row -->
<div class="site-about">
    <p>
        This is the home page. You may modify the following file to customize its content:
    </p>
    <code><?= __FILE__ ?></code>
</div>

