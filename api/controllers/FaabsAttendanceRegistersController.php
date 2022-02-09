<?php

namespace api\controllers;

use backend\models\MeFaabsTrainingAttendanceSheet;

class FaabsAttendanceRegistersController extends ActiveAuthController{
    public $modelClass = MeFaabsTrainingAttendanceSheet::class;
}