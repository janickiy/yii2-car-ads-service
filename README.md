# API сервис объявление автомобилей

Backend API сервис объявлений автомобилей на PHP 8, Yii2 и PostgreSQL.

## Что реализовано

- REST API:
  - POST /api/v1/car/create
  - GET /api/v1/car/{id}
  - GET /api/v1/car/list?page=1
- Swagger UI:
  - GET /swagger
  - GET /swagger/openapi.json
- Многослойная архитектура:
  - application — DTO и сервисы
  - domain — сущности, контракты репозиториев и DataMapper интерфейс
  - infrastructure — ActiveRecord, DataMapper, реализация репозитория
  - modules — HTTP-слой API и admin
- DI контейнер Yii2 для сервисов, репозитория и DataMapper
- PostgreSQL + миграции
- Docker Compose + Nginx
- Админка по адресу http://localhost/admin
- CRUD для car, car_option, user
- Unit-тест для сервиса создания объявления

## Данные БД

- host: localhost
- port: 5432
- db: loans
- user: user
- password: password

## Доступ в админку

- login: admin
- password: 1234567

## Запуск

bash

cp .env.example .env
docker compose up --build -d


После запуска приложение доступно на:

- API: http://localhost/api/v1/
- Swagger UI: http://localhost/swagger
- Admin: http://localhost/admin

## Первый запуск внутри PHP-контейнера

bash

docker compose exec php composer install
docker compose exec php php yii migrate --interactive=0

## Очистка кэша и ассетов

bash

docker compose exec php sh -lc "rm -rf runtime/cache/* public/assets/*"
docker compose restart php nginx


## Полный сброс проекта

bash

docker compose down -v
rm -rf docker/postgres/data/*
docker compose up -d --build
docker compose exec php composer install
docker compose exec php php yii migrate --interactive=0
docker compose exec php sh -lc "rm -rf runtime/cache/* public/assets/*"
docker compose restart php nginx


## Проверка тестов

bash

docker compose exec php vendor/bin/phpunit


## Примеры curl

### 1. Создать объявление

bash

curl -X POST http://localhost/api/v1/car/create \
  -H "Content-Type: application/json" \
  -d '{
    "title": "Toyota Camry 2020",
    "description": "Седан в хорошем состоянии",
    "price": 24500,
    "photo_url": "https://example.com/camry.jpg",
    "contacts": "+7-900-123-45-67",
    "options": [
      {
        "brand": "Toyota",
        "model": "Camry",
        "year": 2020,
        "body": "sedan",
        "mileage": 54000
      }
    ]
  }

### 2. Получить объявление по ID

bash

curl "http://localhost/api/v1/car/1"


### 3. Получить список объявлений

bash

curl "http://localhost/api/v1/car/list?page=1"


## Формат ответов API

### POST /api/v1/car/create
- 201 Created
- возвращает созданное объявление с options или null

### GET /api/v1/car/{id}
- 200 OK
- возвращает одно объявление с техническими характеристиками, если они есть
- 404, если запись не найдена

### GET /api/v1/car/list
- 200 OK
- возвращает массив items и блок pagination

## Swagger

- UI: http://localhost/swagger
- OpenAPI JSON: `http://localhost/swagger/openapi.json`

Swagger описывает все три endpoint'а:
- создание объявления
- получение объявления по ID
- получение списка объявлений

## Примечания

- Миграции созданы в соответствии с заданием.
- Администратор создается миграцией автоматически.
- Технические характеристики автомобиля опциональны, но при передаче обязательны все поля.
- В БД связь car -> car_option реализована как optional has-one.
- Для списка объявлений используется пагинация по 10 элементов.
- DataMapper добавлен и используется в PostgreSQL-репозитории для преобразования ActiveRecord в доменную сущность.

## Затраченное время

Оценка на реализацию данного тестового задания: около 6 часов.
