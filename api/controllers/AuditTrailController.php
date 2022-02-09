<?php

namespace api\controllers;

use backend\models\AuditTrail;

class AuditTrailController extends ActiveAuthController{
    public $modelClass = AuditTrail::class;
}