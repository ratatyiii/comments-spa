## Запуск приложения

**Требования:**

* PHP 8.2 или выше
* Composer
* MySQL

**Установка:**

1. Скопируйте `.env.example` в `.env`.
2. Запустите `npm install` для установки JavaScript зависимостей.
3. Запустите `composer install` для установки PHP зависимостей.
4. Запустите `php artisan migrate` для создания таблиц базы данных.
5. (Необязательно) Запустите `php artisan db:seed` для заполнения базы тестовыми данными.

**Запуск:**

1. Запустите `php artisan serve` для запуска локального веб-сервера.
2. Запустите `php artisan queue:work` для обработки очереди заданий.
3. Запустите `php artisan reverb:start` для активации websocket.
