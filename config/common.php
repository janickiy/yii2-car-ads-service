<?php

declare(strict_types=1);

use app\application\Service\CreateCarService;
use app\application\Service\GetCarByIdService;
use app\application\Service\ListCarsService;
use app\domain\Repository\CarRepositoryInterface;
use app\infrastructure\Persistence\Repository\PgCarRepository;
use yii\db\Connection;
use yii\log\FileTarget;

return [
    'id' => 'car-ads-service',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@app' => dirname(__DIR__),
        '@vendor' => dirname(__DIR__) . '/vendor',
        '@bower' => dirname(__DIR__) . '/vendor/bower-asset',
        '@npm' => dirname(__DIR__) . '/vendor/npm-asset',
        '@webroot' => dirname(__DIR__) . '/public',
        '@web' => '',
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
        'db' => [
            'class' => Connection::class,
            'dsn' => $_ENV['DB_DSN'] ?? 'pgsql:host=db;port=5432;dbname=loans',
            'username' => $_ENV['DB_USER'] ?? 'user',
            'password' => $_ENV['DB_PASSWORD'] ?? 'password',
            'charset' => 'utf8',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
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
