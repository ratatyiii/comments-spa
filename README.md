## Документация для запуска Docker

### Вариант 1: Запуск Docker контейнеров

**Требования:**

* Docker
* Docker Compose

**Установка и запуск:**

1. Клонируйте репозиторий к себе.
2. Перейдите в корневую директорию проекта.
3. Скопируйте `.env.example` в `.env` и настройте его.
4. Запустите команду `docker-compose up --build -d` для запуска контейнеров.
5. После успешного запуска контейнеров приложение будет доступно по адресу `http://localhost:8000`.

### Вариант 2: Запуск вручную

**Требования:**

* PHP 8.2 или выше
* Composer
* Node.js
* MySQL

**Установка:**

1. Клонируйте репозиторий к себе.
2. Скопируйте `.env.example` в `.env` и настройте его.
3. Запустите `npm install` для установки JavaScript зависимостей.
4. Запустите `composer install` для установки PHP зависимостей.
5. Запустите `php artisan migrate` для создания таблиц базы данных.
6. (Необязательно) Запустите `php artisan db:seed` для заполнения базы тестовыми данными.

**Запуск:**

1. Запустите `php artisan serve` для запуска локального веб-сервера.
2. Запустите `php artisan queue:work` для обработки очереди заданий.
3. Запустите `php artisan reverb:start` для активации websocket.
4. Запустите `npm run build` для сборки проекта.
