# Car Ads Service

Backend API сервис объявлений автомобилей на PHP 8, Yii2 и PostgreSQL.

## Что реализовано

- REST API:
  - `POST /api/v1/car/create`
  - `GET /api/v1/car/{id}`
  - `GET /api/v1/car/list?page=1`
  - 
- Многослойная архитектура:
  - `application` — DTO и сервисы
  - `domain` — сущности и контракты репозиториев
  - `infrastructure` — ActiveRecord, DataMapper, реализации репозиториев
  - `modules` — HTTP-слой API и admin
- DI контейнер Yii2 для сервисов и репозиториев
- PostgreSQL + миграции
- Docker Compose + Nginx
- Админка по адресу `http://localhost/admin`
- CRUD для `car`, `car_option`, `user`
- Unit-тест для сервиса создания объявления

## Данные БД

- host: `localhost`
- port: `5432`
- db: `loans`
- user: `user`
- password: `password`

## Доступ в админку

- login: `admin`
- password: `1234567`

## Запуск

```bash
cp .env.example .env
docker compose up --build -d
```

После запуска приложение доступно на:

- API и admin: `http://localhost`
- Admin: `http://localhost/admin`

## Первый запуск внутри PHP-контейнера

```bash
docker compose exec php composer install
docker compose exec php php yii migrate --interactive=0
```

## Проверка тестов

```bash
docker compose exec php vendor/bin/phpunit
```

## Примечания

- Миграции созданы в соответствии с заданием.
- Администратор создается миграцией автоматически.
- Технические характеристики автомобиля опциональны, но при передаче обязательны все поля.
- Для списка объявлений используется пагинация по 10 элементов.

## Что нужно сделать перед сдачей

```bash
git init
git add .
git commit -m "Initial commit"
git remote add origin <your-github-repository>
git push -u origin main
```

## Затраченное время

Оценка на реализацию данного проекта: 5 часов.
