<?php

$params = array_merge(
        require __DIR__ . '/../../common/config/params.php',
        // require __DIR__ . '/../../common/config/params-local.php',
        require __DIR__ . '/params.php',
        // require __DIR__ . '/main-local.php',
        // require __DIR__ . '/params-local.php'
);

return [
    'id' => 'esapp-api',
    'name' => 'ESAPP MIS',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'api\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
        'request' => [
            'enableCookieValidation' => false,
            'enableCsrfValidation' => false,
        ],
        'urlManager' => [
            'rules' => [
                ['class' => 'yii\rest\UrlRule', 'controller' =>[ 'category-a-farmers', 'camps', 'faabs-groups', 'faabs-topics', 'faabs-topics-enrollments', 'faabs-attendance-registers', 'markets']],
            ],
            'enablePrettyUrl' => true,
            'enableStrictParsing' => false,
            'showScriptName' => false,
        ],
        'request' => [
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
        ],
        'response' => [
            'format' => yii\web\Response::FORMAT_JSON,
            'charset' => 'UTF-8',
            ],
        'user' => [
            'identityClass' => 'api\models\User',
            'enableSession' => false,
            'loginUrl' => null,
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
    ],
    'params' => $params,
];
