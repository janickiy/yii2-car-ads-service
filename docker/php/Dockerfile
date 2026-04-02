FROM php:8.3-fpm-alpine

RUN apk add --no-cache \
    bash \
    git \
    unzip \
    icu-dev \
    libzip-dev \
    postgresql-dev \
    oniguruma-dev \
    linux-headers \
    $PHPIZE_DEPS \
 && docker-php-ext-install pdo pdo_pgsql intl mbstring opcache

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app
