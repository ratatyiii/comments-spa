FROM php:8.3-fpm

# Install packages
RUN apt-get update && apt-get install -y \
      build-essential \
      curl \
      apt-utils \
      libgd-dev \
      libpq-dev \
      libpng-dev \
      libjpeg-dev \
      libfreetype6-dev \
      libgif-dev \
      libzip-dev \
      libonig-dev \
      libxml2-dev \
      zip  \
      unzip  \
      git && \
      docker-php-ext-install pdo_mysql pcntl bcmath zip && \
      apt-get clean && \
      rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

#COPY ./_docker/app/php.ini /usr/local/etc/php/conf.d/php.ini

# Activate Gd extension
RUN docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install -j$(nproc) gd

# Install composer
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN curl -sS https://getcomposer.org/installer | php -- \
    --filename=composer \
    --install-dir=/usr/local/bin

COPY . /var/www/html

WORKDIR /var/www/html

RUN composer install
