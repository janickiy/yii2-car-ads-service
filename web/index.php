<?php

define('YII_DEBUG', getenv('APP_ENV') !== 'prod');
define('YII_ENV', getenv('APP_ENV') === 'prod' ? 'prod' : 'dev');

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/../config/web.php';

(new yii\web\Application($config))->run();
