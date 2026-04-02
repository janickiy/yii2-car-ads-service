<?php

declare(strict_types=1);

use app\application\Service\CreateCarService;
use app\application\Service\GetCarByIdService;
use app\application\Service\ListCarsService;
use app\domain\Repository\CarRepositoryInterface;
use app\infrastructure\Persistence\Repository\PgCarRepository;

return [
    'id' => 'car-ads-service',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@app' => dirname(__DIR__),
    ],
    'container' => [
        'singletons' => [
            CarRepositoryInterface::class => PgCarRepository::class,
            CreateCarService::class => CreateCarService::class,
            GetCarByIdService::class => GetCarByIdService::class,
            ListCarsService::class => ListCarsService::class,
        ],
    ],
    'components' => [
        'request' => [
            'cookieValidationKey' => $_ENV['COOKIE_VALIDATION_KEY'] ?? 'change-me',
            'parsers' => [
                'application/json' => yii\web\JsonParser::class,
            ],
        ],
        'db' => [
            'class' => yii\db\Connection::class,
            'dsn' => $_ENV['DB_DSN'] ?? 'pgsql:host=db;port=5432;dbname=loans',
            'username' => $_ENV['DB_USER'] ?? 'user',
            'password' => $_ENV['DB_PASSWORD'] ?? 'password',
            'charset' => 'utf8',
        ],
        'user' => [
            'identityClass' => app\infrastructure\Persistence\ActiveRecord\UserRecord::class,
            'enableAutoLogin' => false,
            'loginUrl' => ['/admin/site/login'],
            'identityCookie' => ['name' => '_identity-backend'],
        ],
        'session' => [
            'name' => 'CAR_ADS_SESSION',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'POST api/v1/car/create' => 'api/v1/car/create',
                'GET api/v1/car/list' => 'api/v1/car/list',
                'GET api/v1/car/<id:\\d+>' => 'api/v1/car/view',
                'admin' => 'admin/site/index',
                'admin/<controller:[\w-]+>/<action:[\w-]+>' => 'admin/<controller>/<action>',
                'admin/<controller:[\w-]+>/<action:[\w-]+>/<id:\\d+>' => 'admin/<controller>/<action>',
            ],
        ],
    ],
    'modules' => [
        'api' => [
            'class' => app\modules\api\Module::class,
        ],
        'admin' => [
            'class' => app\modules\admin\Module::class,
        ],
    ],
    'params' => [],
];
