<?php

namespace api\controllers;

use backend\models\CommodityCategories;

class CommodityCategoriesController extends ActiveAuthController{
    public $modelClass = CommodityCategories::class;
}