<?php

namespace console\controllers;

use yii\console\Controller;

/**
 * Description of CronsController
 *
 * @author chulu
 */
class CronsController extends Controller {

    public function actionIndex() {
        echo "Yes, cron service is running!!";
    }

    /**
     * Create Camp/Project AWPB annual objectives templates every january for the begining of the year
     */
    public function actionCampProjectAwpbObjectiveTemplates() {
        //called on the 1st of January every year at midnight
        //0 0 * * * /var/www/html/esapp/yii crons/camp-project-awpb-objective-templates
        $time_start = microtime(true);
        echo \backend\models\MeCampSubprojectRecordsAwpbObjectives::CreateAwpbTemplates();
        $time_end = microtime(true);
        echo 'Processing for ' . ($time_end - $time_start) . ' seconds ';
    }

}
