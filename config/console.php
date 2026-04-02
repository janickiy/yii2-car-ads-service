<?php

declare(strict_types=1);

require __DIR__ . '/bootstrap.php';

$config = require __DIR__ . '/common.php';
$config['id'] = 'car-ads-console';
$config['controllerNamespace'] = 'app\\commands';

if (YII_ENV === 'dev') {
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => yii\gii\Module::class,
    ];
}

return $config;
