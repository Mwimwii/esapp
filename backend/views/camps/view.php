<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;
use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\overlays\InfoWindow;
use dosamigos\google\maps\overlays\Marker;
use dosamigos\google\maps\Map;

/* @var $this yii\web\View */
/* @var $model backend\models\MeFaabsTrainingAttendanceSheet */

$this->title = "View " . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Camps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);


$faabs = backend\models\MeFaabsGroups::find()->where(['camp_id' => $model->id])->count();
?>
<div class="card card-success card-outline">
    <div class="card-body">

        <p>
            <?php
            if (\backend\models\User::userIsAllowedTo('Manage camps')) {
                echo Html::a('<span class="fas fa-edit fa-2x"></span>', ['update', 'id' => $model->id], [
                    'title' => 'Update camp',
                    'data-toggle' => 'tooltip',
                    'data-placement' => 'top',
                ]);
            }
            echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
            if (\backend\models\User::userIsAllowedTo('Remove camps')) {
                echo Html::a(
                        '<span class="fas fa-trash fa-2x"></span>', ['delete', 'id' => $model->id], [
                    'title' => 'Remove camp',
                    'data-toggle' => 'tooltip',
                    'data-placement' => 'top',
                    'data' => [
                        'confirm' => 'Are you sure you want to remove this camp?',
                        'method' => 'post',
                    ],
                    'style' => "padding:5px;",
                        //'class' => 'bt btn-lg'
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
        </p>
        <div class="row">
            <div class="col-lg-6">
                <?=
                DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        [
                            'attribute' => 'province_id',
                            'value' => function ($model) {
                                $province_id = backend\models\Districts::findOne($model->district_id)->province_id;
                                $name = backend\models\Provinces::findOne($province_id)->name;
                                return $name;
                            },
                        ],
                        [
                            'attribute' => 'district_id',
                            'value' => function ($model) {
                                $name = backend\models\Districts::findOne($model->district_id)->name;
                                return $name;
                            },
                        ],
                        [
                            'attribute' => 'name',
                            'format' => 'raw',
                        ],
                        [
                            'attribute' => 'description',
                            'format' => 'raw',
                        ],
                        [
                            'label' => 'Latitude/Longitude',
                            'value' => function ($model) {
                                return $model->longitude . "/" . $model->latitude;
                            },
                        ],
                    ],
                ])
                ?>
            </div>
            <div class="col-lg-6">
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
                    $type_str = "<b>Number of FaaBS: </b>" . $faabs . "<br>";
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
        </div>
    </div>
</div>
