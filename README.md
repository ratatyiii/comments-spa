## Запуск приложения

- Использование php8.2 и выше

Для запуска нужно установить зависимости:

```bash
npm install
composer install
php artisan migrate
```
Используйте параметр --seed при миграции если хотите заполнить базу тестовыми данными

Запуск:

```bash
php artisan serve
php artisan queue:work
php artisan reverb:start
```


