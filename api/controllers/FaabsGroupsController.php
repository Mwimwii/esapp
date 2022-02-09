<?php

namespace api\controllers;

use backend\models\MeFaabsGroups;

class FaabsGroupsController extends ActiveAuthController{
    public $modelClass = MeFaabsGroups::class;
}