<?php

declare(strict_types=1);

$envPath = dirname(__DIR__) . '/.env';
if (is_file($envPath)) {
    foreach (file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
        if (str_starts_with(trim($line), '#') || !str_contains($line, '=')) {
            continue;
        }
        [$name, $value] = explode('=', $line, 2);
        $_ENV[trim($name)] = trim($value);
        $_SERVER[trim($name)] = trim($value);
    }
}

define('YII_ENV', $_ENV['APP_ENV'] ?? 'dev');
define('YII_DEBUG', (bool)($_ENV['APP_DEBUG'] ?? true));
