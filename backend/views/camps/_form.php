<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model backend\models\MFLFacility */
/* @var $form yii\widgets\ActiveForm */
$lat = $model->latitude;
$lng = $model->longitude;
$model->coordinates = !empty($lat) && !empty($lng) ? $lat . "," . $lng : Yii::$app->params['center_lat'] . "," . Yii::$app->params['center_lng'];
if (!empty($model->district_id)) {
    $model->province_id = backend\models\Districts::findOne($model->district_id)->province_id;
}
$location = "";
if (!empty($model->latitude) && !empty($model->longitude)) {
    $location = [
        'latitude' => $model->latitude,
        'longitude' => $model->longitude,
    ];
} else {
    $location = [
        'latitude' => Yii::$app->params['center_lat'],
        'longitude' => Yii::$app->params['center_lng'],
    ];
}
?>

<?php $form = ActiveForm::begin(); ?>
<div class="row">
    <div class="col-lg-6">
        <?php
        echo
                $form->field($model, 'province_id')
                ->dropDownList(
                        \backend\models\Provinces::getProvinceList(), ['id' => 'prov_id', 'custom' => true, 'prompt' => 'Please select a province', 'required' => true]
        );

        echo Html::hiddenInput('selected_id', $model->isNewRecord ? '' : $model->district_id, ['id' => 'selected_id']);

        echo $form->field($model, 'district_id')->widget(DepDrop::classname(), [
            'options' => ['id' => 'dist_id', 'custom' => true, 'required' => TRUE],
            'pluginOptions' => [
                'depends' => ['prov_id'],
                'initialize' => $model->isNewRecord ? false : true,
                'placeholder' => 'Please select a district',
                'url' => Url::to(['/camps/district']),
                'params' => ['selected_id'],
            ]
        ]);
        ?>
        <?=
        $form->field($model, 'name', ['enableAjaxValidation' => true])->textInput(['maxlength' => true, 'placeholder' =>
            'Name of camp', 'id' => "province", 'required' => true,])
        ?>
        <?=
        $form->field($model, 'description')->textarea(['rows' => 4, 'placeholder' =>
            'Camp description'])->label("Description ");
        ?>
    </div>
    <div class="col-lg-6">
        <?php
        echo $form->field($model, 'coordinates')->widget('\pigolab\locationpicker\CoordinatesPicker', [
            'key' => 'AIzaSyB6G0OqzcLTUt1DyYbWFbK4MPUbi1mSCSc', // require , Put your google map api key
            'valueTemplate' => '{latitude},{longitude}', // Optional , this is default result format
            'options' => [
                'style' => 'width: 100%; height: 400px', // map canvas width and height
            ],
            'enableSearchBox' => true, // Optional , default is true
            'searchBoxOptions' => [// searchBox html attributes
                'style' => 'width: 300px;', // Optional , default width and height defined in css coordinates-picker.css
            ],
            'searchBoxPosition' => new JsExpression('google.maps.ControlPosition.TOP_LEFT'), // optional , default is TOP_LEFT
            'mapOptions' => [
                // google map options
                // visit https://developers.google.com/maps/documentation/javascript/controls for other options
                'mapTypeControl' => true, // Enable Map Type Control
                'mapTypeControlOptions' => [
                    'style' => new JsExpression('google.maps.MapTypeControlStyle.HORIZONTAL_BAR'),
                    'position' => new JsExpression('google.maps.ControlPosition.TOP_LEFT'),
                ],
                'streetViewControl' => false, // Enable Street View Control
            ],
            'clientOptions' => [
                // jquery-location-picker options
                'radius' => 300,
                'addressFormat' => 'street_number',
                'zoom' => 6,
                'location' => $location
            ]
        ])->label("GPS coordinates (location of a camp) - Zoom in and drag the marker to the camp location")
        ?>
    </div>
    <div class="col-lg-12">


    </div>
    <div class="form-group">
        <?= Html::submitButton('Save camp', ['class' => 'btn btn-success btn-sm']) ?>
        <?php ActiveForm::end(); ?>
    </div>

