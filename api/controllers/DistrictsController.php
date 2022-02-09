<?php

namespace api\controllers;

use backend\models\Districts;

class DistrictsController extends ActiveAuthController{
    public $modelClass = Districts::class;
}