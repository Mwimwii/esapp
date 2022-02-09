<?php

namespace api\controllers;

use backend\models\CommodityPriceCollection;

class CommodityPriceCollectionController extends ActiveAuthController{
    public $modelClass = CommodityPriceCollection::class;
}