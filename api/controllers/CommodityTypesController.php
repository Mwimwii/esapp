<?php

namespace api\controllers;

use backend\models\CommodityTypes;

class CommodityTypesController extends ActiveAuthController{
    public $modelClass = CommodityTypes::class;
}