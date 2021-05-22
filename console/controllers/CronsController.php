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
     * Create quarter one work schedule on 1st january
     */
    public function actionQuarterOnePlan() {
        //called on the 1st of January every year at midnight
        //0 0 * * * /var/www/html/esapp/yii crons/quarter-one-plan
        $time_start = microtime(true);
        echo \backend\models\MeQuarterlyWorkPlan::CreateQuarterOnePlan();
        $time_end = microtime(true);
        echo 'Processing for ' . ($time_end - $time_start) . ' seconds ';
    }

    /**
     * Create quarter one work schedule on 1st April
     */
    public function actionQuarterTwoPlan() {
        //called on the 1st of April every year at midnight
        //0 0 * * * /var/www/html/esapp/yii crons/quarter-two-plan
        $time_start = microtime(true);
        echo \backend\models\MeCampSubprojectRecordsAwpbObjectives::CreateAwpbTemplates();
        $time_end = microtime(true);
        echo 'Processing for ' . ($time_end - $time_start) . ' seconds ';
    }

    /**
     * Create quarter one work schedule on 1st April
     */
    public function actionQuarterThreePlan() {
        //called on the 1st of July every year at midnight
        //0 0 * * * /var/www/html/esapp/yii crons/quarter-three-plan
        $time_start = microtime(true);
        echo \backend\models\MeCampSubprojectRecordsAwpbObjectives::CreateAwpbTemplates();
        $time_end = microtime(true);
        echo 'Processing for ' . ($time_end - $time_start) . ' seconds ';
    }

    /**
     * Create quarter one work schedule on 1st October
     */
    public function actionQuarterFourPlan() {
        //called on the 1st of october every year at midnight
        //0 0 * * * /var/www/html/esapp/yii crons/quarter-four-plan
        $time_start = microtime(true);
        echo \backend\models\MeCampSubprojectRecordsAwpbObjectives::CreateAwpbTemplates();
        $time_end = microtime(true);
        echo 'Processing for ' . ($time_end - $time_start) . ' seconds ';
    }

}
