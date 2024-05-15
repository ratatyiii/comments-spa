#!/usr/bin/bash

useradd -ms /usr/bin/bash -u 1000 laravel
usermod -a -G www-data laravel
usermod -a -G laravel www-data

chmod o+w storage -R
chmod o+w bootstrap/cache -R
chown laravel:laravel -R storage
chown laravel:laravel -R bootstrap/cache

if [ ! -f "vendor/autoload.php" ]; then
    composer install --no-progress --no-interaction
fi

if [ ! -f ".env" ]; then
    echo "Creating .env file"
    cp .env.example .env
fi

php artisan migrate
php artisan key:generate

exec docker-php-entrypoint "$@"
