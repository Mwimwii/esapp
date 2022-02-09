<?php

namespace api\controllers;

use backend\models\District;

class DistrictController extends ActiveAuthController{
    public $modelClass = District::class;
}