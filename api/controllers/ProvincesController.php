<?php

namespace api\controllers;

use backend\models\Provinces;

class ProvincesController extends ActiveAuthController{
    public $modelClass = Provinces::class;
}