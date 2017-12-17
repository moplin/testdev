<?php

$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');

$config = [
    'id' => 'basic',
    'language' => 'es',
    'sourceLanguage' => 'es_Ec',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],



    'components' => [
        'jwt' => [
            'class' => 'sizeg\jwt\Jwt',
            'key' => 'secret',
        ],
        'assetManager' => [
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'jsOptions' => [ 'position' => \yii\web\View::POS_HEAD ],
                ],
            ],
        ],
        'request' => [
            'enableCookieValidation' => true, //<---to flase to make it work
            'enableCsrfValidation' => true,
            'cookieValidationKey' => 'hdfghdsrthrgfdhfghthdrtth',
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

        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'fileMap' => [
                        'app' => 'app.php',
                        'app/articles' => 'articles.php',
                    ],
                ],
            ],
        ],

        'db' => $db,
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => false,
            'showScriptName' => false,
            'rules' => [
                ['class' => 'yii\rest\UrlRule', 'controller' => 'articles'],
                //['class' => 'yii\rest\UrlRule', 'controller' => ['v1/jwt']],
            ],
        ],

    ],

    'modules' => [
        'v1' => [
            'class' => 'app\modules\v1\V1',
        ],
    ],


    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1'],
        'generators' => [
            'adminMainFrame' => [
                'class' => 'yii2tech\admin\gii\mainframe\Generator'
            ],
            'adminCrud' => [
                'class' => 'yii2tech\admin\gii\crud\Generator'
            ]
        ],
    ];
}

return $config;
