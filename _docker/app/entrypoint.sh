#!/usr/bin/bash

if [ ! -f "vendor/autoload.php" ]; then
    composer install --no-progress --no-interaction
fi

if [ ! -f ".env" ]; then
    echo "Creating .env file"
    cp .env.example .env
fi

php artisan migrate
php artisan key:generate
php artisan cache:clear
php artisan config:clear

php-fpm

sleep infinity

#exec docker-php-entrypoint "$@"
