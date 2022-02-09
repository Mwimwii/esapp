<?php

namespace api\controllers;

use backend\models\Markets;
use api\controllers\ActiveAuthController;

class MarketsController extends ActiveAuthController{
    public $modelClass = Markets::class;
}