<?php

namespace api\controllers;

use backend\models\CommodityType;

class CommodityTypeController extends ActiveAuthController{
    public $modelClass = CommodityType::class;
}