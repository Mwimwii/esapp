<?php

namespace api\controllers;

use backend\models\MeFaabsCategoryAFarmers;

class CategoryAFarmersController extends ActiveAuthController{
    public $modelClass = MeFaabsCategoryAFarmers::class;
}