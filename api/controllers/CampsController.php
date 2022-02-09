<?php

namespace api\controllers;

use backend\models\Camps;

class CampsController extends ActiveAuthController{
    public $modelClass = Camps::class;
}