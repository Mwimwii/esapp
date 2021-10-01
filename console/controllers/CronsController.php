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
     * Create temp user account
     */
    public function actionUserSeeder() {
        // /var/www/html/esapp/yii crons/user-seeder
        $time_start = microtime(true);
        echo \backend\models\User::seedUser();
        $time_end = microtime(true);
        echo 'Processing for ' . ($time_end - $time_start) . ' seconds ';
    }

    /**
     * Seed permissions
     */
    public function actionSeedRights() {
        // /var/www/html/esapp/yii crons/seed-rights
        $time_start = microtime(true);
        echo \common\models\Right::seedRights()."\n";
        $time_end = microtime(true);
        echo 'Processing for ' . ($time_end - $time_start) . ' seconds ';
    }

}
