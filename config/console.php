<?php

declare(strict_types=1);

require __DIR__ . '/bootstrap.php';

$config = require __DIR__ . '/common.php';
$config['controllerNamespace'] = 'app\\commands';
$config['bootstrap'] = ['log'];
$config['modules']['gii'] = [
    'class' => yii\gii\Module::class,
];

return $config;
