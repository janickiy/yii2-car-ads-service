# Yii2 clean project with Docker

Чистый шаблон проекта на **Yii2 Basic** со сборкой через **Docker Compose**.

## Что внутри

- PHP 8.2 FPM
- Nginx
- PostgreSQL 15
- Базовая структура Yii2
- Конфигурация для запуска на `http://localhost:80`

## Структура

- `docker-compose.yml` — запуск контейнеров
- `docker/Dockerfile` — PHP-FPM образ
- `docker/nginx/default.conf` — конфиг Nginx
- `composer.json` — зависимости Yii2
- `config/` — конфиги приложения
- `controllers/`, `models/`, `views/` — базовая структура
- `commands/` — консольные команды и миграции

## Запуск

```bash
cp .env.example .env
docker compose up --build -d
docker compose exec php composer install
docker compose exec php php init --env=Development --overwrite=All
docker compose exec php php yii serve --help
```

Для этого шаблона веб-сервером выступает **Nginx**, поэтому встроенный сервер Yii использовать не нужно.

После запуска приложение доступно по адресу:

```text
http://localhost
```

## База данных PostgreSQL

По умолчанию:

- host: `db`
- port: `5432`
- database: `loans`
- user: `user`
- password: `password`

## Установка зависимостей

Если `composer install` попросит плагин Composer, разрешите его.

## Команды

Создать миграцию:

```bash
docker compose exec php php yii migrate/create create_example_table
```

Применить миграции:

```bash
docker compose exec php php yii migrate
```

## Примечание

Это **чистый проектный шаблон**, подготовленный под дальнейшую разработку.
Для первого запуска внутри контейнера выполняется `composer install`, чтобы подтянуть Yii2 и зависимости.
