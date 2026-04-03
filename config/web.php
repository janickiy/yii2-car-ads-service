<?php

declare(strict_types=1);

require __DIR__ . '/bootstrap.php';

$config = require __DIR__ . '/common.php';
$config['controllerNamespace'] = 'app\controllers';
$config['defaultRoute'] = 'site/index';

$config['components']['request'] = [
    'cookieValidationKey' => $_ENV['COOKIE_VALIDATION_KEY'] ?? 'change-me',
    'parsers' => [
        'application/json' => yii\web\JsonParser::class,
    ],
];

$config['components']['user'] = [
    'identityClass' => app\infrastructure\Persistence\ActiveRecord\UserRecord::class,
    'enableAutoLogin' => false,
    'loginUrl' => ['/admin/site/login'],
    'identityCookie' => ['name' => '_identity-backend'],
];

$config['components']['session'] = [
    'name' => 'CAR_ADS_SESSION',
];

$config['components']['errorHandler'] = [
    'errorAction' => 'site/error',
];

$config['components']['cache'] = [
    'class' => yii\caching\FileCache::class,
];

$config['components']['urlManager'] = [
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'rules' => [
        'POST api/v1/car/create' => 'api/v1/car/create',
        'GET api/v1/car/list' => 'api/v1/car/list',
        'GET api/v1/car/<id:\d+>' => 'api/v1/car/view',

        'swagger' => 'swagger/index',
        'swagger/openapi.json' => 'swagger/openapi',

        'admin' => 'admin/site/index',
        'admin/' => 'admin/site/index',
        'admin/site/login' => 'admin/site/login',
        'admin/<controller:[\w-]+>/<action:[\w-]+>' => 'admin/<controller>/<action>',
        'admin/<controller:[\w-]+>/<action:[\w-]+>/<id:\d+>' => 'admin/<controller>/<action>',
    ],
];

if (YII_ENV === 'dev') {
    $config['bootstrap'][] = 'debug';
    $config['bootstrap'][] = 'gii';

    $config['modules']['debug'] = [
        'class' => yii\debug\Module::class,
    ];
    $config['modules']['gii'] = [
        'class' => yii\gii\Module::class,
    ];
}

return $config;
