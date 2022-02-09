<?php

namespace api\controllers;

// use api\resources\User; 
use backend\models\User;
use yii\helpers\Json;

class AuthTokenController extends ActiveAuthController{
    public $modelClass = User::class;
    // return Json::encode(['auth'])
}