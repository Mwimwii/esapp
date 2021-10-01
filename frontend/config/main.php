<?php

$params = array_merge(
        require __DIR__ . '/../../common/config/params.php',
        require __DIR__ . '/../../common/config/params-local.php',
        require __DIR__ . '/params.php',
        require __DIR__ . '/params-local.php'
);

return [
    'id' => 'esapp-frontend',
    'name' => 'ESAPP MIS',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'modules' => [
        'modules' => [
            'class' => 'frontend\modules\mgfapplication',
        ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => 'essap_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => false,
            'loginUrl' => ['site/login'],
            'authTimeout' => 1 * 24 * 60 * 60,
            // 'loginUrl' => ['site/login'],
            'identityCookie' => [
                'name' => 'essap_identity-frontend',
                'httpOnly' => true
            ],
        ],
        'session' => [
            'class' => 'yii\redis\Session',
            'timeout' => 1800,
            'redis' => [
                'hostname' => 'localhost',
                'port' => 6379,
                'database' => 0,
            ],
            'name' => 'essap-frontend',
            'cookieParams' => [
                'lifetime' => 1 * 24 * 60 * 60,
            ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        /*'urlManager' => [
            'enablePrettyUrl' => false,
            'showScriptName' => false,
            'rules' => [
            ],
        ],*/
    ],
    'params' => $params,
];
