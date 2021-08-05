<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\web\JsExpression;
use kartik\touchspin\TouchSpin;
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
                $form->field($model, 'camp_id')
                ->dropDownList(
                        \backend\models\Camps::getListByDistrictId(Yii::$app->user->identity->district_id), ['prompt' => 'Please select a camp', 'required' => true]
        );
        ?>
        <?=
        $form->field($model, 'name', ['enableAjaxValidation' => true])->textInput(['maxlength' => true, 'placeholder' =>
            'Enter name of FaaBS group', 'id' => "province", 'required' => true,])
        ?>
        <?=
        $form->field($model, 'max_farmer_graduation_training_topics')->widget(TouchSpin::classname(), [
            'options' => ['placeholder' => 'Enter max topics farmer needs to graduate'],
            'pluginOptions' => [
                // 'initval' => 3.00,
                'min' => 1,
                'max' => 1000,
            ],
        ])->hint("Enter the maximum number of topics farmer needs to graduate");
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
        ])->label("GPS coordinates (location of a FaaBS group) - Zoom in and drag the marker to the FaaBS group location")
        ?>
    </div>
 
    <div class="form-group">
        <?= Html::submitButton('Save group', ['class' => 'btn btn-success btn-sm']) ?>
        <?php ActiveForm::end(); ?>
    </div>

