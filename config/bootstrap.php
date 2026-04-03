<?php

declare(strict_types=1);

$envPath = dirname(__DIR__) . '/.env';
if (is_file($envPath)) {
    foreach (file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
        $line = trim($line);

        if ($line === '' || str_starts_with($line, '#') || !str_contains($line, '=')) {
            continue;
        }

        [$name, $value] = explode('=', $line, 2);
        $name = trim($name);
        $value = trim($value);

        $_ENV[$name] = $value;
        $_SERVER[$name] = $value;
    }
}

if (!defined('YII_ENV')) {
    define('YII_ENV', $_ENV['APP_ENV'] ?? 'dev');
}

if (!defined('YII_DEBUG')) {
    $debug = $_ENV['APP_DEBUG'] ?? '1';
    define('YII_DEBUG', in_array((string)$debug, ['1', 'true', 'on'], true));
}