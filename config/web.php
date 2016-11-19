<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'name' => 'Books directory',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '7UonE7p-L3qe-RSl2byO7t9ehdq7Vdtm',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
        'db' => require(__DIR__ . '/db.php'),
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '/' => 'site/index',
                'login' => 'site/login',
                'logout' => 'site/logout',

                'users' => 'user/index',
                'books' => 'book/index',
                'ratings' => 'rating/index',
                'readers' => 'reader/index',

                'api/readers' => 'api/reader/index',
                'api/books' => 'api/book/index',
                'api/ratings' => 'api/rating/index',

                'api/book/<id:\d+>' => 'api/book/view',
                'api/reader/<id:\d+>' => 'api/reader/view',


                '<_c:[\w\-]+>/<_a:[\w\-]+>' => '<_c>/<_a>',
                '<_c:[\w\-]+>/<id:\d+>' => '<_c>/view',
                '<_c:[\w\-]+>' => '<_c>/index',
                '<_c:[\w\-]+>/<_a:[\w\-]+>/<id:\d+>' => '<_c>/<_a>',

                ['class' => 'yii\rest\UrlRule', 'controller' => 'api/book'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'api/rating'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'api/reader'],
            ],
        ],
    ],
    'modules' => [
        'api' => [
            'class' => 'app\api\Module',
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
