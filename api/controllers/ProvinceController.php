<?php

namespace api\controllers;

use backend\models\Province;

class ProvinceController extends ActiveAuthController{
    public $modelClass = Province::class;
}