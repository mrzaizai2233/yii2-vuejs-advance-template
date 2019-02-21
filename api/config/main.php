<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'api\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'V1' => [
            'class' => 'api\modules\v1\Module',
        ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-api',

        ],
        'user' => [
            'identityClass' => 'common\models\User',
//            'enableAutoLogin' => true,
            'enableSession' => false,
            'loginUrl'=>null,
//            'identityCookie' => ['name' => '_identity-api', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the api
            'name' => 'advanced-api',
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

        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,//if set true only url V1/defaults working else V1/default/index and V1/defaults working
            'showScriptName' => false,
            'rules' => [
                'GET users' => 'V1/default/index',//replace http://domain.com/backend/web/users with http://domain.com/backend/web/V1/default/index
                [
                    'class' => 'yii\rest\UrlRule',//replace V1/defaults with V1/default/index
                    'controller' => 'V1/default',
                    'extraPatterns' => [
                    ],
                ],
            ],
        ],

    ],
    'params' => $params,
];
