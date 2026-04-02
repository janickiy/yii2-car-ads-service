<?php

declare(strict_types=1);

require __DIR__ . '/bootstrap.php';

$config = require __DIR__ . '/common.php';
$config['controllerNamespace'] = 'app\\controllers';
$config['defaultRoute'] = 'site/index';

return $config;
