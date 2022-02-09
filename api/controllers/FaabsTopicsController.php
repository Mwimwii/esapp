<?php

namespace api\controllers;

use backend\models\MeFaabsTrainingTopics;

class FaabsTopicsController extends ActiveAuthController{
    public $modelClass = MeFaabsTrainingTopics::class;
}